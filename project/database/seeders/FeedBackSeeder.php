<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedBackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms->each(function ($room) use ($user) {
            Feedback::factory()->create([
                'room_id' => $room->id,
                'author' => $user->name,
                'title' => fake('ru_RU')->sentence(4),
                'description' => fake('ru_RU')->paragraph(),
            ]);
        });
    }
}
