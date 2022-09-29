@section('child_report', 'menu-open')
@section('report_comittee_dashboard', 'active')
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

            @php
                $type=config('TYPE.NEPALI_ARRAY_NEW');
            @endphp
            <div class="card-header">
                <h3 class="card-title">{{ __($type[$type_id].' को बिस्तृत रिपोर्ट:') }}</h3>
            </div>
            <div class="row">
                <div class="col-12 my-2 mr-2 text-right">
                    <a href="{{ route('report.committee.dashboard') }}" class="btn btn-primary"><i
                            class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="my-2 px-3">
                <div class="row">
                    <table id="table1" class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <td class="text-center font-weight-bold">{{ __('सि.नं') }}</td>
                                <td class="text-center font-weight-bold">
                                    {{ $type[$type_id]. ' को नाम' }}</td>
                                <td class="text-center font-weight-bold">{{ 'वडा नं' }}</td>
                                <td class="text-center font-weight-bold">{{ 'गठन मिति' }}</td>
                                <td class="text-center font-weight-bold">{{ 'पद / नाम थर / सम्पर्क नम्बर' }}</td>
                            </tr>
                        </thead>
                        @foreach ($plans as $key => $value)
                            <tr>
                                <td>{{Nepali($key+1)}}</td>
                                <td>{{isset($value->Consumer->name) ? $value->Consumer->name: ''}}</td>
                                <td>{{Nepali(isset($value->Consumer->ward_no) ? $value->Consumer->ward_no : '')}}</td>
                                <td>{{Nepali(isset($value->Consumer->created_at) ?   \Carbon\Carbon::parse($value->Consumer->created_at)->format('d/m/Y')  : '')}}</td>
                                <td>
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>नाम</td>
                                                <td>पद</td>
                                                <td>सम्पर्क न०</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($value->Consumer->consumerDetails)
                                            @foreach ($value->Consumer->consumerDetails as $item)
                                            @if($item->posts->name=='अध्यक्ष' || $item->posts->name=='सचिब' || $item->posts->name=='कोषाध्यक्ष')
                                                <tr>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->posts->name}}</td>
                                                    <td>{{$item->contact_no}}</td>
                                                </tr>
                                            @endif
                                            @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
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
