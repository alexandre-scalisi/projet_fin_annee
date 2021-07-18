<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();
        foreach($users as $user) {
            $random_animes_ids = DB::table('animes')->get()->random(rand(0, 10))->pluck('id');
            if($random_animes_ids->count() === 0)
                continue;
            foreach($random_animes_ids as $random_animes_id) {
                DB::table('votes')
                    ->insert([
                        'user_id' => $user->id,
                        'anime_id' => $random_animes_id,
                        'vote' => rand(0,5)
                        ]);
            }
        }
    }
}
