@section('title', $plan->name . ' अन्तिम भुक्तानी')
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
                        <a href="{{ route('letter.dashboard', $plan->id) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="letter_wrap">
                    <form action="{{ route('plan.print.letter.payment_letter.tippani') }}" method="get" target="_blank">
                        <input name="plan_id" value="{{ $plan->id }}" type="hidden">
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
                                    'letter_title' => 'टिप्पणी आदेश',
                                ])

                                <div class="letter_date">
                                    <span> मिति </span>
                                    <input id="date" class="form-control form-control-sm" name="date_nep" required />
                                </div>
                            </div>
                            <div class="letter_subject">विषय:- अन्तिम भुक्तानी सम्बन्धमा ।</div>
                            <div class="letter_body">
                                <p class="letter_greeting">श्रीमान,</p>
                                <p class="letter_text">
                                    यस कार्यालयको स्वीकृत वार्षिक कार्यक्रम अनुसार मिति
                                    {{ Nepali($plan->otherBibaran->agreement_date_nep) }} मा यस कार्यलय र
                                    {{ $contract_kabol == null ? $type->typeable->name : $contract_kabol->listRegistrationAttribute->name }}
                                    बिच संझौता भई यस {{ config('constant.SITE_TYPE') }}को
                                    @if ($plan->ward_no)
                                        वडा
                                        नं {{ Nepali($plan->ward_no) }}को योजना
                                    @else
                                        @if ($plan->planWardDetails->count())
                                            @if ($plan->planWardDetails[0]->ward_no)
                                                वडा
                                                नं {{ Nepali($plan->planWardDetails->implode('ward_no', ' ,')) }}को
                                                {{ config('constant.SITE_TYPE') }} स्तरीय योजना
                                            @endif
                                        @endif
                                    @endif
                                    मा {{ $plan->name }} योजना संचालनको कार्यदेश
                                    दिइएकोमा मिति
                                    {{ Nepali($final_payment->plan_end_date) }}
                                    मा तोकिएको काम सम्पन्न
                                    गरी {{ config('TYPE.' . session('type_id')) }}को मिति
                                    {{ Nepali($final_payment->type_accept_date) }} मा बैठक बसी आम्दानी खर्च
                                    अनुमोदन तथा सार्बजनिक गरी
                                    सार्बजनिक परिक्षण समेत गरेको र अनुगमन समितको मिति
                                    {{ Nepali($final_payment->anugaman_accept_date) }} मा बैठक बसी योजनाको अन्तिम
                                    भुक्तानीको लागि सिफारिस गरेको र {{ config('TYPE.' . session('type_id')) }}ले योजनाको
                                    बिल
                                    भरपाई प्राबिधिक मुल्यांकन
                                    तथा योजनाको फोटोसहित यस {{ config('constant.SITE_TYPE') }}मा पेश गरी उक्त योजनाको
                                    भुक्तानीका लागि माग भई आएकाले
                                    तपशिल अनुसारको रकम भुक्तानी दिन मनासिब देखिएकाले श्रीमान् समक्ष निणयार्थ यो टिप्पणी पेश
                                    गरको छु ।
                                </p>
                                <table class="letter_table table table-bordered my-3">
                                    <table id="table1" width="100%" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td class="text-right" style="width: 55%;">बिनियोजन श्रोत र व्याख्या :
                                                </td>
                                                <td>{{ $plan->detail }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="width: 55%;">योजनाको कुल अनुदान रकम :
                                                </td>
                                                <td>{{ 'रु ' . NepaliAmount($plan->grant_amount) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">योजनाको कुल लागत अनुमान :</td>
                                                <td>{{ 'रु ' . NepaliAmount($contract_kabol == null ? $plan->kulLagat->total_investment : $contract_kabol->total_amount) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class='text-right'>बजेट शिर्षक:</td>
                                                @foreach ($plan->budgetSourcePlanDetails as $key => $value)
                                                    <td>{{ $value->budgetSources->name }}</td>
                                                @endforeach
                                            </tr>

                                            <tr>
                                                <td class='text-right'>विनियोजन किसिम</td>
                                                <td>{{ $plan->planAllocation->name }}</td>
                                            </tr>
                                            @if ($contract_kabol == null)
                                                <tr>
                                                    <td class='text-right'>कार्यदेश दिएको रकम</td>
                                                    <td>{{ NepaliAmount($plan->kulLagat->work_order_budget) }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="text-right">योजनाको काम सम्पन्न भएको मिति :</td>
                                                <td>{{ Nepali($final_payment->plan_end_date) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">भुक्तानी दिनु पर्ने कुल रकम :</td>
                                                <td>{{ NepaliAmount($final_payment->total_bhuktani_amount) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">योजनाको मुल्यांकन मिति :</td>
                                                <td>{{ Nepali($final_payment->assessment_date) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">योजनाको हाल मुल्यांकन रकम :</td>
                                                <td>{{ 'रु ' . NepaliAmount($final_payment->hal_mulyankan) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">मुल्यांकन अनुसार हाल सम्म भुक्तानी
                                                    लगेको
                                                    कुल रकम :</td>
                                                <td>{{ 'रु ' . NepaliAmount($final_payment->payment_till_now) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">पेश्की भुक्तानी लगेको कट्टी रकम :</td>
                                                <td>{{ 'रु ' . NepaliAmount($final_payment->advance_payment) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">कन्टेन्जेन्सी कट्टी रकम :</td>
                                                <td>{{ 'रु ' . NepaliAmount($final_payment->final_contingency_amount) }}
                                                </td>
                                            </tr>
                                            @foreach ($final_payment->finalPaymentDeatils as $finalPaymentDetail)
                                                <tr>
                                                    <td class="text-right">
                                                        {{ $finalPaymentDetail->Deduction->name . ' (' . Nepali($finalPaymentDetail->deduction_percent) . ' %)' }}
                                                    </td>
                                                    <td>{{ 'रु ' . NepaliAmount($finalPaymentDetail->deduction_amount) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="text-right">जम्मा कट्टी रकम :</td>
                                                <td>{{ 'रु ' . NepaliAmount($final_payment->final_total_amount_deducted) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">हाल भुक्तानी दिनु पर्ने खुद रकम :
                                                </td>
                                                <td>{{ 'रु ' . NepaliAmount($final_payment->final_total_paid_amount) }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-right">बैंकको नाम</td>
                                                <td>
                                                    <select name="bank_id">
                                                        <option value="">-- छानुहोस --</option>
                                                        @foreach ($bank as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-right">खाता नं.</td>
                                                <td>
                                                    <input style="width:100%" name='acc_no'>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-right">भुक्तानी लिनेको नाम</td>
                                                <td>
                                                    <input style="width:100%" name='bhuktani_name'>
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                </table>
                            </div>

                            <div class='row'>
                                <div class='col-md-4'>
                                </div>
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
                                    <div class="sign_title">सिफारिस गर्ने</div>
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
