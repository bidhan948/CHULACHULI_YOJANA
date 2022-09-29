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
                    <form action="{{ route('plan.print.letter.mulyankan_bhuktani') }}" method="get" target="_blank">
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
                            
                            <div class="letter_subject">विषय:-  सिफारिस सम्बन्धमा ।</div>
                            <div class="letter_body">
                                
                            <div class="letter_body">
                                
                                <p class="letter_greeting">श्री,{{config('constant.SITE_NAME') }}</p>
                                 <span id="bank_address">
                                  {{config('constant.SITE_DISTRICT')}}, {{config('constant.FULL_ADDRESS')}}
                                </span> <br> <br>
                                <p class="letter_text">
                                           उपरोक्त बिषयमा श्री  {{$type->typeable->name}}ले यस वडा  कार्यालयमा  {{$plan->name}} योजना काम भइरहेको हुँदा मुल्यांकनको आधारमा भुक्तानीको लागि सिफारिस पाऊ भनि दिएको निबेदन अनुसार यस वडा कार्यालयबाट ऊक्त योजनाको स्थल गत निरीक्षण गर्दा योजनाको काम भइरहेको हुँदा नियम  अनुसार मुल्यांकनको आधारमा भुक्तानी दिनुहुन अनुरोध छ ।
                                </p>
                                <p style="text-align:center !important;">तपशिल</p>
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
                                        <td>{{ config('TYPE.' . session('type_id')) }}को नाम :</td>
                                        <td>{{ $type->typeable->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>ठेगाना :</td>
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
                                        <td>विनियोजन किसिम :</td>
                                        <td>{{ getSettingValueById($plan->type_of_allocation_id)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('constant.SITE_TYPE') }}बाट अनुदान रकम :</td>
                                        <td>{{ NepaliAmount($plan->grant_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td>अन्य निकायबाट प्राप्त अनुदान रकम :</td>
                                        <td>{{ NepaliAmount($plan->kulLagat->other_office_con) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('TYPE.' . session('type_id')) }}बाट नगद साझेदारी रकम :</td>
                                        <td>{{ NepaliAmount($plan->kulLagat->customer_agreement) }}</td>
                                    </tr>
                                    <tr>
                                        <td>अन्य साझेदारी रकम :</td>
                                        <td>{{ NepaliAmount($plan->kulLagat->other_office_agreement) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{config('TYPE.'.session('type_id'))}}बाट लागत सहभागिता रकम :
                                            ({{ NepaliAmount(round(($plan->kulLagat->consumer_budget / $plan->kulLagat->total_investment) * 100, 2)) . '%' }})
                                        </td>
                                        <td>{{ NepaliAmount($plan->kulLagat->consumer_budget) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कुल लागत अनुमान जम्मा रकम :</td>
                                        <td>{{ NepaliAmount($plan->kulLagat->total_investment) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यदेश रकम :</td>
                                        <td>{{ NepaliAmount($plan->kulLagat->total_investment - $plan->kulLagat->consumer_budget) }}
                                        </td>
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
                            </div>
                            <div class="letter_footer">
                                <div class="letter_sign">
                                    <div class="sign_title">तयार गर्ने</div>
                                    <select name="ready" id="ready" onchange="assignPost('ready')">
                                        <option value="">-- छानुहोस --</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->user_id }}">{{ $staff->nep_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="ready_post"> </div>
                                </div>
                                <div class="letter_sign">
                                    <div class="sign_title">पेश गर्ने</div>
                                    <select name="present" id="present" onchange="assignPost('present')">
                                        <option value="">-- छानुहोस --</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->user_id }}">{{ $staff->nep_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="present_post"></div>
                                </div>
                                <div class="letter_sign">
                                    <div class="sign_title">स्वीकृत गर्ने</div>
                                    <select name="approve" id="approve" onchange="assignPost('approve')">
                                        <option value="">-- छानुहोस --</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->user_id }}">{{ $staff->nep_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="approve_post"></div>
                                </div>
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
