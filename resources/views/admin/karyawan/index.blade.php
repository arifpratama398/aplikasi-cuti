@extends('layouts.app')
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.employee_management._')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('global.employee_management._')</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('global.app_list')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="case-header with-border">
                        <a href="{{ route('admin.karyawan.create') }}" class="btn btn-sm btn-success btn-flat">
                        <i class="fa fa-plus fa-icon"></i>&nbsp;@lang('global.app_add')</a>
                    </div>
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="40%" class="text-center">@lang('global.employee_management.name')</th>
                                <th width="30%" class="text-center">@lang('global.employee_management.fields.number')</th>
                                <th width="10%" class="text-center">@lang('global.employee_management.fields.gender')</th>
                                <th width="20%" class="text-center">@lang('global.app_action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (count($karyawan) > 0)
                            @foreach($karyawan as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->nomor_karyawan }}</td>
                                <td class="text-center">{{ $item->jenisKelamin->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.karyawan.show',[$item->id]) }}" class="btn btn-xs btn-primary btn-flat">
                                        <i class="fa fa-search"></i>&nbsp;@lang('global.app_view')
                                    </a>
                                    <a href="{{ route('admin.karyawan.edit',[$item->id]) }}" class="btn btn-xs btn-info btn-flat">
                                        <i class="fa fa-edit"></i>&nbsp;@lang('global.app_edit')
                                    </a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.karyawan.destroy', $item->id])) !!}
                                        <button class="btn btn-xs btn-danger btn-flat" type="submit">
                                            <i class="fa fa-trash"></i>&nbsp;@lang('global.app_delete')
                                        </button>    
                                    {!! Form::close() !!}                                    
                                </td>                                            
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    @lang('global.app_no_entries_in_table')
                                </td>
                            </tr>
                        @endif    
                        </tbody>                  
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>                        
    </div>
</div>
@endsection

@section('js')
<script>
  $(function () {
    $("#table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "print", "colvis"]
    }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
