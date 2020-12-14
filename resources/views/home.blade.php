@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="row justify-content-md-center">
                    <div class="col-sm-8"> Daftar Cuti Pending </div>
                    <div class="col-sm-4"> 
                        <a style="float: right" 
                                type="button" 
                                class="btn btn-primary"
                                href="{{ route('pengajuan') }}">Buat Pengajuan</a>
                    </div>
                </div>
            </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table"> 
                        <thead >
                            <tr>
                                
                                <td>tgl-mulai</td>
                                <td>tgl-selesai</td>
                                <td>keperluan</td>
                                <td>status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                                @foreach($cuti_pending as $c)
                                <tr>
                                    
                                    <td>{{$c->start}}</td>
                                    <td>{{$c->finish}}</td>
                                    <td>{{$c->needs}}</td>
                                    <td>{{$c->status ? 'accepted' : 'pending'}}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                    {!! $cuti_pending->links("pagination::bootstrap-4") !!}
                    </div>   
                </div>
            </div>
            <br/>
            <br/>
            <div class="card">
                <div class="card-header">Daftar Cuti Accepted</div>

                <div class="card-body">
                    <table class="table"> 
                        <thead >
                            <tr>
                                <td>tgl-mulai</td>
                                <td>tgl-selesai</td>
                                <td>keperluan</td>
                                <td>status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                                @foreach($cuti_acc as $c)
                                <tr>
                                    <td>{{$c->start}}</td>
                                    <td>{{$c->finish}}</td>
                                    <td>{{$c->needs}}</td>
                                    <td>{{$c->status ? 'accepted' : 'pending'}}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                    {!! $cuti_acc->links("pagination::bootstrap-4") !!}
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
