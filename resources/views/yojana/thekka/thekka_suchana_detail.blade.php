@section('title', $plan->name . ' को विवरण')
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
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3>ठेक्का सुचना विवरण</h3>
            </div>


            <form action="">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ठेक्का किसिम :
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>  
                            <div class="form-check ml-4">
                                <input class="form-check-input" type="radio" name="has_deadline"
                                    id="has_deadline" value="1">
                                <label class="form-check-label" for="has_deadline">
                                    भ्याट सहित
                                </label>
                            </div>
                            <div class="form-check">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="has_deadline"
                                        id="no_deadline" value="0" checked>
                                    <label class="form-check-label" for="no_deadline">
                                        भ्याट बाहेक
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('has_deadline')
                            <strong style="color: red">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ठेक्का रकम:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input name="thekka_amount" type="number" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">प्रकासित मिति:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input name="prakashit_date" type="text" class="form-control form-control-sm date"></textarea>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">कुल ठेक्का रकम:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input name="total_thekka_amount" type="number" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">बोलपत्र दाखिला गर्नु पर्ने अन्तिम मिति:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input name="dakhila_date" type="text" class="form-control form-control-sm date"></textarea>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 mt-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">कैफियत:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <textarea name="remarks" type="text" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </form>


            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection

@section('scripts')
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

