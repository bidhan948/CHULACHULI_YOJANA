<div class="card">
    <div class="card-header">
        दरखास्त पेश गर्ने फर्म वा कम्पनीको विवरण
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">दर्ता नं* </span></div>
                        <input type="text" class="form-control" value="">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">नाम* </span></div>
                        <input type="text" class="form-control" value="">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">सम्पर्क नम्वर* </span></div>
                        <input type="text" class="form-control" value="">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">ईमेल* </span></div>
                        <input type="text" class="form-control" value="">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">फर्म/कम्पनीको प्रकृति</span>
                        </div>
                        <select class="form-control">
                            <option value="">छान्नुहोस्</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">प्रदेश</span></div>
                        <select id="province" onchange="onProvinceChange(this)" class="form-control">
                            <option value="">छान्नुहोस्</option>
                            @foreach ($proviences as $item)
                                <option value="{{$item->id}}">{{$item->nep_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">जिल्ला</span></div>
                        <select id="district" onchange="onDistrictChange(this)" class="form-control">
                            <option value="">छान्नुहोस्</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">ग.पा / न. पा</span></div>
                        <select id="municipality" class="form-control">
                            <option value="">छान्नुहोस्</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">वडा</span></div>
                        <select class="form-control">
                            <option value="">छान्नुहोस्</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">टोल </span></div>
                        <input type="text" class="form-control" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
