<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(), // Create a product and use its ID
            'user_id' => User::factory(),       // Create a user and use its ID
            'review' => $this->faker->paragraph(), // Generate a fake review content
            'rating' => $this->faker->numberBetween(1, 5), // Generate a random rating between 1 and 5
        ];
    }
}
