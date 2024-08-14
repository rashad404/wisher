<?php

namespace Database\Factories;

use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

class SizeFactory extends Factory
{
    protected $model = Size::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'Small',
                'Medium',
                'Large',
                'X-Large',
                'XX-Large',
                'XXX-Large',
                'Extra Small',
                'Extra Large',
                'Standard',
                'One Size'
            ]),
        ];
    }
}
