<?php

namespace Database\Seeders;

use App\Models\Icon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $iconNames = ['wifi', 'tv', 'parking', 'pool', 'spa'];
        foreach ($iconNames as $name) {
            Icon::create([
                'name' => $name,
                'link' => fake()->imageUrl(),
            ]);
        }
    }
}
