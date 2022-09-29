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
            <div class="card-header">
                <h3 class="card-title">हाल साबिक</h3>

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
                                <th>साबिक वडा</th>
                                <th>साबिको नाम </th>
                                <th>हालको वडा</th>
                                <th>हालको नाम</th>
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
                                    <td>{{ Nepali($item->old_ward) }}</td>
                                    <td>{{ $item->old_vdc_mp }}</td>
                                    <td>{{ Nepali($item->new_ward) }}</td>
                                    <td>{{ $item->new_vdc_mp }}</td>
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
    @yield('haal_sabik_scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            window.addEventListener("haal_sabik_added", function(evt) {
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

        const toggleHaalSabikModal = () => {
            $('.haal_sabik_modal').modal('toggle');
        }

        const onAdd = () => {
            $('#haal_sabik_id').val('');
            $('#setting_old_ward').val('');
            $('#setting_old_vdc_mp').val('');
            $('#setting_new_ward').val('');
            $('#setting_new_vdc_mp').val('');
            $('#haal_sabik_header').html('हाल साबिक थप्नुहोस');
            toggleHaalSabikModal();
        }
        const onEdit = (item) => {
            $('#haal_sabik_id').val(item.id);
            $('#setting_old_ward').val(item.old_ward);
            $('#setting_old_vdc_mp').val(item.old_vdc_mp);
            $('#setting_new_ward').val(item.new_ward);
            $('#setting_new_vdc_mp').val(item.new_vdc_mp);
            $('#haal_sabik_header').html('हाल साबिक सच्याउनुहोस');
            toggleHaalSabikModal();
        }
    </script>
@endsection
