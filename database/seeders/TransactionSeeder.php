<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            DB::table('transactions')->truncate();
        });
        DB::table('transactions')->insert(
            [
                [
                    'title'=>'Kapitan Ameryka:Civil war',
                    'date'=>'2023-04-24',
                    'time'=>'10:00:00',
                    'room'=>1,
                    'seat'=>1,
                    'row'=>1,
                    'price'=>20,
                    'email'=>'siuhun@email.com'
                ],
                [
                    'title'=>'Kapitan Ameryka:Civil war',
                    'date'=>'2023-04-24',
                    'time'=>'10:00:00',
                    'room'=>1,
                    'seat'=>2,
                    'row'=>1,
                    'price'=>20,
                    'email'=>'siuhun@email.com'
                ],
                [
                    'title'=>'Kapitan Ameryka:Civil war',
                    'date'=>'2023-04-24',
                    'time'=>'10:00:00',
                    'room'=>1,
                    'seat'=>3,
                    'row'=>2,
                    'price'=>20,
                    'email'=>'siuhun@email.com'
                ],
            ]
        );
    }
}
