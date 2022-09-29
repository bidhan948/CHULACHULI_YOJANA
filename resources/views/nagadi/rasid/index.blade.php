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
    @include('nagadi.rasid.cancel');
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">नगदी रसिद</h3>

                <a href="{{ route('nagadi-rasid-create') }}" class="float-right btn btn-warning btn-sm">
                    <i class="fa fa-plus"></i> रसिद काटनुहोस्
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
                                <th>आर्थिक वर्ष</th>
                                <th> मिति </th>
                                <th>करदाताको नाम.</th>
                                <th>रशिद.</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ Nepali($item->fiscal_year->name) }}</td>
                                    <td>{{ Nepali($item->date_nep) }}</td>
                                    <td>{{ $item->customer_name }}</td>
                                    <td>{{ $item->bill_no }}</td>
                                    <td>

                                        @if ($item->fiscal_year->is_current)
                                            <button onclick="onCancel({{ $item }})" class="btn btn-danger btn-sm">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
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

    @yield('cancel_nagadi_rasid_scripts')
    <script>
        window.addEventListener("cancel_nagadi_rasids_added", function(evt) {
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

        function onCancel(item) {
            console.log(item);
            $('#cancel_nagadi_rasid_id').val(item.id);
            $('#cancel_nagadi_rasid_fiscal_year').html(convertToNepaliString(item.fiscal_year.name, '/'));
            $('#cancel_nagadi_rasid_bill_no').html(convertToNepaliDigit(item.bill_no));
            $('#cancel_nagadi_rasid_date_nep').html(convertToNepaliString(item.date_nep, '-'));
            $('#cancel_nagadi_rasid_customer_name').html(item.customer_name);
            toggleCancelNagadi();
        }
    </script>
@endsection
