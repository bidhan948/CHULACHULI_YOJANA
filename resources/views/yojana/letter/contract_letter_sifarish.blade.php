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
                    <form action="{{ route('plan.letter.printContractSifarishLetter') }}" method="get" target="_blank">
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
                            
                            <div class="letter_subject">विषय:-  सम्झौता गरिदिने बारे ।</div>
                            <div class="letter_body">
                                
                            <div class="letter_body">
                                
                                <p class="letter_greeting">श्री,{{config('constant.SITE_NAME') }}</p>
                                 <span id="bank_address">
                                  {{config('constant.SITE_DISTRICT')}}, {{config('constant.FULL_ADDRESS')}}
                                </span> <br> <br>
                                <p class="letter_text">
                                           उपरोक्त बिषयमा {{$type->typeable->name}}ले यस कार्यालयमा दिएको निबेदन अनुसार {{$plan->name}} योजना संचालनका लागि मिति {{Nepali($plan->otherBibaran->formation_start_date)}} मा {{ config('TYPE.' . session('type_id')) }}को भेलाबाट देहाय बमोजिमको  {{ config('TYPE.' . session('type_id')) }} र अनुगमन समिति गठन भएकाले नियम अनुसार योजना संझौता गरिदिनहुन अनुरोध छ ।


                                </p>

                                {{-- type table --}}
                                <p class="text-center my-3 font-weight-bold">
                                    {{ config('TYPE.' . session('type_id')) . __(' सम्बन्धी विवरण') }}</p>
                                <table class=" table table-bordered">
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
                                <p class="text-center my-3 font-weight-bold">
                                    {{ __('अनुगमन समिति सम्बन्धी विवरण') }}</p>
                                <table class="table table-bordered">
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
