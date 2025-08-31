
@extends('layouts.admin')

@section('title', 'Update Profile - BookStore Admin')

@section('header-left')
    <a href="/admin/dashboard" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center hover:from-blue-700 hover:to-purple-700 transition-colors">
        <i class="fas fa-arrow-left text-white text-sm"></i>
    </a>
    <h1 class="text-2xl font-bold text-gray-800 font-['Playfair_Display']">BookStore</h1>
@endsection

@section('content')
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-6">
                <i class="fas fa-user-edit text-3xl text-blue-600"></i>
            </div>
            <h2 class="text-4xl font-bold text-gray-800 mb-4 font-['Playfair_Display']">
                Update <span class="text-blue-600">Profile</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Update your personal information
            </p>
        </div>

        <!-- Profile Update Form -->
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8">
            @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <p class="text-green-800">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <div>
                        <p class="text-red-800 font-semibold">Please fix the following errors:</p>
                        <ul class="text-red-600 mt-1 list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                               required>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                               required>
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Current Role</h4>
                        <p class="text-gray-600">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                {{ auth()->user()->role }}
                            </span>
                        </p>
                        <p class="text-sm text-gray-500 mt-2">Role cannot be changed from this interface.</p>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-center space-x-4">
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition-all">
                        <i class="fas fa-save mr-2"></i>Update Profile
                    </button>
                    
                    <a href="{{ route('admin.dashboard') }}" class="px-8 py-3 bg-gray-500 text-white rounded-xl font-semibold hover:bg-gray-600 transition-all">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
@endsection
