<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Showtime;
use Carbon\Carbon;

class ShowtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Showtime::truncate();
        });

        Showtime::insert(
            [
                [
                    'time'=>Carbon::parse('10:00'),
                    'room_id'=>1,
                    'show_id'=>1,
                ],
                [
                    'time'=>Carbon::parse('12:00'),
                    'room_id'=>2,
                    'show_id'=>1,
                ],
                [
                    'time'=>Carbon::parse('16:00'),
                    'room_id'=>1,
                    'show_id'=>1,
                ],
                [
                    'time'=>Carbon::parse('10:00'),
                    'room_id'=>1,
                    'show_id'=>6,
                ],
                [
                    'time'=>Carbon::parse('12:00'),
                    'room_id'=>2,
                    'show_id'=>6,
                ],
                [
                    'time'=>Carbon::parse('16:00'),
                    'room_id'=>1,
                    'show_id'=>6,
                ],
                [
                    'time'=>Carbon::parse('10:00'),
                    'room_id'=>3,
                    'show_id'=>7,
                ],
                [
                    'time'=>Carbon::parse('12:00'),
                    'room_id'=>4,
                    'show_id'=>7,
                ],
                [
                    'time'=>Carbon::parse('16:00'),
                    'room_id'=>3,
                    'show_id'=>7,
                ],
                [
                    'time'=>Carbon::parse('10:00'),
                    'room_id'=>3,
                    'show_id'=>16,
                ],
                [
                    'time'=>Carbon::parse('12:00'),
                    'room_id'=>4,
                    'show_id'=>16,
                ],
                [
                    'time'=>Carbon::parse('16:00'),
                    'room_id'=>3,
                    'show_id'=>16,
                ],
            ]
        );
    }
}
