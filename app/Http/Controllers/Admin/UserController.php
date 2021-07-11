<?php

namespace App\Http\Controllers\Admin;


use App\Actions\Fortify\CreateNewUserWithRole;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class UserController extends BaseAdminController
{
    

    public function __construct()
    {
        $this->model_name = 'User';
        $this->default_order_by = 'email';
        $this->accepted_order_bys=['email'];
        parent::__construct();
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        array_push($this->accepted_order_bys, 'name', 'role', 'created_at');
        $this->arr['routes'] = $this->getRoutes(['show', 'create', 'update', 'destroy']);
        return parent::index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.users.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_create = new CreateNewUserWithRole();
        $user_create->create($request->only('name', 'email', 'password', 'password_confirmation', 'role'));
        return redirect()->back()->with('success', 'Utilisateur créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
      
        $deleteUser = new DeleteUser();
        $deletes = request('delete');
        if(!$deletes)
            return redirect()->back();
        foreach($deletes as $delete) {
            
            $deleteUser->delete(User::withoutTrashed()->find($delete));
        }

        return redirect()->back()->with('success', 'Utilisateur Supprimé avec succès');
    }

    // private function search() {
    //     $order_by = lcfirst(request()->input('order_by', 'email'));
    //     $dir = lcfirst(request()->input('dir', 'asc'));
    //     $accepted_order_bys = ['name', 'email', 'role', 'created_at'];
    //     $accepted_dirs =['asc', 'desc'];
    //     if(!in_array($order_by, $accepted_order_bys))
    //         $order_by = 'email';
    //     if(!in_array($dir, $accepted_dirs))
    //         $dir = 'asc';
      
    //     return User::orderBy($order_by, $dir)->paginate(20);
        
    // }
}
