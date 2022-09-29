@section('title', $program->name . ' अन्तिम भुक्तानी')
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
                        <h3 class="card-title">{{ __('कार्यक्रमको अन्तिम भुक्तानी') }}</h3>
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
                        <form method="POST" action="{{ route('program.final_bhuktani_store') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="plan_id" value="{{ $program->id }}">
                                <div class="col-4 mt-2">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('कार्यादेश नं:') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <select name="work_order_id" id="work_order_id"
                                                class="form-control @error('work_order_id') is-invalid @enderror">
                                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                @foreach ($program->workOrder as $key => $workOrder)
                                                    <option value="{{ $workOrder->id }}">
                                                        {{ Nepali($workOrder->work_order_no) . ' (' . $workOrder->name . ')' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mt-2">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('कार्यक्रमको बाकी रकम :') }}</span>
                                            </div>
                                            <input type="text" id="program_baki_amount"
                                                value="{{ Nepali($remain_amount) }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mt-2">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('कार्यक्रम संचालन गर्ने :') }}</span>
                                            </div>
                                            <input type="text" id="program_runner" value="" class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="main_form">
                                    <div class="col-12">
                                        <table class="letter_table table table-bordered my-3">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th class="text-center">{{ config('constant.SITE_TYPE') }}{{ __('बाट') }}</th>
                                                    <th class="text-center">{{ __('नगद साझेदारी') }}</th>
                                                    <th class="text-center">{{ __('लागत सहभागिता') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_budget_row">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('भुक्तानी दिएको मिति :') }} <span
                                                            class="text-danger px-1 font-weight-bold">*</span></span>
                                                </div>
                                                <input type="text" name="paid_date"
                                                    class="form-control @error('paid_date') is-invalid @enderror" id="date">
                                                @error('paid_date')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ 'भुक्तानी दिएको मिति अनिवार्य छ' }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('भुक्तानी दिनु पर्ने कुल रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                                                </div>
                                                <input type="text" id="work_order_budget" name="work_order_budget"
                                                    class="form-control @error('work_order_budget') is-invalid @enderror amount"
                                                    value="0" required readonly>
                                                @error('work_order_budget')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ 'भुक्तानी दिनु पर्ने कुल रकम अनिवार्य छ' }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('बिल रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                                                </div>
                                                <input type="text" id="bill_amount" name="bill_amount"
                                                    class="form-control @error('bill_amount') is-invalid @enderror amount"
                                                    value="0" required>
                                                @error('bill_amount')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ 'बिल रकम अनिवार्य छ' }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('भुक्तानी घटी कट्टी रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                                                </div>
                                                <input type="text" id="bhuktani_ghati_katti_rakam"
                                                    name="bhuktani_ghati_katti_rakam"
                                                    class="form-control @error('bhuktani_ghati_katti_rakam') is-invalid @enderror amount"
                                                    value="0" required readonly>
                                                @error('bhuktani_ghati_katti_rakam')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ 'भुक्तानी घटी कट्टी रकम अनिवार्य छ' }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($deductions as $deductionKey => $deduction)
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text ">{{ $deduction->name }}
                                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                                    </div>
                                                    <input type="text" id="katti_{{ $deduction->id }}"
                                                        name="katti[{{ $deduction->id }}]"
                                                        class="form-control amount deduction" value="0" required>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('पेश्की भुक्तानी लगेको कट्टी रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                                                </div>
                                                <input type="text" id="program_advance" name="program_advance"
                                                    class="form-control @error('program_advance') is-invalid @enderror amount deduction"
                                                    value="0" required readonly>
                                                @error('program_advance')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ 'पेश्की भुक्तानी लगेको कट्टी रकम अनिवार्य छ' }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('जम्मा कट्टी रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                                                </div>
                                                <input type="text" id="total_katti_amount" name="total_katti_amount"
                                                    class="form-control @error('total_katti_amount') is-invalid @enderror amount"
                                                    value="0" required readonly>
                                                @error('total_katti_amount')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ 'जम्मा कट्टी रकम  अनिवार्य छ' }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('भुक्तानी दिनु पर्ने खुद रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                                                </div>
                                                <input type="text" id="net_total_amount" name="net_total_amount"
                                                    class="form-control @error('net_total_amount') is-invalid @enderror amount"
                                                    value="0" required readonly>
                                                @error('net_total_amount')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ 'भुक्तानी दिनु पर्ने खुद रकम अनिवार्य छ' }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <input type="checkbox" id="is_final_payment" name="is_final_payment"
                                                        checked>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control text-danger font-09"
                                                value="{{ __('अन्तिम भुक्तानी भएमा टिक लगाउनुहोस') }}" disabled
                                                style="font-size: 0.9rem">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="submit" class="btn btn-sm btn-primary"
                                id="button">{{ __('सेभ गर्नुहोस्') }}</button>
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
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        let ERRORS = @json($errors->any());
        let PLAN = +"{{ $program->id }}";
        let BHUKTANI_DINU_PARNE_RAKAM = 0;
        window.onload = function() {
            if (ERRORS) {
                $("#main_form").css("display", "");
            } else {
                $("#main_form").css("display", "none");
            }
            $('#date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
        };

        $(function() {
            $("#work_order_id").on("change", function() {
                var work_order_id = $("#work_order_id").val();
                if (work_order_id == '') {
                    alert("कार्यदेश नं अनिवार्य छ");
                    $("#main_form").css("display", "none");
                    $("#button").attr("disabled", true);
                    $("#program_runner").val('');
                } else {
                    $("#button").attr("disabled", false);
                    axios.get("{{ route('api.getProgramAntimBhuktani') }}", {
                        params: {
                            work_order_id: work_order_id,
                            program_id: PLAN
                        }
                    }).then(function(response) {
                        if (response.data.show_form) {
                            $("#main_form").css("display", "none");
                            alert("अन्तिम भुक्तानीको विवरण भरिसकेको छ");
                        } else {
                            $("#main_form").css("display", "");
                            $("#program_runner").val(response.data.work_order
                                .list_registration_attribute.name);
                            $("#work_order_budget").val(response.data.work_order_budget);
                            BHUKTANI_DINU_PARNE_RAKAM = response.data.work_order_budget;
                            $("#table_budget_row").html(response.data.html);
                            $("#program_advance").val(response.data.program_advance_amount);
                        }
                    }).catch(function(response) {
                        alert("Something went wrong...");
                    });
                }
            });

            $(".deduction").on("input", function() {
                var bill_amount = $("#bill_amount").val() || 0;
                deduction = 0
                $('.deduction').each(function() {
                    deduction += Number($(this).val()) || 0;
                });

                $("#total_katti_amount").val(deduction);
                $("#net_total_amount").val(bill_amount - deduction);
            });

            $("#bill_amount").on("input", function() {
                var bill_amount = +$("#bill_amount").val();
                var work_order_id = $("#work_order_id").val();
                var ghati_katti_rakam = BHUKTANI_DINU_PARNE_RAKAM - bill_amount;
                if (ghati_katti_rakam < 0) {
                    alert("रकम बढी भयो |");
                    $("#bill_amount").val(0);
                    $("#bhuktani_ghati_katti_rakam").val(0);
                } else {
                    $("#bhuktani_ghati_katti_rakam").val(ghati_katti_rakam);
                }
            });
        });
    </script>
@endsection