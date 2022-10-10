<div class="row" id="form_company">
    <div class="col-4">
        <div class="form-group mt-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text ">{{ __('निर्माण व्यवसाय नाम :') }}
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
                    <span class="input-group-text ">{{ __('ठेगाना :') }}
                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                </div>
                <input type="text" class="form-control form-control-sm " name="address"
                    value="{{ $list_registration_attribute == null ? '' : $list_registration_attribute->address }}"
                    required>
            </div>
        </div>
    </div>
    <div class="  col-4">
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
    <div class="col-4">
        <div class="form-group mt-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text ">{{ __('सम्पर्क ब्यक्तिको नाम :') }}
                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                </div>
                <input type="text" class="form-control form-control-sm " name="second_person_name"
                    value="{{ $list_registration_attribute == null ? '' : $list_registration_attribute->second_person_name }}"
                    required>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mt-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text ">{{ __('कैफियत :') }}</span>
                </div>
                <textarea name="remark" class="form-control form-control-sm">
                    {{ $list_registration_attribute == null ? '' : $list_registration_attribute->remark }}
                </textarea>
            </div>
        </div>
    </div>
</div>