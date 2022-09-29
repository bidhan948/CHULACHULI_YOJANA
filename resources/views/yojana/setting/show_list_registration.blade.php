@section('title', 'सुची दर्ता')
@section('setting_list_registration_bibaran', 'active')
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
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">{{ __('सूची दर्ता विवरण') }}</h3>
                <button class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    <a href="{{ route('setting.list_registration_bibaran_index') }}" class="btn btn-sm btn-primary"><i
                            class="fa-solid fa-backward px-1"></i> {{ __('पछी जानुहोस्') }}</a>
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text ">{{ __('संचालन गर्ने :') }}
                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                            </div>
                            <select name="list_registration_id" id="list_registration" class="form-control form-control-sm">
                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                @foreach ($list_registrations as $list_registration)
                                    <option value="{{ $list_registration->id }}">{{ $list_registration->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="table">
                    <table id="table1" width="100%" class="table table-bordered my-2">
                        <thead>
                            <tr>
                                <td class="text-center font-weight-bold">{{ __('#') }}</td>
                                <td class="text-center font-weight-bold">{{ __('नाम') }}</td>
                                <td class="text-center font-weight-bold">{{ __('ठेगाना') }}</td>
                                <td class="text-center"></td>
                            </tr>
                        </thead>
                        <tbody id="row_body">

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
    <script>
        $(function() {
            $("#table").css('display', 'none');
            $("#list_registration").on("change", function() {
                var list_registration = $("#list_registration").val();
                if (list_registration == '') {
                    $("#table").css('display', 'none');
                } else {
                    axios.get("{{ route('api.getSuchiDartaBibaran') }}", {
                            params: {
                                list_registration_id: list_registration
                            }
                        }).then(function(response) {
                            console.log(response);
                            $("#table").css('display', '');
                            $("#row_body").html(response.data);
                        })
                        .catch(function(error) {
                            alert("Something went wrong");
                        });
                }
            });
        });
    </script>
@endsection
