 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
         <span class="brand-text font-weight-light">{{auth()->user()->name}}</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">Alexander Pierce</a>
             </div>
         </div> --}}

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
                 <li class="nav-item">
                     <a href="{{route('yojana')}}" class="nav-link">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             डास्बोर्ड
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('user.index') }}" class="nav-link @yield('user_active')">
                         <i class="nav-icon fas fa-cog"></i>
                         <p>
                             युजर
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('role.index') }}" class="nav-link @yield('role_active')">
                         <i class="nav-icon fas fa-cog"></i>
                         <p>
                             {{ __('भूमिका व्यवस्थापन') }}
                         </p>
                     </a>
                 </li>
                 @can('VIEW_PERMISSION')
                    <li class="nav-item">
                        <a href="{{ route('permission.index') }}" class="nav-link @yield('permission_active')">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                {{ __('अनुमति व्यवस्थापन') }}
                            </p>
                        </a>
                    </li>
                 @endcan
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
