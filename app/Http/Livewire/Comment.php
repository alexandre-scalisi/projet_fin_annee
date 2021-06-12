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
    public $user_id;

    protected $rules = [
        'body' => 'required|max:250',
        'commentable_id' => 'required',
        'commentable_type' => 'required',
        'user_id' => 'required'
    ];
    

    public function mount() {
        
    }
    
    public function submit()
    {
        $this->user_id = auth()->user()->id;
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