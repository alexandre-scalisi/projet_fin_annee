<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Comment extends Component
{
    public $item;
    public $bgColor;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item, $bgColor)
    {
        $this->item = $item;
        $this->bgColor = $bgColor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comment');
    }
}
