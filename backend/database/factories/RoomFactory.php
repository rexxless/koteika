<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomNumber(4),
            'showcase' => $this->faker->boolean(1),
            'width' => $this->faker->numberBetween(1,10),
            'height' => $this->faker->numberBetween(2,3),
            'length' => $this->faker->numberBetween(1,10)
        ];
    }
}
