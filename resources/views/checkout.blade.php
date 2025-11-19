{{-- resources/views/payment.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pay with Razorpay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">

    {{-- Navbar --}}
    @include('layouts.navigation')

    {{-- Payment Form --}}
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6 text-center">
                Pay with Razorpay
            </h2>

            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/pay" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="amount" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                        Amount (INR)
                    </label>
                    <input type="number" name="amount" id="amount" min="1" placeholder="Enter amount"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none dark:bg-gray-700 dark:text-white dark:border-gray-600"
                        required>
                </div>

                <button type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                    Pay Now
                </button>
            </form>
        </div>
    </div>

</body>
</html>
