<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        $this->call([
            CountrySeeder::class,
            GenreSeeder::class,
            AuthorSeeder::class,
            BookSeeder::class,
            AuthorBookSeeder::class,
            UserSeeder::class,
            CommentSeeder::class,
            CartItemSeeder::class, // Creates cart and attaches 1 book in cart_items | no factory
            SaleSeeder::class,
        ]);      
    }
}

