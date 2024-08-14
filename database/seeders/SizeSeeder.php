<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    public function run()
    {
        Size::firstOrCreate(['name' => 'Small']);
        Size::firstOrCreate(['name' => 'Medium']);
        Size::firstOrCreate(['name' => 'Large']);
        Size::firstOrCreate(['name' => 'X-Large']);
        Size::firstOrCreate(['name' => 'XX-Large']);
        Size::firstOrCreate(['name' => 'XXX-Large']);
        Size::firstOrCreate(['name' => 'Extra Small']);
        Size::firstOrCreate(['name' => 'Extra Large']);
        Size::firstOrCreate(['name' => 'Standard']);
        Size::firstOrCreate(['name' => 'One Size']);
    }
}
