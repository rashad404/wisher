<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition()
    {
        return [
            'user_id' => 1, // Ensure you have a User factory
            'name' => $this->faker->word,
        ];
    }
}
