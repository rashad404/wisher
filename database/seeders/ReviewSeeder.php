<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed some specific products with reviews
        Product::all()->each(function ($product) {
            Review::factory()->count(5)->create([
                'product_id' => $product->id,
                'user_id' => 1, // Assuming a user with ID 1 exists
            ]);
        });
    }
}
