@extends('layout.layout')
@section('sidebar')
    @include('layout.malpot_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
    @include('malpot.setting.haal_sabik_create')
    <div class="container-fluid">
        <div class="card ">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <section class="card">
                            <header class="card-header">
                                <div class="mail-option">
                                    <div class="btn-group hidden-phone">
                                        <input type="text" class="form-control" id="kitta_no" placeholder="कि.नं"
                                            style="width: 270px;">
                                    </div>
                                    <div class="btn-group hidden-phone">
                                        <div class="">
                                            <button type="button" class="btn btn-warning" title="खोजी गर्नुहोस्"
                                                id="filter"><i class="fa fa-search"></i> खोजी गर्नुहोस्</button>
                                        </div>
                                    </div>
                                    <div class="float-right position">
                                        <a class="btn btn-primary "
                                            href="{{route('land_detail_add', ['land_owner_id' => $land_owner_id])}}"
                                            style="color:#FFF;margin-top: 2px;"><i class="fa  fa-plus-circle"></i> नयाँ
                                            थप्नुहोस् </a>

                                        <a class="btn btn-warning "
                                            href="#"
                                            target="_blank" style="color:#FFF;margin-top: 2px;"><i
                                                class="fa fa-file-text"></i> रशिद काट्नुहोस </a>
                                    </div>
                                </div>

                            </header>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4 ">
                                        <!-- <h4>उद्योगहरु अभिलेख</h4> -->
                                        <p class="alert alert-primary"><b>
                                                क्र.स नम्बर: {{Nepali($land_owner_data->sn)}} <br>
                                                जग्गाधनिको नाम: {{$land_owner_data->name}}<br>
                                                दर्ता गरिएको वडा नं: {{Nepali($land_owner_data->land_ward_no)}}<br>
                                            </b>
                                        </p>
                                    </div>
                                </div>

                                <br>
                                <!-- <div class="table-responsive"> -->
                                <table class="table table-bordered table-stripe print_table" id="listtable">
                                    <thead style="background:#1b5693;color:#fff">
                                        <tr>
                                            <th>#</th>
                                            <th>कि.नं</th>
                                            <th>न.न</th>
                                            <th>साबिक</th>
                                            <th>हाल</th>
                                            <th> जग्गाको क्षेत्रगत किसिम</th>
                                            <th>जग्गाको वर्गीकरण</th>
                                            <th>जग्गाको श्रेणी</th>
                                            <th>क्षेत्रफल</th>
                                            <th>क्षेत्रफल वर्ग मिटर</th>
                                            <th>कर ?</th>
                                            <th>सम्पादन कार्य</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($land_details as $key => $land_detail)
                                        <tr>
                                            <td>{{Nepali($key + 1)}}</td>
                                            <td>{{Nepali($land_detail->kitta_no)}}</td>
                                            <td>{{$land_detail->naksa_no}}</td>
                                            <td>{{$land_detail->old_vdc_mp .'-'. Nepali($land_detail->old_ward)}}</td>
                                            <td>{{$land_detail->new_vdc_mp .'-'. Nepali($land_detail->new_ward)}}</td>
                                            <td>{{$land_detail->land_area_type_name}}</td>
                                            <td>{{$land_detail->land_category_type_name}}</td>
                                            <td>{{$land_detail->land_type_name}}</td>
                                            <td>{{Nepali($land_detail->bigha_ropani).'-'.Nepali($land_detail->kattha_aana) .'-'.Nepali($land_detail->dhur_paisa) .'-'.Nepali($land_detail->kanwa_dam)}}<br>
                                                {{config('constant.BIGGA_SMALL') .'-'.config('constant.KATTHA_SMALL') .'-'.config('constant.DHUR_SMALL') .'-'.config('constant.KANUA_SMALL')}}
                                            </td>
                                            <td>{{Nepali($land_detail->meter_sq)}}&nbsp;<span style="font-size: 20px">&#13217;</span></td>
                                            <td>
                                                <p class="badge badge-success"><i class="fa fa-check-circle"></i></p>
                                            </td>
                                            <td>
                                                <p> कार्य उपलब्ध छैन</p>
                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts')
    <script></script>
@endsection
