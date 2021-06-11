<?php

namespace App\Http\Livewire;

use App\Models\Comment as ModelsComment;
use App\Models\Episode;
use Livewire\Component;

class Comment extends Component
{
    public $comments;
    public $commentable_type;
    public $commentable_id;
    public $body;
    public $episode_id;

    protected $rules = [
        'body' => 'required|max:100',
        'commentable_id' => 'required',
        'commentable_type' => 'required'
    ];
    

    public function mount() {
        
    }
    
    public function submit()
    {
        $validated_data = $this->validate();
        ModelsComment::create($validated_data);
        $this->emitUp('refresh');
    }
    
    
    public function render()
    {
        
        $this->comments = ModelsComment::all();
        
        return view('livewire.comment');
    }
}
