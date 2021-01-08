<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller 
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }    

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */    
    public function create()
    {
        $user   = new User;
        $roles  = Role::get()->pluck('nama', 'id');        
        return view('admin.users.create', compact('user', 'roles'));
    }    
    
    public function store(Request $request)
    {
        $data                = $request->all();

        $validator_create = $this->validateOnCreate($data);
        if ($validator_create->fails()) {
            Session::flash('message', trans('global.save_error'));
            Session::flash('alert-class', 'alert-warning');

            return Redirect::back()->withErrors($validator_create)->withInput();
        }

        $user     = new User();
        $this->setAttributes($user, $data);
        if ($user->save()) {
            Session::flash('message', trans('global.save_success'));
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', trans('global.save_failed'));
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect()->route('admin.users.show', $user->id);
    }


    /**
     * Show the form for editing User.
     *
     * @return \Illuminate\Http\Response
     */    
    public function edit(User $user)
    {
        $roles = Role::get()->pluck('nama', 'id');
        return view('admin.users.create', compact('user', 'roles'));
    }        

    public function update(Request $request, User $user)
    {
        $data      = $request->all();
        $validator = $this->validateForm($data);
        if ($validator->fails()) {
            Session::flash('message', trans('global.save_error'));
            Session::flash('alert-class', 'alert-warning');

            return Redirect::back()->withErrors($validator)->withInput();
        }

        $this->setAttributes($user, $data);
        if ($user->save()) {
            Session::flash('message', trans('global.save_success'));
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', trans('global.save_failed'));
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect()->route('admin.users.show', $user->id);
    }


    /**
     * Display User.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */    
    public function show(User $user)
    {        
        return view('admin.users.show', compact('user'));
    }

    /**
     * Remove User from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }


    private function validateForm($data)
    {
        return Validator::make($data, [
            'username'     => 'required|string|min:5|max:12',
            'email'        => 'required|string|email|max:255',
            'password'     => 'required|string|min:5|max:12|confirmed',
            'role_id'      => 'required',
            'name'         => 'required_unless:role_id,1'
        ]);
    }
    
    private function validateOnCreate($data)
    {
        return Validator::make($data, [
            'username'     => 'required|string|min:5|max:12|unique:users',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:5|max:12|confirmed',
            'role_id'      => 'required',
            'name'         => 'required_unless:role_id,1'
        ]);
    }

    private function setAttributes($user, $data)
    {
        $user->username         = $data['username'];
        $user->name             = $data['name'];
        $user->email            = $data['email'];
        $user->password         = Hash::make($data['password']);       
        $user->role_id          = $data['role_id'];
        if($data['role_id'] == 1){
            $user->is_admin          = 1;
        } else {
            $user->is_admin          = 0;
        }
    }    

}
