<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class AnimeController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->model_name = 'Anime';
        parent::__construct();
        
    }


    public function index()
    {
        $this->indexAndRestoreHelper($this->model::withoutTrashed());
        $this->arr['routes'] = $this->getRoutes(['show', 'create', 'update', 'destroy']);

        return view('admin.animes.index', $this->arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.animes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_extension = $request->file('image')->extension();
        $image_path = 'public/images';
        $image_name =  uniqid('img_', true);
        $image_fullname = $image_name.'.'.$image_extension;


        $validatedAnime = $request->validate([
            'title' => 'required|string|min:2|max:80|unique:animes,title',
            'synopsis' => 'required|string|min:5|max:2000',
            'release_date' => 'required|date',
            'studio' => 'required|string|max:80',
        ]);
        
        $validatedImage = $request->validate(['image' => 'required|image|mimes:jpg,jpeg,png|max:4000']);

        $validatedGenres = $request->validate([
            'genre' => 'required|array',
            'genre.*' => 'required|string|exists:genres,id'
        ]);
        $anime = DB::table('animes')->insertGetId(array_merge($validatedAnime, ['created_at' => now(), 'image' => $image_fullname]));

        $request->file('image')->storeAs($image_path, $image_fullname);
        foreach(Arr::first($validatedGenres) as $genre_id) {
            
            DB::table('anime_genre')->insert([
                'anime_id' => $anime,
                'genre_id' => $genre_id,
                'created_at' => now()
            ]);
        }

        return redirect()->back()->with('success', 'Anime ajouté avec succès');
        
  
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
        $episodes = $anime->episodes()->paginate(25);
        $strArr = explode(' ', $anime->synopsis);
        $truncated_synopsis = array_reduce($strArr, function($a, $b) { return strlen($a) < 500 ? $a . ' ' . $b : $a;} ) . ' ...';
        return view('admin.animes.show', compact('anime', 'truncated_synopsis', 'episodes'));
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
        $edit_genres = $anime->genres->pluck('id')->toArray();
        return view('admin.animes.edit', compact('anime', 'edit_genres'));
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
 
        $anime = Anime::find($id);
        if ($request->hasFile('image')) {

            $validatedImage = $request->validate(['image' => 'required|image|mimes:jpg,jpeg,png|max:4000']);
            Storage::delete('public/images/'.$anime->image);
            $image_extension = $request->file('image')->extension();
            $image_path = 'public/images';
            $image_name =  uniqid('img_', true);
            $image_fullname = $image_name.'.'.$image_extension;
            $request->file('image')->storeAs($image_path, $image_fullname);
            $anime->update(['image' => $image_fullname]);
        }
        

        $validatedAnime = $request->validate([
            'title' => 'required|string|min:2|max:80|unique:animes,title,'.$id,
            'synopsis' => 'required|string|min:5|max:2000',
            'release_date' => 'required|date',
            'studio' => 'required|string|max:80',
         ]);
        
        
         
         $validatedGenres = $request->validate([
             'genre' => 'required|array',
             'genre.*' => 'required|string|exists:genres,id'
            ]);
      
            $anime = Anime::find($id);
            $anime->update($validatedAnime);
            
        $anime->genres()->sync(Arr::first($validatedGenres));

        return redirect()->back()->with('success', 'Anime modifié avec succès');
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
        foreach($deletes as $delete) {
            Anime::withoutTrashed()->find($delete)->episodes()->delete();
            Anime::withoutTrashed()->find($delete)->delete();
        }
        
        return redirect()->back()->with('success', 'Anime(s) envoyé(s) à la poubelle avec succès');
    }
   
   


    protected function restore()
    {
        $restores = request('restore');

        if(!$restores)
            return redirect()->back();
        foreach($restores as $restore) {
            // Anime::onlyTrashed()->find($restore)->episodes()->restore();
            $this->model::onlyTrashed()->find($restore)->restore();
        }
        
        return redirect()->back()->with('success', 'Anime(s) restauré(s) avec succès');
    }
    
    

    
    
}
