@extends('layout.layout')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('content')
@if (count($data)>0)
    
        <div class="card">
            <section class="content-header">
                <h1 class="pull-left">भाषाको दक्षता सम्बन्धी विवरण
                </h1>
            </section>
        
            <form action="{{route('page_4_submit')}}" method="post">
                @csrf
            <div class="card-body">
                <div class="col-md-6">
                    <strong>क) स्थानिय भाष सम्बन्धी ज्ञान</strong>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">मातृभाषा: <i class="reqq">*</i></span></div>
                        <select id="local_language" name="local_language" class="form-control select2">
                            @foreach ($languages as $key=> $item)
                                @if ($staffLanguage->local_language==$item->id)
                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                @endif
                            @endforeach
                            @foreach ($languages as$key=> $item)
                                @if ($staffLanguage->local_language!=$item->id)
                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                @endif
                            @endforeach
                    
                        </select>
                        @isset($msg)
                        <strong style="margin-left:2%; "> {{$msg}} </strong>
                        @endisset
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td rowspan="2" style="text-align: center;">भाषाको नाम</td>
                        <td colspan="3" style="text-align: center;">लेखाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">पढाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">बोलाई क्षमता</td>
                        <td rowspan="2" span=""></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                    </tr>
                    </thead>
                    <tbody id="local_body">
                        @foreach ($data as $key=> $item)
                       
                        @if ($item->type=='local')
                       
                        <tr id="tl_1">
                            <td style="max-width: 200px;">
                                <select class="language" name="language[{{$key+1}}]" class="form-control select2">
                                    @if (isset($item->langauage))
                                    @foreach ($languages as $item)
                                        @if ($item->language==$item->id)
                                            <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                        @endif
                                    @endforeach
                                    @foreach ($languages as $item)
                                    @if ($item->language!=$item->id)
                                        <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                    @endif
                                @endforeach
                                @else
                                     <option value="" data-eng="">चयन गर्नुहोस्</option>
                                @foreach ($languages as $item)
                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                @endforeach
                                @endif
                                </select>
                            </td>
                            <td>
                                <input class="writing" type="radio" name="writing[{{$key+1}}]" value="1" checked>
                            </td>
                            <td>
                                <input class="writing"  type="radio" name="writing[{{$key+1}}]" value="2" >
                            </td>
                            <td>
                                <input class="writing"   type="radio" name="writing[{{$key+1}}]" value="3" >
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading[{{$key+1}}]" value="1" checked>
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading[{{$key+1}}]" value="2" >
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading[{{$key+1}}]" value="3" >
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="1" checked>
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="2" >
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking[{{$key+1}}]" value="3" >
                            </td>
                            <td>
                                <a id="add_local_btn" onclick="addLocal(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                                <a id="remove_local_btn"  onclick="removeLocal(this)" class="btn btn-sm btn-danger df"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endif
                        @endforeach


                        <?php
                    ?>
                    </tbody>
                    <tfoot>
                    
                    </tfoot>
                </table>
                <div class="col-md-12">
                    <strong>ख) विदेशी भाषा सम्बन्धी ज्ञान</strong>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td rowspan="2" style="text-align: center;">भाषाको नाम</td>
                        <td colspan="3" style="text-align: center;">लेखाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">पढाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">बोलाई क्षमता</td>
                        <td rowspan="2" span=""></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                    </tr>
                    </thead>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($data as $keyy => $item)

                    @if ($item->type=='foreign')
                    
                    @php
                   $i++;
                @endphp
                        
                    <tbody id="foreign_body">
                        <tr>
                            <td style="max-width: 200px;">
                                <select class="language" name="language2[1]" class="form-control select2">
                                    <option value="" data-eng="">चयन गर्नुहोस्</option>
                                    @foreach ($foreign_languages as $item)
                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input class="writing" type="radio" name="writing2[1]" value="1" checked>
                            </td>   
                            <td>
                                <input class="writing" type="radio" name="writing2[1]" value="2" >
                            </td>
                            <td>
                                <input class="writing" type="radio" name="writing2[1]" value="3" >
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading2[1]" value="1" checked>
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading2[1]" value="2" >
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading2[1]" value="3" >
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking2[1]" value="1" checked>
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking2[1]" value="2" >
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking2[1]" value="3" >
                            </td>
                            <td>
                                <a id="add_foreign_btn" onclick="addForeign(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                                <a id="remove_foreign_btn"  onclick="removeForeign(this)" class="btn btn-sm btn-danger df"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        
                    </tbody>
                    @endif    

                    @endforeach

                    <tfoot>
                    <tr>
                        <td colspan="10">
                        
                        </td>
                    </tr>
                    </tfoot>
                </table>
                

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save & Next</button>
            </div>
        </form>

        </div>

