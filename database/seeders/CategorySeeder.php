<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::firstOrCreate(['name' => 'Electronics']);
        Category::firstOrCreate(['name' => 'Furniture']);
        Category::firstOrCreate(['name' => 'Books']);
        Category::firstOrCreate(['name' => 'Clothing']);
        Category::firstOrCreate(['name' => 'Toys']);
        Category::firstOrCreate(['name' => 'Sports']);
        Category::firstOrCreate(['name' => 'Automotive']);
        Category::firstOrCreate(['name' => 'Health & Beauty']);
        Category::firstOrCreate(['name' => 'Home & Kitchen']);
        Category::firstOrCreate(['name' => 'Office Supplies']);
    }
}
