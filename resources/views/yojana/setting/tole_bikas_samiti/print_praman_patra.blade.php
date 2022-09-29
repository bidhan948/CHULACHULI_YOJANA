@include('layout.print_header')
<title>{{ $tole_bikas_samiti->name . ' प्रमाण पत्र' }}</title>
<style>
    @font-face {
        font-family: kokila;
        src: url('{{ asset('Nepali-font/kokila.ttf') }}');
    }

    .letter {
        border: 5px solid #777;
        padding: 10px;
        /* width: 100%; */
        height: 100%;
    }

    .letter_header {
        width: 100%;
    }

    .letter_header .letter_header_left {
        position: absolute;
        left: 0;
        font-size: 1.5rem;
        padding: 15px;
    }

    .letter_header .letter_header_left img.logo {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }

    .letter_header .letter_header_title {
        text-align: center;
    }

    .letter_header .letter_header_title span {
        display: block;
        font-size: 1.5rem;
        font-weight: 500;
    }

    .letter_header .letter_header_title h1 {
        display: block;
        font-size: 1.9rem;
        font-weight: 700;
        margin-bottom: -5px;
        margin-top: 0px;
        color: red;

    }

    .letter_header .letter_header_title h2 {
        display: block;
        font-size: 2rem;
        font-weight: 700;
        margin: 0px;
        color: red;
    }

    .letter_header .letter_header_title .address {
        color: red;
    }

    .letter_header .letter_header_title h3.letter_title {
        /* color: red; */
        font-size: 2rem;
    }

    .letter_header .letter_header_right {
        position: absolute;
        right: 5px;
        top: 10px;
        font-size: 1.5rem;
        height: 200px;
        width: 200px;
        text-align: right;
        padding: 15px;
    }

    .letter_header .letter_header_right img.logo {
        width: 100px;
        height: 100px;
        object-fit: contain
    }

    .letter_header .letter_header_right span {
        display: block;
        position: absolute;
        bottom: 50px;
        right: 10px;
    }

    .letter_body {
        width: 100%;
        margin-top: 70px;
        line-height: 22px;
        font-family: kokila;
        font-size: 1.5rem;
    }

    .letter_body .letter_title {
        text-align: center;
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .letter_body .letter_body_content p {
        padding-left: 10px;
    }

    .letter_footer {
        width: 100%;
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
        padding: 15px;
    }

    .letter_footer .sing {
        display: inline-block;
    }

    body {
        font-family: kokila !important;
    }

</style>
</head>

<body onload="window.print()">
    <div class="container-fluid letter">
        <div class="letter_header">
            <div class="letter_header_left">
                <img src="{{ asset('emblem_nepal.png') }}" alt="" class="logo">

            </div>
            <div class="letter_header_title">
                <span> अनुसूची - २ ख</span>
                <span> नियम १८ को उपनियम (२) संग सम्बन्धित</span>
                <h1> {{ config('constant.SITE_NAME') }}</h1>
                <h2>{{ config('constant.SITE_SUB_TYPE') }}</h2>
                <span class="address">{{ config('constant.FULL_ADDRESS') }}</span>

                <h3 class="letter_title"> टोल विकास संस्थादर्ताको प्रमाण–पत्र । </h3>

            </div>
            <div class="letter_header_right">
                <img src="{{ asset('emblem_nepal.png') }}" alt="" class="logo">
                <span> मिति : {{ Nepali($tole_bikas_samiti->date_nep) }}</span>
            </div>
        </div>
        <div class="letter_body">


            <div class="letter_body_content">
                <span>कार्यपालिकाको कार्यालय दर्ता नं.:– {{ Nepali($tole_bikas_samiti->reg_no) }}</span> <br>
                <span> वडा नं. २ को कार्यालय दर्ता नं.:–
                </span><br>
                <p>
                    याङवरक गाउँपालिकाको टोल विकास संस्था गठन तथा परिचालन सम्बन्धी ऐन, २०७८ को दफा ४ बमोजिम
                    {{ config('constant.SITE_NAME') }}को वडा नं. {{ Nepali($tole_bikas_samiti->ward_no) }} (साविक
                    गा.वि.स. {{ $tole_bikas_samiti->former_address }}को वडा नं. {{$tole_bikas_samiti->ward_no}}) भरी आफ्नो कार्यक्षेत्र रहने गरी
                    देहाय बमोजिम हुने गरी संस्था दर्ता गरी यो प्रमाण–पत्र प्रदान गरिएको छ ।
                    <br>
                    (क) संस्थाको नाम :श्री {{ $tole_bikas_samiti->name }}
                    <br>
                    (ख) संस्था रहने ठेगाना : {{ config('constant.SITE_NAME') }}, वडा नं.
                    {{ Nepali($tole_bikas_samiti->ward_no) }}
                    <br>
                    <br>
                    <b> द्रष्टव्य : </b> ऐनको दफा ४ को उपदफा (२) बमोजिम प्रत्येक दुई वर्षमा वार्षिक साधारण सभा गरी
                    संस्थाको नयाँकार्यकारी समितिको गठन गरी संस्थानवीकरण गर्नु पर्नेछ ।
                </p>
            </div>

        </div>
        <div class="letter_footer">
            <div class="sing">
                @for ($i = 0; $i < 40; $i++)
                    .
                @endfor
            </div>
            <div class="sing">
                @for ($i = 0; $i < 40; $i++)
                    .
                @endfor
            </div>
        </div>
    </div>
</body>

</html>
