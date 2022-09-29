<div class="card">
    <div class="card-header">
        <span class="landowner_name_label">
            जग्गाधनिको
        </span>&nbsp; स्थाई ठेगाना
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">प्रदेश*: </span></div>
                    <select id="permanent_province" name="permanent_province" class="form-control" required="">
                        <option value="">छान्नुहोस्</option>
                        @foreach ($provinces as $p)
                            <option value="{{ $p->id }}">{{ $p->nep_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">जिल्ला*: </span></div>
                    <select id="permanent_district" name="permanent_district" class="form-control" required="">
                        <option value="">छान्नुहोस्</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">गा.पा/न.पा*: </span>
                    </div>
                    <select id="permanent_municipality" name="permanent_municipality" class="form-control" required="">
                        <option value="">छान्नुहोस्</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">वडा नं **: </span></div>
                    <select id="permanent_ward" name="permanent_ward" class="form-control" required="">
                        <option value="">छान्नुहोस्</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">टोल/ठाउँ: </span></div>
                    <input type="text" id="permanent_tole" name="permanent_tole" class="form-control">
                </div>
            </div>
        </div>

    </div>
</div>
<div id="temprorary_address_div" class="card">
    <div class="card-header">
        <span class="landowner_name_label">
            जग्गाधनिको
        </span>&nbsp;अस्थाई ठेगाना
        <div class="">
            <input type="checkbox" name="" id="temp_addr_checkbox">&nbsp;&nbsp;<b>स्थाई ठेगाना जस्तै</b>
        </div>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">प्रदेश*: </span></div>
                    <select id="temprorary_province" name="temprorary_province" class="form-control">
                        <option value="">छान्नुहोस्</option>
                        @foreach ($provinces as $p)
                            <option value="{{ $p->id }}">{{ $p->nep_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">जिल्ला*: </span></div>
                    <select id="temprorary_district" name="temprorary_district" class="form-control">
                        <option value="">छान्नुहोस्</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">गा.पा/न.पा*: </span>
                    </div>
                    <select id="temprorary_municipality" name="temprorary_municipality" class="form-control">
                        <option value="">छान्नुहोस्</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">वडा नं **: </span></div>
                    <select id="temprorary_ward" name="temprorary_ward" class="form-control">
                        <option value="">छान्नुहोस्</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">टोल/ठाउँ: </span></div>
                    <input type="text" id="temprorary_tole" name="temprorary_tole" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>


@section('land_owner_address_scripts')
    @include('shared.script.address', [
        'district' => 'permanent_district',
        'province' => 'permanent_province',
        'municipality' => 'permanent_municipality',
        'ward' => 'permanent_ward',
    ])
    @include('shared.script.address', [
        'district' => 'temprorary_district',
        'province' => 'temprorary_province',
        'municipality' => 'temprorary_municipality',
        'ward' => 'temprorary_ward',
    ])
    <script>
        var temp_province = '';
        $(document).ready(function() {
            $('#temp_addr_checkbox').change(function(event) {
                if (event.target.checked) {
                    $('#temprorary_province').val($('#permanent_province').val());

                    var $options = $("#permanent_district > option").clone();
                    $('#temprorary_district').empty();
                    $('#temprorary_district').append($options);
                    $('#temprorary_district').val($('#permanent_district').val());

                    $options = $("#permanent_municipality > option").clone();
                    $('#temprorary_municipality').empty();
                    $('#temprorary_municipality').append($options);
                    $('#temprorary_municipality').val($('#permanent_municipality').val());

                    $options = $("#permanent_ward > option").clone();
                    $('#temprorary_ward').empty();
                    $('#temprorary_ward').append($options);
                    $('#temprorary_ward').val($('#permanent_ward').val());
                    $('#temprorary_tole').val($('#permanent_tole').val());
                } else {
                    $('#temprorary_province').val('');
                    $('#temprorary_district').val('');
                    $('#temprorary_municipality').val('');
                    $('#temprorary_ward').val('');
                    $('#temprorary_tole').val('');
                    var html = '<option value="">छान्नुहोस्</option>';
                    $('#temprorary_district').html(html);
                    $('#temprorary_municipality').html(html);
                    $('#temprorary_ward').html(html);
                }
            });
            $('#temprorary_province').change(function(event) {
                $('#temp_addr_checkbox').prop('checked', false);
            });
            $('#temprorary_district').change(function(event) {
                 $('#temp_addr_checkbox').prop('checked', false);
            });
            $('#temprorary_municipality').change(function(event) {
                 $('#temp_addr_checkbox').prop('checked', false);
            });
            $('#temprorary_ward').change(function(event) {
                 $('#temp_addr_checkbox').prop('checked', false);
            });
            $('#temprorary_tole').keyup(function(event) {
                 $('#temp_addr_checkbox').prop('checked', false);
            });
        });
    </script>
@endsection
