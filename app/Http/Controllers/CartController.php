<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    // Tampilkan halaman keranjang
    public function index()
    {
        $sessionId = session()->getId();
        $cartItems = Cart::with('product')->where('session_id', $sessionId)->get();
        return view('cart.index', compact('cartItems'));
    }

    // Tambahkan produk ke keranjang
    public function add(Request $request)
    {
        $product = Product::where('id_products', $request->product_id)->firstOrFail();
        $sessionId = session()->getId();

        $cartItem = Cart::where('session_id', $sessionId)
                        ->where('product_id', $product->id_products)
                        ->first();

        if ($cartItem) {
            // Jika produk sudah ada di keranjang, tambahkan kuantitas
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Jika produk belum ada di keranjang, buat entri baru
            Cart::create([
                'session_id' => $sessionId,
                'product_id' => $product->id_products,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Perbarui seluruh keranjang
    public function updateAll(Request $request)
    {
        $sessionId = session()->getId();
        $quantities = $request->input('quantities', []);
        $removeIds = $request->input('remove', []);

        foreach ($quantities as $id => $quantity) {
            $cartItem = Cart::where('id', $id)->where('session_id', $sessionId)->first();
            if ($cartItem) {
                if ($quantity == 0) {
                    $cartItem->delete();
                } else {
                    $cartItem->quantity = $quantity;
                    $cartItem->save();
                }
            }
        }

        foreach ($removeIds as $id) {
            $cartItem = Cart::where('id', $id)->where('session_id', $sessionId)->first();
            if ($cartItem) {
                $cartItem->delete();
            }
        }

        return redirect()->route('cart')->with('success', 'Keranjang berhasil diperbarui!');
    }

    // Hapus produk dari keranjang
    public function remove($id)
    {
        $sessionId = session()->getId();
        $cartItem = Cart::where('id', $id)->where('session_id', $sessionId)->first();
        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
