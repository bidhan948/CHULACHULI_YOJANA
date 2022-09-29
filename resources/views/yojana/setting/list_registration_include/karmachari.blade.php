<div class="row" id="form_company">
    <div class="col-4">
        <div class="form-group mt-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text ">{{ __('कर्मचारीका नाम :') }}
                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                </div>
                <input type="text" class="form-control form-control-sm " name="name"
                    value="{{ $list_registration_attribute == null ? '' : $list_registration_attribute->name }}"
                    required>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mt-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text ">{{ __('पद :') }}
                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                </div>
                <input type="text" class="form-control form-control-sm"
                    value="{{ $list_registration_attribute == null ? '' : $list_registration_attribute->post }}"
                    name="post" required>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mt-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text ">{{ __('कार्यरत शाखा :') }}
                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                </div>
                <input type="text" class="form-control form-control-sm"
                    value="{{ $list_registration_attribute == null ? '' : $list_registration_attribute->working_branch }}"
                    name="working_branch" required>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mt-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text ">{{ __('ठेगाना :') }}
                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                </div>
                <input type="text" class="form-control form-control-sm amount"
                    value="{{ $list_registration_attribute == null ? '' : $list_registration_attribute->address }}"
                    name="address" required>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mt-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text ">{{ __('सम्पर्क नं :') }}
                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                </div>
                <input type="text" class="form-control form-control-sm " name="contact_no"
                    value="{{ $list_registration_attribute == null ? '' : $list_registration_attribute->contact_no }}"
                    required>
            </div>
        </div>
    </div>
</div>
