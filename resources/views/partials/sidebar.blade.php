  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">
          <strong>Yuk</strong> Cuti !!!
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
              {{ strtoupper(auth()->user()->name) }}
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">        
          <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
          </li>  
          <!-- MANAJEMEN USER   -->
          @if (auth()->user()->is_admin)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manajemen User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.roles.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Role</p>
                  </a>
                </li>
            </ul>
          </li> 
          @endif
          <!-- END MANAJEMEN USER  -->
          <li class="nav-item">
              <a href="{{ route('admin.karyawan.index') }}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Manajemen Karyawan
                </p>
              </a>
          </li>    
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Manajemen Cuti
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (auth()->user()->is_admin)
                <li class="nav-item">
                  <a href="/admin/cuti" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengajuan Terbaru</p>
                  </a>
                </li>
              @endif
            </ul>
          </li> 
          <!-- MANAJEMEN REFERENSI -->
          <li class="nav-item">
              <a href="{{ route('admin.datamaster.list') }}" class="nav-link">
                <i class="nav-icon fas fa-inbox"></i>
                <p>
                  Manajemen Referensi
                </p>
              </a>
          </li>  
        </ul>      
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>