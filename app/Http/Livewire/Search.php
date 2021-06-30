<?php

namespace App\Http\Livewire;

use App\Models\Anime;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $results;

    public function mount() {
        

        
    //     $result = Anime::orderBy('title')->paginate();
    //     $sorted_result =$result->getCollection()->sort(function($a, $b) {
    //             return $a->title[0] !== 'A';  
    //    })->values();


    }
    public function test() {
        
        $array_words = explode(' ', $this->search);
        $new = collect($array_words)->reduce(function($a, $b) {
            return $a . "%$b%";
        });
        if($this->search === '')
            return;
        // if(empty($this->search))
            // return;
        $first_letter = $this->search[0] ?? '';
    //    $this->results = Anime::orderBy('title', 'asc')->where('title','LIKE',$new)->take(5)->get();
       $this->results = Anime::orderBy('title')->where('title', 'LIKE', $new)->get()->sort(function($a, $b) use( $first_letter ) {
        // return $a[0]->title[0] !== "A";
        return ucfirst($a->title[0]) !== ucfirst($first_letter);
    })->take(5);
    }

    public function render()
    {
        return view('livewire.search');
    }
}
