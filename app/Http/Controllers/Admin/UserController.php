<?php

namespace App\Http\Controllers\Admin;


use App\Actions\Fortify\CreateNewUserWithRole;
use App\Actions\Fortify\UpdateUserPasswordWithRole;
use App\Actions\Fortify\UpdateUserProfileInformationWithRole;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Rules\Password;
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
        $this->arr['routes'] = $this->getRoutes(['show', 'create', 'edit', 'destroy']);
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
        $validatedPhoto = $request->validate([
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);
        
        $user = $user_create->create($request->only('name', 'email', 'password', 'password_confirmation', 'role'));
        $user->updateProfilePhoto($request->file('photo'));
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
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
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
        $user = User::find($id);
        Validator::make($request->only('name', 'email', 'current_password'), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['required', 'string', new Password],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
        ])->after(function ($validator) use ($user) {
            if (! request('current_password') || ! Hash::check(request('current_password'), $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validate();


        if(request('password')) {
            $user_update_password = new UpdateUserPasswordWithRole();
            $user_update_password->update($user, $request->only('password', 'password_confirmation', 'role', 'current_password'));
        }
        
        $user_update_profile = new UpdateUserProfileInformationWithRole();
        $user_update_profile->update($user, $request->only('name', 'photo', 'email', 'role'));

        return redirect()->back()->with('success', 'Utilisateur créé avec succès');
    }

    
 
}
