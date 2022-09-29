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
                <!--<div class="letter_subject"></div>-->
                <div class="letter_body">
                    <p class="letter_text" style = "text-align:center">
                        {{ config('constant.SITE_NAME') }} र तपसिलमा उल्लेखित
                        {{ config('TYPE.' . session('type_id')) }} विच तपसिलमा
                        उल्लेखित कार्य गर्न
                        सहमत भई गरिएको दुइपक्षीय आयोजना सम्झौता {{ Nepali(getCurrentFiscalYear()) }}
                    </p>
                    <table class="letter_table table table-bordered">
                        <tr>
                            <td style="text-align:right; width:50%">योजनाको नाम :</td>
                            <td>{{ $plan->name }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; width:50%">आयोजना सचालन हुने स्थान / वार्ड नं :</td>
                            <td>{{ config('constant.SITE_NAME') . '-' }}
                                {{ Nepali($plan->planWardDetails->implode('ward_no', ',')) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; width:50%">योजनाको बिषयगत क्षेत्रको नाम :</td>
                            <td>{{ getSettingValueById($plan->topic_id)->name }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; width:50%">योजनाको उपक्षेत्र नाम :</td>
                            <td>{{ getSettingValueById($plan->topic_area_type_id)->name }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; width:50%">विनियोजन किसिम :</td>
                            <td>{{ getSettingValueById($plan->type_of_allocation_id)->name }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; width:50%">ठेगाना :</td>
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
                            <td style="text-align:right; width:50%">अनुदान रकम :</td>
                            <td>{{ NepaliAmount($plan->grant_amount) }}</td>
                        </tr>
                    </table>

                    {{-- kul lagat table --}}
                    <p class="text-center my-3" style="text-align:center;">{{ __('योजनाको कुल लागत अनुमान') }}</p>
                    <table class="letter_table table table-bordered">
                        <tr>
                            <td style="text-align:right; width:50%">{{ config('constant.SITE_TYPE') }}बाट अनुदान रकम :</td>
                            <td>{{ NepaliAmount($plan->grant_amount) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; width:50%">अन्य निकायबाट प्राप्त अनुदान :</td>
                            <td>{{ NepaliAmount($plan->kulLagat->other_office_con) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; width:50%">{{ config('TYPE.' . session('type_id')) }}बाट नगद
                                साझेदारी रकम :</td>
                            <td>{{ NepaliAmount($plan->kulLagat->customer_agreement) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; width:50%">अन्य साझेदारी रकम :</td>
                            <td>{{ NepaliAmount($plan->kulLagat->other_office_agreement) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; width:50%">{{ config('TYPE.' . session('type_id')) . 'बाट' }}
                                जनश्रमदान :</td>
                            <td>{{ NepaliAmount($plan->kulLagat->consumer_budget) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; width:50%">कुल लागत अनुमान जम्मा रकम :</td>
                            <td>{{ NepaliAmount($plan->kulLagat->total_investment) }}</td>
                        </tr>
                    </table>

                    {{-- type table --}}
                    <p class="text-center my-3" style="text-align:center;">
                        {{ config('TYPE.' . session('type_id')) . __(' सम्बन्धी विवरण') }}</p>
                    <table class="letter_table table table-bordered">
                        <tr>
                            <th colspan="8" style="font-weight: lighter !important">
                                योजनाको संचालन गर्ने {{ config('TYPE.' . session('type_id')) }}को नाम:
                                {{ $type->typeable->name }}
                            </th>
                        </tr>
                        <tr>
                            <th colspan="8" style="font-weight: lighter !important">
                                योजनाको संचालन गर्ने {{ config('TYPE.' . session('type_id')) }}को ठेगाना:
                                @if (session('type_id') == config('TYPE.TOLE_BIKAS_SAMITI'))
                                    {{ config('constant.SITE_NAME') . '-' . Nepali($type->typeable->former_ward_no) }}
                                @elseif(session('type_id') == config('TYPE.upabhokta-samiti') || session('type_id') == config('TYPE.sanstha-samiti'))
                                    {{ config('constant.SITE_NAME') . '-' . Nepali($type->typeable->ward_no) }}
                                @else
                                    {{ $type->typeable->address . Nepali($type->typeable->ward_no) }}
                                @endif
                            </th>
                        </tr>
                        @if (config('TYPE.AMANAT_MARFAT') != session('type_id'))
                            <tr>
                                <th class="text-center">{{ __('सि.नं.') }}</th>
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
                    <p class="text-center my-3" style="text-align:center;">
                        {{ __('अनुगमन समिति सम्बन्धी विवरण') }}</p>
                    <table class="letter_table table table-bordered">
                        <tr>
                            <th class="text-center">{{ __('सि.नं.') }}</th>
                            <th class="text-center">{{ __('पद') }}</th>
                            <th class="text-center">{{ __('नामथर') }}</th>
                            <th class="text-center">{{ __('लिगं') }}</th>
                        </tr>
                        @foreach ($anugamanPlan->anugamanSamiti->anugamanSamitiDetails->where('status', 1)->values() as $anugamanKey => $anugamanSamitiDetail)
                            <tr>
                                <td class="text-center">{{ Nepali($anugamanKey + 1) }}</td>
                                <td class="text-center">
                                    {{ getSettingValueById($anugamanSamitiDetail->post_id)->name ?? '' }}</td>
                                <td class="text-center">{{ $anugamanSamitiDetail->name }}</td>
                                <td class="text-center">{{ returnGender($anugamanSamitiDetail->gender) }}</td>
                            </tr>
                        @endforeach
                    </table>
                    {{-- yojana other bibaran detail --}}
                    <p class="text-center my-3" style="text-align:center;">{{ __('योजना सम्बन्धी अन्य विवरण') }}</p>
                    <table class="letter_table table table-bordered">
                        @if (config('TYPE.AMANAT_MARFAT') != session('type_id'))
                            <tr>
                                <th class="text-center">
                                    {{ config('TYPE.' . session('type_id')) . __(' गठन भएको मिति :') }}</th>
                                <th class="text-center" style="font-weight: lighter !important">
                                    {{ Nepali($plan->otherBibaran->formation_start_date) }} </th>
                            </tr>
                        @endif
                        @if (config('TYPE.AMANAT_MARFAT') != session('type_id'))
                            <tr>
                                <th class="text-center">
                                    {{ config('TYPE.' . session('type_id')) . __(' भेलामा उपस्थिति संख्या :') }}
                                </th>
                                <th class="text-center" style="font-weight: lighter !important">
                                    {{ Nepali($plan->otherBibaran->committee_count) }} </th>
                            </tr>
                        @endif
                        <tr>
                            <th class="text-center">
                                {{ __('योजना शुरु हुने मिति :') }}
                            </th>
                            <th class="text-center" style="font-weight: lighter !important">
                                {{ Nepali($plan->otherBibaran->start_date) }} </th>
                        </tr>
                        <tr>
                            <th class="text-center">
                                {{ __('योजना सम्पन्न हुने मिति हुने मिति :') }}
                            </th>
                            <th class="text-center" style="font-weight: lighter !important">
                                {{ Nepali($plan->otherBibaran->end_date) }} </th>
                        </tr>
                    </table>
                    <p class="text-center my-3" style="text-align:center;">
                        {{ __('योजनाबाट लाभान्वित घरधुरी तथा परिवारको विवरण') }}</p>
                    <table class="letter_table table table-bordered">
                        <tr>
                            <th class="text-center" colspan="4" style="font-weight: lighter !important">
                                लाभान्वित जनसंख्या
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">{{ __('घर परिवार संख्या') }}</th>
                            <th class="text-center">{{ __('महिला') }}</th>
                            <th class="text-center">{{ __('पुरुष') }}</th>
                            <th class="text-center">{{ __('जम्मा') }}</th>
                        </tr>
                        <tr>
                            <td class="text-center" style="font-weight: lighter !important;">
                                {{ Nepali($plan->otherBibaran->house_family_count) }}</td>
                            <td class="text-center" style="font-weight: lighter !important;">
                                {{ Nepali($plan->otherBibaran->female) }}</td>
                            <td class="text-center" style="font-weight: lighter !important;">
                                {{ Nepali($plan->otherBibaran->male) }}</td>
                            <td class="text-center" style="font-weight: lighter !important;">
                                {{ Nepali($plan->otherBibaran->male + $plan->otherBibaran->female) }}</td>
                        </tr>
                    </table>
                    
                    <p class="text-center">
                        {!! $term == null ? '' : $term->term !!}
                    </p>
                    <p class="mt-1 mb-2 text-center">
                        माथि उल्लेख भए बमोजिमका शर्तहरु पालना गर्न हामी निम्न पक्षहरु मन्जुर गर्दछौं ।
                    </p>

                    @if (config('TYPE.AMANAT_MARFAT') != session('type_id'))
                        {{-- type detail --}}
                       
                        <p class="text-center my-3" style="text-align:center;">
                            {{ config('TYPE.' . session('type_id')) . __('को तर्फबाट') }}</p>
                        <table class="letter_table table table-bordered">
                            <tr>
                                <th class="text-center">{{ __('पद') }}</th>
                                <th class="text-center">{{ __('नाम/थर') }}</th>
                                <th class="text-center">{{ __('दस्तखत') }}</th>
                            </tr>
                            {!! $htmlTypeTableRow !!}
                        </table>
                    @endif

                    {{-- other bibaran data --}}
                    <p class="text-center my-3" style="text-align:center;">{{ __('कार्यालयको तर्फबाट') }}</p>
                
                    <table class="letter_table table table-bordered">
                                    <tr>
                                        <th class="text-center">{{ __('नाम') }}</th>
                                        <th class="text-center">{{ __('पद') }}</th>
                                        <th class="text-center">{{ __('मिति') }}</th>
                                        <th class="text-center">{{ __('दस्तखत') }}</th>
                                    </tr>
                                    @foreach ($plan->otherBibaran->otherBibaranDetail as $otherBibaranDetail)
                                        <tr>
                                            <td class="text-center" style="text-align:center">{{ $otherBibaranDetail->Staff->nep_name }}</td>
                                            <td class="text-center" style="text-align:center">
                                                {{ getSettingValueById($otherBibaranDetail->staffServices->position)->name ?? '' }}
                                            </td>
                                            <td class="text-center" style="text-align:center">
                                                {{ Nepali($plan->otherBibaran->agreement_date_nep) }}</td>
                                            <td class="text-center"></td>
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
