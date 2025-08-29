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
        ]);

        Book::create([
            'title' => '1984',
            'author' => 'George Orwell',
            'description' => 'A dystopian novel about totalitarianism and surveillance.',
            'available_copies' => 5,
        ]);

        Book::create([
            'title' => 'To Kill a Mockingbird',
            'author' => 'Harper Lee',
            'description' => 'A novel about racial injustice in the Deep South.',
            'available_copies' => 2,
        ]);
    }
}
