<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);     // odkaze na novy seeder pre role
        $this->call(AdminSeeder::class);

        //$this->call(UsersTableSeeder::class);   // odkaze na novy seeder post
        //$this->call(ClientsTableSeeder::class);   // odkaze na novy seeder post
        //$this->call(ProjectsTableSeeder::class);   // odkaze na novy seeder post
        $this->call(TasksTableSeeder::class);   // odkaze na novy seeder post, vo factory je previazaný s ostatnými postami cize vytvorí aj ostatné

        
    }
}
