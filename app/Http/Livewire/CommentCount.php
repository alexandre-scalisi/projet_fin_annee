<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CommentCount extends Component
{

    public $model;
    public $listeners = ['form_loaded'];
    public $comment_count;

    public function mount() {
        
        $this->calculateCommentCount();
    }

    private function calculateCommentCount() {
        $count = $this->model->comments()->withTrashed()->count();
        $this->model->comments()->each(function($c) use(&$count) {
            $count += $c->comments()->withTrashed()->count();
        });
        $this->comment_count = $count;
    }
 
    public function form_loaded() {
        $this->calculateCommentCount();
    }

    public function render()
    {
        return view('livewire.comment-count');
    }
}
