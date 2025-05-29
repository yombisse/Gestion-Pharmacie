<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin=User::firstOrCreate(

            ['email'=>'admin@gmail.com'],
            ['name'=>'admin',
            'firstname'=>'admin',
            'password'=>bcrypt('admin123'),
        ]);
        $admin->assignRole('admin');
        
    }
}
