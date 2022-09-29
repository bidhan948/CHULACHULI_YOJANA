@include('layout.print_header')
<title>{{ $program->name . ' प्रिन्ट पेज' }}</title>
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
            <input name="program_id" value="{{ $program->id }}" type="hidden">
            <div class="letter_inner">
                <div class="letter_header">
                    <img src="{{ asset('emblem_nepal.png') }}" alt="" class="letter_logo" />
                    <div class="letter_number_detail">
                        <div>पत्र संख्या : {{ Nepali(getCurrentFiscalYear()) }}</div>
                        <div>कार्यक्रम दर्ता नं : {{ Nepali($reg_no) }}</div>
                        <div>चलानी नं . :</div>
                    </div>

                    @include('yojana.letter.include.letter_title', [
                        'letter_title' => '',
                    ])

                    <div class="letter_date">
                        <span> मिति : {{ Nepali($date) }}</span>
                    </div>
                </div>
               <div class="letter_subject">विषय:- रकम भुक्तानी सम्बन्धमा ।</div>
                <div class="letter_body">
                    <p class="letter_greeting">श्री आर्थिक प्रशासन शाखा,
                    </p>
                    <p class="letter_text my-2">
                                    यस कार्यालयको स्वीकृत बार्षिक कार्यक्रम अनुसार देहायको कार्यक्रम 
                                    संचालन गर्न श्री {{$work_order->listRegistrationAttribute->name}}लाई मिति {{Nepali($work_order->decision_date_nep)}} मा कार्यदेश
                                    दिईएकोमा तोकिएको समय भित्रै काम सम्पन गरि भुक्तानी माग भएकोले
                                    तपशिल बमोजिम भुक्तानी दिन हुन अनुरोध छ ।
                                </p>
                                <p class="text-center font-weight-bold">{{ __('तपशिल') }}</p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <td>आर्थिक बर्ष :</td>
                                        <td style="font-weight: lighter;">{{ Nepali(getCurrentFiscalYear()) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यादेश नं :</td>
                                        <td style="font-weight: lighter;">{{ Nepali($work_order->work_order_no) }}</td>
                                    </tr>
                                    <tr>
                                        <td>बिनियोजन श्रोत र व्याख्या :</td>
                                        <td style="font-weight: lighter;">{{ $program->detail }}</td>
                                    </tr>
                                   
                                    <tr>
                                        <td>कार्यक्रमको नाम :</td>
                                        <td style="font-weight: lighter;">
                                        	{{$program->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>भुक्तानी पाउनेको नाम:</td>
                                        <td style="font-weight: lighter;">
                                        	{{$work_order->listRegistrationAttribute->name}}
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>कार्यादेश दिईएको रकम:</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($work_order->work_order_budget)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('constant.SITE_TYPE') }}बाट अनुदान:</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($work_order->municipality_amount)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>लागत सहभागिता :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($work_order->cost_participation)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>पेश्की भुक्तानी लगेको कट्टी रकम:</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->program_advance)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>मुल्यांकन / बिल रकम :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->bill_amount)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>मु.अ कर :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->mu_tax)}}
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>बहाल कर :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->b_tax)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>जम्मा कट्टी रकम :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->total_katti_amount)}}	
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>भुक्तानी दिनु पर्ने खुद रकम :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->net_total_amount)}}
                                        </td>
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
                            <div class="sign_title">स्वीकृत गर्ने </div>
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
