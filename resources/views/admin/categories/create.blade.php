{{-- resources/views/admin/categories/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Add Category</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; margin:0; padding:0; }
        header { background:#3490dc; color:white; padding:15px 20px; }
        input, button { padding:8px; width:100%; margin:5px 0; border-radius:4px; border:1px solid #ccc; }
        button { background:#3490dc; color:white; border:none; cursor:pointer; }
        .container { max-width:600px; margin:20px auto; background:white; padding:20px; border-radius:5px; }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel - Add Category</h1>
    </header>
    <main>
        <div class="container">
            @if($errors->any())
                <div style="color:red;">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}">
                <label>Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}">
                <button type="submit">Add Category</button>
            </form>
        </div>
    </main>
</body>
</html>
