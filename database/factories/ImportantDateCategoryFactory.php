<?php

namespace Database\Factories;

use App\Models\ImportantDateCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImportantDateCategoryFactory extends Factory
{
    protected $model = ImportantDateCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'position' => $this->faker->numberBetween(1, 100),
        ];
    }
}
