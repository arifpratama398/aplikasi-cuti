@extends('layouts.app')
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.employee_management.detail')</h1>
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
                                    <th width="30%">@lang('global.employee_management.name')</th>
                                    <td width="70%">{{ $karyawan->name }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('global.employee_management.fields.number')</th>
                                    <td>{{ $karyawan->nomor_karyawan }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('global.employee_management.fields.address')</th>
                                    <td>{{ $karyawan->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('global.employee_management.fields.telp')</th>
                                    <td>{{ $karyawan->no_telp }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('global.employee_management.fields.gender')</th>
                                    <td>{{ $karyawan->jenisKelamin->name }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('global.employee_management.fields.religion')</th>
                                    <td>{{ $karyawan->agama->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="{{ route('admin.karyawan.index') }}" class="btn btn-sm btn-warning btn-flat text-white" type="button">
                        <i class="fa fa-arrow-left"></i>&nbsp;@lang('global.app_back')
                    </a> 
                    <a href="{{ route('admin.karyawan.edit',[$karyawan->id]) }}" class="btn btn-sm btn-info btn-flat text-white pull-right" type="button">
                        <i class="fa fa-edit"></i>&nbsp;@lang('global.app_edit')
                    </a> 
                </div>
                <!-- /.card-body -->
            </div>
        </div>                        
    </div>
</div>
@endsection
