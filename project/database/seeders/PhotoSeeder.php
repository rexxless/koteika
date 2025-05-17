<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::all()->each(function ($room) {
            Photo::factory(2)->create([
                'room_id' => $room->id,
            ]);
        });
    }
}
