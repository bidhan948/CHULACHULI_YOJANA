<div class="card">
    <div class="card-header">
        आफ्नो स्वामित्वमा रहेको निर्माण सम्बन्धी सवारी साधन मेशिनरी औजारको विवरण
    </div>
    <div class="card-body">
        <table class="table" id="add_new_fields">
            <thead>
                <tr>
                    <th>नाम तथा विवरण </th>
                    <th>दर्ता नम्वर</th>
                    <th>क्षमता संख्या</th>
                    <th>मुल्य</th>
                    <th>खरिद मिति</th>
                    <th>अन्य</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody id="asset_tbody">
                <tr>
                    <td><input type="text" id="device_name" name="device_name[]" class="form-control form-control-sm">
                    </td>
                    <td><input type="text" id="device_no" name="device_no[]" class="form-control form-control-sm"></td>
                    <td><input type="text" id="device_capacity" name="device_capacity[]"
                            class="form-control form-control-sm"></td>
                    <td><input type="text" id="device_amount" name="device_amount[]"
                            class="form-control form-control-sm"></td>
                    <td><input type="text" id="device_date" name="device_date[]" class="form-control form-control-sm">
                    </td>
                    <td><input type="text" id="other_detail" name="other_detail[]" class="form-control form-control-sm">
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary btn-xs" id="add_btn" onclick="addAsssetTr(this)"><i
                                    class="fa fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-xs" id="remove_btn"
                                onclick="removeTr(this)">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@section('assets_scripts')
    <script>
        let asset_tbody = document.querySelector("#asset_tbody");

        function addAsssetTr(event) {
            let tr = event.closest('tr');
            let clone = tr.cloneNode(true);
            event.style.display = 'none';
            clone.id = "";

            let el_device_name = clone.querySelector("#device_name");
            let el_device_no = clone.querySelector("#device_no");
            let el_device_capacity = clone.querySelector("#device_capacity");
            let el_device_amount = clone.querySelector("#device_amount");
            let el_device_date = clone.querySelector("#device_date");
            let el_other_detail = clone.querySelector("#other_detail");

            el_device_no.value = "";
            el_device_name.value = "";
            el_device_capacity.value = "";
            el_device_amount.value = "";
            el_device_date.value = "";
            el_other_detail.value = "";

            asset_tbody.appendChild(clone);
        }
    </script>
@endsection
