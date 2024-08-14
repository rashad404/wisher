<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'main_image' => $this->faker->imageUrl(640, 480, 'products', true, 'Product'),
            'extra_images' => json_encode([
                $this->faker->imageUrl(640, 480, 'products', true, 'Extra1'),
                $this->faker->imageUrl(640, 480, 'products', true, 'Extra2'),
            ]),
            'condition' => $this->faker->randomElement(['New', 'Used']),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'discounted_price' => $this->faker->optional()->randomFloat(2, 5, 500),
            'sku' => $this->faker->unique()->bothify('???-###'),
            'category_id' => $this->faker->numberBetween(1, 10), // Adjust range according to your categories
            'brand_id' => $this->faker->numberBetween(1, 10), // Adjust range according to your brands
            'product_model_id' => $this->faker->numberBetween(1, 10), // Adjust range according to your product models
            'features' => json_encode([
                $this->faker->word(),
                $this->faker->word(),
                $this->faker->word(),
            ]),
        ];
    }
}
