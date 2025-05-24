<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomAmenity;
use App\Models\Photo;
use App\Models\Booking;
use App\Models\Pet;
use App\Models\Feedback;
use App\Models\Amenity;
use App\Models\MainData;
use App\Models\SocialLink;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MainDataSeeder::class,
            RoomSeeder::class,
            AmenitySeeder::class,
            RoomAmenitySeeder::class,
            PhotoSeeder::class,
            UserSeeder::class,
            BookingSeeder::class,
            PetSeeder::class,
            FeedBackSeeder::class,
            SocialLinkSeeder::class,
        ]);
    }
}
