<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word();

        return [
            'name' => $name,
            'article' => Str::slug($name, '_'),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'data' => [
                'price' => $this->faker->randomFloat(2, 10),
                'size' => $this->faker->randomFloat(2, 10),
            ],
        ];
    }
}
