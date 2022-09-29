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
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">हाल साबिक</h3>

                <a href="{{ route('land_profile_add') }}" class="float-right btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>थप्नुहोस
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">

                        <select name="search_ward" id="search_ward" class="form-control form-control-sm">
                            <option value="">वडा नम्बर</option>
                            <option value="0">नगरपालिका</option>
                            @for ($i = 1; $i <= config('constant.TOTAL_WARDS'); $i++)
                            <option value="{{ $i }}">{{ Nepali($i) }}</option>
                        @endfor
                        </select>


                    </div>
                    <div class="form-group col-md-3">
                        <input type="button" value="खोज्नुहोस" id="submit" class="btn btn-success btn-flat btn-sm" name="submit">
                    </div>

                </div>
                <div class="row">
                    <table id="table1" class="table table-striped" style="width:100%;font-size: 14px;">
                        <thead>
                            <tr>
                                <th>सि.नं.</th>
                                <th>वडा नं</th>
                                <th>दर्ता.नं</th>
                                <th>जग्गाधनीको नाम</th>
                                <th>जग्गाधनीको क्र.स नम्बर</th>
                                <th>सम्पर्क फोन नं</th>
                                <th>#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#table1').DataTable({
                language: {
                    searchPlaceholder: "वडा नं/दर्ता.नं/जग्गाधनीको नाम/जग्गाधनीको क्र.स नम्बर/सम्पर्क फोन नं"
                },
                "processing": true, // processing indicator
                "serverSide": true, // DataTables' server-side processing mode
                "order": [], // Initial no order
                "iDisplayLength": 10,
                "searching": true,
                "language": {
                    "processing": "<i class=\"fa fa-spinner fa-spin fa-3x fa-fw\"></i><span class=\"sr-only\">Loading..n.</span>",
                },
                // Load data for table from Ajax source
                "ajax": {
                    "url": "{{ route('get_land_profile_list') }}",
                    "type": "GET",
                    "dataType": "json",
                    "data": function(data) {
                        data.ward = $('#search_ward').val() || '';
                    },
                    "dataSrc": function(jsonData) {
                        console.log(jsonData);
                        return jsonData.data;
                    }
                },
                // Set column definition initilization properties
                "columnDefs": [{
                        "defaultContent": "-",
                        "targets": "_all"
                    },
                    {
                        "targets": [0],
                        "data": "start",
                        "orderable": false,
                    },
                    {
                        "targets": [1],
                        "data": "land_ward_no",
                        "orderable": false,
                    },
                    {
                        "targets": [2],
                        "data": "id",
                        "orderable": false,
                    },
                    {
                        "targets": [3],
                        "data": "name",
                        "orderable": false,
                    },
                    {
                        "targets": [4],
                        "data": "sn",
                        "orderable": false,
                    },
                    {
                        "targets": [5],
                        "data": "contact",
                        "orderable": false,
                    },
                    {
                        "targets": [6], // last column
                        "data": "options",
                        "orderable": false, // set orderable
                    },
                ]
            });


            $(document).on("click", "#submit", function() {
                table.draw();
            });
            $('#table1_wrapper').css("width", "100%");
        });
    </script>
@endsection
