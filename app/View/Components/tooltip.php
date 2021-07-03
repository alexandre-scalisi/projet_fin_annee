<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tooltip extends Component
{
    public $left;
    public $top;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($left = 0, $top= '-20px')
    {
        $this->left = $left;
        $this->top = $top;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tooltip');
    }
}
