<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        // Create specific brands
        Brand::firstOrCreate(['name' => 'Samsung']);
        Brand::firstOrCreate(['name' => 'Apple']);

        // Create additional random brands using the factory
        // Brand::factory()->count(8)->create(); // Adjust the count as needed
    }
}
