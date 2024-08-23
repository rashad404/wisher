<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interest;
use App\Models\InterestCategory;

class InterestSeeder extends Seeder
{
    public function run()
    {
        $interests = [
            ['name' => ['en' => 'Laptop', 'fr' => 'Ordinateur portable'], 'interest_category_id' => 1, 'position' => 1, 'status' => true],
            ['name' => ['en' => 'Smartphone', 'fr' => 'Téléphone intelligent'], 'interest_category_id' => 1, 'position' => 2, 'status' => true],
            ['name' => ['en' => 'Refrigerator', 'fr' => 'Réfrigérateur'], 'interest_category_id' => 2, 'position' => 1, 'status' => true],
            ['name' => ['en' => 'Blender', 'fr' => 'Mixeur'], 'interest_category_id' => 2, 'position' => 2, 'status' => true],
            ['name' => ['en' => 'Soccer', 'fr' => 'Football'], 'interest_category_id' => 3, 'position' => 1, 'status' => true],
            ['name' => ['en' => 'Tennis', 'fr' => 'Tennis'], 'interest_category_id' => 3, 'position' => 2, 'status' => true],
        ];

        foreach ($interests as $interest) {
            Interest::create($interest);
        }
    }
}
