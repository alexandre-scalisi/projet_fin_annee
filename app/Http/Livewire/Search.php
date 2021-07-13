<?php

namespace App\Http\Livewire;

use App\Models\Anime;
use Illuminate\Support\Arr;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $results;

    
    public function test() {
       

        $array_words = explode(' ', $this->search);
        $new = collect($array_words)->reduce(function($a, $b) {
            return $a . "%$b%";
        });
        if($this->search === '')
            return;

        $first_letter = $this->search[0] ?? '';
        $collections = Anime::where('title', 'LIKE', "%$new%")->get()->groupBy(function($a) use($first_letter){
           
            return ucfirst($a->title[0]) === ucfirst($first_letter);
        });

        $firstLetterCollection = $collections[1] ?? collect([]);
        $restCollection = $collections[0] ?? collect([]);
        
        if(empty($restCollection)) {
            $this->results = [];
            return;
        }
        $restCollection = $restCollection->sortBy('title');
    
        if(!empty($firstLetterCollection)) 
            $firstLetterCollection = $firstLetterCollection->sortBy('title');

        $this->results = $firstLetterCollection->merge($restCollection)->take(6);


     return;
        $array_words = explode(' ', $this->search);
        $new = collect($array_words)->reduce(function($a, $b) {
            return $a . "%$b%";
        });
        if($this->search === '')
            return;
        // if(empty($this->search))

    }

    public function render()
    {
        return view('livewire.search');
    }
}
