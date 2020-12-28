@extends('layouts.app')
@php 
$agama = old('agama')
            ? \App\RefAgama::find(old('agama'))
            : $karyawan->agama;
$route = $karyawan->exists
            ? ['method' => 'PUT', 'route' => ['admin.karyawan.update', $karyawan->id]]
            : ['method' => 'POST', 'route' => ['admin.karyawan.store']];
@endphp
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.employee_management.create')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('global.employee_management._')</a></li>
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
                    <div class="col-md-6 border-right">
                        <div class="row">     
                            <!-- NAME FIELD  -->    
                            <div class="col-md-12 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', trans('global.user.fields.name'), ['class' => 'control-label']) !!}
                                {!! Form::text('name', old('name', $karyawan->name), ['class' => 'form-control']) !!}
                                @if($errors->has('name'))
                                    <p class="help-block">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>

                            <!-- NOMOR KARYAWAN FIELD  -->
                            <div class="col-md-12 form-group {{ $errors->has('nomor_karyawan') ? ' has-error' : '' }}">
                                {!! Form::label('nomor_karyawan', trans('global.employee_management.fields.number'), ['class' => 'control-label']) !!}
                                {!! Form::text('nomor_karyawan', old('nomor_karyawan', $karyawan->nomor_karyawan), ['class' => 'form-control']) !!}
                                @if($errors->has('nomor_karyawan'))
                                    <p class="help-block">
                                        {{ $errors->first('nomor_karyawan') }}
                                    </p>
                                @endif
                            </div> 

                            <!-- ALAMAT FIELD  -->
                            <div class="col-md-12 form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
                                {!! Form::label('alamat', trans('global.employee_management.fields.address'), ['class' => 'control-label']) !!}
                                {!! Form::textarea('alamat', old('alamat', $karyawan->alamat), ['class' => 'form-control']) !!}
                                @if($errors->has('alamat'))
                                    <p class="help-block">
                                        {{ $errors->first('alamat') }}
                                    </p>
                                @endif
                            </div>           

                            <!-- NO TELP FIELD  -->
                            <div class="col-md-12 form-group {{ $errors->has('no_telp') ? ' has-error' : '' }}">
                                {!! Form::label('no_telp', trans('global.employee_management.fields.telp'), ['class' => 'control-label']) !!}
                                {!! Form::text('no_telp', old('no_telp', $karyawan->no_telp), ['class' => 'form-control']) !!}
                                @if($errors->has('no_telp'))
                                    <p class="help-block">
                                        {{ $errors->first('no_telp') }}
                                    </p>
                                @endif
                            </div>            
                            
                            <!-- JENIS KELAMIN FIELD  -->
                            <div class="col-md-12 form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                                {!! Form::label('jenis_kelamin', trans('global.employee_management.fields.gender'), ['class' => 'control-label']) !!}
                                <div class="row">
                                    <div class="radio">
                                        <div class="col-xs-2">
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="L"
                                                    @if(old('jenis_kelamin', $karyawan->jk_id) === 1) checked @endif> L
                                            </label>
                                        </div>
                                        <div class="col-xs-2">
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="P"
                                                    @if(old('jenis_kelamin', $karyawan->jk_id) === 2) checked @endif> P
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            
                            <!-- AGAMA FIELD -->
                            <div class="col-md-12 form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                                {!! Form::label('agama', trans('global.employee_management.fields.religion'), ['class' => 'control-label']) !!}
                                <select id="agama" name="agama" class="form-control select2">
                                    <option></option>
                                    @if($agama)
                                        <option value="{{ $agama->id }}" selected>
                                            {{ $agama->name }}
                                        </option>
                                    @endif
                                </select>
                                @if($errors->has('agama'))
                                    <p class="help-block">
                                        {{ $errors->first('agama') }}
                                    </p>
                                @endif
                            </div>                            
                            
                            @if(!$karyawan->exists)
                                <div class="col-md-12">
                                    <div class="row border-top">
                                        <!-- USERNAME -->
                                        <div class="col-md-12 form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                            {!! Form::label('username', trans('global.user.fields.username'), ['class' => 'control-label']) !!}
                                            {!! Form::text('username', old('username'), ['class' => 'form-control']) !!}
                                            @if($errors->has('username'))
                                                <p class="help-block">
                                                    {{ $errors->first('username') }}
                                                </p>
                                            @endif
                                        </div>
                                        <!-- PASSWORD -->
                                        <div class="col-md-12 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                            {!! Form::label('email', trans('global.user.fields.email'), ['class' => 'control-label']) !!}
                                            {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                                            @if($errors->has('email'))
                                                <p class="help-block">
                                                    {{ $errors->first('email') }}
                                                </p>
                                            @endif
                                        </div>
                                        <!-- PASSWORD -->
                                        <div class="col-md-12 form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                            {!! Form::label('password', trans('global.user.fields.password'), ['class' => 'control-label']) !!}
                                            {!! Form::password('password', ['class' => 'form-control']) !!}
                                            @if($errors->has('password'))
                                                <p class="help-block">
                                                    {{ $errors->first('password') }}
                                                </p>
                                            @endif
                                        </div>
                                        <!-- PASSWORD CONFIRMATION -->
                                        <div class="col-md-12 form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            {!! Form::label('password_confirmation', trans('global.user.fields.password_confirmation'), ['class' => 'control-label']) !!}
                                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                            @if($errors->has('password_confirmation'))
                                                <p class="help-block">
                                                    {{ $errors->first('password_confirmation') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-xs-12 form-group {{ $errors->has('role_id') ? ' has-error' : '' }}">
                                            {!! Form::label('role', trans('global.user.fields.role'), ['class' => 'control-label']) !!}
                                            {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control select2', 'id' => 'role']) !!}
                                            @if($errors->has('role_id'))
                                                <p class="help-block">
                                                    {{ $errors->first('role_id') }}
                                                </p>
                                            @endif
                                        </div>                                          
                                    </div>
                                </div>
                            @endif                            
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a type="button" href="{{ route('admin.karyawan.index') }}" class="btn btn-sm btn-warning btn-flat text-white">
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


@push('js')
    <script>
        $(function () {
            let agamaField    = $('#agama');   
            
            agamaField.select2({
                placeholder: "@lang('global.select.agama')",
                ajax       : {
                    url           : root + '/admin/autocomplete/agama',
                    dataType      : 'json',
                    data          : function (params) {
                        return {
                            term: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id  : item.id,
                                    text: item.name
                                }
                            })
                        };
                    }
                },
            });            

        });
    </script> 
@endpush         