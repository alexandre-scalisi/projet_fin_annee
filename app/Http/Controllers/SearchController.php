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

    public function index(Request $request) {
        $this->request = $request;
        
        $this->query()
             ->searchOrderBy()
             ->searchByRating();
        
        $array = $this->array->paginate(20);

        return view('search.indexcopy', compact('array'));
    }

    public function show() {

    }

    public function query() {
        $q = $this->request->query()['q'] ?? '';
        $this->array = Anime::where('title', 'LIKE', "%$q%");
        
        return $this;
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

   

    private function searchOrderBy() {
        $order_by = $this->request->order_by ?? '';
        $d = $this->request->d != null && $this->request->d === 'on' ? false : true; 
        $order_by = in_array($order_by, ['vote', 'release_date', 'upload_date']) ? $order_by : 'title';
        switch($order_by) {
            case 'vote': 
                $this->array = $this->array->withAvg('votes', 'vote')->orderBy('votes_avg_vote', $d ? 'desc' : 'asc');
                break;
            case 'release_date': 
                $this->array = $this->array->orderBy('release_date', $d ? 'desc' : 'asc' );
                break;
            case 'upload_date': 
                $this->array = $d ? $this->array->latest() : $this->array->oldest();
                break;
            default:
                $this->array = $this->array->orderBy('title', $d ? 'asc' : 'desc');
        }
        return $this;
    }

    private function searchByGenre($request) {
        $array = Anime::whereHas('genres', function($query) use ($request) {return $query->whereIn('id',$request->genre);})->paginate(20);
        return $array;
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
        dd($this->array);
        return Anime::oldest()->paginate(20);
    }


}
