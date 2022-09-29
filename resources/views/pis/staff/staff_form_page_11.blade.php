@extends('layout.layout')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection


@section('content')
<div class="card px-4 py-4 mt-4">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="pull-left">विभूषण, प्रशांसा पत्र र पुरस्कारको विवरण
        </h1>
        
    </section>
    <!-- Main content -->
    <section class="content">
            
            <div class="col-md-12" id="right-col">
                <form method="post" enctype="multipart/form-data" action="{{route('page_11_submit')}}" autocomplete="off">
                    @csrf
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" style="font-size: 13px;">
                            <thead>
                            <tr>
                                <td style="text-align: center;">विभूषण, प्रशंसा पत्रको विवरण</td>
                                <td style="text-align: center;">प्राप्त मिति</td>
                                <td style="text-align: center;">विभूषण,प्रशंसापत्र पाएको कारण</td>
                                <td style="text-align: center;">सहुलियत</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody id="row_body">
                            
                                
                                <tr>
                                    <td>
                                        <input type="text" id="award_detail" name="award_detail[1]" class="form-control" required>
                                    </td>
                                    <td>
                                        <div class="col-md-12 ndp-custom">
                                            <input type="text" id="received_date" name="received_date[1]" class="form-control received_date">
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" id="reason" name="reason[1]" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" id="convenience" name="convenience[1]" class="form-control">
                                    </td>
                                    <td>
                                        <a id="add_foreign_btn" onclick="addForeign(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                                        <a id="remove_foreign_btn"  onclick="removeForeign(this)" class="btn btn-sm btn-danger df"><i class="fa fa-times"></i></a>
                                </td>
                                </tr>
                                
                            
                            </tbody>
                            <tfoot>
                               
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="text-align: center;">
                        <div class="box-footer" style="text-align: center">
                            <input type="button" class="btn btn-primary" onclick=history.back() value="Previous" >
                           <button type="submit" class="btn btn-primary">Submit</button>
                       </div>
                    </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/convert_nepali.js') }}"></script>
<script>

$('#received_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
    let foreign_body = document.querySelector("#row_body");
    let i = 2;
    let j = 2;
    function addForeign(event) {
        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';

        let award_detail=clone.querySelector("#award_detail");
        let received_date = clone.querySelector(".received_date");
        let reason = clone.querySelector("#reason");
        let convenience = clone.querySelector("#convenience");
        
        award_detail.name = 'award_detail['+j+']';
        award_detail.value="";
        received_date.name = 'received_date['+j+']';
        received_date.id= 'myDate'+j;
        received_date.value="";

        reason.name = 'reason['+j+']';
        reason.value = '';
        convenience.name = 'convenience['+j+']';
        convenience.value = '';
        

        foreign_body.appendChild(clone);
        $('.received_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
        j++;
    }

    function removeForeign(event) {
        let tr = event.closest('tr');
        let td = event.closest('td');
        var children = td.children;
        var is_hidden = true;

        let add_btn = td.querySelector("#add_foreign_btn");
        let remove_btn = td.querySelector("#remove_foreign_btn");
        if (add_btn.style.display != 'none') {
            is_hidden = false;
        }
        if (!is_hidden) {
            let prevTr = tr.previousElementSibling;
            if (prevTr == null) {
               return;
            }
            let prev_add_btn = prevTr.querySelector("#add_foreign_btn");
            prev_add_btn.style.display = 'inline';
            let cells = prevTr.cells;
        }
        tr.remove();
    }

   
</script>
@endsection

