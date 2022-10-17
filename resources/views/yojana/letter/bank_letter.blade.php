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
                    <form action="{{ route('plan.letter.printBank') }}" method="get" target="_blank">
                        <input name="plan_id" value="{{ $plan->id }}" type="hidden" required>
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
                                    <input id="date" class="form-control form-control-sm" name="date_nep" required />
                                </div>
                            </div>
                            <div class="letter_subject">विषय:- बैंक खाता संचालन सम्बन्धमा ।</div>
                            <div class="letter_body">
                                <p class="letter_greeting">श्री, <select name="bank_id" id="bank_id"
                                        class="form-control @error('bank_id') is-invalid @enderror form-control-sm" required>
                                        <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endforeach
                                    </select></p>
                                <span id="bank_address"> </span> <br>
                                <p class="letter_text">
                                    उपरोक्त विषयमा यस {{ config('constant.SITE_NAME') }}
                                    र {{ $type->typeable->name ?? '' }} विच
                                    मिति {{ Nepali($plan->otherBibaran->agreement_date_nep) }} मा  {{ $plan->name }}
                                    योजना संचालन गर्ने
                                    भनि सम्झौता भएकोमा उक्त्त योजना संचालन गर्न
                                    {{ config('TYPE.' . session('type_id')) }}को
                                    नाममा बैंक खाता आवश्यक भएकाले {{ config('TYPE.' . session('type_id')) }}का
                                    @if ($adakshya_name != null)
                                        अध्यक्ष {{ $adakshya_name->name }} {{ count($post) == 1 ? '' : ',' }}
                                    @endif
                                    @if ($sachib_name != null)
                                        सचिब
                                        {{ $sachib_name->name }} र
                                    @endif
                                    @if ($kosadakshya_name != null)
                                        कोषाध्यक्ष {{ $kosadakshya_name->name }}
                                    @endif
                                    को संयुक्त दस्तखतबाट संचालन हुने गरी चल्ती खाता खोली
                                    दिनहुन अनुरोध छ ।
                                </p>
                            </div>
                            <div class="letter_footer" style="justify-content: flex-end;">
                                <!-- Sign Item  -->
                                <div class="letter_sign">
                                    <!--<div class="sign_title">सदर गर्ने</div>-->
                                    <select name="approve" id="approve" class="@error('bank_id') is-invalid @enderror" onchange="assignPost('approve')" required>
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
        $("#bank_id").on("change", function() {
            bank_id = $("#bank_id").val();
            if (bank_id == '') {
                alert("बैंक छान्नुहोस्")
                $("#bank_address").text("");
                $(".letter").css("display", "none");
            } else {
                axios.get("{{ route('api.getBankName') }}", {
                        params: {
                            bankId: bank_id
                        }
                    }).then(function(response) {
                        $("#bank_name").text(response.data.name);
                        $("#bank_address").text(response.data.address);
                        $(".letter").css("display", "");
                    })
                    .catch(function(error) {
                        alert("Something went wrong");
                    });
            }
        });
    </script>
@endsection
