@section('title', 'नयाँ योजना / कार्यक्रम ')
@section('new_plan', 'active')
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
            <div class="card-header">
                <h3 class="card-title">{{ __('नयाँ योजनाको विवरण भर्नुहोस्') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ route('plan.store') }}">
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
                                    <select name="type_id" class="form-control @error('type_id') is-invalid @enderror">
                                        <option value="">{{ __('--छान्नुहोस्--') }}
                                        </option>
                                        @foreach (config('YOJANA.TYPE') as $key => $type)
                                            <option value="{{ $key }}">
                                                {{ $type }}</option>
                                        @endforeach
                                    </select>
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
                                    <textarea name="name" class="form-control form-control-sm"></textarea>
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
                                    <select id="topic_id" class="form-control" name="topic_id" required>
                                        <option value="">{{ __('--छान्नुहोस्--') }}
                                        </option>
                                        @foreach ($topics->settingValues as $topic)
                                            <option value="{{ $topic->id }}">
                                                {{ $topic->name }}</option>
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
                                    <select id="topic_area_type_id" name="topic_area_type_id" class="form-control"
                                        required>
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
                                        @for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++)
                                        @if (!$i)
                                            <option value="{{ $i }}">{{config('constant.SITE_TYPE')}}</option>
                                        @else
                                            <option value="{{ $i }}">वडा नं {{ Nepali($i) }}</option>
                                        @endif
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
                                        @foreach ($budget_sources as $budget_source)
                                            <option value="{{ $budget_source->id }}">
                                                {{ $budget_source->name }}</option>
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
                        <tbody id="row">

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
                            <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?');">{{ __('सेभ गर्नुहोस्') }}</button>
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
        let budgetSources = @json($budget_sources);
        let grant_amount = 0;
        let data = [];
        let count = 0;
        let arrayCheck = [];
        $(function() {
            $('.select2').select2()
            $('.select3').select2();
            $("#table1").css('display', 'none');
            $("#budget_source_id").on("change", function() {
                count = ($("#budget_source_id").val().length);
                $(".select2-selection__rendered").css("display", '');
                var array = $("#budget_source_id").val();
                var temp = $('#budget_source_id option:selected').map(function(i, v) {
                    return this.value;
                }).get();
                count += temp.length - 1;
                $('#budget_source_id option:selected').prop('disabled', true);
                if (arrayCheck.length == 0) {
                    arrayCheck.push(array[0]);
                } else {
                    array.forEach(element => {
                        if (!arrayCheck.includes(element)) {
                            arrayCheck.push(element);
                        }
                    })
                }

                var budgetSourceId = arrayCheck.slice(-1)[0];
                if (budgetSourceId == '') {
                    alert('बजेट शीर्षक छान्नुहोस् ');
                    $("#table1").css('display', 'none');
                } else {
                    axios.get("{{ route('api.getBudgetSourceAmount') }}", {
                            params: {
                                budget_source_id: budgetSourceId
                            }
                        }).then(function(response) {
                            $("#table1").css('display', '');
                            $("#row").append(response.data.html);
                        })
                        .catch(function(error) {
                            alert("Something went wrong");
                        });
                }
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
        });

        function removeTR(budget_source_id) {
            html = '';
            amount = $("#amount_" + budget_source_id).val();
            grant_amount = +$("#grant_amount").val();
            $("#grant_amount").val(grant_amount - amount);

            arrayCheck = arrayCheck.filter(function(value, index, arr) {
                return value != budget_source_id;
            });

            if (data.includes(budget_source_id)) {
            } else {
                data.push(budget_source_id);
            }
            var temp = $('#budget_source_id option:selected').map(function(i, v) {
                return this.value;
            }).get();

            budgetSources.forEach(element => {
                if (data.length == count) {
                    $(".select2-selection__rendered").css("display", 'none');
                    $("#budget_souce_id").removeAttr("selected");
                    data.splice(0, data.length)
                }
                if (data.includes(element.id)) {
                    html += '<option value="' + element.id + '" >' + element.name + '</option>';
                } else {
                    if (data.length == 0) {
                        html += '<option value="' + element.id + '" >' + element.name + '</option>';
                    } else {
                        if (data.includes(element.id)) {
                            html += '<option value="' + element.id + '" >' + element.name + '</option>';
                        } else {
                            if (temp.includes(JSON.stringify(element.id))) {
                                html += '<option value="' + element.id + '"selected disabled>' + element.name +
                                    '</option>';
                            } else {
                                html += '<option value="' + element.id + '">' + element.name + '</option>';
                            }
                        }
                    }
                }
            });
            $("#tr_" + budget_source_id).remove();
            $("#budget_source_id").html(html);
            console.log(html);
        }

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
