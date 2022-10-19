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
                    <form action="{{ route('plan.print.letter.advance_payment_letter') }}" method="get" target="_blank">
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
                                    'letter_title' => 'टिप्पणी आदेश',
                                ])

                                <div class="letter_date">
                                    <span> मिति </span>
                                    <input class="form-control form-control-sm" id="date" name="date_nep" required />
                                </div>
                            </div>
                            <div class="letter_subject">विषय:- योजना संझौता गरी पेश्की उपलब्ध गराउने सम्बन्धमा ।</div>
                            <div class="letter_body">
                                <p class="letter_greeting">श्रीमान,</p>
                                <p class="letter_text">
                                    @if (session('type_id') != config('TYPE.CONTRACT_MARFAT'))
                                        यस कार्यालयको स्वीकृत बार्षिक कार्यक्रम अनुसार {{ config('constant.SITE_NAME') }}
                                        वडा
                                        नं. {{ Nepali($plan->planWardDetails->implode('ward_no', ',')) }} मा
                                        {{ $plan->name }} स्वीकृत भइ उक्त योजनामा प्राबिधिकबाट रु
                                        {{ NepaliAmount($plan->kulLagat->total_investment) }}
                                        बराबरको लागत ईस्टमेट पेश भइ स्वीकृत भएकोमा
                                        @if (config('TYPE.UPABHOKTA_SAMITI') == session('type_id') ||
                                            config('TYPE.tole-bikas-samiti') == session('type_id'))
                                            मिति
                                            {{ Nepali($plan->otherBibaran->formation_start_date) }} मा
                                            {{ config('TYPE.' . session('type_id')) }} ({{ $type->typeable->name }}) गठन
                                            भइ
                                            समितिको तर्फबाट बैठकको निर्णय प्रतिलिपी,निबेदन लगायत अन्य कागज पत्र सहित
                                        @else
                                            {{ config('TYPE.' . session('type_id')) }} ({{ $type->typeable->name }})द्वारा
                                        @endif
                                        योजना संझौताका
                                        लागी माग भई आएकाले योजनाको कुल लागत रु
                                        {{ NepaliAmount($plan->kulLagat->total_investment) }} मा
                                        {{ config('constant.SITE_TYPE') }}बाट अनुदान रु
                                        {{ NepaliAmount($plan->grant_amount) }} तथा
                                        अन्य निकाय({{ $plan->kulLagat->other_office_con_name }})बाट अनुदान रु
                                        {{ NepaliAmount($plan->KulLagat->other_office_con) }} र
                                        {{ config('TYPE.' . session('type_id')) }}बाट नगद साझेदारी रु
                                        {{ NepaliAmount($plan->kulLagat->customer_agreement) }} तथा अन्य साझेदारी
                                        ({{ $plan->kulLagat->other_contingency_con_name }}) रु
                                        {{ NepaliAmount($plan->kulLagat->other_office_agreement) }}
                                        र
                                        {{ config('TYPE.' . session('type_id')) }}बाट जनश्रमदान रु
                                        {{ NepaliAmount($plan->kulLagat->consumer_budget) }} भएकोमा मिति
                                        {{ Nepali($plan->otherBibaran->start_date) }} देखी काम
                                        सुरु गरी मिति {{ Nepali($plan->otherBibaran->end_date) }}
                                        भित्रमा योजनाको काम सम्पन्न गर्नेगरी यस कार्यालयको निर्णय अनुसार मिति
                                        {{ Nepali($advance->advance_paid_date_nep) }} भित्रमा
                                        पेश्की फर्छयौट गर्ने गरी उक्त योजना संचालनका लागी माथी उल्लेखित
                                        {{ config('TYPE.' . session('type_id')) }}सँग
                                        सम्झौता गरी रु {{ NepaliAmount($advance->peski_amount) }} पेश्की उपलब्ध गराइ
                                        योजनाको
                                        कार्यदेश दिनका लागी श्रीमान समक्ष यो
                                        टिप्पणी पेश गरको छु । श्रीमानको जो आदेश ।
                                    @else
                                        यस कार्यालयको स्वीकृत बार्षिक कार्यक्रम अनुसार देहायको योजना संचालन गर्न पेश्की पाउँ
                                        भनि
                                        {{ $contract_kabol->listRegistrationAttribute->name }}ले यस कार्यलयमा दिएको निबेदन
                                        अनुसार मिति {{ Nepali($advance->advance_paid_date_nep) }} भित्रमा पेश्की फर्छयौट
                                        गर्ने गरी रु {{ NepaliAmount($advance->peski_amount) }} पेश्की उपलब्ध गराई दिनुहुन
                                        श्रीमान समक्ष यो
                                        टिप्पणी पेश गरको छु । श्रीमानको जो आदेश ।
                                        <p class="mt-3 text-center font-weight-bold"
                                            style="text-align: center; !important;">
                                            {{ __('तपशिल') }}</p>
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
                                                <td>{{ $contract_kabol->listRegistrationAttribute->listRegistration->name }}को
                                                    नाम :</td>
                                                <td>{{ $contract_kabol->listRegistrationAttribute->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>ठेगाना :</td>
                                                <td>
                                                    {{ Nepali($contract_kabol->listRegistrationAttribute->address) }}
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
                                                <td>कार्यादेश दिएको रकम रु :</td>
                                                <td>{{ NepaliAmount($contract_kabol->total_amount) }}</td>
                                            </tr>
                                            <tr>
                                                <td>पेश्की दिएको रकम रु :</td>
                                                <td>{{ NepaliAmount($advance->peski_amount) }}</td>
                                            </tr>
                                            <tr>
                                                <td>योजना संचालन हुने स्थान :</td>
                                                <td>{{ NepaliAmount($plan->otherBibaran->venue) }}</td>
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
                                    @endif
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
