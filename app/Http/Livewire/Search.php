<?php

namespace App\Http\Livewire;

use App\Models\Anime;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $results;

    public function test() {
       $this->results = Anime::orderBy('title', 'asc')->where('title','LIKE',$this->search.'%')->take(5)->get();
    }

    public function render()
    {
        return view('livewire.search');
    }
}
