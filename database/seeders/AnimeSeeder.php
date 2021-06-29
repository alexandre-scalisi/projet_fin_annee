<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AnimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($anime)
    {
        DB::table('animes')->insert([
            'id' => $anime['id'],
            'title' => $anime['title'],
            'release_date' => date('Y-m-d H:i:s', $anime['releaseDate']),
            'synopsis' => $anime['synopsis'],
            'image' => $anime['image'],
            'studio' => $anime['studio'],
            'created_at' => now()
        ]);
    }
}
