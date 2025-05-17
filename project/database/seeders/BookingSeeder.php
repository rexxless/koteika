<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms->each(function ($room) use ($user) {
            Booking::factory()->create([
                'room_id' => $room->id,
                'user_id' => $user->id,
            ]);
        });
    }
}
