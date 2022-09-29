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
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('थप्नुहोस') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('role.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('भूमिका') }}<span id="name_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <select name="role_id" id="role_id" class="form-control form-control-sm">
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    @foreach ($parentRoles as $parentRole)
                                        <option value="{{ $parentRole->id }}">{{ $parentRole->name }}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                        {{ __('भूमिका अनिवार्य छ') }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('भूमिका') }}<span id="name_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <input id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                    type="text" required>
                                @error('name')
                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                        {{ __('भूमिका अनिवार्य छ') }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-dismiss="modal">{{ __('रद्द गर्नुहोस्') }}</button>
                        <button type="submit" id="setting_submit"
                            class="btn btn-primary">{{ __('सेभ गर्नुहोस् ') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- !---modal for creating setting --! --}}
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">{{ __('भूमिका थप्नुहोस') }}</h3>
                <button class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row"></div>
                <div class="row">
                    <div class="col-12">
                        <table id="table1" width="100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center font-weight-bold">{{ __('क्र.स.') }}</td>
                                    <td class="text-center font-weight-bold">{{ __('भूमिका') }}</td>
                                    @can('PERMISSION_MANAGEMENT')
                                        <td class="text-center"></td>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $key => $role)
                                    <tr>
                                        <td class="text-center">{{ Nepali($key + 1) }}</td>
                                        <td class="text-center">{{ $role->name }}</td>
                                        @can('PERMISSION_MANAGEMENT')
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('permission.managePermission', $role) }}">{{ __('अनुमति प्रबन्ध गर्नुहोस्') }}
                                                    <i class="fa-solid fa-pen-to-square px-1"></i></a>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
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
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        window.onload = function() {
            if ({{ $errors->any() }}) {
                $("#exampleModal").modal('show');
            }
        }
    </script>
@endsection
