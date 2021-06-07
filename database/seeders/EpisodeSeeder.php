<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($episodes, $anime)
    {
                foreach($episodes as $episode) {
            $videoLinks = $episode['videoLinks'];
            DB::table('episodes')->insert([
                'title' => $episode['title'],
                'adn' => $videoLinks['adn'] === '' ? null : $videoLinks['adn'],
                'crunchyroll' => $videoLinks['crunchyroll'] === '' ? null : $videoLinks['crunchyroll'],
                'wakanim' => $videoLinks['wakanim'] === '' ? null : $videoLinks['wakanim'],
                'anime_id' => $anime['id'],
                'created_at' => now()
            ]);
        }
    }
}
