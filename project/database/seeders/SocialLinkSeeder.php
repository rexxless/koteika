<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socials = [
            ['social_network' => 'vk', 'url' => 'https://vk.com/koteika'],
            ['social_network' => 'telegram', 'url' => 'https://t.me/koteika'],
        ];
        foreach ($socials as $social) {
            SocialLink::factory()->create($social);
        }
    }
}
