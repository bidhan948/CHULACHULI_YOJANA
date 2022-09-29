@extends('layout.layout')
@section('sidebar')
    @include('layout.nagadi_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">नगदी रसिद रिपोर्ट</h3>

            </div>
            <!-- /.card-header -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('nagadi-rasid-report', $report_type) }}" method="post">
                <div class="card-body">
                    <div class="row">
                        @csrf
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">आर्थिक वर्ष</span>
                                    </div>
                                    <select class="form-control" id="fiscal_year">
                                        <option value="">छान्नुहोस्</option>
                                        @foreach ($fiscal_years as $year)
                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            @if ($report_type == 'mashik_report')
                                                देखि
                                            @endif मिति
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="from_date_nep" id="from_date_nep"
                                        value="{{$from_date_nep}}" autocomplete="off">
                                    <input type="hidden" name="from_date_eng" id="from_date_eng" value="{{$from_date}}">

                                </div>
                            </div>
                        </div>
                        @if ($report_type == 'mashik_report')
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">सम्म मिति</span>
                                        </div>
                                        <input type="text" class="form-control" name="to_date_nep" id="to_date_nep"
                                        value="{{$to_date_nep}}" autocomplete="off">
                                        <input type="hidden" name="to_date_eng" id="to_date_eng" value="{{$to_date}}">
                                        @error('to_date')
                                            <strong> {{ $message }} </strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-2">
                            <button class="btn btn-danger"><i class="fa fa-search"></i> खोज्नुहोस </button>
                        </div>
                    </div>

                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-body">
                <table class="table table-stripe table-bordered">
                    <thead>
                        <tr>
                            <th>सि.नं</th>
                            <th>आम्दानी शिर्षक</th>
                            <th>शिर्षक नं </th>
                            <th>मुल्य रु</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $total = 0;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ Nepali($i) }}</td>
                                <td>{{ $item->main_sirsak_name }}</td>
                                <td>{{ Nepali($item->sirsak_number) }}</td>
                                <td>{{ NepaliAmount($item->total) }}</td>
                                <td><a href="" class="btn btn-warning">विवरण हेर्नुहोस</a></td>
                            </tr>
                            @php
                                $i++;
                                $total += $item->total;
                            @endphp
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right"> जम्मा </td>
                            <td colspan="2" align="left">{{ NepaliAmount($total) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script>
        $('#from_date_nep').nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 70,
            readOnlyInput: true,
            ndpTriggerButton: false,
            ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
            ndpTriggerButtonClass: 'btn btn-primary',
            onChange: function(e) {
                $('#from_date_eng').val(e.ad);
            }
        });
        @if ($report_type == 'mashik_report')
            $('#to_date_nep').nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 70,
            readOnlyInput: true,
            ndpTriggerButton: false,
            ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
            ndpTriggerButtonClass: 'btn btn-primary',
            onChange: function(e) {
            $('#to_date_eng').val(e.ad);
            }
            });
        @endif
    </script>
@endsection
