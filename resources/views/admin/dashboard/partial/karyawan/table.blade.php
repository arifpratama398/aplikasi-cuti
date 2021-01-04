<div class="row">
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
                <td>{{ $new->tgl_mulai }}</td>
                <td>{{ $new->tgl_selesai }}</td>
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