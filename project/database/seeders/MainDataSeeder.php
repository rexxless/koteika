<?php

namespace Database\Seeders;

use App\Models\MainData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MainData::factory()->create([
            'title' => 'Гостиница Котейка',
            'city' => 'Москва',
            'slogan' => 'Лучшее место для вашего питомца!',
            'phone' => '+7 495 123-45-67',
            'email' => 'info@koteika.ru',
            'address' => 'ул. Пушкина, д. 34',
            'working_time' => '10:00 - 21:00'
        ]);
    }
}
