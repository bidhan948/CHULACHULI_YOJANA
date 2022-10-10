@section('title', 'मलेप रिपोर्ट')
@section('child_report', 'menu-open')
@section('report_malepa', 'active')
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
                <h3 class="card-title">{{ __('मलेप रिपोर्ट :') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="my-2">
                <table id="table" width="100%" class="table table-bordered">
                    <thead class="bg-primary">
                        <tr>
                            <td class="text-center font-weight-bold">{{ __('सि.नं') }}</td>
                            <td class="text-center font-weight-bold">{{ __('योजना दर्ता नं') }}</td>
                            <td class="text-center font-weight-bold">{{ __('उपभोक्ता समितिको नाम') }}</td>
                            <td class="text-center font-weight-bold">{{ __('अदक्ष्यको नाम') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कामको विवरण') }}</td>
                            <td class="text-center font-weight-bold">{{ __('लागत अनुमान') }}</td>
                            <td class="text-center font-weight-bold">{{ __('सम्झौता मिति') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कार्य सम्पन्न गर्नुपर्ने मिति') }}</td>
                            <td class="text-center font-weight-bold">{{ __('सम्झौता रकम') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कार्यालयले व्योर्ने') }}</td>
                            <td class="text-center font-weight-bold">{{ __('उपभोक्ता समितिले व्योर्ने') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कार्य सम्पन्न गरेको मिति') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कार्य सम्पन्न रकम') }}</td>
                            <td class="text-center font-weight-bold">{{ __('कार्यलयले भुक्तानी गरेको') }}</td>
                            <td class="text-center font-weight-bold">{{ __('उपभोक्ताको जनश्रमदान') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $key => $value)
                            <tr>
                                <td class="text-center font-weight-bold">{{ Nepali($key + 1) }}</td>
                                <td class="text-center font-weight-bold">{{ Nepali($value->reg_no) }}</td>
                                <td class="text-center font-weight-bold">{{ $value->name }}</td>
                                <td class="text-center font-weight-bold">
                                    @foreach ($value->Consumer->consumerDetails as $data)
                                        @if ($data->posts->name == 'अध्यक्ष')
                                            {{ $data->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center font-weight-bold">
                                    <p>उपक्षेत्र: {{ isset($value->subRegion->name) ? $value->subRegion->name : '' }}</p>
                                </td>
                                <td class="text-center font-weight-bold">
                                    {{ NepaliAmount($value->kulLagat->total_investment) }}</td>
                                <td class="text-center font-weight-bold">
                                    {{ Nepali($value->otherBibaran->agreement_date_nep) }} </td>
                                <td class="text-center font-weight-bold">
                                    @php
                                        $count = count($value->addDeadlines);
                                    @endphp

                                    @if ($count >= 1)
                                        @php
                                            $length = count($value->addDeadlines);
                                        @endphp
                                        @foreach ($value->addDeadlines as $key => $item)
                                            @if ($key + 1 == $length)
                                                {{ Nepali($item->period_add_date_nep) }}
                                            @endif
                                        @endforeach
                                    @else
                                        {{ Nepali($value->otherBibaran->end_date) }}
                                    @endif
                                </td>
                                <td class="text-center font-weight-bold">
                                    {{ NepaliAmount($value->kulLagat->total_investment) }}</td>
                                <td class="text-center font-weight-bold">
                                    {{ NepaliAmount($value->kulLagat->work_order_budget) }}</td>
                                <td class="text-center font-weight-bold">
                                    {{ NepaliAmount($value->kulLagat->consumer_budget) }}</td>
                                <td class="text-center font-weight-bold">
                                    {{ Nepali(isset($value->finalPayment->plan_end_date) ? $value->finalPayment->plan_end_date : '') }}
                                </td>
                                <td class="text-center font-weight-bold">
                                    {{ Nepali(isset($value->finalPayment->final_payable_amount) ? $value->finalPayment->final_payable_amount : '') }}
                                </td>
                                <td class="text-center font-weight-bold"></td>
                                <td class="text-center font-weight-bold">
                                    {{ Nepali(isset($value->kulLagat->consumer_budget)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

                {{$reports->links()}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
@endsection



@section('scripts')

@endsection
