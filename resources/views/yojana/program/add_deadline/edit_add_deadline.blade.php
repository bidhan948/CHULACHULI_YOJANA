@section('title', $program->name . ' पेश्की भुक्तानी')
@section('operate_program', 'active')
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
                        <h3 class="card-title">{{ __('कार्यक्रम संचालनमा पेश्की दिनु पर्ने अत्याबश्यक भएमा') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('program.add_deadline', $reg_no) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-3 bg-primary text-center">{{ $program->name . __(' || कार्यक्रम दर्ता नं : ') }}
                            {{ Nepali($reg_no) }}</p>
                        <table id="table1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-right">{{ __('कार्यदेश नं :') }}</th>
                                    <th style="font-weight:500; width:50%;">
                                        {{ Nepali($program_add_deadline->workOrder->work_order_no) }}</th>
                                </tr>
                                <tr>
                                    <th class="text-right">{{ __('कार्यदेशको नाम :') }}</th>
                                    <th style="font-weight:500; width:50%;">
                                        {{ Nepali($program_add_deadline->workOrder->name) }}</th>
                                </tr>
                                <tr>
                                    <th class="text-right">{{ __('अबधि :') }}</th>
                                    <th style="font-weight:500; width:50%;">
                                        {{ convertNumberToNepaliWord($program_add_deadline->period) }}</th>
                                </tr>
                                <tr>
                                    <th class="text-right">{{ __('म्याद थपको लागी निबेदन दिएको मिती :') }}</th>
                                    <th style="font-weight:500; width:50%;">
                                        {{ Nepali($program_add_deadline->letter_date_nep) }}
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-right">{{ __('म्याद थपको कार्यालयबाट निर्णय भएको मिती :') }}</th>
                                    <th style="font-weight:500; width:50%;">
                                        {{ Nepali($program_add_deadline->institution_date_add_nep) }}
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-right">{{ __('थपिएको म्यादको अबधी :') }}</th>
                                    <th style="font-weight:500; width:50%;">
                                        {{ Nepali($program_add_deadline->period_add_date_nep) }}
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-right">{{ __('कार्यक्रम म्याद भित्र नसकिनुको कारण :') }}</th>
                                    <th style="font-weight:500; width:50%;">{{ $program_add_deadline->remark }}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        @if ($isEditable)
                            <form method="POST" action="{{ route('program.add_deadline.update', $program_add_deadline) }}">
                                @csrf
                                @method('PUT')
                                <div class="row text-center">
                                    <input type="hidden" name="plan_id" value="{{ $program->id }}">
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
                                                    value="{{ convertNumberToNepaliWord($program_add_deadline->period) }}"
                                                    required disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <div class="form-group">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('म्याद थपको लागी निबेदन दिएको मिती :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                                                </div>
                                                <input type="text"
                                                    class="form-control nepali-date @error('letter_date_nep') is-invalid @enderror"
                                                    name="letter_date_nep" id="letter_date_nep"
                                                    value="{{ $program_add_deadline->letter_date_nep }}" required>
                                                @error('letter_date_nep')
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
                                                    name="institution_date_add_nep" id="institution_date_add_nep"
                                                    value="{{ $program_add_deadline->institution_date_add_nep }}" required>
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
                                                    name="period_add_date_nep" id="period_add_date_nep"
                                                    value="{{ $program_add_deadline->period_add_date_nep }}" required>
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
                                                        class="input-group-text">{{ __('कार्यक्रम म्याद भित्र नसकिनुको कारण :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                                                </div>
                                                <textarea name="remark" class="form-control" required>{{ $program_add_deadline->remark }}</textarea>
                                                @error('remark')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ 'कार्यक्रम म्याद भित्र नसकिनुको कारण अनिवार्य छ' }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary"
                                    onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?')">{{ __('सेभ गर्नुहोस्') }}</button>
                            </form>
                        @endif
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
        let ProgramSampannaDate = "{{ $date }}";
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
                    if (ProgramSampannaDate >= period_add_date_nep.value) {
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
