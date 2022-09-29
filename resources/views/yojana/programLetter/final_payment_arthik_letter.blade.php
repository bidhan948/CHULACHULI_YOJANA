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
                    <form action="{{ route('print.program.letter.printProgramFinalPaymentArthikLetter') }}" method="get" target="_blank">
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
                            <div class="letter_subject">विषय:- रकम भुक्तानी सम्बन्धमा ।</div>
                            <div class="letter_body">
                                <p class="letter_greeting">श्री आर्थिक प्रशासन शाखा,
                                </p>
                                <p class="letter_text my-2">
                                    यस कार्यालयको स्वीकृत बार्षिक कार्यक्रम अनुसार देहायको कार्यक्रम 
                                    संचालन गर्न श्री {{$work_order->listRegistrationAttribute->name}}लाई मिति {{Nepali($work_order->decision_date_nep)}} मा कार्यदेश
                                    दिईएकोमा तोकिएको समय भित्रै काम सम्पन गरि भुक्तानी माग भएकोले
                                    तपशिल बमोजिम भुक्तानी दिन हुन अनुरोध छ ।
                                </p>
                                <p class="text-center font-weight-bold">{{ __('तपशिल') }}</p>
                                <table class="letter_table table table-bordered">
                                    <tr>
                                        <td>आर्थिक बर्ष :</td>
                                        <td style="font-weight: lighter;">{{ Nepali(getCurrentFiscalYear()) }}</td>
                                    </tr>
                                    <tr>
                                        <td>कार्यादेश नं :</td>
                                        <td style="font-weight: lighter;">{{ Nepali($work_order->work_order_no) }}</td>
                                    </tr>
                                    <tr>
                                        <td>बिनियोजन श्रोत र व्याख्या :</td>
                                        <td style="font-weight: lighter;">{{ $program->detail }}</td>
                                    </tr>
                                    <!--<tr>-->
                                    <!--    <td>बैंक :</td>-->
                                    <!--    <td style="font-weight: lighter;">-->
                                    <!--        <select name="bank_id" class="form-control-sm form-control" required>-->
                                    <!--        	@foreach($banks as $bank)-->
                                    <!--        	    <option value="{{$bank->id}}">{{$bank->name}}</option>-->
                                    <!--        	@endforeach-->
                                    <!--        </select>-->
                                    <!--    </td>-->
                                    <!--</tr>-->
                                    <!--<tr>-->
                                    <!--    <td>चा हिसाब न० :</td>-->
                                    <!--    <td style="font-weight: lighter;">-->
                                    <!--        <input class="form-control form-control-sm" name="acc_no" required>-->
                                    <!--    </td>-->
                                    <!--</tr>-->
                                    <tr>
                                        <td>कार्यक्रमको नाम :</td>
                                        <td style="font-weight: lighter;">
                                        	{{$program->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>भुक्तानी पाउनेको नाम:</td>
                                        <td style="font-weight: lighter;">
                                        	{{$work_order->listRegistrationAttribute->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('constant.SITE_TYPE') }}बाट अनुदान:</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($work_order->municipality_amount)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>लागत सहभागिता :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($work_order->cost_participation)}}
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>कार्यादेश दिईएको रकम:</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($work_order->work_order_budget)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>पेश्की भुक्तानी लगेको कट्टी रकम:</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->program_advance)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>मुल्यांकन / बिल रकम :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->bill_amount)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>मु.अ कर :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->mu_tax)}}
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>बहाल कर :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->b_tax)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>जम्मा कट्टी रकम :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->total_katti_amount)}}	
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>भुक्तानी दिनु पर्ने खुद रकम :</td>
                                        <td style="font-weight: lighter;">
                                        	{{NepaliAmount($final_payment->net_total_amount)}}
                                        </td>
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
