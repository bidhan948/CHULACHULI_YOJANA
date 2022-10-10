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

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ठेक्का किसिम :
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>  
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="has_deadline"
                                    onchange='handleChange(1);' id="has_deadline" value="1">
                                <label class="form-check-label" for="has_deadline">
                                    म्याद भएको
                                </label>
                            </div>
                            <div class="form-check">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="has_deadline"
                                        onchange='handleChange(0);' id="no_deadline" value="0" checked>
                                    <label class="form-check-label" for="no_deadline">
                                        म्याद नभएको
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
                            <input name="name" type="number" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">प्रकासित मित:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input name="name" type="number" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">बोलपत्र दाखिला गर्नु पर्ने अन्तिम मिति:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input name="name" type="number" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">बोलपत्र दाखिला गर्नु पर्ने अन्तिम मिति:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input name="name" type="number" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">बोलपत्र दाखिला गर्नु पर्ने अन्तिम मिति:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <textarea name="name" type="number" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
