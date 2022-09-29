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
    <section class="content-header">
        <h1 class="pull-left">काम गरेको भए सोको विवरण
        </h1>
    </section>
@if (count($data)>0)

@foreach ($data as $item)
    
<form action="{{route('page_6_submit')}}" method="POST">
    @csrf
<div class="row">
    <div class="form-group col-md-12">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">कार्यालयको नाम र ठेगाना:  <i class="reqq">*</i></span></div>
            <input type="text" id="office_name_address" name="office_name_address" class="form-control" value="{{isset($item->office_name_address) ? $item->office_name_address: '' }}"  required>
        </div>
    </div>
  
    
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">सेवा: </span> </div>
            <select id="service" name="service" class="form-control select2">
                @if (isset($item->service))
                    @foreach ($services as $data)
                        @if ($item->service==$data->id)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                    @foreach ($services as $data)
                        @if ($item->service!=$data->id)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                @else
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                @foreach ($services as $data)
                    @if ($item->service!=$data->id)
                        <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                    @endif
                 @endforeach
                @endif
               
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">समूह: </span> </div>
            <select id="office_group" name="office_group" class="form-control select2">
                @if (isset($item->office_group))
                    @foreach ($officeGroups as $data)
                        @if ($item->office_group==$data->id)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                    @foreach ($officeGroups as $data)
                        @if ($item->office_group!=$data->id)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                @else
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                    @foreach ($officeGroups as $data)
                        @if ($item->office_group!=$data->id)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                @endif
               
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">श्रेणी/तह: </span> </div>
            <select id="level" name="level" class="form-control select2">
                @if (isset($item->level))
                    @foreach ($levels as $data)
                        @if ($data->id==$item->level)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                    @foreach ($levels as $data)
                        @if ($data->id!=$item->level)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                @else
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                    @foreach ($levels as $data)
                    <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">पद: </span> </div>
            <select id="position" name="position" class="form-control select2">
                @if(isset($item->position))
                    @foreach ($positions as $data)
                        @if ($data->id==$item->position)
                            <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                        @endif
                    @endforeach
                    @foreach ($positions as $data)
                    @if ($data->id!=$item->position)
                        <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                    @endif
                @endforeach
                @else
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                    @foreach ($positions as $data)
                        <option value="{{$data->id}}" data-eng="">{{$data->name}}</option>
                    @endforeach

                @endif
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">लोक सेवा आयोगको सिफारिश हुँदा कुन वर्गमा भएको हो ? </span> </div>
            @if (isset($item->technical))
                 @if ($item->technical==0)
                    <div class="input-group-text">
                        <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="0" checked> अप्राविधिक
                    </div>
                    <div class="input-group-text">
                        <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="1" >  प्राविधिक 
                    </div>
                @else   
                    <div class="input-group-text">
                        <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="0" > अप्राविधिक
                    </div>
                    <div class="input-group-text">
                        <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="1" checked>  प्राविधिक 
                    </div>
                @endif
            @else
                <div class="input-group-text">
                    <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="0" > अप्राविधिक
                </div>
                <div class="input-group-text">
                    <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="1" >  प्राविधिक 
                </div>
            @endif

        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">छाडेको मिति: </span></div>
            <input type="text" id="leave_date" name="leave_date" class="form-control" value="{{isset($item->leave_date) ? $item->leave_date: '' }}" required>
        </div>
    </div>
    <div class="form-group col-md-12">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">छाड्नुको कारण: <i class="reqq">*</i></span></div>
            <input type="text" id="leave_reason" name="leave_reason" class="form-control" value="{{isset($item->leave_reason) ? $item->leave_reason : ''}}"  required>
        </div>
    </div>
    
</div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Save & Next</button>
</div>
</form>
@endforeach
@else
<form action="{{route('page_6_submit')}}" method="POST">
    @csrf
<div class="row">
    <div class="form-group col-md-12">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">कार्यालयको नाम र ठेगाना:  <i class="reqq">*</i></span></div>
            <input type="text" id="office_name_address" name="office_name_address" class="form-control"  required>
        </div>
    </div>


    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">सेवा: </span> </div>
            <select id="service" name="service" class="form-control select2">
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                @foreach ($services as $item)
                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">समूह: </span> </div>
            <select id="office_group" name="office_group" class="form-control select2">
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                @foreach ($officeGroups as $item)
                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">श्रेणी/तह: </span> </div>
            <select id="level" name="level" class="form-control select2">
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                @foreach ($levels as $item)
                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">पद: </span> </div>
            <select id="position" name="position" class="form-control select2">
                <option value="" data-eng="">चयन गर्नुहोस्</option>
                @foreach ($positions as $item)
                <option value="{{$item->id}}" data-eng="">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">लोक सेवा आयोगको सिफारिश हुँदा कुन वर्गमा भएको हो ? </span> </div>
            <div class="input-group-text">
            <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="0"> अप्राविधिक
            </div>
            <div class="input-group-text">
                <input class="same" name="technical" type="radio" aria-label="Radio button for following text input" value="1">  प्राविधिक
                </div>

        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text">छाडेको मिति: </span></div>
            <input type="text" id="leave_date" name="leave_date" class="form-control" value="" required>
        </div>
    </div>
    <div class="form-group col-md-12">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">छाड्नुको कारण: <i class="reqq">*</i></span></div>
            <input type="text" id="leave_reason" name="leave_reason" class="form-control"  required>
        </div>
    </div>

</div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Save & Next</button>
</div>
</form>
@endif


@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
            $('#leave_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
    </script>
@endsection
