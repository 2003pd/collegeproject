<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Cool Carousel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .carousel-slide {
            transition: transform 0.8s ease-in-out;
        }
        .carousel-image {
            background-size: cover;
            background-position: center;
            height: 500px;
        }
        .carousel-overlay {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7));
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <div class="relative overflow-hidden w-full max-w-6xl mx-auto mt-10 rounded-2xl shadow-2xl">
        <!-- Carousel Container -->
        <div id="carousel" class="flex carousel-slide">

            <!-- Slide 1 -->
            <div class="min-w-full carousel-image relative" style="background-image: url('https://images.unsplash.com/photo-1503264116251-35a269479413?auto=format&fit=crop&w=1600&q=80')">
                <div class="absolute inset-0 carousel-overlay flex flex-col justify-center items-center text-center px-4">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-3 magic-text">Welcome to MyStore</h2>
                    <p class="text-gray-200 text-lg">Discover, shop, and smile with every click.</p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="min-w-full carousel-image relative" style="background-image: url('https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1600&q=80')">
                <div class="absolute inset-0 carousel-overlay flex flex-col justify-center items-center text-center px-4">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-3 magic-text">Fast & Reliable</h2>
                    <p class="text-gray-200 text-lg">Get your favorite items delivered right to your door.</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="min-w-full carousel-image relative" style="background-image: url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1600&q=80')">
                <div class="absolute inset-0 carousel-overlay flex flex-col justify-center items-center text-center px-4">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-3 magic-text">Shop Smart, Live Better</h2>
                    <p class="text-gray-200 text-lg">Quality products with a modern shopping experience.</p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button id="prevBtn" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white rounded-full p-3">
            ❮
        </button>
        <button id="nextBtn" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white rounded-full p-3">
            ❯
        </button>

        <!-- Dots -->
        <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2">
            <span class="dot w-3 h-3 bg-white rounded-full opacity-70"></span>
            <span class="dot w-3 h-3 bg-white rounded-full opacity-40"></span>
            <span class="dot w-3 h-3 bg-white rounded-full opacity-40"></span>
        </div>
    </div>

    <script>
        const slides = document.querySelectorAll('#carousel > div');
        const dots = document.querySelectorAll('.dot');
        let currentIndex = 0;
        const totalSlides = slides.length;

        const showSlide = (index) => {
            const carousel = document.getElementById('carousel');
            carousel.style.transform = `translateX(-${index * 100}%)`;

            dots.forEach(dot => dot.classList.remove('opacity-70'));
            dots[index].classList.add('opacity-70');
        };

        const nextSlide = () => {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
        };

        const prevSlide = () => {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            showSlide(currentIndex);
        };

        document.getElementById('nextBtn').addEventListener('click', nextSlide);
        document.getElementById('prevBtn').addEventListener('click', prevSlide);

        // Auto-slide every 4 seconds
        let autoSlide = setInterval(nextSlide, 4000);

        // Pause when hovered
        const carouselContainer = document.querySelector('.relative');
        carouselContainer.addEventListener('mouseenter', () => clearInterval(autoSlide));
        carouselContainer.addEventListener('mouseleave', () => autoSlide = setInterval(nextSlide, 4000));
    </script>
</body>
</html>
