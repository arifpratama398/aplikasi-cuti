@extends('layouts.app')
@php 
$route = $user->exists
            ? ['method' => 'PUT', 'route' => ['admin.users.update', $user->id]]
            : ['method' => 'POST', 'route' => ['admin.users.store']];
@endphp
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.user.create')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('global.user_management._')</a></li>
              <li class="breadcrumb-item active">@lang('global.user._')</li>
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
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12 form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                {!! Form::label('username', trans('global.user.fields.username'), ['class' => 'control-label']) !!}
                                {!! Form::text('username', old('username', $user->username), ['class' => 'form-control']) !!}
                                @if($errors->has('username'))
                                    <p class="help-block">
                                        {{ $errors->first('username') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-12 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', trans('global.user.fields.email'), ['class' => 'control-label']) !!}
                                {!! Form::email('email', old('email', $user->email), ['class' => 'form-control']) !!}
                                @if($errors->has('email'))
                                    <p class="help-block">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-12 form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                {!! Form::label('password', trans('global.user.fields.password'), ['class' => 'control-label']) !!}
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                                @if($errors->has('password'))
                                    <p class="help-block">
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-12 form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                {!! Form::label('password_confirmation', trans('global.user.fields.password_confirmation'), ['class' => 'control-label']) !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                @if($errors->has('password_confirmation'))
                                    <p class="help-block">
                                        {{ $errors->first('password_confirmation') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-12 form-group {{ $errors->has('role_id') ? ' has-error' : '' }}">
                                {!! Form::label('role', trans('global.user.fields.role'), ['class' => 'control-label']) !!}
                                {!! Form::select('role_id', $roles, old('role_id', $user->role_id), ['class' => 'form-control select2', 'id' => 'role']) !!}
                                @if($errors->has('role_id'))
                                    <p class="help-block">
                                        {{ $errors->first('role_id') }}
                                    </p>
                                @endif
                            </div>    

                            <div class="col-md-12 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('nama', trans('global.user.fields.name'), ['class' => 'control-label']) !!}
                                {!! Form::text('name', old('name', $user->name), ['class' => 'form-control']) !!}
                                @if($errors->has('name'))
                                    <p class="help-block">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>                  
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a type="button" href="{{ route('admin.users.index') }}" class="btn btn-sm btn-warning btn-flat text-white">
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
