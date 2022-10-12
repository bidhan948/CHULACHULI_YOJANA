 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('flag.gif') }}" class=" elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('yojana')}}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
                @if(!auth()->user()->ward_no)
                    <li class="nav-item">
                        <a href="{{ route('budget-sources') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                {{ __('बजेट श्रोत') }}
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('plan.index') }}" class="nav-link @yield('plan')">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            {{ __('योजना/कार्यक्रम') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('new-plan') }}" class="nav-link @yield('new_plan')">
                        <i class="fa-solid fa-plus nav-icon"></i>
                        <p>
                            {{ __('नयाँ योजना/कार्यक्रम दर्ता') }}
                        </p>
                    </a>
                </li>
                @if(!auth()->user()->ward_no)
                    <li class="nav-item">
                        <a href="{{ route('samiti-gathan.index') }}" class="nav-link @yield('tole_bikas_samiti')">
                            <i class="fa-solid fa-users nav-icon"></i>
                            <p>
                                {{ __('समिति गठन') }}
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('plan-operate.index') }}" class="nav-link @yield('operate_plan')">
                        <i class="fa-solid fa-rotate nav-icon"></i>
                        <p>
                            {{ __('योजना संचालन प्रक्रिया') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('program-operate.index') }}" class="nav-link @yield('operate_program')">
                        <i class="fa-solid fa-rotate nav-icon"></i>
                        <p>
                            {{ __('कार्यक्रम संचालन प्रक्रिया') }}
                        </p>
                    </a>
                </li>

                {{-- this is navigation for report dropdown --}}
                <li class="nav-item @yield('child_report')">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-book-open nav-icon"></i>
                        <p>
                            {{ __('रिपोर्ट') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-1">
                            <a href="{{ route('report.numerical') }}" class="nav-link @yield('report_numerical')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('सङ्ख्यात्मक रिपोर्ट') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ml-1">
                            <a href="{{ route('report.malepa') }}" class="nav-link @yield('report_malepa')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('मलेप रिपोर्ट') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ml-1">
                            <a href="{{ route('report.committee.dashboard') }}" class="nav-link @yield('report_comittee_dashboard')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('समिति बिस्तृत विवरण') }}</p>
                            </a>
                        </li>
                        
                        <li class="nav-item ml-1">
                            <a href="{{ route('report.yojana.detail') }}" class="nav-link @yield('report_yojana')">
                                <i class="fa-solid fa-book nav-icon"></i>
                                <p>{{ __('योजना बिस्तृत रिपोर्ट') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                    <!--<li class="nav-item">-->
                    <!--   <a href="{{ route('setting.list') }}" class="nav-link @yield('setting_yojana')">-->
                    <!--       <i class="fa-solid fa-gears nav-icon"></i>-->
                    <!--       <p>-->
                    <!--           {{ __('मास्टर सेटिङ') }}-->
                    <!--       </p>-->
                    <!-- </a> -->
                    <!--</li>-->
                @if(!auth()->user()->ward_no)
                    <li class="nav-item @yield('bhuktani_setting')">
                        <a href="#" class="nav-link">
                            <i class="fa-solid fa-gears nav-icon"></i>
                            <p>
                                {{ __('भुक्तानी सेटिङ्ग') }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ml-1">
                                <a href="{{ route('plan.setting.decimal_point.index') }}" class="nav-link @yield('bhuktani_setting_deciaml_point')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('Decimal Point') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(!auth()->user()->ward_no)
                    <li class="nav-item @yield('child_setting')">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-gears nav-icon"></i>
                        <p>
                            {{ __('सेटिङ्ग') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item ml-1">
                            <a href="{{ route('setting.list_registration_index') }}" class="nav-link @yield('setting_list_registration')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('सुची दर्ता') }}</p>
                            </a>
                        </li> --}}
                        <li class="nav-item ml-1">
                            <a href="{{ route('plan.setting.excel') }}" class="nav-link @yield('setting_excel_upload')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('EXCEL UPLOAD') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ml-1">
                            <a href="{{ route('setting.merge_index') }}" class="nav-link @yield('setting_merge')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('योजना जोड्नुहोस') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ml-1">
                            <a href="{{ route('plan.setting.term.index') }}" class="nav-link @yield('setting_term')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('शर्तहरु') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ml-1">
                            <a href="{{ route('setting.list_registration_bibaran_index') }}"
                                class="nav-link @yield('setting_list_registration_bibaran')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('सुची दर्ता') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ml-1">
                            <a href="{{ route('plan.setting.staff') }}"
                                class="nav-link @yield('setting_staff')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('कर्मचारी') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ml-1">
                            <a href="{{ route('setting_bank') }}" class="nav-link @yield('setting_slug')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('बैंक') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ml-1">
                            <a href="{{ route('plan.setting_deduction') }}" class="nav-link @yield('setting_deduction')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('कट्टी विवरण') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ml-1">
                            <a href="{{ route('contingency.index') }}" class="nav-link @yield('setting_contingency')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('कन्टेनजेन्सी') }}</p>
                            </a>
                        </li>
                        @foreach (App\Models\SharedModel\Setting::query()->where('can_be_updated_in_' . session('active_app'), 1)->get() as $setting)
                            <li class="nav-item ml-1">
                                <a href="{{ route('setting', $setting->slug) }}" class="nav-link @yield($setting->slug)">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ $setting->name }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
