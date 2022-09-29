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
                        <a href="{{ route('letter.dashboard', $plan->id) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="letter_wrap">
                    <form action="{{ route('plan.print.letter.peski_account_letter') }}" method="get" target="_blank">
                        <input name="plan_id" value="{{ $plan->id }}" type="hidden">
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
                                    <input class="my-date form-control form-control-sm" name="date_nep" required />
                                </div>
                            </div>
                            <div class="letter_subject">विषय:- पेस्की सम्बन्धमा ।</div>
                            <div class="letter_body">
                                <p class="letter_greeting">श्री आर्थिक प्रशासन शाखा,</p>
                                <p class="letter_greeting">
                                    {{ config('constant.SITE_NAME') }},{{ config('constant.SITE_DISTRICT') }}</p>
                                <p class="letter_text my-2">
                                    यस कार्यालयको स्वीकृत वार्षिक कार्यक्रम अनुसार तपशिलको विवरणमा उल्लेख बमोजिमको योजना
                                    संचालन गर्न श्री {{ $type->typeable->name }} विच
                                    मिति {{ Nepali($plan->otherBibaran->agreement_date_nep) }} यस
                                    {{ config('constant.SITE_TYPE') }}सँग भएको संझौता अनुसार योजनाको काम शुरु गर्न यस
                                    कार्यालयको निर्णय अनुसार मिति
                                    {{ Nepali($advance->advance_paid_date_nep) }} भित्रमा पेश्की फर्छयौट गर्ने गरी उक्त
                                    योजना संचालनका लागी रु {{ NepaliAmount($advance->peski_amount) }} पेश्की
                                    उपलब्ध गराउन हुन अनुरोध छ |
                                </p>

                                <p class="text-center font-weight-bold my-3">
                                    {{ __('तपशिल') }}</p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <td class="text-center">{{ __('बिनियोजन श्रोत र व्याख्या:') }}</th>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ $plan->detail }}</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('योजनाको नाम :') }}</th>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ $plan->name }}</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ __('ठेगाना :') }}</th>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ config('constant.SITE_NAME') . Nepali($plan->ward_no ? '-' . $plan->ward_no : '') }}
                                            </th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">योजनाको बिषयगत क्षेत्रको नाम :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ getSettingValueById($plan->topic_id)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">योजनाको उपक्षेत्र नाम :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ getSettingValueById($plan->topic_area_type_id)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">योजनाको बजेट शिर्षक :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            @foreach ($plan->budgetSourcePlanDetails as $comma => $budgetSource)
                                                {{ $budgetSource->budgetSources->name . ($comma + 1 == $plan->budgetSourcePlanDetails->count() ? ' ' : ' ,') }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">विनियोजन किसिम :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ getSettingValueById($plan->type_of_allocation_id)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ config('constant.SITE_TYPE') }}बाट अनुदान :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ NepaliAmount($plan->grant_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">अन्य निकायबाट प्राप्त अनुदान रकम :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ NepaliAmount($plan->kulLagat->other_office_con) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ config('TYPE.' . session('type_id')) }}बाट नगद
                                            साझेदारी
                                            रकम :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ NepaliAmount($plan->kulLagat->customer_agreement) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">अन्य साझेदारी रकम : </td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ NepaliAmount($plan->kulLagat->other_office_agreement) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ config('TYPE.' . session('type_id')) }}बाट जनश्रमदान
                                            रकम :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ NepaliAmount($plan->kulLagat->consumer_budget) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">कुल लागत अनुमान जम्मा रकम :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ NepaliAmount($plan->kulLagat->total_investment) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">योजना शुरु हुने मिति :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ Nepali($plan->otherBibaran->start_date) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">योजना सम्पन्न हुने मिति :</td>
                                        <td class="text-center" style="font-weight: lighter">
                                            {{ Nepali($plan->otherBibaran->end_date) }}</td>
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
                                    <div class="sign_title">सदर गर्ने</div>
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
          $('#date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
            }


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
