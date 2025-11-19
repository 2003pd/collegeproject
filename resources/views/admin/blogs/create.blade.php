<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg w-full max-w-lg p-8">
        <h1 class="text-3xl font-bold text-center mb-6 text-purple-600">📝 Add New Blog</h1>

       <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div>
        <label class="block text-sm font-semibold">Title</label>
        <input type="text" name="title" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block text-sm font-semibold">Content</label>
        <textarea name="content" rows="5" class="w-full border rounded p-2" required></textarea>
    </div>

    <div>
        <label class="block text-sm font-semibold">Upload Image</label>
        <input type="file" name="image" class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block text-sm font-semibold">YouTube Video URL</label>
        <input type="text" name="video_url" placeholder="https://www.youtube.com/watch?v=..." class="w-full border rounded p-2">
    </div>

    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
        Save Blog
    </button>
</form>

    </div>
</body>
</html>
