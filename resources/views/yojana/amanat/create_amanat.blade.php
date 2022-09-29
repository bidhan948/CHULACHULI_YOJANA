@section('title', config('TYPE.' . session('type_id')) . ' विवरण')
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
                        <h3 class="card-title">{{ config('TYPE.' . session('type_id')) . __(' विवरण ') }}</h3>
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
                        <p class="mb-0 bg-primary text-center p-2">{{ __('योजना दर्ता नं : ') }} {{ Nepali($regNo) }} ||
                            {{ $plan->name }}
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
                                                    <span>{{ __('नगरपालिकाबाट अनुदान : ') }}</span> <span
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
                        <form method="POST" action="{{ route('plan_amanat_marfat.store') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ config('TYPE.4') . __('को नाम:') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm napa-amount @error('name') is-invalid @enderror"
                                                name="name" id="name" required>
                                            @error('name')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ config('TYPE.4') . __(' नाम अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('ठेगाना :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span>
                                                </span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('address') is-invalid @enderror"
                                                name="address" id="address" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('नाम / थर:') }}
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" name="fullname"
                                                id="fullname">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('वडा नं:') }}</span>
                                            </div>
                                            <select name="ward_no" id="ward_no" class="form-control form-control-sm ">
                                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                @for ($i = 1; $i < 20; $i++)
                                                    <option value="{{ $i }}">{{ Nepali($i) }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('लिङ्ग:') }}</span>
                                            </div>
                                            <select name="gender" id="gender" class="form-control form-control-sm ">
                                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                @foreach (config('constant.GENDER') as $key => $gender)
                                                    <option value="{{ $key }}">{{ $gender }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('नागरिकता नं :') }}
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" name="cit_no"
                                                id="cit_no">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('जारी जिल्ला :') }}
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm"
                                                value="{{ old('issue_district') }}" name="issue_district"
                                                id="issue_district">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('मोबाइल नं :') }}
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm"
                                                value="{{ old('mobile_no') }}" name="mobile_no" id="mobile_no">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-sm btn-primary"
                                        onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?');">{{ __('सेभ गर्नुहोस्') }}</button>
                                </div>
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
