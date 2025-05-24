<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedBackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->first();
        Room::all()->each(function ($room) use ($user) {
            Feedback::factory()->create([
                'room_id' => $room->id,
                'author' => $user->id,
                'title' => fake('ru_RU')->sentence(4),
                'description' => fake('ru_RU')->paragraph(),
            ]);
        });
    }
}
