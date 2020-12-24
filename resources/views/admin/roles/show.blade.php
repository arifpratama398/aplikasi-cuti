@extends('layouts.app')
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.role.detail')</h1>
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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('global.app_view')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>@lang('global.role.name')</th>
                                    <td>{{ $role->nama }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-warning btn-flat text-white" type="button">
                        <i class="fa fa-arrow-left"></i>&nbsp;@lang('global.app_back')
                    </a> 
                    <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="btn btn-sm btn-info btn-flat text-white pull-right" type="button">
                        <i class="fa fa-save"></i>&nbsp;@lang('global.app_edit')
                    </a> 
                </div>
                <!-- /.card-body -->
            </div>
        </div>                        
    </div>
</div>
@endsection
