@section('title', $plan->name . ' को ठेक्का संचालन विवरण भर्नुहोस्')
@section('operate_plan', 'active')
@extends('layout.layout')
@section('sidebar')
    @include('layout.yojana_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">{{ __('ठेक्काको विवरण') }}</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('plan-operate.index') }}" class="btn btn-sm btn-primary"><i
                            class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('other-bibaran.store')}}">
                @csrf
                <div class="row">
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                    <input type="hidden" name="post[]" id="post_0" value="">
                    <div class="col-6">
                        <div class="form-group mt-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('योजनाको विनियोजित बजेट रु') }}
                                        <span id="tole_bikas_group" class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <input type="text"
                                    class="form-control form-control-sm"
                                    value="{{NepaliAmount($plan->grant_amount)}}" disabled required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mt-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('कार्यादेश दिने निर्णय भएको मिति') }}
                                        <span id="tole_bikas_group" class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <input type="text"
                                    class="form-control form-control-sm @error('work_order_date') is-invalid @enderror"
                                    name="work_order_date" id="work_order_date" required>
                                @error('work_order_date')
                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                        {{ 'कार्यादेश दिने निर्णय भएको मिति अनिवार्य छ' }}
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
                                        <span id="tole_bikas_group" class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <input type="text"
                                    class="form-control form-control-sm"
                                    name="work_order_budget" value="{{NepaliAmount($contract_kabol->total_kabol_amount)}}" disabled required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mt-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('योजना शुरु हुने मिति') }}
                                        <span id="tole_bikas_group" class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <input type="text"
                                    class="form-control form-control-sm @error('start_date') is-invalid @enderror"
                                    name="start_date" id="start_date" required>
                                @error('start_date')
                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                        {{ 'योजना शुरु हुने मिति अनिवार्य छ' }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mt-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('योजना सम्पन्न हुने मिति:') }}
                                        <span id="tole_bikas_group" class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <input type="text"
                                    class="form-control form-control-sm @error('end_date') is-invalid @enderror" name="end_date"
                                    id="end_date" required>
                                @error('end_date')
                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                        {{ 'योजना सम्पन्न हुने मिति अनिवार्य छ' }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="rowForAdd">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mt-2">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('गाउँपालिकाको तर्फबाट संझौता गर्नेको नाम:') }}
                                                <span class="text-danger font-weight-bold px-1">*</span></span>
                                        </div>
                                        <select name="staff_id[]" id="staff_id_0" onchange="assignPost(0)"
                                            class="form-control form-control-sm @error('staff_id') is-invalid @enderror"
                                            required>
                                            <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                            @foreach ($staffs as $staff)
                                                <option value="{{ $staff->user_id }}">
                                                    {{ $staff->nep_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('staff_id')
                                            <p class="invalid-feedback" style="font-size: 0.9rem">
                                                {{ config('TYPE.' . session('type_id')) . ' भेलामा उपस्थिति संख्या अनिवार्य छ' }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mt-2">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('पद:') }}
                                                <span class="text-danger font-weight-bold px-1">*</span></span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="post_id_0"
                                            name="post_id[]" readonly required>
                                        @error('post_id')
                                            <p class="invalid-feedback" style="font-size: 0.9rem">
                                                {{ 'पद अनिवार्य छ' }}
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
                                            class="form-control my-date form-control-sm number @error('date') is-invalid @enderror"
                                            name="agreement_date_nep" id="date" required>
                                        @error('date')
                                            <p class="invalid-feedback" style="font-size: 0.9rem">
                                                {{ 'सम्झौता मिति अनिवार्य छ' }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mt-2">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('योजना संचालन हुने स्थान :') }}
                                                <span id="tole_bikas_group"
                                                    class="text-danger font-weight-bold px-1">*</span></span>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm @error('venue') is-invalid @enderror"
                                            name="venue" required>
                                        @error('venue')
                                            <p class="invalid-feedback" style="font-size: 0.9rem">
                                                {{ 'योजना संचालन हुने स्थान :' }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-2">
                                <a class="btn btn-sm btn-primary" id="add"><i class="fa-solid fa-plus px-1"></i></a>
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
                                            name="house_family_count" value="{{ old('house_family_count') }}">
                                    </td>
                                    <td class="text-center">
                                        <input type="text"
                                            class="form-control form-control-sm number  calculate-total @error('female') is-invalid @enderror"
                                            name="female" value="{{ old('female') }}">
                                    </td>
                                    <td class="text-center">
                                        <input type="text"
                                            class="form-control form-control-sm number calculate-total @error('male') is-invalid @enderror"
                                            name="male" value="{{ old('male') }}">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control number form-control-sm" name="total"
                                            value="{{ old('total') }}" id="total" disabled>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary"
                    onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ? ')">{{ __('सेभ गर्नुहोस्') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>
    <script>
        window.onload = function() {
            var work_order_date = document.getElementById("work_order_date");
            var startDate = document.getElementById("start_date");
            var endDate = document.getElementById("end_date");
            var date = document.getElementById("date");
            work_order_date.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100
            });
            startDate.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100
            });
            endDate.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100
            });
            date.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100
            });
        }
        let i = 1;
        let html = '';
        $(function() {
            $('.calculate-total').on("input", function() {
                var total = 0;
                $('.calculate-total').each(function() {
                    total += Number($(this).val()) || 0;
                });
                $("#total").val(total);
            });
            $("#add").on("click", function() {
                    if (i < 3) {
                        html = '<div class="row" id="remove_'+i+'">'
                                +'<input name="post[]" id="post_'+i+'" type="hidden">'
                                +'<div class="col-6">'
                                    +'<div class="form-group mt-2">'
                                        +'<div class="input-group input-group-sm">'
                                            +'<div class="input-group-prepend">'
                                                +'<span class="input-group-text">{{ __("गाउँपालिकाको तर्फबाट संझौता गर्नेको नाम:") }}'
                                                    +'<span class="text-danger font-weight-bold px-1">*</span></span>'
                                            +'</div>'
                                            +'<select name="staff_id[]" id="staff_id_'+i+'" onchange="assignPost('+i+')" class="form-control form-control-sm ">'
                                                +'<option value="">{{ __("--छान्नुहोस्--") }}</option>'
                                                +'@foreach ($staffs as $staff)'
                                                   +'<option value="{{ $staff->user_id }}">'
                                                        +'{{ $staff->nep_name }}'
                                                    +'</option>'
                                                +'@endforeach'
                                            +'</select>'
                                        +'</div>'
                                        +'</div>'
                                        +'</div>'
                                +'<div class="col-5">'
                                    +'<div class="form-group mt-2">'
                                        +'<div class="input-group input-group-sm">'
                                            +'<div class="input-group-prepend">'
                                                +'<span class="input-group-text">{{ __("पद:") }}'
                                                    +'<span id="staff_id"'
                                                        +'class="text-danger font-weight-bold px-1">*</span></span>'
                                            +'</div>'
                                            +'<input type="text"'
                                                +'class="form-control form-control-sm"'
                                                +'id="post_id_'+i+'" name="" readonly>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                                +'<div class="col-1 mt-2">'
                                    +'<a class="btn btn-sm btn-danger" onclick="removeRow('+i+')"><i class="fa-solid fa-circle-xmark"></i></a>'
                                +'</div>'
                            +'</div>'
                            +'</div>';
                                $("#rowForAdd").append(html);
                                i++;
                    }else{
                        alert('Maximum limit is 3');
                    }
                });
        });
    
        function removeRow(row) {
            $("#remove_" + row).remove();
            i--;
        }
    
        function assignPost(staffRow) {
            var staff_id = $("#staff_id_" + staffRow).val();
            if (staff_id == '') {
                alert('गाउँपालिकाको तर्फबाट संझौता गर्नेको नाम: खाली छ');
                $("#post_id_" + staffRow).val('');
            } else {
                axios.get("{{ route('api.getPostByStaffId') }}", {
                        params: {
                            staff_id: staff_id
                        }
                    }).then(function(response) {
                        $("#post_" + staffRow).val(response.data.post_id);
                        $("#post_id_" + staffRow).val(response.data.post);
                    })
                    .catch(function(error) {
                        console.log(error);
                        alert("Something went wrong");
                    });
            }
        }  
    </script>