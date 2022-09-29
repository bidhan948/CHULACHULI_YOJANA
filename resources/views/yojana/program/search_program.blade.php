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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{__('कार्यक्रम खोज्नुहोस')}} </h3>
                            </div>
                            <form method="POST" action="{{route('progarm-operate.searchSubmit')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">कार्यक्रमको नाम / दर्ता फाराम नं:</label>
                                        <input type="text" class="form-control number" id="exampleInputEmail1"
                                            placeholder="कार्यक्रमको नाम / दर्ता फाराम नं:" name="reg_no" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">खोज्नुहोस <i
                                            class="fa-solid fa-magnifying-glass px-1"></i></button>
                                </div>
                                <div class="card-footer">
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
