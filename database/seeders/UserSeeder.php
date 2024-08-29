<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create the admin user if it doesn't already exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@wisher.az'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'),
            ]
        );

        // Create the admin's profile if it doesn't exist
        $admin->profile()->firstOrCreate([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'gender' => 0,
            'dob' => '1980-01-01',
            'address' => '123 Admin St',
            'city' => 'Admin City',
            'state' => 'Admin State',
            'zip' => '12345',
            'country' => 'Admin Country',
            'phone_number' => '123-456-7890',
            'profile_photo' => 'default_photos/profile.png',
        ]);

        // Create additional random users using the factory
        User::factory()
            ->count(9)
            ->create()
            ->each(function ($user) {
                // Create a profile for each user with the new fields
                $user->profile()->create([
                    'first_name' => fake()->firstName(),
                    'last_name' => fake()->lastName(),
                    'gender' => rand(0, 1),
                    'dob' => fake()->date(),
                    'address' => fake()->address(),
                    'city' => fake()->city(),
                    'state' => fake()->state(),
                    'zip' => fake()->postcode(),
                    'country' => fake()->country(),
                    'phone_number' => fake()->phoneNumber(),
                    'profile_photo' => 'default_photos/profile.png',
                ]);
            });
    }
}
