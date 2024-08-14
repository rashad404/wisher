<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create the admin user if it doesn't already exist
        User::firstOrCreate(
            ['email' => 'admin@wisher.az'], // Check by email
            [
                'name' => 'Admin', // Set a name or leave as desired
                'password' => Hash::make('123456'), // Encrypt the password
            ]
        );
        // Create additional random brands using the factory
        User::factory()->count(9)->create(); // Adjust the count as needed
    }
}
