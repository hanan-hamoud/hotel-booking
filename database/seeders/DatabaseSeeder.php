<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Hotel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);




    //     $this->call([
    //         HotelSeeder::class,
    //     ]);
    // }

    public function run(): void
    {
        $this->call([
            HotelSeeder::class,
            RoomSeeder::class,
        ]);
    }
}
