<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\User;
use Faker\Factory as Faker;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        Activity::create([
            'user_id' => 1,
            'type' => 'message_sent', // Example activity type
            'description' => 'Sent a message to another user.', // Example description
            'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ]);

        Activity::create([
            'user_id' => 1,
            'type' => 'contact_added', // Example activity type
            'description' => 'Added a new contact.', // Example description
            'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ]);

        Activity::create([
            'user_id' => 1,
            'type' => 'event_created', // Example activity type
            'description' => 'Created a new event.', // Example description
            'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ]);
    }
}
