@extends('layout.layout')
@section('sidebar')
    @include('layout.malpot_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">जग्गाधनी प्रोफाईल थप्नुहोस</h3>
        </div>
        <form method="post" action="{{ route('land_profile_store') }}">
            @csrf
            <!-- /.card-header -->
            <div class="card-body">


                @include('malpot.profile._land_owner_details')
                @include('malpot.profile._land_owner_address', ['provinces' => $provinces])
                <div class="card">
                    <div class="card-header">
                        विवरण दाखिला गर्नेको विवरण
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">नाम/थर *: </span></div>
                                    <input type="text" name="dakhila_name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">प्रदेश*: </span></div>
                                    <select id="dakhila_province" name="dakhila_province" class="form-control"
                                        required="">
                                        <option value="">छान्नुहोस्</option>
                                        @foreach ($provinces as $p)
                                            <option value="{{ $p->id }}">{{ $p->nep_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">जिल्ला*: </span></div>
                                    <select id="dakhila_district" name="dakhila_district" class="form-control"
                                        required="">
                                        <option value="">छान्नुहोस्</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">गा.पा/न.पा*: </span>
                                    </div>
                                    <select id="dakhila_municipality" name="dakhila_municipality" class="form-control"
                                        required="">
                                        <option value="">छान्नुहोस्</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">वडा नं **: </span></div>
                                    <select id="dakhila_ward" name="dakhila_ward" class="form-control" required="">
                                        <option value="">छान्नुहोस्</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">जग्गाधनी संगको नाता * :
                                        </span></div>
                                    <select name="dakhila_relation" class="form-control" id="dakhila_relation"
                                        required="">
                                        <option value="">छान्नुहोस् </option>
                                        @foreach (get_setting(config('SLUG.setup_relations')) as $nationality)
                                        <option value="{{ $nationality->id }}">{{ $nationality->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">मिति: </span></div>
                                    <input type="text" id="dakhila_date_nep" name="dakhila_date_nep" class="form-control">
                                    <input type="hidden" id="dakhila_date_eng" name="dakhila_date_eng">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">सेव गर्नुहोस</button>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    {
        <script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    @yield('land_owner_address_scripts')
    @yield('land_owner_detail_scripts')
    @include('shared.script.address', [
        'district' => 'dakhila_district',
        'province' => 'dakhila_province',
        'municipality' => 'dakhila_municipality',
        'ward' => 'dakhila_ward',
    ])
    }
    <script>
         $('#dakhila_date_nep').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
                onChange: function(e) {
                    $('#dakhila_date_eng').val(e.ad);
                }
            });
    </script>
@endsection
