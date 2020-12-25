
@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.reference_management._')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.datamaster.list') }}">@lang('global.reference_management._')</a></li>
            </ol>
          </div>
        </div>
      </div>
</section>
@endsection
@section('content')
<div class="list-ref">
@foreach($records['name'] as $index=>$name)
      @if(($index) % 3 === 0)
      <div class="row">
          @endif
          <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{str_replace('_',' ',$name)}}</h3>
                        <p>Jumlah Data: {{$records['count'][$index]}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-folder-outline"></i>
                    </div>
                    <a href="{{ route('admin.datamaster.detail',[$name]) }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          @if(($index+1) % 3 === 0)
      </div>
      @endif
  @endforeach    
</div>    
@endsection
