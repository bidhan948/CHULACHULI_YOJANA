<div class="modal fade setting_modal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="setting_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">
                        <span id="setting_header"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="setting_id" name="id" type="hidden" />
                    <input id="setting_setting_id" name="setting_id" value="{{ $setting->id }}" type="hidden" />

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">नाम:</span>
                            </div>
                            <input id="setting_name" autocomplete="off" class="form-control" name="name"
                                placeholder="" type="text">
                        </div>
                    </div>
                    @if (!empty($setting->cascading_parent_id))
                        @php
                            $p_settings = \App\Models\SharedModel\SettingValue::where(['setting_id' => $setting->cascading_parent_id])->get();
                            
                            $p_set = \App\Models\SharedModel\Setting::where(['id' => $setting->cascading_parent_id])->first();
                            
                        @endphp
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ $p_set->name }}:</span>
                                </div>
                                <select name="cascading_parent_id" id="setting_cascading_parent_id"
                                    placeholder="छान्नुहोस्" class="form-control">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($p_settings as $p_setting)
                                        <option value="{{ $p_setting->id }}">{{ $p_setting->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">वर्णन:</span>
                            </div>
                            <textarea id="setting_note" autocomplete="off" class="form-control" name="note" placeholder=""
                                type="text" /></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="toggleBudgetSourceModal()">
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


@section('setting_scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $('#setting_form').validate({
                onsubmit: true,
                rules: {
                    name: {
                        required: true,
                    },
                    @if (!empty($setting->cascading_parent_id))
                        cascading_parent_id: {
                        required: true,
                        },
                    @endif
                },
                messages: {
                    name: {
                        required: "नाम आवश्यक छ |",
                    },
                    @if (!empty($setting->cascading_parent_id))
                        cascading_parent_id: {
                        required: "{{ $p_set->name }} आवश्यक छ |",
                        },
                    @endif
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
                        id: $('#setting_id').val(),
                        setting_id: $('#setting_setting_id').val(),
                        cascading_parent_id: ($('#setting_cascading_parent_id').val() || null),
                        name: $('#setting_name').val(),
                        note: $('#setting_note').val()
                    };
                    console.log(data);

                    var submitbutton = document.getElementById("setting_submit");
                    submitbutton.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please Wait";
                    submitbutton.disabled = true;
                    axios.post("{{ route('setting.store') }}", data)
                        .then(function(response) {
                            submitbutton.innerHTML = 'Submit';
                            submitbutton.disabled = false;
                            data.id = response.id;
                            const event = new CustomEvent(`{{ $setting->slug }}_added`, {
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
