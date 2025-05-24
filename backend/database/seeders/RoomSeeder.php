<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::factory(5)->create()->each(function ($room) {
            $room->update([
                'title' => fake('ru_RU')->sentence(3),
                'description' => fake('ru_RU')->paragraph(),
            ]);
        });
    }
}
