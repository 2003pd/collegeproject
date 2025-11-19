<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sale Banner</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Page Header -->
    <header class="bg-white shadow p-4">
        <h2 class="text-xl font-semibold text-gray-800">Manage Sale Banner</h2>
    </header>

    <!-- Main Container -->
    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">

        <!-- ✅ Laravel Flash Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- ⚠️ Error Message -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 🧾 Banner Form -->
        <form action="{{ route('admin.banner.update') }}" method="POST">
            @csrf

            <!-- Banner Message -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-800 mb-1">Banner Message</label>
                <input 
                    type="text" 
                    name="message" 
                    id="message" 
                    value="{{ old('message', $banner->message ?? '') }}"
                    class="w-full border rounded p-2" 
                    placeholder="🎉 Big Diwali Sale! Get 25% OFF on all electronics till 15th Nov!"
                    required
                >
            </div>

            <!-- Background Color -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-800 mb-1">Background Color (Tailwind class)</label>
                <input 
                    type="text" 
                    name="background_color" 
                    id="background_color" 
                    value="{{ old('background_color', $banner->background_color ?? 'bg-yellow-100') }}"
                    class="w-full border rounded p-2"
                >
                <small class="text-gray-500 text-sm">Example: bg-red-100, bg-green-200, bg-yellow-50</small>
            </div>

            <!-- Show Banner Checkbox -->
            <div class="mb-4 flex items-center">
                <input 
                    type="checkbox" 
                    name="is_active" 
                    id="is_active"
                    class="w-4 h-4"
                    {{ old('is_active', $banner->is_active ?? false) ? 'checked' : '' }}
                >
                <label for="is_active" class="ml-2 font-semibold text-gray-800">Show Banner</label>
            </div>

            <!-- Save Button -->
            <button 
                type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition"
            >
                Save
            </button>
        </form>
    </div>

</body>
</html>
