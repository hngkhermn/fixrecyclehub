<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard.index', compact('products'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'required|string'
        ]);

        if ($request->hasFile('images')) {
            $validateData['images'] = $request->file('images')->store('images', 'public');
        }

        Product::create($validateData);

        return redirect()->route('dashboard.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        // Temukan produk berdasarkan id_products
        $product = Product::findOrFail($id);

        // Cek apakah ada gambar baru diupload
        if ($request->hasFile('images')) {
            // Hapus gambar lama jika ada
            if ($product->images) {
                Storage::disk('public')->delete($product->images);
            }

            // Simpan gambar baru
            $validateData['images'] = $request->file('images')->store('images', 'public');
        }

        // Perbarui data produk
        $product->update($validateData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('dashboard.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        // Temukan produk berdasarkan id_products
        $product = Product::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($product->images) {
            Storage::disk('public')->delete($product->images);
        }

        // Hapus produk dari database
        $product->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('dashboard.index')->with('success', 'Product deleted successfully.');
    }

}
