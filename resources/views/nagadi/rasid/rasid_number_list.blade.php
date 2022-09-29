@extends('layout.layout')
@section('sidebar')
    @include('layout.nagadi_sidebar')
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
            <h3 class="card-title">नगदी रसिद</h3>

            <a href="{{ route('nagadi-rasid-create') }}" class="float-right btn btn-primary btn-sm" style="margin-left: 5px">
                <i class="fa fa-plus"></i> रसिद नम्बर थप्नुहोस
            </a>

            <a href="{{ route('nagadi-rasid-create') }}" class="float-right btn btn-warning btn-sm">
                <i class="fa fa-plus"></i> रसिद नम्बर ट्रान्सफर गर्नुहोस
            </a>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row"></div>
            <div class="row">
                <table id="table1" width="100%" class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>युजरको नाम</th>
                            <th>रसिद नम्बर </th>
                            <th>काटिएको रसिद नम्बर</th>
                            <th>बाकी रसिद नम्बर</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>

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
    <script>
        window.addEventListener("cancel_rasid_number", function(evt) {
            location.reload();
        }, false);
        window.addEventListener("transfer_rasid_number", function(evt) {
            location.reload();
        }, false);
        $(function() {
            $('#table1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#table1_wrapper').css("width", "100%");
        });

        const toggleCancelNagadi = () => {
            $('.cancel_nagadi_rasid_modal').modal('toggle');
        }


    </script>
@endsection
