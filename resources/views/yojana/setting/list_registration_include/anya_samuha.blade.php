<div class="row">
    <div class="col-4">
        <div class="form-group mt-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text ">{{ __('समुहको नाम :') }}
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
    <div class="col-4">
        <div class="form-group mt-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text ">{{ __('सम्पर्क नं :') }}
                        <span class="text-danger px-1 font-weight-bold">*</span></span>
                </div>
                <input type="text" class="form-control form-control-sm "
                    value="{{ $list_registration_attribute == null ? '' : $list_registration_attribute->contact_no }}"
                    name="contact_no" required>
            </div>
        </div>
    </div>
    <div class="col-12 mt-4">
        <table id="table1" width="100%" class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">{{ __('पद') }}</th>
                    <th class="text-center">{{ __('नाम / थर') }}</th>
                    <th class="text-center" style="width:80px;">{{ __('वडा नं') }}</th>
                    <th class="text-center">{{ __('लिङ्ग') }}</th>
                    <th class="text-center">{{ __('नागरिकता नं') }}</th>
                    <th class="text-center">{{ __('जारी जिल्ला') }}</th>
                    <th class="text-center">{{ __('मोबाइल नं') }}</th>
                    <th class="text-center" style="width: 100px">
                        @if ($list_registration_attribute != null)
                            <a onclick="loadNextForm()" class="btn btn-primary btn-sm"><i
                                    class="fa-solid fa-plus"></i></a>
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody id="row_body">
                @if ($list_registration_attribute == null)
                    <tr>
                        <td class="text-center">
                            <select name="post_id[]" id="position_0" class="form-control form-control-sm position"
                                required>
                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                @foreach ($posts->settingValues as $post)
                                    <option value="{{ $post->id }}">{{ $post->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-center">
                            <input type="text" name="detail_name[]" class="form-control form-control-sm" required>
                        </td>
                        <td class="text-center">
                            <select name="detail_ward_no[]" class="form-control form-control-sm" required>
                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                @for ($i = 1; $i < 20; $i++)
                                    <option value="{{ $i }}">{{ Nepali($i) }}</option>
                                @endfor
                            </select>
                        </td>
                        <td class="text-center">
                            <select name="gender[]" class="form-control form-control-sm" required>
                                <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                @foreach (config('constant.GENDER') as $key => $gender)
                                    <option value="{{ $key }}">{{ $gender }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-center">
                            <input type="text" name="cit_no[]" class="form-control form-control-sm" required>
                        </td>
                        <td class="text-center">
                            <input type="text" name="issue_district[]" class="form-control form-control-sm" required>
                        </td>
                        <td class="text-center">
                            <input type="number" name="detail_contact_no[]" class="form-control form-control-sm"
                                required>
                        </td>
                        <td class="text-center">
                            <a onclick="loadNextForm()" class="btn btn-primary btn-sm"><i
                                    class="fa-solid fa-plus"></i></a>
                        </td>
                    </tr>
                @else
                    @foreach ($list_registration_attribute->listRegistrationAttributeDetails as $Mainkey => $detail)
                        <tr id="re_{{ $Mainkey + 1 }}">
                            <td class="text-center">
                                <select name="post_id[]" id="position_0" class="form-control form-control-sm position"
                                    required>
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    @foreach ($posts->settingValues as $post)
                                        <option value="{{ $post->id }}"
                                            {{ $detail->post_id == $post->id ? 'selected' : '' }}>
                                            {{ $post->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center">
                                <input type="text" name="detail_name[]" value="{{ $detail->name }}"
                                    class="form-control form-control-sm" required>
                            </td>
                            <td class="text-center">
                                <select name="detail_ward_no[]" class="form-control form-control-sm" required>
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    @for ($i = 1; $i < 20; $i++)
                                        <option value="{{ $i }}"
                                            {{ $detail->ward_no == $i ? 'selected' : '' }}>{{ Nepali($i) }}
                                        </option>
                                    @endfor
                                </select>
                            </td>
                            <td class="text-center">
                                <select name="gender[]" class="form-control form-control-sm" required>
                                    <option value="">{{ __('--छान्नुहोस्--') }}</option>
                                    @foreach (config('constant.GENDER') as $key => $gender)
                                        <option value="{{ $key }}"
                                            {{ $detail->gender == $key ? 'selected' : '' }}>{{ $gender }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center">
                                <input type="text" name="cit_no[]" class="form-control form-control-sm"
                                    value="{{ $detail->cit_no }}" required>
                            </td>
                            <td class="text-center">
                                <input type="text" name="issue_district[]" class="form-control form-control-sm"
                                    value="{{ $detail->issue_district }}" required>
                            </td>
                            <td class="text-center">
                                <input type="number" name="detail_contact_no[]" class="form-control form-control-sm"
                                    value="{{ $detail->contact_no }}" required>
                            </td>
                            <td class="text-center">
                                @if ($Mainkey == 0)
                                    <a onclick="removeMoreDetail({{ $Mainkey + 1 }})"
                                        class="btn btn-danger btn-sm mx-1"><i class="fa-solid fa-times"></i></a>
                                @else
                                    <a onclick="removeMoreDetail({{ $Mainkey + 1 }})"
                                        class="btn btn-danger btn-sm"><i class="fa-solid fa-times"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
