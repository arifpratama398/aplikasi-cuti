@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
