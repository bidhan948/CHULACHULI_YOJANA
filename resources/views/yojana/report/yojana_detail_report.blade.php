@section('title', 'सङ्ख्यात्मक रिपोर्ट')
@section('report_yojana', 'active')
@section('child_report', 'menu-open')
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
    <div id="vue_app">

        <div class="card">
            <div class="card-header">
                <h3>योजना विस्तृत रिपोर्ट</h3>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('अवस्था :') }}</span>
                                </div>
                                <select v-model="filterData.type_id" name="type_id" id="type_id"
                                    onchange="type_change(this)" class="form-control form-control-sm">
                                    <option value="">छान्नुहोस</option>
                                    <option value="1">योजनाहरुको अवस्था</option>
                                    <option value="2">योजनाहरुको संचालनको अवस्था</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3" id="yojana_running_type_col" style="display: none">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('योजनाहरु :') }}</span>
                                </div>
                                <select v-model="filterData.yojana_running_type" v-on:change="plans=[]" name="yojana_running_type"
                                    id="yojana_running_type" class="form-control form-control-sm">
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    <option value="1">सम्झौता भएका योजनाहरु</option>
                                    <option value="2">पेश्किको विवरण</option>
                                    <option value="3">मूल्याङ्कनको आधारमा भूक्तानी भएका योजनाहरु</option>
                                    <option value="4">अन्तिम भूक्तानी भएका योजनाहरु</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-3" id="yojana_amount_type_col" style="display: none">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('रकम अनुसार :') }}</span>
                                </div>
                                <select v-model="filterData.yojana_amount_type" name="yojana_amount_type"
                                    id="yojana_amount_type" class="form-control form-control-sm">
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    <option value="-50000">रु ५० हजार भन्दा कम लागतका योजनाहरु</option>
                                    <option value="50001-100000">रु ५० हजार देखि रु १ लाख सम्मका योजनाहरु</option>
                                    <option value="100001-500000">रु १ लाख देखि रु ५ लाख सम्मका योजनाहरु</option>
                                    <option value="500001-1000000">रु ५ लाख देखि रु १० लाख सम्मका योजनाहरु</option>
                                    <option value="1000001-">रु १० लाख भन्दा बढी लागतका योजनाहरु</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-5">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('वडा छान्नुहोस् :') }}</span>
                                </div>
                                <select v-model="filterData.ward_no" name="ward_no" id="ward_no"
                                    class="form-control form-control-sm">
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    @for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++)
                                        <option value="{{ $i }}">{{ $i == 0 ? 'गाउँपालिका' : Nepali($i) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <button v-on:click="search()" class="btn btn-sm btn-primary" id="search"><i
                                class="fa-solid fa-magnifying-glass px-1"></i>{{ __('खोज्नुहोस्') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-footer">

            </div>
        </div>
        <div>
            <table v-if="filterData.type_id==1" class="table w-100" id="firstTable">
                <thead class="bg-primary">
                    <tr>
                        <th scope="col">क्र.स.</th>
                        <th scope="col">योजनाको नाम</th>
                        <th scope="col">कार्यन्वयन हुन स्थान</th>
                        <th scope="col">रकम</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(plan,key) in plans">
                        <th scope="row" v-text='convertToNepaliDigit(plan.reg_no)'></th>
                        <td v-text="plan.name"></td>
                        <td>
                            <div v-for="(ward,key) in plan.plan_wards">
                                <p v-text="ward.ward_no==0 ? site_name : convertToNepaliDigit(ward.ward_no)"></p>
                            </div>
                        </td>
                        <td v-text="convertToNepaliDigit(plan.grant_amount)"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table v-if="filterData.yojana_running_type == 1" class="table w-100">
                <thead class="bg-primary">
                    <tr>
                        <td class="text-center font-weight-bold">{{ __('क्र.स') }}</td>
                        <td class="text-center font-weight-bold">{{ __('योजनाको नाम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('कार्यन्वयन स्थान') }}</td>
                        <td class="text-center font-weight-bold">{{ __('सम्झौता भएको संस्था/व्यक्ति') }}</td>
                        <td class="text-center font-weight-bold">{{ __('सम्झौता मिति') }}</td>
                        <td class="text-center font-weight-bold">{{ __('कार्यदेश रकम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('कुल रकम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('सम्पन्न हुने मिति') }}</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(plan,key) in plans">
                        <th scope="row" v-text='convertToNepaliDigit(plan.reg_no)'></th>
                        <td v-text="plan.name"></td>
                        <td>
                            <div v-for="(ward,key) in plan.plan_wards">
                                <p v-text="ward.ward_no==0 ? site_name : convertToNepaliDigit(ward.ward_no)"></p>
                            </div>
                        </td>
                        <td v-text="plan.type!=null ? plan.type.typeable.name  : 'विवरण छैन'"></td>
                        <td
                            v-text="convertToNepaliDigit(plan.other_bibaran!=null ? plan.other_bibaran.agreement_date_nep  : 'विवरण छैन')">
                        </td>
                        <td
                            v-text="convertToNepaliDigit(plan.kul_lagat!=null ? plan.kul_lagat.work_order_budget  : 'विवरण छैन')">
                        </td>
                        <td
                            v-text="convertToNepaliDigit(plan.kul_lagat!=null ? plan.kul_lagat.total_investment  : 'विवरण छैन')">
                        </td>
                        <td
                            v-text="convertToNepaliDigit(plan.other_bibaran!=null ? plan.other_bibaran.end_date  : 'विवरण छैन')">
                        </td>


                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table v-if="filterData.yojana_running_type == 2" class="table w-100">
                <thead class="bg-primary">
                    <tr>
                        <td class="text-center font-weight-bold">{{ __('क्र.स') }}</td>
                        <td class="text-center font-weight-bold">{{ __('योजनाको नाम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('कार्यन्वयन स्थान') }}</td>
                        <td class="text-center font-weight-bold">{{ __('सम्झौता भएको संस्था/व्यक्ति') }}</td>
                        <td class="text-center font-weight-bold">{{ __('सम्झौता मिति') }}</td>
                        <td class="text-center font-weight-bold">{{ __('कार्यदेश रकम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('पेस्की दिईएको रकम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('पेस्की दिईएको मिति') }}</td>
                        <td class="text-center font-weight-bold">{{ __('पेस्की फछ्यौॅट गर्नुपर्ने मिति') }}</td>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(plan,key) in plans">
                        <th scope="row" v-text='convertToNepaliDigit(plan.reg_no)'></th>
                        <td v-text="plan.name"></td>
                        <td>
                            <div v-for="(ward,key) in plan.plan_wards">
                                <p v-text="ward.ward_no==0 ? site_name : convertToNepaliDigit(ward.ward_no)"></p>
                            </div>
                        </td>
                        <td v-text="plan.type!=null ? plan.type.typeable.name  : 'विवरण छैन'"></td>
                        <td
                            v-text="convertToNepaliDigit(plan.other_bibaran!=null ? plan.other_bibaran.agreement_date_nep  : 'विवरण छैन')">
                        </td>
                        <td
                            v-text="convertToNepaliDigit(plan.kul_lagat!=null ? plan.kul_lagat.work_order_budget  : 'विवरण छैन')">
                        </td>
                        <td v-text="plan.advance!=null ? convertToNepaliDigit(plan.advance.peski_amount) : '' "></td>
                        <td v-text="plan.advance!=null ? plan.advance.advance_paid_date_nep : '' "></td>
                        <td v-text="plan.advance!=null ? plan.advance.advance_paid_date_nep : '' "></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table v-if="filterData.yojana_running_type == 3" class="table w-100">
                <thead class="bg-primary">
                    <tr>
                        <td class="text-center font-weight-bold">{{ __('क्र.स') }}</td>
                        <td class="text-center font-weight-bold">{{ __('योजनाको नाम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('कार्यन्वयन स्थान') }}</td>
                        <td class="text-center font-weight-bold">{{ __('सम्झौता भएको संस्था/व्यक्ति') }}</td>
                        <td class="text-center font-weight-bold">{{ __('सम्झौता मिति') }}</td>
                        <td class="text-center font-weight-bold">{{ __('कार्यदेश रकम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('विल भुक्तानी रकम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('भुक्तानी मिति') }}</td>
                        <td class="text-center font-weight-bold">{{ __('कार्य सम्पन्न गर्नुपर्ने मिति') }}</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(plan,key) in plans">
                        <th scope="row" v-text='convertToNepaliDigit(plan.reg_no)'></th>
                        <td v-text="plan.name"></td>
                        <td>
                            <div v-for="(ward,key) in plan.plan_wards">
                                <p v-text="ward.ward_no==0 ? site_name : convertToNepaliDigit(ward.ward_no)"></p>
                            </div>
                        </td>
                        <td v-text="plan.type!=null ? plan.type.typeable.name  : 'विवरण छैन'"></td>
                        <td
                            v-text="convertToNepaliDigit(plan.other_bibaran!=null ? plan.other_bibaran.agreement_date_nep  : 'विवरण छैन','-')">
                        </td>
                        <td
                            v-text="convertToNepaliDigit(plan.kul_lagat!=null ? plan.kul_lagat.work_order_budget  : 'विवरण छैन')">
                        </td>
                        <td>
                            <div>
                                <table>
                                    <thead>
                                        <tr v-for="(bill,r_key) in plan.running_bill_payment">
                                            <p>
                                                <td v-text="convert(r_key)"></td>
                                            </p>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(bill,key) in plan.running_bill_payment">
                                            <p>
                                                <td v-text="convertToNepaliDigit(bill.payable_amount)"></td>
                                            </p>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td>
                            <div>
                                <table>
                                    <thead>
                                        <tr v-for="(bill,r_key) in plan.running_bill_payment">
                                            <p>
                                                <td v-text="convert(r_key)"></td>
                                            </p>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(bill,key) in plan.running_bill_payment">
                                            <p>
                                                <td v-text="convertToNepaliString(bill.bill_payable_date,'-')">@{{ key + 1 }}</td>
                                            </p>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>

                        <td v-text="plan.other_bibaran.end_date">

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table v-if="filterData.yojana_running_type == 4" class="table w-100">
                <thead class="bg-primary">
                    <tr>
                        <td class="text-center font-weight-bold">{{ __('क्र.स') }}</td>
                        <td class="text-center font-weight-bold">{{ __('योजनाको नाम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('कार्यन्वयन स्थान') }}</td>
                        <td class="text-center font-weight-bold">{{ __('भुक्तानी दिइएको संस्था/व्यक्ति') }}</td>
                        <td class="text-center font-weight-bold">{{ __('सम्झौता मिति') }}</td>
                        <td class="text-center font-weight-bold">{{ __('कार्यदेश रकम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('प्राविधिक मुल्यांकन रकम') }}</td>

                        <td v-for='ded in deductions' class="text-center font-weight-bold">@{{ ded.name }}</td>

                        {{-- <td class="text-center font-weight-bold">{{ __('अग्रिम आय कर कट्टी रकम') }}</td>
                    <td class="text-center font-weight-bold">{{ __('पारिश्रमिक कर कट्टी रकम') }}</td>
                    <td class="text-center font-weight-bold">{{ __('सा.सु कर कट्टी रकम') }}</td>
                    <td class="text-center font-weight-bold">{{ __('धरौटी कट्टी रकम') }}</td> --}}
                        <td class="text-center font-weight-bold">{{ __('कन्टिनजेन्सी कर कट्टी रकम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('खुद भुक्तानी भएको रकम') }}</td>
                        <td class="text-center font-weight-bold">{{ __('भुक्तानी मिति ') }}</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(plan,key) in plans">
                        <th scope="row" v-text='convertToNepaliDigit(plan.reg_no)'></th>
                        <td v-text="plan.name"></td>
                        <td>
                            <div v-for="(ward,key) in plan.plan_wards">
                                <p v-text="ward.ward_no==0 ? site_name : convertToNepaliDigit(ward.ward_no)"></p>
                            </div>
                        </td>
                        <td v-text="plan.type!=null ? plan.type.typeable.name : ''"></td>
                        <td v-text="plan.other_bibaran!=null ? convertToNepaliString(plan.other_bibaran.agreement_date_nep,'-')  : '' "></td>
                        <td v-text="plan.kul_lagat!=null ? convertToNepaliDigit(plan.kul_lagat.work_order_budget) : '' ">
                        </td>
                        <td
                            v-text="plan.final_payment!=null ? convertToNepaliDigit(plan.final_payment.hal_mulyankan) : '' ">
                        </td>

                        <td v-for='ded in deductions' class="text-center font-weight-bold">@{{ convertToNepaliDigit(getDeductionFromPlan(ded.id, plan.final_payment.final_payment_deatils)) }}</td>
                        <td
                            v-text="plan.final_payment!=null ? convertToNepaliDigit(plan.final_payment.final_contingency_amount) : '' ">
                        </td>
                        <td
                            v-text="plan.final_payment!=null ? convertToNepaliDigit(plan.final_payment.final_total_paid_amount) : '' ">
                        </td>
                        <td
                            v-text="plan.final_payment!=null ? convertToNepaliString(plan.final_payment.assessment_date,'-') : '' ">
                        </td>

                        {{-- <td  v-for="(deduction,key) in plan.final_payment.final_payment_deatils" class="text-center font-weight-bold"></td> --}}
                    </tr>
                </tbody>
            </table>
           
        </div>
        <div class="text-center">
            <nav v-if="plans.length>0" aria-label="Page navigation example">
                <ul class="pagination">
                  <li v-for="index in last_page" v-on:click="paginateClick(index)" id="link" :class="index== current_page ? 'page-item active' : ''"><a class="page-link">@{{index}}</a></li>
                </ul>
              </nav>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vue/bundle.js') }}"></script>
    <script>
        const report = new Vue({
            el: "#vue_app",
            data: {
                plans: [],
                deductions: @json($deduction),
                number: {
                    '0': 'पहिलो',
                    '1': 'दोस्रो',
                    '2': 'तेस्रो',
                    '3': 'चौथो',
                    '4': 'पाँचौ',
                },
                pages: [],
                current_page: '',
                last_page: '',
                per_page: 0,
                current_index: '',
            links: [],
                filterData: {
                    type_id: '',
                    ward_no: '',
                    yojana_amount_type: '',
                    yojana_running_type: '',
                },
                site_name: @json(config('constant.SITE_TYPE'))
            },
            methods: {
                getDeductionFromPlan(deduction_id, plan_deduction) {
                    let deduction = plan_deduction.filter(x => x.deduction_id == deduction_id)[0];
                    // console.log(deduction? deduction.deduction_amount : 0);
                    return deduction ? deduction.deduction_amount : '0';
                },

                convertToNepaliString(number, character) {
                    if (!number) return '';
                    var number = number.toString();
                    var splitted_number = number.split(character);
                    var item = '';
                    for (let index = 0; index < splitted_number.length; index++) {
                        const element = splitted_number[index];
                        item += convertToNepaliDigit(element);
                        if (index != splitted_number.length - 1) item += character;
                    }

                    return item;
                },
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

                search: function() {
                    let vm = this;
                    axios.post("{{ route('api.yojana.report') }}", vm.filterData)
                        .then(function(response) {
                            console.log(response);
                            vm.plans = response.data.plan.data;
                            vm.links = response.data.plan.links; 
                            vm.last_page = response.data.plan.last_page;
                            // console.log(vm.links);
                        })
                        .catch(function(error) {
                            console.log(error);
                            alert("Some Problem Occured");
                        });
                },

                paginateClick: function(index) {
                    let vm = this;
                    vm.filterData.page = index;
                    axios.post("{{ route('api.yojana.report') }}", vm.filterData)
                        .then(function(response) {
                                vm.plans = response.data.plan.data;
                                vm.links = response.data.plan.links; 
                                vm.current_page = response.data.plan.current_page;
                                vm.current_index = index;
                                console.log(vm.plans);
                    })
                        .catch(function(error) {
                            console.log(error);
                            alert("Some Problem Occured");
                        });
                },

                convert: function(param) {
                    let vm = this;
                    return vm.number[param];
                }
            },
            mounted() {
                let vm = this;
            }
        });
    </script>
    <script>
        function type_change(event) {
            if (event.value == 1) {
                document.getElementById('yojana_amount_type_col').style = "display: block;";
                document.getElementById('yojana_running_type_col').style = "display: none;";
                document.getElementById('yojana_running_type_col').value = "";
                report._data.filterData.yojana_running_type = "";
            } else {
                document.getElementById('yojana_amount_type_col').style = "display: block;";
                document.getElementById('yojana_amount_type_col').value = "";
                document.getElementById('yojana_running_type_col').style = "display: block;";
                report._data.filterData.yojana_amount_type = "";
            }
        }

        function search() {
            let type = $('#type_id').val();
            if (type == 1) {

            }
        }
    </script>
@endsection
