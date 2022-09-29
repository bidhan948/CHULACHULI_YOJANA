@section('title', $program->name)
@section('operate_program', 'active')
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
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="letter_wrap">
                    <form action="{{ route('print.program.letter.printAgreementLetter') }}" method="get" target="_blank">
                        <input name="program_id" value="{{ $program->id }}" type="hidden">
                        <input name="work_order_id" value="{{ $work_order->id }}" type="hidden">
                        <div class="letter_inner">
                            <button id="print_btn" type="submit">
                                <i class="fa-solid fa-print"></i> <span> प्रिन्ट </span>
                            </button>
                            <div class="letter_header">
                                <img src="{{ asset('emblem_nepal.png') }}" alt="" class="letter_logo" />
                                <div class="letter_number_detail">
                                    <div>पत्र संख्या : {{ Nepali(getCurrentFiscalYear()) }}</div>
                                    <div>कार्यक्रम दर्ता नं : {{ Nepali($reg_no) }}</div>
                                    <div>चलानी नं . :</div>
                                </div>

                                @include('yojana.letter.include.letter_title', [
                                    'letter_title' => '',
                                ])

                                <div class="letter_date">
                                    <span> मिति </span>
                                     <input class="form-control form-control-sm" name="date_nep" required id="testDate" />
                                </div>
                            </div>
                            <div class="letter_body" style="margin-top:60px;">
                                <p class="text-center font-weight-bold">{{ __('कार्यक्रम संझौता फाराम') }}</p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <td>कार्यक्रमको नाम :</td>
                                        <td style="font-weight: lighter;">{{ $program->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यक्रमको बिषयगत क्षेत्र :</td>
                                        <td style="font-weight: lighter;">
                                            {{ getSettingValueById($program->topic_id)->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>उपक्षेत्र :</td>
                                        <td style="font-weight: lighter;">
                                            {{ getSettingValueById($program->topic_area_type_id)->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>विनियोजन किसिम :</td>
                                        <td style="font-weight: lighter;">
                                            {{ getSettingValueById($program->type_of_allocation_id)->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('constant.SITE_TYPE') }}बाट :</td>
                                        <td style="font-weight: lighter;">
                                            {{ 'रु ' . NepaliAmount($program->grant_amount) }}</td>
                                    </tr>
                                </table>
                                <p style="text-align: center" class="font-weight-bold mt-3">
                                    {{ __('कार्यक्रमको कार्यादेश सम्बन्धी विवरण') }}</p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <td>कार्यदेश नं :</td>
                                        <td style="font-weight: lighter;">{{ Nepali($work_order->work_order_no) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यादेश दिने निर्णय भएको मिति :</td>
                                        <td style="font-weight: lighter;">{{ Nepali($work_order->decision_date_nep) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('constant.SITE_TYPE') }}बाट विनियोजित रकम :</td>
                                        <td style="font-weight: lighter;">रु
                                            {{ NepaliAmount($work_order->municipality_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td>लागत सहभागित रकम :</td>
                                        <td style="font-weight: lighter;">
                                            रु {{ NepaliAmount($work_order->cost_participation) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यादेश रकम :</td>
                                        <td style="font-weight: lighter;">
                                            रु {{ NepaliAmount($work_order->work_order_budget) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यक्रम संचालन हुने स्थान :</td>
                                        <td style="font-weight: lighter;">
                                            {{ $work_order->venue }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यक्रमको संचालन गर्ने :</td>
                                        <td style="font-weight: lighter;">
                                            {{ $work_order->listRegistrationAttribute->listRegistration->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>नाम :</td>
                                        <td style="font-weight: lighter;">
                                            {{ $work_order->listRegistrationAttribute->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>ठेगाना :</td>
                                        <td style="font-weight: lighter;">
                                            @if ($work_order->listRegistrationAttribute->listRegistration->id ==
                                                config('YOJANA.LIST_REGISTRATION.UPABHOKTA_SAMITI'))
                                                {{ config('constant.SITE_NAME') . ' वडा नं ' . Nepali($work_order->listRegistrationAttribute->ward_no) }}
                                            @else
                                                {{ $work_order->listRegistrationAttribute->address }}
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($work_order->listRegistrationAttribute->listRegistration->id !=
                                        config('YOJANA.LIST_REGISTRATION.UPABHOKTA_SAMITI'))
                                        <tr>
                                            <td>सम्पर्क नं :</td>
                                            <td style="font-weight: lighter;">
                                                {{ Nepali($work_order->listRegistrationAttribute->contact_no) }}</td>
                                        </tr>
                                    @endif
                                </table>
                                <p class="mb-0 bg-dark text-center mt-3">
                                    {{ __('कार्यक्रमबाट लाभान्वित घरधुरी तथा परिबारको विबरण') }}
                                </p>
                                <table id="table1" width="100%" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="text-center" style="font-weight: lighter;">लाभान्वित
                                                जनसंख्या</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center" style="font-weight: lighter;">
                                                {{ __('घर परिवार संख्या') }}</th>
                                            <th class="text-center" style="font-weight: lighter;">{{ __('महिला') }}</th>
                                            <th class="text-center" style="font-weight: lighter;">{{ __('पुरुष') }}</th>
                                            <th class="text-center" style="font-weight: lighter;">{{ __('जम्मा') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                                {{ Nepali($work_order->house_family_count) }}
                                            </td>
                                            <td class="text-center">
                                                {{ Nepali($work_order->female) }}
                                            </td>
                                            <td class="text-center">
                                                {{ Nepali($work_order->male) }}
                                            </td>
                                            <td class="text-center">
                                                {{ Nepali($work_order->male + $work_order->female) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p style="text-align:center;">{{ __('सम्झौताका शर्तहरु') }}</p>
                                <div class="my-2">
                                    <li> कार्यक्रम मिति {{ Nepali($work_order->program_start_date_nep) }} देखि शुरु गरी
                                        मिति {{ Nepali($work_order->program_end_date_nep) }} सम्ममा पुरा गर्नु पर्नेछ ।
                                    </li>
                                    {!! $term->term !!}
                                </div>
                                <p class="my-2" style="text-align:center;">
                                    {{ __('माथि उल्लेख भए बमोजिमका शर्तहरु पालना गर्न हामी निम्न पक्षहरु मन्जुर गर्दछौं ।') }}
                                </p>
                                <p style="text-align:center;">
                                    {{ __('कार्यक्रम संचालकको तर्फबाट') }}
                                </p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <td>कार्यक्रमको संचालन गर्ने :</td>
                                        <td style="font-weight: lighter;">
                                            {{ $work_order->listRegistrationAttribute->listRegistration->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>नाम :</td>
                                        <td style="font-weight: lighter;">
                                            {{ $work_order->listRegistrationAttribute->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>ठेगाना :</td>
                                        <td style="font-weight: lighter;">
                                            @if ($work_order->listRegistrationAttribute->listRegistration->id ==
                                                config('YOJANA.LIST_REGISTRATION.UPABHOKTA_SAMITI'))
                                                {{ config('constant.SITE_NAME') . ' वडा नं ' . Nepali($work_order->listRegistrationAttribute->ward_no) }}
                                            @else
                                                {{ Nepali($work_order->listRegistrationAttribute->address) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>दस्तखत :</td>
                                        <td style="font-weight: lighter;"></td>
                                    </tr>
                                    <tr>
                                        <td>सम्झौता मिति :</td>
                                        <td style="font-weight: lighter;">
                                            {{ Nepali($work_order->date_nep) }}</td>
                                    </tr>
                                </table>
                                <p style="text-align:center;" class="mt-3">
                                    {{ __('कार्यालयको तर्फबाट') }}
                                </p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <th class="text-center">पद :</th>
                                        <th>नामथर</td>
                                        <th>मिति</td>
                                        <th>दस्तखत</td>
                                        <th>कार्यालयको छाप</td>
                                    </tr>
                                    @foreach ($work_order->workOrderDetail as $work_order_detail)
                                        <tr>
                                            <td style="font-weight: lighter;">
                                                {{ getSettingValueById($work_order_detail->post_id)->name ?? '' }}</td>
                                            <td style="font-weight: lighter;">{{ $work_order_detail->Staff->nep_name }}
                                            </td>
                                            <td style="font-weight: lighter;">{{ Nepali($work_order->date_nep) }}</td>
                                            <td></td>
                                            <td></td>
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
    </script>
@endsection
