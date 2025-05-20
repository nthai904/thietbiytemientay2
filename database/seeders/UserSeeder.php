<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'user_name' => 'admin',
            'email' => 'mita@gmail.com',
            'password' => bcrypt('mita@2025'),
            'department' => 'admin',
            'is_admin' => 1,
            'avatar' => 'avatars/1747446451_6827eab3dc28b.png'
        ]);
    }
}
