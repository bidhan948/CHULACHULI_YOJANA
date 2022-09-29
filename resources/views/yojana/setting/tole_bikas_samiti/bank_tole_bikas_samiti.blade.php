@section('title', $tole_bikas_samiti->name . 'को बैंक रेकोर्ड')
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
<link rel="stylesheet" href="{{asset('css/print.css')}}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">{{ $tole_bikas_samiti->name . 'को बैंक रेकोर्ड' }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('tole-bikas-samiti.index') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-backward px-1"></i>{{ __('पछी जानुहोस्') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{route('tole-bikas-samiti.print_bank',[$tole_bikas_samiti])}}" method="get" target="_blank">
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">बैंक छान्नुहोस्:</span>
                                    </div>
                                    <select name="bank_id" id="bank_id" class="form-control " required>
                                        <option value="">{{ __('---छान्नुहोस्---') }}</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" name="submit"
                                class="btn btn-primary">{{ __('प्रिन्ट गर्नुहोस्') }}</button>
                        </div>
                    </div>
                    {{-- START LETTER --}}
                    <div class="container-fluid letter my-5">
                        <div class="letter_header">
                            <div class="letter_header_left ml-4">
                                <img src="{{ asset('emblem_nepal.png') }}" alt="" class="logo">
                                <div> आ.ब : {{ Nepali(getCurrentFiscalYear()) }}</div>
                                <div> सुची दर्ता नं : {{ Nepali($tole_bikas_samiti->reg_no) }}</div>
                                <div> च नं :</div>
                            </div>
                            <div class="letter_header_title">
                                <h1> {{ config('constant.SITE_NAME') }}</h1>
                                <h2>{{ config('constant.SITE_SUB_TYPE') }}</h2>
                                <span>{{ config('constant.FULL_ADDRESS') }}</span>
                            </div>
                            <div class="letter_header_right">
                                <span style="display: flex;"> <span style="line-height: 34px;" class="pr-2"> मिति
                                    </span> <input type="text" value="{{ $tole_bikas_samiti->date_nep }}" id="date_nep"
                                        class="form-control form-control-sm" name="date_nep"></span>
                            </div>
                        </div>
                        <div class="letter_body">
                            <div class="letter_title"> विषय:- बैंक खाता सम्बन्धमा । </div>

                            <div class="letter_body_content">
                                श्री <span id="bank_name"> </span> <br>
                                <span id="bank_address"> </span> <br>
                                <p class="mt-4">
                                    उपरोक्त बिषयमा यस {{ config('constant.SITE_TYPE') }} र
                                    {{ $tole_bikas_samiti->name }}
                                    बिच योजना संचालन गर्ने भनि संझौता
                                    भएकोमा योजना संचालन गर्न टोल विकास समितिको नाममा बैंक खाता आबश्यक भएकाले टोल विकास
                                    समितिका अध्यक्ष श्री
                                    {{ $tole_bikas_samiti->toleBikasSamitiDetails->count()? ($tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_ADAKSHYA_ID'))->count()? $tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_ADAKSHYA_ID'))->values()[0]->name: ''): '' }},
                                    सचिब श्री
                                    {{ $tole_bikas_samiti->toleBikasSamitiDetails->count()? ($tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_SACHIB_ID'))->count()? $tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_SACHIB_ID'))->values()[0]->name: ''): '' }}
                                    र कोषाध्यक्ष श्री
                                    {{ $tole_bikas_samiti->toleBikasSamitiDetails->count()? ($tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_KOSADAKSHYA_ID'))->count()? $tole_bikas_samiti->toleBikasSamitiDetails->where('position', config('constant.TOLE_KOSADAKSHYA_ID'))->values()[0]->name: ''): '' }}
                                    को संयुक्त दस्तखतबाट संचालन हुने गरी चल्ती खाता खोली दिनहुन अनुरोध छ ।
                                </p>
                            </div>

                        </div>
                        <div class="letter_footer">
                            <div class="sing">
                                @for ($i = 0; $i < 40; $i++)
                                    .
                                @endfor
                            </div>
                        </div>
                    </div>
                    {{-- END LETTER --}}
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
        window.onload = function() {
            var mainInput = document.getElementById("date_nep");
            mainInput.nepaliDatePicker({
                readOnlyInput: true,
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100
            });
        }

        $("#bank_id").on("change", function() {
            bank_id = $("#bank_id").val();
            if (bank_id == '') {
                alert("बैंक छान्नुहोस्")
                $("#bank_address").text("");
                $(".letter").css("display", "none");
            } else {
                axios.get("{{ route('api.getBankName') }}", {
                        params: {
                            bankId: bank_id
                        }
                    }).then(function(response) {
                        $("#bank_name").text(response.data.name);
                        $("#bank_address").text(response.data.address);
                        $(".letter").css("display", "");
                    })
                    .catch(function(error) {
                        alert("Something went wrong");
                    });
            }
        });
    </script>
@endsection
