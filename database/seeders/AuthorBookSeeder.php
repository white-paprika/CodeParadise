<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all(); 
        $books = Book::all(); 
        $books->map(function ($book) use ($authors) {
            $authorsCount = random_int(1, 3);
            $authorsForBookIds = $authors->random($authorsCount)->pluck('id');
            $book->authors()->attach($authorsForBookIds);
        });
    }
}
