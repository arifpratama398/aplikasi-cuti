<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Karyawan;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Session;

class ProfileController extends Controller 
{
    public function profile(){
        $profile = User::join('karyawan','karyawan.user_id','=','users.id')
            ->join('roles','roles.id','=','users.role_id')
            ->join('ref_agama','ref_agama.id','=','karyawan.agama_id')
            ->where('users.id', Auth::id())
            ->first(['roles.name as role','karyawan.*','users.email', 'ref_agama.name as agama']);

        return view('common.profile.index', compact('profile'));
    }
}
