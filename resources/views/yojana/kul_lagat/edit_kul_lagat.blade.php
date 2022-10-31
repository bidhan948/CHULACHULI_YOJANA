@section('title', 'कुल लागत सच्याउनुहोस')
@section('operate_plan', 'active')
@extends('layout.layout')
@section('sidebar')
    @include('layout.yojana_sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">{{ __('कुल लागत') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <div class="col-6 text-right">
                            <a onclick="event.preventDefault(); document.getElementById('form').submit();"
                                class="btn btn-sm btn-primary"><i
                                    class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                            <form id="form" action="{{ route('plan-operate.searchSubmit') }}" method="POST"
                                class="d-none">
                                @csrf
                                <input type="hidden" name="type_id" value="{{ session('type_id') }}">
                                <input type="hidden" name="reg_no" value="{{ $plan->reg_no }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-0 bg-primary text-center">{{ __('योजना दर्ता नं : ') }} {{ Nepali($regNo) }}</p>
                        <form method="POST" action="{{ route('kul_lagat.update', $kul_lagat) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                {{-- start of napa amount --}}
                                <div class="col-6 mt-2">
                                    <div class="form-group mt-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('भौतिक परिमाण :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control amount @error('quantity') is-invalid @enderror"
                                                name="quantity" id="quantity" value="{{ $kul_lagat->quantity }}">
                                            @error('quantity')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('भौतिक परिमाणको नाम अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-group mt-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('भौतिक इकाई :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <select name="unit_id" id="unit_id"
                                                class="form-control @error('quantity') is-invalid @enderror">
                                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                @foreach ($units as $key => $unit)
                                                    <option value="{{ $unit->id }}"
                                                        {{ $unit->id == $kul_lagat->unit_id ? 'selected' : '' }}>
                                                        {{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('unit_id')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('भौतिक इकाईको नाम अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mt-2">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('गाउँपालिका अनुदान :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control napa-amount @error('napa_amount') is-invalid @enderror"
                                                name="napa_amount" value="{{ $plan->grant_amount }}" id="napa_amount"
                                                readonly>
                                            @error('napa_amount')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('नगरपालिकाबाट अनुदान अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <input type="checkbox" id="napa_contingency" name="napa_contingency_check"
                                                    {{ $kul_lagat->napa_contingency == null ? '' : 'checked' }}>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control text-danger font-09"
                                            value="{{ __('कन्टेन्जेन्सी काट्ने भएमा टिक लगाउनुहोस') }}" disabled
                                            style="font-size: 0.9rem">
                                    </div>
                                </div>
                                <div class="col-4 mt-2">
                                    <div class="form-group mt-2 contingency" id="napa_contingency_div">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('कन्टेन्जेन्सी (%)') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text" class="form-control amount"
                                                onkeyup="calculateNapaAmount(event)" name="napa_contingency"
                                                id="napa_contingency_percent"
                                                value="{{ $kul_lagat->napa_contingency != null ? $kul_lagat->napa_contingency : $contingency->percent }}">
                                        </div>
                                    </div>
                                </div>
                                {{-- end of napa amount --}}
                                {{-- strat of anaya nikaya --}}
                                <div class="col-3">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('अन्य निकायबाट प्राप्त अनुदान :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control amount contribution @error('other_office_con') is-invalid @enderror"
                                                name="other_office_con"
                                                value="{{ $kul_lagat->other_office_con == null ? 0 : $kul_lagat->other_office_con }}"
                                                id="other_office_con">
                                            @error('other_office_con')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('अन्य निकायबाट प्राप्त अनुदान अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 mt-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <input type="checkbox" id="other_office_con_contingency_check"
                                                    name="other_office_con_contingency_check"
                                                    {{ $kul_lagat->other_office_con_contingency == null ? '' : 'checked' }}>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control text-danger font-09"
                                            value="{{ __('कन्टेन्जेन्सी काट्ने भएमा टिक लगाउनुहोस') }}" disabled
                                            style="font-size: 0.9rem">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mt-2 contingency" id="other_office_con_div">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('कन्टेन्जेन्सी (%)') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control amount @error('other_office_con_contingency_check') is-invalid @enderror"
                                                name="other_office_con_contingency"
                                                value="{{ $kul_lagat->other_office_con_contingency == null ? $contingency->percent : $kul_lagat->other_office_con_contingency }}"
                                                id="other_office_con_contingency" onkeyup="calculateAnyaNikaya(event)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mt-2 " id="">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('श्रोत') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control @error('other_office_con_name') is-invalid @enderror"
                                                name="other_office_con_name"
                                                value="{{ $kul_lagat->other_office_con_name }}"
                                                id="other_office_con_name">
                                        </div>
                                    </div>
                                </div>
                                {{-- end of nikaya --}}

                                {{-- strat of anaya sajhedari --}}
                                <div class="col-3">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('अन्य साझेदारी : ') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control amount contribution @error('other_office_agreement') is-invalid @enderror"
                                                name="other_office_agreement"
                                                value="{{ $kul_lagat->other_office_agreement == null ? 0 : $kul_lagat->other_office_agreement }}"
                                                id="other_office_agreement">
                                            @error('other_office_agreement')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('अन्य साझेदारी  अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 mt-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <input type="checkbox" id="other_agreement_contingency_check"
                                                    name="other_agreement_contingency_check"
                                                    {{ $kul_lagat->other_agreement_contingency == null ? '' : 'checked' }}>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control text-danger font-09"
                                            value="{{ __('कन्टेन्जेन्सी काट्ने भएमा टिक लगाउनुहोस') }}" disabled
                                            style="font-size: 0.9rem">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mt-2 contingency" id="other_contingency_con_div">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('कन्टेन्जेन्सी (%)') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text" class="form-control amount"
                                                name="other_agreement_contingency"
                                                value="{{ $kul_lagat->other_agreement_contingency == null ? $contingency->percent : $kul_lagat->other_agreement_contingency }}"
                                                id="other_agreement_contingency" onkeyup="calculateAnyaSajhedari(event)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group mt-2 " id="">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('श्रोत') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text" class="form-control" name="other_contingency_con_name"
                                                value="{{ $kul_lagat->other_contingency_con_name }}"
                                                id="other_contingency_con_name">
                                        </div>
                                    </div>
                                </div>
                                {{-- end of anya sajhedari --}}

                                {{-- strat of upabhokta nagad sajhedari --}}
                                <div class="col-4">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text ">{{ config('TYPE.' . session('type_id')) . __('बाट नगद साझेदारी :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control contribution amount @error('customer_agreement') is-invalid @enderror"
                                                name="customer_agreement"
                                                value="{{ $kul_lagat->customer_agreement == null ? 0 : $kul_lagat->customer_agreement }}"
                                                id="customer_agreement">
                                            @error('customer_agreement')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ config('TYPE.' . session('type_id')) . __('बाट नगद साझेदारी अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mt-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <input type="checkbox" id="customer_agreement_check"
                                                    name="customer_agreement_check"
                                                    {{ $kul_lagat->customer_agreement_contingency == null ? '' : 'checked' }}>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control text-danger font-09"
                                            value="{{ __('कन्टेन्जेन्सी काट्ने भएमा टिक लगाउनुहोस') }}" disabled
                                            style="font-size: 0.9rem">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mt-2 contingency" id="customer_agreement_div">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('कन्टेन्जेन्सी (%)') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text" class="form-control amount"
                                                name="customer_agreement_contingency"
                                                value="{{ $kul_lagat->customer_agreement_contingency == null ? 0 : $kul_lagat->customer_agreement_contingency }}"
                                                id="customer_agreement_contingency">
                                        </div>
                                    </div>
                                </div>
                                {{-- end of upabhokta nagad sajhedari --}}

                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('कार्यदेश दिएको रकम :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text" class="form-control" name="work_order_budget"
                                                id="work_order_budget" value="{{ $kul_lagat->work_order_budget }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text ">{{ config('TYPE.' . session('type_id')) . __('बाट जनश्रमदान :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control amount  @error('consumer_budget') is-invalid @enderror"
                                                name="consumer_budget" id="consumer_budget"
                                                value="{{ $kul_lagat->consumer_budget }}" required>
                                            @error('consumer_budget')
                                                {{ config('TYPE.' . session('type_id')) . __('बाट जनश्रमदान खाली छ') }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('कुल लागत अनुमान जम्मा :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control amount  @error('total_investment') is-invalid @enderror"
                                                name="total_investment" id="total_investment"
                                                value="{{ $kul_lagat->total_investment }}" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($show_form)
                                <button type="submit" class="btn btn-sm btn-primary"
                                    onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?')">{{ __('सेभ गर्नुहोस्') }}</button>
                            @endif
                        </form>
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
    <script>
        let workOrderBudget = +{{ $amount['napa_amount'] }};
        let otherOfficeCon = +{{ $amount['other_office_con'] }};
        let otherOfficeAgreement = +{{ $amount['other_office_agreement'] }};
        let customerAgreement = +{{ $amount['customer_agreement'] }};
        let initialContigency = +{{ $contingency->percent }};
        const napaAmount = +$("#napa_amount").val();
        $(function() {
            // workOrderBudget = +$("#napa_amount").val();
            // setWorkOrderBudget(workOrderBudget);

            $("#napa_contingency").on("change", function() {
                isChecked = $(this).is(':checked');
                if (isChecked) {
                    workOrderBudget = calculateWorkOrderBudget(napaAmount, +$("#napa_contingency_percent")
                        .val());

                    setWorkOrderBudget(workOrderBudget + otherOfficeCon + otherOfficeAgreement +
                        customerAgreement);
                    $("#napa_contingency_div").css("display", "");
                } else {
                    workOrderBudget = napaAmount;
                    setWorkOrderBudget(workOrderBudget + otherOfficeAgreement + customerAgreement +
                        otherOfficeCon)
                    console.log(workOrderBudget, otherOfficeAgreement, customerAgreement);
                    $("#napa_contingency_div").css("display", "none");
                }
            });

            $("#other_office_con_contingency_check").on("change", function() {
                isChecked = $(this).is(':checked');
                if (isChecked) {
                    $("#other_office_con_div").css("display", "");
                    $("#other_office_con_name_div").css("display", "");
                    otherOfficeCon = calculateWorkOrderBudget(otherOfficeCon, +$(
                        "#other_office_con_contingency").val());
                    total = workOrderBudget + otherOfficeCon + otherOfficeAgreement + customerAgreement;
                    setWorkOrderBudget(total);
                } else {
                    setWorkOrderBudget(+$("#work_order_budget").val() - otherOfficeCon + (+$(
                        "#other_office_con").val()));
                    otherOfficeCon = +$("#other_office_con").val();
                    $("#other_office_con_div").css("display", "none");
                    $("#other_office_con_name_div").css("display", "none");
                }
            });

            $("#other_agreement_contingency_check").on("change", function() {
                isChecked = $(this).is(':checked');
                if (isChecked) {
                    $("#other_contingency_con_div").css("display", "");
                    $("#other_contingency_con_name_div").css("display", "");
                    otherOfficeAgreement = calculateWorkOrderBudget(otherOfficeAgreement, +$(
                        "#other_agreement_contingency").val());
                    total = workOrderBudget + otherOfficeCon + otherOfficeAgreement + customerAgreement;
                    setWorkOrderBudget(total);
                } else {
                    setWorkOrderBudget(+$("#work_order_budget").val() - otherOfficeAgreement + (+$(
                        "#other_office_agreement").val()));
                    otherOfficeAgreement = +$("#other_office_agreement").val();
                    $("#other_contingency_con_div").css("display", "none");
                    $("#other_contingency_con_name_div").css("display", "none");
                }
            });

            $("#customer_agreement_check").on("change", function() {
                isChecked = $(this).is(':checked');
                if (isChecked) {
                    $("#customer_agreement_div").css("display", "");
                    customerAgreement = calculateWorkOrderBudget(customerAgreement, +$(
                        "#customer_agreement_contingency").val());
                    total = workOrderBudget + otherOfficeCon + otherOfficeAgreement + customerAgreement;
                    setWorkOrderBudget(total);
                } else {
                    setWorkOrderBudget(+$("#work_order_budget").val() - customerAgreement + (+$(
                        "#customer_agreement").val()));
                    customerAgreement = +$("#customer_agreement").val();
                    $("#customer_agreement_div").css("display", "none");
                }
            });

            $("#other_office_con").on("keyup", function() {
                total = +$("#other_office_con").val() || 0;
                if ($("#other_office_con_contingency_check").is(":checked")) {
                    total = calculateWorkOrderBudget(total, +($("#other_office_con_contingency").val()));
                }
                setWorkOrderBudget(workOrderBudget + total + otherOfficeAgreement + customerAgreement);
                otherOfficeCon = total;
            });

            $("#other_office_agreement").on("keyup", function() {
                total = +$("#other_office_agreement").val() || 0;
                if ($("#other_agreement_contingency_check").is(":checked")) {
                    total = calculateWorkOrderBudget(total, +($("#other_agreement_contingency").val()));
                }
                setWorkOrderBudget(workOrderBudget + total + otherOfficeCon + customerAgreement);
                otherOfficeAgreement = total;
            });

            $("#customer_agreement").on("keyup", function() {
                total = +$("#customer_agreement").val() || 0;
                if ($("#customer_agreement_check").is(":checked")) {
                    total = calculateWorkOrderBudget(total, +($("#customer_agreement_contingency").val()));
                }
                setWorkOrderBudget(workOrderBudget + total + otherOfficeCon + otherOfficeAgreement);
                customerAgreement = total;
            });

            $("#consumer_budget").on("keyup", function() {
                total_investment = +($("#work_order_budget").val()) + +($("#consumer_budget").val());
                $("#total_investment").val(parseFloat(total_investment).toFixed(2));
            });
        });

        function calculateNapaAmount(event) {
            if (event.target.value == '') {
                setWorkOrderBudget(napaAmount + otherOfficeCon + otherOfficeAgreement + customerAgreement);
            } else {
                workOrderBudget = calculateWorkOrderBudget(napaAmount, event.target.value);
                setWorkOrderBudget(workOrderBudget + otherOfficeCon + otherOfficeAgreement + customerAgreement);
            }
        }

        function calculateAnyaNikaya(event) {
            if (event.target.value == '') {
                setWorkOrderBudget(workOrderBudget + +($("#other_office_con").val()) + otherOfficeAgreement);
                otherOfficeCon = $("#other_office_con").val();
            } else {
                total = calculateWorkOrderBudget(+$("#other_office_con").val(), +($("#other_office_con_contingency").val()))
                setWorkOrderBudget(workOrderBudget + total + otherOfficeAgreement);
                otherOfficeCon = total;
            }
        }

        function calculateAnyaSajhedari(event) {
            if (event.target.value == '') {
                setWorkOrderBudget(workOrderBudget + +($("#other_office_agreement").val()) + otherOfficeCon);
                otherOfficeAgreement = $("#other_office_agreement").val();
            } else {
                total = calculateWorkOrderBudget(+$("#other_office_agreement").val(), +($("#other_agreement_contingency")
                    .val()))
                setWorkOrderBudget(workOrderBudget + total + otherOfficeCon);
                otherOfficeAgreement = total;
            }
        }

        function setWorkOrderBudget(params) {
            $("#work_order_budget").val(parseFloat(params).toFixed(2));
            $("#total_investment").val((parseFloat(params) + +$("#consumer_budget").val()).toFixed(2));
        }

        function calculateWorkOrderBudget(amount, params) {
            return amount * ((100 - params) / 100)
        }

        function getTotalFromClass() {
            total = 0
            $('.contribution').each(function() {
                total += Number($(this).val()) || 0;
            });
            return total;
        }
    </script>
@endsection
