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
        <form action="{{ route('thekka-boli-submit') }}" method="POST">

        <div class="card-header">
            <h3>ठेक्का बोलिने फारम</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">मिति:
                            <span id="budget_source_id_group"
                                class="text-danger font-weight-bold px-1">*</span></span>
                    </div>
                    <input type="text" name="date" class="date">
                </div>
            </div>
        </div>
        <div class="card-body">
            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
            <table class="table table">
                <thead>
                    <tr>
                        <th scope="col">छान्नुहोस्</th>
                        <th scope="col">सी.न.</th>
                        <th scope="col">निर्माण ब्यवोसायीको नाम</th>
                        <th scope="col">ठेक्का कबोल गरेको कुल रकम </th>
                    </tr>
                </thead>
                <tbody>
                        @csrf
                        @foreach ($plan->contractKabols as $key => $item)
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kabol_id"
                                            value="{{ $item->id }}" name="flexRadioDefault"
                                            id="flexRadioDefault{{ $key + 1 }}">
                                        <label class="form-check-label" for="flexRadioDefault{{ $key + 1 }}">
                                            छान्नुहोस्
                                        </label>
                                    </div>
                                </th>
                                <th scope="row">{{ nepali($key + 1) }}</th>

                                <td><input type="hidden" value="{{ $item->contractor_name }}" name="total_kabol_amount[]">
                                    {{ $item->contractor_name }}</td>
                                <td>{{ $item->total_kabol_amount }}
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary" type="submit">Submit</button>
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

    </script>

@endsection
