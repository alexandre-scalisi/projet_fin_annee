<?php
// TODO FAUT IMPERATIVEMENT RENDRE CA PLUS PROPRE LOOL
namespace App\Http\Livewire;

use App\Models\Anime;
use App\Models\Vote;
use Livewire\Component;

class Stars extends Component
{
    public $anime;
    public $avg;
    public $full_stars;
    public $half_stars;
    public $empty_stars;
    public $user_vote;
    public $user_vote_copy;
    public $total_votes;
    
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
        $this->user_vote = Vote::where(['anime_id' => $this->anime->id, 'user_id' => auth()->user()->id])->first()->vote;
        
    }

    public function render()
    {
        $this->total_votes = $this->anime->votes->count();
        $this->user_vote = Vote::where(['anime_id' => $this->anime->id, 'user_id' => auth()->user()->id])->first()->vote ?? 'Pas de vote';
        $this->getNumberOfStars();
        return view('livewire.stars');
    }
    

}
