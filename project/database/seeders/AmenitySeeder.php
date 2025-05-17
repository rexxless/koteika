<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms->each(function ($room) {
            Amenity::factory(3)->create([
                'room_id' => $room->id,
                'name' => fake('ru_RU')->word(),
            ]);
        });
    }
}
