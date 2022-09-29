@section('title', $setting->name)
@section('child_setting', 'menu-open')
@section($setting->slug, 'active')
@section('title', $setting->name)
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
    @if (session('active_app') == 'malpot')
        @include('layout.malpot_sidebar')
    @endif
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    @include('shared.setting.create', ['setting' => $setting])
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">{{ $setting->name }}</h3>
                <button onclick="onAdd()" class="float-right btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row"></div>
                <div class="row">
                    <table id="table1" width="100%" class="table table-bordered">
                        <thead>
                            <tr>

                                @if (!empty($setting->cascading_parent_id))
                                    @php
                                        $p_set = \App\Models\SharedModel\Setting::where(['id' => $setting->cascading_parent_id])->first();
                                    @endphp
                                    <th class="text-center">{{ $p_set->name }}</th>
                                @endif
                                <th class="text-center">{{ $setting->name }}</th>
                                <th class="text-center">बर्णन</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($setting_values as $item)
                                <tr>

                                    @if (!empty($setting->cascading_parent_id))
                                        @php
                                            $p_set_val = \App\Models\SharedModel\SettingValue::where(['id' => $item->cascading_parent_id])->first();
                                        @endphp

                                        <td class="text-center">
                                            {{ $p_set_val->name }}
                                        </td>
                                    @endif
                                    <td class="text-center">
                                        {{ $item->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->note == null ? '---' : '' }}
                                    </td>
                                    <td class="text-center">
                                        <button onclick="onEdit({{ $item }})" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
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
    @yield('setting_scripts')
    <script>
        window.addEventListener(`{{ $setting->slug }}_added`, function(evt) {
            alert('डाटा हाल्न सफल भयो');
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

        const toggleBudgetSourceModal = () => {
            $('.setting_modal').modal('toggle');
        }

        const onAdd = () => {
            $('#setting_id').val();
            $('#setting_name').val('');
            $('#setting_note').val('');

            @if (!empty($setting->cascading_parent_id))
                $('#setting_cascading_parent_id').val('');
            @endif
            $('#setting_header').html('{{ $setting->name }}' + ' थप्नुहोस');
            toggleBudgetSourceModal();
        }

        const onEdit = (item) => {
            $('#setting_id').val(item.id);
            $('#setting_name').val(item.name);
            $('#setting_note').val(item.note);
            @if (!empty($setting->cascading_parent_id))
                $('#setting_cascading_parent_id').val(item.cascading_parent_id);
            @endif
            $('#setting_header').html('{{ $setting->name }}' + ' सच्याउनुहोस');
            toggleBudgetSourceModal();
        }
    </script>
@endsection
