{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyStore | Shop Smart, Live Better</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">


    {{-- 🌐 Navbar --}}
    @include('layouts.navigation')
    

    {{-- 🏠 Hero Section --}}
    <section class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 text-white py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between">
            <div class="space-y-6 md:w-1/2">
                <h1 class="text-5xl font-extrabold leading-tight animate-fade-in">
                    Shop the Latest Trends <br>
                    <span class="text-yellow-300">with MyStore</span>
                </h1>
                <p class="text-lg text-gray-100">
                    Find everything from fashion to electronics at unbeatable prices.
                </p>
                <a href="#shop" 
                   class="inline-block bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-6 py-3 rounded-lg shadow-lg transition transform hover:scale-105">
                    Start Shopping
                </a>
            </div>
            <div class="mt-10 md:mt-0 md:w-1/2">
               <img src="{{ asset('images/card3.jpg') }}" 
     alt="Shopping" class="rounded-2xl shadow-2xl w-full h-80 object-cover">

            </div>
        </div>
    </section>
    <section class="my-12">
        @include('components.carousel')
    </section>
{{-- blog categories section --}}
@php use Illuminate\Support\Str; @endphp

<section class="py-16 bg-gray-50 dark:bg-gray-900">
    <h2 class="text-3xl font-extrabold text-center text-purple-600 mb-10 flex items-center justify-center gap-2">
        <i class="fas fa-video"></i> Latest Video Blogs
    </h2>

    @if($blogs->count())
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-6">
        @foreach($blogs as $blog)
            <div class="rounded-2xl overflow-hidden shadow-lg bg-gray-800 text-white hover:shadow-2xl transition-all duration-300">
                <div class="relative w-full h-64 overflow-hidden group cursor-pointer"
                     onclick="openVideoModal('{{ $blog->video_url }}')">
                     
                    {{-- ✅ Blog Image --}}
                    <img src="{{ asset('storage/' . $blog->image) }}"
                         alt="{{ $blog->title }}"
                         class="w-full h-64 object-cover transition-all duration-500 group-hover:scale-110">

                    {{-- ▶️ Play Button Overlay --}}
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <div class="bg-white text-black rounded-full p-4 shadow-lg">
                            <i class="fas fa-play text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="p-5">
                    <h3 class="text-lg font-semibold text-purple-400 mb-2">{{ $blog->title }}</h3>
                    <p class="text-gray-300 text-sm line-clamp-3">{{ $blog->content }}</p>
                </div>
            </div>
        @endforeach
    </div>
    @else
        <p class="text-center text-gray-500 dark:text-gray-400 mt-6">No blogs added yet.</p>
    @endif
</section>

{{-- ✅ Modal for YouTube Video --}}
<div id="videoModal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center hidden z-50">
    <div class="relative w-full max-w-3xl p-4">
        <button onclick="closeVideoModal()" class="absolute -top-6 right-0 text-white text-3xl font-bold">&times;</button>
        <div class="aspect-w-16 aspect-h-9">
            <iframe id="videoFrame" class="w-full h-[500px] rounded-lg shadow-lg"
                src="" frameborder="0"
                allow="autoplay; encrypted-media" allowfullscreen>
            </iframe>
        </div>
    </div>
</div>

<script>
function openVideoModal(videoUrl) {
    const modal = document.getElementById('videoModal');
    const iframe = document.getElementById('videoFrame');
    iframe.src = videoUrl + "?autoplay=1";
    modal.classList.remove('hidden');
}
function closeVideoModal() {
    const modal = document.getElementById('videoModal');
    const iframe = document.getElementById('videoFrame');
    iframe.src = "";
    modal.classList.add('hidden');
}
</script>



 {{-- 🛍️ Shop by Category Section --}}
 @php
    // Fallback: prevent undefined variable errors
    $categories = $categories ?? \App\Models\Category::all();
@endphp

<section class="max-w-7xl mx-auto px-6 py-14">
    <h2 class="text-3xl md:text-4xl font-extrabold text-center mb-10">
        <span class="bg-gradient-to-r from-indigo-500 to-purple-600 text-transparent bg-clip-text">
            🌟 Shop by Category
        </span>
    </h2>

    @if($categories->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('category.products', $category->id) }}"
                   class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl 
                          transform hover:-translate-y-2 transition-all duration-300 p-5 text-center">

                    {{-- Optional image if available --}}
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}"
                             alt="{{ $category->name }}"
                             class="mx-auto h-24 w-24 object-cover rounded-full mb-4 border-4 border-indigo-200 group-hover:border-indigo-500 transition">
                    @else
                        <div class="mx-auto h-24 w-24 flex items-center justify-center bg-gradient-to-br 
                                    from-indigo-100 to-indigo-200 text-indigo-700 font-bold rounded-full mb-4 text-xl">
                            {{ strtoupper(substr($category->name, 0, 2)) }}
                        </div>
                    @endif

                    <h3 class="font-semibold text-gray-800 dark:text-gray-100 text-lg mb-2 group-hover:text-indigo-600">
                        {{ $category->name }}
                    </h3>

                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        Explore the latest {{ strtolower($category->name) }} products →
                    </p>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-600 dark:text-gray-300 text-lg mt-10">
            😔 No categories found yet. Please check back soon!
        </div>
    @endif
