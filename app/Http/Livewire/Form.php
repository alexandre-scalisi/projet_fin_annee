<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Episode;
use Livewire\Component;
use Illuminate\Http\Request;

class Form extends Component
{
    public $comments;
    public $episode_id;
    public $count = 0;
    public $key;
    public $listeners = ['refresh'];
    
    public function refresh() {
  
    }

    public function render()
    {

        $this->comments = Episode::find($this->episode_id)->comments;
        return view('livewire.form');
    }
}
