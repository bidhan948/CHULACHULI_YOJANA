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
                        <a href="{{ route('program-operate.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-0 bg-primary text-center">{{ __('कार्यक्रम दर्ता नं : ') }} {{ Nepali($reg_no) }}
                        </p>
                        <form method="POST" action="{{ route('program.work_order.advanceUpdate',$program_advance) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" name="program_id" value="{{ $reg_no }}">
                                <div class="col-6 mt-2">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('कार्यादेश नं:') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <select name="work_order_id" id="work_order_id"
                                                class="form-control @error('work_order_id') is-invalid @enderror" disabled>
                                                <option value="">
                                                    {{ Nepali($program_advance->workOrder->work_order_no) }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('पेश्की रकम:') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control amount @error('amount') is-invalid @enderror"
                                                name="amount" id="amount" value="{{ $program_advance->amount }}"
                                                required>
                                            @error('amount')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('पेश्की रकम अनिवार्य छ') }}
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
                                                    class="input-group-text ">{{ __('पेश्की लिने मुख्य व्यक्तीको नाम:') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="" value="{{ $program_advance->name }}"
                                                required>
                                            @error('name')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('पेश्की रकम अनिवार्य छ') }}
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
                                                    class="input-group-text ">{{ __('पेश्की लिने मुख्य व्यक्तीको बाबुको नाम :') }}
                                                </span>
                                            </div>
                                            <input type="text"
                                                class="form-control @error('father_name') is-invalid @enderror"
                                                name="father_name" id=""
                                                value="{{ $program_advance->father_name }}">
                                            @error('father_name')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('पेश्की लिने मुख्य व्यक्तीको बाबुको नाम अनिवार्य छ') }}
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
                                                    class="input-group-text ">{{ __('पेश्की लिने मुख्य व्यक्तीको बाजेको नाम :') }}
                                                </span>
                                            </div>
                                            <input type="text"
                                                class="form-control @error('g_father_name') is-invalid @enderror"
                                                name="g_father_name" id=""
                                                value="{{ $program_advance->g_father_name }}">
                                            @error('g_father_name')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('पेश्की लिने मुख्य व्यक्तीको बाजेको नाम अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('पेश्की दिएको मिती :') }}<span
                                                        class="text-danger px-1 font-weight-bold">*</span>
                                                </span>
                                            </div>
                                            <input type="text"
                                                class="form-control nepali-date @error('advance_given_date_nep') is-invalid @enderror"
                                                name="advance_given_date_nep"
                                                value="{{ $program_advance->advance_given_date_nep }}" readonly
                                                required>
                                            @error('advance_given_date_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('पेश्की दिएको मिती अनिवार्य छ') }}
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
                                                    class="input-group-text ">{{ __('पेश्की फर्छ्यौट गर्नु पर्ने मिति :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span>
                                                </span>
                                            </div>
                                            <input type="text"
                                                class="form-control nepali-date @error('advance_paid_date_nep') is-invalid @enderror"
                                                name="advance_paid_date_nep"
                                                value="{{ $program_advance->advance_paid_date_nep }}" readonly required>
                                            @error('advance_paid_date_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('पेश्की फर्छ्यौट गर्नु पर्ने मिति अनिवार्य छ') }}
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
                                                    class="input-group-text ">{{ __('पेश्की दिनु पर्ने कारण :') }}<span
                                                        class="text-danger px-1 font-weight-bold">*</span>
                                                </span>
                                            </div>
                                            <input type="text"
                                                class="form-control @error('remark') is-invalid @enderror" name="remark"
                                                value="{{ $program_advance->remark }}" required>
                                            @error('remark')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('पेश्की दिनु पर्ने कारण अनिवार्य छ') }}
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
        let total_investment = 0;
        window.onload = function() {
            var date_fields = document.getElementsByClassName("nepali-date");
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

        $(function() {
            let municipality_amount = +
                {{ $program_advance->workOrder->count() ? $program_advance->workOrder->municipality_amount : 0 }};
            $("#amount").on('input', function() {
                var amount = $("#amount").val();
                if (amount > municipality_amount) {
                    alert("पेश्की रकम मिलेन");
                    $("#amount").val('');
                }
            });
        });
    </script>
@endsection
