<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Genre::truncate();
        });

        Genre::insert(
            [
                [
                    'name' => 'Action'
                ],
                [
                    'name' => 'Adventure'
                ],
                [
                    'name' => 'Animation'
                ],
                [
                    'name' => 'Biography'
                ],
                [
                    'name' => 'Comedy'
                ],
                [
                    'name' => 'Crime'
                ],
                [
                    'name' => 'Documentary'
                ],
                [
                    'name' => 'Drama'
                ],
                [
                    'name' => 'Family'
                ],
                [
                    'name' => 'Fantasy'
                ],
                [
                    'name' => 'History'
                ],
                [
                    'name' => 'Horror'
                ],
                [
                    'name' => 'Music'
                ],
                [
                    'name' => 'Musical'
                ],
                [
                    'name' => 'Mystery'
                ],
            ]
        );
    }
}
