<?php

namespace Database\Factories;

use App\Models\ImportantDate;
use App\Models\ImportantDateCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImportantDateFactory extends Factory
{
    protected $model = ImportantDate::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'date' => $this->faker->date,
            'is_annual' => $this->faker->boolean,
            'is_monthly' => $this->faker->boolean,
            'category_id' => ImportantDateCategory::factory(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'position' => $this->faker->numberBetween(1, 100),
        ];
    }
}
