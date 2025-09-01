<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Book - BookStore Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen font-['Inter']">
    <header class="bg-white/90 backdrop-blur-sm border-b border-gray-200/50 sticky top-0 z-50 p-4">
        <a href="{{ route('admin.books') }}" class="text-blue-600 hover:underline"><i class="fas fa-arrow-left"></i> Back to Books</a>
    </header>

    <main class="container mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold mb-6">Edit Book: {{ $book->title }}</h1>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md max-w-lg">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" required class="w-full border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="mb-4">
                <label for="author" class="block font-semibold mb-1">Author</label>
                <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" required class="w-full border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="mb-4">
                <label for="description" class="block font-semibold mb-1">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="available_copies" class="block font-semibold mb-1">Available Copies</label>
                <input type="number" name="available_copies" id="available_copies" value="{{ old('available_copies', $book->available_copies) }}" min="0" required class="w-full border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="mb-6">
                <label for="image" class="block font-semibold mb-1">Book Cover Image</label>
                @if($book->image)
                    <div class="mb-2">
                        <p class="text-sm text-gray-600">Current Image:</p>
                        <img src="{{ asset('images/' . $book->image) }}" alt="Book Cover" class="w-32 h-32 object-cover rounded mt-2">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2" />
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition">Update Book</button>
        </form>
    </main>
</body>
</html>
