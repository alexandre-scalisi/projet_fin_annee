<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends BaseAdminController
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->model_name = 'Comment';
        parent::__construct();
        
    }
    public function index()
    {

        $arr = $this->counts();
        
        $accepted_order_bys = ['author', 'created_at', 'email'];
        $default_order_by = 'email';
        $arr['objects'] = $this->search($this->model::withoutTrashed(), $accepted_order_bys, $default_order_by);
        $arr['routes'] = $this->getRoutes(['show', 'destroy']);
        
        return view('admin.comments.index', $arr);



    }

    public function show($id) {}

    public function trashed(){}


    public function destroy(){}


    public function forceDelete(){}


    public function restore(){}

}
