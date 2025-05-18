<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MainDataFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
            'city' => $this->faker->city(),
            'slogan' => $this->faker->words(4, true),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
            'address' => $this->faker->address(),
            'working_time' => $this->faker->time(),
        ];
    }
}
