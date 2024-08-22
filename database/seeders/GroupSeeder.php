<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    public function run()
{

    $list = [
        ['name' => 'Family'],
        ['name' => 'Friends'],
        ['name' => 'Work'],
    ];

    foreach ($list as $item) {
        Group::firstOrCreate([
            'user_id' => 1,
            'name' => $item['name'],

        ]);
    }

    }
}
