@include('layout.print_header')
<title>{{ $tole_bikas_samiti->name . ' प्रिन्ट पेज' }}</title>
<style>
  @font-face {
    font-family: kokila;
    src: url('{{asset("Nepali-font/kokila.ttf")}}');
}
</style>
<link rel="stylesheet" href="{{asset('css/final-print.css')}}">
</head>

<body onload="window.print()">
    <div class="container-fluid letter">
        <div class="letter_header">
            <div class="letter_header_left">
                <img src="{{ asset('emblem_nepal.png') }}" alt="" class="logo">
                <div> आ.ब : {{ Nepali(getCurrentFiscalYear()) }}</div>
                <div> सुची दर्ता नं : {{ Nepali($tole_bikas_samiti->reg_no) }}</div>
            </div>
            <div class="letter_header_title">
                <span> अनुसूची - २ ख</span>
                <span> नियम १८ को उपनियम (२) संग सम्बन्धित</span>
                <h1> {{ config('constant.SITE_NAME') }}</h1>
                <h2>{{ config('constant.SITE_SUB_TYPE') }}</h2>
                <span>{{ config('constant.FULL_ADDRESS') }}</span>
            </div>
            <div class="letter_header_right">
                <span> मिति : {{ Nepali($tole_bikas_samiti->date_nep) }}</span>
            </div>
        </div>
        <div class="letter_body">
            <div class="letter_title"> विषय:- सुचिकृत गरिएको बारे । </div>

            <div class="letter_body_content">
                <span>श्री {{ $tole_bikas_samiti->name }}</span> <br>
                <span> {{ config('constant.SITE_NAME') }} वडा नं : {{ Nepali($tole_bikas_samiti->ward_no) }}
                </span><br>
                <p>
                    उपरोक्त बिषयमा तपाईले टोल बिकास समिती संचालनको निम्ती यस कार्यालयमा टोल बिकास समितिको लागि आ. व.
                    {{ Nepali(getCurrentFiscalYear()) }} मा सुचिकृत हुन पाऊ भनि दिएको निबेदन अनुसार यस कार्यालयको
                    मौजुदा सुचीमा दर्ता गरी यो निस्सा
                    / प्रमाणपत्र उपलब्ध गराइएको छ |
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
</body>

</html>