@else
        <div class="card">
            <section class="content-header">
                <h1 class="pull-left">भाषाको दक्षता सम्बन्धी विवरण
                </h1>
            </section>
        
            <form action="{{route('page_4_submit')}}" method="post">
                @csrf
            <div class="card-body">
                <div class="col-md-6">
                    <strong>क) स्थानिय भाष सम्बन्धी ज्ञान</strong>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">मातृभाषा: <i class="reqq">*</i></span></div>
                        <select id="local_language" name="local_language" class="form-control select2">
                            <option value="" data-eng="">चयन गर्नुहोस्</option>
                            @foreach ($languages as $item)
                            <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                            @endforeach
                    
                        </select>
                        @isset($msg)
                        <strong style="margin-left:2%; "> {{$msg}} </strong>
                        @endisset
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td rowspan="2" style="text-align: center;">भाषाको नाम</td>
                        <td colspan="3" style="text-align: center;">लेखाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">पढाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">बोलाई क्षमता</td>
                        <td rowspan="2" span=""></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                    </tr>
                    </thead>
                    <tbody id="local_body">
                
                        <tr id="tl_1">
                            <td style="max-width: 200px;">
                                <select class="language" name="language[1]" class="form-control select2">
                                    <option value="" data-eng="">चयन गर्नुहोस्</option>
                                    @foreach ($languages as $item)
                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input class="writing" type="radio" name="writing[1]" value="1" checked>
                            </td>
                            <td>
                                <input class="writing"  type="radio" name="writing[1]" value="2" >
                            </td>
                            <td>
                                <input class="writing"   type="radio" name="writing[1]" value="3" >
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading[1]" value="1" checked>
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading[1]" value="2" >
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading[1]" value="3" >
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking[1]" value="1" checked>
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking[1]" value="2" >
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking[1]" value="3" >
                            </td>
                            <td>
                                <a id="add_local_btn" onclick="addLocal(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                                <a id="remove_local_btn"  onclick="removeLocal(this)" class="btn btn-sm btn-danger df"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php
                    ?>
                    </tbody>
                    <tfoot>
                    
                    </tfoot>
                </table>
                <div class="col-md-12">
                    <strong>ख) विदेशी भाषा सम्बन्धी ज्ञान</strong>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td rowspan="2" style="text-align: center;">भाषाको नाम</td>
                        <td colspan="3" style="text-align: center;">लेखाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">पढाई क्षमता</td>
                        <td colspan="3" style="text-align: center;">बोलाई क्षमता</td>
                        <td rowspan="2" span=""></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                        <td style="text-align: center;">अति उत्तम</td>
                        <td style="text-align: center;">उत्तम</td>
                        <td style="text-align: center;">सामान्य</td>
                    </tr>
                    </thead>
                    <tbody id="foreign_body">
                        <tr>
                            <td style="max-width: 200px;">
                                <select class="language" name="language2[1]" class="form-control select2">
                                    <option value="" data-eng="">चयन गर्नुहोस्</option>
                                    @foreach ($foreign_languages as $item)
                                    <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input class="writing" type="radio" name="writing2[1]" value="1" checked>
                            </td>
                            <td>
                                <input class="writing" type="radio" name="writing2[1]" value="2" >
                            </td>
                            <td>
                                <input class="writing" type="radio" name="writing2[1]" value="3" >
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading2[1]" value="1" checked>
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading2[1]" value="2" >
                            </td>
                            <td>
                                <input class="reading" type="radio" name="reading2[1]" value="3" >
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking2[1]" value="1" checked>
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking2[1]" value="2" >
                            </td>
                            <td>
                                <input class="speaking" type="radio" name="speaking2[1]" value="3" >
                            </td>
                            <td>
                                <a id="add_foreign_btn" onclick="addForeign(this)" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                                <a id="remove_foreign_btn"  onclick="removeForeign(this)" class="btn btn-sm btn-danger df"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="10">
                        
                        </td>
                    </tr>
                    </tfoot>
                   
                

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save & Next</button>
            </div>
        </form>

        </div>
