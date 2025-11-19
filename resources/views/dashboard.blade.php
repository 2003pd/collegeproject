{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">

    {{-- 🌐 Navbar --}}
    @include('layouts.navigation')

    {{-- ✨ Header --}}
    <header class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 text-white py-12 shadow-md">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-extrabold">Dashboard</h1>
            <p class="text-gray-200 mt-2">Welcome back, {{ Auth::user()->name ?? 'User' }} 👋</p>
        </div>
    </header>

    {{-- 🧾 Main Content --}}
    <main class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl transition transform hover:-translate-y-1 hover:shadow-2xl">
            <div class="p-8 text-center text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-semibold mb-2">You're logged in!</h2>
                <p class="text-gray-600 dark:text-gray-400">Enjoy exploring your personalized dashboard.</p>
            </div>
        </div>
    </main>

    {{-- 🦶 Footer --}}
    <footer class="bg-gray-900 text-gray-400 text-center py-6 mt-10">
        <p>&copy; {{ date('Y') }} <span class="font-semibold text-white">MyStore</span>. All Rights Reserved.</p>
    </footer>

</body>
</html>
