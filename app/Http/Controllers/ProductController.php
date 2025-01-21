<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Menangani pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Menangani kategori yang dipilih
        $category = $request->get('category', 'all'); // Default 'all' jika kategori tidak dipilih
        if ($category !== 'all') {
            $query->where('categories', $category);
        }

        // Menangani urutan produk
        $sort = $request->get('sort', 'name_asc'); // Default urutan berdasarkan nama (A-Z)
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->orderBy('name', 'asc'); // Default urutan berdasarkan nama (A-Z)
                break;
        }

        // Ambil produk sesuai filter, pencarian, dan urutan
        $products = $query->get();

        // Mengirim data ke view
        return view('product.product', compact('products', 'category', 'sort'));
    }

    public function show($id_products)
    {
        // Menampilkan produk berdasarkan id
        $product = Product::findOrFail($id_products);

        return view('product.detail', compact('product'));
    }

    public function checkout($id_products)
    {
        // Ambil data produk berdasarkan id_products
        $product = Product::findOrFail($id_products);

        // Tampilkan halaman checkout dengan data produk
        return view('product.checkout', compact('product'));
    }
}
