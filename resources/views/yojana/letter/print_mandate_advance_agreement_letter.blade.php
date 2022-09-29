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
                <div class="letter_subject">विषय:- पेश्की संझौता कार्यादेश |</div>
                <div class="letter_body">
                    <p class="letter_greeting">श्री
                        {{ config('TYPE.AMANAT_MARFAT') != session('type_id') ? 'अध्यक्ष ज्यु' : $type->typeable->name . ' ज्यु' }}
                        ,</p>
                    @if (config('TYPE.AMANAT_MARFAT') != session('type_id'))
                        <p class="letter_greeting">
                            {{ $type->typeable->name . ',' }}</p>
                        <p class="letter_greeting">
                            {{ config('constant.SITE_NAME') }},{{ config('constant.SITE_DISTRICT') }}</p>
                    @else
                        <p class="letter_greeting">
                            {{ $type->typeable->address }}</p>
                    @endif
                    <p class="letter_text my-2">
                        यस कार्यालयको स्वीकृत वार्षिक कार्यक्रम अनुसार तपशिलको विवरणमा उल्लेख बमोजिमको योजना
                        संचालन गर्न मिति {{ Nepali($plan->otherBibaran->agreement_date_nep) }} यस
                        {{ config('constant.SITE_TYPE') }}सँग
                        भएको संझौता अनुसार योजनाको काम शुरु गर्न
                        यस कार्यालयको निर्णय अनुसार मिति {{ Nepali($advance->advance_paid_date_nep) }}
                        भित्रमा
                        पेश्की फर्छयौट गर्ने गरी उक्त योजना
                        संचालनका लागी रु {{ NepaliAmount($advance->peski_amount) }} पेश्की उपलब्ध गराइको छ ।
                        @php
                        /*
                        तोकिएको समयमा काम सम्पन्न गरी योजनाको
                        प्राबिधिक मुल्यांकन गराइ उक्त योजनामा भएको यथार्थ खर्चको विवरण
                        @if (config('TYPE.AMANAT_MARFAT') != session('type_id'))
                            {{ config('TYPE.' . session('type_id')) }} तथा अनुगमन
                            समितिको बैठकबाट
                        @endif
                        अनुमोदन गराइ खर्चको बिल भरपाईतथा योजनाको फोटो सहित यस गाउँपालिकामा पेश
                        गरी भुक्तानी लिनहुन जानकारी गराइन्छ ।
                        */
                        @endphp
                    </p>

                    <p class="text-center font-weight-bold my-3" style="text-align: center;">
                        {{ __('तपशिल') }}</p>
                    <table class="letter_table table table-bordered">
                        <tr>
                            <td class="text-center">{{ __('बिनियोजन श्रोत र व्याख्या:') }}</th>
                            <td class="text-center" style="font-weight: lighter">
                                {{ $plan->detail }}</th>
                        </tr>
                        <tr>
                            <td class="text-center">{{ __('योजनाको नाम :') }}</th>
                            <td class="text-center" style="font-weight: lighter">
                                {{ $plan->name }}</th>
                        </tr>
                        <tr>
                            <td class="text-center">{{ __('ठेगाना :') }}</th>
                            <td class="text-center" style="font-weight: lighter">
                                {{ config('constant.SITE_NAME') . Nepali($plan->ward_no ? '-' . $plan->ward_no : '') }}
                                </th>
                        </tr>
                        <tr>
                            <td class="text-center">योजनाको बिषयगत क्षेत्रको नाम :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ getSettingValueById($plan->topic_id)->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">योजनाको उपक्षेत्र नाम :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ getSettingValueById($plan->topic_area_type_id)->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">योजनाको बजेट शिर्षक :</td>
                            <td class="text-center" style="font-weight: lighter">
                                @foreach ($plan->budgetSourcePlanDetails as $comma => $budgetSource)
                                    {{ $budgetSource->budgetSources->name . ($comma + 1 == $plan->budgetSourcePlanDetails->count() ? ' ' : ' ,') }}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">विनियोजन किसिम :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ getSettingValueById($plan->type_of_allocation_id)->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">{{ config('constant.SITE_TYPE') }}बाट अनुदान :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ NepaliAmount($plan->grant_amount) }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">अन्य निकायबाट प्राप्त अनुदान रकम :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ NepaliAmount($plan->kulLagat->other_office_con) }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">{{ config('TYPE.' . session('type_id')) }}बाट नगद
                                साझेदारी
                                रकम :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ NepaliAmount($plan->kulLagat->customer_agreement) }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">अन्य साझेदारी रकम : </td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ NepaliAmount($plan->kulLagat->other_office_agreement) }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">{{ config('TYPE.' . session('type_id')) }}बाट जनश्रमदान
                                रकम :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ NepaliAmount($plan->kulLagat->consumer_budget) }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">कुल लागत अनुमान जम्मा रकम :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ NepaliAmount($plan->kulLagat->total_investment) }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">योजना शुरु हुने मिति :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ Nepali($plan->otherBibaran->start_date) }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">योजना सम्पन्न हुने मिति :</td>
                            <td class="text-center" style="font-weight: lighter">
                                {{ Nepali($plan->otherBibaran->end_date) }}</td>
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
