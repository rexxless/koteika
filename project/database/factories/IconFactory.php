<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IconFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'link' => $this->faker->imageUrl(),
        ];
    }
}