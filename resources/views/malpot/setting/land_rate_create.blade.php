<div class="modal fade land_rate_modal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="land_rate_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">
                        <span id="land_rate_header"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="land_rate_id" name="id" type="hidden" />
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">जग्गाको क्षेत्रगत किसिम:</span>
                            </div>
                            <select name="land_area_type_id" id="setting_land_area_type_id" placeholder="छान्नुहोस्"
                                class="form-control">
                                <option value="">छान्नुहोस्</option>
                                @foreach ($land_area_types as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">जग्गाको बर्गिकरण:</span>
                            </div>
                            <select name="land_category_type_id" id="setting_land_category_type_id" placeholder="छान्नुहोस्"
                                class="form-control">
                                <option value="">छान्नुहोस्</option>
                                @foreach ($land_category_types as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">जग्गाको श्रेणी:</span>
                            </div>
                            <select name="land_type_id" id="setting_land_type_id" placeholder="छान्नुहोस्"
                                class="form-control">
                                <option value="">छान्नुहोस्</option>
                                @foreach ($land_types as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">मालपोत दर रु.:</span>
                            </div>
                            <input id="setting_rate" class="form-control number" name="rate"
                                placeholder="" type="text">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="toggleLandRateModal()">
                        रद्द गर्नुहोस
                    </button>
                    <button type="submit" id="setting_submit" class="btn btn-primary">
                        सेब गर्नुहोस
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


@section('land_rate_scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $('#land_rate_form').validate({
                onsubmit: true,
                rules: {
                    land_area_type_id: {
                        required: true,
                    },
                    land_category_type_id: {
                        required: true,
                    },
                    rate: {
                        required: true,
                    },
                },
                messages: {
                    land_area_type_id: {
                        required: "जग्गाको क्षेत्रगत किसिम आवश्यक छ |",
                    },
                    land_category_type_id: {
                        required: "जग्गाको बर्गिकरण आवश्यक छ |",
                    },
                    rate: {
                        required: "मालपोत दर आवश्यक छ |",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function() {
                    const data = {
                        id: $('#land_rate_id').val(),
                        land_area_type_id: $('#setting_land_area_type_id').val(),
                        land_category_type_id: $('#setting_land_category_type_id').val(),
                        land_type_id: $('#setting_land_type_id').val(),
                        rate: $('#setting_rate').val()
                    };
                    var submitbutton = document.getElementById("setting_submit");
                    submitbutton.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please Wait";
                    submitbutton.disabled = true;
                    axios.post("{{ route('land_rate_store') }}", data)
                        .then(function(response) {
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                            data.id = response.id;
                            const event = new CustomEvent(`land_rate_added`, {
                                detail: data
                            });
                            window.dispatchEvent(event);
                        })
                        .catch(function(error) {
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                            console.log(error);
                            alert(error);
                        });
                }
            });
        });
    </script>
@endsection
