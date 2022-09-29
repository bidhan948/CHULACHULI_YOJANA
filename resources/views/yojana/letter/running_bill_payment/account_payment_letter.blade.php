@section('title', $plan->name)
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
    <link rel="stylesheet" href="{{ asset('letter_print.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('letter.dashboard', $plan->reg_no) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="letter_wrap">
                    <form action="{{ route('plan.letter.printAccountPaymentLetter') }}" method="get" target="_blank">
                        <input name="plan_id" value="{{ $plan->reg_no }}" type="hidden">
                        <input name="running_bill_payment_id" value="{{ $running_bill_payment->id }}" type="hidden">
                        <div class="letter_inner">
                            <button id="print_btn" type="submit">
                                <i class="fa-solid fa-print"></i> <span> प्रिन्ट </span>
                            </button>
                            <div class="letter_header">
                                <img src="{{ asset('emblem_nepal.png') }}" alt="" class="letter_logo" />
                                <div class="letter_number_detail">
                                    <div>पत्र संख्या : {{ Nepali(getCurrentFiscalYear()) }}</div>
                                    <div>योजना दर्ता नं : {{ Nepali($reg_no) }}</div>
                                    <div>चलानी नं . :</div>
                                </div>

                                @include('yojana.letter.include.letter_title', [
                                    'letter_title' => '',
                                ])

                                <div class="letter_date">
                                    <span> मिति </span>
                                    <input id="date" class=" form-control form-control-sm" name="date_nep" required />
                                </div>
                            </div>
                            <div class="letter_subject">विषय:- भुक्तानी सम्बन्धमा ।</div>
                            <div class="letter_body">
                                <p class="letter_greeting">श्री आर्थिक प्रशासन शाखा,</p>
                                <p class="letter_greeting">
                                    {{ config('constant.SITE_NAME') }},{{ config('constant.SITE_DISTRICT') }}</p>
                                <p class="letter_text my-1">
                                    यस कार्यालयको स्वीकृत वार्षिक कार्यक्रम अनुसार मिति
                                    {{ Nepali($plan->otherBibaran->agreement_date_nep) }} मा यस कार्यलय र
                                    {{ $type->typeable->name }} बिच संझौता भई यस {{ config('constant.SITE_TYPE') }}को वडा
                                    नं {{ Nepali($plan->ward_no) }} मा
                                    {{ $plan->name }} योजना संचालनको कार्यदेश दिइएकोमा मिति
                                    {{ Nepali($running_bill_payment->bill_date_nep) }} को
                                    प्राबिधिक मुल्याकन अनुसार तपशिल अनुसारको रकम भुक्तानी दिनहुन अनुरोध छ ।

                                <p style="text-align: center; font-weight: bold;">{{ __('तपशिल') }}</p>
                                </p>
                                <table class="letter_table table table-bordered my-3">
                                    <tr>
                                        <td class="text-center">{{ __('बिनियोजन श्रोत र व्याख्या:') }}</th>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ $plan->detail }}</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">योजनाको कुल अनुदान रकम :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ NepaliAmount($plan->kulLagat->napa_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">योजनाको कुल लागत अनुमान :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ NepaliAmount($plan->kulLagat->total_investment) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">कार्यदेश दिएको रकम :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ NepaliAmount($plan->kulLagat->work_order_budget) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('योजनाको मुल्यांकन किसिम :') }}</th>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ convertNumberToNepaliWord($running_bill_payment->period) }}</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('योजनाको मुल्यांकन मिति  :') }}</th>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ Nepali($running_bill_payment->bill_date_nep) }}
                                            </th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('योजनाको मुल्यांकन रकम :') }}</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ NepaliAmount($running_bill_payment->plan_evaluation_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('भुक्तानी दिनु पर्ने कुल रकम :') }}</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            रु {{ NepaliAmount($running_bill_payment->payable_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('कन्टेन्जेन्सी कट्टी रकम :') }}</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            रु {{ NepaliAmount($running_bill_payment->contingency_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('पेश्की भुक्तानी लगेको कट्टी रकम :') }}</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            रु {{ NepaliAmount($running_bill_payment->peski_amount) }}</td>
                                        </td>
                                    </tr>
                                    @foreach ($running_bill_payment->runningBillPaymentDetails as $runningBillPaymentDetail)
                                        <tr>
                                            <td class="text-center">
                                                {{ $runningBillPaymentDetail->Deduction->name . ' (' . Nepali($runningBillPaymentDetail->deduction_percent) . ' %)' }}
                                            </td>
                                            <td class="text-center" style="font-weight: lighter">
                                                रु {{ NepaliAmount($runningBillPaymentDetail->deduction_amount) }}</td>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-center">{{ __('जम्मा कट्टी रकम :') }}</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            रु {{ NepaliAmount($running_bill_payment->total_katti_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('हाल भुक्तानी दिनु पर्ने खुद रकम :') }}</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            रु {{ NepaliAmount($running_bill_payment->total_paid_amount) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="letter_footer">
                                <!-- Sign Item  -->
                                <div class="letter_sign">
                                    <div class="sign_title">तयार गर्ने</div>
                                    <select name="ready" id="ready" onchange="assignPost('ready')">
                                        <option value="">-- छानुहोस --</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->user_id }}">{{ $staff->nep_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="ready_post"> </div>
                                </div>
                                <!-- Sign Item  -->
                                <div class="letter_sign">
                                    <div class="sign_title">पेश गर्ने</div>
                                    <select name="present" id="present" onchange="assignPost('present')">
                                        <option value="">-- छानुहोस --</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->user_id }}">{{ $staff->nep_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="present_post"></div>
                                </div>
                                <!-- Sign Item  -->
                                <div class="letter_sign">
                                    <div class="sign_title">सदर गर्ने</div>
                                    <select name="approve" id="approve" onchange="assignPost('approve')">
                                        <option value="">-- छानुहोस --</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->user_id }}">{{ $staff->nep_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="approve_post"></div>
                                </div>
                            </div>
                    </form>
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
        window.onload = function() {
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

        function assignPost(id) {
            var val = $("#" + id).val();
            if (val == "") {
                $("#" + id + "_post").html("");
            } else {
                axios.get("{{ route('api.getPostByStaffId') }}", {
                        params: {
                            staff_id: val
                        }
                    })
                    .then(function(response) {
                        $("#" + id + "_post").html(response.data.post);
                    }).catch(function(error) {
                        console.log(error);
                        alert("Server Error");
                    });
            }
        }
    </script>
@endsection
