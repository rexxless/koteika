<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Pet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::all()->each(function ($booking) {
            Pet::factory()->create([
                'booking_id' => $booking->id,
                'name' => fake('ru_RU')->firstName(),
            ]);
        });
    }
}
