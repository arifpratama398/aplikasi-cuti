<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Karyawan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class KaryawanController extends Controller 
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('admin.karyawan.index', compact('karyawan'));
    }    

    /**
     * Show the form for creating new Karyawan.
     *
     * @return \Illuminate\Http\Response
     */    
    public function create()
    {
        $karyawan   = new Karyawan;
        $roles  = Role::where('id', '!=', 1)->get()->pluck('nama', 'id');        
        return view('admin.karyawan.create', compact('karyawan', 'roles'));
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

        $karyawan     = new Karyawan();
        $data['user_id'] = $this->setUserGetId($data);
        $this->setAttributes($karyawan, $data);
        if ($karyawan->save()) {
            Session::flash('message', trans('global.save_success'));
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', trans('global.save_failed'));
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect()->route('admin.karyawan.show', $user->id);
    }


    /**
     * Show the form for editing Karyawan.
     *
     * @return \Illuminate\Http\Response
     */    
    public function edit(Karyawan $karyawan)
    {
        return view('admin.karyawan.create', compact('karyawan'));
    }        

    public function update(Request $request, Karyawan $karyawan)
    {
        $data                = $request->all();
        $validator = $this->validateForm($data);
        if ($validator->fails()) {
            Session::flash('message', trans('global.save_error'));
            Session::flash('alert-class', 'alert-warning');

            return Redirect::back()->withErrors($validator)->withInput();
        }
        $this->setAttributes($karyawan, $data);
        if ($karyawan->save()) {
            Session::flash('message', trans('global.save_success'));
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', trans('global.save_failed'));
            Session::flash('alert-class', 'alert-danger');
        }

        if(auth()->user()->isKaryawan())
            return redirect()->route('user.profile');
        elseif(auth()->user()->isAdmin())    
            return redirect()->route('admin.karyawan.show', $karyawan->id);
    }


    /**
     * Display Karyawan.
     *
     * @param Karyawan $karyawan
     * @return \Illuminate\Http\Response
     */    
    public function show(Karyawan $karyawan)
    {        
        return view('admin.karyawan.show', compact('karyawan'));
    }

    /**
     * Remove Karyawan from storage.
     *
     * @param Karyawan $karyawan
     * @return \Illuminate\Http\Response
     */    
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('admin.karyawan.index');
    }


    private function validateForm($data)
    {
        return Validator::make($data, [
            'name'              => 'required',
            'nomor_karyawan'    => 'required',
            'alamat'            => 'required',
            'no_telp'           => 'required',
            'jenis_kelamin'     => 'required',
            'agama'             => 'required'
        ]);
    }    

    private function setAttributes($karyawan, $data)
    {
        $karyawan->nomor_karyawan   = $data['nomor_karyawan'];
        $karyawan->name             = $data['name'];
        $karyawan->alamat           = $data['alamat'];
        $karyawan->no_telp          = $data['no_telp'];
        $karyawan->jk_id            = ($data['jenis_kelamin'] == 'L' ? 1 : 2);
        $karyawan->agama_id         = $data['agama'];
        $karyawan->created_by              = $karyawan->exists ? $karyawan->created_by : auth()->id();
        $karyawan->updated_by              = auth()->id();
    }

    private function setUserGetId($data)
    {
        $user = User::create([
            'username'   => $data['username'],
            'name'       => $data['username'],
            'email'      => $data['email'],
            'password'   => $data['password'],
            'role_id'    => $data['role_id'],
            'is_admin' => 0
        ]);

        return $user->id;
    }
}
