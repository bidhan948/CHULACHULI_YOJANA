<div class="card">
    <div class="card-header">
        जग्गाधनीको बिभरण
        <div class="text-center">
            <b> व्यक्तिगत</b>&nbsp;
            <input type="radio" id="single" name="land_ownership_type" checked value="single">&nbsp;&nbsp;
            <b> संस्थागत</b>&nbsp;
            <input type="radio" id="organization" name="land_ownership_type" value="organization">
        </div>


    </div>
    <div class="card-body">

        <div class="row">
            <div id="land_type_div" class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">जग्गाको स्वामित्वको
                            किसिम*: </span></div>
                    <select id="land_type_select" name="single_ownership_type" class="form-control" required="">
                        <option value="">छान्नुहोस्</option>
                        <option value="1">एकल </option>
                        <option value="2">संयुक्त </option>
                    </select>
                </div>
            </div>
            <div id="organization_type_div" style="display: none;" class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">संस्थाको प्रकार*: </span>
                    </div>
                    <select name="organization_type" id="organization_type" class="form-control">
                        <option value="">छान्नुहोस्</option>
                        @foreach (get_setting(config('SLUG.setup_organization_types')) as $nationality)
                            <option value="{{ $nationality->id }}">{{ $nationality->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="pan_number_div" style="display: none;" class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">इस्थाई लेखा नम्बर *: </span>
                    </div>
                    <input type="text" name="pan_number" id="pan_number"  class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <tbody id="mul_tbody">
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend"><span class="input-group-text"> <span
                                                        class="landowner_name_label">
                                                        जग्गाधनिको
                                                    </span>&nbsp;पुरा नाम*:
                                                </span></div>
                                            <input type="text" name="name[]" id="landowner_name" required=""
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend"><span class="input-group-text"> <span
                                                        class="landowner_name_label">
                                                        जग्गाधनिको
                                                    </span> &nbsp;पुरा नाम
                                                    (अंग्रेजी): </span></div>
                                            <input type="text" pattern="[A-Za-z0-9].{1,}" name="name_english[]" id="landowner_name_english"
                                                required="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div id="gender_div" class="col-md-4">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text">लिंग *: </span>
                                        </div>
                                        <select name="gender[]" id="landowner_gender" class="form-control"
                                            required="">
                                            <option value="">छान्नुहोस् </option>
                                            @foreach (config('constant.GENDER') as $key => $gender)
                                                <option value="{{ $key }}">{{ $gender }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div id="landowner_father_name_div" class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend"><span class="input-group-text">बाबु/पतिको
                                                    नाम र थर *:
                                                </span></div>
                                            <input type="text" name="father_name[]" id="landowner_father_name"
                                                required="" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div id="landowner_grandfather_name_div" class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend"><span class="input-group-text">
                                                    बाजे/ससुराको नाम र थर*:
                                                </span></div>
                                            <input type="text" name="grandfather_name[]"
                                                id="landowner_grandfather_name" required="" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div id="nationality_div" class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend"><span class="input-group-text">
                                                    राष्ट्रियता:
                                                </span></div>
                                            <select name="nationality_id[]" id="nationality_id"
                                                class="form-control" required="">
                                                <option value="">छान्नुहोस् </option>
                                                @foreach (get_setting(config('SLUG.setup_nationality')) as $nationality)
                                                    <option value="{{ $nationality->id }}">{{ $nationality->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="land_owner_job_div" class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend"><span class="input-group-text"> पेशा:
                                                </span></div>
                                            <select name="job_id[]" id="land_owner_job_id" class="form-control"
                                                required="">
                                                <option value="">छान्नुहोस् </option>
                                                @foreach (get_setting(config('SLUG.setup_occupations')) as $nationality)
                                                    <option value="{{ $nationality->id }}">{{ $nationality->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend"><span class="input-group-text"> इमेल
                                                    ठेगाना:</span>
                                            </div>
                                            <input type="email" name="email[]" id="landowner_email"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend"><span class="input-group-text">सम्पर्क
                                                    नं:</span>
                                            </div>
                                            <input type="text" name="contact[]" id="landowner_contact"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="button_tr" style="display: none;">
                            <div class="row"> <button type="button" class="btn btn-primary btn-sm"
                                    id="add_btn" onclick="addTr(this)"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="row"><button type="button" class="btn btn-warning btn-sm"
                                    id="remove_btn" onclick="removeTr(this)"> <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">

            <div id="contact_name_div" style="display: none;" class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">सम्पर्क व्यक्तिको नाम *: </span>
                    </div>
                    <input type="text" name="contact_name" id="contact_name" class="form-control">
                </div>
            </div>
            <div id="contact_name_english_div" style="display: none;" class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">सम्पर्क व्यक्तिको नाम (अंग्रेजी):
                        </span></div>
                    <input type="text" name="contact_name_english" id="contact_name_english" class="form-control">
                </div>
            </div>
            <div id="contact_name_contact_div" style="display: none;" class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">सम्पर्क व्यक्तिको सम्पर्क नं *:
                        </span></div>
                    <input type="text" name="contact_number" id="contact_number"  class="form-control">
                </div>
            </div>
            <div id="contact_name_email_div" style="display: none;" class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">सम्पर्क व्यक्तिको इमेल: </span>
                    </div>
                    <input type="text" name="contact_email" id="contact_email" class="form-control">
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text">जग्गा रहेको वडा नं *: </span>
                    </div>
                    <select name="land_ward_no" class="form-control" required="">
                        <option value="">छान्नुहोस्</option>
                        @for ($i = 1; $i <= config('constant.TOTAL_WARDS'); $i++)
                            <option value="{{ $i }}">{{ Nepali($i) }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div id="house_number_div" class="form-group col-md-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text"> घर नम्बर:
                        </span></div>
                    <input type="text" name="house_number" id="owner_name" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"><span class="input-group-text"> अन्य विवरण/कैफियत :
                        </span></div>
                    <textarea class="form-control" name="other_details" cols="0" rows="2"></textarea>
                </div>
            </div>

        </div>

    </div>
</div>
@section('land_owner_detail_scripts')
    <script>
        $(document).ready(function() {
            $('#land_type_select').change(function(event) {
                manageTable(event.target.value);
            });

            $('input:radio[name=land_ownership_type]').change(function() {
                var land_type_div = document.body.querySelector("#land_type_div");
                var landowner_name_label = document.body.querySelectorAll(".landowner_name_label");
                var house_number_div = document.body.querySelector("#house_number_div");
                var landowner_father_name_div = document.body.querySelector("#landowner_father_name_div");
                var landowner_grandfather_name_div = document.body.querySelector(
                    "#landowner_grandfather_name_div");
                var land_owner_job_div = document.body.querySelector("#land_owner_job_div");
                var gender_div = document.body.querySelector("#gender_div");
                var contact_name_div = document.body.querySelector("#contact_name_div");
                var contact_name_english_div = document.body.querySelector("#contact_name_english_div");
                var contact_name_contact_div = document.body.querySelector("#contact_name_contact_div");
                var contact_name_email_div = document.body.querySelector("#contact_name_email_div");
                var pan_number_div = document.body.querySelector("#pan_number_div");
                var organization_type_div = document.body.querySelector("#organization_type_div");
                var temprorary_address_div = document.body.querySelector("#temprorary_address_div");
                var nationality_div = document.body.querySelector("#nationality_div");
                var button_tr = document.body.querySelectorAll(".button_tr");


                if ($("input:radio[name='land_ownership_type']:checked").val() == 'single') {
                    transition_from = "organization";
                    manageTable($('#land_type_select').val());
                    for (let index = 0; index < landowner_name_label.length; index++) {
                        const element = landowner_name_label[index];
                        element.innerHTML = 'जग्गाधनिको '
                    }
                    house_number_div.style = 'display: block;';
                    land_type_div.style = 'display: block;'
                    landowner_father_name_div.style = 'display: block;';
                    landowner_grandfather_name_div.style = 'display: block;';
                    land_owner_job_div.style = 'display: block;';
                    gender_div.style = 'display: block;';

                    temprorary_address_div.style = 'display: block;';
                    nationality_div.style = 'display: block;';

                    contact_name_div.style = 'display: none;';
                    contact_name_english_div.style = 'display: none;';
                    contact_name_contact_div.style = 'display: none;';
                    contact_name_email_div.style = 'display: none;';
                    pan_number_div.style = 'display: none;';
                    organization_type_div.style = 'display: none;';

                     //form required change
                    $("#organization_type").removeAttr('required');
                    $("#pan_number").removeAttr('required');
                    $("#contact_name").removeAttr('required');
                    $("#contact_name_english").removeAttr('required');
                    $("#contact_number").removeAttr('required');

                    $("#land_type_select").attr('required', '');
                    $("#landowner_gender").attr('required', '');
                    $("#landowner_father_name").attr('required', '');
                    $("#landowner_grandfather_name").attr('required', '');
                    $("#nationality_id").attr('required', '');
                    $("#land_owner_job_id").attr('required', '');

                }
                if ($("input:radio[name='land_ownership_type']:checked").val() == 'organization') {
                    transition_from = "single";
                    manageTable("");
                    for (let index = 0; index < landowner_name_label.length; index++) {
                        const element = landowner_name_label[index];
                        element.innerHTML = 'संस्थाको '
                    }
                    house_number_div.style = 'display: none;';
                    land_type_div.style = 'display: none;'
                    landowner_father_name_div.style = 'display: none;';
                    landowner_grandfather_name_div.style = 'display: none;';
                    land_owner_job_div.style = 'display: none;';
                    gender_div.style = 'display: none;';

                    temprorary_address_div.style = 'display: none;';
                    nationality_div.style = 'display: none;';
                    button_tr.style = 'display: none;';

                    contact_name_div.style = 'display: block;';
                    contact_name_english_div.style = 'display: block;';
                    contact_name_contact_div.style = 'display: block;';
                    contact_name_email_div.style = 'display: block;';
                    pan_number_div.style = 'display: block;';
                    organization_type_div.style = 'display: block;';


                     //form required change
                     $("#organization_type").attr('required', '');
                    $("#pan_number").attr('required', '');
                    $("#contact_name").attr('required', '');
                    $("#contact_name_english").attr('required', '');
                    $("#contact_number").attr('required', '');

                    $("#land_type_select").removeAttr('required');
                    $("#landowner_gender").removeAttr('required');
                    $("#landowner_father_name").removeAttr('required');
                    $("#landowner_grandfather_name").removeAttr('required');
                    $("#nationality_id").removeAttr('required');
                    $("#land_owner_job_id").removeAttr('required');
                }
            });
        });

        let mul_tbody = document.querySelector("#mul_tbody");

        function manageTable(target_value) {
            var button_tr = document.querySelectorAll('.button_tr');
            if (target_value == 2) {
                for (let index = 0; index < button_tr.length; index++) {
                    const element = button_tr[index];
                    element.style = 'display: block;'
                }
            } else {
                for (let index = mul_tbody.children.length - 1; index >= 0; index--) {
                    const element = mul_tbody.children[index];
                    const removeBtn = element.querySelector("#remove_btn");
                    const e = new Event("click");
                    removeBtn.dispatchEvent(e);
                }
                for (let index = 0; index < button_tr.length; index++) {
                    const element = button_tr[index];
                    element.style = 'display: none;'
                }
            }

        }

        function addTr(event) {
            let tr = event.closest('tr');
            let clone = tr.cloneNode(true);
            event.style.display = 'none';
            initializeInputInTable(clone);
            mul_tbody.appendChild(clone);
        }

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

        function initializeInputInTable(node) {
            let el_landowner_name = node.querySelector("#landowner_name");
            let el_landowner_name_english = node.querySelector("#landowner_name_english");
            let el_landowner_gender = node.querySelector("#landowner_gender");
            let el_landowner_father_name = node.querySelector("#landowner_father_name");
            let el_landowner_grandfather_name = node.querySelector("#landowner_grandfather_name");
            let el_nationality_id = node.querySelector("#nationality_id");
            let el_land_owner_job_id = node.querySelector("#land_owner_job_id");
            let el_landowner_email = node.querySelector("#landowner_email");
            let el_landowner_contact = node.querySelector("#landowner_contact");

            el_landowner_name.value = "";
            el_landowner_name_english.value = "";
            el_landowner_gender.value = "";
            el_landowner_father_name.value = "";
            el_landowner_grandfather_name.value = "";
            el_nationality_id.value = "";
            el_land_owner_job_id.value = "";
            el_landowner_email.value = "";
            el_landowner_contact.value = "";
        }
    </script>
@endsection
