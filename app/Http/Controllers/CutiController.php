<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cuti = Null;
        $role = Auth::user()->role_id;

        switch($role) {
            case 2:
                $cuti = Cuti::where('cuti.status_1', 1)->whereNull('cuti.status_2')
                    ->orderBy('cuti.created_at','desc')->get();
                break;
            case 3:
                $cuti = Cuti::whereNull('cuti.status_1')
                    ->whereNull('cuti.status_2')
                    ->orderBy('cuti.created_at','desc')->get();
                break;
            default:
                $cuti = Cuti::where('karyawan_id', auth()->user()->karyawan->id)                
                // ->where('cuti.status_1', 1)->whereNull('cuti.status_2')
                ->orderBy('cuti.created_at','desc')->get();
        }
        
        return view('admin.cuti.index', compact('cuti','role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cuti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data      = $request->all();
        $validator = $this->validateForm($data);
        if ($validator->fails()) {
            Session::flash('message', trans('global.save_error'));
            Session::flash('alert-class', 'alert-warning');

            return Redirect::back()->withErrors($validator)->withInput();
        }

        $cuti     = new Cuti();
        // $data['user_id'] = $this->setUserGetId($data);
        $this->setAttributes($cuti, $data);
        if ($cuti->save()) {
            Session::flash('message', trans('global.save_success'));
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', trans('global.save_failed'));
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect()->route('cuti.index');
    }

    private function setAttributes($cuti, $data)
    {
        $cuti->karyawan_id      = auth()->user()->karyawan->id;
        $cuti->tgl_mulai        = $data['start_date'];
        $cuti->tgl_selesai      = $data['finish_date'];
        $cuti->deskripsi        = $data['description'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function show(Cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuti $cuti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuti $cuti)
    {
        //
    }

    public function hrdAction($id, $action)
    {
        if ($action == 'accept') {
            Cuti::where('cuti_id', $id)->update(['status_2' => true]);
        }
        elseif ($action == 'decline') {
            Cuti::where('cuti_id', $id)->update(['status_2' => false]);
        }
        
        return redirect('/cuti');
        // >with('status', 'Pengajuan Diterima');
    }

    public function managerAction($id, $action)
    {
        if ($action == 'accept') {
            Cuti::where('cuti_id', $id)->update(['status_1' => true]);
        }
        elseif ($action == 'decline') {
            Cuti::where('cuti_id', $id)->update(['status_1' => false]);
        }
        
        return redirect('/cuti');
        // >with('status', 'Pengajuan Diterima');
    }

    private function validateForm($data)
    {
        return Validator::make($data, [
            'start_date'     => 'required',
            'finish_date'    => 'required',
            'description'    => 'required'
        ]);
    } 
}
