@extends('layout.layout')
@section('sidebar')
    @include('layout.malpot_sidebar')
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('land_detail_store') }}">
            @csrf
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">जग्गाको बिभरण थप्नुहोस</h3>
                </div>
                <div class="card-body">
                    <input type="hidden" name="land_owner_id" value="{{ $land_owner_id }}">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">साबिक गा.पा/न.पा*: </span>
                                </div>
                                <select name="old_vdc_mp" id="old_vdc_mp" class="form-control" required="">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($sabik_gapa as $item)
                                        <option value="{{ $item->old_vdc_mp }}"
                                            {{ old('old_vdc_mp') == $item->old_vdc_mp ? 'selected' : '' }}>
                                            {{ $item->old_vdc_mp }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('old_vdc_mp')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">साबिक वडा नं*:
                                    </span></div>
                                <select name="old_ward" id="old_ward" class="form-control" required="">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($sabik_ward as $item)
                                        <option value="{{ $item->old_ward }}" {{ old('old_ward') == $item->old_ward ? 'selected' : '' }}>{{ Nepali($item->old_ward) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('old_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">हाल गा.पा/न.पा*:
                                    </span></div>
                                <input type="text" name="new_vdc_mp" id="new_vdc_mp" class="form-control" value="{{old('new_vdc_mp')}}" required
                                    readonly>
                            </div>
                            @error('new_vdc_mp')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">हाल वडा नं*: </span>
                                </div>
                                <input type="text" name="new_ward" id="new_ward" class="form-control" value="{{old('new_ward')}}" readonly>
                            </div>
                            @error('new_ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">जग्गाको क्षेत्रगत किसिम*:
                                    </span>
                                </div>
                                <select name="land_area_type_id" id="land_area_type_id" class="form-control" required="">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach (get_setting(config('SLUG.setup_land_area_types')) as $item)
                                        <option value="{{ $item->id }}" {{ old('land_area_type_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('land_area_type_id')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text"> जग्गाको वर्गीकरण*:
                                    </span></div>
                                <select name="land_category_type_id" id="land_category_type_id" class="form-control"
                                    required="">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach (get_setting(config('SLUG.setup_land_category_types')) as $item)
                                        <option value="{{ $item->id }}" {{ old('land_category_type_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('land_category_type_id')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text"> जग्गाको श्रेणी*:
                                    </span></div>
                                <select name="land_type_id" id="land_type_id" class="form-control" required="">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach (get_setting(config('SLUG.setup_land_types')) as $item)
                                        <option value="{{ $item->id }}" {{ old('land_type_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('land_type_id')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">कित्ता नं*: </span>
                                </div>
                                <input type="text" name="kitta_no" id="kitta_no" class="form-control number" value="{{old('kitta_no')}}" required>
                            </div>
                            @error('kitta_no')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror

                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">नक्सा नं*: </span>
                                </div>
                                <input type="text" name="naksa_no" id="naksa_no" class="form-control" value="{{old('naksa_no')}}" required>
                            </div>
                            @error('naksa_no')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{ config('constant.BIGGA') }}*: </span>
                                </div>
                                <input type="text" name="bigha_ropani" id="bigha_ropani" class="form-control area number" value="{{old('bigha_ropani')}}" required>
                            </div>
                            @error('bigha_ropani')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{ config('constant.KATTHA') }}*: </span>
                                </div>
                                <input type="text" name="kattha_aana" id="kattha_aana" class="form-control area number" value="{{old('kattha_aana')}}" required>
                            </div>
                            @error('kattha_aana')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{ config('constant.DHUR') }}*: </span>
                                </div>
                                <input type="number" name="dhur_paisa" id="dhur_paisa" class="form-control area number" value="{{old('dhur_paisa')}}" required>
                            </div>
                            @error('dhur_paisa')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{ config('constant.KANUA') }}*: </span>
                                </div>
                                <input type="text" name="kanwa_dam" id="kanwa_dam" class="form-control area amount" value="{{old('kanwa_dam')}}" required>
                            </div>
                            @error('kanwa_dam')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">क्षेत्रफल वर्ग मिटर (meter
                                        sq)*:
                                    </span>
                                </div>
                                <input type="text" name="meter_sq" id="meter_sq" class="form-control number" value="{{old('meter_sq')}}" required>
                            </div>
                            @error('meter_sq')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text">क्षेत्रफल वर्ग फिट (ft sq)*:
                                    </span>
                                </div>
                                <input type="text" name="ft_sq" id="ft_sq" class="form-control number"  value="{{old('ft_sq')}}" required>
                            </div>
                            @error('ft_sq')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" id="setting_back" class="btn btn-danger">
                    रद्द गर्नुहोस
                </button>
                <button type="submit" id="setting_submit" class="btn btn-primary">
                    सेब गर्नुहोस
                </button>
            </div>
        </form>

    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('change', '#old_vdc_mp', function(event) {
            var old_vdc_mp = event.target.value;
            var old_ward = $('#old_ward').val();
            if (old_ward != '') get_sabik(old_vdc_mp, old_ward)
        });
        $(document).on('change', '#old_ward', function(event) {
            var old_ward = event.target.value;
            var old_vdc_mp = $('#old_vdc_mp').val();
            if (old_vdc_mp != '') get_sabik(old_vdc_mp, old_ward)
        });

        $(document).on('input', '.area', function(event) {
            if('{{config('constant.LAND')}}' == 'hill') {
                hill_conversion();
            } else {
                terai_conversion();
            }

        });

        $(document).on('input', '#ft_sq', function(event) {
            var val = $('#ft_sq').val() || 0;
            var sq_feet_to_sq_meter = 0.0929022668153103;
            var sq_meter = sq_feet_to_sq_meter * sq_feet;
            $('#meter_sq').val(round(sq_meter, 2));
            if('{{config('constant.LAND')}}' == 'hill') {
                hill_conversion_from_sq_feet(val);
            } else {
                terai_conversion_from_sq_feet();
            }

        });

        $(document).on('input', '#meter_sq', function(event) {
            var val = $('#meter_sq').val() || 0;
            var sq_feet_to_sq_meter = 0.0929022668153103;
            var sq_ft = val / sq_feet_to_sq_meter;
            $('#ft_sq').val(round(sq_ft, 2));
            if('{{config('constant.LAND')}}' == 'hill') {
                hill_conversion_from_sq_feet(val);
            } else {
                terai_conversion_from_sq_feet();
            }
        });

        function get_sabik(old_vdc_mp, old_ward) {
            $('#new_vdc_mp').val('');
            $('#new_ward').val('');
            axios.get("{{ route('get_haal_from_sabik') }}", {
                    params: {
                        old_vdc_mp: old_vdc_mp,
                        old_ward: old_ward
                    }
                }).then(function(response) {
                    var rows = response.data;

                    $('#new_vdc_mp').val(rows.new_vdc_mp);
                    $('#new_ward').val(rows.new_ward);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function terai_conversion() {
            var bigha = $('#bigha_ropani').val() || 0;
            var kattha = $('#kattha_aana').val() || 0;
            var dhur = $('#dhur_paisa').val() || 0;
            var kanua = $('#kanwa_dam').val() || 0;

            if(kattha >= 20) {
                aana = 0;
                $('#kattha_aana').val('');
                alert("कठ्ठा हाल्दा २० भन्दा माथि भयो|");
            }
            if(dhur >= 20) {
                paisa = 0;
                $('#dhur_paisa').val('');
                alert("धुर हाल्दा २० भन्दा माथि भयो|");
            }
            if(kanua >= 4) {
                dam = 0;
                $('#kanwa_dam').val('');
                alert("कन्वा हाल्दा ४ भन्दा माथि भयो|");
            }

            var sq_feet = bigha * 74722.5 + kattha * 3645 + dhur * 182.25 + kanua * 45.5625;
            var sq_feet_to_sq_meter = 0.0929022668153103;
            var sq_meter = sq_feet_to_sq_meter * sq_feet;
            $('#ft_sq').val(sq_feet.toFixed(2));
            $('#meter_sq').val(sq_meter.toFixed(2));
        }

        function hill_conversion() {
            var ropani = $('#bigha_ropani').val() || 0;
            var aana = $('#kattha_aana').val() || 0;
            var paisa = $('#dhur_paisa').val() || 0;
            var dam = $('#kanwa_dam').val() || 0;
            if(aana >= 16) {
                aana = 0;
                $('#kattha_aana').val('');
                alert("आना हाल्दा १६ भन्दा माथि भयो|");
            }
            if(paisa >= 4) {
                paisa = 0;
                $('#dhur_paisa').val('');
                alert("पैसा हाल्दा ४ भन्दा माथि भयो|");
            }
            if(dam >= 4) {
                dam = 0;
                $('#kanwa_dam').val('');
                alert("दाम हाल्दा ४ भन्दा माथि भयो|");
            }
            var sq_feet = ropani * 5476 + aana * 342.25 + paisa * 85.56 + dam * 21.39;
            var sq_feet_to_sq_meter = 0.0929022668153103;
            var sq_meter = sq_feet_to_sq_meter * sq_feet;
            $('#ft_sq').val(sq_feet.toFixed(2));
            $('#meter_sq').val(sq_meter.toFixed(2));
        }

        function hill_conversion_from_sq_feet(sq_feet) {
            var ropani = 0;
            var aana = 0;
            var paisa = 0;
            var remaining_sq_feet = sq_feet
            if (remaining_sq_feet >= 5476) {
                var ropani_divide = remaining_sq_feet / 5476;
                var ropani = Math.floor(ropani_divide);
                var remaining_sq_feet = round(sq_feet - ropani * 5476, 2);
            }

            if (remaining_sq_feet >= 342.25) {
                var aana_divide = remaining_sq_feet / 342.25;
                var aana = Math.floor(aana_divide);
                var remaining_sq_feet = round(remaining_sq_feet - aana * 342.25, 2);
            }

            if (remaining_sq_feet >= 85.56) {
                var paisa_divide = remaining_sq_feet / 85.56;
                var paisa = Math.floor(paisa_divide);
                var remaining_sq_feet = round(remaining_sq_feet - paisa * 85.56, 2);

            }
            var dam_divide = remaining_sq_feet / 21.39;

            var dam_paisa = Math.floor(round(dam_divide, 2) / 4);
            console.log(dam_paisa);
            dam_divide = Math.abs(dam_divide - dam_paisa * 4);
            paisa += dam_paisa;
            // var dam = floor(dam_divide);
            // var remaining_sq_feet = remaining_sq_feet - dam * 21.39;

            $('#bigha_ropani').val(ropani);
            $('#kattha_aana').val(aana);
            $('#dhur_paisa').val(paisa);
            $('#kanwa_dam').val(dam_divide.toFixed(2));
        }
        function terai_conversion_from_sq_feet(sq_feet) {
            var bigha = 0;
            var kattha = 0;
            var dhur = 0;
            var remaining_sq_feet = sq_feet
            if (remaining_sq_feet >= 5476) {
                var bigha_divide = remaining_sq_feet / 5476;
                var bigha = Math.floor(bigha_divide);
                var remaining_sq_feet = round(sq_feet - bigha * 5476, 2);
            }

            if (remaining_sq_feet >= 342.25) {
                var kattha_divide = remaining_sq_feet / 342.25;
                var kattha = Math.floor(kattha_divide);
                var remaining_sq_feet = round(remaining_sq_feet - kattha * 342.25, 2);
            }

            if (remaining_sq_feet >= 85.56) {
                var dhur_divide = remaining_sq_feet / 85.56;
                var dhur = Math.floor(dhur_divide);
                var remaining_sq_feet = round(remaining_sq_feet - dhur * 85.56, 2);

            }
            var kanua_divide = remaining_sq_feet / 21.39;

            var kanua_dhur = Math.floor(round(kanua_divide, 2) / 4);
            console.log(kanua_dhur);
            kanua_divide = Math.abs(kanua_divide - kanua_dhur * 4);
            dhur += kanua_dhur;
            // var kanua = floor(kanua_divide);
            // var remaining_sq_feet = remaining_sq_feet - kanua * 21.39;

            $('#bigha_ropani').val(bigha);
            $('#kattha_aana').val(kattha);
            $('#dhur_paisa').val(dhur);
            $('#kanwa_dam').val(kanua_divide.toFixed(2));
        }

        const round = (n, dp) => {
            const h = +('1'.padEnd(dp + 1, '0')) // 10 or 100 or 1000 or etc
            return Math.round(n * h) / h
        }
    </script>
@endsection
