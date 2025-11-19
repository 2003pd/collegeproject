{{-- resources/views/services.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* 🌟 Custom 3D Card Effect */
        .service-card {
            transform-style: preserve-3d;
            transition: transform 0.6s ease, box-shadow 0.3s ease;
            perspective: 1000px;
        }

        .service-card:hover {
            transform: rotateY(10deg) rotateX(5deg) scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .glow-button {
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.6);
        }

        .glow-button:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 1);
            transform: translateY(-2px);
        }

        .glass {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="bg-gradient-to-r from-gray-100 via-blue-50 to-gray-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 font-sans antialiased">

    {{-- Navbar --}}
    @include('layouts.navigation')

    <div class="container mx-auto px-6 py-16">
        <h1 class="text-4xl font-extrabold text-center mb-10 text-gray-800 dark:text-white drop-shadow-lg">🚀 Our Services</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @foreach($services as $service)
                <div class="service-card bg-white/80 dark:bg-gray-800 glass p-6 rounded-2xl shadow-lg relative">
                    <h2 class="text-2xl font-semibold text-blue-600 dark:text-blue-400 mb-2">{{ $service['title'] }}</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $service['description'] }}</p>

                    <button onclick="document.getElementById('contact-form-{{ $loop->index }}').classList.toggle('hidden')"
                            class="glow-button bg-blue-600 text-white px-4 py-2 rounded-full">
                        ✉️ Contact Us
                    </button>

                    <form id="contact-form-{{ $loop->index }}" action="{{ route('contact.message') }}" method="POST"
                          class="mt-4 hidden bg-gray-50 dark:bg-gray-700 p-4 rounded-xl shadow-inner">
                        @csrf
                        <input type="hidden" name="service" value="{{ $service['title'] }}">
                        <input type="text" name="name" placeholder="Your Name" class="w-full mb-2 p-2 border rounded" required>
                        <input type="email" name="email" placeholder="Your Email" class="w-full mb-2 p-2 border rounded" required>
                        <input type="text" name="phone" placeholder="Phone Number" class="w-full mb-2 p-2 border rounded">
                        <textarea name="message" placeholder="Message" class="w-full mb-2 p-2 border rounded"></textarea>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            🚀 Send
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
