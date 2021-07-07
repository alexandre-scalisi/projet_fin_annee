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
        $objects = $this->search();
        $type = 'Comment';
        $withoutTrashedCount = Comment::all()->count();
        $trashedCount = Comment::onlyTrashed()->count();
        
        $routes = [
            'index' => route('admin.comments.index'),
            'trash' => route('admin.comments.trashed'),
            'show' => 'admin.comments.show',
            'destroy' => 'admin.animes.destroy'
        ];
        
              
        return view('admin.comments.index', compact('objects', 'type', 'withoutTrashedCount', 'trashedCount', 'routes'));

    }

    public function show($id) {}

    public function trashed(){}


    public function destroy(){}


    public function forceDelete(){}


    public function restore(){}



    private function search() {
        $order_by = lcfirst(request()->input('order_by', 'created_at'));
        $dir = lcfirst(request()->input('dir', 'desc'));
        $accepted_order_bys = ['author', 'created_at'];
        $accepted_dirs =['asc', 'desc'];
        if(!in_array($order_by, $accepted_order_bys))
        $order_by = 'created_at';
        
        if(!in_array($dir, $accepted_dirs))
        $dir = 'asc';
        if($order_by == 'author')
        
        return Comment::join('users', 'users.id', '=', 'comments.user_id' )->
        orderBy('users.email', $dir)
        ->paginate(20);
        
        
        return Comment::orderBy($order_by, $dir)->paginate(20);
        
    }
}
