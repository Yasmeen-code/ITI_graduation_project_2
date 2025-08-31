@extends('layouts.admin')

@section('title', 'All Books - BookStore Admin')

@section('header-left')
    <a href="/admin/dashboard" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center hover:from-blue-700 hover:to-purple-700 transition-colors">
        <i class="fas fa-arrow-left text-white text-sm"></i>
    </a>
    <h1 class="text-2xl font-bold text-gray-800 font-['Playfair_Display']">BookStore</h1>
@endsection

@section('content')
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-6">
                <i class="fas fa-book text-3xl text-blue-600"></i>
            </div>
            <h2 class="text-4xl font-bold text-gray-800 mb-4 font-['Playfair_Display']">
                All <span class="text-blue-600">Books</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Manage all books in your library collection
            </p>
            <div class="mt-6">
                <a href="{{ route('admin.books.create') }}" class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-all">
                    <i class="fas fa-plus mr-3"></i>
                    Add New Book
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Books Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Author</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Available Copies</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Created At</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($books as $book)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700">{{ $book->id }}</td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $book->title }}</td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-600">{{ $book->author }}</td>
                            <td class="px-8 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $book->available_copies > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $book->available_copies }} available
                                </span>
                            </td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">{{ $book->created_at->format('M d, Y') }}</td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.books.edit', $book->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition-all">
                <i class="fas fa-arrow-left mr-3"></i>
                Back to Dashboard
            </a>
        </div>
@endsection
