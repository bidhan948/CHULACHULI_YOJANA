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
        <h1 class="pull-left">विभागीय सजायको विवरण
        </h1>
        
    </section>
    <!-- Main content -->
    <section class="content">x
            
            <div class="col-md-12" id="right-col">
                <form method="post" enctype="multipart/form-data" action="{{route('page_12_submit')}}" autocomplete="off">
                    @csrf
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <td rowspan="2" style="text-align: center;">सजायको प्रकार</td>
                                    <td rowspan="2" style="text-align: center;">सजायको <br/>आदेश मिति</td>
                                    <td colspan="2" style="text-align: center;">पुनरावेदनको</td>
                                    <td rowspan="2" style="text-align: center;">कैफियत</td>
                                    <td rowspan="2"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">ठहर</td>
                                    <td style="text-align: center;">मिति</td>
                                </tr>
                            </thead>
                            <tbody id="row_body">
                                <tr>
                                    <td style="max-width: 200px;">
                                        <select id="punishment" name="punishment[1]" class="form-control select2" required>
                                            <option value="" data-eng="">चयन गर्नुहोस्</option>
                                            @foreach ($punishments as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class="col-md-12 ndp-custom">
                                            <input type="text" id="ordered_date" name="ordered_date[1]" class="form-control ordered_date">
                                        </div>
                                    </td>
                                    <td>
                                        <label>
                                            <input class="stopped" type="radio" name="stopped[1]"  value="1"> हो
                                        </label>
                                        <label>
                                            <input class="stopped" type="radio" name="stopped[1]" value="0"> होइन
                                        </label>
                                    </td>
                                    <td>
                                        <div class="col-md-12 ndp-custom">
                                            <input type="text" id="stopped_date" name="stopped_date[1]" class="form-control stopped_date">
                                        </div>
                                    </td>
                                    <td>
                                        <textarea id="remarks" name="remarks[1]" class="form-control"></textarea>
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
         
    <!-- /.content -->
</div>

@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/convert_nepali.js') }}"></script>
<script>

$('#ordered_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

            $('#stopped_date').nepaliDatePicker({
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

        let punishment=clone.querySelector("#punishment");
        let ordered_date = clone.querySelector(".ordered_date");
        let stopped=clone.querySelectorAll(".stopped");
        let stopped_date=clone.querySelector(".stopped_date");
        let convenience = clone.querySelector("#convenience");
        let remarks = clone.querySelector("#remarks");

        
        punishment.name = 'punishment['+j+']';
        ordered_date.name = 'ordered_date['+j+']';
        ordered_date.id= 'ordered_date'+j;
        ordered_date.value="";

        for (let index = 0; index < stopped.length; index++) {
            const element = stopped[index];
            element.setAttribute('name', 'stopped['+j+']');
            element.checked=false;

        }
        stopped_date.name = 'stopped_date['+j+']';
        stopped_date.id= 'stopped_date'+j;
        stopped_date.value="";
         
        remarks.name = 'remarks['+j+']';
        remarks.value="";

        foreign_body.appendChild(clone);
        $('.stopped_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
            $('.ordered_date').nepaliDatePicker({
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

