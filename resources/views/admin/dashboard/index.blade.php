@extends('layouts.app')
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.dashboard._')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">@lang('global.dashboard._')</a>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<div class="container">
@if(auth()->user()->isAdmin())
  @include('admin.dashboard.partial.admin.widget')
  @include('admin.dashboard.partial.admin.table')
@else  
  @if(auth()->user()->role->id != 4)  
  @include('admin.dashboard.partial.karyawan.widget')
  @endif
  @include('admin.dashboard.partial.karyawan.table')
@endif  
</div>
@endsection
