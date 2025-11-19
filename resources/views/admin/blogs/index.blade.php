<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Blogs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen p-6">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-purple-600">All Blogs</h1>
            <a href="{{ route('admin.blogs.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-xl hover:bg-purple-700 transition">➕ Add Blog</a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-transform hover:-translate-y-2">
                    @if($blog->video_url)
                        <iframe class="w-full h-56"
                            src="{{ str_replace('watch?v=', 'embed/', $blog->video_url) }}"
                            frameborder="0" allowfullscreen></iframe>
                    @elseif($blog->image)
                        <img src="{{ asset('storage/'.$blog->image) }}" class="w-full h-56 object-cover" alt="{{ $blog->title }}">
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-purple-600 mb-2">{{ $blog->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">{{ Str::limit($blog->content, 80) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
