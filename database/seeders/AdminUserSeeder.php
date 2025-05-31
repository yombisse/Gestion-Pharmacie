<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'firstname'=>'Admin',
            'email' => 'adminuser@gmail.com',
            'password' => bcrypt('password'), // change le mot de passe
        ]);

        $role = Role::firstOrCreate(['name' => 'admin']);
        $admin->assignRole($role);
    }
}
