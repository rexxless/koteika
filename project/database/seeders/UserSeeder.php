<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Администратор',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);
        User::factory()->create([
            'name' => 'Пользователь',
            'email' => 'user@example.com',
            'is_admin' => false,
        ]);
    }
}
