<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tooltip extends Component
{

    public $mainColor;
    public $secondaryColor;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($mainColor, $secondaryColor)
    {
        $this->mainColor = $mainColor;
        $this->secondaryColor = $secondaryColor;
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
