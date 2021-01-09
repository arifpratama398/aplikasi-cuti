@extends('layouts.app')
@php 
$route = ['method' => 'POST', 'route' => ['cuti.store']];
@endphp
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.cuti.create')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('global.cuti._')</a></li>
            </ol>
          </div>
        </div>
      </div>
</section>
@endsection
@section('content')
{!! Form::open($route) !!}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('global.app_form')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <div class="row">
                <div class="col-md-6 border-right">
                        <div class="row">     
                            <!-- START DATE FIELD  -->    
                            <div class="col-md-12 form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
                                {!! Form::label('start_date', trans('global.cuti.fields.start_date'), ['class' => 'control-label']) !!}
                                {!! Form::date('start_date', old('start_date'), ['class' => 'form-control', 'min' => date('Y-m-d')]) !!}
                                @if($errors->has('start_date'))
                                    <p class="help-block">
                                        {{ $errors->first('start_date') }}
                                    </p>
                                @endif
                            </div>

                            <!-- END DATE FIELD -->
                            <div class="col-md-12 form-group {{ $errors->has('finish_date') ? ' has-error' : '' }}">
                                {!! Form::label('finish_date', trans('global.cuti.fields.finish_date'), ['class' => 'control-label']) !!}
                                {!! Form::date('finish_date', old('finish_date'), ['class' => 'form-control', 'min' => date('Y-m-d')]) !!}
                                @if($errors->has('finish_date'))
                                    <p class="help-block">
                                        {{ $errors->first('finish_date') }}
                                    </p>
                                @endif
                            </div> 

                            <!-- DESCRIPTION FIELD  -->
                            <div class="col-md-12 form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
                                {!! Form::label('description', trans('global.cuti.fields.description'), ['class' => 'control-label']) !!}
                                {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
                                @if($errors->has('description'))
                                    <p class="help-block">
                                        {{ $errors->first('description') }}
                                    </p>
                                @endif
                            </div>                                                          
                        </div>
                    </div>
                    <div class="col-md-6 border-left">
                        @php   
                            $ref_jatah_cuti = App\Models\RefJatahCuti::firstWhere('tahun', date('Y'));   
                            $ambil_cuti = App\Models\Cuti::where('cuti.karyawan_id', Auth::user()->karyawan->id)
                                    ->where(function($query) {
                                        $query
                                            ->whereNull('cuti.status_1')
                                            ->orWhere('cuti.status_2', 1);
                                    })
                                    ->orderBy('cuti.created_at','desc')
                                    ->sum('jumlah_hari');   
                            $jatah_cuti = $ref_jatah_cuti->jumlah - $ambil_cuti;        
                        @endphp
                        <div class="info-box mb-3 bg-info">
                            <span class="info-box-icon"><i class="far fa-comment"></i></span>
                            <div class="info-box-content">
                                <h3 class="info-box-text">{{ $jatah_cuti }} Hari</h3>
                                <h4 class="info-box-number">Jatah Cuti</h4>
                            </div>
                            <!-- /.info-box-content -->
                        </div>                        
                    </div>                
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a type="button" href="{{ route('cuti.index') }}" class="btn btn-sm btn-warning btn-flat text-white">
                        <i class="fa fa-angle-left"></i>&nbsp;@lang('global.app_back')
                    </a> 
                    <button type="submit" class="btn btn-sm btn-primary btn-flat text-white pull-right">
                        <i class="fa fa-save"></i>&nbsp;@lang('global.app_save')
                    </button> 
                </div>
                <!-- /.card-body -->
            </div>
        </div>                        
    </div>
</div>
{!! Form::close() !!}
@endsection