@section('title', 'नयाँ टोल विकास समिति')
@section('tole_bikas_samiti', 'active')
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
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">{{ __('नयाँ टोल विकास समितिको विवरण भर्नुहोस्') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{route('samiti-gathan.index')}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-backward px-1"></i>{{__('पछी जानुहोस्')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <p class="text-danger text-center mb-0 mt-3">कृपया  * चिन्न भएको ठाउँ खाली नछोड्नु होला |</p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ route('tole-bikas-samiti.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mt-2">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ">{{ __('टोल बिकास समितिको नाम:') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                    </div>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" id="name" required>
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                            {{ __('टोल बिकास समितिको नाम अनिवार्य छ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ">{{ __('वडा नं ') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                    </div>
                                    <select name="ward_no" id="ward_no"
                                        class="form-control form-control-sm @error('ward_no') is-invalid @enderror"
                                        required>
                                        <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                        @for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++)
                                            @if (!$i)
                                                <option value="{{ $i }}">{{ 'गाउँपालिका' }}
                                                </option>
                                            @else
                                                <option value="{{ $i }}">{{ Nepali($i) }}
                                                </option>
                                            @endif
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
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ">{{ __('मिति') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                    </div>
                                    <input type="text"
                                        class="form-control form-control-sm @error('date_nep') is-invalid @enderror"
                                        name="date_nep" id="date_nep" required>
                                    @error('date_nep')
                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                            {{ __('मिति अनिवार्य छ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ">{{ __('म्याद सकिने मिति') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                    </div>
                                    <input type="text"
                                        class="form-control form-control-sm @error('exp_date_nep') is-invalid @enderror"
                                        name="exp_date_nep" id="exp_date_nep" required>
                                    @error('exp_date_nep')
                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                            {{ __('म्याद सकिने मिति अनिवार्य छ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ">{{ __('साबिक गा.बि.स') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                    </div>
                                    <input type="text"
                                        class="form-control form-control-sm @error('former_address') is-invalid @enderror"
                                        name="former_address" id="former_address" required>
                                    @error('former_address')
                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                            {{ __('साबिक गा.बि.स अनिवार्य छ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ">{{ __('साबिक वडा नं ') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                    </div>
                                    <select name="former_ward_no" id="former_ward_no"
                                        class="form-control form-control-sm @error('former_ward_no') is-invalid @enderror"
                                        required>
                                        <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                        @for ($i = 1; $i < 20; $i++)
                                            <option value="{{ $i }}"
                                                {{ $i == old('former_ward_no') ? 'selected' : '' }}>{{ Nepali($i) }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('former_ward_no')
                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                            {{ __('वडा नं अनिवार्य छ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <table id="table1" width="100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('पद') }}</th>
                                        <th class="text-center">{{ __('नाम / थर') }}</th>
                                        <th class="text-center">{{ __('वडा नं') }}</th>
                                        <th class="text-center">{{ __('लिङ्ग') }}</th>
                                        <th class="text-center">{{ __('नागरिकता नं') }}</th>
                                        <th class="text-center">{{ __('जारी जिल्ला') }}</th>
                                        <th class="text-center">{{ __('मोबाइल नं') }}</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="tole_bikas_samiti_detail">
                                    <tr>
                                        <td class="text-center">
                                            <select name="position[]" id="position_0" class="form-control form-control-sm position" required>
                                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                @foreach ($posts->settingValues as $post)
                                                    <option value="{{ $post->id }}">{{ $post->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <input type="text" name="detail_name[]" class="form-control form-control-sm"
                                                required>
                                        </td>
                                        <td class="text-center">
                                            <select name="detail_ward_no[]" class="form-control form-control-sm" required>
                                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                @for ($i = 1; $i < 20; $i++)
                                                    <option value="{{ $i }}">{{ Nepali($i) }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <select name="gender[]" class="form-control form-control-sm" required>
                                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                @foreach (config('constant.GENDER') as $key => $gender)
                                                    <option value="{{ $key }}">{{ $gender }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <input type="text" name="cit_no[]" class="form-control form-control-sm"
                                                required>
                                        </td>
                                        <td class="text-center">
                                            <input type="text" name="issue_district[]" class="form-control form-control-sm"
                                                required>
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="contact_no[]" class="form-control form-control-sm"
                                                required>
                                        </td>
                                        <td class="text-center">
                                            <a id="addToleBikasSamitiDetail" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-sm" onclick="confirm('के तपाई निश्चित हुनुहुन्छ ?')">{{__('सेभ गर्नुहोस्')}}</button>
                            </div>
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
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>
    <script>
        window.onload = function() {
            var mainInput = document.getElementById("date_nep");
            var mainInput1 = document.getElementById("exp_date_nep");
            mainInput.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100
            });
            mainInput1.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100
            });
        }
        let i = 1;
        let posts = [];
        $("#addToleBikasSamitiDetail").on("click",function(){
            html = '<tr id="re_'+i+'">'
                    +'<td class="text-center">'
                        +'<select name="position[]" class="form-control form-control-sm position"  id="position_'+i+'" required>'
                            +'<option value="">{{ __("--छान्नुहोस्--") }}</option>'
                            +'@foreach ($posts->settingValues as $gender)'
                               + '<option value="{{ $gender->id }}">{{ $gender->name }}</option>'
                            +'@endforeach'
                        +'</select>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<input type="text" name="detail_name[]" class="form-control form-control-sm"required>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<select name="detail_ward_no[]" class="form-control form-control-sm" required>'
                            +'<option value="">{{ __("--छान्नुहोस्--") }}</option>'
                            +'@for ($i = 1; $i < 20; $i++)'
                                +'<option value="{{ $i }}">{{ Nepali($i) }}</option>'
                            +'@endfor'
                        +'</select>'
                   +'</td>'
                    +'<td class="text-center">'
                        +'<select name="gender[]" class="form-control form-control-sm" required>'
                            +'<option value="">{{ __("--छान्नुहोस्--") }}</option>'
                           +'@foreach (config("constant.GENDER") as $key => $gender)'
                                +'<option value="{{ $key }}">{{ $gender }}</option>'
                            +'@endforeach'
                        +'</select>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<input type="text" name="cit_no[]" class="form-control form-control-sm"'
                            +'required>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<input type="text" name="issue_district[]" class="form-control form-control-sm"  required>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<input type="number" name="contact_no[]" class="form-control form-control-sm"required>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<a onclick="removeToleBikasSamitiDetail('+i+')" class="btn btn-danger btn-sm"><i class="fa-solid fa-times"></i></a>'
                    +'</td>'
                +'</tr>';
            
            $("#tole_bikas_samiti_detail").append(html);
            i++;
        });
        
        function removeToleBikasSamitiDetail(params) {
            $("#re_"+params).remove();
        }
    </script>
@endsection
