@section('title', 'अनुगमन समिति')
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
                    <div class="col-3">
                        <a href="{{ route('samiti-gathan.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                    <div class="col-6 text-right mt-2">
                        <h3 class="card-title" style="padding-left: 145px;">{{ __('अनुगमन समिति') }}</h3>
                    </div>
                    <div class="col-3 text-right">
                        <a href="{{ route('anugaman-samiti.create') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-plus nav-icon pr-2"></i>{{ __('थप्नुहोस') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table id="table1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('सि.नं.') }}</th>
                                    <th class="text-center">{{ __('अनुगमन समितिको नाम') }}</th>
                                    <th class="text-center">{{ __('अनुगमन समिति') }}</th>
                                    <th class="text-center">{{ __('वडा नं') }}</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anugaman_samitis as $key => $anugaman_samiti)
                                    <tr>
                                        <td class="text-center">{{ Nepali($key + 1) }}</td>
                                        <td class="text-center">{{ $anugaman_samiti->name }}</td>
                                        <td class="text-center">
                                            @if ($anugaman_samiti->anugaman_samiti_type_id == config('constant.WADA_STARIYA'))
                                                {{ __('वडा स्तरीय') }}
                                            @else
                                                {{ __('गा.पा स्तरीय') }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ Nepali($anugaman_samiti->ward_no) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('anugaman-samiti.show', $anugaman_samiti) }}"
                                                class="btn btn-warning btn-sm"><i
                                                    class="fa-solid fa-id-card px-1"></i>{{ __('पुरा बिबरण हेर्नुहोस') }}</a>
                                        </td>
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
