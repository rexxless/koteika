<?php

namespace Database\Seeders;

use App\Models\RoomAmenity;
use App\Models\Amenity;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = Amenity::all();
        Room::all()->each(function ($room) use ($amenities) {
            RoomAmenity::factory()->create([
                'room_id' => $room->id,
                'name' => $amenities->random()->name,
            ]);
        });
    }
}
