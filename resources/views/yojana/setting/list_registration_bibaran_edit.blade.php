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
                        <h3 class="card-title">{{ __('सुची दर्ताको विवरण सच्याउनुहोस') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <button class="float-right btn btn-primary btn-sm">
                            <a href="{{ route('setting.list_registration_bibaran_show') }}"
                                class="btn btn-sm btn-primary"><i class="fa-solid fa-backward px-1"></i>
                                {{ __('पछी जानुहोस्') }}</a>
                        </button>
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
            <form action="{{ route('setting.list_registration_update', $list_registration_attribute) }}" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @csrf
                            @method('PUT')
                            <input id="form_id" value="{{ $list_registration_attribute->list_registration_id }}" name="list_registration_id"
                                type="hidden">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ">{{ __('संचालन गर्ने :') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                    </div>
                                    <select id="list_registration" class="form-control form-control-sm" disabled>
                                        <option value="">{{ $list_registration_attribute->listRegistration->name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form" id="form">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-sm btn-primary" type="submit"
                            onclick="confirm('के तपाई निश्चित हुनुहुन्छ ?')"
                            id="button">{{ __('सेभ गर्नुहोस्') }}</button>
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
        let i = +{{ $list_registration_attribute->listRegistrationAttributeDetails->count() + 1 }};
        let list_registration = {{ $list_registration_attribute->list_registration_id }}
        let list_registration_attribute = {{ $list_registration_attribute->id }}
        $(function() {
            axios.get("{{ route('api.getRawSuchiDartaField') }}", {
                    params: {
                        list_registration_id: list_registration,
                        list_registration_attribute: list_registration_attribute
                    }
                }).then(function(response) {
                    $("#form").html(response.data);
                })
                .catch(function(error) {
                    alert("Something went wrong");
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
