@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Daftar Pengajuan Cuti</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table"> 
                        <thead>
                            <tr>
                                <td>nama</td>
                                <td>tgl-mulai</td>
                                <td>tgl-selesai</td>
                                <td>keperluan</td>
                                <td>status</td>
                                <td><i>action</i></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                                @foreach($cuti_pending as $c)
                                <tr>
                                    <td>{{$c->name}}</td>
                                    <td>{{$c->start}}</td>
                                    <td>{{$c->finish}}</td>
                                    <td>{{$c->needs}}</td>
                                    <td>{{$c->status ? 'accepted' : 'pending'}}</td>
                                    <td>
                                        <a href="/cuti/accept/{{$c->cuti_id}}" class="btn btn-xs btn-success";">Accept</a>
                                        <a href="/cuti/destroy/{{$c->cuti_id}}" class="btn btn-xs btn-secondary" onclick="return confirm('yakin ingin menghapus pengajuan ini?');">Delete</a> 
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                    {!! $cuti_pending->links("pagination::bootstrap-4") !!}
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <br/>
            <br/>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
                <div class="row justify-content-md-center">
                        <div class="col-sm-8"> Daftar Karyawan </div>
                        <div class="col-sm-4"> 
                            <a style="float: right" 
                                    type="button" 
                                    class="btn btn-primary"
                                    href="{{ route('register') }}">Register User</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('register-status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('register-status') }}
                        </div>
                    @endif

                    <table class="table"> 
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Posisi</td>
                                <td>Email</td>
                                <td><i>action</i></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                                @foreach($users as $key=>$u)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->position}}</td>
                                    <td>{{$u->email}}</td>
                                    <td>
                                        <a href="/users/edit/{{$u->id}}" class="btn btn-xs btn-success";">Edit</a>
                                        <a href="/users/destroy/{{$u->id}}" class="btn btn-xs btn-secondary" onclick="return confirm('yakin ingin menghapus data ini?');">Delete</a> 
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                    {!! $users->links("pagination::bootstrap-4") !!}
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
