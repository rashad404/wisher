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
            'status' => 1,
            'user_id' => 1,
            'contact_id' => 1,
            'group_id' => 1,
        ];
    }
}
