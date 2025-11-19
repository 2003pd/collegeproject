<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }
    public function show($id)
{
    $product = Product::with('category')->findOrFail($id);
    return view('products.show', compact('product'));
}
public function ajaxSearch(Request $request)
{
    $query = $request->input('query');

    $products = Product::when($query, function ($q) use ($query) {
        $q->where('name', 'like', "%{$query}%")
          ->orWhere('description', 'like', "%{$query}%");
    })->take(8)->get();

    // Return partial HTML (only product cards)
    $html = view('products._list', compact('products'))->render();

    return response()->json(['html' => $html]);
}


    // Show products by category
    public function category($id)
    {
        $products = Product::where('category_id', $id)->get();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }
}
