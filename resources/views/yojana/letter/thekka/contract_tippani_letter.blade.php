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
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
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
                    <form action="{{ route('print.plan.letter.thekka.contract',$reg_no) }}" method="get" target="_blank">
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
                                    <input id="date" class=" form-control form-control-sm" name="date_nep" required />
                                </div>
                            </div>
                            <div class="letter_subject">विषय:- ठेक्का सम्झौता गर्ने सम्बन्धमा |</div>
                            <div class="letter_body">
                                <p class="letter_greeting">श्रीमान,</p>
                                <p class="letter_text">
                                    यस कार्यालयको आ.ब {{ Nepali(getCurrentFiscalYear()) }} को बार्षिक कार्यक्रम अनुसार
                                    {{ $plan->name }} योजना ठेक्का मार्फत संचालन गर्ने गरी मिति
                                    {{ Nepali($plan->contracts->prakashit_date) }} मा सुचना
                                    प्रकाशन गरिएकोमा
                                    उक्त योजना ठेक्का मार्फत संचालन गर्न तपशिल बमोजिमका फर्म/कम्पनी,निर्माण व्यवसायीले
                                    ठेक्काको बोलपत्र पेश
                                    भएको।
                                </p>
                                <table class="table table-bordered mt-2">
                                    <tr>
                                        <th class="text-center">सि.नं</th>
                                        <th class="text-center">फर्म/कम्पनीको नाम</th>
                                        <th class="text-center">ठेगाना</th>
                                        <th class="text-center">कबोल रु अंकमा (भ्याट बाहेक)</th>
                                        <th class="text-center">कबोल रु अंकमा (भ्याट सहित)</th>
                                        <th class="text-center">कबोल रु अक्षरमा (भ्याट सहित)</th>
                                        <th class="text-center">कैफियत</th>
                                    </tr>
                                    @foreach ($contract_kabols as $key => $contract_kabol)
                                        <tr>
                                            <td class="text-center">{{ Nepali($key + 1) }}</td>
                                            <td class="text-center">
                                                {{ Nepali($contract_kabol->listRegistrationAttribute->name) }}</td>
                                            <td class="text-center">
                                                {{ Nepali($contract_kabol->listRegistrationAttribute->address) }}</td>
                                            <td class="text-center">
                                                {{ NepaliAmount($contract_kabol->has_vat == 1 ? getPreciseFloat($contract_kabol->total_kabol_amount / 1.13, 2) : $contract_kabol->total_kabol_amount) }}
                                            </td>
                                            <td class="text-center">
                                                {{ NepaliAmount($contract_kabol->total_amount) }}
                                            </td>
                                            @php
                                                $budget_aray = explode('.', $contract_kabol->total_amount);
                                            @endphp
                                            <td class="text-center">{{ 'रु ' . convert($budget_aray[0]) }}</td>
                                            <td class="text-center">{{ $contract_kabol->remark }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <p class="mt-2">
                                    माथि उल्लेखित फर्म/कम्पनीहरुबाट प्राप्त बोलपत्र प्रस्ताब मध्ये सबै भन्दा घटी कबोल गर्ने
                                    श्री {{$contract_kabol_single->listRegistrationAttribute->name}} को रित पुर्बकको कबोल अंक सबै भन्दा घटी रकम ( भ्याट सहित ) रु
                                    {{NepaliAmount($contract_kabol_single->total_amount)}} 
                                    @php
                                        $budget_single = explode('.',$contract_kabol_single->total_amount)
                                    @endphp
                                    अक्षरुपी {{convert($budget_single[0])}} मात्र भएकाले सार्बजनिक खरिद ऐन २०६३ को नियम २५ बमोजिम निज
                                    सँग ठेक्का संझौताको लागी निर्णयार्थ यो टिप्पणी पेश गरेको छु ।
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
                                <div class="letter_sign">
                                    <div class="sign_title">सिफारिस गर्ने</div>
                                    <select name="sifaris" id="sifaris" onchange="assignPost('sifaris')">
                                        <option value="">-- छानुहोस --</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->user_id }}">{{ $staff->nep_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="sifaris_post"></div>
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
