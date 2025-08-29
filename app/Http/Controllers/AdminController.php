<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $activeLoans = BorrowedBook::where('return_by', '>', now())->count();
        $overdueBooks = BorrowedBook::where('return_by', '<', now())->count();

        $recentActivities = BorrowedBook::with('book', 'user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($borrowedBook) {
                return (object) [
                    'description' => "{$borrowedBook->user->name} borrowed '{$borrowedBook->book->title}'",
                    'created_at' => $borrowedBook->created_at
                ];
            });

        return view('admin.dashboard', [
            'totalBooks' => $totalBooks,
            'totalUsers' => $totalUsers,
            'activeLoans' => $activeLoans,
            'overdueBooks' => $overdueBooks,
            'recentActivities' => $recentActivities
        ]);
    }

    /**
     * Display a listing of all users.
     */
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    /**
     * Display a listing of all books.
     */
    public function books()
    {
        $books = Book::all();
        return view('admin.books', compact('books'));
    }

    /**
     * Display a listing of all borrowed books.
     */
    public function borrowedBooks()
    {
        $borrowedBooks = BorrowedBook::with('book', 'user')->get();
        return view('admin.borrowed_books', compact('borrowedBooks'));
    }
}
