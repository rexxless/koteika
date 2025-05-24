<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SocialLinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'social_network' => $this->faker->randomElement(['facebook', 'twitter', 'instagram', 'linkedin']),
            'url' => $this->faker->url(),
        ];
    }
}