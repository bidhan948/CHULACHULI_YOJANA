@section('title', $plan->name . ' मुल्यांकन को आधारमा भुक्तानी')
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
                        <h3 class="card-title">{{ __('मुल्यांकन को आधारमा भुक्तानी दिनु पर्ने भएमा') }}</h3>
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
                        <p class="mb-3 bg-primary text-center">{{ __('योजना दर्ता नं : ') }} {{ Nepali($reg_no) }}</p>

                        {{-- running bill accordion --}}
                        @foreach ($running_bill_payments as $key => $running_bill_payment)
                            <div class="accordion" id="running_bill_payment{{ $running_bill_payment->id }}">
                                <div class="card">
                                    <div class="card-header bg-primary p-0" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-center text-white" type="button"
                                                data-toggle="collapse"
                                                data-target="#running_bill_payment{{ $running_bill_payment->id }}_bibaran"
                                                aria-expanded="true"
                                                aria-controls="running_bill_payment{{ $running_bill_payment->id }}_bibaran">
                                                {{ convertNumberToNepaliWord($running_bill_payment->period) }}
                                                भुक्तानी हेर्नुहोस्
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="running_bill_payment{{ $running_bill_payment->id }}_bibaran" class="collapse "
                                        aria-labelledby="headingOne"
                                        data-parent="#running_bill_payment{{ $running_bill_payment->id }}">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row mx-2">
                                                    <div class="col-12">
                                                        <table class="table table-bordered mt-3">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        {{ __('योजनाको मुल्यांकन मिती :') }}</th>
                                                                    <td>{{ Nepali($running_bill_payment->bill_date_nep) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        {{ __('योजनाको हाल मुल्यांकन रकम :') }}</th>
                                                                    <td>{{ NepaliAmount($running_bill_payment->plan_evaluation_amount) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        {{ __('योजनाको खुद मुल्यांकन रकम :') }}</th>
                                                                    <td>{{ NepaliAmount($running_bill_payment->plan_own_evaluation_amount) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        {{ __('भुक्तानी दिनु पर्ने कुल रकम :') }}</th>
                                                                    <td>{{ NepaliAmount($running_bill_payment->payable_amount) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        {{ __('पेश्की भुक्तानी लगेको कट्टी रकम :') }}</th>
                                                                    <td>{{ NepaliAmount($advance == null ? 0 : $advance->peski_amount) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        {{ __('कन्टेन्जेन्सी कट्टी रकम :') }}</th>
                                                                    <td>{{ NepaliAmount($running_bill_payment->contingency_amount) }}
                                                                    </td>
                                                                </tr>
                                                                @foreach ($running_bill_payment->runningBillPaymentDetails as $detail)
                                                                    <tr>
                                                                        <th class="text-center">
                                                                            {{ $detail->Deduction->name ." :"}}</th>
                                                                        <td>{{ NepaliAmount($detail->deduction_amount) . '(' . Nepali($detail->deduction_percent) . ' %)' }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                <tr>
                                                                    <th class="text-center">
                                                                        {{ __('जम्मा कट्टी रकम :') }}</th>
                                                                    <td>{{ NepaliAmount($running_bill_payment->total_katti_amount) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        {{ __('हाल भुक्तानी दिनु पर्ने खुद रकम :') }}</th>
                                                                    <td>{{ NepaliAmount($running_bill_payment->total_paid_amount) }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        {{ __('मुल्यांकनको आधारमा भुक्तानी भएको मिति :') }}</th>
                                                                    <td>{{ Nepali($running_bill_payment->bill_payable_date) }}
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
                        @if ($is_form)
                            <p class="my-2 p-1 bg-primary text-center">
                                {{ $running_bill_payments->count() == 0 ? 'पहिलो' : convertNumberToNepaliWord($running_bill_payments->last()->period + 1) }}
                                भुक्तानी भर्नुहोस्</p>
                            <form method="POST" action="{{ route('plan.running_bill_payment.store') }}">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                    <div class="col-12 mt-2">
                                        <div class="form-group mt-2">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('Auto Calculation :') }}
                                                    </span>
                                                </div>
                                                <select id="a_calculation" class="form-control" name="is_auto_calculate"
                                                    required>
                                                    <option value="0" selected>{{ __('NO') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <table id="table1" width="100%" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td class="text-center">{{ __('योजनाको मुल्यांकन किसिम :') }}</td>
                                                    <td class="text-center">
                                                        <select name="period" id="period"
                                                            class="form-control form-control-sm" disabled>
                                                            <option>
                                                                {{ $running_bill_payments->count() == 0 ? 'पहिलो' : convertNumberToNepaliWord($running_bill_payments->last()->period + 1) }}
                                                            </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">{{ __('योजनाको मुल्यांकन मिती :') }}</td>
                                                    <td class="text-center">
                                                        <input type="text" name="bill_date_nep"
                                                            class="nepali-date form-control form-control-sm @error('bill_date_nep') is-invalid @enderror"
                                                            required readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">{{ __('इष्टिमेट भएको रकम :') }}</td>
                                                    <td class="text-center">
                                                        <input type="text" name="est_amount"
                                                            class="form-control amount form-control-sm @error('est_amount') is-invalid @enderror"
                                                            value="{{ $contract_kabol->total_amount }}" required
                                                            readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">{{ __('योजनाको हाल मुल्यांकन रकम :') }}</td>
                                                    <td class="text-center">
                                                        <input type="text" name="plan_evaluation_amount"
                                                            id="plan_evaluation_amount"
                                                            class="form-control amount form-control-sm @error('plan_evaluation_amount') is-invalid @enderror"
                                                            value="{{ old('plan_evaluation_amount') }}" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">{{ __('योजनाको खुद मुल्यांकन रकम :') }}</td>
                                                    <td class="text-center">
                                                        <input type="text" name="plan_own_evaluation_amount"
                                                            id="plan_own_evaluation_amount"
                                                            class="form-control amount form-control-sm @error('plan_own_evaluation_amount') is-invalid @enderror"
                                                            value="{{ old('plan_own_evaluation_amount') }}" required
                                                            readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">{{ __('भुक्तानी दिनु पर्ने कुल रकम :') }}</td>
                                                    <td class="text-center">
                                                        <input type="text" name="payable_amount"
                                                            class="form-control auto_calculate amount form-control-sm @error('payable_amount') is-invalid @enderror"
                                                            id="payable_amount" value="" required>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <table id="table1" width="100%" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">{{ __('पेश्की भुक्तानी लगेको कट्टी रकम') }}
                                                    </th>
                                                    <th class="text-center">{{ __('कन्टेन्जेन्सी कट्टी रकम') }}</th>
                                                    @foreach ($deductions as $deduction)
                                                        <th class="text-center">{{ $deduction->name }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center"><input type="text"
                                                            id="{{ $running_bill_payments->count() ? '' : 'peski_amount' }}"
                                                            class="form-control amount {{ $running_bill_payments->count() ? '' : 'sum_calc deduction_a' }}  form-control-sm @error('peski_amount') is-invalid @enderror"
                                                            name="peski_amount"
                                                            value="{{ $advance == null ? 0 : $advance->peski_amount }}"
                                                            readonly>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" id="contingency_percent"
                                                            class="form-control form-control-sm "
                                                            value="{{ $contingency == null ? 0 . '%' : $contingency->percent . '%' }}"
                                                            disabled required>
                                                        <input type="text" id="contingency_amount"
                                                            class="form-control amount my-1 sum_calc deduction_a auto_calculate form-control-sm @error('contingency_amount') is-invalid @enderror"
                                                            name="contingency_amount" value="0" readonly required>
                                                    </td>
                                                    @foreach ($deductions as $key => $deduction)
                                                        <td class="text-center">
                                                            <input type="text"
                                                                class="form-control amount deduction form-control-sm"
                                                                id="deduction_percent_{{ $key }}"
                                                                name="deduction_percent[{{ $deduction->id }}]"
                                                                value="{{ $deduction->percent }}"
                                                                oninput="caculateRunningBillPercent({{ $key }})">
                                                            <input type="text"
                                                                class="form-control amount sum_calc auto_calculate deduction_a my-1 form-control-sm"
                                                                id="deduction_amount_{{ $key }}"
                                                                name="deduction[{{ $deduction->id }}]" value=""
                                                                readonly>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table id="table1" width="100%" class="table my-2 table-bordered">
                                            <thead>
                                                <tr>
                                                    <td class="text-center">{{ __('जम्मा कट्टी रकम :') }}</td>
                                                    <td class="text-center">
                                                        <input type="text" id="total_katti_amount"
                                                            class="form-control form-control-sm  @error('total_katti_amount') is-invalid @enderror"
                                                            name="total_katti_amount" required readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">{{ __('हाल भुक्तानी दिनु पर्ने खुद रकम :') }}
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" id="total_paid_amount"
                                                            class="form-control form-control-sm @error('total_paid_amount') is-invalid @enderror"
                                                            name="total_paid_amount" required readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        {{ __('मुल्यांकनको आधारमा भुक्तानी भएको मिति :') }}</td>
                                                    <td class="text-center">
                                                        <input type="text" name="bill_payable_date"
                                                            class="nepali-date form-control form-control-sm @error('bill_payable_date') is-invalid @enderror"
                                                            required readonly>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary"
                                    onclick="submitForm()">{{ __('सेभ गर्नुहोस्') }}</button>
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
        $(function(){
            $("#plan_evaluation_amount").on("input", function() {
                var plan_evaluation_amount = +$("#plan_evaluation_amount").val() || 0;
                var plan_id = {{ $plan->id }};
                var auto_calculation = $('#a_calculation').val();
                axios.get("{{ route('plan.api.getPlanOwnEvaluationAmount') }}", {
                    params: {
                        plan_id: plan_id,
                        plan_evaluation_amount: plan_evaluation_amount
                    }
                }).then(function(response) {
                    console.log(response);
                    $("#plan_own_evaluation_amount").val(response.data.amount);
                }).catch(function(error) {
                    console.log(error);
                });
            });
        });
        function submitForm() {
            if (confirm('के तपाई निश्चित हुनुहुन्छ ?')) {
                var plan_own_evaluation_amount = +$("#plan_own_evaluation_amount").val();
                var check = plan_own_evaluation_amount;
                if (check >= karydesh_amount) {
                    alert(
                        "हाल भुक्तानी दिने खुद रकम कार्यदेश रकम भन्दा बढी भयो | कृपया भुक्तानी दिनु पर्ने भए अन्तिम भुक्तानीमा जानुहोस"
                    );
                    event.preventDefault();
                } else {
                    return true;
                }
            } else {
                event.preventDefault();
            }
        }
    </script>
@endsection
