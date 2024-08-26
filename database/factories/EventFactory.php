<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'date' => $this->faker->date,
            'is_annual' => $this->faker->boolean,
            'is_monthly' => $this->faker->boolean,
            'category_id' => 1,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'position' => $this->faker->numberBetween(1, 100),
        ];
    }
}
