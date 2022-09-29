@section('title', $program->name . ' को विवरण')
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
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">{{ __('कार्यक्रम संचालन विवरण ') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('program-operate.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-0 bg-primary text-center p-2">
                            <span>{{ __('कार्यक्रमको विनियोजित बजेट रु : ') . Nepali($program->grant_amount) }}</span>
                            <br>
                            <span
                                class="mt-1">{{ __('कार्यक्रमको बाँकी रकम : ') . Nepali($program->grant_amount - $program->work_order_sum)  }}</span>
                            <br>
                        </p>
                        {{-- karyakram bibaran accordion --}}
                        <div class="accordion" id="yojana">
                            <div class="card">
                                <div class="card-header bg-primary mt-1 mb-0 p-0" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-center text-white" type="button"
                                            data-toggle="collapse" data-target="#program_bibaran" aria-expanded="true"
                                            aria-controls="program_bibaran">
                                            {{ __('कार्यक्रमको बिबरण') }}
                                        </button>
                                    </h2>
                                </div>

                                <div id="program_bibaran" class="collapse " aria-labelledby="headingOne"
                                    data-parent="#yojana">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row mx-2">
                                                <div class="col-4">
                                                    <span>{{ __('दर्ता नं :') }}</span> <span
                                                        class="font-weight-bold">{{ Nepali($program->reg_no) }}</span>
                                                    <br>
                                                    <span class="py-2">{{ __('कार्यक्रमको नाम :') }}</span>
                                                    <span class="font-weight-bold py-2">{{ $program->name }}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>{{ __('कार्यक्रमको क्षेत्रको नाम :') }}</span> <span
                                                        class="font-weight-bold">{{ getSettingValueById($program->topic_id)->name }}</span>
                                                    <br>
                                                    <span>{{ __('कार्यक्रमको उपक्षेत्रको नाम :') }}</span> <span
                                                        class="font-weight-bold">{{ getSettingValueById($program->topic_area_type_id)->name }}</span>
                                                    <br>
                                                </div>
                                                <div class="col-4">
                                                    <span>{{ __('कार्यक्रमको विनियोजन किसिम  :') }}</span> <span
                                                        class="font-weight-bold">{{ getSettingValueById($program->type_of_allocation_id)->name }}</span>
                                                    <br>
                                                    <span>{{ __('योजना सचालन हुने स्थान :') }}</span> <span
                                                        class="font-weight-bold">{{ config('constant.SITE_NAME') }}</span>
                                                    <br>
                                                    <span>{{ __('अनुदान रकम :') }}</span> <span
                                                        class="font-weight-bold"><span
                                                            class="px-1">रु</span>{{ NepaliAmount($program->grant_amount) }}</span>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end of karyakram bibaran accordion --}}
                        @include('yojana.program.program_execution.workorder_accordion')
                        
                        <p class="bg-primary text-center p-2">
                            {{ __('कार्यक्रम दर्ता नं : ' . Nepali($regNo)) . ' ||' . ' कर्यादेस नं ' . Nepali($program->workOrder->count() + 1) }}
                        </p>
                        <form method="POST" action="{{route('work_order.store')}}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="program_id" value="{{ $program->id }}">
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('कार्यदेशको नाम') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('name') is-invalid @enderror"
                                                name="name" id="name" required value="{{ old('name') }}">
                                            @error('name')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('कार्यदेशको नाम अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text">{{ __('कार्यादेश दिने निर्णय भएको मिति') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('decision_date_nep') is-invalid @enderror my-date"
                                                name="decision_date_nep" id="decision_date_nep" required
                                                value="{{ old('decision_date_nep') }}" readonly>
                                            @error('decision_date_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('कार्यादेश दिने निर्णय भएको मिति अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ config('constant.SITE_TYPE') }}{{ __('बाट') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('municipality_amount') is-invalid @enderror amount sub_work_ordrer_budget"
                                                name="municipality_amount" id="municipality_amount" required
                                                value="{{ old('municipality_amount') ?? 0 }}">
                                            @error('municipality_amount')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ config('constant.SITE_TYPE') }}{{ __('बाट फिल्ड अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('नगद साझेदारी नाम/संस्था') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('cost_sharing_name') is-invalid @enderror"
                                                name="cost_sharing_name" required
                                                value="{{ old('cost_sharing_name')  }}">
                                            @error('cost_sharing_name')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('नगद साझेदारी नाम/संस्था फिल्ड अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('नगद साझेदारी') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('cost_sharing') is-invalid @enderror amount sub_work_ordrer_budget"
                                                name="cost_sharing" id="cost_sharing" required
                                                value="{{ old('cost_sharing') ?? 0 }}">
                                            @error('cost_sharing_name')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('नगद साझेदारी फिल्ड अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('सम्झौता मिति') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('date_nep') is-invalid @enderror my-date"
                                                name="date_nep" id="date_nep" required value="{{ old('date_nep') }}"
                                                readonly>
                                            @error('date_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('कार्यक्रम सम्पन्न हुने मिति अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('लागत सहभागिता') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('cost_participation') is-invalid @enderror amount sub_work_ordrer_budget"
                                                name="cost_participation" id="cost_participation" required
                                                value="{{ old('cost_participation') ?? 0 }}">
                                            @error('cost_participation')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('लागत सहभागिता फिल्ड अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('कार्यक्रमको संचालन गर्ने') }}
                                                    <span class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <select name="list_registration_id" id="list_registration_id"
                                                class="form-control form-control-sm @error('list_registration_id') is-invalid @enderror"
                                                required>
                                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                @foreach ($list_registrations as $list_registration)
                                                    <option value="{{ $list_registration->id }}">
                                                        {{ $list_registration->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('program_end_date_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('कार्यक्रम सम्पन्न हुने मिति अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('कार्यादेश दिईएको रकम रु') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('work_order_budget') is-invalid @enderror amount"
                                                name="work_order_budget" id="work_order_budget" required
                                                value="{{ old('work_order_budget') ?? 0 }}" readonly>
                                            @error('work_order_budget')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('कार्यादेश दिईएको रकम रु फिल्ड अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 sub_registration" id="sub-registration">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('कार्यक्रमको संचालन गर्ने') }}
                                                    <span class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <select name="list_registration_id" id="list_registration_id"
                                                class="form-control form-control-sm @error('list_registration_id') is-invalid @enderror"
                                                required>
                                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('कार्यक्रम शुरु हुने मिति') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('program_start_date_nep') is-invalid @enderror my-date"
                                                name="program_start_date_nep" id="program_start_date_nep" required
                                                value="{{ old('program_start_date_nep') }}" readonly>
                                            @error('program_start_date_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('कार्यक्रम शुरु हुने मिति अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('कार्यक्रम सम्पन्न हुने मिति') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('program_end_date_nep') is-invalid @enderror my-date"
                                                name="program_end_date_nep" id="program_end_date_nep" required
                                                value="{{ old('program_end_date_nep') }}" readonly>
                                            @error('program_end_date_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('कार्यक्रम सम्पन्न हुने मिति अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('कार्यक्रम संचालन हुने स्थान') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm @error('venue') is-invalid @enderror"
                                                name="venue" id="venue" required
                                                value="{{ old('venue') }}">
                                            @error('venue')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('कार्यक्रम संचालन हुने स्थान अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" id="staff">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mt-2">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="input-group-text">{{ config('constant.SITE_TYPE') }}{{ __('को तर्फबाट संझौता गर्नेको नाम') }}
                                                            <span id="tole_bikas_group"
                                                                class="text-danger font-weight-bold px-1">*</span></span>
                                                    </div>
                                                    <select name="staff_id[]" id="staff_id_0"
                                                        class="form-control form-control-sm" onchange="assignPost(0)" required>
                                                        <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                        @foreach ($staffs as $staff)
                                                            <option value="{{ $staff->user_id }}">{{ $staff->nep_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('staff_id')
                                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                                            {{ config('constant.SITE_TYPE') }}{{ __('को तर्फबाट संझौता गर्नेको नाम अनिवार्य छ') }}
                                                        </p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group mt-2">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">{{ __('पद : ') }}
                                                            <span id="tole_bikas_group"
                                                                class="text-danger font-weight-bold px-1">*</span></span>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm" name="post[]"
                                                        readonly id="post_0" required>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="post_id[]" id="post_id_0">
                                        <div class="col-2">
                                            <span>
                                                <a class="btn btn-primary btn-sm mt-2" id="lastDiv"><i
                                                        class="fa-solid fa-plus"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <p class="mb-0 bg-dark text-center">
                                        {{ __('योजनाबाट लाभान्वित घरधुरी तथा परिबारको विबरण') }}
                                    </p>
                                    <table id="table1" width="100%" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="4" class="text-center">लाभान्वित जनसंख्या</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">{{ __('घर परिवार संख्या') }}</th>
                                                <th class="text-center">{{ __('महिला') }}</th>
                                                <th class="text-center">{{ __('पुरुष') }}</th>
                                                <th class="text-center">{{ __('जम्मा') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text"
                                                        class="form-control form-control-sm number @error('house_family_count') is-invalid @enderror"
                                                        name="house_family_count" value="{{ old('house_family_count') }}"
                                                        required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="text"
                                                        class="form-control form-control-sm number  calculate-total @error('female') is-invalid @enderror"
                                                        name="female" value="{{ old('female') }}" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="text"
                                                        class="form-control form-control-sm number calculate-total @error('male') is-invalid @enderror"
                                                        name="male" value="{{ old('male') }}" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control number form-control-sm"
                                                        name="total" value="{{ old('total') }}" id="total" disabled>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary"
                                onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ? ')" id="submit">{{ __('सेभ गर्नुहोस्') }}</button>
                        </form>
                    </div>
                </div>
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
        let baki_amount = +{{$program->grant_amount - $program->work_order_sum}};
        let index = 1;
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
            };
        }
        $(function() {
            $(".sub_registration").css('display', 'none');

            $(".sub_work_ordrer_budget").on('input', function() {
                work_order_budget = 0;
                $('.sub_work_ordrer_budget').each(function() {
                    work_order_budget += Number($(this).val()) || 0;
                });
                $("#work_order_budget").val(work_order_budget);
            });

            $("#list_registration_id").on("change", function() {
                list_registration_id = $("#list_registration_id").val();
                if (list_registration_id == '') {
                    alert('कार्यक्रमको संचालन गर्ने फिल्ड अनिवार्य छ');
                    $(".sub_registration").css('display', 'none');
                } else {
                    axios.get("{{ route('api.getSubListRegistration') }}", {
                        params: {
                            list_registration_id: list_registration_id
                        }
                    }).then(function(response) {
                        $(".sub_registration").css('display', '');
                        $("#sub-registration").html(response.data);
                    }).catch(function(error) {
                        console.log(error);
                        alert('Something went wrong');
                    })
                }
            });

            $('.calculate-total').on("input", function() {
                var total = 0;
                $('.calculate-total').each(function() {
                    total += Number($(this).val()) || 0;
                });
                $("#total").val(total);
            });

            $("#municipality_amount").on("input",function(){
                municipality_amount = $("#municipality_amount").val();
                if (municipality_amount > baki_amount) {
                    alert('रकम बढी भयो |');
                    $("#submit").attr("disabled",true);
                }else{
                    $("#submit").removeAttr("disabled");
                }
            });

            $("#lastDiv").on("click",function(){
                if (index >=3) {
                    alert('Maxmimum limit is 3..');
                }else{
                    html = '<div class="row" id="remove_'+index+'">'
                            +'<div class="col-6">'
                                +'<div class="form-group mt-2">'
                                    +'<div class="input-group input-group-sm">'
                                        +'<div class="input-group-prepend">'
                                            +'<span class="input-group-text">{{ config('constant.SITE_TYPE') }}{{ __("को तर्फबाट संझौता गर्नेको नाम") }}'
                                                +'<span id="tole_bikas_group" class="text-danger font-weight-bold px-1">*</span></span>'
                                        +'</div>'
                                        +'<select name="staff_id[]" id="staff_id_'+index+'"'
                                            +'class="form-control form-control-sm" onchange="assignPost('+index+')" required>'
                                            +'<option value="">{{ __("--छान्नुहोस्--") }}</option>'
                                            +'@foreach ($staffs as $staff)'
                                                +'<option value="{{ $staff->user_id }}">{{ $staff->nep_name }}'
                                                +'</option>'
                                            +'@endforeach'
                                        +'</select>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                            +'<div class="col-4">'
                                +'<div class="form-group mt-2">'
                                    +'<div class="input-group input-group-sm">'
                                        +'<div class="input-group-prepend">'
                                            +'<span class="input-group-text">{{ __("पद : ") }}'
                                                +'<span id="tole_bikas_group"'
                                                    +'class="text-danger font-weight-bold px-1">*</span></span>'
                                        +'</div>'
                                        +'<input type="text" class="form-control form-control-sm" name="post[]"'
                                            +'readonly id="post_'+index+'" required>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                            +'<input type="hidden" name="post_id[]" id="post_id_'+index+'">'
                            +'<div class="col-2">'
                                +'<span>'
                                    +'<a class="btn btn-danger btn-sm mt-2" onclick="removeLastDiv('+index+')"><i class="fa-solid fa-xmark"></i></a>'
                                +'</span>'
                            +'</div>'
                        +'</div>';
    
                        $("#staff").append(html);
                        index++;
                }
            });
        });

        function assignPost(params) {
            staff_id = $("#staff_id_" + params).val();
            if (staff_id == '') {
                alert('{{ config('constant.SITE_TYPE') }}को तर्फबाट संझौता गर्नेको नाम अनिवार्य छ |');
                $("#post_" + params + params).val('');
            } else {
                axios.get("{{ route('api.getPostByStaffId') }}", {
                    params: {
                        staff_id: staff_id
                    }
                }).then(function(response) {
                    $("#post_" + params).val(response.data.post);
                    $("#post_id_" + params).val(response.data.post_id);
                }).catch(function(error) {
                    console.log(error);
                    alert("Something went wrong");
                });
            }
        }

        function removeLastDiv(params) {
            $("#remove_"+params).remove();
            index--;
        }
    </script>
@endsection
