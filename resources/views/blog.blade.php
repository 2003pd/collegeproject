<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Blog | MyStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ✨ Gradient text animation */
        .magic-text {
            background: linear-gradient(90deg, #ff0080, #7928ca, #00bcd4);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientMove 6s ease infinite;
        }
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Fade-in animation */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 1s ease;
        }
        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
@include('layouts.navigation')
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans antialiased">

    <!-- 🌈 Header Section -->
    <header class="py-16 text-center">
        <h1 class="text-5xl md:text-6xl font-extrabold magic-text mb-4">Our Blog</h1>
        <p class="text-gray-600 dark:text-gray-300 text-lg">Stories, tips, and inspiration from the MyStore team 🚀</p>
    </header>

    <!-- 📰 Blog Cards Section -->
    <section class="max-w-6xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 pb-16">

        <!-- Blog Card -->
        <div class="fade-in bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-transform hover:-translate-y-2">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80" alt="Blog 1" class="w-full h-56 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2 text-purple-600 dark:text-purple-400">The Future of Online Shopping</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Discover how AI and modern design are transforming the e-commerce experience for millions of users.
                </p>
                <a href="#" class="inline-block px-4 py-2 bg-purple-500 text-white rounded-full hover:bg-purple-600 transition">
                    Read More →
                </a>
            </div>
        </div>

        <!-- Blog Card -->
        <div class="fade-in bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-transform hover:-translate-y-2">
            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80" alt="Blog 2" class="w-full h-56 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2 text-purple-600 dark:text-purple-400">Building with Laravel</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Learn why Laravel is the best PHP framework for building scalable, elegant web applications fast.
                </p>
                <a href="#" class="inline-block px-4 py-2 bg-purple-500 text-white rounded-full hover:bg-purple-600 transition">
                    Read More →
                </a>
            </div>
        </div>

        <!-- Blog Card -->
        <div class="fade-in bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-transform hover:-translate-y-2">
            <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=800&q=80" alt="Blog 3" class="w-full h-56 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2 text-purple-600 dark:text-purple-400">UI/UX Trends 2025</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    From glassmorphism to minimal gradients — explore what’s shaping modern digital design in 2025.
                </p>
                <a href="#" class="inline-block px-4 py-2 bg-purple-500 text-white rounded-full hover:bg-purple-600 transition">
                    Read More →
                </a>
            </div>
        </div>

    </section>
    

    <!-- 🌟 Scroll Animation Script -->
    <script>
        const fadeEls = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('show');
            });
        }, { threshold: 0.2 });
        fadeEls.forEach(el => observer.observe(el));
    </script>

</body>
</html>
