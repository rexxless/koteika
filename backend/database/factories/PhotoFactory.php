<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'link' => $this->faker->imageUrl(),
            'room_id' => \App\Models\Room::factory(),
        ];
    }
}
