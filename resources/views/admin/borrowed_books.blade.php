<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>All Borrowed Books - BookStore Admin</title>
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
                    <a href="/admin/dashboard" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center hover:from-blue-700 hover:to-purple-700 transition-colors">
                        <i class="fas fa-arrow-left text-white text-sm"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800 font-['Playfair_Display']">BookStore</h1>
                </div>
                
                <nav class="hidden md:flex space-x-8">
                    <a href="/admin/dashboard" class="text-blue-600 font-semibold relative group">
                        Admin
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-blue-600 transform scale-x-100 transition-transform"></span>
                    </a>
                </nav>
                
                <button class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-gray-600 text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-6">
                <i class="fas fa-exchange-alt text-3xl text-purple-600"></i>
            </div>
            <h2 class="text-4xl font-bold text-gray-800 mb-4 font-['Playfair_Display']">
                All <span class="text-purple-600">Borrowed Books</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                View all borrowing activities in your library system
            </p>
        </div>

        <!-- Borrowed Books Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Book</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">User</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Borrowed At</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Return By</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($borrowedBooks as $borrowedBook)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700">{{ $borrowedBook->id }}</td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $borrowedBook->book->title }}</td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-600">{{ $borrowedBook->user->name }}</td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">{{ $borrowedBook->created_at->format('M d, Y') }}</td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">{{ $borrowedBook->return_by->format('M d, Y') }}</td>
                            <td class="px-8 py-4 whitespace-nowrap">
                                @if($borrowedBook->return_by->isPast())
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        Overdue
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @endif
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
