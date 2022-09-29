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
                    <form action="{{ route('print.program.letter.printWorkOrderLetterTwo') }}" method="get"
                        target="_blank">
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
                            <div class="letter_subject">विषय:- कार्यादेश दिईएको बारे ।</div>
                            <div class="letter_body">
                                <p class="letter_greeting">श्री {{ $work_order->name }},
                                </p>
                                <p class="letter_greeting">
                                    @if ($work_order->listRegistrationAttribute->listRegistration->id == config('YOJANA.LIST_REGISTRATION.UPABHOKTA_SAMITI'))
                                        {{ config('constant.SITE_NAME') . ' वडा नं ' . Nepali($work_order->listRegistrationAttribute->ward_no) }}
                                    @else
                                        {{ $work_order->listRegistrationAttribute->address }}
                                    @endif
                                </p>
                                <p class="letter_text my-2">
                                    यस कार्यालयको स्वीकृत बार्षिक कार्यक्रम अनुसार तपशिलको विवरणमा उल्लेख भए बमोजिमको
                                    कार्यक्रम संचालन गर्न यस कार्यालयको मिति {{ Nepali($work_order->decision_date_nep) }}
                                    को निर्णय अनुसार यो कार्यादेश दिईएको
                                    छ ।
                                </p>
                                <p class="text-center font-weight-bold">{{ __('तपशिल') }}</p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <td>आर्थिक बर्ष :</td>
                                        <td style="font-weight: lighter;">{{ Nepali(getCurrentFiscalYear()) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यदेश नं :</td>
                                        <td style="font-weight: lighter;">{{ Nepali($work_order->work_order_no) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यक्रमको नाम :</td>
                                        <td style="font-weight: lighter;">{{ $program->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यक्रम संचालन हुने स्थान :</td>
                                        <td style="font-weight: lighter;">{{ $work_order->venue }}</td>
                                    </tr>
                                    <tr>
                                        <td>बिषयगत क्षेत्र :</td>
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
                                            {{ NepaliAmount($program->grant_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td>लागत सहभागित रकम :</td>
                                        <td style="font-weight: lighter;">
                                            {{ NepaliAmount($work_order->cost_participation) }}</td>
                                    </tr>
                                    <tr>
                                        <td>नगद साझेदारी रकम :</td>
                                        <td style="font-weight: lighter;">
                                            {{ NepaliAmount($work_order->cost_sharing) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यादेश रकम :</td>
                                        <td style="font-weight: lighter;">
                                            {{ NepaliAmount($work_order->work_order_budget) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यक्रम शुरु हुने मिति :</td>
                                        <td style="font-weight: lighter;">
                                            {{ Nepali($work_order->program_start_date_nep) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यक्रम सम्पन्न हुने मिति :</td>
                                        <td style="font-weight: lighter;">
                                            {{ Nepali($work_order->program_end_date_nep) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="letter_footer">
                                <!-- Sign Item  -->
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
                                <!-- Sign Item  -->
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
                                <!-- Sign Item  -->
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
