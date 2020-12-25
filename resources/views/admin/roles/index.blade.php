@extends('layouts.app')
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.role._')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('global.user_management._')</a></li>
              <li class="breadcrumb-item active">@lang('global.role._')</li>
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
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-success btn-flat">
                        <i class="fa fa-plus fa-icon"></i>&nbsp;@lang('global.app_add')</a>
                    </div>
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="80%" class="text-center">@lang('global.role.name')</th>
                                <th width="20%" class="text-center">@lang('global.app_action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (count($roles) > 0)
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->nama }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.roles.show',[$role->id]) }}" class="btn btn-xs btn-primary btn-flat">
                                        <i class="fa fa-search"></i>&nbsp;@lang('global.app_view')
                                    </a>
                                    <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="btn btn-xs btn-info btn-flat">
                                        <i class="fa fa-edit"></i>&nbsp;@lang('global.app_edit')
                                    </a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.roles.destroy', $role->id])) !!}
                                        <button class="btn btn-xs btn-danger btn-flat" type="submit">
                                            <i class="fa fa-trash"></i>&nbsp;@lang('global.app_delete')
                                        </button>    
                                    {!! Form::close() !!}                                    
                                </td>                                            
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2">@lang('global.app_no_entries_in_table')</td>
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
    $("#dataTable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "print", "colvis"]
    }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
