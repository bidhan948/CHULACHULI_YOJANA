@extends('layout.layout')
@section('sidebar')
    @include('layout.malpot_sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('land_detail_store') }}">
            @csrf
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">रसिद काट्नुहोस्</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 ">
                            <!-- <h4>उद्योगहरु अभिलेख</h4> -->
                            <p class="alert alert-primary"><b>
                                क्र.स नम्बर: {{Nepali($land_owner_data->sn)}} <br>
                                {{$land_owner_data->land_ownership_type=='single'?'जग्गाधनिको नाम':'संस्थाको नाम'}}: {{$land_owner_data->name}}<br>
                                </b>
                            </p>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <!-- <h4>उद्योगहरु अभिलेख</h4> -->
                            <p class="alert alert-primary"><b>
                                    दर्ता न: {{Nepali($land_owner_data->id)}} <br>
                                    पान न: {{Nepali($land_owner_data->pan_number)}}<br>
                                </b>
                            </p>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <!-- <h4>उद्योगहरु अभिलेख</h4> -->
                            <p class="alert alert-primary"><b>
                                दर्ता गरिएको वडा नं: {{Nepali($land_owner_data->land_ward_no)}}<br>
                                </b>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table-sm table table-bordered table-responsive" tabindex="1"
                            style="overflow: hidden; outline: none;">
                            <thead>
                                <tr>
                                    <th rowspan="2">क्र.सं</th>
                                    <th colspan="6" class="text-center">जग्गाको विवरण</th>
                                    <th rowspan="2" style="width:180px;">मालपोत कर</th>
                                </tr>
                                <tr>
                                    <th style="width:180px;">साबिक गा.पा/न.पा</th>
                                    <th style="width:180px;">हालको वडा</th>
                                    <th style="width:180px;">नक्सा नं</th>
                                    <th style="width:180px;">कित्ता नं</th>
                                    <th style="width:180px;">क्षेत्रफल({{config('constant.BIGGA')}})</th>
                                    <th style="width:180px;">मालपोत दर रु.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($land_details as $key => $land_detail)
                                    <tr>
                                        <td style="width: 180px">{{Nepali($key + 1)}}</td>
                                        <td>{{ $land_detail->old_vdc_mp . '-' . Nepali($land_detail->old_ward) }}</td>
                                        <td>{{ $land_detail->new_vdc_mp . '-' . Nepali($land_detail->new_ward) }}</td>
                                        <td>{{ $land_detail->naksa_no }}</td>
                                        <td>{{ Nepali($land_detail->kitta_no) }}</td>
                                        <td>{{ Nepali($land_detail->bigha_ropani) . '-' . Nepali($land_detail->kattha_aana) . '-' . Nepali($land_detail->dhur_paisa) . '-' . Nepali($land_detail->kanwa_dam) }}<br>
                                            {{ config('constant.BIGGA_SMALL') . '-' . config('constant.KATTHA_SMALL') . '-' . config('constant.DHUR_SMALL') . '-' . config('constant.KANUA_SMALL') }}
                                        </td>
                                        <td>
                                           {{NepaliAmount($land_detail->rate)}}
                                        </td>
                                        <td>
                                           {{NepaliAmount($land_detail->rate)}}
                                        </td>
                                    </tr>
                                    @php
                                        $total += $land_detail->rate;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-right">जम्मा</td>

                                    <td colspan="">{{NepaliAmount($total)}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="alert alert-danger">नोटः माथि उल्लेखित दरमा न्यूनतम शुल्क रु २०/- लाग्नेछ । </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">मालपोत कर*: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="{{ $total }}" readonly>
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">जम्मा कर मूल्य*: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="20" readonly>
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">रसिद नम्बर.*: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="{{ old('new_ward') }}">
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">अन्य सेवा शुल्क रु.: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="{{ old('new_ward') }}">
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">छुट रकम रु.: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="{{ old('new_ward') }}">
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">जरिवाना रकम रु.: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="{{ old('new_ward') }}">
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">बक्यौता रकम रु.*: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="{{ old('new_ward') }}">
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">कुल जम्मा रु.*: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="{{ old('new_ward') }}">
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">लिईएको रकम रु.*: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="{{ old('new_ward') }}">
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">फिर्ता रकम रु.: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="{{ old('new_ward') }}">
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">बाँकी रकम रु.: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="{{ old('new_ward') }}">
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">बाँकी रकम रु.: </span>
                                </div>
                                <textarea type="text" name="new_ward" id="new_ward" class="form-control"
                                    value="{{ old('new_ward') }}"></textarea>
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
