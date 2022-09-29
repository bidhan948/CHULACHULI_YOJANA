@extends('layout.layout')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
    
@endsection

@section('content')
<div class="card px-4 py-4 mt-4" style="width: 3500 px;">

<section class="content">
     <!-- Content Header (Page header) -->
     <section class="content-header">
        <h1 class="pull-left">वर्गीकृत क्षेत्रहरुमा काम गरेको विवरण
        </h1>
    </section>
    <div class="row">
       
        <div class="col-md-12" id="right-col">
            <form method="post" enctype="multipart/form-data" action="{{route('page_14_submit')}}" autocomplete="off">
                @csrf
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered" style="font-size: 11px;">
                        <thead>
                        <tr>
                            <td colspan="2" style="text-align: center;">अवधि</td>
                            <td rowspan="2" style="text-align: center;">पदस्थापना भएको स्थान वा क्षेत्र</td>
                            <td rowspan="2" style="text-align: center;">काम गरेको स्थान वा क्षेत्र</td>
                            <td colspan="5" style="text-align: center;">काम गरेको क्षेत्रको वर्ग जनाउने</td>
                            <td rowspan="2" style="text-align: center;">कैफियत</td>
                            <td rowspan="2"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">देखि</td>
                            <td style="text-align: center;">सम्म</td>
                            <td style="text-align: center;">क वर्ग</td>
                            <td style="text-align: center;">ख वर्ग</td>
                            <td style="text-align: center;">ग वर्ग</td>
                            <td style="text-align: center;">घ वर्ग</td>
                            <td style="text-align: center;">ङ वर्ग</td>
                        </tr>
                        </thead>
                        <tbody id="row_body">
                      
                            <tr >
                                <td>
                                    <div class="col-md-12 ndp-custom">
                                        <input type="text" id="from_date"  name="from_date[1]" class="form-control from_date">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12 ndp-custom">
                                        <input type="text" id="to_date" name="to_date[1]" class="form-control to_date">
                                    </div>
                                </td>
                                <td>
                                    <input type="text" id="post_area" name="post_area[1]" class="form-control">
                                </td>
                                <td>
                                    <input type="text" id="work_area" name="work_area[1]" class="form-control">
                                </td>
                                <td>
                                    <input type="checkbox" id="a_work" name="a_work[1]" value="1">
                                </td>
                                <td>
                                    <input type="checkbox" id="b_work"  name="b_work[1]" value="1">
                                </td>
                                <td>
                                    <input type="checkbox" id="c_work"  name="c_work[1]" value="1">
                                </td>
                                <td>
                                    <input type="checkbox" id="d_work"  name="d_work[1]" value="1">
                                </td>
                                <td>
                                    <input type="checkbox" id="e_work"  name="e_work[1]" value="1">
                                </td>
                                <td>
                                    <textarea id="remarks" name="remarks[1]" class="form-control"></textarea>
                                </td>
                              
                                <td>
                                    <a id="add_foreign_btn" onclick="addForeign(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                                    <a id="remove_foreign_btn"  onclick="removeForeign(this)" class="btn btn btn-danger df"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                       
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer" style="text-align: center;">
                    <input type="button" class="btn btn-primary" onclick=history.back() value="Previous" >
                    <button type="submit"   class="btn btn-primary">Save</button> 
                </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
</div>
@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/convert_nepali.js') }}"></script>

<script>
     $('#from_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

            $('#to_date').nepaliDatePicker({
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

        let from_date = clone.querySelector(".from_date");
        let to_date = clone.querySelector(".to_date");

        let post_area = clone.querySelector("#post_area");
        let work_area = clone.querySelector("#work_area");
        let a_work = clone.querySelector("#a_work");
        let b_work = clone.querySelector("#b_work");
        let c_work = clone.querySelector("#c_work");
        let d_work = clone.querySelector("#d_work");
        let e_work = clone.querySelector("#e_work");
        let remarks = clone.querySelector("#remarks");
        
        from_date.name = 'from_date['+j+']';
        from_date.id= 'from_date'+j;
        from_date.value="";

        to_date.name = 'to_date['+j+']';
        to_date.id= 'to_date'+j;
        to_date.value="";

        post_area.name = 'post_area['+j+']';
        work_area.name = 'work_area['+j+']';
        a_work.name = 'a_work['+j+']';
        a_work.value ='';

        b_work.name = 'b_work['+j+']';
        b_work.value ='';

        c_work.name = 'c_work['+j+']';
        c_work.value ='';

        d_work.name = 'd_work['+j+']';
        d_work.value ='';

        e_work.name = 'e_work['+j+']';
        e_work.value ='';

        remarks.name = 'remarks['+j+']';
        remarks.value="";

        foreign_body.appendChild(clone);
        $('.from_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
            $('.to_date').nepaliDatePicker({
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
