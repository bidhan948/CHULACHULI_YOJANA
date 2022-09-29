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
                <div class="letter_subject">विषय:- अन्तिम भुक्तानी सम्बन्धमा ।</div>
                <div class="letter_body">
                    <p class="letter_greeting">श्रीमान्,</p>
                    <p class="letter_greeting">श्री आर्थिक प्रशासन  शाखा,</p>
                    <p>{{config('constant.SITE_NAME')}}, {{config('constant.FULL_ADDRESS')}}</p>
                    <p class="letter_text">
                                    यस कार्यालयको स्वीकृत वार्षिक कार्यक्रम अनुसार मिति
                                    {{ Nepali($plan->otherBibaran->agreement_date_nep) }} मा यस कार्यलय र
                                    {{ $type->typeable->name }} बिच संझौता भई यस {{ config('constant.SITE_TYPE') }}को वडा
                                    नं {{ Nepali($plan->ward_no) }} मा {{ $plan->name }} योजना संचालनको कार्यदेश
                                    दिइएकोमा मिति
                                    {{ Nepali($final_payment->plan_end_date) }}
                                    मा तोकिएको काम सम्पन्न
                                    गरी {{ config('TYPE.' . session('type_id')) }}को मिति
                                    {{ Nepali($final_payment->type_accept_date) }} मा बैठक बसी आम्दानी खर्च
                                    अनुमोदन तथा सार्बजनिक गरी
                                    सार्बजनिक परिक्षण समेत गरेको र अनुगमन समितिको मिति
                                    {{ Nepali($final_payment->anugaman_accept_date) }} मा बैठक बसी योजनाको अन्तिम
                                    भुक्तानीको लागि सिफारिस गरेको र {{ config('TYPE.' . session('type_id')) }}ले योजनाको
                                    बिल
                                    भरपाई प्राबिधिक मुल्यांकन
                                    तथा योजनाको फोटोसहित यस {{ config('constant.SITE_TYPE') }}मा पेश गरी उक्त योजनाको
                                    भुक्तानीका लागि माग भई आएकाले
                                    तपशिल अनुसारको रकम भुक्तानी दिनहुन अनुरोध छ |

                    <p class="text-center font-weight-bold">{{ __('तपशिल') }}</p>
                    </p>
                                <table class="letter_table table table-bordered my-3">
                                    <table id="table1" width="100%" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td class="text-right" style="width: 55%;">बिनियोजन श्रोत र व्याख्या :
                                                </td>
                                                <td>{{ $plan->detail }}</td>
                                            </tr>
                                            
                                            <!--<tr>-->
                                            <!--	<td class="text-right">बैंकको नाम</td>-->
                                            <!--	<td>-->
                                            <!--        {{isset($bank->name) ? $bank->name : ''}}-->
                                            <!--	</td>-->
                                            <!--	</tr>-->
                                            	
                                            <!--    <tr>-->
                                            <!--	<td class="text-right">खाता न०</td>-->
                                            <!--	<td>-->
                                            <!--	    {{Nepali(isset($acc_no) ? $acc_no : '')}}-->
                                            <!--	</td>-->
                                            <!--</tr>-->
                                            
                                        
                                                    
                                            <tr>
                                                <td class="text-right" style="width: 55%;">योजनाको कुल अनुदान रकम :
                                                </td>
                                                <td>{{ 'रु ' . NepaliAmount($plan->grant_amount) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">योजनाको कुल लागत अनुमान :</td>
                                                <td>{{ 'रु ' . NepaliAmount($plan->kulLagat->total_investment) }}</td>
                                            </tr>
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
                                            <td class="text-right">बैंकको नाम :
                                            </td>
                                            <td>
                                                {{isset($bank->name) ? $bank->name : ''}}
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class'text-right'>
                                                खाता नं.	:
                                            </td>
                                            
                                            <td>
                                                {{$acc_no}}
                                            </td>
                                        </tr>
                                        
                                                                    <tr>
                                            <td class'text-right'>
                                                भुक्तानी लिनेको नाम:
                                            </td>
                                            
                                            <td>
                                                {{$bhuktani_name}}
                                            </td>
                                        </tr>
                                            

                                        </thead>
                                    </table>
                                </table>
                </div>
                <div class="letter_footer " style="justify-content: flex-end;">
                    <!-- Sign Item  -->
                   
                    <!-- Sign Item  -->
                    <!-- Sign Item  -->
                    @if ($approve != null)
                        <div class="letter_sign">
                            {{-- @for ($i = 0; $i < 30; $i++)
                                .
                            @endfor --}}
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
