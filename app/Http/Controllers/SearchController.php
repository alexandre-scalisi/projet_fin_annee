<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index() {


        
        $animes = Anime::orderBy('title')->get()->groupBy(function($anime) {return preg_match('/[a-zA-Z]/',$anime['title'][0]) ? $anime['title'][0] : 'autres';});

        // dd($time_end - $time_start);
        return view('search.index', compact('animes'));
    }

    public function show() {

    }


}
