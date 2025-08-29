<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Books routes
    Route::get('/books', [BooksController::class, 'index'])->name('books.index');
    Route::get('/books/dashboard', [BooksController::class, 'dashboard'])->name('dashboard');
    Route::get('/books/{book}', [BooksController::class, 'show'])->name('books.show');
    Route::post('/books/{book}/borrow', [BooksController::class, 'borrow'])->name('books.borrow');
    Route::post('/borrowed-books/{borrowedBook}/return', [BooksController::class, 'return'])->name('books.return');
});

require __DIR__ . '/auth.php';
