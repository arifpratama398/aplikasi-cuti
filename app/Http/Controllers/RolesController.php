<?php

namespace App\Http\Controllers;

use App\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RolesController extends Controller 
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }    

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */    
    public function create()
    {
        $role = new Role;
        return view('admin.roles.create', compact('role'));
    }    
    
    public function store(Request $request)
    {
        $data                = $request->all();
        $validator = $this->validateForm($data);
        if ($validator->fails()) {
            Session::flash('message', trans('global.save_error'));
            Session::flash('alert-class', 'alert-warning');

            return Redirect::back()->withErrors($validator)->withInput();
        }

        $role     = new Role();
        $this->setAttributes($role, $data);
        if ($role->save()) {
            Session::flash('message', trans('global.save_success'));
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', trans('global.save_failed'));
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect()->route('admin.roles.show', $role->id);
    }


    /**
     * Show the form for editing Role.
     *
     * @return \Illuminate\Http\Response
     */    
    public function edit(Role $role)
    {
        return view('admin.roles.create', compact('role'));
    }        

    public function update(Request $request, Role $role)
    {
        $data                = $request->all();
        $validator = $this->validateForm($data);
        if ($validator->fails()) {
            Session::flash('message', trans('global.save_error'));
            Session::flash('alert-class', 'alert-warning');

            return Redirect::back()->withErrors($validator)->withInput();
        }

        $this->setAttributes($role, $data);
        if ($role->save()) {
            Session::flash('message', trans('global.save_success'));
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', trans('global.save_failed'));
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect()->route('admin.roles.show', $role->id);
    }


    /**
     * Display Role.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */    
    public function show(Role $role)
    {        
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Remove Role from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */    
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index');
    }


    private function validateForm($data)
    {
        return Validator::make($data, [
            'nama'           => 'required',
        ]);
    }    

    private function setAttributes($role, $data)
    {
        $role->nama                      = $data['nama'];
    }    

}
