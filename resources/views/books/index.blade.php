@extends('layouts.books')

@section('title', 'Library Books Collection - BookStore')

@section('content')
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-6">
                <i class="fas fa-book text-3xl text-blue-600"></i>
            </div>
            <h2 class="text-5xl font-bold text-gray-800 mb-6 font-['Playfair_Display']">
                Discover Your Next <span class="text-blue-600">Adventure</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Explore our curated collection of literary treasures. From timeless classics to modern masterpieces, 
                find the perfect book to ignite your imagination.
            </p>
        </div>

        <!-- Books Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-16">
            @if($books->count() > 0)
                @foreach($books as $book)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-2">
                        <div class="h-60 bg-gradient-to-br from-blue-500 to-purple-600 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
                                    {{ $book->available_copies > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <i class="fas fa-copy mr-1 text-xs"></i>
                                    {{ $book->available_copies }} left
                                </span>
                            </div>
                            <div class="absolute bottom-4 left-4">
                                @if($book->image)
                                    <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="w-20 h-20 rounded-lg object-cover" />
                                @else
                                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                        <i class="fas fa-book text-white text-xl"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2">
                                {{ $book->title }}
                            </h3>
                            <p class="text-gray-600 mb-3 flex items-center">
                                <i class="fas fa-user-pen text-blue-400 mr-2 text-sm"></i>
                                <span class="text-sm">{{ $book->author }}</span>
                            </p>
                            
                            @if($book->description)
                                <p class="text-gray-700 text-sm mb-4 line-clamp-3 leading-relaxed">
                                    {{ Str::limit($book->description, 100) }}
                                </p>
                            @endif
                            
                            <div class="flex space-x-3">
                                <a href="{{ route('books.show', $book) }}" 
                                   class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-xl text-center hover:bg-gray-200 transition-colors font-medium text-sm">
                                    <i class="fas fa-eye mr-2"></i>Details
                                </a>
                                
                                @if($book->available_copies > 0)
                                    <form action="{{ route('books.borrow', $book) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 px-4 rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all font-medium text-sm">
                                            <i class="fas fa-book-reader mr-2"></i>Borrow
                                        </button>
                                    </form>
                                @else
                                    <button class="w-full bg-gray-300 text-gray-600 py-2 px-4 rounded-xl cursor-not-allowed font-medium text-sm">
                                        <i class="fas fa-times mr-2"></i>Unavailable
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-book-open text-gray-300 text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-600 mb-3">No Books Available</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        Our library is currently updating its collection. Please check back soon for new arrivals.
                    </p>
                </div>
            @endif
        </div>

        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-12 text-center text-white">
            <h3 class="text-3xl font-bold mb-4 font-['Playfair_Display']">Ready to Start Reading?</h3>
            <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                Join our community of readers and discover the joy of books. Borrow your first book today!
            </p>
            <a href="/books/dashboard" class="inline-flex items-center px-8 py-3 bg-white text-blue-600 rounded-xl font-semibold hover:bg-gray-100 transition-colors">
                <i class="fas fa-book-reader mr-3"></i>
                View My Bookshelf
            </a>
        </div>
@endsection
