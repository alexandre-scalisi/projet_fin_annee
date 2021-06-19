<?php

namespace App\Http\Livewire;

use App\Models\Anime;
use App\Models\Vote;
use Livewire\Component;

class Stars extends Component
{
    public $anime;
    public $avg;
    public $star_value;
    public $full_stars;
    public $half_stars;
    public $empty_stars;
    

    public function getNumberOfStars() {
        $this->avg = round(Vote::where('anime_id', $this->anime->id)->avg('vote'), 2);
        $this->full_stars = (int) $this->avg;
        $this->half_stars = ($this->avg - $this->full_stars) >= .5 ? 1 : 0;
        $this->empty_stars = 5 - $this->full_stars - $this->half_stars; 

    }

    public function vote($rating) {
        
        $vote = Vote::updateOrCreate([
            'user_id' => auth()->user()->id,
            'anime_id' => $this->anime->id
        ], [
            'vote' => $rating
        ]); 
      
    }

    public function render()
    {
        
        $this->star_value = 1;
        $this->getNumberOfStars();
        return view('livewire.stars');
    }

}
