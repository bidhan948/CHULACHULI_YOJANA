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
    <div id="vue_app" class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3>ठेक्का खोलिएको फारम</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">निर्माण व्यवसायीको नाम:
                                    <span id="budget_source_id_group"
                                        class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <template>
                                <div>
                                    <multiselect v-model="value" placeholder="निर्माण व्यवसायीको छान्नुहोस्"
                                        @select="onchange()" :options="options" :multiple="true" ></multiselect>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('thekka-open-submit') }}" method="POST">
                @csrf
                <div class="card-footer">
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                    <table class="table-responsive table">
                        <thead>
                            <tr>
                                <th scope="col">सी.न.</th>
                                <th scope="col">निर्माण व्यवसायीको नाम</th>
                                <th scope="col">बैंकको नाम</th>
                                <th scope="col">बैंकको ग्यारेन्टी रकम</th>
                                <th scope="col">बैंकको ग्यारेन्टी रकम अवधि</th>
                                <th scope="col">धरौटी खातामा जम्मा गरिएको रकम</th>
                                <th scope="col">कैफियत</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for='(namee,index) in value'>
                                <th scope="row">@{{ index + 1 }}</th>
                                <td><input type="text" v-model="namee" name="name[]" readonly></td>
                                <td><input type="text" v-model="namee.bank_name" name="bank_name[]"></td>
                                <td><input type="number" v-model="namee.bank_guarantee_amount" name="bank_guarantee_amount[]"></td>
                                <td><input type="text" v-model="namee.bank_date" class="date" name="bank_date[]"></td>
                                <td><input type="number" v-model="namee.bail_amount" name="bail_amount[]"></td>
                                <td><input type="text" v-model="namee.remark" name="remark[]"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

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
        const report = new Vue({

            el: "#vue_app",

            components: {
                Multiselect: window.VueMultiselect.default
            },
            data: {
                form: [],   
                value: @json($plan->contractOpens->pluck('name')),
                options: [],
                selectedOptions: [],
                insertedValue:[],
                listRegistration: @json($list_registrations),
            },

            methods: {
                onchange() {
                    setTimeout(function(){
                        var date = document.getElementsByClassName("date");
                        date.nepaliDatePicker({
                            ndpYear: true,
                            ndpMonth: true,
                            ndpYearCount: 70,
                            readOnlyInput: true,
                            ndpTriggerButton: false,
                            ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                            ndpTriggerButtonClass: 'btn btn-primary',
                     });
                    }, 100)
                }
            },

            mounted() {
                let vm = this;
                vm.listRegistration.list_registration_attribute.forEach(setOptions);
                var date = document.getElementsByClassName("date");
                    date.nepaliDatePicker({
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 70,
                        readOnlyInput: true,
                        ndpTriggerButton: false,
                        ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                        ndpTriggerButtonClass: 'btn btn-primary',
                 });

                function setOptions(item) {
                    vm.options.push(item.name);
                    console.log(vm.options);
                }
            },

        });
    </script>




    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

@endsection
