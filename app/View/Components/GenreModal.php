<?php

namespace App\View\Components;

use App\Models\Genre;
use Illuminate\View\Component;

class GenreModal extends Component
{
    public $genres;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->genres = Genre::all();
    }

    public function checked ($id) {
       
        if(!request()->genre) return false;
        if(!in_array($id, request()->genre)) return false;
        
        return true;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.genre-modal');
    }

}
