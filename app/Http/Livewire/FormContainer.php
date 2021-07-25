<?php

namespace App\Http\Livewire;

use App\Models\Anime;
use App\Models\Comment;
use App\Models\Episode;
use Livewire\Component;
use Illuminate\Http\Request;

class FormContainer extends Component
{
    public $max_comments;
    public $initial_comment_quantity;
    public $init_replies_amount;
    public $comment_quantity;
    public $comments;
    public $replies;
    public $type;
    public $type_id;
    public $listeners = ['scrollTop', 'reply_added', 'load_more_comments', 
            'load_more_replies', 'scrollToComment', 'reset_replies_quantity', 'commentDeleted'];

    public function mount() {
        $this->initial_comment_quantity = 10;
        $this->init_replies_amount = 3;
        $this->comment_quantity = $this->initial_comment_quantity;
    }

    public function commentDeleted(){}
    
    public function scrollToComment($id) {}

    public function scrollTop() {}
    
    public function reply_added($commentable_id) {
        $this->replies[$commentable_id]['current_amount']
        = $this->replies[$commentable_id]['count'] + 1;
        $this->emit('scrollToComment', $commentable_id);
    }
    
    public function load_more_replies($id) {
        $this->replies[$id]['current_amount'] += $this->init_replies_amount;
        $this->emit('scrollToComment', $id);
    }
    public function reset_replies_quantity($id) {
        $this->replies[$id]['current_amount'] = $this->init_replies_amount;
        $this->emit('scrollToComment', $id);
    }
    
    public function load_more_comments() {
        $this->comment_quantity += $this->initial_comment_quantity;
    }
    
    public function render()
    {
        if($this->type === 'Episode') {
            $episodes = Episode::find($this->type_id);
            if($episodes != null)
                $this->max_comments = count($episodes->comments); 
                $this->comments = $episodes->comments()->take($this->comment_quantity)->latest()->get(); 

        }
        elseif ($this->type === 'Anime') {
            $episodes = Anime::find($this->type_id);
            if($episodes != null)
                $this->max_comments = count($episodes->comments); 
                $this->comments = $episodes->comments()->take($this->comment_quantity)->latest()->get(); 
        }

        foreach($this->comments as $comment) {
            $this->replies[$comment->id] = [
                'count' => count($comment->comments),
                'current_amount' => $this->replies[$comment->id]['current_amount'] ?? $this->init_replies_amount
            ];
        }

        $this->emit('form_loaded');
        return view('livewire.form-container');
    }
}
