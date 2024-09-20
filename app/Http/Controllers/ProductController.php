<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $products = Product::orderByRaw('stock < 5 DESC') // Urutkan produk dengan stok kurang dari 5 di atas
        ->get();
        return view('admin.dashboard', compact('products'));
    }
    

    public function create()
    {
        $products = Product::all();
        return view('admin.produk.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.produk.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Product deleted successfully.');
    }

    public function updateStock(Request $request, $id)
{
    $product = Product::find($id);

    if ($product && $product->stock > 0) {
        $product->stock--;
        $product->save();

        return response()->json(['success' => true, 'stock' => $product->stock]);
    }

    return response()->json(['success' => false, 'message' => 'Stok produk habis!'], 400);
}
}
