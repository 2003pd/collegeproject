{{-- resources/views/admin/categories/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Categories</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; margin: 0; padding: 0; }
        header { background: #3490dc; color: white; padding: 15px 20px; }
        a.button { background: #3490dc; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #f2f2f2; }
        form { display: inline; }
        button { background: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel - Categories</h1>
    </header>
    <main style="padding: 20px;">
        <a href="{{ route('admin.categories.create') }}" class="button">Add Category</a>

        @if(session('success'))
            <div style="margin-top:10px; color: green;">{{ session('success') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="button" style="background:#ffc107;">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button>Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">No categories found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>
</html>
