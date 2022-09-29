@section('title', 'कार्यक्रम कुल लागत')
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
                        <h3 class="card-title">{{ __('कार्यक्रम कुल लागत') }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('work_order.kul_lagat', $regNo) }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-1 bg-primary text-center p-2">
                            {{ __('कार्यक्रम दर्ता नं : ' . Nepali($regNo)) . ' || कार्यदेशको नाम : ' . $work_order->name }}
                        </p>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('कार्यक्रमको कुल लागत अनुमान भर्नुहोस्') }} </h3>
                            </div>
                            <form method="POST" action="{{ route('work_order.kul_lagat.store') }}">
                                @csrf
                                <input type="hidden" name="work_order_id" value="{{ $work_order->id }}">
                                <div class="card-body">
                                    <table id="table1" width="100%" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{ __('विवरण') }}</th>
                                                <th class="text-center">{{ __('इकाई') }}</th>
                                                <th class="text-center" style="width: 10%">{{ __('दर') }}</th>
                                                <th class="text-center" style="width: 10%">{{ __('परिमाण') }}</th>
                                                <th class="text-center" style="width: 15%">{{ __('जम्मा') }}</th>
                                                <th class="text-center">{{ __('कैफियत') }}</th>
                                                <th class="text-center">
                                                    @if ($work_order->programKulLagat->count())
                                                        <a class="btn btn-primary btn-sm" id="addMore"><i
                                                            class="fa-solid fa-plus"></i></a>
                                                    @endif
                                                </th>
                                            </tr>
                                        </thead>
                                        @if ($work_order->programKulLagat->count())
                                            <tbody id="rowBody">
                                                @foreach ($work_order->programKulLagat as $key => $programKulLagat)
                                                    <tr id="remove_{{$key}}">
                                                        <td class="text-center">
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="bibaran[]" required
                                                                value="{{ $programKulLagat->bibaran }}">
                                                        </td>
                                                        <td class="text-center">
                                                            <select name="unit_id[]" id="unit_id_0"
                                                                class="form-control form-control-sm">
                                                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                                @foreach ($units->settingValues as $settingValue)
                                                                    <option value="{{ $settingValue->id }}"
                                                                        {{ $programKulLagat->unit_id == $settingValue->id ? 'selected' : '' }}>
                                                                        {{ $settingValue->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="text"
                                                                class="form-control form-control-sm amount calculate-total"
                                                                name="unit_price[]"
                                                                oninput="calculatePrice({{ $key }})"
                                                                id="unit_price_{{ $key }}"
                                                                value="{{ $programKulLagat->unit_price }}" required>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="text"
                                                                class="form-control form-control-sm amount calculate-total"
                                                                name="quantity[]"
                                                                oninput="calculatePrice({{ $key }})"
                                                                id="quantity_{{ $key }}"
                                                                value="{{ $programKulLagat->quantity }}" required>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="text"
                                                                class="form-control form-control-sm amount total"
                                                                name="total[]" id="total_{{ $key }}"
                                                                value="{{ $programKulLagat->total }}" required readonly>
                                                        </td>
                                                        <td class="text-center">
                                                            <textarea name="remark[]" id="remark_0" class="form-control form-control-sm">{{$programKulLagat->remark}}</textarea>
                                                        </td>
                                                        <td class="text-center">
                                                                <a class="btn btn-danger btn-sm"
                                                                    onclick="removeRow({{ $key }})"><i
                                                                        class="fa-solid fa-xmark"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @else
                                            <tbody id="rowBody">
                                                <tr>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="bibaran[]" required>
                                                    </td>
                                                    <td class="text-center">
                                                        <select name="unit_id[]" id="unit_id_0"
                                                            class="form-control form-control-sm">
                                                            <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                                            @foreach ($units->settingValues as $settingValue)
                                                                <option value="{{ $settingValue->id }}">
                                                                    {{ $settingValue->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text"
                                                            class="form-control form-control-sm amount calculate-total"
                                                            name="unit_price[]" oninput="calculatePrice(0)"
                                                            id="unit_price_0" required>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text"
                                                            class="form-control form-control-sm amount calculate-total"
                                                            name="quantity[]" oninput="calculatePrice(0)" id="quantity_0"
                                                            required>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-control-sm amount total"
                                                            name="total[]" id="total_0" required readonly>
                                                    </td>
                                                    <td class="text-center">
                                                        <textarea name="remark[]" id="remark_0" class="form-control form-control-sm"></textarea>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-primary btn-sm" id="addMore"><i
                                                                class="fa-solid fa-plus"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endif
                                        <tbody>
                                            <tr>
                                                <td class="text-center" colspan="4">{{ __('जम्मा') }}</td>
                                                <td class="text-center">
                                                    <input type="text" id="grand_total" name=""
                                                        value="{{$work_order->programKulLagat->sum('total')}}" 
                                                        class="form-control form-control-sm" required readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-primary"
                                            onclick="return confirm('के तपाई निश्चित हुनुहुन्छ ?');">
                                            {{ __('सेभ गर्नुहोस्') }}
                                        </button>
                                    </div>
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
            let i = +{{$work_order->programKulLagat->count() == 0 ? 1 : $work_order->programKulLagat->count()}}
            $("#addMore").on("click", function() {
                html = '<tr id="remove_'+i+'">'
                    +'<td class="text-center">'
                        +'<input type="text" class="form-control form-control-sm"'
                            +'name="bibaran[]" required>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<select name="unit_id[]"'
                            +'class="form-control form-control-sm">'
                            +'<option value="">{{ __("--छान्नुहोस्--") }}</option>'
                            +'@foreach ($units->settingValues as $settingValue)'
                                +'<option value="{{ $settingValue->id }}">'
                                    +'{{ $settingValue->name }}</option>'
                            +'@endforeach'
                        +'</select>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<input type="number"'
                            +'class="form-control form-control-sm amount calculate-total" step="0.1"'
                            +'name="unit_price[]" oninput="calculatePrice('+i+')" id="unit_price_'+i+'" required>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<input type="number"'
                            +'class="form-control form-control-sm amount calculate-total"'
                            +'name="quantity[]" oninput="calculatePrice('+i+')" id="quantity_'+i+'" required>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<input type="text"'
                            +'class="form-control form-control-sm amount total"'
                            +'name="total[]" id="total_'+i+'" required readonly>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<textarea name="remark[]" class="form-control form-control-sm"></textarea>'
                    +'</td>'
                    +'<td class="text-center">'
                        +'<a class="btn btn-danger btn-sm" onclick="removeRow('+i+')""><i class="fa-solid fa-xmark"></i></a>'
                    +'</td>'
                +'</tr>';
                $("#rowBody").append(html);
                i++;
            })
        });

        function removeRow(params) {
            var total = $("#total_" + params).val() || 0;
            var grand_total = $("#grand_total").val() || 0;
            $("#grand_total").val(grand_total - total);
            $("#remove_" + params).remove();
        }

        function calculatePrice(row) {
            console.log(row);
            var unit_price = +$("#unit_price_" + row).val() || 0;
            var quantity = +$("#quantity_" + row).val() || 0;
            $("#total_" + row).val(unit_price * quantity);
            var grand_total = 0;
            $('.total').each(function() {
                grand_total += Number($(this).val()) || 0;
            });
            $("#grand_total").val(grand_total);
        }
    </script>
@endsection