</section>


    {{-- ⚡ Featured / Deals Section --}}
    <section class="bg-gradient-to-r from-purple-100 to-indigo-100 dark:from-gray-800 dark:to-gray-700 py-14">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-8 text-center">🔥 Featured Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
             @foreach ($products->take(4) as $deal)
    <a href="{{ route('products.show', $deal->id) }}" 
       class="block bg-white dark:bg-gray-900 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-1 transition">
        <img src="{{ $deal->image ? asset('storage/'.$deal->image) : 'https://via.placeholder.com/400x300' }}"
             alt="{{ $deal->name }}" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100 truncate">{{ $deal->name }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $deal->category->name ?? 'Uncategorized' }}</p>
            <p class="text-xl font-bold text-green-600 mt-2">₹{{ number_format($deal->price, 2) }}</p>
            <div class="flex gap-2 mt-4">
                <span class="bg-indigo-600 text-white px-3 py-2 rounded-lg">View Details</span>
            </div>
        </div>
    </a>
@endforeach

            </div>
        </div>
    </section>
    
    {{-- 🛒 Product Grid Section --}}
    <section id="shop" class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-8 text-center">All Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl hover:scale-105 transition">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/400x300' }}"
                         class="w-full h-48 object-cover" alt="{{ $product->name }}">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $product->category->name ?? 'Uncategorized' }}</p>
                        <p class="text-xl font-bold text-green-600 mt-2">₹{{ number_format($product->price,2) }}</p>
                        <div class="flex gap-2 mt-4">
                            <a href="{{ route('cart.add', $product->id) }}" 
                               class="bg-indigo-600 text-white px-3 py-2 rounded-lg hover:bg-indigo-700 transition">
                               Add to Cart
                            </a>
                            <a href="{{ route('checkout') }}"
                               class="bg-yellow-500 text-white px-3 py-2 rounded-lg hover:bg-yellow-600 transition">
                                Buy Now
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-600 dark:text-gray-300 py-10">
                    No products found.
                </div>
            @endforelse
        </div>
    </section>
 {{-- review section --}}
  {{-- 📝 Review Section --}}
@php
    // ✅ Prevent "Undefined variable" error (if controller didn't send it)
    $topReviews = $topReviews ?? collect();
@endphp

<section class="bg-gray-50 dark:bg-gray-900 py-14">
    <h2 class="text-3xl font-bold text-center mb-10 text-gray-800 dark:text-gray-100">
        ⭐ What Our Customers Say
    </h2>

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($topReviews as $review)
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="flex items-center mb-3">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                    @endfor
                </div>
                <p class="italic text-gray-700 dark:text-gray-300">
                    "{{ \Illuminate\Support\Str::limit($review->comment, 120) }}"
                </p>
                <h4 class="font-semibold mt-4 text-gray-800 dark:text-gray-200">— {{ $review->name }}</h4>
                <p class="text-sm text-gray-500 mt-1">
                    on <strong>{{ $review->product->name ?? 'Product' }}</strong>
                </p>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500 dark:text-gray-400">
                No reviews yet. Be the first to review our products!
            </div>
        @endforelse
    </div>
</section>

    {{-- 💌 Newsletter Section --}}
    <section class="bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 text-white py-14">
        <div class="max-w-3xl mx-auto text-center px-6">
            <h2 class="text-3xl font-bold mb-3">Join Our Newsletter</h2>
            <p class="text-gray-200 mb-6">Get updates on new arrivals, exclusive offers, and more.</p>
            <form class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <input type="email" placeholder="Enter your email"
                       class="px-4 py-3 rounded-lg w-72 text-gray-900 focus:outline-none">
                <button type="submit"
                        class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold transition transform hover:scale-105">
                    Subscribe
                </button>
            </form>
        </div>
    </section>

@php
    $banner = \App\Models\Banner::first();
@endphp

@if ($banner && $banner->is_active)
    <section class="{{ $banner->background_color }} text-center py-6 font-semibold text-lg">
        {{ $banner->message }}
    </section>
@endif



    {{-- 🦶 Footer --}}
    <footer class="bg-gray-900 text-gray-400 text-center py-6 mt-10">
        <p>&copy; {{ date('Y') }} <span class="font-semibold text-white">MyStore</span>. All Rights Reserved.</p>
    </footer>

</body>
</html>
