<?php

namespace Database\Factories;

use App\Models\Wish;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishFactory extends Factory
{
    protected $model = Wish::class;

    public function definition()
    {
        return [
            'lang' => $this->faker->randomElement(['az', 'en', 'ru']),
            'event_id' => Event::factory(),
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph,
        ];
    }
}
