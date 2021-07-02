<?php

namespace App\View\Components;

use App\Models\Genre;
use Illuminate\View\Component;

class GenreModal extends Component
{
    public $genres;
    public $checkedGenres;
    public $editGenres;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($editGenres = null)
    {
        $this->editGenres = $editGenres;
        $this->genres = Genre::all();
        $this->checkedGenres = [];
        if(!request()->genre) return;
        $this->checkedGenres = Genre::whereIn('id', request()->genre)
                                    ->get()
                                    ->map(function ($a) {
                                        return $a->id;
                                    })->toArray();
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
