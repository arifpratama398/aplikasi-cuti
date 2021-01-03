@extends('layouts.app')
@php 
$roleStr = '';
switch ($role) {
  case '2':
    $roleStr = 'hrd';
    break;
  case '3':
    $roleStr = 'manager';
    break;
  default:
    $roleStr = 'karyawan';
}
@endphp
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('global.cuti._')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('global.cuti._')</a></li>
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
                        <a href="{{ route('cuti.create') }}" class="btn btn-sm btn-success btn-flat">
                        <i class="fa fa-plus fa-icon"></i>&nbsp;@lang('global.app_add')</a>
                    </div>
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="2.5%" class="text-center">@lang('global.cuti.number')</th>
                                <th width="20%" class="text-center">@lang('global.cuti.name')</th>
                                <th width="15%" class="text-center">@lang('global.cuti.start_date')</th>
                                <th width="15%" class="text-center">@lang('global.cuti.finish_date')</th>
                                <th width="20%" class="text-center">@lang('global.cuti.description')</th>
                                @if ($roleStr != 'karyawan')
                                    <th width="20%" class="text-center">@lang('global.app_action')</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @if (count($cuti) > 0)
                            @foreach($cuti as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->tgl_mulai }}</td>
                                <td>{{ $item->tgl_selesai }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                @if ($roleStr != 'karyawan')
                                    <td class="text-center">
                                        <a href="{{ route($roleStr . '.cuti.action', [$item->cuti_id, 'accept']) }}" class="btn btn-xs btn-primary btn-flat">
                                            <i class="fa fa-check"></i>&nbsp;Terima
                                        </a>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'GET',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => [$roleStr . '.cuti.action', $item->cuti_id, 'decline'])) !!}
                                            <button class="btn btn-xs btn-danger btn-flat" type="submit">
                                                <i class="fa fa-times"></i>&nbsp;Tolak
                                            </button>    
                                        {!! Form::close() !!}                                    
                                    </td>
                                @endif                                            
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">
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
