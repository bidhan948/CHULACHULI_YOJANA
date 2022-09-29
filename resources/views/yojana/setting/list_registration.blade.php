@section('title', 'सुची दर्ता')
@section('setting_list_registration', 'active')
@section('child_setting', 'menu-open')
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
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    {{-- -- modal for creating setting --- --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('थप्नुहोस') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('setting.list_registration_store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('सुची दर्ताको नाम') }}<span id="name_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <input id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                    type="text" required>
                                @error('name')
                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                        {{ __('सुची दर्ताको नाम अनिवार्य छ') }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-dismiss="modal">{{ __('रद्द गर्नुहोस्') }}</button>
                        <button type="submit" id="setting_submit" class="btn btn-primary"
                            onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?');">{{ __('सेभ गर्नुहोस् ') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- !---modal for creating setting --! --}}
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">{{ __('सुची दर्ता थप्नुहोस') }}</h3>
                <button class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
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
                                <td class="text-center font-weight-bold">{{ __('#') }}</td>
                                <td class="text-center font-weight-bold">{{ __('सुची दर्ता') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_registrations as $key => $list_registration)
                                <tr>
                                    <td class="text-center">{{ Nepali($key + 1) }}</td>
                                    <td class="text-center">{{ $list_registration->name }}</td>
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
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        window.onload = function() {
            if ({{ $errors->any() }}) {
                $("#exampleModal").modal('show');
            }
        }
    </script>
@endsection
