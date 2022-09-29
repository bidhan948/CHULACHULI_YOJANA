<div class="modal fade main_sirsak_modal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="main_sirsak_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">
                      मुख्य शिर्षक <span id="main_sirsak_header"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="main_sirsak_id" name="id" type="hidden" />

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">मुख्य शिर्षक नं:</span>
                            </div>
                            <input id="main_sirsak_number" autocomplete="off" class="form-control" name="topic_number"
                                placeholder="" type="number" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">मुख्य शिर्षकको नाम:</span>
                            </div>
                            <input id="main_sirsak_name" autocomplete="off" class="form-control" name="name"
                                placeholder="" type="text" >
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="toggleMainSirsakModal()">
                        रद्द गर्नुहोस
                    </button>
                    <button type="submit" id="main_sirsak_submit" class="btn btn-primary">
                        सेब गर्नुहोस
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


@section('main_sirsak_scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $('#main_sirsak_form').validate({
                rules: {
                    topic_number: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                },
                messages: {
                    topic_number: {
                        required: "शिर्षक नं आवश्यक छ |",
                    },
                    name: {
                        required: "शिर्षकको नाम आवश्यक छ |",
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
                        id: $('#main_sirsak_id').val(),
                        name: $('#main_sirsak_name').val(),
                        topic_number: $('#main_sirsak_number').val(),
                    };

                    var submitbutton = document.getElementById("main_sirsak_submit");
                    submitbutton.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please Wait";
                    submitbutton.disabled = true;
                    axios.post("{{ route('nagadi-main-sirsak.store') }}", data)
                        .then(function(response) {
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                            data.id = response.data.id;
                            const event = new CustomEvent('main_sirsaks_added', {
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
