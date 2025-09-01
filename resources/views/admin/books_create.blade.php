@extends('layouts.admin')

@section('title', 'Add New Book - BookStore Admin')

@section('header-left')
    <a href="{{ route('admin.books') }}" class="text-blue-600 hover:underline"><i class="fas fa-arrow-left"></i> Back to Books</a>
@endsection

@section('content')
    <h1 class="text-3xl font-bold mb-6">Add New Book</h1>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md max-w-lg">
        @csrf
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>

        <div class="mb-4">
            <label for="author" class="block font-semibold mb-1">Author</label>
            <input type="text" name="author" id="author" value="{{ old('author') }}" required class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="available_copies" class="block font-semibold mb-1">Available Copies</label>
            <input type="number" name="available_copies" id="available_copies" value="{{ old('available_copies', 1) }}" min="0" required class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>

        <div class="mb-6">
            <label for="image" class="block font-semibold mb-1">Book Cover Image</label>
            <input type="file" name="image" id="image" accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition">Add Book</button>
    </form>
@endsection
