@extends('layout.layout')
@section('title', 'भूमिका ब्यबस्थापन')
@section('role_active', 'active')
@section('sidebar')
    @include('layout.shared_sidebar')
@endsection

@section('content')
    {{-- -- modal for creating setting --- --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
    {{-- !---modal for creating setting --! --}}
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header text-center">
                <h3 class="card-title text-center">{{ $role->name . __('को अनुमति व्यवस्थापन') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2 mb-2">
                        <a id="check" class="btn btn-sm btn-primary text-white float-right" onclick="checkAll()"
                            style="display: block;">{{ __('Check all') }} <i class="fas fa-check px-1"></i></a>
                        <a id="uncheck" class="btn btn-sm btn-danger text-white" onclick="uncheckAll()"
                            style="display: none;">{{ __('Uncheck all') }} <i class="fas fa-times px-1"></i></a>
                    </div>
                </div>
                <form action="{{ route('role.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @foreach ($permissions as $key => $permission)
                            <div class="col-md-4 p-2 border" style="display: flex; align-items: center;">
                                <label class="px-2 font-weight-bold px-2 mt-2"
                                    for="{{ $permission->name }}">{{ $permission->name }}</label>
                                <input type="checkbox" name="permission[]" class="px-2 check"
                                    value="{{ $permission->name }}" id="{{ $permission->id }}"
                                    @if (in_array($permission->id, $permissionArr)) checked @endif>
                            </div>
                        @endforeach
                        <div class="col-12 my-3">
                            <button class="btn btn-sm btn-primary" type="submit"
                                onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?')">{{ __('सम्पादन गर्नुहोस्') }}</button>
                        </div>
                    </div>
                </form>
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
        <script>
            function checkAll() {
                $('.check').attr("checked", "checked");
                $('#uncheck').css("display", "block");
                $("#check").css("display", "none");
            }

            function uncheckAll() {
                $('.check').attr("checked", false);
                $('#uncheck').css("display", "none");
                $("#check").css("display", "block");
            }
        </script>
    @endsection
