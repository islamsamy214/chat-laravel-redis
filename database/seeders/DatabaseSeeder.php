<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //create initial user
        \App\Models\User::factory()->create([
            'name' => 'super_admin',
            'email' => 'super_admin@app.com',
            'password' => Hash::make('12345678'),
        ]);

        // create 10 users each two users are in same room and the User in many to many relationship with the Room
        // \App\Models\Room::factory(10)->create();
        \App\Models\User::factory(10)->create();
        // \App\Models\Message::factory(100)->create();
    }
}
