<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->first();
        Room::all()->each(function ($room) use ($user) {
            Booking::factory()->create([
                'room_id' => $room->id,
                'user_id' => $user->id,
            ]);
        });
    }
}
