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
                <div class="letter_subject">विषय:- कार्यदेश दिएको सम्बन्धमा ।</div>
                <div class="letter_body">
                    <p class="letter_greeting">श्री,
                        {{ $contract_kabol_single->listRegistrationAttribute->listRegistration->name }}</p>
                    <span id="bank_address">
                        {{ Nepali($contract_kabol_single->listRegistrationAttribute->address) }}
                    </span> <br> <br>
                    <p class="letter_text">
                        यस कार्यालयको स्वीकृत वार्षिक कार्यक्रम अनुसार तपशिलको विवरणमा उल्लेख बमोजिमको योजना
                        संचालन गर्न
                        मिति {{ Nepali($plan->otherBibaran->agreement_date_nep) }} मा यस
                        {{ config('constant.SITE_TYPE') }}सँग भएको
                        संझौता अनुसार योजनाको काम
                        शुरु गर्न यो
                        कार्यादेश दिईएको छ ।
                    </p>
                    <p class="mt-3 text-center font-weight-bold" style="text-align: center; !important;">
                        {{ __('तपशिल') }}</p>
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
                            <td>{{ $contract_kabol_single->listRegistrationAttribute->listRegistration->name }}को
                                नाम :</td>
                            <td>{{ $contract_kabol_single->listRegistrationAttribute->name }}</td>
                        </tr>
                        <tr>
                            <td>ठेगाना :</td>
                            <td>
                                {{ Nepali($contract_kabol_single->listRegistrationAttribute->address) }}
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
                            <td>कार्यादेश दिएको रकम रु :</td>
                            <td>{{ NepaliAmount($contract_kabol_single->total_amount) }}</td>
                        </tr>
                        <tr>
                            <td>योजना संचालन हुने स्थान :</td>
                            <td>{{ NepaliAmount($plan->otherBibaran->venue) }}</td>
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
                        २. प्राविधिक साखा {{$engineer->nep_name." "}}{{ config('constant.SITE_NAME') }} :- निर्माण कार्यमा प्राबिधिक सहयोग पुर्याउन
                        हुनको साथै
                        १५/१५ दिनमा कार्य प्रगतिको जानकारी
                        गराउनु हुन
                    </p>
                </div>
                <div class="letter_footer">
                    <!-- Sign Item  -->
                    @if ($ready != null)
                        <div class="letter_sign">
                            {{-- @for ($i = 0; $i < 30; $i++)
                                .
                            @endfor --}}
                            <div class="sign_name"> {{ $ready->nep_name }} </div>
                            <div id="ready_post" class="post"> {{ $ready_post }}</div>
                        </div>
                    @endif
                    <!-- Sign Item  -->
                </div>
            </div>
        </div>
        {{-- END LETTER --}}
</body>

</html>
