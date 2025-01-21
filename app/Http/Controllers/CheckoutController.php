<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart');

        // Cek apakah keranjang kosong
        if (empty($cart)) {
            return redirect()->route('product')->with('error', 'Keranjang kosong!');
        }

        // Menampilkan halaman checkout dengan data keranjang
        return view('checkout.index', compact('cart'));
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

        // Mengambil data keranjang dari session
        $cart = session('cart');
        $total = 0;

        // Menghitung total harga dengan mempertimbangkan kuantitas
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];  // Mengalikan harga dengan kuantitas
        }

        // Menambahkan biaya pengiriman
        $shippingCost = 10000; // Misalnya biaya pengiriman Rp 10.000
        $total += $shippingCost;

        // Menambahkan data total ke validatedData
        $validatedData['total'] = $total;

        // Generate order ID (bisa menggunakan timestamp atau ID lain)
        $orderId = 'ORD-' . time();  // Menggunakan timestamp sebagai ID unik

        session()->forget('cart');

        // Redirect ke halaman invoice dengan data pesanan
        return view('checkout.invoice', [
            'order' => $validatedData,
            'cart' => $cart,
            'total' => $total,
            'orderId' => $orderId  // Mengirimkan orderId ke view
        ]);
    }
}
