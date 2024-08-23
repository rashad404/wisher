<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserEvent;
use Faker\Factory as Faker;

class UserEventSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Define an array of events with real values
        $events = [
            [
                'name' => 'John\'s Birthday',
                'date' => '2024-10-10',
                'recurrence' => 2,
                'status' => 1,
                'user_id' => 1,
                'contact_id' => 1,
                'group_id' => 1,
            ],
            [
                'name' => 'Company Anniversary',
                'date' => '2024-09-15',
                'recurrence' => 0,
                'status' => 1,
                'user_id' => 1,
                'contact_id' => 3,
                'group_id' => 3,
            ],
            [
                'name' => 'Monthly Team Meeting',
                'date' => '2024-08-22',
                'recurrence' => 1,
                'status' => 1,
                'user_id' => 1,
                'contact_id' => 3,
                'group_id' => 3,
            ],
        ];

        // Loop through the events array and create UserEvent records
        foreach ($events as $event) {
            UserEvent::firstOrCreate([
                'name' => $event['name'],
                'date' => $event['date'],
                'recurrence' => $event['recurrence'],
                'status' => $event['status'],
                'user_id' => $event['user_id'],
                'contact_id' => $event['contact_id'],
                'group_id' => $event['group_id'],
            ]);
        }
    }
}
