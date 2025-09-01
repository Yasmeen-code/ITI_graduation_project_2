@extends('layouts.admin')

@section('title', 'All Borrowed Books - BookStore Admin')

@section('header-left')
    <a href="/admin/dashboard" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center hover:from-blue-700 hover:to-purple-700 transition-colors">
        <i class="fas fa-arrow-left text-white text-sm"></i>
    </a>
    <h1 class="text-2xl font-bold text-gray-800 font-['Playfair_Display']">BookStore</h1>
@endsection

@section('content')
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
@endsection
