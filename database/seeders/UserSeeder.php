<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('Admin_Pa$$word'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('User_Pa$$word'),
            'role' => 'user'
        ]);
    }
}