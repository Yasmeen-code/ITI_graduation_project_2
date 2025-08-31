<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'BookStore Admin')</title>
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
                    @yield('header-left', '<h1 class="text-2xl font-bold text-gray-800 font-[\'Playfair_Display\']">BookStore</h1>')
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
        @yield('content')
    </main>


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
