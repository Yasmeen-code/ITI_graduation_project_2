@extends('layouts.books')

@section('title', 'My Bookshelf - BookStore')

@section('content')
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-6">
                <i class="fas fa-book-reader text-3xl text-blue-600"></i>
            </div>
            <h2 class="text-5xl font-bold text-gray-800 mb-6 font-['Playfair_Display']">
                My <span class="text-blue-600">Bookshelf</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Manage your borrowed books, track return dates, and explore your reading journey.
            </p>
        </div>

        <center>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-book text-blue-600 text-2xl"></i>
                </div>
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ $borrowedBooks->count() }}</div>
                <div class="text-gray-600 font-medium">Books Borrowed</div>
            </div>
        </div>
</center>
        <!-- Books Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            
            <div class="px-8 py-6 border-b border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800 font-['Playfair_Display']">My Borrowed Books</h3>
            </div>
            
            @if(session('success'))
                <div class="mx-8 mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="mx-8 mt-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="p-8">
                @if($borrowedBooks->count() > 0)
                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                        @foreach($borrowedBooks as $borrowedBook)
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                                <div class="mb-6 text-center">
                                    @if($borrowedBook->book->image)
                                        <img src="{{ asset($borrowedBook->book->image) }}" alt="{{ $borrowedBook->book->title }}" class="w-32 h-40 rounded-xl object-cover mx-auto shadow-lg" />
                                    @else
                                        <div class="w-32 h-40 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto shadow-lg">
                                            <i class="fas fa-book text-white text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="mb-6">
                                    <h4 class="text-xl font-semibold text-gray-800 mb-2 font-['Playfair_Display']">
                                        {{ $borrowedBook->book->title }}
                                    </h4>
                                    <p class="text-gray-600 mb-3 flex items-center">
                                        <i class="fas fa-user-pen text-blue-400 mr-2 text-sm"></i>
                                        <span class="text-sm">{{ $borrowedBook->book->author }}</span>
                                    </p>
                                </div>
                                
                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600 font-medium">Borrowed:</span>
                                        <span class="text-sm text-gray-800">{{ $borrowedBook->borrowed_at->format('M d, Y') }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600 font-medium">Return by:</span>
                                        <span class="text-sm font-semibold {{ $borrowedBook->return_by < now() ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $borrowedBook->return_by->format('M d, Y') }}
                                            @if($borrowedBook->return_by < now())
                                                <i class="fas fa-exclamation-triangle ml-1"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                
                                <form action="{{ route('books.return', $borrowedBook) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 px-6 rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all font-semibold text-sm">
                                        <i class="fas fa-undo-alt mr-2"></i>
                                        Return Book
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-book-open text-gray-300 text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-600 mb-3">No Books Borrowed</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-8">
                            You haven't borrowed any books yet. Explore our collection to find your next read!
                        </p>
                        <a href="/books" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition-all">
                            <i class="fas fa-book mr-3"></i>
                            Browse Books
                        </a>
                    </div>
                @endif
            </div>
        </div>
@endsection


