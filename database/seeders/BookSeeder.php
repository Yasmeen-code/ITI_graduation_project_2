<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'description' => 'A novel set in the Roaring Twenties, exploring themes of wealth, love, and the American Dream.',
            'available_copies' => 3,
            'image' => 'images/1.png',
        ]);
        Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'description' => 'A novel set in the Roaring Twenties, exploring themes of wealth, love, and the American Dream.',
            'available_copies' => 3,
            'image' => 'images/1.png',
        ]);
        Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'description' => 'A novel set in the Roaring Twenties, exploring themes of wealth, love, and the American Dream.',
            'available_copies' => 3,
            'image' => 'images/1.png',
        ]);
        Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'description' => 'A novel set in the Roaring Twenties, exploring themes of wealth, love, and the American Dream.',
            'available_copies' => 3,
            'image' => 'images/1.png',
        ]);
        Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'description' => 'A novel set in the Roaring Twenties, exploring themes of wealth, love, and the American Dream.',
            'available_copies' => 3,
            'image' => 'images/1.png',
        ]);
        Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'description' => 'A novel set in the Roaring Twenties, exploring themes of wealth, love, and the American Dream.',
            'available_copies' => 3,
            'image' => 'images/1.png',
        ]);
    }
}
