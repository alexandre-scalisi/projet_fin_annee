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
