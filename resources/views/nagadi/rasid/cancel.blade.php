<div class="modal fade cancel_nagadi_rasid_modal" tabindex="-1" role="dialog" aria-labelledby="largeModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="cancel_nagadi_rasid_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">
                        रसिद रद्द गर्नुहोस
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="cancel_nagadi_rasid_id" name="id" type="hidden" />
                    <table width="100%" class="table table-bordered table-sm">
                        <thead>
                            <tr>

                                <th>आर्थिक वर्ष</th>
                                <th> मिति </th>
                                <th>करदाताको नाम.</th>
                                <th>रशिद.</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="cancel_nagadi_rasid_fiscal_year"></td>
                                <td id="cancel_nagadi_rasid_date_nep"></td>
                                <td id="cancel_nagadi_rasid_customer_name"></td>
                                <td id="cancel_nagadi_rasid_bill_no"></td>
                            </tr>
                        </tbody>

                    </table>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">रद्द गर्नुको कारण:</span>
                            </div>
                            <textarea id="cancel_nagadi_rasid_reason" class="form-control" name="cancel_reason" type="text"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="cancel_nagadi_rasid_submit" class="btn btn-primary">
                        सेब गर्नुहोस
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


@section('cancel_nagadi_rasid_scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $('#cancel_nagadi_rasid_form').validate({
                rules: {
                    cancel_reason: {
                        required: true,
                    },
                },
                messages: {
                    cancel_reason: {
                        required: "रद्द गर्नुको कारण आवश्यक छ |",
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
                        id: $('#cancel_nagadi_rasid_id').val(),
                        cancel_reason: $('#cancel_nagadi_rasid_reason').val()
                    };

                    var submitbutton = document.getElementById("cancel_nagadi_rasid_submit");
                    submitbutton.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please Wait";
                    submitbutton.disabled = true;
                    axios.post("{{ route('nagadi-cancel_rasid') }}", data)
                        .then(function(response) {
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                            data.id = response.id;
                            const event = new CustomEvent('cancel_nagadi_rasids_added', {
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
