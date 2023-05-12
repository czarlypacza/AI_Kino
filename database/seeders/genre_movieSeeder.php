<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class genre_movieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            DB::table('genre_movie')->truncate();
        });

        DB::table('genre_movie')->insert([
            [
                'genre_id' => 1,
                'movie_id' => 1,
            ],
            [
                'genre_id' => 2,
                'movie_id' => 1,
            ],
            [
                'genre_id' => 5,
                'movie_id' => 2,
            ],
            [
                'genre_id' => 2,
                'movie_id' => 2,
            ],
        ]);
    }
}
