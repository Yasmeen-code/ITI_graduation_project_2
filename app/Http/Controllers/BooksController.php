<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowedBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function borrow(Book $book)
    {
        if ($book->available_copies <= 0) {
            return redirect()->back()->with('error', 'This book is not available for borrowing.');
        }

        $existingBorrow = BorrowedBook::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->first();

        if ($existingBorrow) {
            return redirect()->back()->with('error', 'You have already borrowed this book.');
        }

        BorrowedBook::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'return_by' => now()->addDays(14),
        ]);

        $book->decrement('available_copies');

        return redirect()->back()->with('success', 'Book borrowed successfully!');
    }

    public function return(BorrowedBook $borrowedBook)
    {
        if ($borrowedBook->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to return this book.');
        }

        if ($borrowedBook->returned_at) {
            return redirect()->back()->with('error', 'This book has already been returned.');
        }
        $borrowedBook->update([
            'returned_at' => now(),
        ]);

        $borrowedBook->book->increment('available_copies');

        return redirect()->back()->with('success', 'Book returned successfully!');
    }
    public function dashboard()
    {
        $user = Auth::user();
        $borrowedBooks = BorrowedBook::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->with('book')
            ->get();

        return view('books.dashboard', compact('user', 'borrowedBooks'));
    }
}
