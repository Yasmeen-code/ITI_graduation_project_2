<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - BookStore</title>
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
                    <a href="/admin/dashboard" class="text-blue-600 font-semibold relative group">
                        Admin
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-blue-600 transform scale-x-100 transition-transform"></span>
                    </a>
                                    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-red-600 transition-colors font-medium">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
                </nav>
                
                <button class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-gray-600 text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12">
   
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-16">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6 font-['Playfair_Display']">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <a href="{{ route('admin.books') }}" class="bg-blue-50 rounded-xl p-6 text-center hover:bg-blue-100 transition-colors group">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book text-blue-600 text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Manage Books</h4>
                    <p class="text-gray-600 text-sm">View and manage all books</p>
                </a>
                <a href="{{ route('admin.users') }}" class="bg-green-50 rounded-xl p-6 text-center hover:bg-green-100 transition-colors group">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-green-600 text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Manage Users</h4>
                    <p class="text-gray-600 text-sm">View and manage all users</p>
                </a>
                <a href="{{ route('admin.borrowed_books') }}" class="bg-purple-50 rounded-xl p-6 text-center hover:bg-purple-100 transition-colors group">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exchange-alt text-purple-600 text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Borrowing History</h4>
                    <p class="text-gray-600 text-sm">View all borrowing activities</p>
                </a>
                <a href="{{ route('admin.profile') }}" class="bg-orange-50 rounded-xl p-6 text-center hover:bg-orange-100 transition-colors group">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-edit text-orange-600 text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Update Profile</h4>
                    <p class="text-gray-600 text-sm">Update your personal information</p>
                </a>
            </div>
        </div>
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
