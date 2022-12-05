<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'm.peter.k15@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$hybKw/csZJljlE9iIwgIZugD9KKLJk3HhbE6OH7ALy6CzeOkF5Q2O', // password
        ])->assignRole('writer', 'admin');

        User::create([
            'name' => 'user',
            'email' => 'p.petermanik@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$hybKw/csZJljlE9iIwgIZugD9KKLJk3HhbE6OH7ALy6CzeOkF5Q2O', // password
        ])->assignRole('writer');
    }
}

