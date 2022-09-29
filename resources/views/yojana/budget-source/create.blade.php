<div class="modal fade budget_source_modal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="budget_source_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">
                       बजेट श्रोत <span id="budget_source_header"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="budget_source_id" name="id" type="hidden" />

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">बजेट श्रोत:</span>
                            </div>
                            <input id="budget_source_name" autocomplete="off" class="form-control" name="name"
                                placeholder="" type="text" >
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        रद्द गर्नुहोस
                    </button>
                    <button type="submit" id="budget_source_submit" class="btn btn-primary">
                        सेब गर्नुहोस
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


@section('budget_source_scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $('#budget_source_form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "बजेट श्रोत आवश्यक छ |",
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
                        id: $('#budget_source_id').val(),
                        name: $('#budget_source_name').val()
                    };

                    var submitbutton = document.getElementById("budget_source_submit");
                    submitbutton.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please Wait";
                    submitbutton.disabled = true;
                    axios.post("{{ route('budget-sources.store') }}", data)
                        .then(function(response) {
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                            data.id = response.id;
                            const event = new CustomEvent('budget_sources_added', {
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
