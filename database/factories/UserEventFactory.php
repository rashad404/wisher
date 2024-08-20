<?php

namespace Database\Factories;

use App\Models\UserEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserEventFactory extends Factory
{
    protected $model = UserEvent::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'date' => $this->faker->date,
            'is_annual' => $this->faker->boolean,
            'is_monthly' => $this->faker->boolean,
            'category' => $this->faker->word,
            'status' => $this->faker->word,
            'user_id' => \App\Models\User::factory(),
            'contact_id' => \App\Models\Contact::factory(),
            'group_id' => \App\Models\Group::factory(),
        ];
    }
}
