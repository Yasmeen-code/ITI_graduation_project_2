<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('books.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Books routes
    Route::get('/books', [BooksController::class, 'index'])->name('books.index');
    Route::get('/books/dashboard', [BooksController::class, 'dashboard'])->name('books.dashboard');
    Route::get('/books/{book}', [BooksController::class, 'show'])->name('books.show');
    Route::post('/books/{book}/borrow', [BooksController::class, 'borrow'])->name('books.borrow');
    Route::post('/borrowed-books/{borrowedBook}/return', [BooksController::class, 'return'])->name('books.return');

    // Admin routes
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users')->middleware('admin');
    Route::get('/admin/books', [AdminController::class, 'books'])->name('admin.books')->middleware('admin');
    Route::get('/admin/borrowed-books', [AdminController::class, 'borrowedBooks'])->name('admin.borrowed_books')->middleware('admin');

    // Admin Book CRUD routes
    Route::get('/admin/books/create', [AdminController::class, 'createBook'])->name('admin.books.create')->middleware('admin');
    Route::post('/admin/books/store', [AdminController::class, 'storeBook'])->name('admin.books.store')->middleware('admin');
    Route::get('/admin/books/{id}/edit', [AdminController::class, 'editBook'])->name('admin.books.edit')->middleware('admin');
    Route::put('/admin/books/{id}/update', [AdminController::class, 'updateBook'])->name('admin.books.update')->middleware('admin');
    Route::delete('/admin/books/{id}/destroy', [AdminController::class, 'destroyBook'])->name('admin.books.destroy')->middleware('admin');

    // Admin User routes
    Route::get('/admin/users/{id}/details', [AdminController::class, 'userDetails'])->name('admin.user.details')->middleware('admin');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile')->middleware('admin');
    Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update')->middleware('admin');
});

require __DIR__ . '/auth.php';
