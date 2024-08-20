<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserEvent;

class UserEventSeeder extends Seeder
{
    public function run()
    {
        UserEvent::factory()->count(10)->create(); // Creates 10 records in the user_events table
    }
}
