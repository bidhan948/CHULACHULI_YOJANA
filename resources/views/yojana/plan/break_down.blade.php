@section('title', 'योजना / कार्यक्रम टुक्राउनुहोस्')
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
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .select2-selection__choice {
            color: black !important;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="container mt-2">
                <div class="col-12 bg-primary">
                    <p class="p-1 mb-1 text-center">मुख्य योजना : {{ $plan->name }} || <span
                            class="mx-1">विनियोजित
                            बजेट : रु. {{ NepaliAmount($plan->grant_amount) }}</span></p>
                </div>
                @foreach ($plan->Parents as $parent)
                    <div class="col-12 bg-primary">
                        <p class="p-2 mb-1 text-center">मुख्य योजना : {{ $parent->name }} || <span
                                class="mx-1">विनियोजित
                                बजेट : रु. {{ NepaliAmount($parent->grant_amount) }}</span></p>
                    </div>
                @endforeach
                <div class="col-12 bg-primary">
                    <p class="my-1 p-1 mb-1 text-center">मुख्य योजनाको बाकी विनियोजित रकम : रु.
                        {{ NepaliAmount($plan->grant_amount - $plan->parents->sum('grant_amount')) }}</p>
                </div>
            </div>
            <div class="card-header">
                <h3 class="card-title">{{ __('नयाँ योजनाको विवरण भर्नुहोस्') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ route('plan.breakdown', $plan->id) }}">
                    @csrf
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('किसिम') }}
                                            <span id="type_id_group"
                                                class="text-danger font-weight-bold px-1">*</span></span>
                                    </div>
                                    <select id="type_id" class="form-control @error('type_id') is-invalid @enderror"
                                        name="type_id">
                                        @foreach (config('YOJANA.TYPE') as $key => $type)
                                            @if ($key == $plan->type_id)
                                                <option value="{{ $key }}" selected>
                                                    {{ $type}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('type_id')
                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                            {{ __('किसिम फिल्ड अनिवार्य छ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('योजना / कार्यक्रमको नाम :') }}
                                            <span id="budget_source_id_group"
                                                class="text-danger font-weight-bold px-1">*</span></span>
                                    </div>
                                    <textarea name="name" class="form-control form-control-sm @error('type_id') is-invalid @enderror"></textarea>
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                            {{ __('योजना / कार्यक्रमको फिल्ड अनिवार्य छ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('क्षेत्र ') }}
                                            <span id="topic_id_group"
                                                class="text-danger font-weight-bold px-1">*</span></span>
                                    </div>
                                    <select id="topic_id" class="form-control @error('topic_id_group') is-invalid @enderror"
                                        name="topic_id" required>
                                        <option value="">{{ __('--छान्नुहोस्--') }}
                                        </option>
                                        @foreach ($topics->settingValues as $topic)
                                            @if ($topic->id == $plan->topic_id)
                                                <option value="{{ $topic->id }}" selected>
                                                    {{ $topic->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('उपक्षेत्र ') }}
                                            <span id="topic_area_type_id_group"
                                                class="text-danger font-weight-bold px-1">*</span></span>
                                    </div>
                                    <select id="topic_area_type_id" name="topic_area_type_id"
                                        class="form-control @error('topic_area_type_id') is-invalid @enderror" required>
                                        <option value="">{{ __('--छान्नुहोस्--') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('खर्च किसिम') }}
                                            <span id="expense_type_id_group"
                                                class="text-danger font-weight-bold px-1">*</span></span>
                                    </div>
                                    <select id="expense_type_id" class="form-control" name="expense_type_id">
                                        <option value="">{{ __('--छान्नुहोस्--') }}
                                        </option>
                                        @foreach ($expense_types->settingValues as $expense_type)
                                            <option value="{{ $expense_type->id }}">
                                                {{ $expense_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('विनियोजन किसिम:') }}
                                            <span id="type_of_allocation_id_group"
                                                class="text-danger font-weight-bold px-1">*</span></span>
                                    </div>
                                    <select id="type_of_allocation_id" name="type_of_allocation_id" class="form-control"
                                        required>
                                        <option value="">{{ __('--छान्नुहोस्--') }}
                                        </option>
                                        @foreach ($type_of_allocations->settingValues as $type_of_allocation)
                                            <option value="{{ $type_of_allocation->id }}">
                                                {{ $type_of_allocation->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="wada_stariya">

                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('संचालन हुने वडा') }}
                                            <span id="ward_group" class="text-danger font-weight-bold px-1">*</span></span>
                                    </div>
                                    <select name="ward_no[]" class="select2 form-control form-control-sm"
                                        multiple="multiple" data-placeholder="संचालन हुने वडा छान्नुहोस्" required>
                                        <option value="">{{ __('--छान्नुहोस्--') }}
                                        </option>
                                        @for ($i = 1; $i < 20; $i++)
                                            <option value="{{ $i }}">वडा नं {{ Nepali($i) }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6" id="cross">
                            <div class="form-group mt-2 aa">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('बजेट शिर्षक ') }}
                                            <span id="budget_source_id_group"
                                                class="text-danger font-weight-bold px-1">*</span></span>
                                    </div>
                                    <select id="budget_source_id" class="form-control select3" multiple="multiple"
                                        data-placeholder="--छान्नुहोस्--">
                                        @foreach ($plan->budgetSourcePlanDetails as $budgetSource)
                                            <option value="{{ $budgetSource->id }}" selected disabled>
                                                {{ $budgetSource->budgetSources->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="table1" width="100%" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('बजेट शिर्षक') }}</th>
                                <th class="text-center">{{ __('रकम') }}</th>
                                <th class="text-center">{{ __('जम्मा') }}</th>
                                <th class="text-center">{{ __('बाँकि') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plan->budgetSourcePlanDetails as $budgetSource)
                                    @php
                                        $sirsak = 0;
                                    @endphp
                                    @foreach ($plan->Parents as $child)
                                        @foreach ($child->budgetSourcePlanDetails as $item)
                                            @if ($item->budget_source_id == $budgetSource->budget_source_id)
                                                @php
                                                    $sirsak += $item->amount;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <tr>
                                        <td class="text-center"><input type="text" class="form-control form-control-sm"
                                                name="budget_source_name[]"
                                                value="{{ $budgetSource->budgetSources->name }}" readonly></td>
                                        <td class="text-center"><input type="number"
                                                id="amount_{{ $budgetSource->id }}"
                                                onkeyup="calculateBakiAmount({{ $budgetSource->id }})" step="0.1"
                                                class="form-control form-control-sm amount"
                                                name="rakam[{{ $budgetSource->id }}]"></td>
                                        <td>
                                            <input class="form-control form-control-sm"
                                                id="jamma_{{ $budgetSource->id }}"
                                                value="{{ $budgetSource->amount - $sirsak}}"
                                                disabled>
                                        </td>
                                        <td class="text-center"><input class="form-control form-control-sm"
                                                id="baki_{{ $budgetSource->id }}" readonly></td><input type="hidden"
                                            class="budget_source_id" name="budget_source_id[]"
                                            value="{{ $budgetSource->budget_source_id }}">
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('अनुदान रु: ') }}
                                            <span id="grant_amount_group"></span></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" name="grant_amount" readonly
                                        id="grant_amount">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('बिनियोजन श्रोत र व्याख्या: ') }}
                                            <span id="budget_source_id_group"></span></span>
                                    </div>
                                    <textarea name="detail" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('पहिलो चौमासिक:') }}
                                            <span id="first_installment_group"></span></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm installment"
                                        name="first_installment" id="first_installment">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('दोस्रो चौमासिक') }}
                                            <span id="second_installment_group"></span></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm installment"
                                        name="second_installment" id="second_installment">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('तेस्रो चौमासिक:') }}
                                            <span id="third_installment_group"></span></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" name="third_installment"
                                        id="third_installment" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary">{{ __('सेभ गर्नुहोस्') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        let grant_amount = 0;
        let data = [];
        let count = 0;
        let arrayCheck = [];
        $(function() {
            $('.select2').select2()
            $('.select3').select2();
            var settingId = $("#topic_id").val();
            axios.get("{{ route('api.getTopicAreaType') }}", {
                    params: {
                        setting_id: settingId
                    }
                }).then(function(response) {
                    $("#topic_area_type_id").html(response.data.html);
                })
                .catch(function(error) {
                    console.log(error);
                    alert("Something went wrong");
                });
            $("#topic_id").on("change", function() {
                var settingId = $("#topic_id").val();
                axios.get("{{ route('api.getTopicAreaType') }}", {
                        params: {
                            setting_id: settingId
                        }
                    }).then(function(response) {
                        $("#topic_area_type_id").html(response.data.html);
                    })
                    .catch(function(error) {
                        console.log(error);
                        alert("Something went wrong");
                    });
            });

            $("#type_of_allocation_id").on("change", function() {
                var settingId = $("#type_of_allocation_id").val();
                if (settingId == {{ config('constant.wada_stariya_id') }}) {
                    html = '<div class="col-12">'
                            +'<div class="form-group mt-2">'
                                +'<div class="input-group input-group-sm">'
                                    +'<div class="input-group-prepend">'
                                        +'<span class="input-group-text">{{ __("संचालन गर्ने वडा") }}'
                                            +'<span id="ward_group" class="text-danger font-weight-bold px-1">*</span></span>'
                                    +'</div>'
                                    +'<select name="is_main" class="form-control form-control-sm" required>'
                                        +'<option value="">{{ __("--छान्नुहोस्--") }}'
                                        +'</option>'
                                        +'@for ($i = 1; $i < 20; $i++)'
                                            +'<option value="{{ $i }}">वडा नं {{ Nepali($i) }}</option>'
                                        +'@endfor'
                                    +'</select>'
                                +'</div>'
                            +'</div>'
                        +'</div>';
                    $("#wada_stariya").html(html);
                    $("#wada_stariya").css("width", "50%");
                } else {
                    $("#wada_stariya").html("");
                    $("#wada_stariya").css("width", "0%");
                }
            });


            $(".installment").on("keyup", function() {
                third_installment = 0;
                $('.installment').each(function() {
                    third_installment += Number($(this).val()) || 0;
                });
                third_installment = $("#grant_amount").val() - third_installment;
                if (third_installment < 0) {
                    alert('रकम मिलेन');
                    $('.installment').val(0);
                    $("#third_installment").val(0)
                } else {
                    $("#third_installment").val(third_installment)
                }
            })

            $("#topic_id").on("change", function() {
                var settingId = $("#topic_id").val();
                axios.get("{{ route('api.getTopicAreaType') }}", {
                        params: {
                            setting_id: settingId
                        }
                    }).then(function(response) {
                        $("#topic_area_type_id").html(response.data.html);
                    })
                    .catch(function(error) {
                        console.log(error);
                        alert("Something went wrong");
                    });
            });
        });

        function calculateBakiAmount(budget_source_id) {
            amount = +$("#amount_" + budget_source_id).val();
            jamma = +$("#jamma_" + budget_source_id).val();
            if (jamma < amount) {
                grant_amount = 0
                alert('रकम बढी भयो');
                $("#amount_" + budget_source_id).val(0)
                $('.amount').each(function() {
                    grant_amount += Number($(this).val()) || 0;
                });
                $("#grant_amount").val(grant_amount);
                $("#baki_" + budget_source_id).val(jamma);
            } else {
                grant_amount = 0;
                $("#baki_" + budget_source_id).val(jamma - amount);
                $('.amount').each(function() {
                    grant_amount += Number($(this).val()) || 0;
                });
                $("#grant_amount").val(grant_amount);
            }
        }
    </script>
@endsection
