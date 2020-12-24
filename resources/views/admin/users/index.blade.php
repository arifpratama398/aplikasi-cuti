@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <div class="row justify-content-md-center">
                        <div class="col-sm-8">
                            <h3>Daftar User</h3>
                        </div>
                        <div class="col-sm-4"> 
                            <a style="float: right" type="button" class="btn btn-primary btn-flat" href="{{ route('register') }}">
                                Tambah User
                            </a>
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
                                <th>No</th>
                                <th>Nama</th>
                                <th>Posisi</td>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($users as $key => $u)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->role->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>                                        
                                        <a href="/users/edit/{{$u->id}}" class="btn btn-xs btn-success btn-flat";">Edit</a>
                                        <a href="/users/destroy/{{$u->id}}" class="btn btn-xs btn-danger btn-flat" onclick="return confirm('yakin ingin menghapus data ini?');">Delete</a> 
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
