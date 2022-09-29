@section('title', $plan->name . ' को विवरण')
@section('operate_plan', 'active')
@extends('layout.layout')
@section('sidebar')
    @include('layout.yojana_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">{{ __('अन्य विवरण') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('plan-operate.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-0 bg-primary text-center p-2">{{ __('योजना दर्ता नं : ') }} {{ Nepali($regNo) }}
                        </p>

                        {{-- yojana bibaran accordion --}}
                        <div class="accordion" id="yojana">
                            <div class="card">
                                <div class="card-header bg-primary mt-2 p-0" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-center text-white" type="button"
                                            data-toggle="collapse" data-target="#yojana_bibaran" aria-expanded="true"
                                            aria-controls="yojana_bibaran">
                                            {{ __('योजनाको बिबरण') }}
                                        </button>
                                    </h2>
                                </div>

                                <div id="yojana_bibaran" class="collapse " aria-labelledby="headingOne"
                                    data-parent="#yojana">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row mx-2">
                                                <div class="col-4">
                                                    <span>{{ __('दर्ता नं :') }}</span> <span
                                                        class="font-weight-bold">{{ Nepali($plan->reg_no) }}</span> <br>
                                                    <span class="py-2">{{ __('योजनाको नाम :') }}</span> <span
                                                        class="font-weight-bold py-2">{{ $plan->name }}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>{{ __('योजनाको क्षेत्रको नाम :') }}</span> <span
                                                        class="font-weight-bold">{{ getSettingValueById($plan->topic_id)->name }}</span>
                                                    <br>
                                                    <span>{{ __('योजनाको उपक्षेत्रको नाम :') }}</span> <span
                                                        class="font-weight-bold">{{ getSettingValueById($plan->topic_area_type_id)->name }}</span>
                                                    <br>
                                                </div>
                                                <div class="col-4">
                                                    <span>{{ __('योजनाको विनियोजन किसिम  :') }}</span> <span
                                                        class="font-weight-bold">{{ getSettingValueById($plan->type_of_allocation_id)->name }}</span>
                                                    <br>
                                                    <span>{{ __('योजना सचालन हुने स्थान :') }}</span> <span
                                                        class="font-weight-bold">{{ config('constant.SITE_NAME') }}</span>
                                                    <br>
                                                    <span>{{ __('अनुदान रकम :') }}</span> <span
                                                        class="font-weight-bold"><span
                                                            class="px-1">रु</span>{{ NepaliAmount($plan->grant_amount) }}</span>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end of yojana bibaran accordion --}}
                        {{-- yojana kul lagat --}}
                        @if (session('type_id') == config('TYPE.AMANAT_MARFAT'))
                            <div class="accordion" id="amanat" style="margin-top:-10px;">
                                <div class="card">
                                    <div class="card-header bg-primary p-0" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-center text-white" type="button"
                                                data-toggle="collapse" data-target="#amanat_bibaran" aria-expanded="true"
                                                aria-controls="amanat_bibaran">
                                                {{ __('योजनाको अमानतको विवरण') }}
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="amanat_bibaran" class="collapse " aria-labelledby="headingOne"
                                        data-parent="#amanat">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row mx-2">
                                                    <div class="col-4">
                                                        <span>{{ __('आमानतको नाम : ') }}</span> <span
                                                            class="font-weight-bold"><span class="px-1">
                                                            </span>{{ $type->name }}</span> <br>
                                                        <span>{{ __('ठेगाना : ') }}</span> <span
                                                            class="font-weight-bold"><span class="px-1">
                                                            </span>{{ $type->address }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- end of yojana kul lagat --}}

                        {{-- yojana kul lagat --}}
                        <div class="accordion" id="kul_lagat" style="margin-top:-10px;">
                            <div class="card">
                                <div class="card-header bg-primary p-0" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-center text-white" type="button"
                                            data-toggle="collapse" data-target="#kul_lagat_bibaran" aria-expanded="true"
                                            aria-controls="kul_lagat_bibaran">
                                            {{ __('योजनाको कुल लागत अनुमान') }}
                                        </button>
                                    </h2>
                                </div>

                                <div id="kul_lagat_bibaran" class="collapse " aria-labelledby="headingOne"
                                    data-parent="#kul_lagat">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row mx-2">
                                                <div class="col-4">
                                                    <span>{{ __('गाउँपालिकाबाट अनुदान : ') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->napa_amount) }}</span> <br>
                                                    <span>{{ __('अन्य निकायबाट प्राप्त अनुदान : ') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->other_office_con) }}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>{{ __('उपभोक्ताबाट नगद साझेदारी :') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->customer_agreement) }}</span>
                                                    <br>
                                                    <span>{{ __('अन्य साझेदारी : ') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->other_office_agreement) }}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>{{ __('उपभोक्ताबाट जनश्रमदान :') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->consumer_budget) }}</span>
                                                    <br>
                                                    <span>{{ __('कुल लागत अनुमान जम्मा : ') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->total_investment) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end of yojana kul lagat --}}

                        {{-- yojana tole bikas samiti --}}
                        @if (session('type_id') != config('TYPE.AMANAT_MARFAT'))
                            <div class="accordion" id="tole_bikas_samiti" style="margin-top:-10px;">
                                <div class="card">
                                    <div class="card-header bg-primary p-0" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-center text-white" type="button"
                                                data-toggle="collapse" data-target="#tole_bikas_samiti_bibaran"
                                                aria-expanded="true" aria-controls="tole_bikas_samiti_bibaran">
                                                {{ config('TYPE.' . session('type_id')) . 'को विवरण' }}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="tole_bikas_samiti_bibaran" class="collapse " aria-labelledby="headingOne"
                                        data-parent="#tole_bikas_samiti">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row mx-2">
                                                    <div class="col-6">
                                                        <span>{{ config('TYPE.' . session('type_id')) . 'को नाम :' }}</span>
                                                        <span class="font-weight-bold"><span
                                                                class="px-1">{{ $type->name }}</span></span>
                                                        <br>
                                                    </div>
                                                    <div class="col-6">
                                                        <span>{{ 'योजनाको संचालन गर्ने ' . config('TYPE.' . session('type_id')) . 'को ठेगाना:' }}</span>
                                                        <span class="font-weight-bold"><span
                                                                class="px-1">{{ $type->name }}</span></span>
                                                        <br>
                                                    </div>
                                                    <div class="col-12">
                                                        <table class="table table-bordered mt-3">
                                                            <thead>
                                                                <tr>
                                                                    <td class="text-center">{{ __('सि.नं.') }}</td>
                                                                    <td class="text-center">{{ __('पद') }}</td>
                                                                    <td class="text-center">{{ __('नाम/ थर') }}</td>
                                                                    <td class="text-center">{{ __('वडा नं') }}</td>
                                                                    <td class="text-center">{{ __('लिङ्ग') }}</td>
                                                                    <td class="text-center">{{ __('नागरिकता नं') }}
                                                                    </td>
                                                                    <td class="text-center">{{ __('जारी जिल्ला') }}
                                                                    </td>
                                                                    <td class="text-center">{{ __('मोबाइल नं') }}</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($type->$relationName as $key => $relation)
                                                                    <tr>
                                                                        <td class="text-center">{{ Nepali($key + 1) }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ getSettingValueById(session('type_id') == 1 ? $relation->position : $relation->post_id)->name }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $relation->name }}</td>
                                                                        <td class="text-center">
                                                                            {{ Nepali($relation->ward_no) }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ returnGender($relation->gender) }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ Nepali($relation->cit_no) }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $relation->issue_district }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ Nepali($relation->contact_no) }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- end of yojana tole bikas samiti --}}

                        {{-- yojana anugman samiti --}}
                        @if (session('type_id') != config('TYPE.AMANAT_MARFAT'))
                            <div class="accordion" id="anugaman_samiti" style="margin-top:-10px;">
                                <div class="card">
                                    <div class="card-header bg-primary p-0" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-center text-white" type="button"
                                                data-toggle="collapse" data-target="#anugaman_samiti_bibaran"
                                                aria-expanded="true" aria-controls="anugaman_samiti_bibaran">
                                                {{ __('अनुगमन समितिको विवरण') }}
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="anugaman_samiti_bibaran" class="collapse " aria-labelledby="headingOne"
                                        data-parent="#anugaman_samiti">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row mx-2">
                                                    <div class="col-6">
                                                        <span>{{ __('अनुगमन समितिको नाम :') }}</span>
                                                        <span class="font-weight-bold"><span
                                                                class="px-1">{{ $anugaman_plan->anugamanSamiti->name }}</span></span>
                                                        <br>
                                                    </div>
                                                    <div class="col-6">
                                                        <span>{{ __('अनुगमन समितिको ठेगाना:') }}</span>
                                                        <span class="font-weight-bold"><span
                                                                class="px-1">{{ config('constant.SITE_NAME') }}</span></span>
                                                        <br>
                                                    </div>
                                                    <div class="col-12">
                                                        <table class="table table-bordered mt-3">
                                                            <thead>
                                                                <tr>
                                                                    <td class="text-center">{{ __('सि.नं.') }}</td>
                                                                    <td class="text-center">{{ __('पद') }}</td>
                                                                    <td class="text-center">{{ __('नाम/ थर') }}</td>
                                                                    <td class="text-center">{{ __('वडा नं') }}</td>
                                                                    <td class="text-center">{{ __('लिङ्ग') }}</td>
                                                                    <td class="text-center">{{ __('मोबाइल नं') }}
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($anugaman_plan->anugamanSamiti->anugamanSamitiDetails as $key => $anugaman_samiti_detail)
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            {{ Nepali($key + 1) }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ getSettingValueById($anugaman_samiti_detail->post_id)->name }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $anugaman_samiti_detail->name }}</td>
                                                                        <td class="text-center">
                                                                            {{ Nepali($anugaman_samiti_detail->ward_no == null ? '--' : $anugaman_samiti_detail->ward_no) }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ returnGender($anugaman_samiti_detail->gender) }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ Nepali($anugaman_samiti_detail->mobile_no) }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- end of yojana anugman samiti --}}

                        <form method="POST" action="{{ route('other-bibaran.store') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <input type="hidden" name="post[]" id="post_0" value="">
                                @if (session('type_id') != config('TYPE.AMANAT_MARFAT'))
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text">{{ config('TYPE.' . session('type_id')) . ' गठन भएको मिति' }}
                                                        <span id="tole_bikas_group"
                                                            class="text-danger font-weight-bold px-1">*</span></span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-control-sm @error('formation_start_date') is-invalid @enderror"
                                                    name="formation_start_date" id="formation_start_date"
                                                    value="{{ old('formation_start_date') }}" required>
                                                @error('formation_start_date')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ config('TYPE.' . session('type_id')) . ' गठन भएको मिति अनिवार्य छ' }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text">{{ config('TYPE.' . session('type_id')) . ' भेलामा उपस्थिति संख्या' }}
                                                        <span id="tole_bikas_group"
                                                            class="text-danger font-weight-bold px-1">*</span></span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-control-sm number @error('committee_count') is-invalid @enderror"
                                                    name="committee_count" value="{{ old('committee_count') }}"
                                                    id="committee_count" required>
                                                @error('committee_count')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ config('TYPE.' . session('type_id')) . ' भेलामा उपस्थिति संख्या अनिवार्य छ' }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('योजना शुरु हुने मिति') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('start_date') is-invalid @enderror"
                                                name="start_date" id="start_date" required>
                                            @error('start_date')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ 'योजना शुरु हुने मिति अनिवार्य छ' }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('योजना सम्पन्न हुने मिति:') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('end_date') is-invalid @enderror"
                                                name="end_date" id="end_date" required>
                                            @error('end_date')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ 'योजना सम्पन्न हुने मिति अनिवार्य छ' }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div id="rowForAdd">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mt-2">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text">{{ __('गाउँपालिकाको तर्फबाट संझौता गर्नेको नाम:') }}
                                                            <span class="text-danger font-weight-bold px-1">*</span></span>
                                                    </div>
                                                    <select name="staff_id[]" id="staff_id_0" onchange="assignPost(0)"
                                                        class="form-control form-control-sm @error('staff_id') is-invalid @enderror" required>
                                                        <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                        @foreach ($staffs as $staff)
                                                            <option value="{{ $staff->user_id }}">
                                                                {{ $staff->nep_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('staff_id')
                                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                                            {{ config('TYPE.' . session('type_id')) . ' भेलामा उपस्थिति संख्या अनिवार्य छ' }}
                                                        </p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mt-2">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">{{ __('पद:') }}
                                                            <span class="text-danger font-weight-bold px-1">*</span></span>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm" id="post_id_0"
                                                        name="post_id[]" readonly required>
                                                    @error('post_id')
                                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                                            {{ 'पद अनिवार्य छ' }}
                                                        </p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mt-2">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">{{ __('सम्झौता मिति') }}
                                                            <span id="tole_bikas_group"
                                                                class="text-danger font-weight-bold px-1">*</span></span>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control my-date form-control-sm number @error('date') is-invalid @enderror"
                                                        name="agreement_date_nep" id="date" required>
                                                    @error('date')
                                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                                            {{ 'सम्झौता मिति अनिवार्य छ' }}
                                                        </p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <a class="btn btn-sm btn-primary" id="add"><i
                                                    class="fa-solid fa-plus px-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <p class="mb-0 bg-dark text-center">
                                        {{ __('योजनाबाट लाभान्वित घरधुरी तथा परिबारको विबरण') }}
                                    </p>
                                    <table id="table1" width="100%" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="4" class="text-center">लाभान्वित जनसंख्या</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">{{ __('घर परिवार संख्या') }}</th>
                                                <th class="text-center">{{ __('महिला') }}</th>
                                                <th class="text-center">{{ __('पुरुष') }}</th>
                                                <th class="text-center">{{ __('जम्मा') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text"
                                                        class="form-control form-control-sm number @error('house_family_count') is-invalid @enderror"
                                                        name="house_family_count"
                                                        value="{{ old('house_family_count') }}">
                                                </td>
                                                <td class="text-center">
                                                    <input type="text"
                                                        class="form-control form-control-sm number  calculate-total @error('female') is-invalid @enderror"
                                                        name="female" value="{{ old('female') }}">
                                                </td>
                                                <td class="text-center">
                                                    <input type="text"
                                                        class="form-control form-control-sm number calculate-total @error('male') is-invalid @enderror"
                                                        name="male" value="{{ old('male') }}" >
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control number form-control-sm"
                                                        name="total" value="{{ old('total') }}" id="total" disabled>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary"
                                onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ? ')">{{ __('सेभ गर्नुहोस्') }}</button>
                        </form>
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
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>
    <script>
        let check = +{{ session('type_id') == config('TYPE.AMANAT_MARFAT') ? 0: 1 }};
        window.onload = function() {
            if (check) {
                var mainInput = document.getElementById("formation_start_date");
                mainInput.nepaliDatePicker({
                    readOnlyInput: true,
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 100
                });
            }
            var startDate = document.getElementById("start_date");
            var endDate = document.getElementById("end_date");
            var date = document.getElementById("date");
            startDate.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100
            });
            endDate.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100
            });
            date.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100
            });
        }
        let i = 1;
        let html = '';
        $(function() {
            $('.calculate-total').on("input", function() {
                var total = 0;
                $('.calculate-total').each(function() {
                    total += Number($(this).val()) || 0;
                });
                $("#total").val(total);
            });
            $("#add").on("click", function() {
                    if (i < 3) {
                        html = '<div class="row" id="remove_'+i+'">'
                                +'<input name="post[]" id="post_'+i+'" type="hidden">'
                                +'<div class="col-6">'
                                    +'<div class="form-group mt-2">'
                                        +'<div class="input-group input-group-sm">'
                                            +'<div class="input-group-prepend">'
                                                +'<span class="input-group-text">{{ __("गाउँपालिकाको तर्फबाट संझौता गर्नेको नाम:") }}'
                                                    +'<span class="text-danger font-weight-bold px-1">*</span></span>'
                                            +'</div>'
                                            +'<select name="staff_id[]" id="staff_id_'+i+'" onchange="assignPost('+i+')" class="form-control form-control-sm ">'
                                                +'<option value="">{{ __("--छान्नुहोस्--") }}</option>'
                                                +'@foreach ($staffs as $staff)'
                                                   +'<option value="{{ $staff->user_id }}">'
                                                        +'{{ $staff->nep_name }}'
                                                    +'</option>'
                                                +'@endforeach'
                                            +'</select>'
                                        +'</div>'
                                        +'</div>'
                                        +'</div>'
                                +'<div class="col-5">'
                                    +'<div class="form-group mt-2">'
                                        +'<div class="input-group input-group-sm">'
                                            +'<div class="input-group-prepend">'
                                                +'<span class="input-group-text">{{ __("पद:") }}'
                                                    +'<span id="staff_id"'
                                                        +'class="text-danger font-weight-bold px-1">*</span></span>'
                                            +'</div>'
                                            +'<input type="text"'
                                                +'class="form-control form-control-sm"'
                                                +'id="post_id_'+i+'" name="" readonly>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                                +'<div class="col-1 mt-2">'
                                    +'<a class="btn btn-sm btn-danger" onclick="removeRow('+i+')"><i class="fa-solid fa-circle-xmark"></i></a>'
                                +'</div>'
                            +'</div>'
                            +'</div>';
                                $("#rowForAdd").append(html);
                                i++;
                    }else{
                        alert('Maximum limit is 3');
                    }
                });
        });

        function removeRow(row) {
            $("#remove_" + row).remove();
            i--;
        }

        function assignPost(staffRow) {
            var staff_id = $("#staff_id_" + staffRow).val();
            if (staff_id == '') {
                alert('गाउँपालिकाको तर्फबाट संझौता गर्नेको नाम: खाली छ');
                $("#post_id_" + staffRow).val('');
            } else {
                axios.get("{{ route('api.getPostByStaffId') }}", {
                        params: {
                            staff_id: staff_id
                        }
                    }).then(function(response) {
                        $("#post_" + staffRow).val(response.data.post_id);
                        $("#post_id_" + staffRow).val(response.data.post);
                    })
                    .catch(function(error) {
                        console.log(error);
                        alert("Something went wrong");
                    });
            }
        }
    </script>
@endsection
