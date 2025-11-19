<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 font-sans antialiased">

    <!-- 🔝 Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow mb-6">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">Products</h1>
            <a href="{{ url('/') }}" class="text-gray-700 dark:text-gray-300 hover:underline">Home</a>
        </div>
    </nav>

    <!-- 🔍 Search Bar -->
    <section class="mb-6 flex justify-center">
        <input 
            type="text" 
            id="searchBox"
            placeholder="Search products..." 
            class="w-full md:w-1/2 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
                   dark:bg-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
    </section>

    <!-- 🧩 Categories Filter -->
    <section class="flex flex-wrap gap-2 justify-center mb-6">
        @foreach($categories as $category)
            <a href="{{ url('category/'.$category->id) }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                {{ $category->name }}
            </a>
        @endforeach
    </section>

    <!-- 🛍️ Products Grid -->
    <section class="max-w-7xl mx-auto px-6 pb-16">
        <div id="productList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @include('products._list', ['products' => $products])
        </div>
    </section>

    <!-- ⚡ Live Search Script -->
    <script>
        const searchBox = document.getElementById('searchBox');
        const productList = document.getElementById('productList');

        searchBox.addEventListener('input', async () => {
            const query = searchBox.value;
            const response = await fetch(`{{ route('products.ajax.search') }}?query=${encodeURIComponent(query)}`);
            const data = await response.json();
            productList.innerHTML = data.html;
        });
    </script>

</body>
</html>
