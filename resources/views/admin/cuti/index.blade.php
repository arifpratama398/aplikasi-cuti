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
                    @if(auth()->user()->isAdmin() || auth()->user()->isKaryawan())
                    <div class="case-header with-border">
                        <a href="{{ route('cuti.create') }}" class="btn btn-sm btn-success btn-flat">
                        <i class="fa fa-plus fa-icon"></i>&nbsp;@lang('global.app_add')</a>
                    </div>
                    @endif
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="2.5%" class="text-center">@lang('global.cuti.number')</th>
                                <th width="20%" class="text-center">@lang('global.cuti.name')</th>
                                <th width="15%" class="text-center">@lang('global.cuti.start_date')</th>
                                <th width="15%" class="text-center">@lang('global.cuti.finish_date')</th>
                                <th width="20%" class="text-center">@lang('global.cuti.description')</th>
                                <th width="20%" class="text-center">@lang('global.cuti.status')</th>
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
                                <td>{{ $item->karyawan->name }}</td>
                                <td>{{ $item->tgl_mulai }}</td>
                                <td>{{ $item->tgl_selesai }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td class="text-center">{!! $item->status !!}</td>
                                @if ($roleStr != 'karyawan')
                                   
                                    <td class="text-center">
                                        @if (auth()->user()->isManajer() && !isset($item->status_1))
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
                                        @elseif (auth()->user()->isHRD() && !isset($item->status_2) && $item->status_1)
                                        <a href="{{ route($roleStr . '.cuti.action', [$item->cuti_id, 'accept']) }}" class="btn btn-xs btn-info btn-flat">
                                            <i class="fa fa-check"></i>&nbsp;Terima
                                        </a>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'GET',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => [$roleStr . '.cuti.action', $item->cuti_id, 'decline'])) !!}
                                            <button class="btn btn-xs btn-warning btn-flat" type="submit">
                                                <i class="fa fa-times"></i>&nbsp;Tolak
                                            </button>    
                                        {!! Form::close() !!}
                                        @else
                                            @php
                                                $data_modal = [
                                                    'status_1'      => $item->status_1,
                                                    'status_2'      => $item->status_2,
                                                    'name'          => $item->karyawan->name,
                                                    'description'   => $item->deskripsi,
                                                    'tgl_mulai'     => $item->tgl_mulai,
                                                    'tgl_selesai'   => $item->tgl_selesai
                                                ];

                                                $json_data = json_encode($data_modal);
                                                
                                            @endphp
                                            <button class="btn btn-xs btn-primary btn-flat" type="button" onclick="showModal({{ $json_data }})">
                                                <i class="fa fa-search"></i>&nbsp;Detail
                                            </button> 
                                        @endif                                    
                                    </td>
                                    
                                @endif                                            
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">
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
<div class="modal fade show" id="modal-default" style="display: none; padding-right: 19px;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="cuti-data"></div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@section('js')
<script>
  $(function () {
    
    $("#modal-default").on("hidden.bs.modal", function (e) {
        $('#cuti-data').html("");
    });

    $("#table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "print", "colvis"]
    }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
  });

  function showModal(data){
    $("#modal-default").modal();

    var data = [ 
        ["@lang('global.cuti.name')", data.name ],
        ["@lang('global.cuti.start_date')", data.tgl_mulai ],
        ["@lang('global.cuti.finish_date')", data.tgl_selesai ],
        ["@lang('global.cuti.description')", data.description ],
        ["@lang('global.cuti.status') 1", ( data.status_1 ? "Diterima" : "Ditolak" ) + " Manajer"],
        ["@lang('global.cuti.status') 2", ( data.status_2 ? "Diterima" : "Ditolak" ) + " HRD"],

    ];

    var html = '<table class="table table-bordered table-striped"><thead><tr></tr></thead><tbody>';
    for (var i = 0, len = data.length; i < len; ++i) {
        html += '<tr>';

        for (var j = 0, rowLen = data[i].length; j < rowLen; ++j ) {
            html += '<td>' + data[i][j] + '</td>';
        }

        html += "</tr>";
        
    }
    html += '</tbody><tfoot><tr></tr></tfoot></table>';

    $(html).appendTo('#cuti-data');
  }


</script>
@endsection
