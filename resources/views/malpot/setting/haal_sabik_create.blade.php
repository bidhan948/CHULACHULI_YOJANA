<div class="modal fade haal_sabik_modal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="haal_sabik_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">
                        <span id="haal_sabik_header"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="haal_sabik_id" name="id" type="hidden" />
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">साबिकको वडा:</span>
                            </div>
                            <select name="old_ward" id="setting_old_ward"
                                placeholder="छान्नुहोस्" class="form-control">
                                <option value="">छान्नुहोस्</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">साबिकको नाम:</span>
                            </div>
                            <input id="setting_old_vdc_mp" autocomplete="off" class="form-control" name="old_vdc_mp"
                                placeholder="" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">हालको वडा:</span>
                            </div>
                            <select name="new_ward" id="setting_new_ward"
                                placeholder="छान्नुहोस्" class="form-control">
                                <option value="">छान्नुहोस्</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">हालको नाम:</span>
                            </div>
                            <input id="setting_new_vdc_mp" autocomplete="off" class="form-control" name="new_vdc_mp"
                                placeholder="" type="text">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="toggleHaalSabikModal()">
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


@section('haal_sabik_scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $('#haal_sabik_form').validate({
                onsubmit: true,
                rules: {
                    old_ward: {
                        required: true,
                    },
                    old_vdc_mp: {
                        required: true,
                    },
                    new_ward: {
                        required: true,
                    },
                    new_vdc_mp: {
                        required: true,
                    },
                },
                messages: {
                    old_ward: {
                        required: "साबिकको वडा आवश्यक छ |",
                    },
                    old_vdc_mp: {
                        required: "साबिकको नाम आवश्यक छ |",
                    },
                    new_ward: {
                        required: "हालको वडा आवश्यक छ |",
                    },
                    new_vdc_mp: {
                        required: "हालको नाम आवश्यक छ |",
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
                        id: $('#haal_sabik_id').val(),
                        old_ward: $('#setting_old_ward').val(),
                        old_vdc_mp: $('#setting_old_vdc_mp').val(),
                        new_ward: $('#setting_new_ward').val(),
                        new_vdc_mp: $('#setting_new_vdc_mp').val()
                    };
                    console.log(data);

                    var submitbutton = document.getElementById("setting_submit");
                    submitbutton.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please Wait";
                    submitbutton.disabled = true;
                    axios.post("{{ route('haal_sabik_store') }}", data)
                        .then(function(response) {
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                            data.id = response.id;
                            const event = new CustomEvent(`haal_sabik_added`, {
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
