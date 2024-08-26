<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventCategory;

class EventCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'İctimai Bayramlar',
            'Dini Bayramlar',
            'Milli Bayramlar',
            'Beynəlxalq Bayramlar',
            'Qeyri-rəsmi Bayramlar',
            'Mədəni Bayramlar',
        ];

        foreach ($categories as $category) {
            EventCategory::create(['name' => $category]);
        }
    }
}
