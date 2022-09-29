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
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="letter_wrap">
                    <form action="{{ route('plan.letter.printExtensionLetter') }}" method="get" target="_blank">
                        <input name="plan_id" value="{{ $plan->id }}" type="hidden">
                        <input name="add_deadline_id" value="{{ $add_deadline->id }}" type="hidden">
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
                            <div class="letter_subject">विषय:- म्याद थप सम्बन्धमा |</div>
                            <div class="letter_body">
                                <p class="letter_greeting">श्री
                                    {{ $type->typeable->name . ' ज्यु' }}
                                    ,</p>
                                @if (config('TYPE.AMANAT_MARFAT') != session('type_id'))
                                    <p class="letter_greeting">
                                        {{ config('constant.SITE_NAME') }},{{ config('constant.SITE_DISTRICT') }}</p>
                                @else
                                    <p class="letter_greeting">
                                        {{ $type->typeable->address }}</p>
                                @endif
                                <p class="letter_text my-2">
                                    यस कार्यालयको स्वीकृत बार्षिक कार्यक्रम अनुसार {{ config('constant.SITE_NAME') }} वडा
                                    नं. {{ Nepali($plan->planWardDetails->implode('ward_no', ',')) }}मा
                                    {{ $plan->name }} योजना स्वीकृत भइ मिती
                                    {{ Nepali($plan->otherBibaran->agreement_date_nep) }} मा यस
                                    {{ config('constant.SITE_TYPE') }} सँग
                                    भएको संझौता अनुसार उक्त योजना मिति {{ Nepali($plan->otherBibaran->start_date) }} देखी
                                    काम सुरु गरी मिती {{ Nepali($plan->otherBibaran->end_date) }} भित्रमा
                                    काम सम्पन्न गर्ने गरी योजनाको कार्यदेश दिइएकोमा
                                    {{ config('TYPE.' . session('type_id')) }}ले मिति
                                    {{ Nepali($add_deadline->consumer_date_nep) }} मा यस
                                    कार्यालयमा {{ Nepali($add_deadline->remark) }} कारणले तोकिएको समयमा योजना सम्पन्न गर्न
                                    नसकिएको भनि म्याद थपका
                                    लागी निबेदन दिएकाले यस कार्यालयको निर्णय अनुसार
                                    {{ convertNumberToNepaliWord($add_deadline->period) }}पटक मिति
                                    {{ Nepali($add_deadline->period_add_date_nep) }} सम्मका लागी
                                    योजना संचालनको म्याद थप गरिएको जानकारी गराइन्छ ।
                                </p>
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
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>
    <script>
        window.onload = function() {
            var date_fields = document.getElementsByClassName("my-date");
            for (let index = 0; index < date_fields.length; index++) {
                const element = date_fields[index];
                element.nepaliDatePicker({
                    readOnlyInput: true,
                    ndpTriggerButton: false,
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10
                });
            }
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
