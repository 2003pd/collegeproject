<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Product Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 font-sans antialiased">

    <!-- Simple Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow mb-10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">MyStore</a>
            <a href="{{ route('products.index') }}" class="text-gray-700 dark:text-gray-300 hover:underline">All Products</a>
        </div>
    </nav>

    <!-- Product Detail Section -->
    <div class="max-w-5xl mx-auto px-6 py-10">
        <div class="grid md:grid-cols-2 gap-8">
            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/500x400' }}" 
                 alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg shadow">

            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $product->name }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $product->category->name ?? 'Uncategorized' }}</p>
                <p class="text-2xl text-green-600 font-bold mb-4">
                    ₹{{ number_format($product->price, 2) }}
                </p>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                    {{ $product->description ?? 'No description available.' }}
                </p>

                <div class="flex gap-3">
                    <a href="{{ route('cart.add', $product->id) }}" 
                       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                       Add to Cart
                    </a>
                    <a href="{{ route('checkout') }}" 
                       class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                       Buy Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    
      <section class="mt-10 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Customer Reviews</h2>

    {{-- Review List --}}
    @forelse($product->reviews as $review)
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-4 shadow">
            <div class="flex items-center mb-2">
                @for($i=1; $i<=5; $i++)
                    <span class="{{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                @endfor
            </div>
            <p class="text-gray-700 dark:text-gray-300">{{ $review->comment }}</p>
            <p class="text-sm text-gray-500 mt-2">— {{ $review->name }}, {{ $review->created_at->format('d M Y') }}</p>
        </div>
    @empty
        <p class="text-gray-500 dark:text-gray-400">No reviews yet. Be the first to review this product!</p>
    @endforelse

    {{-- Add Review Form --}}
    <div class="mt-8 bg-gray-100 dark:bg-gray-900 p-6 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-3 text-gray-800 dark:text-gray-100">Write a Review</h3>
        <form action="{{ route('products.review', $product->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 dark:text-gray-300">Your Name</label>
                <input type="text" name="name" required class="w-full p-2 rounded border dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Rating</label>
                <select name="rating" class="w-full p-2 rounded border dark:bg-gray-700 dark:text-white">
                    @for($i=5; $i>=1; $i--)
                        <option value="{{ $i }}">{{ $i }} ★</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Comment</label>
                <textarea name="comment" rows="3" required class="w-full p-2 rounded border dark:bg-gray-700 dark:text-white"></textarea>
            </div>

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                Submit Review
            </button>
        </form>
    </div>
</section>


    <!-- Simple Footer -->
    <footer class="bg-white dark:bg-gray-800 mt-10 py-6">
        <div class="text-center text-gray-500 dark:text-gray-400">
            © {{ date('Y') }} MyStore. All rights reserved.
        </div>
    </footer>

</body>
</html>
