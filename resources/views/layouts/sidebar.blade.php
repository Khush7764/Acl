<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-')}}3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image')}}">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @foreach ($sidebar['sidebar'] as $menu)
            <li class="nav-item has-treeview">
              <a href="{{route($menu['uri']??'dashboard')}}" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  {{$menu['menu_name']}}
                  @if ($menu['user_sidebar'])
                  <i class="fas fa-angle-right right"></i>
                  @endif
                </p>
              </a>
              @if ($menu['user_sidebar'])
              <ul class="nav nav-treeview">
              @foreach ($menu['user_sidebar'] as $submenu)
                <li class="nav-item">
                  <a href="{{route($submenu['uri'] ?? 'dashboard')}}" class="nav-link"> 
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{$submenu['menu_name']}}</p>
                  </a>
                </li>
                @endforeach
              </ul>
              @endif
            </li>  
          @endforeach
          <li class="nav-item">
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>