@section('title', $plan->name . ' पेश्की भुक्तानी')
@section('operate_plan', 'active')
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
                        <h3 class="card-title">{{ __('योजना संचालनमा पेश्की दिनु पर्ने अत्याबश्यक भएमा') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('plan_bhuktani.dashboard', $reg_no) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-0 bg-primary text-center">{{ __('योजना दर्ता नं : ') }} {{ Nepali($reg_no) }}</p>
                        <form method="POST" action="{{ $advance == null ? route('plan.peski_bhuktani_store') : route('plan.peski_bhuktani_update',$advance) }}">
                            @csrf
                            @if ($advance != null)
                                @method('PUT')                                
                            @endif
                            <div class="row">
                                <input type="hidden" name="plan_id" value="{{ $reg_no }}">
                                <div class="col-6 mt-2">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('पेश्की रकम:') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control amount @error('peski_amount') is-invalid @enderror"
                                                name="peski_amount" id="peski_amount" value="{{ $advance == null ? old('peski_amount') : $advance->peski_amount  }}"
                                                required>
                                            @error('peski_amount')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('पेश्की रकम अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('पेश्की दिएको मिति :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control nepali-date @error('peski_given_date_nep') is-invalid @enderror"
                                                name="peski_given_date_nep" id="peski_given_date" value="{{ $advance == null ? old('peski_given_date_nep') : $advance->peski_given_date_nep  }}" required>
                                            @error('peski_given_date_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('पेश्की दिएको मिति अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text ">{{ __('पेश्की फर्छ्यौट गर्नु पर्ने मिति :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <input type="text"
                                                class="form-control nepali-date @error('advance_paid_date_nep') is-invalid @enderror"
                                                name="advance_paid_date_nep" value="{{ $advance == null ? old('advance_paid_date_nep') : $advance->advance_paid_date_nep  }}" required>
                                            @error('advance_paid_date_nep')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('पेश्की फर्छ्यौट गर्नु पर्ने मिति अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @if (config('TYPE.AMANAT_MARFAT') == session('type_id'))
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('वुवा नाम :') }}</span>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('father_name') is-invalid @enderror"
                                                    name="father_name" value="{{  $advance == null ? old('father_name') : $advance->father_name }}">
                                                @error('father_name')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('वुवा नाम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('बाजेको नाम :') }}</span>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('g_father_name') is-invalid @enderror"
                                                    name="g_father_name" value="{{ $advance == null ? old('g_father_name') : $advance->g_father_name  }}">
                                                @error('g_father_name')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('बाजेको नाम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text ">{{ __('पेश्की दिनु पर्ने कारण :') }}
                                                    <span class="text-danger px-1 font-weight-bold">*</span></span>
                                            </div>
                                            <textarea name="remark" class="form-control" required>{{  $advance == null ? old('remark') : $advance->remark  }}</textarea>
                                            @error('remark')
                                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                                    {{ __('पेश्की दिनु पर्ने कारण अनिवार्य छ') }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (!$show_form)
                                <button type="submit" class="btn btn-sm btn-primary"
                                    onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?')">{{ __('सेभ गर्नुहोस्') }}</button>
                            @endif
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
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>
    <script>
        let total_investment = +{{ $contract_kabol == null ?  $plan->kulLagat->total_investment : $contract_kabol->total_amount }};
        window.onload = function() {
            var date_fields = document.getElementsByClassName("nepali-date");
            for (let index = 0; index < date_fields.length; index++) {
                const element = date_fields[index];
                element.nepaliDatePicker({
                    readOnlyInput: true,
                    ndpTriggerButton: false,
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10
                });
            }
        };

        $(function() {
            $("#peski_amount").on('input', function() {
                var peski_amount = +$("#peski_amount").val();
                if (peski_amount > total_investment) {
                    alert('पेश्की रकम लागत अनुमान भन्दा बढी भयो');
                    $("#peski_amount").val(0);
                }
            });
        });
    </script>
@endsection
