<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\AnimeGenre;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $animes = $this->search(Anime::withoutTrashed());
        $type = 'Anime';
        $withoutTrashedCount = Anime::all()->count();
        $trashedCount = Anime::onlyTrashed()->count();
              
        return view('admin.animes.index', compact('animes', 'type', 'withoutTrashedCount', 'trashedCount'));
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
            // dd($validatedGenres);
            $anime = Anime::find($id);
            $anime->update($validatedAnime);
            
        $anime->genres()->sync(Arr::first($validatedGenres));
        // $anime = DB::table('animes')->updateGetId(array_merge($validatedAnime, ['updated_at' => now()]));

        // foreach(Arr::first($validatedGenres) as $genre_id) {
            
        //     DB::table('anime_genre')->update([
        //         'anime_id' => $anime,
        //         'genre_id' => $genre_id,
        //         'created_at' => now()
        //     ]);
        // }

        return redirect()->back()->with('success', 'Anime modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Anime::find($id)->delete();
        return redirect()->back()->with('success', 'Anime envoyé à la poubelle avec succès');
    }
    public function restore($id)
    {
        Anime::onlyTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Anime restauré avec succès');
    }
    public function forceDelete($id)
    {
        Anime::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Anime définitivement supprimé avec succès');
    }

    public function trashed() {
        $animes = $this->search(Anime::onlyTrashed());
        $type = 'Anime';
        $withoutTrashedCount = Anime::all()->count();
        $trashedCount = Anime::onlyTrashed()->count();
              
        return view('admin.animes.trashed', compact('animes', 'type', 'withoutTrashedCount', 'trashedCount'));
    }

    
    private function search($animes) {
        
        $order_by = lcfirst(request()->input('order_by', 'title'));
        $dir = lcfirst(request()->input('dir', 'asc'));
        $accepted_order_bys = ['title', 'release_date', 'created_at', 'vote', 'episodes', 'deleted_at'];
        $accepted_dirs =['asc', 'desc'];
        if(!in_array($order_by, $accepted_order_bys))
            $order_by = 'title';
        if(!in_array($dir, $accepted_dirs))
            $dir = 'asc';
        if($order_by === 'vote') {
            
            return $animes->withAvg('votes', 'vote')->orderBy('votes_avg_vote', $dir)->paginate(20);

        }
        else if($order_by == "episodes") {
            return $animes->withCount('episodes')->orderBy('episodes_count', $dir)->paginate(20);
        }
        
      
        return $animes->orderBy($order_by, $dir)->paginate(20);
        
    }

    
}
