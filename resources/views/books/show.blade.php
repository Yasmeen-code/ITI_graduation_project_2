@extends('layouts.books')

@section('title', $book->title . ' - BookStore')

@section('content')
        <div class="max-w-4xl mx-auto">
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/books" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600">
                            <i class="fas fa-book mr-2"></i>
                            Books
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                            <span class="text-sm text-gray-500">{{ $book->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Book Details Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-3">
                    <div class="lg:col-span-1 bg-gradient-to-br from-blue-500 to-purple-600 p-12 flex items-center justify-center">
                        <div class="text-center">
                            @if($book->images && count($book->images) > 0)
                                <img src="{{ asset('/' . $book->images[0]) }}" alt="{{ $book->title }}" class="w-32 h-40 rounded-xl object-cover mx-auto mb-6" />
                            @else
                            @if($book->image)
                                <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="w-32 h-40 rounded-xl object-cover mx-auto mb-6" />
                            @else
                                <div class="w-32 h-40 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mx-auto mb-6">
                                    <i class="fas fa-book text-white text-5xl"></i>
                                </div>
                            @endif
                            @endif
                            <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-copy text-white text-sm mr-2"></i>
                                <span class="text-white text-sm font-semibold">{{ $book->available_copies }} available</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 p-8">
                        <h1 class="text-3xl font-bold text-gray-800 mb-4 font-['Playfair_Display']">{{ $book->title }}</h1>

                        <div class="flex items-center text-gray-600 mb-6">
                            <i class="fas fa-user-pen text-blue-500 mr-3"></i>
                            <span class="text-lg font-medium">{{ $book->author }}</span>
                        </div>

                        @if($book->description)
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Description</h3>
                                <p class="text-gray-700 leading-relaxed text-justify">
                                    {{ $book->description }}
                                </p>
                            </div>
                        @endif

                        <div class="grid grid-cols-2 gap-6 mb-8">
                            <div class="text-center p-4 bg-blue-50 rounded-xl">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-book text-blue-600"></i>
                                </div>
                                <div class="text-2xl font-bold text-blue-600">{{ $book->available_copies }}</div>
                                <div class="text-sm text-gray-600">Available Copies</div>
                            </div>

                            <div class="text-center p-4 bg-green-50 rounded-xl">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                </div>
                                <div class="text-2xl font-bold text-green-600">
                                    {{ $book->available_copies > 0 ? 'Available' : 'Out of Stock' }}
                                </div>
                                <div class="text-sm text-gray-600">Status</div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            @if($book->available_copies > 0)
                                <form action="{{ route('books.borrow', $book) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit"
                                            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 px-6 rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all font-semibold text-lg">
                                        <i class="fas fa-book-reader mr-3"></i>
                                        Borrow This Book
                                    </button>
                                </form>
                            @else
                                <button class="w-full bg-gray-300 text-gray-600 py-3 px-6 rounded-xl cursor-not-allowed font-semibold text-lg">
                                    <i class="fas fa-times mr-3"></i>
                                    Currently Unavailable
                                </button>
                            @endif

                            <a href="/books"
                               class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-xl text-center hover:bg-gray-200 transition-colors font-semibold text-lg">
                                <i class="fas fa-arrow-left mr-3"></i>
                                Back to Books
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-white rounded-2xl shadow-lg p-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 font-['Playfair_Display']">Book Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-book text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Book ID</p>
                            <p class="font-semibold text-gray-800">#{{ $book->id }}</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-copy text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Copies</p>
                            <p class="font-semibold text-gray-800">{{ $book->available_copies }} available</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
