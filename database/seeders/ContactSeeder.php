<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use Faker\Factory as Faker;


class ContactSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Create a new Faker instance

        $list = [
            ['name' => 'John D.', 'group' => 1],
            ['name' => 'Mike M.', 'group' => 2],
            ['name' => 'Olivia B.', 'group' => 3],
        ];
    
        foreach ($list as $item) {
            $contact = Contact::firstOrCreate([
                'user_id' => 1,
                'name' => $item['name'],
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->phoneNumber,
                'birthdate' => $faker->date('Y-m-d'),
                'address' => $faker->address,
                'interests' => json_encode([$faker->word, $faker->word]), // Ensure it's a valid JSON format
                'likes' => json_encode([$faker->word, $faker->word]),
                'dislikes' => json_encode([$faker->word, $faker->word]),
            ]);

            $contact->groups()->attach($item['group']);

        }
    }
}
