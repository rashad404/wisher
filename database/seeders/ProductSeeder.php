<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::firstOrCreate([
            'sku' => 'LAP123'
        ], [
            'name' => 'Laptop',
            'description' => 'A high-performance laptop for professionals.',
            'main_image' => '/products/laptop.jpg',
            'extra_images' => json_encode(['laptop.jpg', 'sofa.jpg']),
            'condition' => 'New',
            'price' => 999.99,
            'discounted_price' => 899.99,
            'category_id' => 1,
            'brand_id' => 1,
            'product_model_id' => 1,
            'features' => json_encode(['16GB RAM', '512GB SSD', 'Intel i7'])
        ]);

        Product::firstOrCreate([
            'sku' => 'SOF456'
        ], [
            'name' => 'Sofa',
            'description' => 'Comfortable leather sofa for your living room.',
            'main_image' => '/products/sofa.jpg',
            'extra_images' => json_encode(['sofa.jpg', 'laptop.jpg']),
            'condition' => 'New',
            'price' => 499.99,
            'discounted_price' => 449.99,
            'category_id' => 2,
            'brand_id' => 2,
            'product_model_id' => 2,
            'features' => json_encode(['Leather', '3-seater', 'Reclining'])
        ]);

        Product::firstOrCreate([
            'sku' => 'NOV789'
        ], [
            'name' => 'Novel',
            'description' => 'A gripping novel by a renowned author.',
            'main_image' => '/products/sofa.jpg',
            'extra_images' => json_encode(['laptop.jpg']),
            'condition' => 'New',
            'price' => 14.99,
            'discounted_price' => 12.99,
            'category_id' => 3,
            'brand_id' => 3,
            'product_model_id' => 3,
            'features' => json_encode(['Paperback', '300 pages'])
        ]);

        Product::firstOrCreate([
            'sku' => 'TSH101'
        ], [
            'name' => 'T-Shirt',
            'description' => 'A stylish t-shirt for casual wear.',
            'main_image' => '/products/sofa.jpg',
            'extra_images' => json_encode(['sofa.jpg']),
            'condition' => 'New',
            'price' => 19.99,
            'discounted_price' => 17.99,
            'category_id' => 4,
            'brand_id' => 4,
            'product_model_id' => 4,
            'features' => json_encode(['Cotton', 'Various colors'])
        ]);

        Product::firstOrCreate([
            'sku' => 'ACT202'
        ], [
            'name' => 'Action Figure',
            'description' => 'Detailed action figure from a popular series.',
            'main_image' => '/products/laptop.jpg',
            'extra_images' => json_encode(['laptop.jpg']),
            'condition' => 'New',
            'price' => 29.99,
            'discounted_price' => 24.99,
            'category_id' => 5,
            'brand_id' => 5,
            'product_model_id' => 5,
            'features' => json_encode(['Articulated', 'Collectible'])
        ]);

        Product::firstOrCreate([
            'sku' => 'FB123'
        ], [
            'name' => 'Football',
            'description' => 'High-quality football for recreational use.',
            'main_image' => '/products/sofa.jpg',
            'extra_images' => json_encode(['sofa.jpg']),
            'condition' => 'New',
            'price' => 24.99,
            'discounted_price' => 19.99,
            'category_id' => 6,
            'brand_id' => 6,
            'product_model_id' => 6,
            'features' => json_encode(['Size 5', 'Durable'])
        ]);

        Product::firstOrCreate([
            'sku' => 'BAT456'
        ], [
            'name' => 'Car Battery',
            'description' => 'Reliable car battery with long-lasting performance.',
            'main_image' => '/products/sofa.jpg',
            'extra_images' => json_encode(['laptop.jpg']),
            'condition' => 'New',
            'price' => 89.99,
            'discounted_price' => 79.99,
            'category_id' => 7,
            'brand_id' => 7,
            'product_model_id' => 7,
            'features' => json_encode(['12V', 'Maintenance-free'])
        ]);

        Product::firstOrCreate([
            'sku' => 'SHA789'
        ], [
            'name' => 'Shampoo',
            'description' => 'Nourishing shampoo for healthy hair.',
            'main_image' => '/products/laptop.jpg',
            'extra_images' => json_encode(['sofa.jpg']),
            'condition' => 'New',
            'price' => 5.99,
            'discounted_price' => 4.99,
            'category_id' => 8,
            'brand_id' => 8,
            'product_model_id' => 8,
            'features' => json_encode(['500ml', 'Sulfate-free'])
        ]);

        Product::firstOrCreate([
            'sku' => 'BLD123'
        ], [
            'name' => 'Blender',
            'description' => 'Powerful blender for making smoothies and more.',
            'main_image' => '/products/sofa.jpg',
            'extra_images' => json_encode(['laptop.jpg']),
            'condition' => 'New',
            'price' => 59.99,
            'discounted_price' => 49.99,
            'category_id' => 9,
            'brand_id' => 9,
            'product_model_id' => 9,
            'features' => json_encode(['600W', 'Multiple speeds'])
        ]);

        Product::firstOrCreate([
            'sku' => 'CHA456'
        ], [
            'name' => 'Desk Chair',
            'description' => 'Ergonomic desk chair for comfort and support.',
            'main_image' => '/products/sofa.jpg',
            'extra_images' => json_encode(['sofa.jpg']),
            'condition' => 'New',
            'price' => 89.99,
            'discounted_price' => 79.99,
            'category_id' => 10,
            'brand_id' => 10,
            'product_model_id' => 10,
            'features' => json_encode(['Adjustable height', 'Lumbar support'])
        ]);
    }
}
