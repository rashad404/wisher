<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        Brand::firstOrCreate(['name' => 'Samsung']);
        Brand::firstOrCreate(['name' => 'Apple']);
        Brand::firstOrCreate(['name' => 'Google']);
        Brand::firstOrCreate(['name' => 'OnePlus']);
        Brand::firstOrCreate(['name' => 'Sony']);
        Brand::firstOrCreate(['name' => 'Xiaomi']);
        Brand::firstOrCreate(['name' => 'Oppo']);
        Brand::firstOrCreate(['name' => 'Huawei']);
        Brand::firstOrCreate(['name' => 'Nokia']);
        Brand::firstOrCreate(['name' => 'Motorola']);
    }
}
