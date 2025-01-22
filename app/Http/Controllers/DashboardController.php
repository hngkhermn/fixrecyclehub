<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
            'images' => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'required'
        ]);

        // if ($request->hasFile('images')){
        //     $validateData['images'] = $request->file('images')->store('images', 'public');
        // }

        $data = $request->all();

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $destinationPath = storage_path('app/public/images');
            $filename = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);

            $data['images'] = $filename;
        }

        Product::create($data);
        return redirect()->route('dashboard.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $dashboard)
    {
        // $single_product = Product::where('id', $product)->first();
        return view('dashboard.show', compact('dashboard'));
    }

    public function edit(Product $dashboard)
    {
        return view('dashboard.edit', compact('dashboard'));
    }

    public function update(Request $request, Product $dashboard)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'required'
        ]);

        $data = $request->except('images');

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $destinationPath = storage_path('app/public/images');
            $filename = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);

            $data['images'] = $filename;
        }


        $dashboard->update($data);

        return redirect()->route('dashboard.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $dashboard)
    {
        // Cek apakah produk memiliki gambar
        if ($dashboard->images) {
            $imagePath = storage_path('app/public/images/' . $dashboard->images);

            // Hapus file gambar jika ada
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Hapus produk dari database
        $dashboard->delete();

        return redirect()->route('dashboard.index')->with('success', 'Product deleted successfully.');
    }
}
