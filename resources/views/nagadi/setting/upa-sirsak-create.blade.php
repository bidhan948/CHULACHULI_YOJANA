<div class="modal fade upa_sirsak_modal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="upa_sirsak_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">
                      उप शिर्षक <span id="upa_sirsak_header"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="upa_sirsak_id" name="id" type="hidden" value="" />
                    <input id="main_sirsak_id_readonly" name="pid" type="hidden" value="" />

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">मुख्य शिर्षक:</span>
                            </div>
                            <input id="main_sirsak_name_readonly" readonly autocomplete="off" class="form-control"
                                placeholder="" type="text" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">उप शिर्षकको नाम:</span>
                            </div>
                            <input id="upa_sirsak_name" autocomplete="off" class="form-control" name="name"
                                placeholder="" type="text" >
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="toggleUpaSirsakModal()">
                        रद्द गर्नुहोस
                    </button>
                    <button type="submit" id="upa_sirsak_submit" class="btn btn-primary">
                        सेब गर्नुहोस
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


@section('upa_sirsak_scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $('#upa_sirsak_form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "उप शिर्षकको नाम आवश्यक छ |",
                    },
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
                        id: $('#upa_sirsak_id').val(),
                        pid: $('#main_sirsak_id_readonly').val(),
                        name: $('#upa_sirsak_name').val(),
                    };

                    var submitbutton = document.getElementById("upa_sirsak_submit");
                    submitbutton.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please Wait";
                    submitbutton.disabled = true;
                    axios.post("{{ route('nagadi-upa-sirsak.store') }}", data)
                        .then(function(response) {
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                            data.id = response.data.id;
                            const event = new CustomEvent('upa_sirsaks_added', {
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
