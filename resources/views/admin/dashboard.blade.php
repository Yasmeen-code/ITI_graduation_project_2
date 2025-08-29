<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <main class="py-12 bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 font-['Playfair_Display']">Admin Dashboard</h1>
                <p class="mt-2 text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Manage your library system, books, users, and borrowing activities.
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 text-center">
                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book text-blue-600 dark:text-blue-400 text-2xl"></i>
                    </div>
                    <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">{{ $totalBooks }}</div>
                    <div class="text-gray-600 dark:text-gray-300 font-medium">Total Books</div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 text-center">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-green-600 dark:text-green-400 text-2xl"></i>
                    </div>
                    <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-2">{{ $totalUsers }}</div>
                    <div class="text-gray-600 dark:text-gray-300 font-medium">Total Users</div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 text-center">
                    <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book-reader text-purple-600 dark:text-purple-400 text-2xl"></i>
                    </div>
                    <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-2">{{ $activeLoans }}</div>
                    <div class="text-gray-600 dark:text-gray-300 font-medium">Active Loans</div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 text-center">
                    <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-orange-600 dark:text-orange-400 text-2xl"></i>
                    </div>
                    <div class="text-3xl font-bold text-orange-600 dark:text-orange-400 mb-2">{{ $overdueBooks }}</div>
                    <div class="text-gray-600 dark:text-gray-300 font-medium">Overdue Books</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <a href="/books" class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book text-blue-600 dark:text-blue-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">Manage Books</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Add, edit, and manage library books</p>
                </a>

                <a href="/users" class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-green-600 dark:text-green-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">Manage Users</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">View and manage user accounts</p>
                </a>

                <a href="/borrowed-books" class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exchange-alt text-purple-600 dark:text-purple-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">Borrowing Records</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Track all borrowing activities</p>
                </a>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 font-['Playfair_Display']">Recent Activity</h3>
                </div>
                <div class="p-8">
                    <div class="space-y-4">
                        @if($recentActivities->count() > 0)
                            @foreach($recentActivities as $activity)
                                <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <i class="fas fa-book text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-800 dark:text-gray-100 font-medium">{{ $activity->description }}</p>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $activity->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-600 dark:text-gray-300 text-center py-8">No recent activity</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
