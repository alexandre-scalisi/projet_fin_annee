<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
class SearchController extends Controller
{
    public function index(Request $request) {
        
        // $animes = Anime::orderBy('title')->get()->groupBy(function($anime) {return preg_match('/[a-zA-Z]/',$anime['title'][0]) ? $anime['title'][0] : 'autres';});
        $animes = Anime::orderBy('title')->get()->groupBy(function($anime) {return preg_match('/[a-zA-Z]/',$anime['title'][0]) ? $anime['title'][0] : 'autres';})->toArray();

        
        
        $mapped = [];
        foreach($animes as $l => $anime) {
            $mapped[]=$l;
            $mapped[]=$anime;
        }    
        
        // dd($mapped);
        $animes = Arr::flatten($mapped, 1);
        
        
        
        
        $total = count($animes);
        $per_page= 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $array = array_slice($animes, $starting_point, $per_page, true);
        $array = new LengthAwarePaginator($array, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        return view('search.index', compact('animes', 'array'));
    }

    public function show() {

    }



}
