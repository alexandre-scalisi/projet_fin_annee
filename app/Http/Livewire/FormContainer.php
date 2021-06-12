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
    public $initial_replies_quantity;
    public $comment_quantity;
    public $comments;
    public $replies;
    public $type;
    public $type_id;
    public $listeners = ['refresh', 'load_more_comments'];

    public function mount() {
        $this->initial_comment_quantity = 10;
        $this->initial_replies_quantity = 3;
        $this->comment_quantity = $this->initial_comment_quantity;
        // dd($this->comment_quantity);
    }
    

    public function refresh() {
        // $replies
    }

    public function load_more_replies($id) {
        $this->replies[$id] += $this->initial_replies_quantity;
    }
    public function reset_replies_quantity($id) {
        $this->replies[$id] = $this->initial_replies_quantity;
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
            $this->comments = Anime::find($this->type_id)->comments()->take($this->comment_quantity)->paginate(1)->get();
        }

        foreach($this->comments as $comment) {
            $comment_id = $comment->id;
            $this->replies[$comment_id] = $this->replies[$comment_id] ?? $this->initial_replies_quantity;
        }
        // $this->replies = $this->comments->mapWithKeys(function($comms) {
        //     return [$comms['id']=>3];
        // });

        return view('livewire.form-container');
    }
}
