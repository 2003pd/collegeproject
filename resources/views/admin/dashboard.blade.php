<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">

    {{-- Navbar --}}
    @include('layouts.navigation')

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Page Header --}}
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Admin Dashboard</h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Action Buttons --}}
        <div class="flex justify-end mb-6 space-x-3">
            <a href="{{ route('admin.categories.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300">
                ➕ Add Category
            </a>

            <a href="{{ route('admin.products.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300">
                ➕ Add Product
            </a>
        </div>

        {{-- Product List --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow overflow-x-auto mb-10">
            <h3 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Products</h3>
            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr class="border md:border-none block md:table-row">
                        <th class="p-2 text-left font-bold">#</th>
                        <th class="p-2 text-left font-bold">Name</th>
                        <th class="p-2 text-left font-bold">Category</th>
                        <th class="p-2 text-left font-bold">Price</th>
                        <th class="p-2 text-left font-bold">Image</th>
                        <th class="p-2 text-left font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                    @forelse($products as $product)
                        <tr class="border md:border-none block md:table-row mb-2 md:mb-0">
                            <td class="p-2">{{ $loop->iteration }}</td>
                            <td class="p-2">{{ $product->name }}</td>
                            <td class="p-2">{{ $product->category->name ?? 'N/A' }}</td>
                            <td class="p-2">₹{{ $product->price }}</td>
                            <td class="p-2">
                                <img src="{{ asset('images/'.$product->image) }}"
                                     class="w-16 h-16 object-cover rounded"
                                     alt="{{ $product->name }}">
                            </td>
                            <td class="p-2">
                                <div class="flex flex-col md:flex-row gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-center">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded w-full md:w-auto">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="block md:table-row">
                            <td colspan="6" class="text-center text-gray-500 p-4">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Contact Messages --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow overflow-x-auto">
            <h3 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Contact Messages</h3>
            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr class="border md:border-none block md:table-row">
                        <th class="p-2 text-left font-bold">#</th>
                        <th class="p-2 text-left font-bold">Name</th>
                        <th class="p-2 text-left font-bold">Email</th>
                        <th class="p-2 text-left font-bold">Phone</th>
                        <th class="p-2 text-left font-bold">Service</th>
                        <th class="p-2 text-left font-bold">Message</th>
                        <th class="p-2 text-left font-bold">Received At</th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                    @forelse($contacts as $contact)
                        <tr class="border md:border-none block md:table-row mb-2 md:mb-0">
                            <td class="p-2">{{ $loop->iteration }}</td>
                            <td class="p-2">{{ $contact->name }}</td>
                            <td class="p-2">{{ $contact->email }}</td>
                            <td class="p-2">{{ $contact->phone ?? '-' }}</td>
                            <td class="p-2">{{ $contact->service ?? '-' }}</td>
                            <td class="p-2">{{ $contact->message }}</td>
                            <td class="p-2">{{ $contact->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr class="block md:table-row">
                            <td colspan="7" class="text-center text-gray-500 p-4">No contact messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Blog Management Section --}}
    <section class="max-w-4xl mx-auto mt-16 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 text-center">
        <h2 class="text-3xl font-bold mb-4 text-purple-600">Manage Your Blogs</h2>
        <p class="text-gray-600 dark:text-gray-300 mb-6">
            Create and manage your blog posts easily from here. You can add, edit, or delete blogs anytime.
        </p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('admin.blogs.create') }}"
               class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-all transform hover:scale-105 shadow-md">
                ➕ Add New Blog
            </a>
            <a href="{{ route('admin.blogs.index') }}"
               class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-6 py-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-all transform hover:scale-105 shadow-md">
                📚 View All Blogs
            </a>
        </div>
    </section>

    
    <section class="h-16">
        <h2 class="text-3xl font-bold mb-4 text-purple-600 text-center">Manage Your Banners</h2>
        <!-- 🏷️ Manage Banner Button -->
        <div class="mt-6">
            <a href="{{ route('admin.banner.index') }}" 
               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded shadow">
                🎉 Manage Sale Banner
            </a>
        </div>
    </section>

</div>

    </section>

</body>
</html>
