@extends('layouts.admin')

@section('title', 'Admin Dashboard - BookStore')

@section('header-left')
    <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
        <i class="fas fa-book-open text-white text-lg"></i>
    </div>
    <h1 class="text-2xl font-bold text-gray-800 font-['Playfair_Display']">BookStore</h1>
@endsection

@section('content')
   
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
@endsection
