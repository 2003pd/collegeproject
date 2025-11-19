<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Review;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
      $blogs = Blog::latest()->get();
       $banner = Banner::where('is_active', true)->first();
      $topReviews = Review::with('product')->latest()->take(6)->get();
        return view('home', compact('categories', 'products', 'blogs', 'topReviews', 'banner'));
    }

    public function categoryProducts($id)
    {
        $categories = Category::all();
        $products = Product::with('category')->where('category_id', $id)->get();
        return view('home', compact('categories', 'products'));
    }
    
}
