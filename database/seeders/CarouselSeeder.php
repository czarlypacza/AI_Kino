<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Carousel::truncate();
        });
        Carousel::insert([
            [
                'img'=>'civil_war.jpg',
                'movie_id'=>1,
            ],
            [
                'img'=>'suzume.jpg',
                'movie_id'=>2,
            ],
            [
                'img'=>'asteriks_i_obelisk.jpg',
                'movie_id'=>4,
            ],
        ]);
    }
}
