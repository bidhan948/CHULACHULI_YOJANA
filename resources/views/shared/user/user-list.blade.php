@extends('layout.layout')
@section('title', 'USER')
@section('user_active', 'active')
@section('sidebar')
    @include('layout.shared_sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- this is modal for adding user --}}
        <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('प्रयोगकर्ता थप्नुहोस') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('user.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('प्रयोगकर्ताको नाम') }} <span
                                                    class="text-dnager px-1 font-weight-bold text-danger">*</span></span>
                                        </div>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('प्रयोगकर्ताको नाम') }}" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('प्रयोगकर्ताको ईमेल') }} <span
                                                    class="text-dnager px-1 font-weight-bold text-danger">*</span></span>
                                        </div>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="{{ __('प्रयोगकर्ताको ईमेल') }}" required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('प्रयोगकर्ताको पासवोर्ड') }} <span
                                                    class="text-dnager px-1 font-weight-bold text-danger">*</span></span>
                                        </div>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="{{ __('प्रयोगकर्ताको पासवोर्ड') }}" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('पासवोर्ड पुन हाल्नुहोस्') }} <span
                                                    class="text-dnager px-1 font-weight-bold text-danger">*</span></span>
                                        </div>
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="{{ __('पासवोर्ड पुन हाल्नुहोस्') }}" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('ठेगाना') }} <span
                                                    class="text-dnager px-1 font-weight-bold text-danger">*</span></span>
                                        </div>
                                        <input type="text" name="site_type"
                                            class="form-control @error('site_type') is-invalid @enderror"
                                            placeholder="{{ __('ठेगाना हाल्नुहोस्') }}"
                                            value="{{ config('constant.SITE_TYPE') }}" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('वडा नं') }} <span
                                                    class="text-dnager px-1 font-weight-bold text-danger">*</span></span>
                                        </div>
                                        <select name="ward_no"
                                            class="form-control @error('ward_no') is-invalid @enderror">
                                            <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                            @for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++)
                                                <option value="{{$i}}">{{Nepali($i)}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('भूमिका') }} <span
                                                    class="text-dnager px-1 font-weight-bold text-danger">*</span></span>
                                        </div>
                                        <select name="role_id[]"
                                            class="form-control @error('role_id') is-invalid @enderror" id="role_id">
                                            <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                            @foreach ($roles as $key => $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4" id="childRole">

                                </div>
                                <div class="col-4">
                                    <button class="btn btn-sm btn-primary" type="submit"
                                        onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?');">{{ __('सम्पादन गर्नुहोस्') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-dismiss="modal">{{ __('रद्द गर्नुहोस्') }}</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- xxx end of modal for adding user xxx --}}
        <div class="card">
            <div class="card-header">
                @can('ADD_USER')
                    <div class="col-12 text-right">
                        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addUser"><i
                                class="fa-solid fa-plus"></i></a>
                    </div>
                @endcan
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <table id="table1" width="100%" class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th style="width:50px;">#</th>
                                <th>युजरको नाम</th>
                                <th>इमेल </th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td class="text-center">{{ Nepali($key + 1) }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center"></td>
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
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
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

            $("#role_id").on("change", function() {
                var role_id = $("#role_id").val();
                axios.get("{{ route('api.getChildRole') }}", {
                        params: {
                            role_id: role_id
                        }
                    }).then(function(response) {
                        $("#childRole").html(response.data);
                    })
                    .catch(function(error) {
                        console.log(error);
                        alert("Something went wrong");
                    });
            });
        });

        window.onload = function() {
            let check = {{ $errors->any() ? 1 : 0 }}
            if (check) {
                $("#addUser").modal('show');
            }
        }
    </script>
@endsection
