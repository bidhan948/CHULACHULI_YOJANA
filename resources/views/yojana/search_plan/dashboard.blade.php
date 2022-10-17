@section('title', 'योजना संचालन प्रक्रिया')
@section('operate_plan', 'active')
@extends('layout.layout')
@section('sidebar')
    @include('layout.yojana_sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">{{ __('योजना संचालन प्रक्रिया') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('plan-operate.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                    <div class="col-12 mt-2">
                        <p class="mb-0 p-2 text-center bg-primary">{{ $plan->name }}</p>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">

                    @if (config('TYPE.' . session('type_id')) == 'ठेक्का')
                        <div class="col-3">
                            <ul class="users-list clearfix">
                                <li class="card shadow-lg" style="width:100%;">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image"
                                            class="img-fluid" width="50">
                                    </div>
                                    <a class="users-list-name mt-3 font-weight-bold"
                                        href="{{ route('thekka-suchana-detail', $reg_no) }}">{{ __('ठेक्का सुचना विवरण') }}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-3">
                            <ul class="users-list clearfix">
                                <li class="card shadow-lg" style="width:100%;">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('yojana/report-icon.png') }}" alt="User Image" class="img-fluid"
                                            width="50">
                                    </div>
                                    <a class="users-list-name mt-3 font-weight-bold"
                                        href="{{ route('thekka-open', $reg_no) }}">{{ __('ठेक्का खोलिएको फारम') }}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-3">
                            <ul class="users-list clearfix">
                                <li class="card shadow-lg" style="width:100%;">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('yojana/report-icon.png') }}" alt="User Image" class="img-fluid"
                                            width="50">
                                    </div>
                                    <a class="users-list-name mt-3 font-weight-bold"
                                        href="{{ route('thekka-kabol', $reg_no) }}">{{ __('ठेक्का कबोल फारम') }}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-3">
                            <ul class="users-list clearfix">
                                <li class="card shadow-lg" style="width:100%;">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('yojana/report-icon.png') }}" alt="User Image" class="img-fluid"
                                            width="50">
                                    </div>
                                    <a class="users-list-name mt-3 font-weight-bold"
                                        href="{{ route('thekka-boli', $reg_no) }}">{{ __('ठेक्का बोलिने फारम') }}</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route(session('type_id') == config('TYPE.CONTRACT_MARFAT') ? 'plan.thekka_kul_lagat' : 'plan.kul-lagat', $reg_no) }}">{{ __('योजनाको कुल लागत अनुमान') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/user-profile.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route(session('type_id') != config('TYPE.CONTRACT_MARFAT') ? 'plan.consumer-bibaran' : 'plan.thekka_bibaran', $reg_no) }}">{{ config('TYPE.' . session('type_id')) . ' विवरण ' }}</a>
                            </li>
                        </ul>
                    </div>
                    @if (session('type_id') != config('TYPE.CONTRACT_MARFAT'))
                        <div class="col-3">
                            <ul class="users-list clearfix">
                                <li class="card shadow-lg" style="width:100%;">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('yojana/user-profile.png') }}" alt="User Image"
                                            class="img-fluid" width="50">
                                    </div>
                                    <a class="users-list-name mt-3 font-weight-bold"
                                        href="{{ route('plan.anugaman', $reg_no) }}">{{ 'अनुगमन समितिको विवरण ' }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="users-list clearfix">
                                <li class="card shadow-lg" style="width:100%;">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('yojana/report-icon.png') }}" alt="User Image" class="img-fluid"
                                            width="50">
                                    </div>
                                    <a class="users-list-name mt-3 font-weight-bold"
                                        href="{{ route('plan.other_bibaran', $reg_no) }}">{{ __('योजना सम्बन्धि अन्य विवरण ') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="users-list clearfix">
                                <li class="card shadow-lg" style="width:100%;">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('yojana/report-icon.png') }}" alt="User Image"
                                            class="img-fluid" width="50">
                                    </div>
                                    <a class="users-list-name mt-3 font-weight-bold"
                                        href="{{ route('plan_bhuktani.dashboard', $reg_no) }}">{{ __('भुक्तानी') }}</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/patra-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('letter.dashboard', $reg_no) }}">{{ __('पत्रहरु') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $('#table1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#table1_wrapper').css("width", "100%");
        });
    </script>
@endsection
