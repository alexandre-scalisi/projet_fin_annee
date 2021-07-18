<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        
        $animes = Anime::paginate(12);
        return view('anime.index', compact('animes'));
    }


    public function home() {

        $animes = Anime::all();
        $new_animes = Anime::latest()->take(10)->get();
        $action_animes = Genre::where('name', 'Action')->first()->animes()->get()->random(10);
        $top_rated_animes = Anime::withAvg('votes', 'vote')
        ->orderBy('votes_avg_vote', 'desc')->take(10)->get();
        $random_animes = Anime::all()->random(10);

        return view('anime.home', compact('animes', 'new_animes', 'action_animes', 'top_rated_animes', 'random_animes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function show(Anime $anime)
    {   
        // TODO refactoriser le code
        $episodes = $anime->episodes()->paginate(25);

        $truncated_synopsis = h_truncate($anime->synopsis, 500);
        return view('anime.show', compact('anime', 'truncated_synopsis', 'episodes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function edit(Anime $anime)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anime $anime)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anime $anime)
    {
        //
    }


}
