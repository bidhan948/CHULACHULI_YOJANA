@section('title', $plan->name . ' पेश्की भुक्तानी')
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
                        <h3 class="card-title">{{ __('योजना संचालनमा पेश्की दिनु पर्ने अत्याबश्यक भएमा') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('plan_bhuktani.dashboard', $reg_no) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-3 bg-primary text-center">{{ $plan->name . __(' || योजना दर्ता नं : ') }}
                            {{ Nepali($reg_no) }}</p>

                        {{-- myad thap bibaran accordion --}}
                        @foreach ($add_deadline as $deadline)
                            <div class="accordion" id="add_deadline_Div{{ $deadline->id }}" style="margin-top:-10px;">
                                <div class="card">
                                    <div class="card-header bg-primary p-0" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-center text-white" type="button"
                                                data-toggle="collapse" data-target="#add_deadline_{{ $deadline->id }}"
                                                aria-expanded="true" aria-controls="program_bibaran">
                                                {{ convertNumberToNepaliWord($deadline->period) . ' म्याद थपिएको' }}
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="add_deadline_{{ $deadline->id }}" class="collapse "
                                        aria-labelledby="headingOne" data-parent="#add_deadline_Div{{ $deadline->id }}">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row mb-1">
                                                    @if ($loop->last)
                                                        <div class="col-6">
                                                            <a href="{{ route('plan.antim_myad_edit', $deadline) }}"
                                                                class="btn btn-sm btn-primary"><i
                                                                    class="fa-solid fa-pen-to-square px-1"></i>
                                                                {{ __('सच्याउनुहोस्') }}</a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <table id="table1" width="100%" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-center">{{ __('अबधि :') }}</td>
                                                            <td class="">
                                                                {{ convertNumberToNepaliWord($deadline->period) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ __('म्याद थपको लागी उपभोक्ता समितिले निबेदन दिएको मिती  :') }}
                                                            </td>
                                                            <td class="">{{ Nepali($deadline->consumer_date_nep) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ __('म्याद थपको कार्यालयबाट निर्णय भएको मिती :') }}
                                                            </td>
                                                            <td class="">
                                                                {{ Nepali($deadline->institution_date_add_nep) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">{{ __('थपिएको म्यादको अबधी :') }}
                                                            </td>
                                                            <td class="">
                                                                {{ Nepali($deadline->period_add_date_nep) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ __('योजना म्याद भित्र नसकिनुको कारण :') }}</td>
                                                            <td class="">{{ $deadline->remark }}
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- end of myad thap bibaran accordion --}}
                        <form method="POST" action="{{ route('plan.antim_myad_store') }}">
                            @csrf
                            <div class="row text-center">
                                <input type="hidden" name="plan_id" value="{{ $reg_no }}">
                                <div class="col-12 mt-2">
                                    <span class="font-weight-bold">{{ __('तोकिएको सम्पन्न मिति :') }}</span>
                                    <span class="px-1">{{ Nepali($plan->otherBibaran->end_date) }}</span>
                                </div>
                                @foreach ($add_deadline as $detail)
                                    <div class="col-12 mt-2">
                                        <span
                                            class="font-weight-bold">{{ convertNumberToNepaliWord($detail->period) . ' म्याद थपको मिति :' }}</span>
                                        <span class="px-1">{{ Nepali($detail->period_add_date_nep) }}</span>
                                    </div>
                                @endforeach
                                <div class="col-6 mt-3">
                                    <div class="form-group">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('अबधि :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control amount @error('period') is-invalid @enderror"
                                                name="period" id="period"
                                                value="{{ !$add_deadline->count() ? 'पहिलो' : convertNumberToNepaliWord($add_deadline->count() + 1) }}"
                                                required disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="form-group">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text ">{{ __('म्याद थपको लागी उपभोक्ता समितिले निबेदन दिएको मिती :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control nepali-date @error('consumer_date_nep') is-invalid @enderror"
                                                name="consumer_date_nep" id="consumer_date_nep" required>
                                            @error('consumer_date_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ 'म्याद थपको लागी उपभोक्ता समितिले निबेदन दिएको मिती अनिवार्य छ' }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text ">{{ __('म्याद थपको कार्यालयबाट निर्णय भएको मिती :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control nepali-date @error('institution_date_add_nep') is-invalid @enderror"
                                                name="institution_date_add_nep" id="institution_date_add_nep" required>
                                            @error('institution_date_add_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ 'म्याद थपको कार्यालयबाट निर्णय भएको मिती अनिवार्य छ' }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('थपिएको म्यादको अबधी :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control @error('period_add_date_nep') is-invalid @enderror"
                                                name="period_add_date_nep" id="period_add_date_nep" required>
                                            @error('period_add_date_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ 'थपिएको म्यादको अबधी अनिवार्य छ' }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text ">{{ __('योजना म्याद भित्र नसकिनुको कारण :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <textarea name="remark" class="form-control">{{ old('remark') }}</textarea>
                                            @error('remark')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ 'योजना म्याद भित्र नसकिनुको कारण अनिवार्य छ' }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary"
                                onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?')">{{ __('सेभ गर्नुहोस्') }}</button>
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
        let OtherBibaranSampannaDate =
            "{{ $add_deadline->count() ? $add_deadline->last()->period_add_date_nep : $plan->otherBibaran->end_date }}"
        window.onload = function() {
            var date_fields = document.getElementsByClassName("nepali-date");
            period_add_date_nep = document.getElementById('period_add_date_nep');
            period_add_date_nep.nepaliDatePicker({
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                onChange: function() {
                    if (OtherBibaranSampannaDate >= period_add_date_nep.value) {
                        alert("कृपया तोकिएको सम्पन्न मिति भन्दा पछिको मिति छान्नुहोस्");
                        period_add_date_nep.value = '';
                    }
                }
            });
            for (let index = 0; index < date_fields.length; index++) {
                const element = date_fields[index];
                element.nepaliDatePicker({
                    readOnlyInput: true,
                    ndpTriggerButton: false,
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10
                });
            }
        };
    </script>
@endsection
