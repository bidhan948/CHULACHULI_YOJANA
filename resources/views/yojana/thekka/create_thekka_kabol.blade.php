@section('title', $plan->name . ' को ठेक्का खोलिएकोफारम')
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
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>ठेक्का कबोल फारम</h3>
        </div>
        <form action="{{ route('thekka-kabol-submit') }}" method="post">
            @csrf
            <div class="card-body">
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                <table class="table-responsive table">
                    <thead>
                        <tr>
                            <th scope="col">सी.न.</th>
                            <th scope="col">निर्माण व्यवसायीको नाम</th>
                            <th scope="col">प्रकार छान्नुहोस्</th>
                            <th scope="col">ठेक्का कबोल गरेको कुल रकम </th>
                            <th scope="col">कुल रकम</th>
                            <th scope="col">कैफियत</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contract_open as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    <input type="text" value="{{ $item->name }}" name="contractor_name[]">
                                    <input type="hidden" value="{{ $item->list_registration_attribute_id }}"
                                        name="list_registration_attribute_id[]">
                                </td>
                                <td>
                                    <select class="form-select" id="has_vat_{{$key}}" name="has_vat[]" aria-label="Disabled select example"
                                        onchange="chnagedHasVat({{ $key }})">
                                        <option value="">भ्याट प्रकार</option>
                                        <option value="1">भ्याट सहित</option>
                                        <option value="2">भ्याट बाहेक</option>
                                    </select>
                                </td>
                                <td><input type="number" id="kabol_amount_{{ $key }}"
                                        name="total_kabol_amount[]" oninput="chnagedHasVat({{ $key }})"></td>
                                <td><input type="text" id="total_amount_{{ $key }}" name="total_amount[]"
                                        class="form-control form-control-sm" readonly></td>
                                <td>
                                    <textarea type="text" name="remark[]" class="form-control form-control-sm"></textarea>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>


    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vue/bundle.js') }}"></script>
    <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
    <script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        window.onload = function() {
            $('.date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
        }

        function chnagedHasVat(params) {
            has_vat = $("#has_vat_"+params).val();
            console.log(has_vat);
            if (has_vat == '') {
                alert("भ्याटको परकर छान्नुहोस्");
                $("#kabol_amount_" + params).val(0);
                $("#total_amount_" + params).val(0);
            }else{
                kabol_amount = $("#kabol_amount_" + params).val();
                if (has_vat == 1) {
                    $("#total_amount_" + params).val(kabol_amount);
                } else {
                    $("#total_amount_"+params).val(parseFloat(kabol_amount*1.13).toFixed(2));
                }
            }
        }
    </script>
@endsection
