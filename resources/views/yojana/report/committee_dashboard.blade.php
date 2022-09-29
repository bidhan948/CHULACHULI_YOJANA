@section('title', 'समिति बिस्तृत रिपोर्ट')
@section('child_report', 'menu-open')
@section('report_comittee_dashboard', 'active')
@extends('layout.layout')
@section('sidebar')

    @if (session('active_app') == 'pis')
        @include('layout.pis_sidebar')
    @endif
    @if (session('active_app') == 'yojana')
        @include('layout.yojana_sidebar')
    @endif
    @if (session('active_app') == 'nagadi')
        @include('layout.yojana_sidebar')
    @endif
    @if (session('active_app') == 'byabasaye')
        @include('layout.byabasaye_sidebar')
    @endif
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">{{ __('समिति बिस्तृत :') }}</h3>
            </div>
            <!-- /.card-header -->

            <form action="{{route('commitee-dashboard-submit')}}" method="GET">
                @csrf
            <div class="my-2">
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('समिति छान्नुहोस् :') }}<span id="name_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <select name="type_id" id="type_id" class="form-control form-control-sm">
                                    @foreach (config('TYPE.NEPALI_ARRAY_NEW') as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('वडा छान्नुहोस् :') }}<span id="name_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <select name="ward_no" id="ward_no" class="form-control form-control-sm">
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    @for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++)
                                        <option value="{{ $i }}">{{ $i == 0 ? 'गाउँपालिका' : Nepali($i) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <button class="btn btn-sm btn-primary" type="submit" id="search"><i class="fa-solid fa-magnifying-glass px-1"></i>खोज्नुहोस्</button>
                    </div>
                </form>

                    {{-- <div class="col-12">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan.committe_report',['tole-bikas-samiti'])}}">{{ config('TYPE.1') . __(' मार्फत') }}</a>
                            </li>
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan.committe_report',['upabhokta-samiti'])}}">{{ config('TYPE.2') . __(' मार्फत') }}</a>
                            </li>
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan.committe_report',['sanstha-samiti'])}}">{{ config('TYPE.3') . __(' मार्फत') }}</a>
                            </li>
                            <li class="card shadow-lg">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/upabhokta-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{route('plan.committe_report',['amanat'])}}">{{ config('TYPE.4') . __(' मार्फत') }}</a>
                            </li>
                        </ul>
                    </div> --}}
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
   
@endsection
