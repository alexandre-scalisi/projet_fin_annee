<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function destroy($id)
    {
        //
    }

    public function all() {
        $episodes = $this->search();
        return view('admin.episodes.all', compact('episodes'));
    }


    private function search() {
        $order_by = lcfirst(request()->input('order_by', 'title'));
        $dir = lcfirst(request()->input('dir', 'asc'));
        $accepted_order_bys = ['title', 'created_at'];
        $accepted_dirs =['asc', 'desc'];
        if(!in_array($order_by, $accepted_order_bys))
            $order_by = 'title';
        if(!in_array($dir, $accepted_dirs))
            $dir = 'asc';
      
        return Episode::orderBy($order_by, $dir)->paginate(20);
        
    }
}
