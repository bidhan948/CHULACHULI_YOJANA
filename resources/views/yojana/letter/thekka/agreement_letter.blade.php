@section('title', $plan->name)
@section('operate_plan', 'active')
@extends('layout.layout')
@section('sidebar')
    @include('layout.yojana_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('letter_print.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('letter.dashboard', $plan->reg_no) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="letter_wrap">
                    <form action="{{ route('print.plan.letter.thekka.agreement') }}" method="get" target="_blank">
                        <input name="plan_id" value="{{ $plan->reg_no }}" type="hidden">
                        <div class="letter_inner">
                            <button id="print_btn" type="submit">
                                <i class="fa-solid fa-print"></i> <span> प्रिन्ट </span>
                            </button>
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
                                    <span> मिति </span>
                                    <!--<input class="my-date form-control hello" name="date_nep" required />-->
                                    <input id="testDate" class=" form-control form-control-sm " name="date_nep" required />
                                </div>
                            </div>
                            <div class="letter_subject"></div>
                            <div class="letter_body">
                                <p class="letter_greeting"></p>
                                <p style="text-align:center">
                                    {{ config('constant.SITE_NAME') }} र तपसिलमा उल्लेखित
                                    {{ $contract_kabol_single->listRegistrationAttribute->listRegistration->name }} विच
                                    तपसिलमा
                                    उल्लेखित कार्य गर्न
                                    सहमत भई गरिएको दुइपक्षीय आयोजना सम्झौता {{ Nepali(getCurrentFiscalYear()) }}
                                </p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <td style="text-align:right; width:50%;">योजनाको नाम :</td>
                                        <td>{{ $plan->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;">आयोजना सचालन हुने स्थान / वार्ड नं :</td>
                                        <td>{{ config('constant.SITE_NAME') . '-' }}
                                            {{ Nepali($plan->planWardDetails->implode('ward_no', ',')) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;">योजनाको बिषयगत क्षेत्रको नाम :</td>
                                        <td>{{ getSettingValueById($plan->topic_id)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;">योजनाको उपक्षेत्र नाम :</td>
                                        <td>{{ getSettingValueById($plan->topic_area_type_id)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;">विनियोजन किसिम :</td>
                                        <td>{{ getSettingValueById($plan->type_of_allocation_id)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;">ठेगाना :</td>
                                        <td>
                                            {{ Nepali($contract_kabol_single->listRegistrationAttribute->address) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;">अनुदान रकम :</td>
                                        <td>{{ NepaliAmount($plan->grant_amount) }}</td>
                                    </tr>
                                </table>

                                {{-- kul lagat table --}}
                                <p class="text-center my-3 font-weight-bold">{{ __('योजनाको कुल लागत अनुमान') }}</p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <td style="text-align:right; width:50%;">भौतिक परिणाम :</td>
                                        <td>{{ NepaliAmount($contract_kul_lagat->physical_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right; width:50%;">भौतिक ईकाई :</td>
                                        <td>{{ $contract_kul_lagat->Unit->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right; width:50%;">{{ config('constant.SITE_TYPE') }}बाट
                                            अनुदान रकम :</td>
                                        <td>{{ NepaliAmount($plan->grant_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right; width:50%;">ठेक्का कबोल गरेको कुल रकम (भ्याट बाहेक) :
                                        </td>
                                        <td>{{ NepaliAmount($contract_kabol_single->has_vat == 2 ? $contract_kabol_single->total_kabol_amount : getPreciseFloat($contract_kabol_single->total_kabol_amount / 1.13, 2)) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right; width:50%;">कुल ठेक्का रकम जम्मा (भ्याट सहित) :</td>
                                        <td>{{ NepaliAmount($contract_kabol_single->total_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right; width:50%;">कार्यदेश दिएको रकम :</td>
                                        <td>{{ NepaliAmount($contract_kabol_single->total_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right; width:50%;">योजना संचालन गर्ने
                                            {{ $contract_kabol_single->listRegistrationAttribute->listRegistration->name }}
                                        </td>
                                        <td>{{ $contract_kabol_single->listRegistrationAttribute->name }}</td>
                                    </tr>
                                </table>

                                <p class="text-center my-3 font-weight-bold">
                                    {{ config('TYPE.' . session('type_id')) . __(' सम्बन्धी विवरण') }}</p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <th class="text-center">
                                            {{ __('योजना शुरु हुने मिति :') }}
                                        </th>
                                        <th class="text-center" style="font-weight: lighter !important">
                                            {{ Nepali($plan->otherBibaran->start_date) }} </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">
                                            {{ __('योजना सम्पन्न हुने मिति :') }}
                                        </th>
                                        <th class="text-center" style="font-weight: lighter !important">
                                            {{ Nepali($plan->otherBibaran->end_date) }} </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">
                                            {{ __('योजना संचालन हुने स्थान :') }}
                                        </th>
                                        <th class="text-center" style="font-weight: lighter !important">
                                            {{ Nepali($plan->otherBibaran->venue) }} </th>
                                    </tr>
                                </table>
                                <p class="text-center my-3 font-weight-bold">
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
                                {{-- other bibaran data --}}
                                <p class="text-center my-3 font-weight-bold">
                                    {{ $contract_kabol_single->listRegistrationAttribute->listRegistration->name . 'को तर्फबाट' }}
                                </p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <th class="text-center">{{ __('नाम') }}</th>
                                        <th class="text-center">
                                            {{ $contract_kabol_single->listRegistrationAttribute->name }}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">{{ __('ठेगाना') }}</th>
                                        <th class="text-center">
                                            {{ $contract_kabol_single->listRegistrationAttribute->address }}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">{{ __('सम्पर्क नं ') }}</th>
                                        <th class="text-center">
                                            {{ Nepali($contract_kabol_single->listRegistrationAttribute->contact_no) }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">{{ __('दस्तखत') }}</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </table>
                                {{-- other bibaran data --}}
                                <p class="text-center my-3 font-weight-bold">{{ __('कार्यालयको तर्फबाट') }}</p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <th class="text-center">{{ __('नाम') }}</th>
                                        <th class="text-center">{{ __('पद') }}</th>
                                        <th class="text-center">{{ __('मिति') }}</th>
                                        <th class="text-center">{{ __('दस्तखत') }}</th>
                                    </tr>
                                    @foreach ($plan->otherBibaran->otherBibaranDetail as $otherBibaranDetail)
                                        <tr>
                                            <td class="text-center">{{ $otherBibaranDetail->Staff->nep_name }}</td>
                                            <td class="text-center" style="font-weight:lighter !important;">
                                                {{ getSettingValueById($otherBibaranDetail->staffServices->position)->name ?? '' }}
                                            </td>
                                            <td class="text-center" style="font-weight: lighter;">
                                                {{ Nepali($plan->otherBibaran->agreement_date_nep) }}</td>
                                            <td class="text-center"></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                    </form>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('scripts')
    <script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        window.onload = function() {
            // var date_fields = document.getElementsByClassName("my-date");
            // for (let index = 0; index < date_fields.length; index++) {
            //     const element = date_fields[index];
            //     element.nepaliDatePicker({
            //         readOnlyInput: true,
            //         ndpTriggerButton: false,
            //         ndpYear: true,
            //         ndpMonth: true,
            //         ndpYearCount: 10
            //     });
            // }

            var mainInput = document.getElementById("testDate");
            mainInput.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100
            });


        };

        function assignPost(id) {
            var val = $("#" + id).val();
            if (val == "") {
                $("#" + id + "_post").html("");
            } else {
                axios.get("{{ route('api.getPostByStaffId') }}", {
                        params: {
                            staff_id: val
                        }
                    })
                    .then(function(response) {
                        $("#" + id + "_post").html(response.data.post);
                    }).catch(function(error) {
                        console.log(error);
                        alert("Server Error");
                    });
            }
        }
    </script>
@endsection
