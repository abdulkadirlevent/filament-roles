<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Admin
       User::create([
            'id' => 1,
            'name' => 'Abdulkadir LEVENT',
            'email' => 'abdulkadirlevent@hotmail.com',
            'password' => Hash::make('Batman7234'),
            'image' => 'google.png',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
       // User
        User::create([
            'id' => 2,
            'name' => 'Abdulkadir Yahoo',
            'email' => 'abdulkadirlevent@yahoo.com',
            'password' => Hash::make('Batman7234'),
            'image' => 'google.png',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'id' => 3,
            'name' => 'Abdulkadir Gmail',
            'email' => 'abdulkadirlevent@gmail.com',
            'password' => Hash::make('Batman7234'),
            'image' => 'google.png',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
