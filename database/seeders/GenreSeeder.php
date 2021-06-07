<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = $this->genres;

        foreach($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre,
                'created_at' => now()
            ]);
        }
    }
}
