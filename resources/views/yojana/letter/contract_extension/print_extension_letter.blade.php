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
                <div class="letter_subject">विषय:- योजना संझौता कार्यादेश |</div>
                <div class="letter_body">
                    <p class="letter_greeting">श्री
                        {{ $type->typeable->name . ' ज्यु' }}
                        ,</p>
                    @if (config('TYPE.AMANAT_MARFAT') != session('type_id'))
                        <p class="letter_greeting">
                            {{ config('constant.SITE_NAME') }},{{ config('constant.SITE_DISTRICT') }}</p>
                    @else
                        <p class="letter_greeting">
                            {{ $type->typeable->address }}</p>
                    @endif
                    <p class="letter_text my-2">
                        यस कार्यालयको स्वीकृत बार्षिक कार्यक्रम अनुसार {{ config('constant.SITE_NAME') }} वडा
                        नं. {{ Nepali($plan->planWardDetails->implode('ward_no', ',')) }}मा
                        {{ $plan->name }} योजना स्वीकृत भइ मिती
                        {{ Nepali($plan->otherBibaran->agreement_date_nep) }} मा यस
                        {{ config('constant.SITE_TYPE') }} सँग
                        भएको संझौता अनुसार उक्त योजना मिति {{ Nepali($plan->otherBibaran->start_date) }} देखी
                        काम सुरु गरी मिती {{ Nepali($plan->otherBibaran->end_date) }} भित्रमा
                        काम सम्पन्न गर्ने गरी योजनाको कार्यदेश दिइएकोमा
                        {{ config('TYPE.' . session('type_id')) }}ले मिति
                        {{ Nepali($add_deadline->consumer_date_nep) }} मा यस
                        कार्यालयमा {{ Nepali($add_deadline->remark) }} कारणले तोकिएको समयमा योजना सम्पन्न गर्न
                        नसकिएको भनि म्याद थपका
                        लागी निबेदन दिएकाले यस कार्यालयको निर्णय अनुसार
                        {{ convertNumberToNepaliWord($add_deadline->period) }}पटक मिति
                        {{ Nepali($add_deadline->period_add_date_nep) }} सम्मका लागी
                        योजना संचालनको म्याद थप गरिएको जानकारी गराइन्छ ।
                    </p>
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
