@section('title', 'नयाँ अनुगमन समिति')
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
                        <h3 class="card-title">{{ __('नयाँ अनुगमन समितिको विवरण भर्नुहोस्') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('samiti-gathan.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <p class="text-danger text-center mb-0 mt-3">कृपया * चिन्न भएको ठाउँ खाली नछोड्नु होला |</p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ route('anugaman-samiti.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mt-2">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ">{{ __('अनुगमन समिति :') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                    </div>
                                    <select name="anugaman_samiti_type_id" id="anugaman_samiti_type_id"
                                        class="form-control @error('anugaman_samiti_type_id') is-invalid @enderror">
                                        <option value="">{{ __('---छान्नुहोस्---') }}</option>
                                        <option value="0">{{ __('वडा स्तरीय') }}</option>
                                        <option value="1">{{ __('गाउँपालिका स्तरीय') }}</option>
                                    </select>

                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                            {{ __('अनुगमन समिति अनिवार्य छ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6 anugaman">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ">{{ __('अनुगमन समितिको नाम :') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                    </div>
                                    <input type="text" id="name"
                                        class="form-control form-control-sm @error('name') is-invalid @enderror"
                                        name="name">
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                            {{ __('अनुगमन समितिको नाम अनिवार्य छ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6 anugaman">
                            <div class="form-group mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ">{{ __('वडा नं :') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span></span>
                                    </div>
                                    <select name="ward_no" id="ward_no"
                                        class="form-control @error('ward_no') is-invalid @enderror">
                                        <option value="">{{ __('---छान्नुहोस्---') }}</option>
                                        @for ($i = 1; $i < 20; $i++)
                                            <option value="{{ $i }}">{{ Nepali($i) }}</option>
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

                        <div class="col-12 mt-4">
                            <table id="table1" width="100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('पद') }}</th>
                                        <th class="text-center">{{ __('नाम / थर') }}</th>
                                        <th class="text-center">{{ __('वडा नं') }}</th>
                                        <th class="text-center">{{ __('लिङ्ग') }}</th>
                                        <th class="text-center">{{ __('मोबाइल नं') }}</th>
                                        <th class="text-center"><span class="btn btn-sm btn-primary" id="addMore"><i class="fa-solid fa-plus"></i></span></th>
                                    </tr>
                                </thead>
                                <tbody id="anugaman_samiti_detail">
                                </tbody>
                            </table>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-sm"
                                    onclick="confirm('के तपाई निश्चित हुनुहुन्छ ?')">{{ __('सेभ गर्नुहोस्') }}</button>
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
        $(function() {
            let i = 1;
            $("#table1").css("display", "none");
            $(".anugaman").css("display", "none");

            $("#anugaman_samiti_type_id").on("change", function() {
                anugaman_samiti_type_id = $("#anugaman_samiti_type_id").val();
                ward_no = $("#ward_no").val();
                if (anugaman_samiti_type_id == '') {
                    alert('अनुगमन समिति छान्नुहोस् ');
                    $("#table1").css("display", "none");
                } else {
                    $(".anugaman").css("display", "");
                    $("#table1").css("display", "");
                    if (anugaman_samiti_type_id == 1) {
                        $("#name").val('गा.प अनुगमन समिति');
                        $("#name").prop('readonly', 'true');
                        $("#ward_no").prop('disabled', 'true');
                        $("#ward_no").val('');
                    } else {
                        $("#name").val(ward_no + ' वडा स्तरीय अनुगमन समिति');
                        $("#name").prop('readonly', 'true');
                        $("#ward_no").removeAttr('disabled');
                    }

                    getAnugamanSamiti(anugaman_samiti_type_id, ward_no);
                }
            });

            $("#ward_no").on("change", function() {
                ward_no = $("#ward_no").val();
                anugaman_samiti_type_id = $("#anugaman_samiti_type_id").val();
                if (ward_no == '') {
                    alert('वडा नं छान्नुहोस्');
                    $("#table1").css("display", "none");
                    $("#name").val(ward_no + ' वडा स्तरीय अनुगमन समिति');
                } else {
                    $("#table1").css("display", "");
                    $("#name").val(ward_no + ' वडा स्तरीय अनुगमन समिति');
                    $('.ward_no').val(ward_no);
                    getAnugamanSamiti(anugaman_samiti_type_id, ward_no);
                }
            })

            $("#addMore").on("click",function(){
                html = '';
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
                            +'<input type="text" class="form-control form-control-sm ward_no" value="'+$("#ward_no").val()+'" disabled>'
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
                    $("#anugaman_samiti_detail").append(html);
                i++; 
            });
        });

        function getAnugamanSamiti(anugaman_samiti_type_id, ward_no) {
            axios.get("{{ route('api.getAnugmanSamiti') }}", {
                    params: {
                        anugaman_samiti_type_id: anugaman_samiti_type_id,
                        ward_no: ward_no
                    }
                }).then(function(response) {
                    console.log(response.data);
                    $(".dummy").remove();
                    $("#anugaman_samiti_detail").append(response.data);
                })
                .catch(function(error) {
                    alert("Something went wrong");
                });
        }

        function removeRow(params) {
            $("#remove_row_"+params).remove();
        }
    </script>
@endsection
