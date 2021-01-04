<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cuti;
use App\Models\RefJatahCuti;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $ref_jatah_cuti = RefJatahCuti::firstWhere('tahun', date('Y'));        
        $user = User::orderBy('created_at','desc')->get();
        
        // CUTI QUERY  
        $query = Cuti::orderBy('cuti.created_at','desc');
        if(auth()->user()->isKaryawan())    
            $query->where('karyawan_id', auth()->user()->karyawan->id);    
        $cuti = $query->get();    

        // JATAH CUTI 
        $ambil_cuti = Cuti::where('cuti.status_1', 1)
            // not confirmed by HR
            ->where('cuti.status_2', 1)
            // show latest data.
            ->orderBy('cuti.created_at','desc')
            ->sum('jumlah_hari');    

        $jatah_cuti = $ref_jatah_cuti->jumlah - $ambil_cuti;
        
        return view('admin.dashboard.index', compact(['user', 'cuti', 'jatah_cuti']));
    }

    public function adminHome()
    {
        $users = User::paginate(5);

        return view('admin.users.index', compact('users'));
    }

    public function adminCuti()
    {
        $cuti_pending = DB::table('cuti')
            ->join('users','users.id','cuti.id')
            ->select('users.name','cuti.*')
            ->where('status', false)
            ->paginate(10);        

        return view('admin_cuti', [
            'cuti_pending' => $cuti_pending,
        ]);
    }

    public function deleteCuti($id) 
    {
        // menghapus pengajuan cuti
        DB::table('cuti')->where('cuti_id', $id)->delete();
        
        return redirect('/admin/cuti')->with('status', 'Pengajuan berhasil dihapus');
    }

    public function deleteUser($id) 
    {
       
        DB::table('users')->where('id', $id)->delete();
        
        return redirect('/admin/home')->with('register-status', 'Data karyawan berhasil dihapus');
    }

    public function editUser($id) 
    {
    
        $user = DB::table('users')->where('id', $id)->get();
        // dd($user);
        return view('edit_user', [
          'user' => $user
        ]);
        
    }

    public function acceptCuti($id) 
    {
        DB::table('cuti')->where('cuti_id', $id)->update(['status' => true]);
        
        return redirect('/admin/cuti')->with('status', 'Pengajuan Diterima');
    }

    public function updateUser(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'position' => 'required',
            'id' => 'required'
        ]);
        
        DB::table('users')->where('id', $request->id)->update(
            [
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position
            ]
        );

        
        return redirect('/admin/home')->with('register-status', 'Data berhasil diupdate');
    }

    public function addcuti(){
        $id = Auth::id();
        return view('add_cuti', ['id'=> $id]);
    }

    public function store_cuti(Request $request) {
    $this->validate($request, [
        'start' => 'required',
        'finish' => 'required',
        'needs' => 'required',
        'id' => 'required'
    ]);

    
    DB::table('cuti')->insert([
        'start' => $request->start,
        'finish' => $request->finish,
        'needs' => $request->needs,
        'id' => $request->id,
    ]);
    
    return redirect('/home')->with('status', 'Pengajuan Cuti Berhasil Ditambahkan');
}
public function store_user(Request $request) {
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required',
        'position' => 'required',
        'password' => 'required|confirmed'
    ]);

    
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'position' => $request->position,
        'password' => Hash::make($request->password),
    ]);
    
    return redirect('/admin/home')->with('register-status', 'User Berhasil Ditambahkan');
}
}
