@extends('layout.layout')
@section('sidebar')
    @include('layout.nagadi_sidebar')
@endsection


@section('content')
    <form method="post" action="{{ route('nagadi-rasid-store') }}">
        @csrf
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">प्रदेश:</span>
                                </div>
                                <select name="provience" id="province"
                                    placeholder="छान्नुहोस्" class="form-control" required>
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id }}">{{ $item->nep_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('provience')
                                    <strong> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">जिल्ला:</span>
                                </div>
                                <select name="district" id="district"
                                    placeholder="छान्नुहोस्" class="form-control" required>
                                    <option value="">छान्नुहोस्</option>

                                </select>
                                @error('district')
                                    <strong> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">ग.पा / न. पा:</span>
                                </div>
                                <select name="gapa_napa" id="municipality" placeholder="छान्नुहोस्" class="form-control" required>
                                    <option value="">छान्नुहोस्</option>

                                </select>
                                @error('municipality')
                                    <strong> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">वडा:</span>
                                </div>
                                <select id="ward" name="ward" id="setting_cascading_parent_id" placeholder="छान्नुहोस्"
                                    class="form-control" required>
                                    <option value="">छान्नुहोस्</option>
                                </select>

                            </div>
                            @error('ward')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">आर्थिक वर्ष:</span>
                                </div>
                                <input class="form-control" readonly placeholder="" type="text"
                                    value="{{ $current_fiscal_year->name }}">
                                <input type="hidden" name="fiscal_year_id" value="{{ $current_fiscal_year->id }}">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">मिति:</span>
                                </div>
                                <input class="form-control" name="date_nep" readonly placeholder="" type="text"
                                    value="{{ convertAdToBs(now()) }}">

                            </div>
                            @error('date_nep')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">रशिद नं. :</span>
                                </div>
                                <input class="form-control" name="bill_no" readonly placeholder="" type="text" value="">

                            </div>
                            @error('bill_no')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">करदातको नाम *:</span>
                                </div>
                                <input class="form-control" name="customer_name" placeholder="करदातको नाम" type="text"
                                    value="" required>

                            </div>
                            @error('customer_name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">स्थायी लेखा नं. :</span>
                                </div>
                                <input class="form-control" placeholder="स्थायी लेखा नं" name="pan_no" type="text"
                                    value="">
                            </div>
                            @error('pan_no')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead style="background: #1b5693; color:#fff">
                                <tr>
                                    <th colspan="2">बिल विवरण प्रविष्ट गर्नुहोस् </th>
                                </tr>
                            </thead>
                            <tbody id="mul_tbody">
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">मुख्य शीर्षक:</span>
                                                        </div>
                                                        <select id="main_sirsak" onchange="onMainSirsakChange(this)"
                                                            class="form-control" name="main_sirsak[]" required>
                                                            <option value="">छान्नुहोस्</option>
                                                            @foreach ($main_sirsaks as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">सहायक शीर्षक:</span>
                                                        </div>
                                                        <select id="upa_sirsak" onchange="onUpaSirsakChange(this)"
                                                            class="form-control" name="upa_sirsak[]" required>
                                                            <option value="">छान्नुहोस्</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">शीर्षक:</span>
                                                    </div>
                                                    <select class="form-control" id="sirsak"
                                                        onchange="onSirsakChange(this)" name="sirsak[]">
                                                        <option value="">छान्नुहोस्</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="other_topic" style="display: none;">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">अन्य शीर्षक:</span>
                                                        </div>
                                                        <input type="text" name="anya_sirsak[]" value=""
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">दर/रकम: &nbsp;&nbsp;
                                                                <span id="rate_type"></span>
                                                                <input type="hidden" name="rate_type[]"
                                                                    id="rate_type_amount" required />
                                                            </span>
                                                        </div>
                                                        <input type="number" name="rate[]" oninput="onRateChange(this)"
                                                            readonly value="" id="rate" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">परिमाण/रकम:</span>
                                                        </div>
                                                        <input type="number" name="parimad[]"
                                                            oninput="onParimadChange(this)" onfocus="onParimadChange(this)"
                                                            value="1" id="parimad" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">जम्मा:</span>
                                                        </div>
                                                        <input type="text" name="total[]" id="total" readonly required value=""
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="row"> <button type="button" class="btn btn-primary btn-sm"
                                                id="add_btn" onclick="addTr(this)"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="row"><button type="button" class="btn btn-warning btn-sm"
                                                id="remove_btn" onclick="removeTr(this)"> <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <hr> --}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">कुल जम्मा:</span>
                                </div>
                                <input class="form-control" name="grand_total" id="grand_total" placeholder="" readonly
                                    type="text">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">लिएको रकम:</span>
                                </div>
                                <input class="form-control" name="recieved_amount" id="received_money"
                                    oninput="onReceivedMoneyChange(this)" placeholder="" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">फिर्ता रकम:</span>
                                </div>
                                <input class="form-control" id="returned_money" name="return_amount" placeholder=""
                                    readonly type="text">
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">प्राप्तीकाे माध्यम:</span>
                                </div>
                                <select id="payment_mode" name="payment_mode" class="form-control" name="sub_topic[]">
                                    <option value="1" selected>नगद</option>
                                    <option value="2">चेक</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" id="rasid_submit" class="btn btn-primary">
                    सेब गर्नुहोस
                </button>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    @include('shared.script.address')
    <script>
        let mul_tbody = document.querySelector("#mul_tbody");

        function addTr(event) {
            let tr = event.closest('tr');
            let clone = tr.cloneNode(true);
            event.style.display = 'none';
            clone.id = "";

            let el_upa_sirsak = clone.querySelector("#upa_sirsak");
            let el_main_sirsak = clone.querySelector("#main_sirsak");
            let el_sirsak = clone.querySelector("#sirsak");
            let el_total = clone.querySelector("#total");
            let el_parimad = clone.querySelector("#parimad");
            let el_rate = clone.querySelector("#rate");
            let el_rate_type = clone.querySelector("#rate_type");
            let el_rate_type_amount = clone.querySelector("#rate_type_amount");

            el_main_sirsak.value = "";
            el_upa_sirsak.value = "";
            el_sirsak.value = "";
            el_total.value = "";
            el_parimad.value = "1";
            el_rate.value = "";
            el_rate_type.innerHTML = "";
            el_rate_type_amount.innerHTML = "";

            el_upa_sirsak.innerHTML = '<option value="">छान्नुहोस्</option>';
            el_sirsak.innerHTML = '<option value="">छान्नुहोस्</option>';

            mul_tbody.appendChild(clone);
        }

        function removeTr(event) {
            let tr = event.closest('tr');
            let td = event.closest('td');
            var children = td.children;
            var is_hidden = true;

            let el_add_btn = td.querySelector("#add_btn");
            let el_remove_btn = td.querySelector("#remove_btn");
            if (el_add_btn.style.display != 'none') {
                is_hidden = false;
            }
            if (!is_hidden) {
                let prevTr = tr.previousElementSibling;
                if (prevTr == null) {
                    return;
                }
                let el_prev_add_btn = prevTr.querySelector("#add_btn");
                el_prev_add_btn.style.display = 'inline';
                let cells = prevTr.cells;
            }
            tr.remove();
        }


        function onMainSirsakChange(event) {
            var main_sirsak = event.value;
            let tr = event.closest('tr');
            var html = '<option value="">छान्नुहोस्</option>';

            let el_upa_sirsak = tr.querySelector("#upa_sirsak");
            let el_sirsak = tr.querySelector("#sirsak");

            let el_rate = tr.querySelector("#rate");
            let el_other_topic = tr.querySelector("#other_topic");

            let el_parimad = tr.querySelector("#parimad");
            let el_total = tr.querySelector("#total");

            el_parimad.value = '1';
            el_total.value = '';

            el_rate.setAttribute('readonly', true);
            el_other_topic.style.display = 'none';

            el_rate.value = '';

            el_upa_sirsak.innerHTML = html;
            el_sirsak.innerHTML = html;

            el_upa_sirsak.value = '';
            el_sirsak.value = '';


            if (main_sirsak != '') {
                axios.get("{{ route('nagadi-get-categories') }}", {
                        params: {
                            pid: main_sirsak
                        }
                    }).then(function(response) {
                        var selected = '';
                        var rows = response.data;
                        $.each(rows, function(key, value) {
                            html += '<option value="' + value.id + '" data-hasChild="' + value.has_child +
                                '" data-rate="' + value.rate + '" data-rateType="' + value.rate_type +
                                '" ' + selected + '>' + value.name +
                                '</option>';
                        });
                        el_upa_sirsak.innerHTML = html;
                    })
                    .catch(function(error) {
                        console.log(error);;
                    });
            }
        }

        function onUpaSirsakChange(event) {
            var upa = event.value;
            let tr = event.closest('tr');
            var html = '<option value="">छान्नुहोस्</option>';

            let el_sirsak = tr.querySelector("#sirsak");
            let el_rate = tr.querySelector("#rate");
            let el_other_topic = tr.querySelector("#other_topic");

            let el_rate_type = tr.querySelector("#rate_type");
            let el_rate_type_amount = tr.querySelector("#rate_type_amount");

            let el_parimad = tr.querySelector("#parimad");

            el_parimad.value = '1';

            el_rate_type.innerHTML = '';
            el_rate_type_amount.innerHTML = '';

            el_rate.setAttribute('readonly', true);
            el_other_topic.style.display = 'none';

            el_rate.value = '';
            el_sirsak.innerHTML = html;
            el_sirsak.value = '';

            let el_total = tr.querySelector("#total");
            el_total.value = '';

            let el_grand_total = document.querySelector("#grand_total");
            el_grand_total.value = '';

            const hasChild = event.options[event.selectedIndex].getAttribute('data-hasChild');
            const rate = event.options[event.selectedIndex].getAttribute('data-rate');

            const rate_type_data = event.options[event.selectedIndex].getAttribute('data-rateType');

            if (hasChild == 0) {
                el_rate.value = rate;
                el_rate_type.innerHTML = convertToNepaliRate(rate_type_data);
                el_rate_type_amount.value = rate_type_data;
                const e = new Event("input");
                el_rate.dispatchEvent(e);
            }

            if (main_sirsak != '' && hasChild > 0) {
                axios.get("{{ route('nagadi-get-categories') }}", {
                        params: {
                            pid: upa
                        }
                    }).then(function(response) {
                        console.log(response);
                        var selected = '';
                        var rows = response.data;
                        $.each(rows, function(key, value) {
                            html += '<option value="' + value.id + '" data-hasChild="' + value.has_child +
                                '" data-rate="' + value.rate + '" data-rateType="' + value.rate_type +
                                '" ' + selected + '>' + value.name +
                                '</option>';
                        });
                        html += '<option value="others">अन्य शिर्षक</option>';
                        el_sirsak.innerHTML = html;
                    })
                    .catch(function(error) {
                        console.log(error);;
                    });
            }
        }

        function onSirsakChange(event) {
            var sirshak = event.value;
            let tr = event.closest('tr');

            let el_rate = tr.querySelector("#rate");
            el_rate.value = '';

            let el_other_topic = tr.querySelector("#other_topic");

            let el_rate_type = tr.querySelector("#rate_type");
            let el_rate_type_amount = tr.querySelector("#rate_type_amount");

            el_rate_type.innerHTML = '';
            el_rate_type_amount.innerHTML = '';

            el_rate.setAttribute('readonly', true);
            el_other_topic.style.display = 'none';

            let el_total = tr.querySelector("#total");
            el_total.value = '';

            let el_grand_total = document.querySelector("#grand_total");
            el_grand_total.value = '';

            if (sirshak == 'others') {
                el_rate.removeAttribute("readonly");
                el_other_topic.style.display = 'inline';
            } else {
                const rate_type_data = event.options[event.selectedIndex].getAttribute('data-rateType');
                el_rate_type.innerHTML = convertToNepaliRate(rate_type_data);
                el_rate_type_amount.value = rate_type_data;

                const rate = event.options[event.selectedIndex].getAttribute('data-rate');
                el_rate.value = rate;
            }
            const e = new Event("input");
            el_rate.dispatchEvent(e);
        }

        function onParimadChange(event) {
            var parimad = event.value;

            let tr = event.closest('tr');

            let el_rate_type = tr.querySelector("#rate_type_amount");

            let rate_type_amount = parseInt(el_rate_type.value) || 1;

            let el_rate = tr.querySelector("#rate");
            let el_total = tr.querySelector("#total");

            var per = el_rate.value / rate_type_amount;
            var calc_val = parimad * per;
            el_total.value = calc_val;

            calc_grand_total();
        }

        function onRateChange(event) {
            var rate = event.value;
            let tr = event.closest('tr');

            let el_rate_type = tr.querySelector("#rate_type_amount");

            let rate_type_amount = parseInt(el_rate_type.value) || 1;

            let el_parimad = tr.querySelector("#parimad");
            let el_total = tr.querySelector("#total");

            var per = rate / rate_type_amount;
            var calc_val = el_parimad.value * per;
            el_total.value = calc_val;

            calc_grand_total();
        }

        function calc_grand_total() {
            let grand_total = 0;
            let children = mul_tbody.children;
            for (let index = 0; index < children.length; index++) {
                const element = children[index];
                let total = element.querySelector("#total");

                grand_total += +total.value;
            }
            let el_grand_total = document.querySelector("#grand_total");
            el_grand_total.value = grand_total;

            let el_received_money = document.querySelector("#received_money");
            const e = new Event("input");
            el_received_money.dispatchEvent(e);
        }

        function onReceivedMoneyChange(event) {
            let el_total = document.querySelector("#grand_total");
            let el_returned_money = document.querySelector("#returned_money");

            el_returned_money.value = (-(el_total.value - event.value)).toFixed(2) || 0;
        }
    </script>
@endsection
