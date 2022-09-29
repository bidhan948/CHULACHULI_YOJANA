@section('title', 'कार्यक्रम संचालन प्रक्रिया')
@section('operate_program', 'active')
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
                        <h3 class="card-title">{{ __('कार्यक्रम संचालन प्रक्रिया') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('plan-operate.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-1 bg-primary text-center p-2">
                            {{ __('कार्यक्रम दर्ता नं : ' . Nepali($regNo)) }}
                        </p>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('कार्यक्रम खोज्नुहोस') }} </h3>
                            </div>
                            <form method="POST" action="{{route('work_order.create')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="work_order_id">{{ __('कार्यदेश नं :') }}</label>
                                        <select name="work_order_id" id="work_order_id" class="form-control">
                                            <option value="">{{ __('--खोज्नुहोस--') }}</option>
                                            @foreach ($program->workOrder as $workOrder)
                                                <option value="{{ $workOrder->id }}">
                                                    {{ Nepali($workOrder->work_order_no) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <table id="table1" width="100%" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('कार्यदेश संचालन गर्ने') }}</th>
                                            <th id="name"></th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary my-2" id="button">खोज्नुहोस <i
                                            class="fa-solid fa-magnifying-glass px-1"></i></button>
                                </div>
                            </form>
                        </div>
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
            $("#table1").css("display", 'none');
            $("#button").attr("disabled", 'true');
            $("#work_order_id").on("change", function() {
                var work_order_id = $("#work_order_id").val();
                if (work_order_id == '') {
                    $("#table1").css("display", 'none');
                    $("#button").attr("disabled", 'true');
                    alert('कार्यादेश नं अनिवार्य छ');
                } else {
                    axios.get("{{ route('api.getWorkOrderById') }}", {
                        params: {
                            work_order_id: work_order_id
                        }
                    }).then(function(response) {
                        $("#table1").css("display", '');
                        $("#button").removeAttr("disabled");
                        $("#name").html(response.data.name);
                    }).catch(function(error) {
                        alert("Something went wrong");
                        console.log(error);
                    });
                }
            });
        })
    </script>
@endsection
