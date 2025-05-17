<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Icon;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = Icon::all();
        Room::all()->each(function ($room) use ($amenities) {
            Amenity::factory(3)->create([
                'room_id' => $room->id,
                'name' => $amenities->random()->name,
            ]);
        });
    }
}
