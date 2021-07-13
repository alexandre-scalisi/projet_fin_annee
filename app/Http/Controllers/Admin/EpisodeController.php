<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

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
        $this->arr['routes'] = $this->getRoutes([], ['show', 'update', 'destroy'], 'animes' );
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
        $fullname = $title . ' - ' . $episode_name . $season;
        
        $validatedAdn = [];
        $validatedCrunchyroll = [];
        $validatedWakanim = [];

        $validatedTitle = $request->validate([
            'title' => 'required|string|min:2|max:80|unique:episodes,title',
        ]);
        
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
        
        Episode::create(array_merge($validatedTitle, $validatedAdn, $validatedCrunchyroll, $validatedWakanim, ['anime_id' => $anime->id]));

        

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
        
        $links = $episode->links();
        return view('episodes.show', compact('episode', 'links'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $deletes = request('delete');
        if(!$deletes)
            return redirect()->back();

        Episode::withoutTrashed()->whereIn('id', $deletes)->delete();
        return redirect()->back()->with('success', 'Episode(s) envoyé(s) à la poubelle avec succès');
    }

    



    public function restore()
    {
        $restores = request('restore');

        if(!$restores)
            return redirect()->back();
        Episode::onlyTrashed()->whereIn('id', $restores)->restore();
        return redirect()->back()->with('success', 'Episode(s) restauré(s) avec succès');
    }
    public function forceDelete()
    {
        $deletes = request('delete');
        if(!$deletes)
            return redirect()->back();

            Episode::onlyTrashed()->whereIn('id', $deletes)->forceDelete();
        return redirect()->back()->with('success', 'Episodes définitivement supprimés avec succès');
    }


}
