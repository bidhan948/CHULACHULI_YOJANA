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

                        {{-- program peski --}}
                        @foreach ($program_advances as $program_advance)
                            <div class="accordion my-2" id="tole_bikas_samiti">
                                <div class="card">
                                    <div class="card-header bg-primary p-0" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-center text-white" type="button"
                                                data-toggle="collapse"
                                                data-target="#program_advance{{ $program_advance->id }}"
                                                aria-expanded="true"
                                                aria-controls="program_advance{{ $program_advance->id }}">
                                                {{ $program_advance->name . 'द्वारा लागिएको' }}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="program_advance{{ $program_advance->id }}" class="collapse "
                                        aria-labelledby="headingOne" data-parent="#tole_bikas_samiti">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row mx-2">
                                                    <div class="col-6">
                                                        @if ($loop->last)
                                                            <a href="{{ route('program.work_order.advance.edit', $program_advance) }}"
                                                                class="btn btn-primary"><i
                                                                    class="fa-solid fa-pen-to-square px-1"></i>
                                                                {{ __('सच्याउनुहोस्') }}</a>
                                                        @endif
                                                    </div>
                                                    <div class="col-12">
                                                        <table class="table table-bordered mt-1">
                                                            <thead>
                                                                <tr>
                                                                    <td class="text-right font-weight-bold"
                                                                        style="width:400px;">{{ __('कार्यादेश नं :') }}
                                                                    </td>
                                                                    <td style="width:400px;">
                                                                        {{ Nepali($program_advance->workOrder->work_order_no) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right font-weight-bold"
                                                                        style="width:400px;">{{ __('पेश्की रकम :') }}
                                                                    </td>
                                                                    <td style="width:400px;">
                                                                        रु {{ NepaliAmount($program_advance->amount) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right font-weight-bold"
                                                                        style="width:400px;">
                                                                        {{ __('पेश्की लिने मुख्य व्यक्तीको नाम:') }}
                                                                    </td>
                                                                    <td style="width:400px;">
                                                                        {{ $program_advance->name }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right font-weight-bold"
                                                                        style="width:400px;">
                                                                        {{ __('पेश्की लिने मुख्य व्यक्तीको बाबुको नाम :') }}
                                                                    </td>
                                                                    <td style="width:400px;">
                                                                        {{ $program_advance->father_name }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right font-weight-bold"
                                                                        style="width:400px;">
                                                                        {{ __('पेश्की लिने मुख्य व्यक्तीको बाजेको नाम :') }}
                                                                    </td>
                                                                    <td style="width:400px;">
                                                                        {{ $program_advance->g_father_name }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right font-weight-bold"
                                                                        style="width:400px;">
                                                                        {{ __('पेश्की दिएको मिती :') }}
                                                                    </td>
                                                                    <td style="width:400px;">
                                                                        {{ Nepali($program_advance->advance_given_date_nep) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right font-weight-bold"
                                                                        style="width:400px;">
                                                                        {{ __('पेश्की दिएको मिती :') }}
                                                                    </td>
                                                                    <td style="width:400px;">
                                                                        {{ Nepali($program_advance->advance_given_date_nep) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right font-weight-bold"
                                                                        style="width:400px;">
                                                                        {{ __('पेश्की फर्छ्यौट गर्नु पर्ने मिति :') }}
                                                                    </td>
                                                                    <td style="width:400px;">
                                                                        {{ Nepali($program_advance->advance_paid_date_nep) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right font-weight-bold"
                                                                        style="width:400px;">
                                                                        {{ __('कारण :') }}
                                                                    </td>
                                                                    <td style="width:400px;">
                                                                        {{ $program_advance->remark }}
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($work_order != null)
                            <form method="POST" action="{{ route('program.work_order.advanceSubmit') }}">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="program_id" value="{{ $program->id }}">
                                    <div class="col-6 mt-2">
                                        <div class="form-group mt-2">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('कार्यादेश नं:') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                                                </div>
                                                <select name="work_order_id" id="work_order_id"
                                                    class="form-control @error('work_order_id') is-invalid @enderror"
                                                    disabled>
                                                    <option value="">{{ Nepali($work_order->work_order_no) }}
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
                                                    name="amount" id="amount" value="" required>
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
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    name="name" id="" value="{{ old('name') }}" required>
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
                                                    value="{{ old('father_name') }}">
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
                                                    value="{{ old('g_father_name') }}">
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
                                                    name="advance_given_date_nep" readonly required>
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
                                                    name="advance_paid_date_nep" readonly required>
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
                                                    class="form-control @error('remark') is-invalid @enderror"
                                                    name="remark" required>
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
            let municipality_amount = +{{ $work_order == null ? 0 : $work_order->municipality_amount }};
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
