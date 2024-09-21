<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'vica',
            'email' => 'vica@gmail.com',
            'password' => Hash::make('123123123'),
            'image'=> 'users/default.jpg',
            'is_admin' => true,
        ]);
    }
}
