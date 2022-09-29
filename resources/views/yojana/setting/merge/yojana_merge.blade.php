@section('title', 'योजना मर्ज गर्नुहोस्')
@section('setting_merge', 'active')
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

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">{{ __('योजना मर्ज गर्नुहोस्') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('setting.merge_store') }}" method="post">
                    @csrf
                    <div class="col-12">
                        <div class="form-group mt-2">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('योजनाको किसिम :') }}
                                        <span id="budget_source_id_group"
                                            class="text-danger font-weight-bold px-1">*</span></span>
                                </div>
                                <select id="merge_type" class="form-control">
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    @foreach (config('YOJANA.MERGE_TYPE') as $mergeKey => $mergeType)
                                        <option value="{{ $mergeKey }}">{{ $mergeType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="rowTable">
                        <table id="table" width="100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center font-weight-bold">{{ __('योजनाको दर्ता नं :') }}</td>
                                    <td class="font-weight-bold"><input type="text" name="reg_no[]" id="reg_no_0"
                                            class="form-control form-control-sm number reg_no" oninput="searchYojana(0)">
                                    </td>
                                    <td class="font-weight-bold text-center"><a class="btn btn-sm btn-primary"
                                            onclick="addYojanaTable()"><i class="fa-solid fa-plus"></i></a></td>
                                </tr>
                            </thead>
                            <tbody id="rowBody">
                                <tr>
                                    <td class="text-center">{{ __('योजनाको नाम :') }}</td>
                                    <td id="name_0"></td>
                                    <td id="grant_amount_0">अनुदान रु : </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-sm btn-primary" onclick="submitMergeForm()" id="button"><i
                                class="fa-solid fa-code-merge px-2"></i>{{ __('मर्ज गर्नुहोस्') }}</button>
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
    <script>
        let index = 1;
        let checkArray = [];
        let checkRegNo = [];

        function searchYojana(row) {
            var reg_no = +$("#reg_no_" + row).val();
            var merge_type = +$("#merge_type").val();
            if (reg_no == '') {
                $("#name_" + row).html("");
            } else {
                axios.get("{{ route('api.getPlanName') }}", {
                    params: {
                        reg_no: reg_no,
                        merge_type : merge_type
                    }
                }).then(function(response) {
                    $("#merge_type").attr('disabled',true);
                    if (response.data[0] != undefined) {
                        $("#name_" + row).html(response.data[0].name);
                        $("#grant_amount_" + row).html('अनुदान रु : ' + response.data[0].grant_amount);
                        $("#button").removeAttr('disabled');
                        $('.reg_no').each(function() {
                            if (checkArray.includes(Number($(this).val()))) {
                                $("#button").attr('disabled', true);
                            }
                        });
                    } else {
                        checkArray.push(reg_no);
                        $("#name_" + row).html(
                            "<span class='text-danger'><i class='fa-solid fa-circle-exclamation px-1'></i>निम्न दर्ता नं को योजना भेटिएन</span>"
                            );
                        $("#button").attr('disabled', true);
                    }
                }).catch(function(error) {
                    alert('Some problem occured');
                    console.log(error);
                });
            }
        }

        function addYojanaTable() {
            html = '<table id="table'+index+'" width="100%" class="table table-bordered">'
                    +'<thead>'
                        +'<tr>'
                            +'<td class="text-center font-weight-bold">{{ __("योजनाको दर्ता नं :") }}</td>'
                            +'<td class="font-weight-bold"><input type="text" name="reg_no[]" id="reg_no_'+index+'"'
                                    +'class="form-control form-control-sm number reg_no" oninput="searchYojana('+index+')">'
                            +'</td>'
                            +'<td class="font-weight-bold text-center"><a class="btn btn-sm btn-danger"'
                                    +'onclick="removeTable('+index+')"><i class="fa-solid fa-xmark"></i></a></td>'
                        +'</tr>'
                    +'</thead>'
                    +'<tbody id="rowBody">'
                        +'<tr>'
                            +'<td class="text-center">{{ __("योजनाको नाम :") }}</td>'
                            +'<td id="name_'+index+'"></td>'
                            +'<td id="grant_amount_'+index+'">अनुदान रु :</td>'
                        +'</tr>'
                    +'</tbody>'
                +'</table>';
            $("#rowTable").append(html);
            index++;
        }

        function removeTable(row) {
            $("#table" + row).remove();
        }

        function submitMergeForm() {
            if (confirm('के तपाई निश्चित हुनुहुन्छ ?')) {
                $('.reg_no').each(function() {
                    checkRegNo.push(Number($(this).val()));
                });
                let map = {};
                let result = false;
                for (let i = 0; i < checkRegNo.length; i++) {
                    if (map[checkRegNo[i]]) {
                        result = true;
                        break;
                    }
                    map[checkRegNo[i]] = true;
                }
                if (result) {
                    alert('चयन भएको योजनाको दर्ता नं दोहोरिएको छ');
                    event.preventDefault();
                } else {
                    return true;
                }
            } else {
                event.preventDefault();
            }
        }
    </script>
@endsection
