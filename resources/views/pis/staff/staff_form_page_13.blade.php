@extends('layout.layout')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
    <style>
        .form-control{
            width:200px;
        }    
     </style>
@endsection


@section('content')
<div class="card px-4 py-4 mt-4" style="width: 3500 px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="pull-left">विदा र औषधी उपचारको विवरण

        </h1>
        
    </section>
    <!-- Main content -->
    <section class="content" >
            
            <div class="col-md-12" id="right-col" >
                <form method="post" enctype="multipart/form-data" action="{{route('page_13_submit')}}" autocomplete="off">
                    @csrf
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" style="font-size: 13px;" id="table" >
                            <thead class="thead-dark">
                                <tr>
                                    <td rowspan="2" style="text-align: center; width: 110px;">विवरण</td>
                                    <td rowspan="2" style="text-align: center; width:110px;">आर्थिक वर्ष</td>
                                    <td colspan="2" style="text-align: center;">घर विदा</td>
                                    <td colspan="2" style="text-align: center;">बिरामी विदा</td>
                                    <td colspan="1" style="text-align: center;">प्रसुति / प्रसुति स्याहार<br/> विदा</td>
                                    <td colspan="1" style="text-align: center;">अध्ययन विदा</td>
                                    <td colspan="1" style="text-align: center;">असाधारण विदा</td>
                                    <td colspan="1" style="text-align: center;">बेतलवी विदा</td>
                                    <td colspan="1" style="text-align: center;">गयल विदा</td>
                                    <td colspan="1" style="text-align: center;">क्याबी  बिदा</td>
                                    <td colspan="1" style="text-align: center;">पबी  बिदा </td>
                                    <td rowspan="2" style="text-align: center; width:110px;">उपचार खर्च लिएको रकम</td>
                                    <td rowspan="2" style="text-align: center; width: 110px;">कैफियत</td>
                                    <td rowspan="2"></td>
                                </tr>
                               
                                </thead>
                            <tbody id="row_body">
                                    <tr id="t_">
                                        <td> 
                                            <textarea id="detail" name="detail[1]" class="form-control detail" row="2"></textarea>
                                        </td>
                                   
                                        <td id="t_session_">
                                            <select id="session" name="session[1]" class="form-control">
                                                <option value="{{$fiscalYear->id}}">{{$fiscalYear->name}}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <label for="">विदा</label>
                                            <input id="home_new" min="0" type="number" name="home_new[1]" class="form-control home_new">
                                            <label class="mt-4" for="">पहिलेको बाँकी</label>
                                            <input id="home_prev_left" min="0" type="number" name="home_prev_left[1]" class="form-control home_prev_left" readonly>
                                            <label  for="">जम्मा</label>
                                            <input id="home_total" min="0" type="number" name="home_total[1]" class="form-control home_total" readonly>
                                        </td>
                                      
                                        <td>
                                            <label for="">खर्च</label>
                                            <input id="home_cost" min="0" type="number" name="home_cost[1]" class="form-control home_cost">
                                            <label  for="" class="mt-4">जम्मा</label>
                                            <input id="home_left" min="0" type="number" name="home_left[1]" class="form-control home_left" readonly>

                                        </td>

                                        <td>
                                          <label for="">विदा</label>
                                          <input id="sick_new" min="0" type="number" name="sick_new[1]" class="form-control sick_new">
                                          <label  for="" class="mt-4">पहिलेको बाँकी</label>
                                          <input id="sick_prev_left" min="0" type="number" name="sick_prev_left[1]" class="form-control sick_prev_left" readonly>
                                          <label  for="" class="mt-4">जम्मा</label>
                                          <input id="sick_total" min="0" type="number" name="sick_total[1]" class="form-control sick_total" readonly>

                                        <td>
                                            <label for="">खर्च</label>
                                            <input id="sick_cost" min="0" type="number" name="sick_cost[1]" class="form-control sick_cost">
                                            <label  for="" class="mt-4">बाँकी</label>
                                            <input id="sick_left" min="0" type="number" name="sick_left[1]" class="form-control sick_left" readonly>
                                        </td>
                                        
                                        <td>
                                            <label for="">जम्मा</label>
                                            <input id="delivery_total" min="0" type="number" name="delivery_total[1]" class="form-control delivery_total">
                                            <label  for="" class="mt-4">खर्च</label>
                                            <input id="delivery_cost" min="0" type="number" name="delivery_cost[1]" class="form-control delivery_cost">
                                            <label  for="" class="mt-4">बाँकी</label>
                                            <input id="delivery_left" min="0" type="number" name="delivery_left[1]" class="form-control delivery_left" readonly>
                                        
                                        </td>

                                        <td>
                                            <label for="">जम्मा</label>
                                            <input id="study_total" min="0" type="number" name="study_total[1]" class="form-control study_total">
                                            <label  for="" class="mt-4">खर्च</label>
                                            <input id="study_cost" min="0" type="number" name="study_cost[1]" class="form-control study_cost">
                                            <label  for="" class="mt-4">बाँकी</label>
                                            <input id="study_left" min="0" type="number" name="study_left[1]" class="form-control study_left" readonly>
                                        </td>

                                        <td>
                                            <label for="">जम्मा</label>
                                            <input id="uncommon_total" min="0" type="number" name="uncommon_total[1]" class="form-control uncommon_total">
                                            <label  for="" class="mt-4">खर्च</label>
                                            <input id="uncommon_cost" min="0" type="number" name="uncommon_cost[1]" class="form-control uncommon_cost">
                                            <label  for="" class="mt-4">बाँकी</label>
                                            <input id="uncommon_left" min="0" type="number" name="uncommon_left[1]" class="form-control uncommon_left" readonly>
                                        </td>

                                        <td>
                                            <label for="">जम्मा</label>
                                            <input id="bedroom_total" min="0" type="number" name="bedroom_total[1]" class="form-control bedroom_total">
                                            <label  for="" class="mt-4">खर्च</label>
                                            <input id="bedroom_cost" min="0" type="number" name="bedroom_cost[1]" class="form-control bedroom_cost">
                                            <label  for="" class="mt-4">बाँकी</label>
                                            <input id="bedroom_left" min="0" type="number" name="bedroom_left[1]" class="form-control bedroom_left" readonly>
                                        </td>
                                        <td>
                                            <label  for="">देखि</label>
                                                <input type="text" id="from_date" name="from_date[1]" class="form-control from_date">
                                            <label  for="" class="mt-4">सम्म</label>
                                                <input type="text" id="to_date" name="to_date[1]" class="form-control to_date">
                                            <label  for="" class="mt-4">जम्मा	</label>
                                                <input id="to_from_total" min="0" type="number" name="to_from_total[1]" class="form-control to_from_total" readonly>
                                        </td>

                                        <td>
                                            <label for="">जम्मा</label>
                                            <input id="kyabi_total" min="0" type="number" name="kyabi_total[1]" class="form-control kyabi_total">
                                            <label  for="" class="mt-4">खर्च</label>
                                            <input id="kyabi_cost" min="0" type="number" name="kyabi_cost[1]" class="form-control kyabi_cost">
                                            <label  for="" class="mt-4">बाँकी</label>
                                            <input id="kyabi_left" min="0" type="number" name="kyabi_left[1]" class="form-control kyabi_left" readonly readonly>
                                        </td>

                                        
                                        <td>
                                            <label for="">जम्मा</label>
                                            <input id="pabi_total" min="0" type="number" name="pabi_total[1]" class="form-control pabi_total">
                                            <label  for="" class="mt-4">खर्च</label>
                                            <input id="pabi_cost" min="0" type="number" name="pabi_cost[1]" class="form-control pabi_cost">
                                            <label  for="" class="mt-4">बाँकी</label>
                                            <input id="pabi_left" min="0" type="number" name="pabi_left[1]" class="form-control pabi_left" readonly>
                                        </td>
                                  
                                    <td>
                                        <input id="mc_amount" min="0" type="number" name="mc_amount[1]" class="form-control mc_amount">
                                    </td>
                                    <td>
                                        <textarea id="remarks" name="remarks[1]" class="form-control" row="2"></textarea>
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

        let detail=clone.querySelector("#detail");
        let session = clone.querySelector("#session");
        let home_prev_left = clone.querySelector("#home_prev_left");
        let home_new = clone.querySelector("#home_new");
        let home_total = clone.querySelector("#home_total");
        let home_cost = clone.querySelector("#home_cost");
        let home_left = clone.querySelector("#home_left");
        let sick_prev_left = clone.querySelector("#sick_prev_left");
        let sick_new = clone.querySelector("#sick_new");
        let sick_total = clone.querySelector("#sick_total");
        let sick_cost = clone.querySelector("#sick_cost");
        let sick_left = clone.querySelector("#sick_left");
        let delivery_total = clone.querySelector("#delivery_total");
        let delivery_cost = clone.querySelector("#delivery_cost");
        let delivery_left = clone.querySelector("#delivery_left");
        let study_total = clone.querySelector("#study_total");
        let study_cost = clone.querySelector("#study_cost");
        let study_left = clone.querySelector("#study_left");
        let uncommon_total = clone.querySelector("#uncommon_total");
        let uncommon_cost = clone.querySelector("#uncommon_cost");
        let uncommon_left = clone.querySelector("#uncommon_left");
        let bedroom_total = clone.querySelector("#bedroom_total");
        let bedroom_cost = clone.querySelector("#bedroom_cost");
        let bedroom_left = clone.querySelector("#bedroom_left");
        let from_date = clone.querySelector(".from_date");
        let to_date = clone.querySelector(".to_date");
        let to_from_total = clone.querySelector("#to_from_total");
        let kyabi_total = clone.querySelector("#kyabi_total");
        let kyabi_cost = clone.querySelector("#kyabi_cost");
        let kyabi_left = clone.querySelector("#kyabi_left");
        let pabi_total = clone.querySelector("#pabi_total");
        let pabi_cost = clone.querySelector("#pabi_cost");
        let pabi_left = clone.querySelector("#pabi_left");
        let mc_amount = clone.querySelector("#mc_amount");
        let remarks = clone.querySelector("#remarks");

        detail.name = 'detail['+j+']';
        session.name = 'session['+j+']';
        home_prev_left.name='home_prev_left['+j+']';
        home_new.name='home_new['+j+']';
        home_total.name='home_total['+j+']';
        home_cost.name='home_cost['+j+']';
        home_left.name='home_left['+j+']';
        sick_prev_left.name='sick_prev_left['+j+']';
        sick_new.name='sick_new['+j+']';
        sick_total.name='sick_total['+j+']';
        sick_cost.name='sick_cost['+j+']';
        sick_left.name='sick_left['+j+']';
        delivery_total.name='delivery_total['+j+']';
        delivery_cost.name='delivery_cost['+j+']';
        delivery_left.name='delivery_left['+j+']';
        study_total.name='study_total['+j+']';
        study_cost.name='study_cost['+j+']';
        study_left.name='study_left['+j+']';
        uncommon_total.name='uncommon_total['+j+']';
        uncommon_cost.name='uncommon_cost['+j+']';
        uncommon_left.name='uncommon_left['+j+']';
        bedroom_total.name='bedroom_total['+j+']';
        bedroom_cost.name='bedroom_cost['+j+']';
        bedroom_left.name='bedroom_left['+j+']';
        

        from_date.name = 'from_date['+j+']';
        from_date.id= 'from_date'+j;
        from_date.value="";

        to_date.name = 'to_date['+j+']';
        to_date.id= 'to_date'+j;
        to_date.value="";

        to_from_total.name='bedroom_left['+j+']';
        kyabi_total.name='kyabi_total['+j+']';
        kyabi_cost.name='kyabi_cost['+j+']';
        kyabi_left.name='kyabi_left['+j+']';
        pabi_total.name='pabi_total['+j+']';
        pabi_cost.name='pabi_cost['+j+']';
        pabi_left.name='pabi_left['+j+']';
        mc_amount.name='mc_amount['+j+']';
        bedroom_left.name='bedroom_left['+j+']';
        remarks.name='remarks['+j+']';

        
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

