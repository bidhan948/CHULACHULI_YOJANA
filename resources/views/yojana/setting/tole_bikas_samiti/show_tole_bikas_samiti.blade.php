@section('title', $tole_bikas_samiti->name . 'को विवरण')
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
                        <h3 class="card-title">{{ __('टोल विकास समिति सम्बन्धी विवरण') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('tole-bikas-samiti.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward pr-2"></i><span>{{ __('पछी जानुहोस्') }}</span></a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                        <p class="text-center " style="font-size: 1rem;">टोल बिकास समितीको नाम: <span
                                class="font-weight-bold px-1">{{ $tole_bikas_samiti->name }}</span></p>
                        <p class="text-center" style="font-size: 1rem;">टोल बिकास समितिको ठेगाना: <span
                                class="font-weight-bold px-1">{{ config('constant.SITE_NAME') }}{{ ' ' . Nepali($tole_bikas_samiti->ward_no) }}</span>
                        </p>
                        <p class="text-center" style="font-size: 1rem;">टोल बिकास समिति दर्ता नं: <span
                                class="font-weight-bold px-1">{{ Nepali($tole_bikas_samiti->reg_no) }}</span>
                        </p>
                        <p class="text-center" style="font-size: 1rem;">गठन मिति : <span
                                class="font-weight-bold px-1">{{ Nepali($tole_bikas_samiti->date_nep) }}</span>
                        </p>
                        <p class="text-center" style="font-size: 1rem;">म्याद सकिने मिति: <span
                                class="font-weight-bold px-1">{{ Nepali($tole_bikas_samiti->exp_date_nep) }}</span>
                        </p>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center">{{ __('सि.नं.') }}</td>
                                    <td class="text-center">{{ __('पद') }}</td>
                                    <td class="text-center">{{ __('नाम/ थर') }}</td>
                                    <td class="text-center">{{ __('वडा नं') }}</td>
                                    <td class="text-center">{{ __('लिङ्ग') }}</td>
                                    <td class="text-center">{{ __('नागरिकता नं') }}</td>
                                    <td class="text-center">{{ __('जारी जिल्ला') }}</td>
                                    <td class="text-center">{{ __('मोबाइल नं') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tole_bikas_samiti->toleBikasSamitiDetails as $key => $tole_bikas_samiti_detail)
                                    <tr>
                                        <td class="text-center">{{ Nepali($key + 1) }}</td>
                                        <td class="text-center">
                                            {{ getSettingValueById($tole_bikas_samiti_detail->position)->name }}</td>
                                        <td class="text-center">
                                            {{ $tole_bikas_samiti_detail->name }}</td>
                                        <td class="text-center">
                                            {{ Nepali($tole_bikas_samiti_detail->ward_no) }} </td>
                                        <td class="text-center">
                                            {{ returnGender($tole_bikas_samiti_detail->gender) }}</td>
                                        <td class="text-center">
                                            {{ Nepali($tole_bikas_samiti_detail->cit_no) }}</td>
                                        <td class="text-center">
                                            {{ $tole_bikas_samiti_detail->issue_district }}</td>
                                        <td class="text-center">
                                            {{ Nepali($tole_bikas_samiti_detail->contact_no) }}</td>
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
