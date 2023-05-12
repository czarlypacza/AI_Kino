<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Ticket::truncate();
        });
        Ticket::insert(
            [
                [
                    'seat'=>1,
                    'row'=>1,
                    'price'=>20,
                    'showtime_id'=>1,
                ],
                [
                    'seat'=>2,
                    'row'=>1,
                    'price'=>20,
                    'showtime_id'=>1,
                ],
                [
                    'seat'=>3,
                    'row'=>2,
                    'price'=>20,
                    'showtime_id'=>1,
                ]
            ]
        );

    }
}
