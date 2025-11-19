@if($products->isEmpty())
    <p class="text-center text-gray-500 dark:text-gray-400 mt-6">No products found.</p>
@else
    @foreach ($products as $deal)
        <a href="{{ route('products.show', $deal->id) }}" 
           class="block bg-white dark:bg-gray-900 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-1 transition">
            <img src="{{ $deal->image ? asset('storage/'.$deal->image) : 'https://via.placeholder.com/400x300' }}"
                 alt="{{ $deal->name }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100 truncate">{{ $deal->name }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $deal->category->name ?? 'Uncategorized' }}</p>
                <p class="text-xl font-bold text-green-600 mt-2">₹{{ number_format($deal->price, 2) }}</p>
            </div>
        </a>
    @endforeach
@endif
