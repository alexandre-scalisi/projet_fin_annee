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
        $this->default_order_by = 'email';
        $this->accepted_order_bys = ['email'];
        parent::__construct();
        
    }
    public function index()
    {

        array_push($this->accepted_order_bys, 'created_at', 'email');
        $this->arr['routes'] = $this->getRoutes(['show', 'destroy']);
        return parent::index();
    }

    
}
