  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @if ($data->has_pis)
            <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'pis'? 'active': ''}}">
                <a href="{{route('pis')}}" class="nav-link">कर्मचारी ब्यबस्थापन प्रणाली</a>
            </li>
        @endif
        @if ($data->has_yojana)
            <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'yojana'? 'active': ''}}">
                <a href="{{route('yojana')}}" class="nav-link">योजना</a>
            </li>
        @endif
        @if ($data->has_nagadi)
            <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'nagadi'? 'active': ''}}">
                <a href="{{route('nagadi')}}" class="nav-link">नगदी</a>
            </li>
        @endif
        @if ($data->has_sampatikar)
            <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'sampatikar'? 'active': ''}}">
                <a href="#" class="nav-link">सम्पतिकर</a>
            </li>
        @endif
        @if ($data->has_malpot)
            <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'malpot'? 'active': ''}}">
                <a href="{{route('malpot')}}" class="nav-link">मालपोत</a>
            </li>
        @endif
        @if ($data->has_dainik)
            <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'dainik'? 'active': ''}}">
                <a href="#" class="nav-link">दैनिक प्रशासन</a>
            </li>
        @endif
        @if ($data->has_apangata)
            <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'apangata'? 'active': ''}}">
                <a href="#" class="nav-link">अपांगता</a>
            </li>
        @endif
        @if ($data->has_byabasaye)
            <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'byabasaye'? 'active': ''}}">
                <a  href="{{route('byabasaye')}}" class="nav-link">ब्यबसाय दर्ता</a>
            </li>
        @endif
        @if ($data->has_naksa)
            <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'naksa'? 'active': ''}}">
                <a href="#" class="nav-link">नक्सा</a>
            </li>
        @endif
        @if ($data->has_krishi)
            <li class="nav-item d-none d-sm-inline-block {{ session('active_app') == 'krishi'? 'active': ''}}">
                <a href="#" class="nav-link">कृषि</a>
            </li>
        @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

        <!-- Messages Dropdown Menu -->
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
               <i class="fa-solid fa-user mr-2"></i>
                <span class="badge badge-warning navbar-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                @if(!auth()->user()->ward_no)
                     <a class="dropdown-item text-danger" href="{{ route('user.index') }}">
                              <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                              {{ __('User') }}
                          </a>
                @endif
                 <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
