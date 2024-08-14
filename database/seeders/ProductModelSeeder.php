<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductModel;
use App\Models\Brand;

class ProductModelSeeder extends Seeder
{
    public function run()
    {
        $apple = Brand::firstOrCreate(['name' => 'Apple'])->id;
        $samsung = Brand::firstOrCreate(['name' => 'Samsung'])->id;
        $google = Brand::firstOrCreate(['name' => 'Google'])->id;
        $onePlus = Brand::firstOrCreate(['name' => 'OnePlus'])->id;
        $sony = Brand::firstOrCreate(['name' => 'Sony'])->id;
        $xiaomi = Brand::firstOrCreate(['name' => 'Xiaomi'])->id;
        $oppo = Brand::firstOrCreate(['name' => 'Oppo'])->id;
        $huawei = Brand::firstOrCreate(['name' => 'Huawei'])->id;
        $nokia = Brand::firstOrCreate(['name' => 'Nokia'])->id;
        $motorola = Brand::firstOrCreate(['name' => 'Motorola'])->id;

        ProductModel::firstOrCreate([
            'name' => 'iPhone 14',
            'brand_id' => $apple
        ]);
        ProductModel::firstOrCreate([
            'name' => 'Samsung Galaxy S23',
            'brand_id' => $samsung
        ]);
        ProductModel::firstOrCreate([
            'name' => 'Google Pixel 8',
            'brand_id' => $google
        ]);
        ProductModel::firstOrCreate([
            'name' => 'OnePlus 11',
            'brand_id' => $onePlus
        ]);
        ProductModel::firstOrCreate([
            'name' => 'Sony Xperia 1 IV',
            'brand_id' => $sony
        ]);
        ProductModel::firstOrCreate([
            'name' => 'Xiaomi Mi 13',
            'brand_id' => $xiaomi
        ]);
        ProductModel::firstOrCreate([
            'name' => 'Oppo Find X5',
            'brand_id' => $oppo
        ]);
        ProductModel::firstOrCreate([
            'name' => 'Huawei P60',
            'brand_id' => $huawei
        ]);
        ProductModel::firstOrCreate([
            'name' => 'Nokia X30',
            'brand_id' => $nokia
        ]);
        ProductModel::firstOrCreate([
            'name' => 'Motorola Edge 40',
            'brand_id' => $motorola
        ]);
    }
}
