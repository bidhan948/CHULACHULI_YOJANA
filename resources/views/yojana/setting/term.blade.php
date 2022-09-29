@section('title', 'शर्तहरु')
@section('setting_term', 'active')
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
                <form method="post" action="{{ route('plan.setting.term.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('संचालन प्रक्रिया :') }}<span id="name_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <select name="type_id"
                                    class="form-control form-control-sm @error('type_id') is-invalid @enderror" required>
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    @foreach (config('TYPE.NEPALI_ARRAY') as $id => $type)
                                        <option value="{{ $id }}">{{ $type }}</option>
                                    @endforeach
                                    <option value="0">{{ __('कार्यक्रम') }}</option>
                                </select>
                                @error('type_id')
                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                        {{ __('संचालन प्रक्रिया अनिवार्य छ') }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('शर्तहरु :') }}<span id="name_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <textarea name="term" class="form-control form-control-sm ckeditor" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-dismiss="modal">{{ __('रद्द गर्नुहोस्') }}</button>
                        <button type="submit" id="setting_submit" class="btn btn-primary"
                            onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ? ')">{{ __('सेभ गर्नुहोस् ') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- !---modal for creating setting --! --}}
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">{{ __('शर्तहरु थप्नुहोस') }}</h3>
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
                                <td class="text-center font-weight-bold">#</td>
                                <td class="text-center font-weight-bold">संचालन प्रक्रिया</td>
                                <td class="text-center font-weight-bold"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($terms as $key => $term)
                                <tr>
                                    <td class="text-center">{{ Nepali($key + 1) }}</td>
                                    <td class="text-center">
                                        {{ $term->type_id != null ? config('TYPE.NEPALI_ARRAY.' . $term->type_id) : 'कार्यक्रम' }}</td>
                                    <td class="text-center"><a class="btn btn-sm btn-primary text-white" data-toggle="modal"
                                            data-target="#term{{ $key }}">{{ __('सच्याउनुहोस्') }}</a></td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="term{{ $key }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('थप्नुहोस') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post"
                                                    action="{{ route('plan.setting.term.update', $term) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text">{{ __('शर्तहरु :') }}<span
                                                                            id="name_group"
                                                                            class="text-danger font-weight-bold px-1">*</span></span>
                                                                </div>
                                                                <textarea name="term" class="form-control form-control-sm ckeditor" required>
                                                                    {!! $term->term !!}
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">{{ __('रद्द गर्नुहोस्') }}</button>
                                                        <button type="submit" id="setting_submit"
                                                            class="btn btn-primary"
                                                            onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ? ')">{{ __('सेभ गर्नुहोस् ') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- !---modal for creating setting --! --}}
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
