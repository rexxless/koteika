<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'room_id' => \App\Models\Room::factory(),
            'check_in' => $this->faker->dateTimeBetween('now', '+1 month'),
            'check_out' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'user_id' => \App\Models\User::factory(),
            'approved' => $this->faker->boolean(50),
        ];
    }
}