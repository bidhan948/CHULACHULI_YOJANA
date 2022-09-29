@section('title', $anugaman_samiti->name . 'को विवरण')
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
                    <div class="col-6 mt-2">
                        <h3 class="card-title">{{ __('अनुगमन समिति सम्बन्धी विवरण') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('anugaman-samiti.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward pr-2"></i><span>{{ __('पछी जानुहोस्') }}</span></a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                        <p class="text-center " style="font-size: 1rem;">अनुगमन समितीको नाम: <span
                                class="font-weight-bold px-1">{{ $anugaman_samiti->name }}</span></p>
                        <p class="text-center" style="font-size: 1rem;">अनुगमन समितिको ठेगाना: <span
                                class="font-weight-bold px-1">{{ config('constant.SITE_NAME') }}{{ ' ' . Nepali($anugaman_samiti->ward_no) }}</span>
                        </p>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('सि.नं.') }}</th>
                                    <th class="text-center">{{ __('पद') }}</th>
                                    <th class="text-center">{{ __('नाम/ थर') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anugaman_samiti->anugamanSamitiDetails as $key => $anugaman_samiti_detail)
                                    <tr>
                                        <td class="text-center">{{ Nepali($key + 1) }}</td>
                                        <td class="text-center">
                                            {{ getSettingValueById($anugaman_samiti_detail->post_id)->name }}</td>
                                        <td class="text-center">
                                            {{ $anugaman_samiti_detail->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
