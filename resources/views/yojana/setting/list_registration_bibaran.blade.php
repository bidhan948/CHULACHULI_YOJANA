@section('title', 'सुची दर्ता')
@section('setting_list_registration_bibaran', 'active')
@section('child_setting', 'menu-open')
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
@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">{{ __('सुची दर्ताको विवरण थप्नुहोस') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{route('setting.list_registration_bibaran_show')}}" class="btn btn-success btn-sm"><i class="fa-solid fa-eye px-1"></i>{{__('सुची दर्ता हेर्नुहोस्')}}</a>
                    </div>
                    <div class="col-12 text-center">
                        <p class="mb-0 text-danger">कृपया * चिन्न भएको ठाउँ खाली नछोड्नु होला |</p>
                    </div>
                </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- /.card-header -->
            <form action="{{route('setting.list_registration_bibaran_store')}}" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                            @csrf
                            <input id="form_id" value="" type="hidden">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ">{{ __('संचालन गर्ने :') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                    </div>
                                    <select name="list_registration_id" id="list_registration"
                                        class="form-control form-control-sm">
                                        <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                        @foreach ($list_registrations as $list_registration)
                                            <option value="{{ $list_registration->id }}">{{ $list_registration->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('napa_amount')
                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                            {{ __('संचालन गर्ने फिल्ड अनिवार्य छ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                    </div>
                </div>
                <div class="form" id="form">
                </div>
                <div class="col-12">
                    <button class="btn btn-sm btn-primary" type="submit" disabled
                        onclick="confirm('के तपाई निश्चित हुनुहुन्छ ?')" id="button">{{ __('सेभ गर्नुहोस्') }}</button>
                </div>
            </div>
        </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('scripts')
    <script>
        let i = 1;
        $(function() {
            $('#list_registration').on('change', function() {
                var list_registration = $("#list_registration").val();
                if (list_registration == '') {
                    $("#form").html('');
                    $("#button").prop('disabled','true');
                    alert('संचालन गर्ने फिल्ड अनिवार्य छ');
                } else {
                    axios.get("{{ route('api.getRawSuchiDartaField') }}", {
                            params: {
                                list_registration_id: list_registration
                            }
                        }).then(function(response) {
                            $("#form").html(response.data);
                            $("#button").removeAttr("disabled");
                        })
                        .catch(function(error) {
                            alert("Something went wrong");
                        });
                }
            });
        });

        function loadNextForm() {
            html = '<tr id="re_'+i+'">'
                    +'<td class="text-center">'
                        +'<select name="post_id[]" class="form-control form-control-sm position"  id="post_id_'+i+'" required>'
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
                        +'<input type="number" name="detail_contact_no[]" class="form-control form-control-sm"required>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<a onclick="removeMoreDetail('+i+')" class="btn btn-danger btn-sm"><i class="fa-solid fa-times"></i></a>'
                    +'</td>'
                +'</tr>';
            
            $("#row_body").append(html);
            i++;
        }
        function removeMoreDetail(param) {
            $("#re_" + param).remove();
        }
    </script>
@endsection
