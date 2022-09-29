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
                        'letter_title' => 'टिप्पणी आदेश',
                    ])

                    <div class="letter_date">
                        <span> मिति : {{ Nepali($date) }}</span>
                    </div>
                </div>
                <div class="letter_subject">विषय:- पेश्की सम्बन्धमा ।</div>
                <div class="letter_body">
                    <p class="letter_greeting">श्रीमान्,
                    </p>
                    <p class="letter_text my-2">
                        यस कार्यालयको स्वीकृत बार्षिक कार्यक्रम अनुसार तपशिलको विवरणमा उल्लेख बमोजिमको कार्यक्रम
                        संचालन गर्न यस कार्यालयको मिति {{ Nepali($work_order->date_nep) }}को निर्णय अनुसार
                        श्री
                        {{ $work_order->listRegistrationAttribute->name ?? '' }} सँग
                        भएको सम्झौता अनुसार मिति
                        {{ Nepali($work_order->programAdvance->advance_paid_date_nep) }} भित्रमा
                        पेश्की फर्छयौट गर्ने गरी उक्त कार्यक्रम संचालनका लागी
                        पेश्की उपलब्ध गराउनको लागि मनासिव देखिएकोले निर्णयार्थ पेश गर्दछु 
                    </p>
                    <p style="font-weight: bold; text-align:center;">{{ __('तपशिल') }}</p>
                    <table class="letter_table table table-bordered">
                        <tr>
                            <td>आर्थिक बर्ष :</td>
                            <td style="font-weight: lighter;">{{ Nepali(getCurrentFiscalYear()) }}</td>
                        </tr>
                        <tr>
                            <td>कार्यक्रमको नाम :</td>
                            <td style="font-weight: lighter;">{{ $program->name }}</td>
                        </tr>
                        <tr>
                            <td>कार्यदेश नं :</td>
                            <td style="font-weight: lighter;">{{ Nepali($work_order->work_order_no) }}</td>
                        </tr>
                        <tr>
                            <td>कार्यदेशको नाम :</td>
                            <td style="font-weight: lighter;">{{ $work_order->name }}</td>
                        </tr>
                        <tr>
                            <td>कार्यक्रम संचालन हुने स्थान :</td>
                            <td style="font-weight: lighter;">{{ $work_order->venue }}</td>
                        </tr>
                        <tr>
                            <td>बिषयगत क्षेत्र :</td>
                            <td style="font-weight: lighter;">
                                {{ getSettingValueById($program->topic_id)->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>उपक्षेत्र :</td>
                            <td style="font-weight: lighter;">
                                {{ getSettingValueById($program->topic_area_type_id)->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>विनियोजन किसिम :</td>
                            <td style="font-weight: lighter;">
                                {{ getSettingValueById($program->type_of_allocation_id)->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>{{ config('constant.SITE_TYPE') }}बाट :</td>
                            <td style="font-weight: lighter;">
                                {{ NepaliAmount($program->grant_amount) }}</td>
                        </tr>
                        <tr>
                            <td>लागत सहभागित रकम :</td>
                            <td style="font-weight: lighter;">
                                {{ NepaliAmount($work_order->cost_participation) }}</td>
                        </tr>
                        <tr>
                            <td>नगद साझेदारी रकम :</td>
                            <td style="font-weight: lighter;">
                                {{ NepaliAmount($work_order->cost_sharing) }}</td>
                        </tr>
                        <tr>
                            <td>कार्यादेश रकम :</td>
                            <td style="font-weight: lighter;">
                                {{ NepaliAmount($work_order->work_order_budget) }}</td>
                        </tr>
                        <tr>
                            <td>कार्यक्रम शुरु हुने मिति :</td>
                            <td style="font-weight: lighter;">
                                {{ Nepali($work_order->program_start_date_nep) }}</td>
                        </tr>
                        <tr>
                            <td>कार्यक्रम सम्पन्न हुने मिति :</td>
                            <td style="font-weight: lighter;">
                                {{ Nepali($work_order->program_end_date_nep) }}</td>
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
