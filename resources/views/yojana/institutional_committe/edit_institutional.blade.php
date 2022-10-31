@section('title', config('TYPE.3') . ' विवरण')
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
                        <h3 class="card-title">{{ config('TYPE.3') . __(' विवरण ') }}</h3>
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
                        <p class="mb-0 bg-primary text-center p-2">{{ __('योजना दर्ता नं : ') }} {{ Nepali($regNo) }} ||
                            {{ $plan->name }}
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
                        <form method="POST" action="{{ route('plan_sanstha_samiti.update',$institutional_committee) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text ">{{ __('योजनाको संचालन गर्ने संस्था / समितिको नाम:') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm napa-amount @error('name') is-invalid @enderror"
                                                name="name" value="{{ $institutional_committee->name }}" id="name"
                                                required>
                                            @error('name')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('योजनाको संचालन गर्ने संस्था / समितिको नाम अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                        <p class="mt-2 mb-0 pl-1">
                                            {{ __('योजनाको संचालन गर्ने संस्था / समितिको ठेगाना: ') }}
                                            {{ config('constant.SITE_NAME') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('वडा नं :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <select name="ward_no" id="ward_no"
                                                class="form-control form-control-sm @error('ward_no') is-invalid @enderror">
                                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                @for ($i = 1; $i < 20; $i++)
                                                    <option value="{{ $i }}" {{ $institutional_committee->ward_no == $i ? 'selected' : '' }}>
                                                        {{ Nepali($i) }}</option>
                                                @endfor
                                            </select>
                                            @error('ward_no')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('वडा नं अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <table id="table1" width="100%" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{ __('पद') }}</th>
                                                <th class="text-center">{{ __('नाम/थर') }}</th>
                                                <th class="text-center">{{ __('वडा नं') }}</th>
                                                <th class="text-center">{{ __('लिङ्ग ') }}</th>
                                                <th class="text-center">{{ __('नागरिकता नं ') }}</th>
                                                <th class="text-center">{{ __('जारी जिल्ला ') }}</th>
                                                <th class="text-center">{{ __('मोबाइल नं ') }}</th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="row">
                                            @foreach ($institutional_committee->institutionalCommitteeDetail as $mainKey => $detail)
                                                <tr id="remove_{{$mainKey+1}}">
                                                    <td class="text-center">
                                                        <select name="post_id[]" class="form-control form-control-sm" required>
                                                            <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                            @foreach ($posts->settingValues as $post)
                                                                <option value="{{ $post->id }}" {{$post->id == $detail->post_id ? 'selected' : ''}}>
                                                                    {{ $post->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" name="fullname[]"
                                                            class="form-control form-control-sm" value="{{$detail->name}}" required>
                                                    </td>
                                                    <td class="text-center">
                                                        <select name="ward_no_consumer[]" class="form-control form-control-sm"
                                                            required>
                                                            <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                            @for ($i = 1; $i < 20; $i++)
                                                                <option value="{{ $i }}" {{$detail->ward_no == $i ? 'selected' : ''}}>
                                                                    {{ Nepali($i) }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <select name="consumer_gender[]"
                                                            class="form-control form-control-sm gender" required>
                                                            <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                            @foreach (config('constant.GENDER') as $key => $gender)
                                                                <option value="{{ $key }}" {{$key == $detail->gender ? 'selected' : ''}}>
                                                                    {{ $gender }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" name="cit_no[]"
                                                            class="amount form-control form-control-sm" value="{{$detail->cit_no}}" required>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" name="issue_district[]"
                                                            class="form-control form-control-sm"
                                                            value="{{$detail->issue_district}}" required>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" name="contact_no[]"
                                                            class="amount form-control form-control-sm" value="{{$detail->mobile_no}}" required>
                                                    </td>
                                                    <td class="text-center">
                                                    @if (!$mainKey)
                                                        <span class="btn btn-success" id="addMore"><i
                                                                class="fa-solid fa-plus"></i></span>
                                                    @else
                                                        <span class="btn btn-danger" onclick="removeRow({{$mainKey+1}})"><i class="fa-solid fa-xmark"></i></span>
                                                    @endif
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
            let i = (+{{$institutional_committee->institutionalCommitteeDetail->count()}} + 1);
            $("#addMore").on("click", function() {
                html = '<tr id="remove_'+i+'">'
                        +'<td class="text-center">'
                            +'<select name="post_id[]" class="form-control form-control-sm" required>'
                                +'<option value="">{{ __("--छान्नुहोस्--") }}</option>'
                                +'@foreach ($posts->settingValues as $post)'
                                    +'<option value="{{ $post->id }}">{{ $post->name }}'
                                    +'</option>'
                                +'@endforeach'
                            +'</select>'
                        +'</td>'
                        +'<td class="text-center">'
                            +'<input type="text" name="fullname[]" class="form-control form-control-sm"required>'
                        +'</td>'
                        +'<td class="text-center">'
                            +'<select name="ward_no_consumer[]" class="form-control form-control-sm" required>'
                                +'<option value="">{{ __("--छान्नुहोस्--") }}</option>'
                                +'@for ($i = 1; $i < 20; $i++)'
                                    +'<option value="{{ $i }}">{{ Nepali($i) }}'
                                    +'</option>'
                                +'@endfor'
                            +'</select>'
                        +'</td>'
                        +'<td class="text-center">'
                            +'<select name="consumer_gender[]" class="form-control form-control-sm gender"required>'
                                +'<option value="">{{ __("--छान्नुहोस्--") }}</option>'
                                +'@foreach (config("constant.GENDER") as $key => $gender)'
                                    +'<option value="{{ $key }}">{{ $gender }}'
                                    +'</option>'
                                +'@endforeach'
                            +'</select>'
                        +'</td>'
                        +'<td class="text-center">'
                            +'<input type="text" name="cit_no[]"'
                                +'class="amount form-control form-control-sm" required>'
                        +'</td>'
                        +'<td class="text-center">'
                            +'<input type="text" name="issue_district[]"'
                                +'class="form-control form-control-sm"'
                                +'value="{{ config("constant.SITE_DISTRICT") }}" required>'
                        +'</td>'
                        +'<td class="text-center">'
                            +'<input type="text" name="contact_no[]"'
                                +'class="amount form-control form-control-sm" value="" required>'
                        +'</td>'
                        +'<td class="text-center">'
                            +'<span class="btn btn-danger" onclick="removeRow('+i+')"><i class="fa-solid fa-xmark"></i></span>'
                        +'</td>'
                    +'</tr>';
                $("#row").append(html);
                i++;
            });
        });

        function removeRow(params) {
            console.log(params);
            $("#remove_" + params).remove();
        }
    </script>
@endsection
