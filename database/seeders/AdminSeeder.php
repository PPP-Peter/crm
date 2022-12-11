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
            'password' => '$2y$10$wNZcFRQ1ae9CrUit/.Oblew6oZeDrufdi2qIsdKumoj7H8c.Bc0c.', // heslo123
        ])->assignRole('admin');


        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$wNZcFRQ1ae9CrUit/.Oblew6oZeDrufdi2qIsdKumoj7H8c.Bc0c.', // heslo123
        ];

        User::create(array_merge([
            'name' => 'manager',
            'email' => 'info.pppcreative.@gmail.com',
        ], $default_user_value) )->assignRole('manager');

        User::create(array_merge([
            'name' => 'writer',
            'email' => 'p.petermanik@gmail.com',
        ], $default_user_value) )->assignRole('writer');

        User::create(array_merge([
            'name' => 'user',
            'email' => 'info@pppcreative.sk',
        ], $default_user_value) )->assignRole('user');


    }
    
}

