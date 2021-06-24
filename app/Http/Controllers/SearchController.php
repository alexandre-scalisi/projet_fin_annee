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
    private $tab;
    private $tabButtons;
    private $order_by;
    
    public function index(Request $request) {
        
        $this->request = $request;
        
        $this
        ->query()
        ->searchByRating()
        ->searchByGenre()
        ->searchByTab()
        ->searchOrderBy()
        ->searchAll();
        
        return view('search.index', ['array' => $this->array, 'tab' => $this->tab, 'tabButtons' => $this->tabButtons]);
    }
    
    // QueryBuilder
    
    public function query() {
        $q = $this->request->query()['q'] ?? '';
        $this->array = Anime::where('title', 'LIKE', "$q%");
        return $this;
    }
    
    private function searchByRating() {
        if(!isset($this->request['minrating']) || $this->request['minrating'] == 0)
            return $this;
        $request = $this->request['minrating'];
        
        $this->array = $this->array->withAvg('votes', 'vote')->having('votes_avg_vote', '>=', $request);
        return $this;
    }


    private function searchByGenre() {
        if(!isset($this->request['genre']))
            return $this;
        $request = $this->request['genre'];

        $this->array = $this->array->whereHas('genres', function($query) use ($request) {return $query->whereIn('id',$request);});
        return $this;
    }





    

    private function searchByTab() {
        $this->order_by = $this->request->order_by ?? '';
        // $this->order_by = in_array($order_by, ['vote', 'release_date', 'upload_date']) ? $order_by : 'title';
        $this->tab = $this->request->query()['tab'] ?? '';

        switch($this->order_by) {

            
            case 'vote': 
                $this->tabButtons = array_merge(['Tous', 'Pas de vote' ], range(1, 5) );
                if(strtolower($this->tab) === 'pas de vote') {
                   
                    $this->array = $this->array->withCount('votes')->having('votes_count', 0);
                    
                    return $this;
                }

                if((int) $this->tab != 0) {
                    $this->array = $this->array
                                ->withAvg('votes', 'vote')
                                ->having('votes_avg_vote', '>=', (int)$this->tab)
                                ->having('votes_avg_vote', '<', (int)$this->tab + 1);
                }
                

                break;

            case 'release_date':
                
                $year = getDate()['year'];
                dd($this->tab);
                $this->tabButtons = array_merge(['Tous'], range($year,  $year - 10), [$year-11 . '-' . ($year-20)], [$year-21 . '-' . ($year-30)] );
                if($this->tab >= $year - 10) {
                    $query = $this->array->get()->filter(function ($a) {
                        return date('Y', $a->release_date) == $this->tab;
                    });
                    if(count($query) > 0)
                    {
                        $this->array= $query->toQuery();
                    }
                    else {
                        $this->array = $this->array->whereNull('id');
                    }
                }

                // if(in_array($this->tab, range($year-11, $year-19))) {
                //     $query = $this->array->get()->filter(function ($a) {
                //         return date('Y', $a->release_date) = $this->request->tab;
                //     });
                //     if(count($query) > 0)
                //     {
                //         $this->array= $query->toQuery();
                //     }
                //     else {
                //         $this->array = $this->array->whereNull('id');
                //     }
                // }
                
                break;
            
            default:
                $this->tabButtons = array_merge(['Tous', 'Autres'], range('a','z'));
                if(strtolower($this->tab) === 'autres') {
                    $this->array = $this->array->where('title', 'regexp', '^[0-9]');
                    return $this;
                }
                if(!in_array(strtolower($this->tab), $this->tabButtons)) {
        
                    $this->tab = '';
                }
                $this->array = $this->array->where('title', 'LIKE', "$this->tab%");
                break;
            }
            
            
            
            
            
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
                        return $anime->votes->count() > 0 ? (int)$anime["votes_avg_vote"] : 'Pas de vote' ;
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
                                    return preg_match('/[a-zA-Z]/',$anime['title'][0]) ? $anime['title'][0] : 'Autres';
                                });
                                
                break;
        }
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


    //Helpers


    private function checkRangeTab() {

        $tab = $this->request->tab;
        if(!$tab || strlen($tab) === 0)
            return false;
        $range = explode('-', $tab);
        if(count($range) != 2 || !h_is_integer($range[0], false) && !h_is_integer($range[1], false))
            return false;
        if($range[0] > $range[1]) 
            return false;
        return true;
       
        
    }

}
