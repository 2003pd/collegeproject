{{-- resources/views/admin/add-product.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">

    {{-- Navbar --}}
    @include('layouts.navigation')

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Add Product</h2>

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-medium">Product Name</label>
                <input type="text" name="name" class="border p-2 w-full rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Category</label>
                <select name="category_id" class="border p-2 w-full rounded" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Description</label>
                <textarea name="description" class="border p-2 w-full rounded" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Price</label>
                <input type="number" name="price" class="border p-2 w-full rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Image</label>
                <input type="file" name="image" class="border p-2 w-full rounded" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Add Product
            </button>
        </form>
    </div>

</body>
</html>
