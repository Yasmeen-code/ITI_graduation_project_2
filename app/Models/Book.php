<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'available_copies',
    ];

    /**
     * Get the borrowed books for this book.
     */
    public function borrowedBooks()
    {
        return $this->hasMany(BorrowedBook::class);
    }
}
