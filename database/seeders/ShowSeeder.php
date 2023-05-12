<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Show;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Show::truncate();
        });

        Show::insert(
            [
                [
                    'date'=>Carbon::parse('2023-04-24'),
                    'movie_id'=>1,
                ],
                [
                    'date'=>Carbon::parse('2023-04-24'),
                    'movie_id'=>2,
                ],
                [
                    'date'=>Carbon::parse('2023-04-24'),
                    'movie_id'=>3,
                ],
                [
                    'date'=>Carbon::parse('2023-04-24'),
                    'movie_id'=>4,
                ],
                [
                    'date'=>Carbon::parse('2023-04-24'),
                    'movie_id'=>5,
                ],
                [
                    'date'=>Carbon::parse('2023-05-03'),
                    'movie_id'=>1,
                ],
                [
                    'date'=>Carbon::parse('2023-05-03'),
                    'movie_id'=>2,
                ],
                [
                    'date'=>Carbon::parse('2023-05-03'),
                    'movie_id'=>3,
                ],
                [
                    'date'=>Carbon::parse('2023-05-03'),
                    'movie_id'=>4,
                ],
                [
                    'date'=>Carbon::parse('2023-05-03'),
                    'movie_id'=>5,
                ],
                [
                    'date'=>Carbon::parse('2023-05-04'),
                    'movie_id'=>1,
                ],
                [
                    'date'=>Carbon::parse('2023-05-04'),
                    'movie_id'=>2,
                ],
                [
                    'date'=>Carbon::parse('2023-05-04'),
                    'movie_id'=>3,
                ],
                [
                    'date'=>Carbon::parse('2023-05-04'),
                    'movie_id'=>4,
                ],
                [
                    'date'=>Carbon::parse('2023-05-04'),
                    'movie_id'=>5,
                ],
                [
                    'date'=>Carbon::parse('2023-05-11'),
                    'movie_id'=>1,
                ],
                [
                    'date'=>Carbon::parse('2023-05-11'),
                    'movie_id'=>2,
                ],
                [
                    'date'=>Carbon::parse('2023-05-11'),
                    'movie_id'=>3,
                ],
                [
                    'date'=>Carbon::parse('2023-05-11'),
                    'movie_id'=>4,
                ],
                [
                    'date'=>Carbon::parse('2023-05-11'),
                    'movie_id'=>5,
                ]

            ]
        );

    }
}
