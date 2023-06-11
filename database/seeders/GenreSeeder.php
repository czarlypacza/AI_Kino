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
                    'name' => 'Akcja'
                ],
                [
                    'name' => 'Przygoda'
                ],
                [
                    'name' => 'Animacja'
                ],
                [
                    'name' => 'Biografia'
                ],
                [
                    'name' => 'Komedia'
                ],
                [
                    'name' => 'Kryminał'
                ],
                [
                    'name' => 'Dokumentalny'
                ],
                [
                    'name' => 'Dramat'
                ],
                [
                    'name' => 'Familijny'
                ],
                [
                    'name' => 'Fantasy'
                ],
                [
                    'name' => 'Historia'
                ],
                [
                    'name' => 'Horror'
                ],
                [
                    'name' => 'Muzyka'
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
