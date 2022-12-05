<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Role::create(['name' => 'user']);
        
        $role_admin = Role::create(['name' => 'admin']);
        $role_manager = Role::create(['name' => 'manager']);
        $role_writer = Role::create(['name' => 'writer']);
        $role_user = Role::create(['name' => 'user']);

                 
        $permission = Permission::create(['name'=>'read tasks']);
        $permission = Permission::create(['name'=>'edit tasks']);
        $permission = Permission::create(['name'=>'create tasks']);
        $permission = Permission::create(['name'=>'delete tasks']);


        $role_admin->givePermissionTo('read tasks','create tasks','edit tasks','delete tasks');
        $role_manager->givePermissionTo('read tasks','create tasks','edit tasks','delete tasks');
        $role_writer ->givePermissionTo('edit tasks', 'read tasks','create tasks');
        $role_user -> givePermissionTo('read tasks');
        
    }
}
