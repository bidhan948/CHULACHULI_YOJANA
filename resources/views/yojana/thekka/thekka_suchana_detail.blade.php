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
                <h4>ठेक्का सुचना विवरण</h4>
            </div>


            <form action="{{route('thekka-suchana-detail-submit')}}" method="POST">
                @csrf
                <input type="hidden" name="plan_id" value={{$plan->id}}>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">सूचना प्रकासित मिति:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input name="prakashit_date" value="{{isset($contract->prakashit_date) ? $contract->prakashit_date : ''}}" type="text" class="form-control form-control-sm date"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ठेक्का किसिम :
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>  

                            @if ($contract!=null)
                                <div class="form-check ml-4">
                                    <input class="form-check-input" id="withVat" type="radio" name="has_deadline"
                                        id="has_deadline" value="1" onclick="calculateAmount()" {{$contract->has_deadline? 'checked' : ''}}>
                                    <label class="form-check-label" for="withVat">
                                        भ्याट सहित
                                    </label>
                                </div>
                                <div class="form-check">
                                    <div class="form-check">
                                        <input class="form-check-input" id="withoutVat" type="radio" name="has_deadline"
                                            id="no_deadline" value="0" onclick="calculateAmount()" {{!$contract->has_deadline ? 'checked' : ''}}>
                                        <label class="form-check-label" for="withoutVat">
                                            भ्याट बाहेक
                                        </label>
                                    </div>
                                </div>
                            @else

                            <div class="form-check ml-4">
                                <input class="form-check-input" id="withVat" type="radio" name="has_deadline"
                                    id="has_deadline" value="1" onclick="calculateAmount()">
                                <label class="form-check-label" for="withVat">
                                    भ्याट सहित
                                </label>
                            </div>
                            <div class="form-check">
                                <div class="form-check">
                                    <input class="form-check-input" id="withoutVat" type="radio" name="has_deadline"
                                        id="no_deadline" value="0" onclick="calculateAmount()" checked>
                                    <label class="form-check-label" for="withoutVat">
                                        भ्याट बाहेक
                                    </label>
                                </div>
                            </div>
                            @endif

                        </div>
                        @error('has_deadline')
                            <strong style="color: red">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ठेक्का रकम:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input name="thekka_amount" id="thekka_amount" oninput="calculateAmount()" value="{{isset($contract->thekka_amount) ? $contract->thekka_amount : ''}}" type="number" class="form-control form-control-sm">
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">कुल ठेक्का रकम:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input name="total_thekka_amount" id="total_thekka_amount" value="{{isset($contract->total_thekka_amount) ? $contract->total_thekka_amount : ''}}" type="number" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                   

                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">बोलपत्र दाखिला गर्नु पर्ने अन्तिम मिति:
                                    <span id="budget_source_id_group" class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input name="dakhila_date" value="{{isset($contract->dakhila_date) ? $contract->dakhila_date : ''}}" type="text" class="form-control form-control-sm date"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">कैफियत:</span>
                            </div>
                            <textarea name="remarks" value="" type="text" class="form-control form-control-sm" style="height:31px">{{isset($contract->remarks) ? $contract->remarks : ''}}</textarea>
                        </div>
                    </div>
                </div>

            </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

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
            function calculateAmount()
            {
                thekka_amount = +$("#thekka_amount").val() || 0;
                withVat = $('#withVat').is(':checked');
                withoutVat = $('#withoutVat').is(':checked');
                if(withVat){
                    $("#total_thekka_amount").val((thekka_amount).toFixed(2));
                }else{
                    $("#total_thekka_amount").val((1.13*thekka_amount).toFixed(2));
                }
            }
    </script>
    
@endsection

