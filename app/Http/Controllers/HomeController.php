<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        $id = Auth::id();
        $cuti_pending = DB::table('cuti')
            ->where('id', $id)
            ->where('status', false)
            ->paginate(10);

        $cuti_acc = DB::table('cuti')
            ->where('id', $id)
            ->where('status', true)
            ->paginate(10);

        return view('home', [
            'cuti_pending' => $cuti_pending, 
            'cuti_acc' => $cuti_acc,
        ]);
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
