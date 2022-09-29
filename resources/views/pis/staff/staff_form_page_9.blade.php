@extends('layout.layout')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection


@section('content')
<link rel="stylesheet" type="text/css" href="=base_url();assets/vendors/plugins/select2/select2.min.css"/>
<link rel="stylesheet" type="text/css" href="=base_url();assets/vendors/plugins/jQueryUI/jquery-ui.min.css"/>
<link rel="stylesheet" type="text/css" href="=base_url();assets/vendors/inputmask/inputmask.css"/>
<link rel="stylesheet" type="text/css" href="=base_url();assets/vendors/nepaliDate/nepali.datepicker.v2.1.min.css" />
<!-- Content Wrapper. Contains page content -->
<div class="card px-4 py-4 mt-4">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="pull-left">शैक्षिक योग्यता
        </h1>
   
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
           
         
            <div class="col-md-12" id="right-col">
                <form method="post"  action="{{route('page_9_submit')}}">
                    @csrf
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" style="font-size: 13px;">
                            <thead>
                            <tr>
                                <td style="text-align: center;">शैक्षिक योग्यता वा उपाधि</td>
                                <td style="text-align: center;">अध्ययनको विषय वा संकाय</td>
                                <td style="text-align: center;">उतीर्ण गरेको साल</td>
                                <td style="text-align: center;">प्राप्त श्रेणी</td>
                                <td style="text-align: center;">शिक्षण<br/> संस्था/परिषद्/विश्वविद्यालयको<br/> नाम र देश</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody id="row_body">
                                
                                <tr id="t_">
                                    <td style="max-width: 200px;">
                                        <select id="qualification" name="qualification[1]" class="form-control select2">
                                            <option value="" data-eng="">चयन गर्नुहोस्</option>
                                            @foreach ($qualifications as $item)
                                            <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="max-width: 200px;">
                                        <select id="subject" name="subject[1]" class="form-control select2">
                                            <option value="" data-eng="">चयन गर्नुहोस्</option>
                                            @foreach ($subjects as $item)
                                            <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="max-width: 200px;">
                                        <select id="year" name="year[1]" class="form-control select2">
                                            <option value="" data-eng="">चयन गर्नुहोस्</option>
                                      @foreach ($date as $item)
                                      <option value="{{$item[0]}}" data-eng="">{{$item[0]}}</option>
                                      @endforeach
                                        </select>
                                    </td>
                                    <td style="max-width: 200px;">
                                        <select id="position" name="position[1]" class="form-control select2">
                                            <option value="" data-eng="">चयन गर्नुहोस्</option>
                                            @foreach ($postitions as $item)
                                            <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                            @endforeach
                                         
                                        </select>
                                    </td>
                                    <td style="max-width: 200px;">
                                        <select id="institute" name="institute[1]" class="form-control select2">
                                            <option value="" data-eng="">चयन गर्नुहोस्</option>
                                            @foreach ($institutes  as $item)
                                            <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                            @endforeach
                                        </select>
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
                        <input type="button" class="btn btn-primary" onclick=history.back() value="Previous" >
                            <button type="submit"  class="btn btn-primary">Save & Next</button>
                    </div>
                </form>
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
<!-- /.content-wrapper -->
<!-- ./wrapper -->

<!-- Bootstrap 3.3.6 -->

<script>
    let foreign_body = document.querySelector("#row_body");
    let i = 2;
    let j = 2;
    function addForeign(event) {
        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';
        console.log(tr);
        let qualification=clone.querySelectorAll("#qualification");
        let subject = clone.querySelectorAll("#subject");
        let position = clone.querySelectorAll("#position");
        let year = clone.querySelectorAll("#year");
        let institute = clone.querySelectorAll("#institute");

        for (let index = 0; index < qualification.length; index++) {
            const element = qualification[index];
            element.setAttribute('name', 'qualification['+j+']');
        }

        for (let index = 0; index < subject.length; index++) {
            const element = subject[index];
            element.setAttribute('name', 'subject['+j+']');
        }
        for (let index = 0; index < year.length; index++) {
            const element = year[index];
            element.setAttribute('name', 'year['+j+']');
        }
        for (let index = 0; index < institute.length; index++) {
            const element = institute[index];
            element.setAttribute('name', 'institute['+j+']');
        }

        for (let index = 0; index < position.length; index++) {
            const element = position[index];
            element.setAttribute('name', 'position['+j+']');
        }
        foreign_body.appendChild(clone);
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
</body>
</html>
@endsection
