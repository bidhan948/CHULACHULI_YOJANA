@section('title', $contract_kabol->plan->name . ' को ठेक्का खोलिएकोफारम')
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
            <h3>ठेक्काको कुल लागत अनुमान</h3>
        </div>

        <form action="{{ route('thekka-kul-lagat-submit') }}" method="POST">
            @csrf
            <div class="card-body">
                <table class="table table-bordered w-100">
                    <thead>
                        <tr>
                            <input type="hidden" name="kabol_id" value="{{ $contract_kabol->id }}">
                            <input type="hidden" name="plan_id" value="{{ $contract_kabol->plan_id }}">
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>भौतिक परिणाम </td>
                            <td><input class="form-control" name="physical_amount" type="number"
                                    value="{{ $contract_kul_lagat == null ? '' : $contract_kul_lagat->physical_amount }}">
                            </td>
                        </tr>

                        <tr>
                            <td>भौतिक ईकाई </td>
                            <td><select class="form-control" name="unit_id" aria-label="Default select example">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $contract_kul_lagat == null ? '' : ($contract_kul_lagat->unit_id == $item->id ? 'selected' : '') }}>
                                            {{ $item->name }}</option>
                                    @endforeach

                                </select></td>
                        </tr>

                        <tr>
                            <td>गाँउपालिकाबाट अनुदान </td>
                            <td><input class="form-control" type="text"
                                    value="{{ nepali($contract_kabol->plan->grant_amount) }}" readonly>
                                <input class="form-control" type="hidden"
                                    value="{{ $contract_kabol->plan->grant_amount }}" name="grant_amount" readonly>
                            </td>
                        </tr>

                        <tr>
                            <td>कुल ठेक्का रकम जम्मा </td>
                            <td><input class="form-control"
                                    value="{{ nepali($contract_kabol->contract->total_thekka_amount) }}" type="text"
                                    readonly>
                                <input class="form-control" value="{{ $contract_kabol->contract->total_thekka_amount }}"
                                    name="total_thekka_amount" type="hidden" readonly>
                            </td>
                        </tr>

                        <tr>
                            <td>ठेक्का कबोल गरेको कुल रकम </td>
                            <td><input class="form-control" value="{{ nepali($contract_kabol->total_kabol_amount) }}"
                                    type="text" readonly>

                            </td>
                        </tr>

                        <tr>
                            <td>कार्यदेश दिएको रकम </td>
                            <td><input class="form-control" value="{{ nepali($contract_kabol->total_kabol_amount) }}"
                                    type="text" readonly>
                                <input class="form-control" value="{{ $contract_kabol->total_kabol_amount }}"
                                    name="total_kabol_amount" type="hidden" readonly>
                            </td>
                        </tr>


                        <tr>
                            <td>योजना संचालन गर्ने फर्म/कम्पनी</td>
                            <td><input class="form-control" value="{{ $contract_kabol->contractor_name }}"
                                    name="contractor_name" type="text" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="card-footer">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>
@endsection

@section('scripts')

@endsection
