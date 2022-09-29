@section('title', 'कार्यदेश नं छान्नुहोस्')
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
                        <h3 class="card-title">{{ __('पत्र') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('program.letter', $reg_no) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                    <div class="col-12 mt-2">
                        <p class="mb-0 p-2 text-center bg-primary">{{ $plan->name }}</p>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <form action="{{ route($route) }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $plan->id }}" name="program_id">
                        <input type="hidden" value="{{ $route }}" name="route">
                        <div class="col-12">
                            <div class="form-group d-flex">
                                <label for="period"
                                    style="width: 220px;
                                display: flex;
                                justify-content: center;
                                align-items: center;">कार्यदेश
                                    छान्नुहोस्:</label>
                                <select style="min-width:400px;" name="work_order_id" id="period" class="form-control"
                                    required>
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    @foreach ($plan->workOrder as $workOrder)
                                        <option value="{{ $workOrder->id }}">
                                            {{ Nepali($workOrder->work_order_no) ." (" . $workOrder->name .")"}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary"
                                    style="min-width: 110px; margin-left:10px;">खोज्नुहोस <i
                                        class="fa-solid fa-magnifying-glass px-1"></i></button>
                            </div>
                        </div>

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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
@endsection
