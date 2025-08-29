<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Bookshelf - BookStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen font-['Inter']">
    <!-- Header -->
    <header class="bg-white/90 backdrop-blur-sm border-b border-gray-200/50 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-book-open text-white text-lg"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800 font-['Playfair_Display']">BookStore</h1>
                </div>
                
                <nav class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Home</a>
                    <a href="/books" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Books</a>
                    <a href="/books/dashboard" class="text-blue-600 font-semibold relative group">
                        My Books
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-blue-600 transform scale-x-100 transition-transform"></span>
                    </a>
                </nav>
                
                <button class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-gray-600 text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12">
        <!-- Hero Section -->
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

        <!-- Stats Cards -->
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
                                <!-- Book Cover -->
                                <div class="mb-6 text-center">
                                    @if($borrowedBook->book->image)
                                        <img src="{{ asset($borrowedBook->book->image) }}" alt="{{ $borrowedBook->book->title }}" class="w-32 h-40 rounded-xl object-cover mx-auto shadow-lg" />
                                    @else
                                        <div class="w-32 h-40 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto shadow-lg">
                                            <i class="fas fa-book text-white text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Book Details -->
                                <div class="mb-6">
                                    <h4 class="text-xl font-semibold text-gray-800 mb-2 font-['Playfair_Display']">
                                        {{ $borrowedBook->book->title }}
                                    </h4>
                                    <p class="text-gray-600 mb-3 flex items-center">
                                        <i class="fas fa-user-pen text-blue-400 mr-2 text-sm"></i>
                                        <span class="text-sm">{{ $borrowedBook->book->author }}</span>
                                    </p>
                                </div>
                                
                                <!-- Borrowing Info -->
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
                                
                                <!-- Action Button -->
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
    </main>
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2025 BookStore Library Management System. All rights reserved.</p>
        </div>
    </footer>

