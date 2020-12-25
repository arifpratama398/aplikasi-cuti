@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('header')
<!-- header -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{str_replace('_',' ',$table_name)}}</h1>
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
@php
    $ignored_fields  = ['created_at','created_by','modified_at','modified_by'];
@endphp
<div class="container">
    <div class="modal fade bs-modal-md" tabindex="-1" role="dialog" id="formModal">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.datamaster.store',[$table_name]) }}" method="post" id="formDetail">
                    {{ csrf_field() }}
                    @foreach($records['fields'] as $index => $fields)
                        <div class="form-group">
                            <label>{{ $fields }}</label>
                            <input type="text" name="{{ $fields }}" class="form-control" id="{{ $fields }}">
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary btn-flat btn-sm submit-btn">
                        @lang('global.app_save')
                    </button>
                </form>              
            </div>
          </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12">
            <div class="card"> 
                <div class="card-header">
                    <h3 class="card-title">@lang('global.app_list')</h3>
                </div> 
                <!-- /.card-header -->
                <div class="card-body">              
                    <div class="case-header with-border">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm btn-flat" data-toggle="modal"
                                    data-target="#formModal">
                                <i class="fa fa-plus"></i> @lang('global.app_add')
                            </button>
                        </div>                        
                    </div>   
                    <table id="dataTable" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                @foreach($records['fields'] as $fields)
                                    @if(!in_array($fields,$ignored_fields))
                                        <th>{{ $fields }}</th>
                                    @endif
                                @endforeach         
                                <th class="text-center" width="20%">@lang('global.app_action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($records['data'] as $index => $data)
                            <tr>
                                @foreach($data as $index => $value)
                                    @if(!in_array($index,$ignored_fields))
                                        <td>{{ $value }}</td>
                                    @endif
                                @endforeach
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-xs btn-flat" id="btn-edit">
                                        <i class="fa fa-edit"></i> @lang('global.app_edit')
                                    </button>
                                    <button type="button" class="btn btn-danger btn-xs btn-flat" id="btn-delete">
                                        <i class="fa fa-trash"></i> @lang('global.app_delete')
                                    </button>                                    
                                </td>
                            </tr>
                        @endforeach 
                        </tbody>                  
                    </table>                                     
                </div>    
                <div class="card-footer">
                    <a href="{{ route('admin.datamaster.list') }}" class="btn btn-sm btn-flat btn-warning text-white">
                        <i class="fa fa-chevron-left"></i> @lang('global.app_back')
                    </a>
                </div>
            </div>
        </div>                        
    </div>
</div>

@endsection
@push('js')
    <script type="text/javascript">
        var table = $("#dataTable").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons"   : ["copy", "csv", "print", "colvis"],
            "dom"       : "<'row'<'col-sm-8'><'col-sm-3 col-xs-12'f><'col-sm-1 col-xs-12'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'><'col-sm-7'p>>"  
        }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');

        $('#dataTable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        //show edit modal
        $('#btn-edit').on('click', function () {            
            $('.selected td').each(function () {
                var th = $('#dataTable th').eq($(this).index()).text();
                $('#' + th).val($(this).html());
            });
            $('#formDetail').prepend('<input type="hidden" name="_method" value="put">');
            $('#formModal').modal('show');
            //clear form on modal hide
            $('#formModal').on('hidden.bs.modal', function () {
                $(this).find("input[name='_method']").remove();
                $(this).find("input:text").val('');
                $('#dataTable tbody tr').removeClass('selected');
            });
        });

        //delete field
        $('#btn-delete').on('click', function () {
            if (confirm('@lang('global.confirm_del')')) {
                $('.selected td').each(function () {
                    var th = $('#dataTable th').eq($(this).index()).text();
                    $('#' + th).val($(this).html());
                });
                $('#formDetail').prepend('<input type="hidden" name="_method" value="delete">');
                $('#formDetail').submit();
            }
        });
    </script>
@endpush
