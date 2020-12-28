<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller 
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {        
        $user = User::get();
        return view('admin.dashboard.index', compact('user'));
    }    
}
