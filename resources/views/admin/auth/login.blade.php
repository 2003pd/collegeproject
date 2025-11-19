<x-app-layout>
    <div class="flex justify-center items-center h-screen">
        <form method="POST" action="{{ route('admin.login.submit') }}" class="bg-white p-6 rounded shadow w-96">
            @csrf
            <h2 class="text-2xl font-bold mb-4 text-center">Admin Login</h2>

            <div class="mb-4">
                <input type="email" name="email" placeholder="Email" class="border p-2 w-full" required>
            </div>

            <div class="mb-4">
                <input type="password" name="password" placeholder="Password" class="border p-2 w-full" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full hover:bg-blue-700">Login</button>
        </form>
    </div>
</x-app-layout>
