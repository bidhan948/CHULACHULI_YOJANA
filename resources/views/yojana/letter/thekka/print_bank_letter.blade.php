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
                <div class="letter_subject">विषय:- बैंक खाता संचालन सम्बन्धमा ।</div>
                <div class="letter_body">
                    <p class="letter_greeting">श्री, {{ $bank->name }}</p>
                    <span id="bank_address">{{ $bank->address }}</span> <br>

                    <p class="letter_text">
                        उपरोक्त विषयमा यस {{ config('constant.SITE_NAME') }}
                        र {{ $contract_kabol_single->listRegistrationAttribute->name . ' ' . $contract_kabol_single->listRegistrationAttribute->listRegistration->name }}
                        विच
                        मिति {{ Nepali($plan->otherBibaran->agreement_date_nep) }} मा  {{ $plan->name }}
                        योजना संचालन गर्ने
                        भनि सम्झौता भएकोमा उक्त्त योजना संचालन गर्न उपरोक्त
                        {{ $contract_kabol_single->listRegistrationAttribute->listRegistration->name }}को
                        नाममा बैंक खाता आवश्यक भएकाले
                        {{ $contract_kabol_single->listRegistrationAttribute->listRegistration->name }}को
                        दस्तखतबाट संचालन हुने गरी चल्ती खाता खोली
                        दिनहुन अनुरोध छ ।
                    </p>
                </div>
                <div class="letter_footer" style="justify-content: flex-end;">
                    @if ($approve != null)
                        <div class="letter_sign">
                            <!--<div class="sign_title">तयार गर्ने </div>-->
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
