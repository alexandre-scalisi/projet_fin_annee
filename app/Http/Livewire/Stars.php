<?php
// TODO FAUT IMPERATIVEMENT RENDRE CA PLUS PROPRE LOOL
namespace App\Http\Livewire;

use App\Models\Anime;
use App\Models\Vote;
use Livewire\Component;

class Stars extends Component
{
    public $anime;
    public $user_vote;
    public $stars_infos;

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
        $this->user_vote = Vote::where(['anime_id' => $this->anime->id, 'user_id' => auth()->user()->id])->first()->vote ?? 'Pas de vote';
        //helper (app/Helpers)
        $this->stars_infos = calculateStars($this->anime->id);
        return view('livewire.stars');
    }
    

}
