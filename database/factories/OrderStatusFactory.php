<?php

namespace Database\Factories;

use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderStatusFactory extends Factory
{
    protected $model = OrderStatus::class;

    public function definition()
    {
        return [
            'status' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}

