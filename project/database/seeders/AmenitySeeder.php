<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $iconNames = ['wifi', 'tv', 'parking', 'pool', 'spa'];
        foreach ($iconNames as $name) {
            Amenity::create([
                'name' => $name,
                'link' => fake()->imageUrl(),
            ]);
        }
    }
}
