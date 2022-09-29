@section('title', 'सेटिङ्ग')
@section('setting_yojana', 'active')
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
    @if (session('active_app') == 'malpot')
        @include('layout.malpot_sidebar')
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('सेटिङ्ग थप्नुहोस') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="setting_form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('सेटिङ्गको नाम') }}<span id="name_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <input id="name" name="name" class="form-control" placeholder="" type="text">
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('Is Child') }} <span
                                            id="has_child_group"></span></span>
                                </div>
                                <select id="has_child" name="has_child" class="form-control">
                                    <option value="0">{{ __('--छैन--') }}</option>
                                    <option value="1">{{ __('--छ--') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('सेटिङ्ग अन्तर्गत') }} <span
                                            id="cascading_parent_id_group"></span></span>
                                </div>
                                <select id="cascading_parent_id" name="cascading_parent_id" class="form-control">
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    @foreach ($settingParents as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('Setting KEY') }}<span id="slug_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <input id="slug" name="slug" class="form-control" placeholder="" type="text">
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
                <h3 class="card-title">{{ __('सेटिङ्ग थप्नुहोस') }}</h3>
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
                                <td class="text-center font-weight-bold">{{ __('क्र.स') }}</td>
                                <td class="text-center font-weight-bold">{{ __('सेटिङ्गको नाम') }}</td>
                                <td class="text-center font-weight-bold">{{ __('Setting KEY') }}</td>
                                <td class="text-center"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($settings as $key => $setting)
                                <tr>
                                    <td class="text-center">{{ Nepali($key + 1) }}</td>
                                    <td class="text-center">{{ $setting->name }}</td>
                                    <td class="text-center">{{ $setting->slug }}</td>
                                    <td class="text-center">
                                        <a class="" data-toggle="modal"
                                            data-target="#edit_setting{{ $setting->id }}"><i
                                                class="fa-solid fa-pen-to-square fa-2x"></i></a>
                                        @include('shared.setting.edit-setting')
                                    </td>
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
    @yield('setting_scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            window.addEventListener("setting_added", function(evt) {
                location.reload();
            }, false);
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
            $('#setting_form').validate({
                rules: {
                    name: {
                        required: true
                    },
                    slug: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "सेटिङ्गको नाम आवश्यक छ |",
                    },
                    slug: {
                        required: "SETTING KEY IS REQUIRED",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function() {
                    const data = {
                        name: $('#name').val(),
                        slug: $('#slug').val(),
                        cascading_parent_id: $('#cascading_parent_id').val(),
                        has_child: $('#has_child').val(),
                    };

                    var submitbutton = document.getElementById("setting_submit");
                    submitbutton.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please Wait";
                    submitbutton.disabled = true;
                    axios.post("{{ route('setting.store_setting') }}", data)
                        .then(function(response) {
                            console.log(response);
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                            const event = new CustomEvent('setting_added', {
                                detail: 'success'
                            });
                        })
                        .catch(function(error) {
                            console.log('here');
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                        });
                }
            });
        });
    </script>
@endsection
