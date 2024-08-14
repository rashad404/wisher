<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 10), // Adjust range according to your products
            'color_id' => $this->faker->numberBetween(1, 10), // Adjust range according to your colors
            'size_id' => $this->faker->numberBetween(1, 10), // Adjust range according to your sizes
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
