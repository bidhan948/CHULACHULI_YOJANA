<div class="modal fade budget_source_amount_modal" tabindex="-1" role="dialog" aria-labelledby="largeModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="budget_source_amount_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">
                        बजेट श्रोतमा रकम <span id="budget_source_amount_header"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="budget_source_amount_budget_source_id" name="budget_source_id" type="hidden" />

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">मिति:</span>
                            </div>
                            <input id="budget_source_amount_entry_date_nep" class="form-control" name="entry_date_nep"
                                placeholder="YYYY-MM-DD" type="text" value="">
                            <input id="budget_source_amount_entry_date_eng" name="entry_date_eng" value=""
                                type="hidden">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">बजेट श्रोत <span
                                        id="budget_source_amount_has_transfer"></span></span>
                            </div>
                            <input id="budget_source_amount_budget_source_name" readonly class="form-control"
                                placeholder="" type="text">
                        </div>
                    </div>
                    <div id="budget_source_amount_to_budget_source_group" class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">बजेट श्रोत सम्म:</span>
                            </div>
                            <select name="to_budget_source_id" id="budget_source_amount_to_budget_source"
                                class="form-control">
                                <option value="">छान्नुहोस्</option>
                                @foreach ($budget_sources as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">रकम:</span>
                            </div>
                            <input id="budget_source_amount_amount" autocomplete="off" class="form-control amount"
                                name="amount" placeholder="" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">कैफियत:</span>
                            </div>
                            <textarea id="budget_source_amount_remarks" class="form-control" name="remarks" placeholder="" type="text"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        रद्द गर्नुहोस
                    </button>
                    <button type="submit" id="budget_source_amount_submit" class="btn btn-primary">
                        सेब गर्नुहोस
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


@section('budget_source_amount_scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $('#budget_source_amount_entry_date_nep').nepaliDatePicker({
                container: ".budget_source_amount_modal",
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
                onChange: function(e) {
                    $('#budget_source_amount_entry_date_eng').val(e.ad);
                }
            });
            $('#budget_source_amount_form').validate({
                rules: {
                    amount: {
                        required: true,
                    },
                    entry_date_nep: {
                        required: true,
                    },
                    remarks: {
                        required: false,
                    },
                },
                messages: {
                    amount: {
                        required: "रकम आवश्यक छ |",
                    },
                    entry_date_nep: {
                        required: "मिति आवश्यक छ |",
                    },
                    remarks: {
                        required: "कैफियत आवश्यक छ |",
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
                        budget_source_id: $('#budget_source_amount_budget_source_id').val(),
                        entry_date_nep: $('#budget_source_amount_entry_date_nep').val(),
                        entry_date_eng: $('#budget_source_amount_entry_date_eng').val(),
                        budget_source_to: $('#budget_source_amount_to_budget_source').val(),
                        amount: $('#budget_source_amount_amount').val(),
                        remarks: $('#budget_source_amount_remarks').val(),
                    };

                    var submitbutton = document.getElementById("budget_source_amount_submit");
                    submitbutton.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please Wait";
                    submitbutton.disabled = true;
                    axios.post("{{ route('budget-source-amount.store') }}", data)
                        .then(function(response) {
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                            data.id = response.id;
                            const event = new CustomEvent('budget_source_amounts_added', {
                                detail: data
                            });
                            window.dispatchEvent(event);
                            alert('बजेट श्रोत हाल्न सफल भयो |');
                        })
                        .catch(function(error) {
                            custom_error(error);
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                        });
                }
            });
        });
    </script>
@endsection
