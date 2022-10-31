@section('title', $plan->name)
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
                        <h3 class="card-title">{{ config('TYPE.' . session('type_id')) . __(' विवरण ') }}</h3>
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
                        <p class="mb-0 bg-primary text-center p-2">{{ __('योजना दर्ता नं : ') }} {{ Nepali($regNo) }}
                        </p>
                        {{-- yojana bibaran accordion --}}
                        <div class="accordion" id="yojana">
                            <div class="card">
                                <div class="card-header bg-primary mt-2 p-0" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-center text-white" type="button"
                                            data-toggle="collapse" data-target="#yojana_bibaran" aria-expanded="true"
                                            aria-controls="yojana_bibaran">
                                            {{ __('योजनाको बिबरण') }}
                                        </button>
                                    </h2>
                                </div>

                                <div id="yojana_bibaran" class="collapse " aria-labelledby="headingOne"
                                    data-parent="#yojana">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row mx-2">
                                                <div class="col-4">
                                                    <span>{{ __('दर्ता नं :') }}</span> <span
                                                        class="font-weight-bold">{{ Nepali($plan->reg_no) }}</span> <br>
                                                    <span class="py-2">{{ __('योजनाको नाम :') }}</span> <span
                                                        class="font-weight-bold py-2">{{ $plan->name }}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>{{ __('योजनाको क्षेत्रको नाम :') }}</span> <span
                                                        class="font-weight-bold">{{ getSettingValueById($plan->topic_id)->name }}</span>
                                                    <br>
                                                    <span>{{ __('योजनाको उपक्षेत्रको नाम :') }}</span> <span
                                                        class="font-weight-bold">{{ getSettingValueById($plan->topic_area_type_id)->name }}</span>
                                                    <br>
                                                </div>
                                                <div class="col-4">
                                                    <span>{{ __('योजनाको विनियोजन किसिम  :') }}</span> <span
                                                        class="font-weight-bold">{{ getSettingValueById($plan->type_of_allocation_id)->name }}</span>
                                                    <br>
                                                    <span>{{ __('योजना सचालन हुने स्थान :') }}</span> <span
                                                        class="font-weight-bold">{{ config('constant.SITE_NAME') }}</span>
                                                    <br>
                                                    <span>{{ __('अनुदान रकम :') }}</span> <span
                                                        class="font-weight-bold"><span
                                                            class="px-1">रु</span>{{ NepaliAmount($plan->grant_amount) }}</span>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end of yojana bibaran accordion --}}

                        {{-- yojana kul lagat --}}
                        <div class="accordion" id="kul_lagat" style="margin-top:-10px;">
                            <div class="card">
                                <div class="card-header bg-primary p-0" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-center text-white" type="button"
                                            data-toggle="collapse" data-target="#kul_lagat_bibaran" aria-expanded="true"
                                            aria-controls="kul_lagat_bibaran">
                                            {{ __('योजनाको कुल लागत अनुमान') }}
                                        </button>
                                    </h2>
                                </div>

                                <div id="kul_lagat_bibaran" class="collapse " aria-labelledby="headingOne"
                                    data-parent="#kul_lagat">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row mx-2">
                                                <div class="col-4">
                                                    <span>{{ __('नगरपालिकाबाट अनुदान : ') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->napa_amount) }}</span> <br>
                                                    <span>{{ __('अन्य निकायबाट प्राप्त अनुदान : ') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->other_office_con) }}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>{{ __('उपभोक्ताबाट नगद साझेदारी :') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->customer_agreement) }}</span>
                                                    <br>
                                                    <span>{{ __('अन्य साझेदारी : ') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->other_office_agreement) }}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>{{ __('उपभोक्ताबाट जनश्रमदान :') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->consumer_budget) }}</span>
                                                    <br>
                                                    <span>{{ __('कुल लागत अनुमान जम्मा : ') }}</span> <span
                                                        class="font-weight-bold"><span class="px-1"> रु
                                                        </span>{{ NepaliAmount($kul_lagat->total_investment) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end of yojana kul lagat --}}

                        {{-- yojana type --}}
                        @if (config('TYPE.AMANAT_MARFAT') != session('type_id'))
                            
                        <div class="accordion" id="tole_bikas_samiti" style="margin-top:-10px;">
                            <div class="card">
                                <div class="card-header bg-primary p-0" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-center text-white" type="button"
                                            data-toggle="collapse" data-target="#tole_bikas_samiti_bibaran"
                                            aria-expanded="true" aria-controls="tole_bikas_samiti_bibaran">
                                            {{ config('TYPE.' . session('type_id')) . 'को विवरण' }}
                                        </button>
                                    </h2>
                                </div>
                                <div id="tole_bikas_samiti_bibaran" class="collapse " aria-labelledby="headingOne"
                                data-parent="#tole_bikas_samiti">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row mx-2">
                                            <div class="col-6">
                                                <span>{{ config('TYPE.' . session('type_id')) . 'को नाम :' }}</span>
                                                <span class="font-weight-bold"><span
                                                        class="px-1">{{ $type->name }}</span></span> <br>
                                            </div>
                                            <div class="col-6">
                                                <span>{{ 'योजनाको संचालन गर्ने ' . config('TYPE.' . session('type_id')) . 'को ठेगाना:' }}</span>
                                                <span class="font-weight-bold"><span
                                                        class="px-1">{{ config('constant.SITE_NAME') . '-' . Nepali($type->ward_no) }}</span></span> <br>
                                            </div>
                                            <div class="col-12">
                                                <table class="table table-bordered mt-3">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-center">{{ __('सि.नं.') }}</td>
                                                            <td class="text-center">{{ __('पद') }}</td>
                                                            <td class="text-center">{{ __('नाम/ थर') }}</td>
                                                            <td class="text-center">{{ __('वडा नं') }}</td>
                                                            <td class="text-center">{{ __('लिङ्ग') }}</td>
                                                            <td class="text-center">{{ __('नागरिकता नं') }}</td>
                                                            <td class="text-center">{{ __('जारी जिल्ला') }}</td>
                                                            <td class="text-center">{{ __('मोबाइल नं') }}</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($type->$relationName as $key => $relation)
                                                            <tr>
                                                                <td class="text-center">{{ Nepali($key + 1) }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ getSettingValueById( session('type_id') == 1 ? $relation->position : $relation->post_id)->name }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $relation->name }}</td>
                                                                <td class="text-center">
                                                                    {{ Nepali($relation->ward_no) }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ returnGender($relation->gender) }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ Nepali($relation->cit_no) }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $relation->issue_district }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ Nepali($relation->contact_no) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        {{-- end of yojana type --}}
                        @endif

                        <form method="POST" action="{{ route('plan.anugaman_update',$anugaman_plan->anugaman_samiti_id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('अनुगमन समिति छान्नुहोस्') }}
                                                    <span id="tole_bikas_group"
                                                        class="text-danger font-weight-bold px-1">*</span></span>
                                            </div>
                                            <select name="anugaman_samiti_id"
                                                class="form-control form-control-sm @error('anugaman_samiti_id') is-invalid @enderror"
                                                id="anugaman_samiti_id">
                                                <option value="">{{ __('--छान्नुहोस्--') }}
                                                </option>
                                                @foreach ($anugaman_samitis as $key => $anugaman_samiti)
                                                    <option value="{{ $anugaman_samiti->id }}" {{$anugaman_plan->anugaman_samiti_id == $anugaman_samiti->id ? 'selected': ''}}>
                                                        {{ $anugaman_samiti->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 anugaman_name">
                                    <div class="form-group mt-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ __('अनुगमन समितिको नाम') }}
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" name="name" value="{{$anugaman_plan->anugamanSamiti->is_useable ? '' : $anugaman_plan->anugamanSamiti->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <table id="table1" width="100%" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{ __('पद') }}</th>
                                                <th class="text-center">{{ __('नाम/थर') }}</th>
                                                <th class="text-center">{{ __('वडा नं') }}</th>
                                                <th class="text-center">{{ __('लिङ्ग ') }}</th>
                                                <th class="text-center">{{ __('मोबाइल नं ') }}</th>
                                                <th class="text-center"><span class="btn btn-sm btn-primary anugaman_name"
                                                        id="addMore"><i class="fa-solid fa-plus"></i></span></th>
                                            </tr>
                                        </thead>
                                        <tbody id="row">
                                            @foreach ($anugaman_plan->anugamanSamiti->anugamanSamitiDetails as $key => $anugamanSamitiDetail)
                                                <tr class="{{$anugamanSamitiDetail->anugamanSamiti->is_useable ? 'dummy' : ''}}">
                                                    <td class="text-center">
                                                        @if (!$anugaman_plan->anugamanSamiti->is_useable)
                                                            <select name="post_id[]" class="form-control form-control-sm" required>
                                                                @foreach ($posts->settingValues as $post_key => $post)
                                                                    <option value="{{$post->id}}" {{$anugamanSamitiDetail->post_id == $post->id ? 'selected' : ''}} >{{$post->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <input type="text" class="form-control form-control-sm"  value="{{getSettingValueById($anugamanSamitiDetail->post_id)->name}}" {{!$anugaman_plan->anugamanSamiti->is_useable ? '' : 'disabled'}}>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"  name="samiti_name[]" value="{{$anugamanSamitiDetail->name}}" {{!$anugaman_plan->anugamanSamiti->is_useable ? '' : 'disabled'}}>
                                                    </td>
                                                    <td class="text-center">
                                                        @if (!$anugaman_plan->anugamanSamiti->is_useable)
                                                            <select name="ward_no[]" class="form-control form-control-sm" required>
                                                               @for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++)
                                                                   <option value="{{$i}}"{{$i == $anugamanSamitiDetail->ward_no ? 'selected' : ''}}>{{Nepali($i ? 'वडा नं '. $i :config('constant.SITE_TYPE'))}}</option>
                                                               @endfor
                                                            </select>
                                                        @else
                                                            <input type="text" class="form-control form-control-sm"  value="{{Nepali($anugamanSamitiDetail->ward_no)}}" {{!$anugaman_plan->anugamanSamiti->is_useable ? '' : 'disabled'}}>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if (!$anugaman_plan->anugamanSamiti->is_useable)
                                                            <select name="gender[]" class="form-control form-control-sm" required>
                                                                @foreach (config('constant.GENDER') as $gender_key => $gender)
                                                                    <option value="{{$gender_key}}" {{$anugamanSamitiDetail->gender == $gender_key ? 'selected' : ''}}>{{$gender}}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <input type="text" class="form-control form-control-sm"  value="{{returnGender($anugamanSamitiDetail->gender)}}" disabled>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                            <input type="text" name="mobile_no[]" class="form-control form-control-sm"  value="{{$anugamanSamitiDetail->mobile_no}}" {{!$anugaman_plan->anugamanSamiti->is_useable ? '' : 'disabled'}}>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?');">{{ __('सेभ गर्नुहोस्') }}</button>
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
        $(function() {
            let check = +{{$anugamanSamitiDetail->anugamanSamiti->is_useable}};
            let i = 1;
            let ward_no = '';
            if (check) {
                var elem = document.querySelector('.anugaman_name');
                elem.style.display = 'none';
            }
            $("#anugaman_samiti_id").on("change", function() {
                anugaman_samiti_id = $("#anugaman_samiti_id").val();
                if (anugaman_samiti_id == '') {
                    $('.anugaman_name').css("display", "");
                    $(".dummy").remove();
                    if (!check) {
                        html = '@foreach ($anugaman_plan->anugamanSamiti->anugamanSamitiDetails as $key => $anugamanSamitiDetail)'
                                    +'<tr>'
                                        +'<td class="text-center">'
                                            +'<input type="text" class="form-control form-control-sm"  value="{{getSettingValueById($anugamanSamitiDetail->post_id)->name}}" disabled>'
                                        +'</td>'
                                        +'<td class="text-center">'
                                            +'<input type="text" class="form-control form-control-sm"  value="{{$anugamanSamitiDetail->name}}" disabled>'
                                        +'</td>'
                                        +'<td class="text-center">'
                                            +'<input type="text" class="form-control form-control-sm"  value="{{Nepali($anugamanSamitiDetail->ward_no)}}" disabled>'
                                        +'</td>'
                                        +'<td class="text-center">'
                                            +'<input type="text" class="form-control form-control-sm"  value="{{returnGender($anugamanSamitiDetail->gender)}}" disabled>'
                                        +'</td>'
                                        +'<td class="text-center">'
                                            +'<input type="text" class="form-control form-control-sm"  value="{{Nepali($anugamanSamitiDetail->mobile_no)}}" disabled>'
                                        +'</td>'
                                    +'</tr>'
                                +'@endforeach';
                        $("#row").append(html);  
                    }
                } else {
                    $('.anugaman_name').css("display", "none");
                    axios.get("{{ route('api.getAnugmanSamitiById') }}", {
                            params: {
                                anugaman_samiti_id: anugaman_samiti_id,
                            }
                        }).then(function(response) {
                            console.log(response.data);
                            $(".dummy").remove();
                            $("#row").html(response.data);
                        })
                        .catch(function(error) {
                            alert("Something went wrong");
                        });
                }
            });
            $("#addMore").on("click", function() {
                    html = '<tr id="remove_row_'+i+'">'
                            +'<td class="text-center">'
                                +'<select name="post_id[]" class="form-control form-control-sm" required>'
                                    +'<option value="">{{ __("--छान्नुहोस्--") }}</option>'
                                    +'@foreach ($posts->settingValues as $post)'
                                        +'<option value="{{ $post->id }}">{{ $post->name }}</option>'
                                    +'@endforeach'
                                +'</select>'
                            +'</td>'
                            +'<td class="text-center">'
                                +'<input type="text" class="form-control form-control-sm" name="samiti_name[]">'
                            +'</td>'
                            +'<td class="text-center">'
                                +'<select name="ward_no[]" class="form-control form-control-sm">'
                                    +'<option value="">{{__("--छान्नुहोस्--")}}</option>'
                                    +'@for ($i = 1; $i<20; $i++)'
                                        +'<option value="{{$i}}">{{Nepali($i)}}</option>'
                                    +'@endfor'
                                +'</select>'
                            +'</td>'
                            +'<td class="text-center">'
                                +'<select class="form-control form-control-sm" name="gender[]">'
                                    +'<option>{{__("--छान्नुहोस्--")}}</option>'
                                    +'@foreach (config("constant.GENDER") as $key => $gender)'
                                        +'<option value="{{$key}}">{{$gender}}</option>'
                                    +'@endforeach'
                                +'</select>'
                            +'</td>'
                            +'<td class="text-center">'
                                +'<input type="text" class="form-control form-control-sm" name="mobile_no[]">'
                            +'</td>'
                            +'<td class="text-center">'
                                +'<span class="btn btn-danger btn-sm" onclick="removeRow('+i+')"><i class="fa-solid fa-xmark"></i></span>'
                            +'</td>'
                        +'</tr>';
                $("#row").append(html);
                i++
            });
        });

        function removeRow(params) {
            $("#remove_row_" + params).remove();
        }
    </script>
@endsection
