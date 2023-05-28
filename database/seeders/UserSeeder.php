<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::withoutForeignKeyConstraints(function () {
            User::truncate();
        });
        User::insert(
            [
                [
                    'name' => 'Jan', 'email' => 'jan@email.com', 'password' => Hash::make('1234'),
                 'role_id' => 2,
                ],
                [
                    'name' => 'Siu Hun', 'email' => 'siuhun@email.com', 'password' => Hash::make('1234'),
                 'role_id' => 1,
                ],
                [
                    'name' => 'Helmut', 'email' => 'helmut@email.com', 'password' => Hash::make('1234'),
                 'role_id' => 1,
                ],
                [
                    'name' => 'Marta', 'email' => 'marta@email.com', 'password' => Hash::make('1234'),
                 'role_id' => 1,
                ],
                [
                    'name' => 'Bill', 'email' => 'bill@email.com', 'password' => Hash::make('1234'),
                 'role_id' => 1,
                ],
                [
                    'name' => 'Lilly', 'email' => 'lilly@email.com', 'password' => Hash::make('1234'),
                 'role_id' => 1,
                ]
            ]
        );
    }
}
