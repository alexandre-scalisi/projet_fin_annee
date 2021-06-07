<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimeGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($anime_genres, $anime, $genres)
    {

        foreach($anime_genres as $anime_genre) {
                
            DB::table('anime_genre')->insert([
                'anime_id' => $anime['id'],
                'genre_id' => array_search($anime_genre, $genres) + 1,
                'created_at' => now()
            ]);
        }
    }
}
