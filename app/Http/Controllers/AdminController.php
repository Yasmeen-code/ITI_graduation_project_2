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

        // For recent activities, you can create an Activity model or use existing data
        // For now, we'll use recent borrowed books as placeholder
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
}
