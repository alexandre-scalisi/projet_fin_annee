<?php

namespace App\Http\Livewire;

use App\Models\Anime;
use Livewire\Component;

class FollowButton extends Component
{
    public $text;
    public $anime;

    public function mount(Anime $anime) {
        $this->anime = $anime;
        $this->text = in_array(auth()->user()->id, $this->anime->registeredUsers->pluck('id')->toArray()) ? 'Ne plus suivre' : 'Suivre';
    }

    public function follow() {
        
        if(in_array(auth()->user()->id, $this->anime->registeredUsers->pluck('id')->toArray())) {

            $this->anime->registeredUsers()->detach(auth()->user());
        }
        else
            $this->anime->registeredUsers()->attach(auth()->user());
    }

    public function render()
    {
        $this->text = in_array(auth()->user()->id, $this->anime->registeredUsers->pluck('id')->toArray()) ? 'Ne plus suivre' : 'Suivre';
        return view('livewire.follow-button');
    }
}
