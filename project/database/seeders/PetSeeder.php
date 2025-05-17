<?php

namespace Database\Seeders;

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
                'animal' => fake('ru_RU')->randomElement(['собака', 'кошка', 'попугай']),
            ]);
        });
    }
}
