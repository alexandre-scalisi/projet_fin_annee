<?php

namespace App\Http\Livewire;

use App\Models\Comment as ModelsComment;
use Livewire\Component;

class Comment extends Component
{
    public $item;
    public $bgColor;
    public $reply;

    public function mount($reply = false) {
       
        $this->reply = $reply;
    }

    public function isDifferent() {
        if(!auth()->user())
            return true;
        return $this->item->author->id !== auth()->user()->id;
    }
    

    public function destroy() {
        ModelsComment::destroy($this->item->id);
        $this->emit('commentDeleted');
    }

    public function render()
    {
        
        return view('livewire.comment');
    }
}
