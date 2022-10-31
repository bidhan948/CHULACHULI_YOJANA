@include('layout.print_header')
<title>{{ $plan->name . ' प्रिन्ट पेज' }}</title>
<link rel="stylesheet" href="{{ asset('letter_print.css') }}">
<style>
    @font-face {
        font-family: kokila;
        src: url('{{ asset('Nepali-font/kokila.ttf') }}');
    }
</style>
</head>

<body onload="window.print()">
    {{-- START LETTER --}}
    <div class="container-fluid letter my-5">
        <div class="letter_wrap" id="print_letter">
            <input name="plan_id" value="{{ $plan->id }}" type="hidden">
            <div class="letter_inner">
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
                        <span> मिति : {{ Nepali($date) }}</span>
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
                        {{ $contract_kabol == null ? $type->typeable->name : $contract_kabol->listRegistrationAttribute->name }}
                        बिच संझौता भई यस {{ config('constant.SITE_TYPE') }}को वडा
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
                            <td class="text-right">बैंकको नाम</td>
                            <td>
                                {{ $bank->name }}
                            </td>
                        </tr>

                        <tr>
                            <td class="text-right">खाता नं.</td>
                            <td>
                                {{ $acc_no }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">योजनाको कुल अनुदान रकम :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ NepaliAmount($contract_kabol == null ? $plan->kulLagat->napa_amount : $plan->grant_amount) }}
                            </td>
                        </tr>
                        @if ($contract_kabol == null)
                            <tr>
                                <td class="text-center">योजनाको कुल लागत अनुमान :</td>
                                <td class="text-center" style="font-weight: lighter">
                                    {{ NepaliAmount($plan->kulLagat->total_investment) }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="text-center">कार्यदेश दिएको रकम :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ NepaliAmount($contract_kabol == null ? $plan->kulLagat->work_order_budget : $contract_kabol->total_amount) }}
                            </td>
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
                    @if ($ready != null)
                        <div class="letter_sign">
                            {{-- @for ($i = 0; $i < 30; $i++)
                                .
                            @endfor --}}
                            <div class="sign_title">तयार गर्ने</div>
                            <div class="sign_name"> {{ $ready->nep_name }} </div>
                            <div id="ready_post" class="post"> {{ $ready_post }}</div>
                        </div>
                    @endif
                    <!-- Sign Item  -->
                    <!-- Sign Item  -->
                    @if ($present != null)
                        <div class="letter_sign">
                            {{-- @for ($i = 0; $i < 30; $i++)
                                .
                            @endfor --}}
                            <div class="sign_title">पेश गर्ने </div>
                            <div class="sign_name"> {{ $present->nep_name }}</div>
                            <div id="present_post" class="post"> {{ $present_post }}</div>
                        </div>
                    @endif
                    <!-- Sign Item  -->
                    <!-- Sign Item  -->
                    @if ($approve != null)
                        <div class="letter_sign">
                            {{-- @for ($i = 0; $i < 30; $i++)
                                .
                            @endfor --}}
                            <div class="sign_title">सदर गर्ने </div>
                            <div class="sign_name"> {{ $approve->nep_name }} </div>
                            <div id="approve_post" class="post"> {{ $approve_post }}</div>
                        </div>
                    @endif
                    <!-- Sign Item  -->
                </div>
            </div>
        </div>
        {{-- END LETTER --}}
</body>

</html>
