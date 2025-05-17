<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'animal' => $this->faker->randomElement(['dog', 'cat', 'bird', 'other']),
            'booking_id' => \App\Models\Booking::factory(),
        ];
    }
}