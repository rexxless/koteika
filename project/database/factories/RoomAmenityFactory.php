<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;

class RoomAmenityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'room_id' => Room::factory(),
        ];
    }
}
