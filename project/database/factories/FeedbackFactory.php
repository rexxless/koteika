<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    public function definition(): array
    {
        return [
            'rate' => $this->faker->numberBetween(1, 5),
            'author' => $this->faker->name(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'room_id' => \App\Models\Room::factory(),
        ];
    }
}