<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $animes = $this->search();

        return view('admin.animes.index', compact('animes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anime = Anime::find($id);
        return view('admin.animes.show', compact('anime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anime = Anime::find($id);
        return view('admin.animes.show', compact('anime'));
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

    
    private function search() {
        $order_by = lcfirst(request()->input('order_by', 'title'));
        $dir = lcfirst(request()->input('dir', 'asc'));
        $accepted_order_bys = ['title', 'release_date', 'created_at', 'vote', 'episodes'];
        $accepted_dirs =['asc', 'desc'];
        if(!in_array($order_by, $accepted_order_bys))
            $order_by = 'title';
        if(!in_array($dir, $accepted_dirs))
            $dir = 'asc';
        if($order_by === 'vote') {
            
            return Anime::withAvg('votes', 'vote')->orderBy('votes_avg_vote', $dir)->paginate(20);

        }
        else if($order_by == "episodes") {
            return Anime::withCount('episodes')->orderBy('episodes_count', $dir)->paginate(20);
        }
        return Anime::orderBy($order_by, $dir)->paginate(20);
        
    }
}
