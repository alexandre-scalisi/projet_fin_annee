<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EpisodeController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->model_name = 'Episode';
        $this->default_order_by = 'title';
        $this->accepted_order_bys=['title'];
        parent::__construct();
        
    }


    public function index()
    {
        array_push($this->accepted_order_bys, 'created_at');
        $this->arr['routes'] = $this->getRoutes([], ['show', 'edit', 'destroy'], 'animes' );
        return parent::index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Anime $anime)
    {
        $anime_id = $anime->id;  
        return view('admin.episodes.create', compact('anime_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Anime $anime)
    {   
        $title=$anime->title;
        $episode_name = 'Episode ' . request('episode_number') . ' vostfr';
        $season = request('season_number') ? ' saison ' . request('season_number') : '';
        $data = ['fullname' => $title . ' - ' . $episode_name . $season];
        $request->merge($data);
        $validatedTitle= $request->validate([
            'episode_number' => 'required|numeric',
            'fullname' => 'required|unique:episodes,title'
        ]);

        
        $validatedAdn = [];
        $validatedCrunchyroll = [];
        $validatedWakanim = [];
        
        if(request('adn')) {
            $validatedAdn = $request->validate([
                'adn' => 'string|starts_with:https://animedigitalnetwork.fr/video|unique:episodes,adn'
            ]);
        }
        if(request('crunchyroll')) {
            $validatedCrunchyroll = $request->validate([
                'crunchyroll' => 'string|starts_with:https://www.crunchyroll.com/affiliate_iframeplayer|unique:episodes,crunchyroll'
            ]);
        }
        if(request('wakanim')) {
            $validatedWakanim = $request->validate([
                'wakanim' => 'string|starts_with:https://www.wakanim.tv/fr/v2/catalogue/embeddedplayer|unique:episodes,wakanim'
            ]);
        }

        Episode::create(array_merge($validatedAdn, $validatedCrunchyroll, $validatedWakanim, ['title' => $validatedTitle['fullname'], 'anime_id' => $anime->id]));
        

        return redirect()->back()->with('success', 'Anime ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Anime $anime, Episode $episode)
    {
       
        return view('admin.episodes.show', compact('episode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($anime, $episode)
    {

        $episode = Episode::find($episode);
        
        $episode_title = $episode->title;
        $episode_number = Arr::last(explode(' ', explode(' vostfr', $episode_title)[0]));
        $episode_season = Str::contains($episode_title, 'saison') ? Arr::last(explode(' ', $episode_title)) : null;

        return view('admin.episodes.edit', compact('episode', 'episode_number', 'episode_season'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $anime_id, $episode_id)
    {   
        $anime = Anime::find($anime_id);
        $episode = Episode::find($episode_id);
        $title=$anime->title;
        $episode_name = 'Episode ' . request('episode_number') . ' vostfr';
        $season = request('season_number') ? ' saison ' . request('season_number') : '';
        $data = ['fullname' => $title . ' - ' . $episode_name . $season];
        $request->merge($data);
        $validatedTitle= $request->validate([
            'episode_number' => 'required|numeric',
            'fullname' => 'required|unique:episodes,title,'.$episode_id
        ]);

        
        $validatedAdn = [];
        $validatedCrunchyroll = [];
        $validatedWakanim = [];
        
        if(request('adn')) {
            $validatedAdn = $request->validate([
                'adn' => 'string|starts_with:https://animedigitalnetwork.fr/video|unique:episodes,adn,'.$episode->id
            ]);
        }
        if(request('crunchyroll')) {
            $validatedCrunchyroll = $request->validate([
                'crunchyroll' => 'string|starts_with:https://www.crunchyroll.com/affiliate_iframeplayer|unique:episodes,crunchyroll,'.$episode->id
            ]);
        }
        if(request('wakanim')) {
            $validatedWakanim = $request->validate([
                'wakanim' => 'string|starts_with:https://www.wakanim.tv/fr/v2/catalogue/embeddedplayer|unique:episodes,wakanim,'.$episode->id
            ]);
        }

        $episode->update(array_merge($validatedAdn, $validatedCrunchyroll, $validatedWakanim, ['title' => $validatedTitle['fullname'], 'anime_id' => $anime->id]));
        

        return redirect()->back()->with('success', 'Anime mis à jour avec succès');
    }




}
