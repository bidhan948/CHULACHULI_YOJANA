@section('title', $work_order->Program->name . ' को विवरण')
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
                        <a href="{{ route('work_order.index',$work_order->plan_id) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-1 bg-primary text-center p-2">
                            {{ __('कार्यक्रम दर्ता नं : ' . Nepali($work_order->plan_id)) . ' ||' . ' कर्यादेस नं ' . Nepali($work_order->work_order_no) }}
                        </p>
                        <p class="mb-0 bg-primary text-center p-2">
                            <span>{{ __('कार्यक्रमको विनियोजित बजेट रु : ') . Nepali($work_order->program->grant_amount) }}</span>
                            <br>
                            <span
                                class="mt-1">{{ __('कार्यक्रमको बाँकी रकम : ') . Nepali($work_order->program->grant_amount - $program->work_order_sum) }}</span>
                            <br>
                        </p>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('work_order.update', $work_order) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" name="program_id" value="{{ $work_order->plan_id }}">
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
                                                name="name" id="name" required value="{{ $work_order->name }}">
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
                                                value="{{ $work_order->decision_date_nep }}" readonly>
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
                                                value="{{ $work_order->municipality_amount }}">
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
                                                value="{{ $work_order->cost_sharing_name }}">
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
                                                value="{{ $work_order->cost_sharing }}">
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
                                                name="date_nep" id="date_nep" required
                                                value="{{ $work_order->date_nep }}" readonly>
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
                                                value="{{ $work_order->cost_participation }}">
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
                                                    <option value="{{ $list_registration->id }}"
                                                        {{ $work_order->listRegistrationAttribute->list_registration_id == $list_registration->id ? 'selected' : '' }}>
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
                                                value="{{ $work_order->work_order_budget }}" readonly>
                                            @error('work_order_budget')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('कार्यादेश दिईएको रकम रु फिल्ड अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" id="sub-registration">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('कार्यक्रमको संचालन गर्नेको नाम') }}
                                                    <span class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <select name="list_registration_attribute_id" id="list_registration_attribute_id"
                                                class="form-control form-control-sm @error('list_registration_attribute_id') is-invalid @enderror"
                                                required>
                                                <option value="{{ $work_order->listRegistrationAttribute->id }}">
                                                    {{ $work_order->listRegistrationAttribute->name }}</option>
                                            </select>
                                            @error('list_registration_attribute_id')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('कार्यक्रमको संचालन गर्नेको नाम अनिवार्य छ') }}
                                                </p>
                                            @enderror
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
                                                value="{{ $work_order->program_start_date_nep }}" readonly>
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
                                                value="{{ $work_order->program_end_date_nep }}" readonly>
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
                                                value="{{ $work_order->venue }}">
                                            @error('venue')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('कार्यक्रम संचालन हुने स्थान अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" id="staff">
                                    @foreach ($work_order->workOrderDetail as $key => $workOrderDetail)
                                        <div class="row" id="remove_{{ $key + 1 }}">
                                            <div class="col-6">
                                                <div class="form-group mt-2">
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text">{{ config('constant.SITE_TYPE') }}{{ __('को तर्फबाट संझौता गर्नेको नाम') }}
                                                                <span id="tole_bikas_group"
                                                                    class="text-danger font-weight-bold px-1">*</span></span>
                                                        </div>
                                                        <select name="staff_id[]" id="staff_id_{{ $key + 1 }}"
                                                            class="form-control form-control-sm"
                                                            onchange="assignPost({{ $key + 1 }})" required>
                                                            <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                            @foreach ($staffs as $staff)
                                                                <option value="{{ $staff->user_id }}" {{$workOrderDetail->staff_id == $staff->user_id ? 'selected' : ''}}>
                                                                    {{ $staff->nep_name }}
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
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="post[]" readonly id="post_{{ $key + 1 }}" required value="{{getSettingValueById($workOrderDetail->post_id)->name}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="post_id[]" id="post_id_{{ $key + 1 }}" value="{{$workOrderDetail->post_id}}">
                                            <div class="col-2">
                                                @if ($key == 0)
                                                    <span>
                                                        <a class="btn btn-primary btn-sm mt-2" id="lastDiv"><i
                                                                class="fa-solid fa-plus"></i></a>
                                                    </span>
                                                @else
                                                    <span>
                                                        <a class="btn btn-danger btn-sm mt-2" onclick="removeLastDiv({{$key+1}})"><i class="fa-solid fa-xmark"></i></a>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
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
                                                        name="house_family_count"
                                                        value="{{ $work_order->house_family_count }}" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="text"
                                                        class="form-control form-control-sm number  calculate-total @error('female') is-invalid @enderror"
                                                        name="female" value="{{ $work_order->female }}" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="text"
                                                        class="form-control form-control-sm number calculate-total @error('male') is-invalid @enderror"
                                                        name="male" value="{{ $work_order->male }}" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control number form-control-sm"
                                                        name="total"
                                                        value="{{ $work_order->female + $work_order->male }}" id="total"
                                                        disabled>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary"
                                onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ? ')"
                                id="submit">{{ __('सेभ गर्नुहोस्') }}</button>
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
        let baki_amount = +{{ $program->grant_amount - $program->work_order_sum }};
        let index = +{{ $work_order->workOrderDetail->count() }};
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

            $("#municipality_amount").on("input", function() {
                municipality_amount = $("#municipality_amount").val();
                if (municipality_amount > baki_amount) {
                    alert('रकम बढी भयो |');
                    $("#submit").attr("disabled", true);
                } else {
                    $("#submit").removeAttr("disabled");
                }
            });

            $("#lastDiv").on("click", function() {
                if (index >= 3) {
                    alert('Maxmimum limit is 3..');
                } else {
                    index++;
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
                }
            });
        });

        function assignPost(params) {
            staff_id = $("#staff_id_" + params).val();
            if (staff_id == '') {
                alert('{{ config('constant.SITE_TYPE') }}को तर्फबाट संझौता गर्नेको नाम अनिवार्य छ |');
                $("#post_" + params).val('');
            } else {
                console.log(staff_id);
                axios.get("{{ route('api.getPostByStaffId') }}", {
                    params: {
                        staff_id: staff_id
                    }
                }).then(function(response) {
                    console.log("#post_" + params);
                    $("#post_" + params).val(response.data.post);
                    $("#post_id_" + params).val(response.data.post_id);
                }).catch(function(error) {
                    console.log(error);
                    alert("Something went wrong");
                });
            }
        }

        function removeLastDiv(params) {
            $("#remove_" + params).remove();
            index--;
        }
    </script>
@endsection
