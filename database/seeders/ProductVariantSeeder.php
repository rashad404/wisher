<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariant;

class ProductVariantSeeder extends Seeder
{
    public function run()
    {
        ProductVariant::firstOrCreate([
            'product_id' => 1,
            'color_id' => 1,
            'size_id' => 1,
        ], [
            'quantity' => 100
        ]);

        ProductVariant::firstOrCreate([
            'product_id' => 1,
            'color_id' => 2,
            'size_id' => 2,
        ], [
            'quantity' => 50
        ]);

        ProductVariant::firstOrCreate([
            'product_id' => 2,
            'color_id' => 1,
            'size_id' => 3,
        ], [
            'quantity' => 30
        ]);

        ProductVariant::firstOrCreate([
            'product_id' => 2,
            'color_id' => 2,
            'size_id' => 1,
        ], [
            'quantity' => 20
        ]);

        ProductVariant::firstOrCreate([
            'product_id' => 3,
            'color_id' => 3,
            'size_id' => 2,
        ], [
            'quantity' => 15
        ]);

        ProductVariant::firstOrCreate([
            'product_id' => 4,
            'color_id' => 1,
            'size_id' => 3,
        ], [
            'quantity' => 40
        ]);

        ProductVariant::firstOrCreate([
            'product_id' => 4,
            'color_id' => 2,
            'size_id' => 2,
        ], [
            'quantity' => 25
        ]);

        ProductVariant::firstOrCreate([
            'product_id' => 5,
            'color_id' => 1,
            'size_id' => 1,
        ], [
            'quantity' => 35
        ]);

        ProductVariant::firstOrCreate([
            'product_id' => 5,
            'color_id' => 3,
            'size_id' => 3,
        ], [
            'quantity' => 10
        ]);

        ProductVariant::firstOrCreate([
            'product_id' => 6,
            'color_id' => 2,
            'size_id' => 1,
        ], [
            'quantity' => 60
        ]);
    }
}
