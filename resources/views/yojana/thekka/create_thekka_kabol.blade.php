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
        <div class="card-body">
            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
            <table class="table-responsive table">
                <thead>
                    <tr>
                        <th scope="col">सी.न.</th>
                        <th scope="col">निर्माण व्यवसायीको नाम</th>
                        <th scope="col">प्रकार छान्नुहोस्</th>
                        <th scope="col">ठेक्का कबोल गरेको कुल रकम	</th>
                        <th scope="col">कुल रकम</th>
                        <th scope="col">बैंक ग्यारेन्टी पत्र</th>
                        <th scope="col">धरौटी खातामा जम्मा गरिएको रकम</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"></th>
                        <td><input type="text" v-model="namee" name="name[]"></td>
                        <td><input type="text" name="bank_name[]"></td>
                        <td><input type="number" name="bank_guarantee_amount[]"></td>
                        <td><input type="text" class="date" name="bank_date[]"></td>
                        <td><input type="number" name="bail_amount[]"></td>
                        <td><input type="text" name="remark[]"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer">

        </div>
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

<script>

</script>

@endsection
 