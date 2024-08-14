<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    public function run()
    {
        Color::firstOrCreate(['name' => 'Red']);
        Color::firstOrCreate(['name' => 'Blue']);
        Color::firstOrCreate(['name' => 'Green']);
        Color::firstOrCreate(['name' => 'Yellow']);
        Color::firstOrCreate(['name' => 'Black']);
        Color::firstOrCreate(['name' => 'White']);
        Color::firstOrCreate(['name' => 'Purple']);
        Color::firstOrCreate(['name' => 'Orange']);
        Color::firstOrCreate(['name' => 'Pink']);
        Color::firstOrCreate(['name' => 'Gray']);
    }
}
