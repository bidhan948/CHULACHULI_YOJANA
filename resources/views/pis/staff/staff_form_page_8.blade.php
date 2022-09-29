@extends('layout.layout')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->

    <!-- Main content -->
<div class="card px-4 py-4 mt-4">
    <section class="content-header">
        <h1 class="pull-left">सेवा सम्बन्धी विवरण

        </h1>

    </section>
        <div class="row">

            <div class="col-md-12" id="right-col">
                    <input type="hidden" name="req_field" value="111">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <form action="{{route('page_8_submit')}}" method="POST">
                        @csrf
                    <div class="box-body">
                        <table class="table table-bordered" style="font-size: 13px;">
                            <thead>
                            <tr>
                                <td style="text-align: center;">सेवा</td>
                                <td style="text-align: center;">समूह <!-- /उप समूह !--></td>
                                <td style="text-align: center;">पद र श्रेणी</td>
                                <td style="text-align: center;">कार्यालयको / बिद्यालयको नाम र ठेगाना</td>
                                <td style="text-align: center;">कार्यालयको / बिद्यालयको नाम र ठेगाना अंग्रजीमा</td>
                                <td style="text-align: center;">नयाँ नियुक्ति/सरुवा/बढुवा</td>
                                <td style="text-align: center;">निर्णय मिति</td>
                                <td style="text-align: center;">बहाली मिति<br/>( हाजिरी मिति)</td>
                                <td></td>
                            </tr>
                            </thead>
                                <tbody id="row_body">
                                       <tr>
                                        <td>
                                            <div  class="form-control">
                                            <select class="service" id="service" name="service[1]" >
                                                <option value="" data-eng="">चयन गर्नुहोस्</option>
                                                @foreach ($services as $item)
                                                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </td>
                                        <td style="max-width: 200px;">
                                            <div class="form-control">

                                            <select class="office_group" id="office_group" name="office_group[1]" >
                                                <option value="" data-eng="">समूह चयन</option>
                                              @foreach ($officeGroups as $item)
                                                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                              @endforeach
                                            </select>
                                            </div>
                                            <!--
                                            <select id="office_subgroup_" name="office_subgroup[]" class="form-control select2">
                                                <option value="" data-eng="">उप समूह चयन</option>

                                            </select>
                                            !-->
                                        </td>
                                        <td style="max-width: 200px;">
                                            <div class="form-control">

                                            <select class="position" id="position_1"  name="position[1]">
                                                <option value="" data-eng="">पद चयन</option>
                                                @foreach ($positions as $item)
                                                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                              @endforeach

                                            </select>
                                        </div>
                                        <div class="form-control">
                                            <select class="level" id="level" name="level[1]" >
                                                <option value="" data-eng="">श्रेणी चयन</option>
                                                @foreach ($levels as $item)
                                                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>

                                        </td>
                                        <td>
                                            <input type="text" id="office_name_address" name="office_name_address[1]" class="form-control" value="" >
                                        </td>
                                        <td>
                                            <input type="text" id="office_name_address_english" name="office_name_address_english[1]" class="form-control" value="" >
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                @foreach ($appoints as $key=> $item)
                                                <div class="input-group-text ml-2">
                                                    <input  class="new_appoint" name="new_appoint[1]" type="radio" aria-label="Radio button for following text input" value="{{$key}}"> {{$item}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12 ndp-custom" style="max-width: 400px;">
                                                <input type="text"   id="decision_date" name="decision_date[1]" class="form-control decision_date">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12 ndp-custom">
                                                <input type="text" id="restoration_date" name="restoration_date[1]" class="form-control restoration_date">
                                            </div>
                                        </td>
                                        <td>
                                            <a id="add_btn" onclick="addDetails(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                                            <hr>
                                            <a id="remove_btn"  onclick="removeDetails(this)" class="btn btn-danger df"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="text-align: center;">
                        <input type="button" class="btn btn-primary" onclick=history.back() value="Previous" >
                            <button type="submit"  class="btn btn-primary">Save & Next</button>
                    </div>
                </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    <!-- /.content -->
<!-- /.content-wrapper -->
<!-- ./wrapper -->


</body>
</html>
@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/convert_nepali.js') }}"></script>
    <script>

        
    $('#decision_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

     $('#restoration_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });

        let row_body = document.querySelector("#row_body");
        let i = 2;
        let j = 2;
        let k = 2;
        let date = 1;

    function addDetails(event) {

        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';

       let service= clone.querySelector(".service");
       let office_group=clone.querySelector(".office_group");
       let position=clone.querySelector('.position');
       let level=clone.querySelector('.level');
       let office_name_address=clone.querySelector('#office_name_address');
       let office_name_address_english=clone.querySelector('#office_name_address_english');
       let decision_date=clone.querySelector('.decision_date');
       let restoration_date=clone.querySelector('.restoration_date');
       let new_appoint=clone.querySelectorAll('.new_appoint');
       
       
       service.name = 'service['+j+']';
       service.value="";
       office_group.name = 'office_group['+j+']';
       office_group.value="";
       position.name = 'position['+j+']';
       position.value="";
       level.name = 'level['+j+']';
       level.value="";
       office_name_address.name = 'office_name_address['+j+']';
       office_name_address.value="";
       office_name_address_english.name = 'office_name_address_english['+j+']';
       office_name_address_english.value="";
       decision_date.name = 'decision_date['+j+']';
       decision_date.id = 'decisionDate'+j;
       decision_date.value="";
       restoration_date.name = 'restoration_date['+j+']';
       restoration_date.id = 'restoration_date'+j;
       restoration_date.value="";

       for (let index = 0; index < new_appoint.length; index++) {
            const element = new_appoint[index];
            element.setAttribute('name', 'new_appoint['+j+']');
        }

        row_body.appendChild(clone);

        $('.decision_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
            $('.restoration_date').nepaliDatePicker({
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


    function removeDetails(event) {
        let tr = event.closest('tr');
        let td = event.closest('td');
        var children = td.children;
        var is_hidden = true;
        let add_btn = td.querySelector("#add_btn");
        let remove_btn = td.querySelector("#remove_btn");
        if (add_btn.style.display != 'none') {
            is_hidden = false;
        }
        if (!is_hidden) {
            let prevTr = tr.previousElementSibling;
            if (prevTr == null) {
               return;
            }
            let prev_add_btn = prevTr.querySelector("#add_btn");
            prev_add_btn.style.display = 'inline';
            let cells = prevTr.cells;
        }
        tr.remove();
    }
    </script>




@endsection
