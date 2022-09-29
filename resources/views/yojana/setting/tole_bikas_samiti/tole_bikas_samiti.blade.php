@section('title', 'टोल विकास समिति')
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
                        <h3 class="card-title" style="padding-left: 145px;">{{ __('टोल विकास समिति') }}</h3>
                    </div>
                    <div class="col-3 text-right">
                        <a href="{{ route('tole-bikas-samiti.create') }}" class="btn btn-sm btn-primary"><i
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
                                    <td class="text-center" style="width:3%;">{{ __('सि.नं.') }}</td>
                                    <td class="text-center" style="width:5%;">{{ __('समिती दर्ता नं') }}</td>
                                    <td class="text-center">{{ __('टोल बिकास समितिको नाम') }}</td>
                                    <td class="text-center" style="width:3%;">{{ __('वडा नं') }}</td>
                                    <td class="text-center">{{ __('गठन मिती') }}</td>
                                    <td class="text-center">{{ __('पुरा विवरण हेर्नुहोस') }}</td>
                                    <td class="text-center"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tole_bikas_samitis as $key => $tole_bikas_samiti)
                                    <tr>
                                        <td class="text-center">{{ Nepali($key + 1) }}</td>
                                        <td class="text-center">{{ Nepali($tole_bikas_samiti->id) }}</td>
                                        <td class="text-center">{{ $tole_bikas_samiti->name }}</td>
                                        <td class="text-center">{{ Nepali($tole_bikas_samiti->ward_no) }}</td>
                                        <td class="text-center">{{ Nepali($tole_bikas_samiti->date_nep) }}</td>
                                        <td class="text-center">
                                            <a href="{{route('tole-bikas-samiti.show',$tole_bikas_samiti)}}"
                                                class="btn btn-sm btn-primary">{{ __('पुरा विवरण हेर्नुहोस') }}</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('tole-bikas-samiti.edit',$tole_bikas_samiti)}}"
                                                class="btn btn-sm btn-success my-1"><i class="fa-solid fa-pen-to-square px-1"></i>{{ __('सच्याउनुहोस') }}</a>
                                            <a href="{{route('tole-bikas-samiti.print',$tole_bikas_samiti)}}"
                                                class="btn btn-sm btn-warning my-1"  target="_blank"><i class="fa-solid fa-file-lines px-1"></i>{{ __('पत्र') }}</a>
                                            <a href="{{route('tole-bikas-samiti.bank',$tole_bikas_samiti)}}"
                                                class="btn btn-sm btn-primary my-1"><i class="fa-solid fa-file-lines px-1"></i>{{ __('बैंक पत्र') }}</a>
                                            <a href="{{route('tole-bikas-samiti.praman',$tole_bikas_samiti)}}"
                                                class="btn btn-sm btn-danger my-1" target="_blank"><i class="fa-solid fa-file-lines px-1" ></i>{{ __('प्रमाण पत्र') }}</a>
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
