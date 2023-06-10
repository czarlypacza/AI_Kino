<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\MovieSeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\ShowSeeder;
use Database\Seeders\ShowtimeSeeder;
use Database\Seeders\TicketSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\genre_movieSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RoleSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(genre_movieSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(ShowSeeder::class);
        $this->call(ShowtimeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CarouselSeeder::class);
        $this->call(TicketSeeder::class);

    }
}
