<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>All Users - BookStore Admin</title>
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
                <i class="fas fa-users text-3xl text-blue-600"></i>
            </div>
            <h2 class="text-4xl font-bold text-gray-800 mb-4 font-['Playfair_Display']">
                All <span class="text-blue-600">Users</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Manage all registered users in your library system
            </p>
        </div>

        <!-- Search Form -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 font-['Playfair_Display']">Search Users</h3>
            <form method="GET" action="{{ route('admin.users') }}" class="flex gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ $search }}" 
                           placeholder="Enter User ID to search..." 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition-all">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
                @if($search)
                <a href="{{ route('admin.users') }}" class="px-6 py-3 bg-gray-500 text-white rounded-xl font-semibold hover:bg-gray-600 transition-all">
                    <i class="fas fa-times mr-2"></i>Clear
                </a>
                @endif
            </form>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Created At</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->id }}</td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $user->name }}</td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-8 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-8 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.user.details', $user->id) }}" 
                                   class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-lg text-xs font-semibold hover:bg-blue-600 transition-colors">
                                    <i class="fas fa-eye mr-1"></i>View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if($users->isEmpty() && $search)
        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 mt-8 text-center">
            <i class="fas fa-exclamation-triangle text-yellow-500 text-3xl mb-4"></i>
            <h3 class="text-lg font-semibold text-yellow-800 mb-2">No users found</h3>
            <p class="text-yellow-600">No users match the ID: {{ $search }}</p>
        </div>
        @endif

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