@endif

@endsection

@section('scripts')
<script>
        
</script>
<script>
    let foreign_body = document.querySelector("#foreign_body");
  
    let i = 2;
    let j = 2;
    function addForeign(event) {
        console.log(j);
        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';

        let language=clone.querySelectorAll(".language");
        let writing = clone.querySelectorAll(".writing");
        let reading = clone.querySelectorAll(".reading");
        let speaking = clone.querySelectorAll(".speaking");

        for (let index = 0; index < language.length; index++) {
            const element = language[index];
            element.setAttribute('name', 'language2['+j+']');
            element.checked=false;
        }

        for (let index = 0; index < writing.length; index++) {
            const element = writing[index];
            element.setAttribute('name', 'writing2['+j+']');
            element.checked=false;
        }
        for (let index = 0; index < reading.length; index++) {
            const element = reading[index];
            element.setAttribute('name', 'reading2['+j+']');
            element.checked=false;
        }
        for (let index = 0; index < speaking.length; index++) {
            const element = speaking[index];
            element.setAttribute('name', 'speaking2['+j+']');
            element.checked=false;
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
<script>
     let local_body = document.querySelector("#local_body");
    let k = 2;
    let l = 2;
    function addLocal(event)
    {
        let tr = event.closest('tr');
        let clone = tr.cloneNode(true);
        event.style.display = 'none';

        let language=clone.querySelectorAll(".language");
        let writing = clone.querySelectorAll(".writing");
        let reading = clone.querySelectorAll(".reading");
        let speaking = clone.querySelectorAll(".speaking");

        for (let index = 0; index < language.length; index++) {
            const element = language[index];
            element.setAttribute('name', 'language['+j+']');
        }

        for (let index = 0; index < writing.length; index++) {
            const element = writing[index];
            element.setAttribute('name', 'writing['+j+']');
        }
        for (let index = 0; index < reading.length; index++) {
            const element = reading[index];
            element.setAttribute('name', 'reading['+j+']');
        }
        for (let index = 0; index < speaking.length; index++) {
            const element = speaking[index];
            element.setAttribute('name', 'speaking['+j+']');
        }
        local_body.appendChild(clone);
        j++;
    }

    function removeLocal(event)
    {
        let tr = event.closest('tr');
        let td = event.closest('td');
        var children = td.children;
        var is_hidden = true;

        let add_btn = td.querySelector("#add_local_btn");
        let remove_btn = td.querySelector("#remove_local_btn");
        if (add_btn.style.display != 'none') {
            is_hidden = false;
        }
        if (!is_hidden) {
            let prevTr = tr.previousElementSibling;
            if (prevTr == null) {
               return;
            }
            let prev_add_btn = prevTr.querySelector("#add_local_btn");
            prev_add_btn.style.display = 'inline';
            let cells = prevTr.cells;
        }
        tr.remove();
    }
</script>
   
@endsection
