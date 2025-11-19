<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        $products = Product::where('category_id', $id)->get();
        $blogs = Blog::latest()->get(); // ✅ make sure this is added

        return view('home', compact('category', 'categories', 'products', 'blogs'));
    }
}
