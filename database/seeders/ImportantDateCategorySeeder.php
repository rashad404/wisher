<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImportantDateCategory;

class ImportantDateCategorySeeder extends Seeder
{
    public function run()
    {
        ImportantDateCategory::factory()->count(5)->create(); // Adjust the count as needed
    }
}
