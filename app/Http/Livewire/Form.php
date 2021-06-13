<?php

namespace App\Http\Livewire;

use App\Models\Comment as ModelsComment;
use App\Models\Episode;
use Livewire\Component;

class Form extends Component
{
    public $comments;
    public $commentable_type;
    public $commentable_id;
    public $body;
    public $user_id;
    public $listeners = ['refresh'];
    
    public function refresh() {
  
    }

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
        $this->reset('body');
        $this->emitUp('refresh', $this->commentable_type, $this->commentable_id);
    }
    
    
    public function render()
    {
        
        $this->comments = ModelsComment::all();
        
        return view('livewire.form');
    }
}
