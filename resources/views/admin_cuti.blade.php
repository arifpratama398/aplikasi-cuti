@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
</div>
@endsection
