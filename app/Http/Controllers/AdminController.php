<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
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

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function books()
    {
        $books = Book::all();
        return view('admin.books', compact('books'));
    }

    public function borrowedBooks()
    {
        $borrowedBooks = BorrowedBook::with('book', 'user')->get();
        return view('admin.borrowed_books', compact('borrowedBooks'));
    }

    public function createBook()
    {
        return view('admin.books_create');
    }

    public function storeBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'available_copies' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        Book::create($data);

        return redirect()->route('admin.books')
            ->with('success', 'Book created successfully!');
    }

    public function editBook($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books_edit', compact('book'));
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'available_copies' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($book->image && file_exists(public_path('images/' . $book->image))) {
                unlink(public_path('images/' . $book->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $book->update($data);

        return redirect()->route('admin.books')
            ->with('success', 'Book updated successfully!');
    }

    public function destroyBook($id)
    {
        $book = Book::findOrFail($id);
        
        // Delete associated image if exists
        if ($book->image && file_exists(public_path('images/' . $book->image))) {
            unlink(public_path('images/' . $book->image));
        }
        
        $book->delete();

        return redirect()->route('admin.books')
            ->with('success', 'Book deleted successfully!');
    }
}
