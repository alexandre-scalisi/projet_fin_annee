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
        
        $array = [];
        $letter = $request->query('l', 'tous');

        if($letter === "tous") {
            $array = $this->searchAll($request);
        return view('search.index', compact('array'));
        }
        // else {
        //     $array = $this->searchByLetter($letter);
        // }
        
        
        


        return view('search.indexcopy', compact('array'));
    }

    public function show() {

    }

    private function searchAll(Request $request) {
        $animes = Anime::orderBy('title')->get()->groupBy(function($anime) {return preg_match('/[a-zA-Z]/',$anime['title'][0]) ? $anime['title'][0] : 'autres';})->toArray();
        $mapped = [];
        foreach($animes as $l => $anime) {
            $mapped[]=$l;
            $mapped[]=$anime;
        }    
        
        // dd($mapped);
        $animes = Arr::flatten($mapped, 1);
        
        
        
        
        $total = count($animes);
        $per_page= 30;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $array = array_slice($animes, $starting_point, $per_page, true);
        $array = new LengthAwarePaginator($array, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        return $array;
    }

    private function searchByLetter($letter) {
        $array = Anime::orderBy('title')->where('title', 'LIKE', "$letter%")->paginate(20);
        return $array;
    }

    private function orderByDate() {
        $array = Anime::orderBy('release_date', 'desc');
        return $array;
    }



}
