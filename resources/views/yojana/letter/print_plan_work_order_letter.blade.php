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
                            <div class="letter_subject">विषय:-  कार्यदेश दिएको सम्बन्धमा ।</div>
                <div class="letter_body">
                    <p class="letter_greeting">श्री, {{ $type->typeable->name }}</p>
                    <span id="bank_address">
                        @if (session('type_id') == config('TYPE.TOLE_BIKAS_SAMITI'))
                            {{ config('constant.SITE_NAME') . '-' . Nepali($type->typeable->former_ward_no) }}
                        @elseif(session('type_id') == config('TYPE.upabhokta-samiti') || session('type_id') == config('TYPE.sanstha-samiti'))
                            {{ config('constant.SITE_NAME') . '-' . Nepali($type->typeable->ward_no) }}
                        @else
                            {{ $type->typeable->address . Nepali($type->typeable->ward_no) }}
                        @endif
                    </span> <br> <br>
                    <p class="letter_text">
                        यस कार्यालयको स्वीकृत वार्षिक कार्यक्रम अनुसार तपशिलको विवरणमा उल्लेख बमोजिमको योजना
                        संचालन गर्न
                        मिति {{ Nepali($plan->otherBibaran->agreement_date_nep) }} मा यस {{ config('constant.SITE_TYPE') }}सँग भएको
                        संझौता अनुसार योजनाको काम
                        शुरु गर्न यो
                        कार्यादेश दिईएको छ ।
                        @php
                        /*
                        तोकिएको समयमा काम सम्पन्न गरी योजनाको प्राबिधिक मुल्यांकन गराइ उक्त योजनामा भएको यथार्थ
                        खर्चको विवरण
                        उपभोक्ता समित तथा अनुगमन समितिको बैठकबाट अनुमोदन गराइ खर्चको बिल भरपाई तथा योजनाको फोटो
                        सहित यस
                        नगरपालिकामा पेश गरी भुक्तानी लिनुहुन जानकारी गराइन्छ । */
                        @endphp
                    </p>
                    <p class="mt-3 text-center font-weight-bold" style="text-align:center">{{ __('तपशिल') }}</p>
                    <table class="t_half letter_table table table-bordered half_left">
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
                            <td>{{ config('TYPE.' . session('type_id')) }}बाट लागत सहभागिता रकम :
                                ({{ NepaliAmount(round(($plan->kulLagat->consumer_budget / $plan->kulLagat->total_investment) * 100, 2)) . '%' }})
                            </td>
                            <td>{{ NepaliAmount($plan->kulLagat->consumer_budget) }}</td>
                        </tr>
                        <tr>
                            <td>कन्टेन्जेन्सी :</td>
                            <td>{{ NepaliAmount($contingency_sum) }}</td>
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
                    <p class="font-weight-bold mt-1">वोधार्थ</p>
                    <p>
                        १. {{ Nepali($plan->planWardDetails->implode('ward_no', ',')) }} न. वडा कार्यलय
                        निर्माण
                        कार्यको अनुगमन र सहजिकरण गरिदिनु हुन <br>
                        २. {{isset($engineer->nep_name) ? 'प्राविधिक साखा '.  $engineer->nep_name : '' }} {{config('constant.SITE_NAME')}} निर्माण कार्यमा प्राबिधिक सहयोग
                        पुर्याउन हुनको साथै
                        १५/१५ दिनमा कार्य प्रगतिको जानकारी
                        गराउनु हुन
                    </p>
                </div>
                <div class="letter_footer" style="justify-content: flex-end;">
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
