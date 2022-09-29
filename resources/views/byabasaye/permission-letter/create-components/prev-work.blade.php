<div class="card">
    <div class="card-header">
        यस अघि सम्पन्न गरेको कामको विवरण
    </div>
    <div class="card-body">
        <table class="table table-sm">
            <thead>
              <tr>
                <th>निर्माण सम्वन्धि कामको अनुभव</th>
                <th>काम गरेको साल</th>
                <th>रकम</th>
                <th>ठेक्कादाता कार्यालयको नाम</th>
                <th>कामको अवस्था </th>
                <th>#</th>
              </tr>
            </thead>
            <tbody id="prev_work_tbody">
              <tr>
                <td><input type="text" id="pre_work" name="pre_work[]" class="form-control form-control-sm"></td>
                <td><input type="text" id="per_work_year" name="per_work_year[]" class="form-control form-control-sm"></td>
                <td><input type="text" id="work_amount" name="work_amount[]" class="form-control form-control-sm"></td>
                <td><input type="text" id="work_office" name="work_office[]" class="form-control form-control-sm"></td>
                <td><input type="text" id="work_status" name="work_status[]" class="form-control form-control-sm"></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary btn-xs" id="add_btn" onclick="addPrevWorkTr(this)"><i
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

@section('prev_work_scripts')
    <script>
        let prev_work_tbody = document.querySelector("#prev_work_tbody");

        function addPrevWorkTr(event) {
            let tr = event.closest('tr');
            let clone = tr.cloneNode(true);
            event.style.display = 'none';
            clone.id = "";

            let el_pre_work = clone.querySelector("#pre_work");
            let el_per_work_year = clone.querySelector("#per_work_year");
            let el_work_amount = clone.querySelector("#work_amount");
            let el_work_office = clone.querySelector("#work_office");
            let el_work_status = clone.querySelector("#work_status");

            el_per_work_year.value = "";
            el_pre_work.value = "";
            el_work_amount.value = "";
            el_work_office.value = "";
            el_work_status.value = "";

            prev_work_tbody.appendChild(clone);
        }
    </script>
@endsection
