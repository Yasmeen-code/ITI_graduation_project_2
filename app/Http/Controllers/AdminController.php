<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalBooks'      => Book::count(),
            'totalUsers'      => User::count(),
            'activeLoans'     => BorrowedBook::where('return_by', '>', now())->count(),
            'overdueBooks'    => BorrowedBook::where('return_by', '<', now())->count(),
            'recentActivities' => BorrowedBook::with('book', 'user')
                ->latest()
                ->take(5)
                ->get()
                ->map(fn($b) => (object)[
                    'description' => "{$b->user->name} borrowed '{$b->book->title}'",
                    'created_at'  => $b->created_at
                ])
        ]);
    }

    public function users(Request $request)
    {
        $users = User::when($request->search, fn($q, $s) => $q->where('id', $s))->get();
        return view('admin.users', ['users' => $users, 'search' => $request->search]);
    }

    public function books()
    {
        return view('admin.books', ['books' => Book::all()]);
    }

    public function borrowedBooks()
    {
        return view('admin.borrowed_books', ['borrowedBooks' => BorrowedBook::with('book', 'user')->get()]);
    }

    public function createBook()
    {
        return view('admin.books_create');
    }

    public function storeBook(Request $request)
    {
        $data = $this->validateBook($request);
        if ($request->hasFile('image')) {
            $data['image'] = $this->handleImageUpload($request->file('image'));
        }
        Book::create($data);

        return redirect()->route('admin.books')->with('success', 'Book created successfully!');
    }

    public function editBook(Book $book)
    {
        return view('admin.books_edit', compact('book'));
    }

    public function updateBook(Request $request, Book $book)
    {
        $data = $this->validateBook($request);
        if ($request->hasFile('image')) {
            $data['image'] = $this->handleImageUpload($request->file('image'), $book->image);
        }
        $book->update($data);

        return redirect()->route('admin.books')->with('success', 'Book updated successfully!');
    }

    public function destroyBook(Book $book)
    {
        if ($book->image) {
            $this->deleteImage($book->image);
        }
        $book->delete();

        return redirect()->route('admin.books')->with('success', 'Book deleted successfully!');
    }

    public function userDetails(User $user)
    {
        $user->load('borrowedBooks.book');
        return view('admin.user_details', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($user->role === 'admin' && $request->id && $request->id != $user->id) {
            return back()->withErrors(['error' => 'You cannot update other admin profiles.']);
        }

        $user->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully!');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    private function validateBook(Request $request)
    {
        return $request->validate([
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'description'      => 'nullable|string',
            'available_copies' => 'required|integer|min:0',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    }

    private function handleImageUpload($image, $oldImage = null)
    {
        if ($oldImage) $this->deleteImage($oldImage);

        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        return $imageName;
    }

    private function deleteImage($image)
    {
        $path = public_path('images/' . $image);
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
