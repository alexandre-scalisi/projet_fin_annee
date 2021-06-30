<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $genres;
    protected $anime_json;
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function __construct()
    {
        $this->anime_json=$this->getJson('animu');
        $this->genres=$this->getJson('genres');
    }

    public function run()
    {
        
        $animes = $this->anime_json;
        $genres = $this->genres;
        
        $this->call([
            GenreSeeder::class,
            UserSeeder::class
            ]);

        \App\Models\User::factory(50)->create();
            

        foreach($animes as $anime) {
            $episodes = $anime['episodes'];
            $anime_genres = $anime['genre'];

            $this->callWith(AnimeSeeder::class, compact('anime'));
            $this->callWith(AnimeGenreSeeder::class, compact('anime_genres', 'anime', 'genres'));
            $this->callWith(EpisodeSeeder::class, compact('episodes', 'anime'));
        }
    }

    public function getJson($path) {
        $path = storage_path() . "/app/json/$path.json";
        return json_decode(file_get_contents($path), true);
    }

}
