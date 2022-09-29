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
                        'letter_title' => 'टिप्पणी आदेश',
                    ])

                    <div class="letter_date">
                        <span> मिति : {{ Nepali($date) }}</span>
                    </div>
                </div>
                <div class="letter_subject">विषय:- योजना संझौता गरी पेश्की उपलब्ध गराउने सम्बन्धमा ।</div>
                <div class="letter_body">
                    <p class="letter_greeting">श्रीमान,</p>
                    <p class="letter_text">
                        यस कार्यालयको स्वीकृत बार्षिक कार्यक्रम अनुसार {{ config('constant.SITE_NAME') }} वडा
                        नं. {{ Nepali($plan->planWardDetails->implode('ward_no', ',')) }} मा
                        {{ $plan->name }} स्वीकृत भइ उक्त योजनामा प्राबिधिकबाट रु
                        {{ NepaliAmount($plan->kulLagat->total_investment) }}
                        बराबरको लागत ईस्टमेट पेश भइ स्वीकृत भएकोमा
                        @if (config('TYPE.UPABHOKTA_SAMITI') == session('type_id') || config('TYPE.tole-bikas-samiti') == session('type_id'))
                            मिति
                            {{ Nepali($plan->otherBibaran->formation_start_date) }} मा
                            {{ config('TYPE.' . session('type_id')) }} ({{ $type->typeable->name }}) गठन
                            भइ
                            समितिको तर्फबाट बैठकको निर्णय प्रतिलिपी,निबेदन लगायत अन्य कागज पत्र सहित
                        @else
                            {{ config('TYPE.' . session('type_id')) }} ({{ $type->typeable->name }})द्वारा
                        @endif
                        योजना संझौताका
                        लागी माग भई आएकाले योजनाको कुल लागत रु
                        {{ NepaliAmount($plan->kulLagat->total_investment) }} मा
                        {{ config('constant.SITE_TYPE') }}बाट अनुदान रु
                        {{ NepaliAmount($plan->grant_amount) }} तथा
                        अन्य निकाय({{ $plan->kulLagat->other_office_con_name }})बाट अनुदान रु
                        {{ NepaliAmount($plan->KulLagat->other_office_con) }} र
                        {{ config('TYPE.' . session('type_id')) }}बाट नगद साझेदारी रु
                        {{ NepaliAmount($plan->kulLagat->customer_agreement) }} तथा अन्य साझेदारी
                        ({{ $plan->kulLagat->other_contingency_con_name }}) रु
                        {{ NepaliAmount($plan->kulLagat->other_office_agreement) }}
                        र
                        {{ config('TYPE.' . session('type_id')) }}बाट जनश्रमदान रु
                        {{ NepaliAmount($plan->kulLagat->consumer_budget) }} भएकोमा मिति
                        {{ Nepali($advance->advance_paid_date_nep) }} देखी काम
                        सुरु गरी मिति {{ Nepali($plan->otherBibaran->start_date) }}
                        भित्रमा योजनाको काम सम्पन्न गर्नेगरी यस कार्यालयको निर्णय अनुसार मिति
                        {{ Nepali($plan->otherBibaran->end_date) }} भित्रमा
                        पेश्की फर्छयौट गर्ने गरी उक्त योजना संचालनका लागी माथी उल्लेखित {{ config('TYPE.' . session('type_id')) }}सँग
                        सम्झौता गरी रु {{ NepaliAmount($advance->peski_amount) }} पेश्की उपलब्ध गराइ योजनाको
                        कार्यदेश दिनका लागी श्रीमान समक्ष यो
                        टिप्पणी पेश गरको छु । श्रीमानको जो आदेश ।
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
