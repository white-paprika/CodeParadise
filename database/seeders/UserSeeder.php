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
        // Admin
        User::create([
            'name' => 'testAdmin',
            'email' => 'testAdmin@mail.ru',
            'role' => 'admin',
            'path' => 'admin_avatar_path',
            'email_verified_at' => now(),
            'password' => 'password', 
            'remember_token' => 'qoxnf739dn',
        ]);

        // User
        User::create([
            'name' => 'testUser',
            'email' => 'testUser@mail.ru',
            'role' => 'user',
            'path' => 'user_avatar_path',
            'email_verified_at' => now(),
            'password' => 'password', 
            'remember_token' => 'woxnf739dn',
        ]);

    }
}
