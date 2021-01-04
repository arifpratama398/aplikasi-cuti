<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cuti;

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
        $user = User::orderBy('created_at','desc')->get();
        $cuti = Cuti::whereNull('cuti.status_1')
            // not confirmed by HR
            ->whereNull('cuti.status_2')
            // show latest data.
            ->orderBy('cuti.created_at','desc')
            ->get(['cuti.*']);
        return view('admin.dashboard.index', compact(['user', 'cuti']));
    }    
}
