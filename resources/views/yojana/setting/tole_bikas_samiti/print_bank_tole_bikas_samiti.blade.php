@include('layout.print_header')
<title>{{ $tole_bikas_samiti->name . ' प्रिन्ट पेज' }}</title>
<style>
    @font-face {
        font-family: kokila;
        src: url('{{ asset('Nepali-font/kokila.ttf') }}');
    }
</style>
<link rel="stylesheet" href="{{asset('css/final-print.css')}}">
</head>

<body onload="window.print()">
    {{-- START LETTER --}}
    <div class="container-fluid letter my-5">
        <div class="letter_header">
            <div class="letter_header_left ml-4">
                <img src="{{ asset('emblem_nepal.png') }}" alt="" class="logo">
                <div> आ.ब : {{ Nepali(getCurrentFiscalYear()) }}</div>
                <div> सुची दर्ता नं : {{ Nepali($tole_bikas_samiti->reg_no) }}</div>
                <div> च नं :</div>
            </div>
            <div class="letter_header_title">
                <h1> {{ config('constant.SITE_NAME') }}</h1>
                <h2>{{ config('constant.SITE_SUB_TYPE') }}</h2>
                <span>{{ config('constant.FULL_ADDRESS') }}</span>
            </div>
            <div class="letter_header_right">
                <span style="display: flex;"> <span style="padding-right:10px;" class="pr-2"> मिति :
                    </span> {{ Nepali($date_nep) }}</span>
            </div>
        </div>
        <div class="letter_body">
            <div class="letter_title"> विषय:- बैंक खाता सम्बन्धमा । </div>

            <div class="letter_body_content">
                श्री <span id="bank_name"> {{ $bank->name }}</span> <br>
                <span id="bank_address">{{ $bank->address }} </span> <br>
                <p class="mt-4">
                    उपरोक्त बिषयमा यस {{ config('constant.SITE_TYPE') }} र
                    {{ $tole_bikas_samiti->name }}
                    बिच योजना संचालन गर्ने भनि संझौता
                    भएकोमा योजना संचालन गर्न टोल विकास समितिको नाममा बैंक खाता आबश्यक भएकाले टोल विकास
                    समितिका अध्यक्ष श्री
                    {{ $tole_bikas_samiti->toleBikasSamitiDetails->count()? ($tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_ADAKSHYA_ID'))->count()? $tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_ADAKSHYA_ID'))->values()[0]->name: ''): '' }},
                    सचिब श्री
                    {{ $tole_bikas_samiti->toleBikasSamitiDetails->count()? ($tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_SACHIB_ID'))->count()? $tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_SACHIB_ID'))->values()[0]->name: ''): '' }}
                    र कोषाध्यक्ष श्री
                    {{ $tole_bikas_samiti->toleBikasSamitiDetails->count()? ($tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_KOSADAKSHYA_ID'))->count()? $tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_KOSADAKSHYA_ID'))->values()[0]->name: ''): '' }}
                    को संयुक्त दस्तखतबाट संचालन हुने गरी चल्ती खाता खोली दिनहुन अनुरोध छ ।
                </p>
            </div>

        </div>
        <div class="letter_footer">
            <div class="sing">
                @for ($i = 0; $i < 40; $i++)
                    .
                @endfor
            </div>
        </div>
    </div>
    {{-- END LETTER --}}
</body>

</html>
