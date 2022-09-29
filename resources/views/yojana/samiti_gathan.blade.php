@section('title', 'समिति गठन')
@section('tole_bikas_samiti', 'active')
@extends('layout.layout')
@section('sidebar')
    @include('layout.yojana_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">{{ __('समिति गठन') }}</h3>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ Nepali($tole_bikas_count) }}</h3>
                                <p>{{ __('टोल विकास समिति') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <a href="{{ route('tole-bikas-samiti.create') }}"
                                class="small-box-footer">{{ __('थप्नुहोस') }} <i class="fa-solid fa-plus px-1"></i></a>
                            <a href="{{ route('tole-bikas-samiti.index') }}"
                                class="small-box-footer">{{ __('हेर्नुहोस्') }} <i class="fa-solid fa-eye px-1"></i></a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ Nepali($anugaman_samiti_count) }}</h3>
                                <p>{{ __('अनुगमन समिति') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <a href="{{ route('anugaman-samiti.create') }}"
                                class="small-box-footer">{{ __('थप्नुहोस') }} <i class="fa-solid fa-plus px-1"></i></a>
                            <a href="{{ route('anugaman-samiti.index') }}"
                                class="small-box-footer">{{ __('हेर्नुहोस्') }} <i class="fa-solid fa-eye px-1"></i></a>
                        </div>
                    </div>
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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
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
    </script>
@endsection
