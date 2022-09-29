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
                        <a href="{{ route('plan_bhuktani.dashboard', $reg_no) }}" class="btn btn-sm btn-primary"><i
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
                        <form method="POST" action="{{ route('program.add_deadline.store') }}">
                            @csrf
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text ">{{ __('कार्यादेश नं :') }}
                                                <span class="text-danger px-1 font-weight-bold">*</span></span>
                                        </div>
                                        <select name="work_order_id" id="work_order_id"
                                            class="form-control @error('work_order_id') is-invalid @enderror" required>
                                            <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                            @foreach ($work_orders as $work_order)
                                                <option value="{{ $work_order->id }}">
                                                    {{ Nepali($work_order->work_order_no) . ' (' . $work_order->name . ')' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" id="date_part">

                            </div>
                            <div class="row text-center">
                                <input type="hidden" name="plan_id" value="{{ $reg_no }}">
                                <div class="col-6 mt-3">
                                    <div class="form-group">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('अबधि :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control amount @error('period') is-invalid @enderror"
                                                name="period" id="period" value="" required disabled>
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
                                                name="letter_date_nep" id="letter_date_nep" required>
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
                                                    class="input-group-text">{{ __('कार्यक्रम म्याद भित्र नसकिनुको कारण :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <textarea name="remark" class="form-control" required>{{ old('remark') }}</textarea>
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
        let ProgramSampannaDate =
            "{{ $add_deadline->count() ? $add_deadline->last()->program_end_date_nep : $program->date_nep }}"
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

            $(function() {
                $("#work_order_id").on("change", function() {
                    var work_order_id = $("#work_order_id").val();
                    if (work_order_id == "") {
                        alert("कार्यदेश नं अनिवार्य छ");
                        $("#date_part").html("");
                        $("#period").val("");
                    } else {
                        axios.get("{{ route('api.program.getPeriodByWorkOrderNo') }}", {
                            params: {
                                work_order_id: work_order_id
                            }
                        }).then(function(response) {
                            $("#date_part").html(response.data.html);
                            $("#period").val(response.data.period);
                            ProgramSampannaDate = response.data.date;
                        }).catch(function(error) {
                            console.log(error);
                            alert("Something went wrong ...");
                        });
                    }
                })
            });
        };
    </script>
@endsection
