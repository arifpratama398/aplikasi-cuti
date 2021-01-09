<div class="row">
@if(auth()->user()->role->id != 4)  
  <div class="col-5">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">@lang('global.dashboard.table_user')</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>@lang('global.dashboard.table_header.number')</th>
              <th>@lang('global.dashboard.table_header.name')</th>
              <th>@lang('global.dashboard.table_header.email')</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($user->take(5) as $person)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $person->name }}</td>
                <td>{{ $person->email }}</td>
                
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
      <!-- /.col-md-6 -->
  <div class="col-7">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">@lang('global.dashboard.table_cuti')</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>@lang('global.dashboard.table_header.number')</th>
              <th>@lang('global.dashboard.table_header.name')</th>
              <th>@lang('global.dashboard.table_header.start_date')</th>
              <th>@lang('global.dashboard.table_header.finish_date')</th>
              <th>@lang('global.dashboard.table_header.description')</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cuti->take(5) as $new)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $new->karyawan->name }}</td>
                <td>{{ Helper::date_convert($new->tgl_mulai) }}</td>
                <td>{{ Helper::date_convert($new->tgl_selesai) }}</td>
                <td>{{ $new->deskripsi }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col-md-6 -->
</div>
@else 
    <div class="col-3">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $jatah_cuti }}</h3>
            <p>Jatah Cuti</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>
          <a href="#" class="small-box-footer">Ajukan Cuti<i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>  
      <!-- /.col-md-6 -->
      <div class="col-9">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">@lang('global.dashboard.table_cuti')</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>@lang('global.dashboard.table_header.number')</th>
              <th>@lang('global.dashboard.table_header.name')</th>
              <th>@lang('global.dashboard.table_header.start_date')</th>
              <th>@lang('global.dashboard.table_header.finish_date')</th>
              <th>@lang('global.dashboard.table_header.description')</th>
              <th>@lang('global.dashboard.table_header.status')</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cuti->take(5) as $new)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $new->karyawan->name }}</td>
                <td>{{ Helper::date_convert($new->tgl_mulai) }}</td>
                <td>{{ Helper::date_convert($new->tgl_selesai) }}</td>
                <td>{{ $new->deskripsi }}</td>
                <td>
                  {!! $new->status !!}                  
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col-md-6 -->    
@endif
