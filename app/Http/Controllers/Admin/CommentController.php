<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $comments = $this->search();
        return view('admin.comments.index', compact('comments'));
    }

    private function search() {
        $order_by = lcfirst(request()->input('order_by', 'author'));
        $dir = lcfirst(request()->input('dir', 'asc'));
        $accepted_order_bys = ['author', 'title', 'created_at'];
        $accepted_dirs =['asc', 'desc'];
        if(!in_array($order_by, $accepted_order_bys))
            $order_by = 'author';
        
        if(!in_array($dir, $accepted_dirs))
            $dir = 'asc';
        if($order_by = 'author')
            
            return Comment::join('users', 'users.id', '=', 'comments.user_id' )->
                orderBy('users.email', $dir)
                ->paginate(20);
            
       
        return Comment::orderBy($order_by, $dir)->paginate(20);
        
    }
}
