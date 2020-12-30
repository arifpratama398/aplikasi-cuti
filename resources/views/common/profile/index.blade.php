@extends('layouts.app')
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.profile._')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">@lang('global.profile._')</a>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{ $profile->name }}</h3>

          <p class="text-muted text-center">{{ $profile->user->role->nama }}</p>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>@lang('global.profile.id')</b> <a class="float-right">{{ $profile->nomor_karyawan }}</a>
            </li>
            <li class="list-group-item">
              <b>@lang('global.profile.email')</b> <a class="float-right">{{ $profile->user->email }}</a>
            </li>
            <li class="list-group-item">
              <b>@lang('global.profile.phone')</b> <a class="float-right">{{ $profile->no_telp }}</a>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-8">
      <!-- About Me Box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">@lang('global.profile.info')</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <strong><i class="fas fa-heart mr-1"></i>@lang('global.profile.religion')</strong>
          <p class="text-muted">
            {{ $profile->agama->name }}
          </p>
          <hr>
          <strong><i class="fas fa-map-marker-alt mr-1"></i>@lang('global.profile.address')</strong>
          <p class="text-muted">{{ $profile->alamat }}</p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
@endsection