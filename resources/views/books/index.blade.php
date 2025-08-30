<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Library Books Collection</title>
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
                    <a href="/books" class="text-blue-600 font-semibold relative group">
                        Books
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-blue-600 transform scale-x-100 transition-transform"></span>
                    </a>
                    <a href="/books/dashboard" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">My Books</a>
                </nav>
                
                <button class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-gray-600 text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12">
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
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book-open text-white"></i>
                        </div>
                        <span class="text-xl font-bold font-['Playfair_Display']">BookStore</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Your gateway to a world of knowledge and imagination. Discover, borrow, and enjoy.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="/books" class="hover:text-white transition-colors">All Books</a></li>
                        <li><a href="/books/dashboard" class="hover:text-white transition-colors">My Books</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-blue-400"></i>
                            <span>YasmeenHana@BookStore.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-blue-400"></i>
                            <span>+20 010 028 135</span>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-purple-600 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-400 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2025 BookStore Library Management System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
    </style>
</body>
</html>
