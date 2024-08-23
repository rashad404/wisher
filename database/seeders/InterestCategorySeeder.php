<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterestCategory;

class InterestCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => ['en' => 'Technology', 'fr' => 'Technologie'], 'position' => 1, 'status' => true],
            ['name' => ['en' => 'Home Appliances', 'fr' => 'Appareils ménagers'], 'position' => 2, 'status' => true],
            ['name' => ['en' => 'Sports', 'fr' => 'Sports'], 'position' => 3, 'status' => true],
        ];

        foreach ($categories as $category) {
            InterestCategory::create($category);
        }
    }
}
