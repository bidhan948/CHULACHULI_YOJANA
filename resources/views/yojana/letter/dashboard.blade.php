@section('title', 'पत्र')
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
                        <h3 class="card-title">{{ __('पत्र') }}</h3>
                  
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('plan-operate.index') }}" class="btn btn-sm btn-primary"><i
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
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('letter.contract', $reg_no) }}">{{ __('संझौताको टिप्पणी') }}</a>
                            </li>
                        </ul>
                    </div>
                    @if (config('TYPE.tole-bikas-samiti') != session('type_id') && config('TYPE.AMANAT_MARFAT') != session('type_id'))
                        <div class="col-3">
                            <ul class="users-list clearfix">
                                <li class="card shadow-lg" style="width:100%;">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                            width="50">
                                    </div>
                                    <a class="users-list-name mt-3 font-weight-bold"
                                        href="{{ route('plan.letter.bank', $reg_no) }}">{{ __('बैंक पत्र') }}</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('plan.workOrdrer.letter', $reg_no) }}">{{ __('कार्यादेश पत्र') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('plan.letter.contractLetter', $reg_no) }}">{{ __('संझौता पत्र') }}</a>
                            </li>
                        </ul>
                    </div>
                    @if(!auth()->user()->ward_no)
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('plan.letter.advance_agreement_dashboard', $reg_no) }}">{{ __('पेश्की संझौताको टिप्पणी / आर्थिक प्रशासन शाखा पत्र') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('plan.letter.mandateAdvanceAgreement', $reg_no) }}">{{ __('पेश्की संझौताको कार्यदेश') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('plan.letter.contractExtensionLetter', $reg_no) }}">{{ __('म्याद थपको टिप्पणी') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('plan.letter.extensionLetter', $reg_no) }}">{{ __('म्याद थपको पत्र') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('plan.letter.runningBillPaymentLetterDashboard', $reg_no) }}">{{ __('मुल्यांकनको आधारमा  भुक्तानीको टिप्पणी / आर्थिक प्रशासन शाखा पत्र') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('plan.letter.paymentLetterDashboard', $reg_no) }}">{{ __('अन्तिम भुक्तानीको टिप्पणी') }}</a>
                            </li>
                        </ul>
                    </div>
                    @else
                    <div class="col-3">
                        <ul class="users-list clearfix">
                            <li class="card shadow-lg" style="width:100%;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('yojana/pen-icon.png') }}" alt="User Image" class="img-fluid"
                                        width="50">
                                </div>
                                <a class="users-list-name mt-3 font-weight-bold"
                                    href="{{ route('plan.letter.recommendation', $reg_no) }}">{{ __('योजनाको सिफारिस') }}</a>
                            </li>
                        </ul>
                    </div>
                    @endif
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
