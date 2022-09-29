@section('title', 'योजना / कार्यक्रम ')
@section('plan', 'active')
@extends('layout.layout')
@section('sidebar')
    @include('layout.yojana_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card " id="vue_app">
            <div class="card-header">
                <h3 class="card-title">{{ __('योजनाको विवरण हेर्नुहोस्') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="mb-2 p-2">
                    <div class="row">
                        <div class="col-4" v-if="!ward_no">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('वडा नं :') }}</span>
                                    </div>
                                    <select v-model="filterData.ward_no" class="form-control form-control-sm">
                                        <option value="" v-text="'--छान्नुहोस्--'"></option>
                                        <option value="0" v-text="site_name"></option>
                                        <option :value="ward" v-for="ward in 7"
                                            v-text="convertToNepaliDigit(ward)"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('किसिम :') }}</span>
                                    </div>
                                    <select v-model="filterData.type_id" class="form-control form-control-sm">
                                        <option value="" v-text="'--छान्नुहोस्--'"></option>
                                        <option :value="type_key" v-for="(type,type_key) in types" v-text="type">
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('विनियोजन  किसिम :') }}</span>
                                    </div>
                                    <select v-model="filterData.type_of_allocation_id" class="form-control form-control-sm">
                                        <option value="" v-text="'--छान्नुहोस्--'"></option>
                                        <option :value="type_of_allocation.id"
                                            v-for="(type_of_allocation,type_of_allocation_key) in type_of_allocations"
                                            v-text="type_of_allocation.name">
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('दर्ता नं :') }}</span>
                                    </div>
                                    <input type="text" class="amount form-control form-control-sm"
                                        v-model="filterData.reg_no">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('योजना / कार्यक्रमको नाम :') }}</span>
                                    </div>
                                    <input type="text" class="amount form-control form-control-sm"
                                        v-model="filterData.name">
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mb-2 mt-2">
                            <button class="btn-sm btn btn-primary" id="submit" v-on:click="loadData()"><i
                                    class="fa-solid fa-magnifying-glass px-1"></i> <span>खोज्नुहोस</span></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-end py-2">

                            <input class="printBtn" type="button" value="Print" onclick="onPrint('div_print')" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="div_print">
                            <table id="table1" class="table table-bordered yojana_table">
                                <thead>
                                    <tr>
                                        <th width="55px;" style="text-align:center">{{ __('दर्ता नं') }}</th>
                                        <th width="30%">{{ __('योजना / कार्यक्रमको नाम') }}</th>
                                        <th>{{ __('बजेट शिर्षक') }}</th>
                                        <th>{{ __('विनियोजन किसिम') }}</th>
                                        <th>{{ __('वडा नं') }}</th>
                                        <th>{{ __('अनुदान रकम (रु.)') }}</th>
                                        <th>{{ __('खर्च रकम (रु.)') }}</th>
                                        <th>{{ __('बाँकि रकम (रु.)') }}</th>
                                        <th>{{ __('विवरण हेर्नुहोस') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(plan,key) in plans.data">
                                        <tr>
                                            <td style="text-align:center" v-text="convertToNepaliDigit(plan.reg_no)"></td>
                                            <td class="" v-text="plan.name"></td>
                                            <td class="">
                                                <span
                                                    v-for="(budget_source_plan_detail,budget_index) in plan.budget_source_plan_details"
                                                    v-text="budget_source_plan_detail.budget_sources.name + ' :' + convertToNepaliDigit(budget_source_plan_detail.amount)"></span>
                                                <br>
                                            </td>
                                            <td class="" v-text="plan.plan_allocation.name"></td>
                                            <td class=""
                                                v-text="plan.ward_no ? convertToNepaliDigit(plan.ward_no) : '०'"></td>
                                            <td class="" v-text="convertToNepaliDigit(plan.grant_amount)"></td>
                                            <td class="" v-text="calculateExpenseAmount(key,'expense')">
                                            </td>
                                            <td class="" v-text="calculateExpenseAmount(key,'baki')">
                                            </td>
                                            <td class="">
                                                <a v-on:click="redirectEdit(key)" v-if="!plan.is_merge"
                                                    class="btn btn-sm btn-success" v-text="'सच्याउनुहोस'"></a>
                                                <a v-on:click="redirectBreakYojana(key)" v-if="checkIfItIsBreakable(key)"
                                                    class="btn btn-sm btn-danger" v-text="'टुक्राउनुहोस्'"></a>
                                            </td>
                                        </tr>
                                        <tr v-for="(parent,parent_key) in plan.parents" v-if="plan.parents.length">
                                            <td class="" v-text="convertToNepaliDigit(parent.reg_no)"></td>
                                            <td class="" v-text="parent.name"></td>
                                            <td class="">
                                                <span
                                                    v-for="(budget_source_plan_detail,budget_index) in parent.budget_source_plan_details"
                                                    v-text="budget_source_plan_detail.budget_sources.name + ' :' + convertToNepaliDigit(budget_source_plan_detail.amount)"></span>
                                                <br>
                                            </td>
                                            <td class="" v-text="parent.plan_allocation.name"></td>
                                            <td class=""
                                                v-text="parent.ward_no ? convertToNepaliDigit(parent.ward_no) : '०'"></td>
                                            <td class="text-center" v-text="convertToNepaliDigit(parent.grant_amount)">
                                            </td>
                                            <td class="">
                                                <a v-on:click="redirectEdit(key)" v-if="!parent.is_merge"
                                                    class="btn btn-sm btn-success" v-text="'सच्याउनुहोस'"></a>
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </template>
                                    <tr>
                                        <td colspan="5" style="text-align:right; font-weight:bold"> जम्मा </td>
                                        <td v-text="total_budget" style="text-align:center; font-weight:bold;"> </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!--<tr>-->
                                    <!--    <td class="text-center" colspsan="5">जम्मा  :</td>-->
                                    <!--    <td class="text-center" v-text="total_budget"></td>-->
                                    <!--</tr>-->
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination pagination-sm d-flex justify-content-center my-2">
                            <li class="page-item text-primary" v-for="index in last_page" v-on:click="loadPage(index)"
                                :class="index == current_page ? 'active' : ''" style="cursor: pointer;"><a
                                    class="page-link" v-text="index"></a></li>
                        </ul>
                    </div>
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
    <script src="{{ asset('vue/bundle.js') }}"></script>
    <!--<script src="{{ asset('js/script.js') }}"></script>-->

    <script>
        new Vue({
            el: "#vue_app",
            data: {
                plans: [],
                ward_no : @json(auth()->user()->ward_no),
                site_name: @json(config('constant.SITE_TYPE')),
                yojana_id: @json(config('YOJANA.PLAN')),
                program_id: @json(config('YOJANA.PROGRAM')),
                total_wards: @json(config('constant.TOTAL_WARDS')),
                types: @json(config('YOJANA.PLAN_PROGRAM_KEY')),
                type_of_allocations: @json($type_of_allocations),
                pages: [],
                current_page: '',
                last_page: '',
                per_page: 0,
                total_budget: '',
                filterData: {
                    page: '',
                    ward_no: '',
                    type_id: '',
                    reg_no: '',
                    type_of_allocation_id: '',
                    name:''
                }
            },
            methods: {
                convertToNepaliDigit: function(number) {
                    let vm = this;
                    var number = number.toString();
                    var number_before_decimal = number.split(".")[0]
                    var number_after_decimal = number.split(".")[1]
                    var text1 = convertToNepaliDigit(number_before_decimal);
                    var text2 = "";
                    if (typeof number_after_decimal !== "undefined") {
                        text2 = convertToNepaliDigit(number_after_decimal);
                        return text1 + "." + text2;
                    } else {
                        return text1;
                    }
                },
                redirectEdit: function(key) {
                    let vm = this;
                    window.location.href = "{{ url('yojana/plan/edit/') }}" + "/" + vm.plans.data[key].id;
                },
                redirectBreakYojana: function(key) {
                    let vm = this;
                    window.location.href = "{{ url('yojana/break-down/') }}" + "/" + vm.plans.data[key].id;
                },
                checkIfItIsBreakable: function(key) {
                    let vm = this;
                    if (vm.plans.data[key].type_id == vm.program_id) {
                        return false;
                    } else {
                        if (vm.plans.data[key].is_merge) {
                            return false;
                        } else {
                            if (vm.plans.data[key].kul_lagat != null) {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    }
                },
                loadData: function() {
                    let vm = this;
                    button = document.getElementById('submit');
                    button.disabled = true;
                    button.innerHTML = 'Loading <i class="fa-solid fa-spinner px-1"></i>';
                    axios.post("{{ route('api.plan.report') }}", vm.filterData)
                        .then(function(response) {
                            console.log(response);
                            vm.plans = response.data.plan;
                            vm.pages = response.data.plan.links;
                            vm.last_page = response.data.plan.last_page
                            vm.current_page = response.data.plan.current_page;
                            vm.per_page = response.data.plan.per_page;
                            vm.total_budget = response.data.sum;
                            button.disabled = false;
                            button.innerHTML =
                                'खोज्नुहोस <i class="fa-solid fa-magnifying-glass px-1"></i>';
                        }).catch(function(error) {
                            alert("Something went wrong");
                            console.log(error);
                        });
                },
                loadPage: function(index) {
                    let vm = this;
                    if (index == 0) {
                        vm.filterData.page = parseInt(vm.current_page) - 1;
                    } else if (index == vm.pages.length - 1) {
                        vm.filterData.page = parseInt(vm.current_page) + 1;
                    } else {
                        vm.filterData.page = index;
                    }
                    if (vm.current_page != 0 && vm.filterData.page != vm.pages.length - 1) {
                        axios.post("{{ route('api.plan.report') }}", vm.filterData)
                            .then(function(response) {
                                vm.plans = response.data.plan;
                                vm.total_budget = response.data.sum;
                                vm.current_page = response.data.plan.current_page;
                                button.disabled = false;
                                button.innerHTML =
                                    'Search <i class="fa-solid fa-magnifying-glass px-1"></i>';
                            })
                            .catch(function(error) {
                                console.log(error);
                                alert("Some Problem Occured");
                            });
                    }
                },
                calculateExpenseAmount: function(key, param) {
                    let vm = this;
                    expense_amount = 0;

                    if (vm.plans.data[key].running_bill_payment == null && vm.plans.data[key].final_payment ==
                        null) {
                        expense_amount = (vm.plans.data[key].advance == null ? 0 : vm.plans.data[key].advance
                            .peski_amount);
                    } else {
                        if (vm.plans.data[key].running_bill_payment == null) {
                            expense_amount += 0;
                        } else {
                            expense_amount += vm.plans.data[key].running_bill_payment;
                        }
                        if (vm.plans.data[key].final_payment == null) {
                            expense_amount += 0;
                        } else {
                            expense_amount += vm.plans.data[key].final_payment.total_bhuktani_amount;
                        }
                    }
                    if (param == 'baki') {
                        return vm.convertToNepaliDigit((vm.plans.data[key].grant_amount - expense_amount).toFixed(2));
                    } else {
                        return (expense_amount == 0 ? '०' : vm.convertToNepaliDigit(expense_amount.toFixed(2)));
                    }
                }
            },
            mounted() {
                let vm = this;
                vm.loadData();
            }
        });
    </script>
    <script>
        const onPrint = (element) => {
            var divContents = document.getElementById(element);
            var a = window.open("", "", "height=500, width=500");
            a.document.write('<html><head><title>my div</title>');
            // a.document.write('`<link rel="stylesheet" href="{{ url('') }}/public/css/style.css" type="text/css" media="print"/>`');
            a.document.write(
                "<link rel='stylesheet' href='http://dhanpalthan.ourpalika.com/public/css/style.css' type='text/css' media='print'/>"
            );
            a.document.write('</head><body >');
            a.document.write(divContents.innerHTML);
            a.document.write("</body></html>");

            a.document.close();
            a.onload = function() {
                a.onafterprint = a.close;
                a.print();
            };
        };
    </script>





@endsection
