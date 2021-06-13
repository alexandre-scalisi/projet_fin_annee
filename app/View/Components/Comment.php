<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Comment extends Component
{
    public $item;
    public $bgColor;
    public $reply;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item, $bgColor, $reply = false)
    {
        
        $this->reply = $reply;
        $this->item = $item;
        $this->bgColor = $bgColor;
    }

    public function is_different() {
        return $this->item->author->id !== auth()->user()->id;
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
