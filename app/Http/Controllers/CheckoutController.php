<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order; // Pastikan model Order ada
use App\Models\OrderItem; // Pastikan model OrderItem ada

class CheckoutController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();
        $cartItems = Cart::with('product')->where('session_id', $sessionId)->get();

        // Redirect jika keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('product')->with('error', 'Keranjang Anda kosong!');
        }

        // Kirim data ke view
        return view('checkout.index', compact('cartItems'));
    }

    public function confirmOrder(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_postal' => 'required|string|max:10',
        ]);

        $sessionId = session()->getId();
        $cartItems = Cart::with('product')->where('session_id', $sessionId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('product')->with('error', 'Keranjang Anda kosong!');
        }

        // Hitung total harga
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Tambahkan biaya pengiriman
        $shippingCost = 10000;
        $total += $shippingCost;

        // Simpan data pesanan ke tabel `orders`
        $order = Order::create([
            'customer_name' => $validatedData['customer_name'],
            'customer_email' => $validatedData['customer_email'],
            'customer_phone' => $validatedData['customer_phone'],
            'shipping_address' => $validatedData['shipping_address'],
            'shipping_city' => $validatedData['shipping_city'],
            'shipping_postal' => $validatedData['shipping_postal'],
            'total' => $total,
            'order_id' => 'ORD-' . time(), // ID unik untuk pesanan
        ]);

        // Simpan detail produk ke tabel `order_items`
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);

            // Kurangi stok produk
            $product = Product::find($item->product_id);
            if ($product->stock >= $item->quantity) {
                $product->stock -= $item->quantity;
                $product->save();
            } else {
                return redirect()->route('cart')->with('error', 'Stok produk tidak mencukupi: ' . $product->name);
            }
        }

        // Hapus data keranjang dari database
        Cart::where('session_id', $sessionId)->delete();

        // Redirect ke halaman invoice dengan data pesanan
        return view('checkout.invoice', [
            'order' => $order,
            'cartItems' => $cartItems,
            'total' => $total,
            'orderId' => $order->order_id, // Kirimkan $orderId ke view

        ]);
    }

}
