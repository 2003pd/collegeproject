<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File; // For deleting images
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Blog;

class ProductController extends Controller
{
   
public function index()
{
    $contacts = Contact::latest()->get();
    $products = Product::with('category')->latest()->get();

    return view('admin.dashboard', compact('products','contacts'));
}

    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // ✅ Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // ✅ Create product
        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'] ?? null,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product added successfully!');
    }
public function create()
{
    $categories = Category::all();
    return view('admin.products.create', compact('categories'));
}

    public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all();
    return view('admin.products.edit', compact('product', 'categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $product = Product::findOrFail($id);

    // If new image uploaded, handle it
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $product->image = $imageName;
    }

    // Update other fields
    $product->name = $request->name;
    $product->category_id = $request->category_id;
    $product->description = $request->description;
    $product->price = $request->price;

    $product->save();

    return redirect()->route('admin.dashboard')->with('success','Product updated successfully!');
}

public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Delete the image file if exists
    if($product->image && File::exists(public_path('images/'.$product->image))){
        File::delete(public_path('images/'.$product->image));
    }

    $product->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully!');
}
}
