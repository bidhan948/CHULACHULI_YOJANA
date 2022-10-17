@section('title', $plan->name . ' को ठेक्का खोलिएकोफारम')
@section('operate_plan', 'active')
@extends('layout.layout')
@section('sidebar')
    @include('layout.yojana_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>ठेक्का कबोल फारम</h3>
        </div>
        <form action="{{ route('thekka-kabol-submit') }}" method="post">
            @csrf
            <div class="card-body">
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                <table class="table-responsive table">
                    <thead>
                        <tr>
                            <th scope="col">सी.न.</th>
                            <th scope="col">निर्माण व्यवसायीको नाम</th>
                            <th scope="col">प्रकार छान्नुहोस्</th>
                            <th scope="col">ठेक्का कबोल गरेको कुल रकम </th>
                            <th scope="col">कुल रकम</th>
                            <th scope="col">बैंक ग्यारेन्टी रकम</th>
                            <th scope="col">धरौटी खातामा जम्मा गरिएको रकम</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contract_open as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td><input type="text" value="{{ $item->name }}" name="contractor_name[]"></td>
                                <td>
                                    <select class="form-select" name="has_vat[]" aria-label="Disabled select example">
                                        <option selected>भ्याट प्रकार</option>
                                        <option value="1">भ्याट सहित</option>
                                        <option value="2">भ्याट बाहेक</option>
                                    </select>
                                </td>
                                <td><input type="number" name="total_kabol_amount[]"></td>
                                <td><input type="text" class="date" name="total_amount[]"></td>
                                <td><input type="number" value="{{ $item->bail_amount }}" name="bank_guarantee_amount[]">
                                </td>
                                <td><input type="text" name="bail_account_amount[]"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>


    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vue/bundle.js') }}"></script>
    <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
    <script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>

    <script></script>

@endsection
