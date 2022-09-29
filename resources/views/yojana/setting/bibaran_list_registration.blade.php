@section('title', $list_registration_attribute->name)
@section('setting_list_registration_bibaran', 'active')
@section('child_setting', 'menu-open')
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
                <div class="row">
                    <div class="col-12">
                        <h3 class="card-title">{{ __('सूची दर्ता विवरण') }}</h3>
                        <button class="float-right btn btn-primary btn-sm">
                            <a href="{{ route('setting.list_registration_bibaran_show') }}" class="btn btn-sm btn-primary"><i
                                    class="fa-solid fa-backward px-1"></i> {{ __('पछी जानुहोस्') }}</a>
                        </button>
                    </div>
                </div>
                <p class="mb-0 mt-3 bg-primary text-center">{{$list_registration_attribute->listRegistration->name}}</p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row" id="table">
                    <table id="table1" width="100%" class="table table-bordered my-2">
                        <thead>
                            <tr>
                                <td class="text-right font-weight-bold">{{ __('नाम :') }}</td>
                                <td>{{ $list_registration_attribute->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-right font-weight-bold">{{ __('ठेगाना :') }}</td>
                                <td>{{ Nepali($list_registration_attribute->list_registration_id == config('YOJANA.LIST_REGISTRATION.UPABHOKTA_SAMITI') ? config('constant.SITE_NAME') . ' ' . Nepali($list_registration_attribute->ward_no) : $list_registration_attribute->address) }}
                                </td>
                            </tr>
                            @if ($list_registration_attribute->list_registration_id != config('YOJANA.LIST_REGISTRATION.UPABHOKTA_SAMITI'))
                                <tr>
                                    <td class="text-right font-weight-bold">{{ __('सम्पर्क नं :') }}</td>
                                    <td>{{ Nepali($list_registration_attribute->contact_no) }}</td>
                                </tr>
                            @endif
                            @if ($list_registration_attribute->list_registration_id == config('YOJANA.LIST_REGISTRATION.KARMACHARI') || $list_registration_attribute->list_registration_id == config('YOJANA.LIST_REGISTRATION.PADADHIKARI'))
                                <tr>
                                    <td class="text-right font-weight-bold">{{ __('पद :') }}</td>
                                    <td>{{ Nepali($list_registration_attribute->post) }}</td>
                                </tr>
                            @endif
                            @if ($list_registration_attribute->list_registration_id == config('YOJANA.LIST_REGISTRATION.BYAKTI'))
                                <tr>
                                    <td class="text-right font-weight-bold">{{ __('नागरिकता नं :') }}</td>
                                    <td>{{ Nepali($list_registration_attribute->cit_no) }}</td>
                                </tr>
                            @endif
                            @if ($list_registration_attribute->list_registration_id == config('YOJANA.LIST_REGISTRATION.KARMACHARI'))
                                <tr>
                                    <td class="text-right font-weight-bold">{{ __('कार्यरत शाखा :') }}</td>
                                    <td>{{ $list_registration_attribute->working_branch }}</td>
                                </tr>
                            @endif
                        </thead>
                    </table>
                    @if ($list_registration_attribute->listRegistrationAttributeDetails->count())
                        <table id="table1" width="100%" class="table table-bordered my-2">
                            <thead>
                                <tr>
                                    <td class="text-center font-weight-bold">{{ __('#') }}</td>
                                    <td class="text-center font-weight-bold">{{ __('पद') }}</td>
                                    <td class="text-center font-weight-bold">{{ __('नाम') }}</td>
                                    <td class="text-center font-weight-bold">{{ __('लिङ्ग') }}</td>
                                    <td class="text-center font-weight-bold">{{ __('नागरिकता नं') }}</td>
                                    <td class="text-center font-weight-bold">{{ __('जारी जिल्ला') }}</td>
                                    <td class="text-center font-weight-bold">{{ __('सम्पर्क नं') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_registration_attribute->listRegistrationAttributeDetails as $key => $detail)
                                    <tr>
                                        <td class="text-center">{{ Nepali($key + 1) }}</td>
                                        <td class="text-center">{{ getSettingValueById($detail->post_id)->name }}</td>
                                        <td class="text-center">{{ $detail->name }}</td>
                                        <td class="text-center">{{ returnGender($detail->gender) }}</td>
                                        <td class="text-center">{{ Nepali($detail->cit_no) }}</td>
                                        <td class="text-center">{{ $detail->issue_district }}</td>
                                        <td class="text-center">{{ Nepali($detail->contact_no) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
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
