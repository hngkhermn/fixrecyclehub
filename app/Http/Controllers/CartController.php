<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Tampilkan halaman keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Tambahkan produk ke keranjang
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id_products])) {
            $cart[$product->id_products]['quantity']++;
        } else {
            $cart[$product->id_products] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Perbarui seluruh keranjang
    public function updateAll(Request $request)
    {
        $cart = session()->get('cart', []);
        $quantities = $request->input('quantities', []);
        $removeIds = $request->input('remove', []);

        // Perbarui kuantitas dan hapus item dengan kuantitas 0
        foreach ($quantities as $id => $quantity) {
            if (isset($cart[$id])) {
                if ($quantity == 0) {
                    unset($cart[$id]);
                } else {
                    $cart[$id]['quantity'] = $quantity;
                }
            }
        }

        // Hapus item berdasarkan checkbox
        foreach ($removeIds as $id) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
        return redirect()->route('cart')->with('success', 'Keranjang berhasil diperbarui!');
    }

    // Hapus produk dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
