<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->sentence(4),
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 750, 7800),
            'path' => "images/book/default.jpg",
            'items_in_stock' => $this->faker->numberBetween(0, 100),
            'release_year' => $this->faker->year,
            'translator' => $this->faker->optional()->name,
            'genre_id' => Genre::inRandomOrder()->pluck('id')->first(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            // 'deleted_at' => null,
        ];
    }
}
