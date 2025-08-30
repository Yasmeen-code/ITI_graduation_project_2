<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Details - BookStore Admin</title>
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
                    <a href="{{ route('admin.users') }}" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center hover:from-blue-700 hover:to-purple-700 transition-colors">
                        <i class="fas fa-arrow-left text-white text-sm"></i>
                    </a>
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
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-6">
                <i class="fas fa-user text-3xl text-blue-600"></i>
            </div>
            <h2 class="text-4xl font-bold text-gray-800 mb-4 font-['Playfair_Display']">
                User <span class="text-blue-600">Details</span>
            </h2>
        </div>

        <!-- User Information -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6 font-['Playfair_Display']">User Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">User ID</label>
                    <p class="text-lg text-gray-800">{{ $user->id }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Full Name</label>
                    <p class="text-lg text-gray-800">{{ $user->name }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Email Address</label>
                    <p class="text-lg text-gray-800">{{ $user->email }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Role</label>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                        {{ $user->role }}
                    </span>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Account Created</label>
                    <p class="text-lg text-gray-800">{{ $user->created_at->format('M d, Y') }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Last Updated</label>
                    <p class="text-lg text-gray-800">{{ $user->updated_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Borrowed Books -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6 font-['Playfair_Display']">Borrowed Books</h3>
            
            @if($user->borrowedBooks->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Book Title</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Borrowed Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Return By</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($user->borrowedBooks as $borrowedBook)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $borrowedBook->book->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $borrowedBook->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $borrowedBook->return_by->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-book text-gray-300 text-4xl mb-4"></i>
                <p class="text-gray-600">This user hasn't borrowed any books yet.</p>
            </div>
            @endif
        </div>

        <div class="flex justify-center space-x-4">
            <a href="{{ route('admin.users') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition-all">
                <i class="fas fa-arrow-left mr-3"></i>
                Back to Users
            </a>
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
