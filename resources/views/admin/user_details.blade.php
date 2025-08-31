@extends('layouts.admin')

@section('title', 'User Details - BookStore Admin')

@section('header-left')
    <a href="/admin/users" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center hover:from-blue-700 hover:to-purple-700 transition-colors">
        <i class="fas fa-arrow-left text-white text-sm"></i>
    </a>
    <h1 class="text-2xl font-bold text-gray-800 font-['Playfair_Display']">BookStore Admin</h1>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/admin/dashboard" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600">
                        <i class="fas fa-home mr-2"></i>
                        Admin Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <a href="/admin/users" class="text-sm text-gray-600 hover:text-blue-600">Users</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-sm text-gray-500">{{ $user->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-8 text-white">
                <div class="flex items-center space-x-6">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold font-['Playfair_Display']">{{ $user->name }}</h1>
                        <p class="text-blue-100 text-lg">{{ $user->email }}</p>
                        <div class="flex items-center mt-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                <i class="fas fa-crown mr-2 {{ $user->role === 'admin' ? 'text-red-600' : 'text-green-600' }}"></i>
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 font-['Playfair_Display']">Personal Information</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Full Name</p>
                                    <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-envelope text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Email Address</p>
                                    <p class="font-semibold text-gray-800">{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-calendar text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Member Since</p>
                                    <p class="font-semibold text-gray-800">{{ $user->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 font-['Playfair_Display']">Account Statistics</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-book text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Books Borrowed</p>
                                    <p class="font-semibold text-gray-800">{{ $user->borrowedBooks->count() }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Books Returned</p>
                                    <p class="font-semibold text-gray-800">{{ $user->borrowedBooks->where('returned_at', '!=', null)->count() }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-clock text-orange-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Currently Borrowing</p>
                                    <p class="font-semibold text-gray-800">{{ $user->borrowedBooks->where('returned_at', null)->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Borrowed Books History -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800 font-['Playfair_Display']">Borrowed Books History</h3>
            </div>

            <div class="p-8">
                @if($user->borrowedBooks->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 font-semibold text-gray-800">Book Title</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-800">Author</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-800">Borrowed Date</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-800">Return Date</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-800">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->borrowedBooks as $borrowedBook)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="py-3 px-4">
                                            <div class="flex items-center">
                                                @if($borrowedBook->book->image)
                                                    <img src="{{ asset($borrowedBook->book->image) }}" alt="{{ $borrowedBook->book->title }}" class="w-10 h-12 rounded object-cover mr-3" />
                                                @else
                                                    <div class="w-10 h-12 bg-gray-200 rounded flex items-center justify-center mr-3">
                                                        <i class="fas fa-book text-gray-400 text-xs"></i>
                                                    </div>
                                                @endif
                                                <span class="font-medium text-gray-800">{{ $borrowedBook->book->title }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">{{ $borrowedBook->book->author }}</td>
                                        <td class="py-3 px-4 text-gray-600">{{ $borrowedBook->borrowed_at->format('M d, Y') }}</td>
                                        <td class="py-3 px-4 text-gray-600">{{ $borrowedBook->return_by->format('M d, Y') }}</td>
                                        <td class="py-3 px-4">
                                            @if($borrowedBook->returned_at)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    Returned
                                                </span>
                                            @elseif($borrowedBook->return_by < now())
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                                    Overdue
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Active
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-book-open text-gray-300 text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-600 mb-3">No Books Borrowed</h3>
                        <p class="text-gray-500 max-w-md mx-auto">
                            This user hasn't borrowed any books yet.
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 mt-8">
            <a href="/admin/users"
               class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-xl text-center hover:bg-gray-200 transition-colors font-semibold">
                <i class="fas fa-arrow-left mr-3"></i>
                Back to Users
            </a>

            <a href="/admin/users/{{ $user->id }}/edit"
               class="flex-1 bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 px-6 rounded-xl text-center hover:from-blue-600 hover:to-purple-700 transition-all font-semibold">
                <i class="fas fa-edit mr-3"></i>
                Edit User
            </a>
        </div>
    </div>
@endsection
