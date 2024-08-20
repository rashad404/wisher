<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // Ensure you have a User factory
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'birthdate' => $this->faker->date('Y-m-d'),
            'address' => $this->faker->address,
            'interests' => json_encode([$this->faker->word, $this->faker->word]), // Ensure it's a valid JSON format
            'likes' => json_encode([$this->faker->word, $this->faker->word]),
            'dislikes' => json_encode([$this->faker->word, $this->faker->word]),
        ];
    }
}
