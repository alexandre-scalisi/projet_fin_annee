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
    public $parent_id;

    protected $rules = [
        'body' => 'required|max:250',
        'commentable_id' => 'required',
        'commentable_type' => 'required',
        'user_id' => 'required',
    ];
    

    public function mount($parent_id=null) {
        $this->parent_id = $parent_id;

    }
    
    public function submit()
    {
        $this->user_id = auth()->user()->id;
        $validated_data = $this->validate();
        $model = ModelsComment::create($validated_data);
        $this->reset('body');
        if($this->commentable_type === "App\Models\Comment") {
            $model->update(['parent_id' => $this->parent_id ?? $this->commentable_id]);
            $this->emit('reply_added', $this->commentable_id);
        } else {
            $this->emit('scrollTop');
        }
    }
    
    
    public function render()
    {
        
        $this->comments = ModelsComment::all();
        
        return view('livewire.form');
    }
}
