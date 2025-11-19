<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// ======================
// 🏠 PUBLIC (Frontend)
// ======================

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
// about page

Route::get('/about', function () {
    return view('about');
})->name('about');
// blog page
Route::get('/blog', function () {
    return view('blog');
})->name('blog');


// Category-wise products
Route::get('/category/{id}', [HomeController::class, 'categoryProducts'])->name('category.products');

// Razorpay payment routes
Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');


// ======================
// 👤 USER AUTH (Breeze)
// ======================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;

// Services page
Route::get('/services', [ServiceController::class, 'index'])->name('services');

// Contact form submission (goes to contacts table)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.message');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// ======================
// 🛒 ADMIN ROUTES
// ======================

// Admin login/logout
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard + Product CRUD
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('dashboard', [AdminProductController::class, 'index'])->name('admin.dashboard');
    Route::get('products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('products/store', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
});

// Admin Categories
use App\Http\Controllers\Admin\CategoryController;



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
});
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.products');
Route::resource('categories', CategoryController::class);




use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
use App\Http\Controllers\Admin\AdminBlogController;

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs/store', [AdminBlogController::class, 'store'])->name('admin.blogs.store');
});


use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search/ajax', [ProductController::class, 'ajaxSearch'])->name('products.ajax.search');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

use App\Http\Controllers\ReviewController;

Route::post('/products/{id}/review', [ReviewController::class, 'store'])->name('products.review');

use App\Http\Controllers\Admin\BannerController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
    Route::post('/banner/update', [BannerController::class, 'update'])->name('banner.update');
});
