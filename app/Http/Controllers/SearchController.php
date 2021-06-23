<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
class SearchController extends Controller
{
    private $request;
    private $array;
    private $letter;

    public function index(Request $request) {

        $this->request = $request;
        $this
            ->query()
            ->searchByRating()
            ->searchByGenre()
            ->searchByLetter()
            ->searchOrderBy()
            ->searchAll();
            $array = $this->array;

        return view('search.index', compact('array'));
    }

    public function show() {

    }

    public function query() {
        $q = $this->request->query()['q'] ?? '';
        $this->array = Anime::where('title', 'LIKE', "%$q%");
        return $this;
    }

    private function searchAll() {

        $animes = $this->array;

        $mapped = [];
        foreach($animes as $l => $anime) {
            $mapped[]=$l;
            $mapped[]=$anime;
        }    
        
        $animes = Arr::flatten($mapped, 1);
        
        
        $request = $this->request;
        
        $total = count($animes);
        $per_page= 30;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $array = array_slice($animes, $starting_point, $per_page, true);
        $this->array = new LengthAwarePaginator($array, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return $this;
    }

    private function searchByLetter() {
        $this->letter = '';
        $l = $this->request->query()['l'] ?? '';

        if($l === 'autres') {
            $this->array = $this->array->where('title', 'regexp', '^[0-9]');
            return $this;
        }

        if(preg_match('/^[a-zA-Z]$/', $l)) {
            $this->letter = $l;
        }
        $this->array = $this->array->where('title', 'LIKE', "$this->letter%");
        return $this;
    }



   

    private function searchOrderBy() {
        $order_by = $this->request->order_by ?? '';
        $d = $this->request->d != null && $this->request->d === 'on' ? false : true; 
        $order_by = in_array($order_by, ['vote', 'release_date', 'upload_date']) ? $order_by : 'title';
        switch($order_by) {
            case 'vote': 
                
                $this->array = $this->array
                    ->withAvg('votes', 'vote')
                    ->orderBy('votes_avg_vote', $d ? 'desc' : 'asc')
                    ->get()
                    ->groupBy(function ($anime) {
                        return (int)$anime["votes_avg_vote"];
                    });

                break;
            case 'release_date': 
                $this->array = $this->array->
                orderBy('release_date', $d ? 'desc' : 'asc' )
                ->get()
                ->groupBy(function ($anime) {
                    return date('F Y', $anime->release_date);
                });

                break;
            case 'upload_date': 
                $this->array = $d ? $this->array->latest() : $this->array->oldest();
                break;
            default:
                $this->array = $this->array
                                ->orderBy('title', $d ? 'asc' : 'desc')
                                ->get()
                                ->groupBy(function($anime) {
                                    return preg_match('/[a-zA-Z]/',$anime['title'][0]) ? $anime['title'][0] : 'autres';
                                });
                                
                break;
        }
        return $this;
    }

    private function searchByGenre() {
        if(!isset($this->request['genre']))
            return $this;
        $request = $this->request['genre'];

        $this->array = $this->array->whereHas('genres', function($query) use ($request) {return $query->whereIn('id',$request);});
        return $this;
    }

    private function searchByRating() {
        if(!isset($this->request['minrating']) || $this->request['minrating'] == 0)
            return $this;
        $request = $this->request['minrating'];
        
        $this->array = $this->array->withAvg('votes', 'vote')->having('votes_avg_vote', '>=', $request);
        return $this;
    }

    private function orderByVotesAvg() {
        return Anime::withAvg('votes', 'vote')->orderBy('votes_avg_vote')->paginate(20);
    }

    private function orderByTitle() {
        return Anime::orderBy('title')->paginate(20);
    }

    private function orderByDate() {
        $array = Anime::orderBy('release_date', 'desc');
        return $array;
    }

    private function orderByUploadedAt() {

        return Anime::oldest()->paginate(20);
    }


}
