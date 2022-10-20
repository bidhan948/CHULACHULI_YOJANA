@section('title', $plan->name . ' अन्तिम भुक्तानी')
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
                        <h3 class="card-title">{{ __('योजनाको अन्तिम भुक्तानी') }}</h3>
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
                        <p class="mb-3 bg-primary text-center">{{ __('योजना दर्ता नं : ') }} {{ Nepali($reg_no) }}</p>
                        @if ($final_payment != null)
                            {{-- antim bhuktani bibaran --}}
                            <div class="accordion" id="final_payment" style="margin-top:-10px;">
                                <div class="card">
                                    <div class="card-header bg-primary p-0" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-center text-white" type="button"
                                                data-toggle="collapse" data-target="#final_payment_bibaran"
                                                aria-expanded="true" aria-controls="final_payment_bibaran">
                                                {{ __('योजनाको अन्तिम भुक्तानीको विवरण') }}
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="final_payment_bibaran" class="collapse " aria-labelledby="headingOne"
                                        data-parent="#final_payment">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row mx-2">
                                                    <table id="table1" width="100%"
                                                        class="table table-bordered shadow-lg">
                                                        <thead class="bg-secondary">
                                                            <tr>
                                                                <td class="text-right" style="width: 50%;">Auto calculate :
                                                                </td>
                                                                <td>{{ $final_payment->is_auto_calculate ? 'YES' : 'NO' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">सार्बजनिक परिक्षण भएको मिति :</td>
                                                                <td>{{ Nepali($final_payment->public_exam_date) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">सार्बजनिक परिक्षण भेलमामा उपस्थित
                                                                    संख्या
                                                                    :</td>
                                                                <td>{{ Nepali($final_payment->public_group_count) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">योजनाको काम सम्पन्न भएको मिति :</td>
                                                                <td>{{ Nepali($final_payment->plan_end_date) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">संस्था समितिको बैठक बसी खर्च स्वीकृत
                                                                    गरेको मिति :</td>
                                                                <td>{{ Nepali($final_payment->type_accept_date) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">अनुगमन समितिको बैठक बसी खर्च स्वीकृत
                                                                    गरेको मिति :</td>
                                                                <td>{{ Nepali($final_payment->anugaman_accept_date) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">योजनाको मुल्यांकन मिति :</td>
                                                                <td>{{ Nepali($final_payment->assessment_date) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">इष्टिमेट भएको रकम :</td>
                                                                <td>{{ 'रु ' . NepaliAmount($contract_kabol->total_amount) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">योजनाको हाल मुल्यांकन रकम :</td>
                                                                <td>{{ 'रु ' . NepaliAmount($final_payment->hal_mulyankan) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">योजनाको खुद मुल्यांकन रकम :</td>
                                                                <td>{{ 'रु ' . NepaliAmount($final_payment->evaluated_amount) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">भुक्तानी दिनु पर्ने कुल रकम :</td>
                                                                <td>{{ 'रु ' . NepaliAmount($final_payment->final_payable_amount) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">मुल्यांकन अनुसार हाल सम्म भुक्तानी
                                                                    लगेको
                                                                    कुल रकम :</td>
                                                                <td>{{ 'रु ' . NepaliAmount($final_payment->payment_till_now) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">घटी मुल्यांकन रकम :</td>
                                                                <td>{{ 'रु ' . NepaliAmount($final_payment->ghati_mulyankan_amount) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">जम्मा भुक्तानी रकम :</td>
                                                                <td>{{ 'रु ' . NepaliAmount($final_payment->total_bhuktani_amount) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">कन्टेन्जेन्सी कट्टी रकम :</td>
                                                                <td>{{ 'रु ' . NepaliAmount($final_payment->final_contingency_amount) }}
                                                                </td>
                                                            </tr>
                                                            @foreach ($final_payment->finalPaymentDeatils as $finalPaymentDetail)
                                                                <tr>
                                                                    <td class="text-right">
                                                                        {{ $finalPaymentDetail->Deduction->name }}
                                                                    </td>
                                                                    <td>{{ 'रु ' . NepaliAmount($finalPaymentDetail->deduction_amount) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td class="text-right">जम्मा कट्टी रकम :</td>
                                                                <td>{{ 'रु ' . NepaliAmount($final_payment->final_total_amount_deducted) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">हाल भुक्तानी दिनु पर्ने खुद रकम :
                                                                </td>
                                                                <td>{{ 'रु ' . NepaliAmount($final_payment->final_total_paid_amount) }}
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end of antim bhuktani bibaran --}}
                        @endif
                        @if ($final_payment == null)
                            <form method="POST" action="{{ route('plan.thekka.final_payment_store') }}">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                    <div class="col-12 mt-2">
                                        <div class="form-group mt-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('Auto calculate :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <select name="is_auto_calculate" id="is_auto_calculate"
                                                    class="form-control">
                                                    <option value="0">NO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('सार्बजनिक परिक्षण भएको मिति :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm nepali-date @error('public_exam_date') is-invalid @enderror"
                                                    name="public_exam_date" readonly required>
                                                @error('public_exam_date')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('सार्बजनिक परिक्षण भएको मिति अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('सार्बजनिक परिक्षण भेलमामा उपस्थित संख्या') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm amount @error('public_group_count') is-invalid @enderror"
                                                    name="public_group_count" required>
                                                @error('public_group_count')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('सार्बजनिक परिक्षण भेलमामा उपस्थित संख्या अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('योजना सम्पन्न हुने मिति :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control form-conrol-sm"
                                                    value="{{ Nepali($plan_end_date_check) }}" disabled required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('योजनाको काम सम्पन्न भएको मिति :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm @error('plan_end_date') is-invalid @enderror"
                                                    name="plan_end_date" id="plan_end_date" readonly required>
                                                @error('plan_end_date')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('योजनाको काम सम्पन्न भएको मिति अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ $contract_kabol->listRegistrationAttribute->listRegistration->name . __('को बैठक बसी खर्च स्वीकृत गरेको मिति :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm nepali-date @error('type_accept_date') is-invalid @enderror"
                                                    name="type_accept_date" readonly required>
                                                @error('type_accept_date')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ $contract_kabol->listRegistrationAttribute->listRegistration->name . __('को बैठक बसी खर्च स्वीकृत गरेको मिति :') . __(' अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('अनुगमन समितिको बैठक बसी खर्च स्वीकृत गरेको मिति :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm nepali-date @error('anugaman_accept_date') is-invalid @enderror"
                                                    name="anugaman_accept_date" readonly required>
                                                @error('anugaman_accept_date')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('अनुगमन समितिको बैठक बसी खर्च स्वीकृत गरेको मिति अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('योजनाको मुल्यांकन मिति :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm nepali-date @error('assessment_date') is-invalid @enderror"
                                                    name="assessment_date" readonly required>
                                                @error('assessment_date')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('योजनाको मुल्यांकन मिति अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('इष्टिमेट भएको रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm amount @error('est_amount') is-invalid @enderror"
                                                    name="est_amount" value="{{ $contract_kabol->total_amount }}"
                                                    required>
                                                @error('est_amount')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('इष्टिमेट भएको रकम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('योजनाको हाल मुल्यांकन रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm amount @error('hal_mulyankan') is-invalid @enderror"
                                                    name="hal_mulyankan" id="hal_mulyankan" required>
                                                @error('hal_mulyankan')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('योजनाको हाल मुल्यांकन रकम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('योजनाको खुद मुल्यांकन रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm amount @error('evaluated_amount') is-invalid @enderror"
                                                    name="evaluated_amount" id="evaluated_amount" required readonly>
                                                @error('evaluated_amount')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('योजनाको खुद मुल्यांकन रकम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('भुक्तानी दिनु पर्ने कुल रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm amount @error('final_payable_amount') is-invalid @enderror"
                                                    name="final_payable_amount" id="final_payable_amount" value="0"
                                                    required>
                                                @error('final_payable_amount')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('भुक्तानी दिनु पर्ने कुल रकम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('मुल्यांकन अनुसार हाल सम्म भुक्तानी लगेको कुल रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm amount @error('payment_till_now') is-invalid @enderror"
                                                    name="payment_till_now"
                                                    value="{{ $sum_running_bill_payable_amount }}" required>
                                                @error('payment_till_now')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('मुल्यांकन अनुसार हाल सम्म भुक्तानी लगेको कुल रकम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('पेश्की भुक्तानी लगेको कट्टी रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm amount @error('advance_payment') is-invalid @enderror"
                                                    name="advance_payment"
                                                    value="{{ $advance == null ? 0 : $advance->peski_amount }}" required
                                                    readonly>
                                                @error('advance_payment')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('पेश्की भुक्तानी लगेको कट्टी रकम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{ __('घटी मुल्यांकन रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm amount @error('ghati_mulyankan_amount') is-invalid @enderror"
                                                    name="ghati_mulyankan_amount" id="ghati_mulyankan_amount" required
                                                    readonly>
                                                @error('ghati_mulyankan_amount')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('घटी मुल्यांकन रकम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('जम्मा भुक्तानी रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm amount @error('total_bhuktani_amount') is-invalid @enderror"
                                                    name="total_bhuktani_amount" id="total_bhuktani_amount" required>
                                                @error('total_bhuktani_amount')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('जम्मा भुक्तानी रकम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('कन्टेन्जेन्सी कट्टी रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm sum_calc amount @error('final_contingency_amount') is-invalid @enderror"
                                                    name="final_contingency_amount" id="final_contingency_amount"
                                                    required>
                                                @error('final_contingency_amount')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('कन्टेन्जेन्सी कट्टी रकम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <table id="table1" width="100%" class="table table-bordered shadow-lg">
                                            <thead class="bg-secondary">
                                                <tr>
                                                    @foreach ($deductions as $deduction)
                                                        <th class="text-center">{{ $deduction->name }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($deductions as $key => $deduction)
                                                        <td class="text-center">
                                                            <input type="text"
                                                                class="form-control amount sum_calc auto_calculate deduction_a my-1 form-control-sm"
                                                                id="deduction_amount_{{ $key }}"
                                                                name="deduction[{{ $deduction->id }}]" value="0">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text ">{{ __('जम्मा कट्टी रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm amount @error('final_total_amount_deducted') is-invalid @enderror"
                                                    name="final_total_amount_deducted" id="final_total_amount_deducted"
                                                    required readonly>
                                                @error('final_total_amount_deducted')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('जम्मा कट्टी रकम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text ">{{ __('हाल भुक्तानी दिनु पर्ने खुद रकम :') }}
                                                        <span class="text-danger px-1 font-weight-bold">*</span>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-conrol-sm amount @error('final_total_paid_amount') is-invalid @enderror"
                                                    name="final_total_paid_amount" id="final_total_paid_amount" required
                                                    readonly>
                                                @error('final_total_paid_amount')
                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                        {{ __('हाल भुक्तानी दिनु पर्ने खुद रकम अनिवार्य छ') }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <button class="btn btn-sm btn-primary"
                                            onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?');">{{ __('सेभ गर्नुहोस्') }}</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class='card-footer'>
                <a href="" class='btn btn-danger'><i class="fa-sharp fa-solid fa-trash"></i>अन्तिम भुक्तानी
                    हटाउनुहोस् |</a>
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
        let PLAN_END_DATE = "{{ $plan_end_date_check }}";
        let EVULATED_AMOUNT = +"{{ $plan_own_evaluation_amount_from_running_bill }}";
        let PLAN_ID = +"{{ $plan->id }}";
        let EST_AMOUNT = +
            "{{ $contract_kabol == null ? $plan->kulLagat->total_investment : $contract_kabol->total_amount }}";
        let peskiAmount = +"{{ $running_bill_payments->count() ? 0 : ($advance == null ? 0 : $advance->peski_amount) }}";
        let deduction_loop = +{{ $deductions->count() }};
        let decimal = +{{ $decimal_point->name }};
        let napa_amount = 0;

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

            var mainInput = document.getElementById("plan_end_date");
            mainInput.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100,
                onChange: function() {
                    var curr_date = mainInput.value;
                    if (curr_date > PLAN_END_DATE) {
                        console.log('here');
                        alert("यो मिति सम्पन्न हुनु पर्ने मिति भन्दा बढी भएकोले कृपया म्याद थप गर्नुहोला");
                        mainInput.value = "";
                    }
                }
            });
        };

        $(function() {
            $("#hal_mulyankan").on("input", function() {
                hal_mulyankan = +$("#hal_mulyankan").val();
                $("#evaluated_amount").val(hal_mulyankan + EVULATED_AMOUNT);
                $("#ghati_mulyankan_amount").val(EST_AMOUNT - (hal_mulyankan + EVULATED_AMOUNT));
            });

            $("#total_bhuktani_amount").on("input", function() {
                total_bhuktani_amount = +$("#total_bhuktani_amount").val() || 0;
                deduction = 0;
                $('.sum_calc').each(function() {
                    deduction += Number($(this).val()) || 0;
                });
                $("#final_total_amount_deducted").val(deduction);
                $("#final_total_paid_amount").val(total_bhuktani_amount - deduction);
            });

            $(".sum_calc").on("input", function() {
                total_bhuktani_amount = +$("#total_bhuktani_amount").val() || 0;
                deduction = 0;
                $('.sum_calc').each(function() {
                    deduction += Number($(this).val()) || 0;
                });
                $("#final_total_amount_deducted").val(deduction);
                $("#final_total_paid_amount").val(total_bhuktani_amount - deduction);
            });
        });
    </script>
@endsection
