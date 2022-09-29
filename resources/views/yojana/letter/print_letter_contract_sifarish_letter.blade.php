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
                     <div class="letter_subject">विषय:-  सम्झौता गरिदिने बारे ।</div>

                </div>
                <!--<div class="letter_subject"></div>-->
 <div class="letter_body">
                                
                                <p class="letter_greeting">श्री,{{config('constant.SITE_NAME') }}</p>
                                <span id="bank_address">
                                  {{config('constant.SITE_DISTRICT')}}, {{config('constant.FULL_ADDRESS')}}
                                </span> <br>
                                <p class="letter_text">
                                           उपरोक्त बिषयमा {{$type->typeable->name}}ले यस कार्यालयमा दिएको निबेदन अनुसार {{$plan->name}} योजना संचालनका लागि मिति {{Nepali($plan->otherBibaran->formation_start_date)}} मा {{ config('TYPE.' . session('type_id')) }}को भेलाबाट देहाय बमोजिमको  {{ config('TYPE.' . session('type_id')) }} र अनुगमन समिति गठन भएकाले नियम अनुसार योजना संझौता गरिदिनहुन अनुरोध छ ।
                                </p>

                                {{-- type table --}}
                                <h4 class="text-center my-3 font-weight-bold" style="text-align:center">
                                    {{ config('TYPE.' . session('type_id')) . __(' सम्बन्धी विवरण') }}</h4>
                                    
                                    <div class="text-center"  style="text-align:center">
                                        <p>
                                            योजनाको संचालन गर्ने {{ config('TYPE.' . session('type_id')) }}को नाम:
                                            {{ $type->typeable->name }}
                                        </p>
                                        <p>
                                           योजनाको संचालन गर्ने {{ config('TYPE.' . session('type_id')) }}को ठेगाना:
                                            @if (session('type_id') == config('TYPE.TOLE_BIKAS_SAMITI'))
                                                {{ config('constant.SITE_NAME') . '-' . Nepali($type->typeable->former_ward_no) }}
                                            @elseif(session('type_id') == config('TYPE.upabhokta-samiti') || session('type_id') == config('TYPE.sanstha-samiti'))
                                                {{ config('constant.SITE_NAME') . '-' . Nepali($type->typeable->ward_no) }}
                                            @else
                                                {{ $type->typeable->address . Nepali($type->typeable->ward_no) }}
                                            @endif 
                                        </p>
                                    </div>
                                <table class="letter_table table table-bordered"  style="font-size: 1rem !important">
                               
                                    @if (config('TYPE.AMANAT_MARFAT') != session('type_id'))
                                        <tr>
                                            <th style="width:10px !important;">{{ __('सि.नं.') }}</th>
                                            <th class="text-center">{{ __('पद') }}</th>
                                            <th class="text-center">{{ __('नामथर') }}</th>
                                            <th class="text-center">{{ __('ठेगाना') }}</th>
                                            <th class="text-center">{{ __('लिगं') }}</th>
                                            <th class="text-center">{{ __('नागरिकता नं') }}</th>
                                            <th class="text-center">{{ __('जारी जिल्ला') }}</th>
                                            <th class="text-center">{{ __('मोबाइल नं') }}</th>
                                        </tr>
                                        @foreach ($type_details as $key => $type_detail)
                                            <tr>
                                                <td>
                                                    {{ Nepali($key + 1) }}</td>
                                                <td class="text-center" style="font-weight: lighter !important;">
                                                    @if (config('TYPE.TOLE_BIKAS_SAMITI') == session('type_id'))
                                                        {{ getSettingValueById($type_detail->position)->name }}
                                                    @else
                                                        {{ getSettingValueById($type_detail->post_id)->name }}
                                                    @endif
                                                </td>
                                                <td class="text-center" style="font-weight: lighter !important;">
                                                    {{ $type_detail->name }}</td>
                                                <td class="text-center" style="font-weight: lighter !important;">
                                                    {{ config('constant.SITE_NAME') . '-' . Nepali($type_detail->ward_no) }}
                                                </td>
                                                <td class="text-center" style="font-weight: lighter !important;">
                                                    {{ returnGender($type_detail->gender) }}</td>
                                                <td class="text-center" style="font-weight: lighter !important;">
                                                    {{ Nepali($type_detail->cit_no) }}</td>
                                                <td class="text-center" style="font-weight: lighter !important;">
                                                    {{ $type_detail->issue_district }}</td>
                                                <td class="text-center" style="font-weight: lighter !important;">
                                                    {{ Nepali($type_detail->contact_no) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                                {{-- anugaman samiti sambandhi bibaran --}}
                                <p class="text-center my-3 font-weight-bold" style="text-align:center; font-weight:bold">
                                    {{ __('अनुगमन समिति सम्बन्धी विवरण') }}</p>
                                <table class="letter_table table table-bordered" style="font-size: 1rem !important">
                                    <tr>
                                        <th class="text-center">{{ __('सि.नं.') }}</th>
                                        <th class="text-center">{{ __('पद') }}</th>
                                        <th class="text-center">{{ __('नामथर') }}</th>
                                        <th class="text-center">{{ __('लिगं') }}</th>
                                    </tr>
                                    @foreach ($anugamanPlan->anugamanSamiti->anugamanSamitiDetails->where('status',1)->values() as $anugamanKey => $anugamanSamitiDetail)
                                        <tr>
                                            <td class="text-center">{{ Nepali($anugamanKey + 1) }}</td>
                                            <td class="text-center">{{getSettingValueById($anugamanSamitiDetail->post_id)->name ?? ''}}</td>
                                            <td class="text-center">{{ $anugamanSamitiDetail->name }}</td>
                                            <td class="text-center">{{ returnGender($anugamanSamitiDetail->gender) }}</td>
                                        </tr>
                                    @endforeach
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
