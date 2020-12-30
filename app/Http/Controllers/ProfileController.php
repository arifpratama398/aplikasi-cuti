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
        $profile = Karyawan::firstWhere('user_id', auth()->user()->id);
        return view('common.profile.index', compact('profile'));
    }
}
