<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin4',
            'email' => 'admin4@example.com',
            'password' => '123456789',
            'role' => 'admin',
        ]);

        $this->call(BookSeeder::class);
    }
}
