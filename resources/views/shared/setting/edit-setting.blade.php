<div class="modal fade" id="edit_setting{{ $setting->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('सेटिङ्ग सच्याउनुहोस') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('setting.edit_setting', $setting) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ __('सेटिङ्गको नाम') }}<span id="name_group_edit"
                                        class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input id="name_edit" name="name" class="form-control" value="{{ $setting->name }}"
                                type="text">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ __('Is Child') }}
                                    <span id="has_child_group"></span></span>
                            </div>
                            <select id="has_child_edit" name="has_child" class="form-control">
                                <option value="0" {{ $setting->has_child ? '' : 'selected' }}>
                                    {{ __('--छैन--') }}</option>
                                <option value="1" {{ $setting->has_child ? 'selected' : '' }}>
                                    {{ __('--छ--') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ __('सेटिङ्ग अन्तर्गत') }}
                                    <span id="cascading_parent_id_edit"></span></span>
                            </div>
                            <select id="cascading_parent_id_edit" name="cascading_parent_id" class="form-control">
                                <option value="">{{ __('--छान्नुहोस्--') }}
                                </option>
                                @foreach ($settingParents as $parent)
                                    <option value="{{ $parent->id }}" {{ $parent->id == $setting->cascading_parent_id ? 'selected' : '' }}>
                                        {{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ __('Setting KEY') }}<span id="slug_group_edit"
                                        class="text-danger font-weight-bold px-1">*</span></span>
                            </div>
                            <input id="slug_edit" name="slug" class="form-control" type="text"
                                value="{{ $setting->slug }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-dismiss="modal">{{ __('रद्द गर्नुहोस्') }}</button>
                    <button type="submit"
                        class="btn btn-primary">{{ __('सेभ गर्नुहोस् ') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
