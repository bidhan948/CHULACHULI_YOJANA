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
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <ul class="users-list clearfix">

                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan-operate.search',['upabhokta-samiti'])}}">{{ config('TYPE.2') . __(' मार्फत') }}</a>
                            </li>
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan-operate.search',['tole-bikas-samiti'])}}">{{ config('TYPE.1') . __(' मार्फत') }}</a>
                            </li>
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan-operate.search',['thekka-marfat'])}}">{{ config('TYPE.5') . __(' मार्फत') }}</a>
                            </li>
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan-operate.search',['sanstha-samiti'])}}">{{ config('TYPE.3') . __(' मार्फत') }}</a>
                            </li>
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan-operate.search',['amanat'])}}">{{ config('TYPE.4') . __(' मार्फत') }}</a>
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
@endsection
