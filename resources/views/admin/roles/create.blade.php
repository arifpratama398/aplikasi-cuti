@extends('layouts.app')
@php 
$route = $role->exists
            ? ['method' => 'PUT', 'route' => ['admin.roles.update', $role->id]]
            : ['method' => 'POST', 'route' => ['admin.roles.store']];
@endphp
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.role.create')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('global.user_management._')</a></li>
              <li class="breadcrumb-item active">@lang('global.role._')</li>
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
                    <h3 class="card-title">@lang('global.app_view')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-6">
                        <div class="row">
                            <!-- NAMA FIELD -->
                            <div class="col-md-12 form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                                {!! Form::label('nama', trans('global.role.name'), ['class' => 'control-label']) !!}
                                {!! Form::text('nama', old('nama', $role->nama), ['class' => 'form-control']) !!}
                                @if($errors->has('nama'))
                                    <p class="help-block">
                                        {{ $errors->first('nama') }}
                                    </p>
                                @endif
                            </div>                                
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a type="button" href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-warning btn-flat text-white">
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
