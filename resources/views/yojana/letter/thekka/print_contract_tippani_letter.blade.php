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
                <div class="letter_subject">विषय:- ठेक्का सम्झौता गर्ने सम्बन्धमा |</div>
                <div class="letter_body">
                    <p class="letter_greeting">श्रीमान,</p>
                    <p class="letter_text">
                        यस कार्यालयको आ.ब {{ Nepali(getCurrentFiscalYear()) }} को बार्षिक कार्यक्रम अनुसार
                        {{ $plan->name }} योजना ठेक्का मार्फत संचालन गर्ने गरी मिति
                        {{ Nepali($plan->contracts->prakashit_date) }} मा सुचना
                        प्रकाशन गरिएकोमा
                        उक्त योजना ठेक्का मार्फत संचालन गर्न तपशिल बमोजिमका फर्म/कम्पनी,निर्माण व्यवसायीले
                        ठेक्काको बोलपत्र पेश
                        भएको।
                    </p>
                    <table class="table table-responsive table-bordered mt-2" style="border-collapse: collapse; margin-top:15px;">
                        <tr>
                            <th class="text-center">सि.नं</th>
                            <th class="text-center">फर्म/कम्पनीको नाम</th>
                            <th class="text-center">ठेगाना</th>
                            <th class="text-center">कबोल रु अंकमा (भ्याट बाहेक)</th>
                            <th class="text-center">कबोल रु अंकमा (भ्याट सहित)</th>
                            <th class="text-center">कबोल रु अक्षरमा (भ्याट सहित)</th>
                            <th class="text-center">कैफियत</th>
                        </tr>
                        @foreach ($contract_kabols as $key => $contract_kabol)
                            <tr>
                                <td class="text-center">{{ Nepali($key + 1) }}</td>
                                <td class="text-center">
                                    {{ Nepali($contract_kabol->listRegistrationAttribute->name) }}</td>
                                <td class="text-center">
                                    {{ Nepali($contract_kabol->listRegistrationAttribute->address) }}</td>
                                <td class="text-center">
                                    {{ NepaliAmount($contract_kabol->has_vat == 1 ? getPreciseFloat($contract_kabol->total_kabol_amount / 1.13, 2) : $contract_kabol->total_kabol_amount) }}
                                </td>
                                <td class="text-center">
                                    {{ NepaliAmount($contract_kabol->total_amount) }}
                                </td>
                                @php
                                    $budget_aray = explode('.', $contract_kabol->total_amount);
                                @endphp
                                <td class="text-center">{{ 'रु ' . convert($budget_aray[0]) }}</td>
                                <td class="text-center">{{ $contract_kabol->remark }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <p class="mt-2" style="margin-top:15px;">
                        माथि उल्लेखित फर्म/कम्पनीहरुबाट प्राप्त बोलपत्र प्रस्ताब मध्ये सबै भन्दा घटी कबोल गर्ने
                        श्री {{ $contract_kabol_single->listRegistrationAttribute->name }} को रित पुर्बकको कबोल अंक सबै
                        भन्दा घटी रकम ( भ्याट सहित ) रु
                        {{ NepaliAmount($contract_kabol_single->total_amount) }}
                        @php
                            $budget_single = explode('.', $contract_kabol_single->total_amount);
                        @endphp
                        अक्षरुपी {{ convert($budget_single[0]) }} मात्र भएकाले सार्बजनिक खरिद ऐन २०६३ को नियम २५ बमोजिम
                        निज
                        सँग ठेक्का संझौताको लागी निर्णयार्थ यो टिप्पणी पेश गरेको छु ।
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
                    @if ($sifaris != null)
                        <div class="letter_sign">
                            {{-- @for ($i = 0; $i < 30; $i++)
                                .
                            @endfor --}}
                            <div class="sign_title">सिफारिस गर्ने </div>
                            <div class="sign_name"> {{ $sifaris->nep_name }}</div>
                            <div id="sifaris_post" class="post"> {{ $sifaris_post }}</div>
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
