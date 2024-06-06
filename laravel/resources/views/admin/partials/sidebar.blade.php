<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <img src="{{ asset('adminassets/dist/img/admin.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">IWin Game</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ auth()->user()->image }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('admin.profile') }}" class="d-block">{{ auth()->user()->name }}</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.user.index') }}" class="nav-link @if(Request::segment(2) == 'user') active @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>
              User Management
            </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="{{ route('admin.category.index') }}" class="nav-link @if(Request::segment(2) == 'category') active @endif">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Game Category
            </p>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a href="{{ route('admin.game.index') }}" class="nav-link @if(Request::segment(2) == 'game') active @endif">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Game Management
            </p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="{{ route('admin.affiliate-ads.index') }}" class="nav-link @if(Request::segment(2) == 'affiliate-ads') active @endif">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Affiliate Ads Revenue
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.winner.index') }}" class="nav-link @if(Request::segment(2) == 'winner') active @endif">
            <i class="nav-icon fas fa-flag"></i>
            <p>
              Winning Management
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.tournaments.index') }}" class="nav-link @if(Request::segment(2) == 'tournaments') active @endif">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Tournaments
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.cms-page.index') }}" class="nav-link @if(Request::segment(2) == 'cms-page') active @endif">
            <i class="nav-icon fas fa-table"></i>
            <p>
              CMS Pages
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>