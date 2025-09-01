<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'return_by',
        'returned_at',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'return_by' => 'datetime',
        'returned_at' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
