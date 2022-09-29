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
                     <div class="letter_subject">विषय:-  सिफारिस सम्बन्धमा  ।</div>

                </div>
                <!--<div class="letter_subject"></div>-->
 <div class="letter_body">
                                
                                <p class="letter_greeting">श्री,{{config('constant.SITE_NAME') }}</p>
                                 <span id="bank_address">
                                  {{config('constant.SITE_DISTRICT')}}, {{config('constant.FULL_ADDRESS')}}
                                </span> <br> <br>
                                <p class="letter_text">
                                           उपरोक्त बिषयमा श्री  {{$type->typeable->name}}ले यस वडा  कार्यालयमा  {{$plan->name}} योजना काम भइरहेको हुँदा मुल्यांकनको आधारमा भुक्तानीको लागि सिफारिस पाऊ भनि दिएको निबेदन अनुसार यस वडा कार्यालयबाट ऊक्त योजनाको स्थल गत निरीक्षण गर्दा योजनाको काम भइरहेको हुँदा नियम  अनुसार मुल्यांकनको आधारमा भुक्तानी दिनुहुन अनुरोध छ ।
                                </p>
                                <p style="text-align:center !important;">तपशिल</p>
                                <table class="letter_table table table-bordered half_left">
                                    <tr>
                                        <td>योजनाको नाम :</td>
                                        <td>{{ $plan->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>ठेगाना :</td>
                                        <td>{{ config('constant.SITE_NAME') . Nepali($plan->ward_no ? '-' . $plan->ward_no : '') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>योजनाको बिषयगत क्षेत्रको नाम :</td>
                                        <td>{{ getSettingValueById($plan->topic_id)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>योजनाको उपक्षेत्र नाम :</td>
                                        <td>{{ getSettingValueById($plan->topic_area_type_id)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('TYPE.' . session('type_id')) }}को नाम :</td>
                                        <td>{{ $type->typeable->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>ठेगाना :</td>
                                        <td>
                                            @if (session('type_id') == config('TYPE.TOLE_BIKAS_SAMITI'))
                                                {{ config('constant.SITE_NAME') . '-' . Nepali($type->typeable->former_ward_no) }}
                                            @elseif(session('type_id') == config('TYPE.upabhokta-samiti') || session('type_id') == config('TYPE.sanstha-samiti'))
                                                {{ config('constant.SITE_NAME') . '-' . Nepali($type->typeable->ward_no) }}
                                            @else
                                                {{ $type->typeable->address . Nepali($type->typeable->ward_no) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>विनियोजन किसिम :</td>
                                        <td>{{ getSettingValueById($plan->type_of_allocation_id)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('constant.SITE_TYPE') }}बाट अनुदान रकम :</td>
                                        <td>{{ NepaliAmount($plan->grant_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td>अन्य निकायबाट प्राप्त अनुदान रकम :</td>
                                        <td>{{ NepaliAmount($plan->kulLagat->other_office_con) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('TYPE.' . session('type_id')) }}बाट नगद साझेदारी रकम :</td>
                                        <td>{{ NepaliAmount($plan->kulLagat->customer_agreement) }}</td>
                                    </tr>
                                    <tr>
                                        <td>अन्य साझेदारी रकम :</td>
                                        <td>{{ NepaliAmount($plan->kulLagat->other_office_agreement) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{config('TYPE.'.session('type_id'))}}बाट लागत सहभागिता रकम :
                                            ({{ NepaliAmount(round(($plan->kulLagat->consumer_budget / $plan->kulLagat->total_investment) * 100, 2)) . '%' }})
                                        </td>
                                        <td>{{ NepaliAmount($plan->kulLagat->consumer_budget) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कुल लागत अनुमान जम्मा रकम :</td>
                                        <td>{{ NepaliAmount($plan->kulLagat->total_investment) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यदेश रकम :</td>
                                        <td>{{ NepaliAmount($plan->kulLagat->total_investment - $plan->kulLagat->consumer_budget) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>योजना शुरु हुने मिति :</td>
                                        <td>{{ Nepali($plan->otherBibaran->start_date) }}</td>
                                    </tr>
                                    <tr>
                                        <td>योजना सम्पन्न हुने मिति :</td>
                                        <td>{{ Nepali($plan->otherBibaran->end_date) }}</td>
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
