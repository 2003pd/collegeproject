{{-- resources/views/cart.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">

    {{-- Navbar --}}
    @include('layouts.navigation')

    <div class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">🛒 Your Cart</h2>

        @if($cart && count($cart) > 0)
            <div class="grid grid-cols-1 gap-4">
                @foreach($cart as $id => $product)
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg flex justify-between items-center">
                        <div class="flex items-center gap-4">
                            <img src="{{ $product['image'] ? asset('storage/'.$product['image']) : 'https://via.placeholder.com/100' }}" 
                                 class="w-24 h-24 object-cover rounded" alt="{{ $product['name'] }}">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $product['name'] }}</h3>
                                <p class="text-green-600 font-bold">₹{{ number_format($product['price'],2) }}</p>
                                <p>Quantity: {{ $product['quantity'] }}</p>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('cart.remove', $id) }}" 
                               class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition">
                               Remove
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 text-right">
                <p class="text-xl font-bold">
                    Total: ₹{{ number_format(collect($cart)->sum(fn($p) => $p['price'] * $p['quantity']),2) }}
                </p>
                <a href="{{ route('checkout') }}" 
                   class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition mt-2 inline-block">
                   Proceed to Checkout
                </a>
            </div>
        @else
            <p class="text-center text-gray-600 dark:text-gray-300 py-10">Your cart is empty.</p>
        @endif
    </div>

</body>
</html>
