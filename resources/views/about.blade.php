{{-- resources/views/about.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | MyStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .tilt-card {
            transition: transform 0.5s ease, box-shadow 0.3s ease;
            transform-style: preserve-3d;
        }

        .tilt-card:hover {
            transform: rotateY(10deg) rotateX(5deg) scale(1.03);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .glow {
            text-shadow: 0 0 10px rgba(59, 130, 246, 0.6);
        }

        .glass {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-100 via-blue-50 to-gray-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 text-gray-800 dark:text-gray-200 font-sans antialiased">

    {{-- Navbar --}}
    @include('layouts.navigation')

    {{-- Hero Section --}}
    <section class="text-center py-20">
        <h1 class="text-5xl font-extrabold glow text-blue-600 dark:text-blue-400 drop-shadow-lg">
            🌟 About <span class="text-gray-900 dark:text-white">MyStore</span>
        </h1>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
            We are a passionate team of creators and developers dedicated to building the best e-commerce experience for everyone.
        </p>
    </section>

    {{-- Mission Section --}}
    <section class="py-16 bg-white/40 dark:bg-gray-800/40 glass rounded-2xl mx-6 md:mx-16 shadow-xl">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-4">🎯 Our Mission</h2>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                To empower businesses and customers by providing an intuitive, reliable, and visually engaging online shopping platform that blends speed, design, and innovation.
            </p>
        </div>
    </section>

    {{-- Our Story --}}
    <section class="py-20 max-w-5xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-6">📖 Our Story</h2>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed max-w-3xl mx-auto">
            Started in 2025 with a vision to simplify e-commerce, MyStore began as a small project between friends passionate about technology and design.
            Today, we serve thousands of customers with high-quality products, smooth transactions, and seamless shopping experiences.
        </p>
    </section>

    {{-- Team Section --}}
    <section class="py-16 bg-gray-100/50 dark:bg-gray-800/50">
        <h2 class="text-3xl font-bold text-center text-blue-600 dark:text-blue-400 mb-12">👨‍💻 Meet Our Team</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 px-6 md:px-16">
            @foreach([
                ['name' => 'Jayanti Maurya', 'role' => 'Founder & CEO', 'img' => 'https://randomuser.me/api/portraits/women/45.jpg'],
                ['name' => 'Rahul Sharma', 'role' => 'Lead Developer', 'img' => 'https://randomuser.me/api/portraits/men/52.jpg'],
                ['name' => 'Priya Singh', 'role' => 'UI/UX Designer', 'img' => 'https://randomuser.me/api/portraits/women/68.jpg'],
                ['name' => 'Amit Patel', 'role' => 'Marketing Head', 'img' => 'https://randomuser.me/api/portraits/men/61.jpg']
            ] as $member)
            <div class="tilt-card glass p-6 rounded-2xl shadow-lg text-center">
                <img src="{{ $member['img'] }}" alt="{{ $member['name'] }}" class="w-32 h-32 rounded-full mx-auto mb-4 border-4 border-blue-500 shadow-md">
                <h3 class="text-xl font-semibold">{{ $member['name'] }}</h3>
                <p class="text-blue-600 dark:text-blue-400">{{ $member['role'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-6 text-center text-gray-600 dark:text-gray-400">
        © {{ date('Y') }} MyStore — Crafted with ❤️ by Our Team
    </footer>

</body>
</html>
