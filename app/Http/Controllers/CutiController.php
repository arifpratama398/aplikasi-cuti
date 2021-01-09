<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\RefJatahCuti;
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
            case 3:
                $cuti = Cuti::orderBy('cuti.created_at','desc')->get();
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

        $ref_jatah_cuti = RefJatahCuti::firstWhere('tahun', date('Y'));

        $ambil_cuti = Cuti::where('karyawan_id', Auth::user()->karyawan->id)
            ->where('cuti.status_1', '!=', 0)
            ->where('cuti.status_2', '!=', 0)
            ->orderBy('cuti.created_at','desc')
            ->sum('jumlah_hari');  

        $jatah_cuti = $ref_jatah_cuti->jumlah - $ambil_cuti;   

        $validator = $this->validateForm($data, $jatah_cuti);
        if ($validator->fails()) {
            Session::flash('message', trans('global.save_error'));
            Session::flash('alert-class', 'alert-warning');

            return Redirect::back()->withErrors($validator)->withInput();
        }

        $jumlah_hari = $this->getJumlahHari($data['start_date'], $data['finish_date']);

        if($jumlah_hari > $jatah_cuti){
            Session::flash('message', trans('Ambil cuti anda melebihi jatah hari cuti tersisa'));
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
        $cuti->jumlah_hari      = $this->getJumlahHari($cuti->tgl_mulai, $cuti->tgl_selesai);
    }

    private function getJumlahHari($tgl_mulai, $tgl_selesai){
        $tgl_mulai = \Carbon\Carbon::createFromFormat('Y-m-d', $tgl_mulai);
        $tgl_selesai = \Carbon\Carbon::createFromFormat('Y-m-d', $tgl_selesai);
        $jumlah_hari = $tgl_selesai->diffInDays($tgl_mulai);
        return $jumlah_hari + 1;         
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
            Cuti::where('cuti_id', $id)->update(['status_1' => false , 'status_2' => false]);
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
