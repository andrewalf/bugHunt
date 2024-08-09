<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(30),
            'description' => fake()->text(1000),
            'price' => fake()->randomFloat(2, 10, 50000),
            'stock' => fake()->numberBetween(0, 100),
            'is_visible' => fake()->boolean()
        ];
    }
}