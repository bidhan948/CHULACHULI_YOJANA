@section('title', 'योजना / कार्यक्रम सच्याउनुहोस')
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
                <form method="post" action="{{ route('plan.update',$plan) }}">
                    @csrf
                    @method('PUT')
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
                                            <option value="{{ $key }}" {{$plan->type_id == $key ? 'selected' : ''}}>
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
                                    <textarea name="name" class="form-control form-control-sm">{{$plan->name}}</textarea>
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
                                            <option value="{{ $topic->id }}" {{$topic->id == $plan->topic_id ? 'selected' : ''}}>
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
                                            <option value="{{ $expense_type->id }}" {{$expense_type->id == $plan->expense_type_id ? 'selected' : ''}}>
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
                                            <option value="{{ $type_of_allocation->id }}" {{$plan->type_of_allocation_id == $type_of_allocation->id ? 'selected' : ''}}>
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
                                        @for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++)
                                        @if (!$i)
                                            <option value="{{ $i }}" {{in_array($i,$ward_array) ? 'selected' : ''}}>{{ 'गाउँपालिका' }}</option>
                                        @else
                                        <option value="{{ $i }}" {{in_array($i,$ward_array) ? 'selected' : ''}}>वडा नं {{ Nepali($i) }}</option>
                                        @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="table1" width="100%" class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-center">{{ __('बजेट शिर्षक') }}</th>
                                <th class="text-center">{{ __('रकम') }}</th>
                                <th class="text-center">{{ __('बाँकि रकम') }}</th>
                                <th class="text-center"><a class="px-1 btn-sm btn btn-danger" id="addMore"><i class="fa-solid fa-plus"></i></a></th>
                            </tr>
                        </thead>
                        <tbody id="row">
                           {!! $html !!}
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
                                        id="grant_amount" value="{{$plan->grant_amount}}">
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
                                    <textarea name="detail" class="form-control form-control-sm">{{$plan->detail}}</textarea>
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
                                    <input type="text" class="form-control form-control-sm installment amount"
                                        name="first_installment" id="first_installment" value="{{$plan->first_installment}}">
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
                                    <input type="text" class="form-control form-control-sm installment amount"
                                        name="second_installment" id="second_installment" value="{{$plan->second_installment}}">
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
                                        id="third_installment" value="{{$plan->third_installment}}" readonly>
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
        let wada_stariya = "{{config('constant.wada_stariya_id')}}";
        let data = [];
        let type_of_allocation_id = "{{$plan->type_of_allocation_id}}";
        let count = 0;
        let row = +"{{$plan->budgetSourcePlanDetails->count()}}";
        $(function() {
            $('.select2').select2()
            $('.select3').select2();

            axios.get("{{ route('api.getTopicAreaType') }}", {
                params: {
                    setting_id: "{{$plan->topic_id}}"
                }
            }).then(function(response) {
                $("#topic_area_type_id").html(response.data.html);
                $("#topic_area_type_id").val("{{$plan->topic_area_type_id}}");
            })
            .catch(function(error) {
                console.log(error);
                alert("Something went wrong");
            });
            
            if (type_of_allocation_id == wada_stariya) {
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
                                            +'<option value="{{ $i }}" {{$plan->ward_no == $i ? "selected" : ""}}>वडा नं {{ Nepali($i) }}</option>'
                                        +'@endfor'
                                    +'</select>'
                                +'</div>'
                            +'</div>'
                        +'</div>';
                    $("#wada_stariya").html(html);
                    $("#wada_stariya").css("width", "50%");
            }

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

            $("#addMore").on("click",function(){
                row++;
                html = '<tr id="re_'+row+'">'
                        +'<td class="text-center"><select name="budget_source_id" class="form-control form-control-sm budget_source_id" id="budget_source_id_'+row+'" onchange="changeBudgetSource('+row+')" required>'
                        +'<option value="">--छान्नुहोस्--</option>'
                        +'@foreach ($budget_sources as $key => $budget_source) '
                        +'<option value="{{$budget_source->id}}">{{$budget_source->name}}</option>@endforeach</select></td>'
                        +'<td class="text-center"><input type="text" class="form-control form-control-sm rakam" oninput="changeRakam(0,0,'+row+')" id="rakam_'+row+'" name="rakam[]" value="0"></td>'
                        +'<td class="text-center"><input type="text" class="form-control form-control-sm"  id="baki_'+row+'" value="0" readonly></td>'
                        +'<td class="text-center"><a class="btn btn-sm btn-danger" onclick="removeTr('+row+')"><i class="fa-solid fa-xmark"></i></a></td></tr>'

                $("#row").append(html);
            });
        });

        function changeRakam(amount,baki_amount,row) {
            var rakam = +$("#rakam_"+row).val();
            var res_baki = +amount + baki_amount;
            if ((res_baki - rakam) < 0) {
                alert("रकम बढी भयो");
                $("#rakam_"+row).val(amount);
                $("#baki_"+row).val(baki_amount);
            }else{
                $("#baki_"+row).val(res_baki - rakam);
            }
            total = 0
            $('.rakam').each(function() {
                total += Number($(this).val()) || 0;
            });

            $("#grant_amount").val(total);
            $("#third_installment").val(total);

        }

        function changeBudgetSource(row) {
            var budget_source_id = $("#budget_source_id_"+row).val();

            axios.get("{{route('api.getBudgetRowTr')}}",{
                params : {
                    row : row,
                    budget_source_id : budget_source_id
                }
            }).then(function(response){
                $("#re_"+row).html(response.data);
            }).catch(function(error){
                alert("Something went wrong...");
            });
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

        function removeTr(params) {
            $("#re_"+params).remove();
        }
    </script>
@endsection
