@extends('layout.layout')
@section('sidebar')
    @include('layout.byabasaye_sidebar')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            इजाजतपत्र थप्नुहोस
        </div>
        <div class="card-body">
            @include(
                'byabasaye.permission-letter.create-components.company-description'
            )
            @include(
                'byabasaye.permission-letter.create-components.contact-description'
            )
            <div class="card">
                <div class="card-header">
                    फर्म वा कम्पनीको विवरण
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
                                    <div class="input-group-prepend"><span class="input-group-text">दर्ता मिति* </span>
                                    </div>
                                    <input type="text" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">अधिकृत पूँजि* </span>
                                    </div>
                                    <input type="text" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">जारि पूँजी* </span>
                                    </div>
                                    <input type="text" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    दर्ता गर्ने कार्यालयको नाम र ठेगाना
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">इजाजतपत्र लिन चाहेको
                                            वर्ग*</span></div>
                                    <select class="form-control">
                                        <option value="">छान्नुहोस्</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">समूहीकरण हुन चाहेको
                                            समुह*</span></div>
                                    <input type="text" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include(
                'byabasaye.permission-letter.create-components.aarthik-shrot'
            )
            @include(
                'byabasaye.permission-letter.create-components.assets-description'
            )
            @include(
                'byabasaye.permission-letter.create-components.prev-work'
            )

        </div>
    </div>
@endsection


@section('scripts')
    @yield('assets_scripts')
    @yield('prev_work_scripts')
    @include('shared.script.address')
    <script>
        function removeTr(event) {
            let tr = event.closest('tr');
            let td = event.closest('td');
            var children = td.children;
            var is_hidden = true;

            let el_add_btn = td.querySelector("#add_btn");
            let el_remove_btn = td.querySelector("#remove_btn");
            if (el_add_btn.style.display != 'none') {
                is_hidden = false;
            }
            if (!is_hidden) {
                let prevTr = tr.previousElementSibling;
                if (prevTr == null) {
                    return;
                }
                let el_prev_add_btn = prevTr.querySelector("#add_btn");
                el_prev_add_btn.style.display = 'inline';
                let cells = prevTr.cells;
            }
            tr.remove();
        }
    </script>
@endsection
