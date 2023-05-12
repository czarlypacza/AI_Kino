<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Room::truncate();
        });

        Room::insert(
            [
                [
                    'cols'=>10,
                    'rows'=>10,
                ],
                [
                    'cols'=>15,
                    'rows'=>10,
                ],
                [
                    'cols'=>10,
                    'rows'=>15,
                ],
                [
                    'cols'=>15,
                    'rows'=>15,
                ],
            ]
        );
    }
}
