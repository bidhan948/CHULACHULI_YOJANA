@extends('layout.layout')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection
@section('content')

@if (count($data)>0)

@foreach ($data as $item)
    
<div class="card px-4 py-4 mt-4">
    <section class="content-header">
        <h1 class="pull-left">अन्य विवरण
        </h1>
    </section>
        <div class="row">
                <form method="post" enctype="multipart/form-data" action="{{route('page_7_submit')}}">
                    @csrf
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">(क) बहु विवाह / बाल विवाह गरेको </div>
                                            @if (isset($item->poly_marriage))
                                            <div class="input-group-text ml-2">
                                                @if ($item->poly_marriage==1)
                                                    <input class="same" name="poly_marriage" type="radio" aria-label="Radio button for following text input" value="1" checked> छ
                                                    <input class="same" name="poly_marriage" type="radio" aria-label="Radio button for following text input" value="0"> छैन

                                                </div>
                                                @else
                                                    <div class="input-group-text ml-2">
                                                    <input class="same" name="poly_marriage" type="radio" aria-label="Radio button for following text input" value="1" > छ
                                                        <input class="same" name="poly_marriage" type="radio" aria-label="Radio button for following text input" value="0" checked> छैन
                                                    </div>
                                                @endif

                                            @else
                                            <div class="input-group-text ml-2">
                                                <input class="same" name="poly_marriage" type="radio" aria-label="Radio button for following text input" value="1"> छ
                                                </div>
                                                <div class="input-group-text ml-2">
                                                    <input class="same" name="poly_marriage" type="radio" aria-label="Radio button for following text input" value="0"> छैन
                                                    </div>
                                            @endif

                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group" id="poly_marriage_y">
                                            <div class="input-group-prepend"><span class="input-group-text">छ भने पत्नीको नाम लेखुहोस् </div>
                                            <input type="text" id="poly_spouse_name" name="poly_spouse_name" value="{{isset($item->poly_spouse_name) ? $item->poly_spouse_name : '' }}" class="form-control"  >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">(ख) पति वा पत्नीले विदेशी मुलुलको स्थायी आवासीय अनुमति (DV/PR वा अन्य ) लिए / नलिएको वा सोको लागि दरखास्त दिए / नदिएको विवरण :</div>

                                            @if (isset($item->foreign_spouse_apply))
                                                @if ($item->foreign_spouse_apply==1)
                                                <div class="input-group-text ml-2">
                                                    <input class="same" name="foreign_spouse_apply" type="radio" aria-label="Radio button for following text input" value="1" checked> छ
                                                    </div>
                                                    <div class="input-group-text ml-2">
                                                        <input class="same" name="foreign_spouse_apply" type="radio" aria-label="Radio button for following text input" value="0"> छैन
                                                        </div>
                                                @else
                                                <div class="input-group-text ml-2">
                                                    <input class="same" name="foreign_spouse_apply" type="radio" aria-label="Radio button for following text input" value="1" > छ
                                                    </div>
                                                    <div class="input-group-text ml-2">
                                                        <input class="same" name="foreign_spouse_apply" type="radio" aria-label="Radio button for following text input" value="0" checked> छैन
                                                        </div>
                                                @endif
                                                
                                            @else
                                            <div class="input-group-text ml-2">
                                                <input class="same" name="foreign_spouse_apply" type="radio" aria-label="Radio button for following text input" value="1"> छ
                                                </div>
                                                <div class="input-group-text ml-2">
                                                    <input class="same" name="foreign_spouse_apply" type="radio" aria-label="Radio button for following text input" value="0"> छैन
                                                    </div>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend" style="padding-left: 20px;"><span class="input-group-text">१. स्थायी आवासीय अनुमति लिएको भए देशको नाम : <i> </i></div>
                                            <select id="fa_country" name="fa_country" class="form-control select2">
                                                @if (isset($item->fa_country))
                                                    @foreach ($countries as $key=> $value)
                                                        @if ($item->fa_country==$key)
                                                        <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($countries as $key=> $value)
                                                    @if ($item->fa_country!=$key)
                                                    <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                    @endif
                                                @endforeach
                                                @else
                                                    <option value="" data-eng="">चयन गर्नुहोस्</option>
                                                    @foreach ($countries as $key=> $value)
                                                        <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                    @endforeach
                                                @endif
                                                
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">र लिएको मिति: <i class="reqq"></i></div>
                                            {{-- <input type="text" id="fa_date" name="fa_date" class="form-control nepaliDate"> --}}
                                             <input type="text" id="fa_date" name="fa_date" class="form-control" value="{{isset($item->fa_date) ? $item->fa_date : '' }}" >

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend" style="padding-left: 20px;"><span class="input-group-text">२. स्थायी आवासीय अनुमतिका लागि दरखास्त दिएको भए देशको नाम:   <i class="reqq"></i></div>
                                            <select id="fa2_country" name="fa2_country" class="form-control select2">
                                                @if (isset($item->fa2_country))
                                                @foreach ($countries as $key=> $value)
                                                    @if ($item->fa2_country==$key)
                                                    <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                    @endif
                                                @endforeach
                                                @foreach ($countries as $key=> $value)
                                                @if ($item->fa2_country!=$key)
                                                <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                @endif
                                            @endforeach
                                            @else
                                                <option value="" data-eng="">चयन गर्नुहोस्</option>
                                                @foreach ($countries as $key=> $value)
                                                    <option value="{{$key}}" data-eng="">{{$value}}</option>
                                                @endforeach
                                            @endif
                                               
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                    <div class="form-group col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">दरखास्त दिएको मिति:  <i class="reqq"></i> </div>
                                            <input type="text" id="fa2_date" name="fa2_date" class="form-control" value="{{isset($item->fa2_date) ? $item->fa2_date : '' }}" >
                                        </div>
                                    </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">(ग) कुनै सरकारी बक्यौता तिर्न बाँकी </div>
                                            @if (isset($item->loan))
                                                @if ($item->loan==1)
                                                <div class="input-group-text ml-2">
                                                
                                                    <input type="radio" name="loan" value="1" checked> छ
                                                    </div>
                                                    <div class="input-group-text ml-2">
                                                    <input type="radio" name="loan" value="0" > छैन
                                                        </div>
                                                @else
                                                <div class="input-group-text ml-2">
                                                
                                                    <input type="radio" name="loan" value="1" > छ
                                                    </div>
                                                    <div class="input-group-text ml-2">
                                                    <input type="radio" name="loan" value="0" checked> छैन
                                                        </div>
                                                @endif

                                                @else
                                           
                                                <div class="input-group-text ml-2">
                                                
                                                    <input type="radio" name="loan" value="1" > छ
                                                    </div>
                                                    <div class="input-group-text ml-2">
                                                    <input type="radio" name="loan" value="0" > छैन
                                                        </div>
                                            @endif
                                          
                                           
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group" id="load_y">
                                            <div class="input-group-prepend"><span class="input-group-text">बाँकी भए सोको विवरण </div>
                                            <input type="text" id="loan_detail" name="loan_detail" value="{{isset($item->loan_detail) ? $item->loan_detail : ''}}" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend"><span class="input-group-text">सम्बन्धित कर्मचारीको बिशेष योग्यता र क्षमताः <i class="reqq">*</i></div>
                                            <input type="text" id="qualification" name="qualification" value="{{isset($item->qualification) ? $item->qualification : ''}}"  class="form-control" >
                                            @error('qualification')
                                            <strong style="margin-left: 2%"> {{$message}}* </strong>
                                            @enderror
                                        </div>
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

        @endforeach
        @endif

<!-- /.row -->
<!-- /.content -->

@endsection

@section('scripts')
<script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
            $('#fa_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
            });
    </script>
    <script>
        $('#fa2_date').nepaliDatePicker({
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
