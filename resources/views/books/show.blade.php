<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $book->title }} - BookStore</title>
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
                    <a href="/books" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center hover:from-blue-700 hover:to-purple-700 transition-colors">
                        <i class="fas fa-arrow-left text-white text-sm"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800 font-['Playfair_Display']">BookStore</h1>
                </div>
                
                <nav class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Home</a>
                    <a href="/books" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Books</a>
                    <a href="/books/dashboard" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">My Books</a>
                </nav>
                
                <button class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-gray-600 text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
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
                    <!-- Book Cover -->
                    <div class="lg:col-span-1 bg-gradient-to-br from-blue-500 to-purple-600 p-12 flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-32 h-40 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-book text-white text-5xl"></i>
                            </div>
                            <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-copy text-white text-sm mr-2"></i>
                                <span class="text-white text-sm font-semibold">{{ $book->available_copies }} available</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Book Information -->
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
                        
                        <!-- Book Stats -->
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
                        
                        <!-- Action Buttons -->
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

            <!-- Additional Information -->
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
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2025 BookStore Library Management System. All rights reserved.</p>
        </div>
    </footer>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
    </style>
</body>
</html>
