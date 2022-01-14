<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->model_name = 'Genre';
        parent::__construct();
        $this->default_order_by = 'name';
        $this->accepted_order_bys=['name'];
        
    }

    public function index()
    {     
        
        array_push($this->accepted_order_bys, 'release_date', 'created_at', 'vote', 'episodes');
        $this->arr['routes'] = $this->getRoutes(['show', 'create', 'edit', 'destroy']);
        return parent::index();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:80|unique:genre,name'
        ]);

        $genre = Genre::create($validated);
        return redirect()->back()->with('success', 'Genre ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genre = Genre::find($id);
        $animes = $genre->animes()->paginate(15);
        return view('admin.genres.show', compact('genre', 'animes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genre = Genre::find($id);

        return view('admin.genres.edit', compact('genre'));
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
        $genre = Genre::find($id);

        $validated = $request->validate([
            'name' => 'required|string|min:2|max:80|unique:genres,name,'.$id,
        ]);

        $genre->update($validated);

        return redirect()->back()->with('success', 'Genre modifié avec succès');

    }

    
   

}