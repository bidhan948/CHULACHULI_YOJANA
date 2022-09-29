@section('title', 'सङ्ख्यात्मक रिपोर्ट')
@section('report_numerical', 'active')
@section('child_report', 'menu-open')
@extends('layout.layout')
@section('sidebar')

    @if (session('active_app') == 'pis')
        @include('layout.pis_sidebar')
    @endif
    @if (session('active_app') == 'yojana')
        @include('layout.yojana_sidebar')
    @endif
    @if (session('active_app') == 'nagadi')
        @include('layout.yojana_sidebar')
    @endif
    @if (session('active_app') == 'byabasaye')
        @include('layout.byabasaye_sidebar')
    @endif
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">{{ __('सङ्ख्यात्मक रिपोर्ट :') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('किसिम :') }}<span id="name_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <select name="type_id" id="type_id" class="form-control form-control-sm">
                                    @foreach (config('YOJANA.TYPE') as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('वडा छान्नुहोस् :') }}<span id="name_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <select name="ward_no" id="ward_no" class="form-control form-control-sm">
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    @for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++)
                                        <option value="{{ $i }}">{{ $i == 0 ? 'गाउँपालिका' : Nepali($i) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-sm btn-primary" id="search"><i
                                class="fa-solid fa-magnifying-glass px-1"></i>{{ __('खोज्नुहोस्') }}</button>
                    </div>
                </div>
            </div>
            <div class="my-2">
                <table id="table" width="100%" class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center font-weight-bold">{{ __('योजना रिपोर्ट') }}</td>
                            <td class="text-center font-weight-bold">{{ __('जम्मा योजना') }}</td>
                            <td class="text-center font-weight-bold">{{ __('जम्मा अनुदान') }}</td>
                            <td class="text-center font-weight-bold">{{ __('हाल सम्मको खर्च') }}</td>
                            <td class="text-center font-weight-bold">{{ __('बाँकी रकम') }}</td>
                            <td class="text-center font-weight-bold">{{ __('विवरण हेर्नुहोस') }}</td>
                        </tr>
                    </thead>
                    <tbody id="reportBody">
                       
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
@endsection



@section('scripts')
    <script>
        $(function() {
            $("#table").css("display", "none");
            $("#search").on("click", function() {
                var type_id = $("#type_id").val();
                var ward_no = $("#ward_no").val();

                axios.get("{{ route('report.generateNumericReport') }}", {
                    params: {
                        type_id: type_id,
                        ward_no: ward_no,
                    }
                }).then(function(response) {
                    $("#table").css("display", "");
                    console.log(response.data);
                    $("#reportBody").html(response.data);
                }).catch(function(error) {
                    console.log(error);
                    alert("Something went wrong");
                });
            });
        });
    </script>
@endsection
