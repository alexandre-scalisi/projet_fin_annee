<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;

class Stars extends Component
{
    public $anime_id;
    public $stars_infos;
    public $color;
    public $text_size;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($animeId, $textSize, $color )
    {
        $this->color = $color;

        $this->text_size = $textSize;
        $this->anime_id = $animeId;
        $this->stars_infos = h_calculateStars($this->anime_id);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stars');
    }
}
