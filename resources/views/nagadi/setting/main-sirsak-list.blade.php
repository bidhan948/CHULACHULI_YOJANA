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
    @include('nagadi.setting.main-sirsak-create')
    @include('nagadi.setting.upa-sirsak-create')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">शिर्षक</h3>
                {{-- <button onclick="onAdd()" class="float-right btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>मुख्य शिर्षक थप्नुहोस
                </button> --}}
                <a href="{{ route('nagadi-dar.create') }}" class="float-right btn btn-warning btn-sm">
                    <i class="fa fa-plus"></i> दर थप्नुहोस
                </a>
                {{-- <a href="{{ route('nagadi-dar.create') }}" class="float-right btn btn-secondary btn-sm">
                    <i class="fa fa-plus"></i> दरको लिस्ट हेर्नुहोस </a> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row"></div>
                <div class="row">
                    <table id="table1" width="100%" class="table table-bordered table-sm">

                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td colspan="2"><b>{{ $item->name }}</b></td>
                                </tr>
                                @php
                                    $j = 1;
                                @endphp
                                @foreach ($item->categories as $category)
                                    <tr>
                                        <td class="text-center">{{ $i.'.'.$j }}</td>
                                        <td class="text-center">{{ $category->name }}</td>
                                        <td class="text-center">
                                            @if ($category->has_child)
                                                <table class="table table-bordered table-sm">
                                                    @foreach ($category->categories as $sub_cat)
                                                        <tr>
                                                            <td> {{ $sub_cat->name }}</td>
                                                            <td> {{ $sub_cat->rate }}&nbsp;&nbsp;
                                                                {{ RateType($sub_cat->rate_type) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @else
                                                {{ $category->rate }}&nbsp;&nbsp; {{ RateType($category->rate_type) }}
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                      $j += 1;
                                    @endphp
                                @endforeach
                                @php
                                $i += 1;
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
    @yield('main_sirsak_scripts')
    @yield('upa_sirsak_scripts')
    <script>
        window.addEventListener("main_sirsaks_added", function(evt) {
            location.reload();
        }, false);

        window.addEventListener("upa_sirsaks_added", function(evt) {
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

        const toggleMainSirsakModal = () => {
            $('.main_sirsak_modal').modal('toggle');
        }
        const toggleUpaSirsakModal = () => {
            $('.upa_sirsak_modal').modal('toggle');
        }

        const onAdd = () => {
            $('#main_sirsak_id').val('');
            $('#main_sirsak_name').val('');
            $('#main_sirsak_number').val('');
            $('#main_sirsak_header').html('थप्नुहोस');
            toggleMainSirsakModal();
        }

        const onAddUpa = (item) => {
            console.log(item);
            $('#main_sirsak_id_readonly').val(item.id);
            $('#main_sirsak_name_readonly').val(item.name);
            $('#upa_sirsak_name').val('');
            $('#upa_sirsak_id').val('');
            $('#upa_sirsak_header').html('थप्नुहोस');
            toggleUpaSirsakModal();
        }

        const onEditUpa = (upa, item) => {
            $('#main_sirsak_id_readonly').val(item.id);
            $('#main_sirsak_name_readonly').val(item.name);
            $('#upa_sirsak_id').val(upa.id);
            $('#upa_sirsak_name').val(upa.name);
            $('#upa_sirsak_header').html('सच्याउनुहोस');
            toggleUpaSirsakModal();
        }
        const onEdit = (item) => {
            $('#main_sirsak_id').val(item.id);
            $('#main_sirsak_name').val(item.name);
            $('#main_sirsak_number').val(item.topic_number);
            $('#main_sirsak_header').html('सच्याउनुहोस');
            toggleMainSirsakModal();
        }
    </script>
@endsection
