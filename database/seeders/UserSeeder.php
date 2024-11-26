<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MyLink;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::create([
            'password' => Hash::make('password123'),
            'phone_number' => '081234567890',
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'profile_picture' => null,
        ]);

        MyLink::create([
            'user_id' => $user1->user_id,
            'total_views' => 100,
            'total_clicks' => 50,
        ]);

        $user2 = User::create([
            'password' => Hash::make('password456'),
            'phone_number' => '089876543210',
            'name' => 'Jane Smith',
            'username' => 'janesmith',
            'email' => 'janesmith@example.com',
            'profile_picture' => null,
        ]);

        MyLink::create([
            'user_id' => $user2->user_id,
            'total_views' => 200,
            'total_clicks' => 75,
        ]);
    }
}
