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
    @include('malpot.setting.land_rate_create', [
        'land_area_types' => $land_area_types,
        'land_category_types' => $land_category_types,
        'land_types' => $land_types
    ])
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">मालपोतकरको सुची</h3>

                <button onclick="onAdd()" class="float-right btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>थप्नुहोस
                </button>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row"></div>
                <div class="row">
                    <table id="table1" width="100%" class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>जग्गाको क्षेत्रगत किसिम</th>
                                <th>जग्गाको बर्गिकरण</th>
                                <th>जग्गाको श्रेणी</th>
                                <th>मालपोत दर रु.</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->land_area_type_name }}</td>
                                    <td>{{ $item->land_category_type_name }}</td>
                                    <td>{{ $item->land_type_name }}</td>
                                    <td>{{ Nepali($item->rate) }}</td>
                                    <td>
                                        <button onclick="onEdit({{ $item }})" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
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
    @yield('land_rate_scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            window.addEventListener("land_rate_added", function(evt) {
                location.reload();
            }, false);
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

        const toggleLandRateModal = () => {
            $('.land_rate_modal').modal('toggle');
        }

        const onAdd = () => {
            $('#land_rate_id').val('');
            $('#setting_land_area_type_id').val('');
            $('#setting_land_category_type_id').val('');
            $('#setting_land_type_id').val('');
            $('#setting_rate').val('');
            $('#land_rate_header').html('मालपोतकरको रेट थप्नुहोस');
            toggleLandRateModal();
        }

        const onEdit = (item) => {
            $('#land_rate_id').val(item.id);
            $('#setting_old_ward').val(item.old_ward);
            $('#setting_old_vdc_mp').val(item.old_vdc_mp);
            $('#setting_new_ward').val(item.new_ward);
            $('#setting_new_vdc_mp').val(item.new_vdc_mp);
            $('#land_rate_header').html('मालपोतकरको रेट सच्याउनुहोस');
            toggleLandRateModal();
        }
    </script>
@endsection
