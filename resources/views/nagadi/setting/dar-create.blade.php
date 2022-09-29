@extends('layout.layout')
@section('sidebar')
    @include('layout.nagadi_sidebar')
@endsection

@section('content')
    @include('nagadi.setting.main-sirsak-create')
    @include('nagadi.setting.upa-sirsak-create')
    <form method="post" action="{{route('nagadi-dar.store')}}">
        @csrf
        <div class="card">
            <div class="card-header">
                दर थप्नुहोस
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="add_new_fields">
                    <thead>
                        <tr>
                            <th>मुख्य शिर्षक</th>
                            <th>उप शिर्षक</th>
                            <th>शिर्षकको नाम</th>
                            <th>दर</th>
                            <th>यदि प्रतिशतमा भएमा मात्रै</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody id="mul_tbody">
                        <tr>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" data-toggle="modal" onclick="onMainSirsakAdd(this)"
                                            class="input-group-text btn btn-warning" title="मुख्य शिर्षक किसिम थप्नुहोस्"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                    <select class="form-control" name="main_sirsak[]" onchange="onMainSirsakChange(this)"
                                        id="main_sirsak" required="required">
                                        <option value="">छान्नुहोस्</option>
                                        @foreach ($main_sirshak as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" data-toggle="modal" onclick="onUpaSirsakAdd(this)"
                                            id="upa_sirsak_button" class="input-group-text btn btn-warning"
                                            title="उप शिर्षक किसिम थप्नुहोस्">
                                            <i class="fa fa-plus"></i></button>
                                    </div>
                                    <select class="form-control" name="upa_sirsak[]" id="upa_sirsak" required="required">
                                        <option value="">छान्नुहोस्</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="sirsak" placeholder="" name="sirsak[]"  value="">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="rate" placeholder="" name="rate[]"
                                        required="required" value="">

                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <select class="form-control" name="rate_type[]" id="rate_type" >
                                        <option value="">छान्नुहोस्</option>
                                        <option value="100">प्रतिसत</option>
                                        <option value="1000">प्रति हजार</option>
                                        <option value="100000">प्रति लाख</option>
                                        <option value="10000000">प्रति करोड</option>
                                    </select>
                                </div>
                            </td>

                            <td class="action_button">
                                <button type="button" class="btn btn-primary btn-sm " id="add_btn" onclick="addTr(this)"><i
                                        class="fa fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-warning btn-sm remove-btn" id="remove_btn" onclick="removeTr(this)"> <i
                                        class="fa fa-times"></i>
                                </button>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    सेब गर्नुहोस
                </button>
            </div>
        </div>
    </form>
@endsection


@section('scripts')
    @yield('main_sirsak_scripts')
    @yield('upa_sirsak_scripts')
    <script>
        // mainInput.nepaliDatePicker({});
        let mul_tbody = document.querySelector("#mul_tbody");

        let currentTr = '';

        window.addEventListener("main_sirsaks_added", function(evt) {
            let main_sirsak = currentTr.querySelector("#main_sirsak");
            let selected = 'selected';
            let html = '<option value="' + event.detail.id + '" ' + selected + '>' + event.detail.name +
            '</option>';
            main_sirsak.innerHTML += html;
            toggleMainSirsakModal();
        }, false);

        window.addEventListener("upa_sirsaks_added", function(evt) {
            let upa_sirsak = currentTr.querySelector("#upa_sirsak");
            let selected = 'selected';
            let html = '<option value="' + event.detail.id + '" ' + selected + '>' + event.detail.name +
            '</option>';
            upa_sirsak.innerHTML += html;
            toggleUpaSirsakModal();
        }, false);

        function onMainSirsakChange(event) {
            let id = event.value;
            let tr = event.closest('tr');
            let upa_sirsak_button = tr.querySelector("#upa_sirsak_button");
            let upa_sirsak = tr.querySelector("#upa_sirsak");
            if (id != '') {
                upa_sirsak_button.innerHTML = "<i class='fa fa-spinner fa-spin'></i>";
                axios.get("{{ route('nagadi-get-categories') }}", {
                        params: {
                            pid: id
                        }
                    }).then(function(response) {
                        var html = '<option value="">छान्नुहोस्</option>';
                        var selected = '';
                        var rows = response.data;
                        console.log(response);
                        $.each(rows, function(key, value) {
                            html += '<option value="' + value.id + '" ' + selected + '>' + value.name +
                                '</option>';
                        });
                        upa_sirsak.innerHTML = html;
                        upa_sirsak_button.innerHTML = '<i class="fa fa-plus"></i>';
                    })
                    .catch(function(error) {
                        console.log(error);
                        upa_sirsak_button.innerHTML = '<i class="fa fa-plus"></i>';
                    });
            } else {
                var html = '<option value="">छान्नुहोस्</option>';
                upa_sirsak.innerHTML = html;
            }
        }

        const toggleMainSirsakModal = () => {
            $('.main_sirsak_modal').modal('toggle');
        }
        const toggleUpaSirsakModal = () => {
            $('.upa_sirsak_modal').modal('toggle');
        }

        function onMainSirsakAdd(event) {
            currentTr = event.closest('tr');
            $('#main_sirsak_id').val('');
            $('#main_sirsak_name').val('');
            $('#main_sirsak_number').val('');
            $('#main_sirsak_header').html('थप्नुहोस');
            toggleMainSirsakModal();
        }

        function onUpaSirsakAdd(event) {
            currentTr = event.closest('tr');
            let main_sirsak = currentTr.querySelector("#main_sirsak");
            if (main_sirsak.value == '') {
                alert('कृपया पहिला मुख्य शिर्षक छान्नुहोस्');
                return;
            }
            $('#main_sirsak_id_readonly').val(main_sirsak.value);
            $('#main_sirsak_name_readonly').val(main_sirsak.options[main_sirsak.selectedIndex].text);
            $('#upa_sirsak_name').val('');
            $('#upa_sirsak_id').val('');
            $('#upa_sirsak_header').html('थप्नुहोस');
            toggleUpaSirsakModal();
        }

        function addTr(event) {
            let tr = event.closest('tr');
            let clone = tr.cloneNode(true);
            event.style.display = 'none';
            clone.id = "";

            let upa_sirsak = clone.querySelector("#upa_sirsak");
            let main_sirsak = clone.querySelector("#main_sirsak");
            let sirsak = clone.querySelector("#sirsak");
            let rate = clone.querySelector("#rate");
            let rate_type = clone.querySelector("#rate_type");

            rate.value = "";
            sirsak.value = "";
            upa_sirsak.value = "";
            main_sirsak.value = "";
            rate_type.value = "";

            upa_sirsak.innerHTML = '<option value="">छान्नुहोस्</option>';

            mul_tbody.appendChild(clone);
        }


        function removeTr(event) {
            let tr = event.closest('tr');
            let td = event.closest('td');
            var children = td.children;
            var is_hidden = true;

            let add_btn = td.querySelector("#add_btn");
            let remove_btn = td.querySelector("#remove_btn");
            if (add_btn.style.display != 'none') {
                is_hidden = false;
            }
            if (!is_hidden) {
                let prevTr = tr.previousElementSibling;
                if (prevTr == null) {
                    return;
                }
                let prev_add_btn = prevTr.querySelector("#add_btn");
                prev_add_btn.style.display = 'inline';
                let cells = prevTr.cells;
            }
            tr.remove();
        }
    </script>
@endsection
