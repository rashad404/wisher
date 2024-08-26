<?php

namespace Database\Factories;

use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventCategoryFactory extends Factory
{
    protected $model = EventCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'position' => $this->faker->numberBetween(1, 100),
        ];
    }
}
