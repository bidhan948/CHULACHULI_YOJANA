<script>
    function cN{{ $ward ?? 'ward' }}(number) {
        if (!number) return '';
        var number = number.toString();
        var sliced = [];
        var numberLength = number.length
        var nepali_digits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        for (i = 0; i < numberLength; i++) {
            sliced.push(nepali_digits[number.substr(number.length - 1)]);
            number = number.slice(0, -1);
        }
        return sliced.reverse().join('').toString();
    }
    $(document).on('change', '#{{ $province ?? 'province' }}', function(event) {
        var province = event.target.value;
        var html = '<option value="">छान्नुहोस्</option>';
        $('#{{ $municipality ?? 'municipality' }}').html(html);
        $('#{{ $district ?? 'district' }}').html(html);
        $('#{{ $ward ?? 'ward' }}').html(html);
        if (province != '') {
            axios.get("{{ route('address.district') }}", {
                    params: {
                        id: province
                    }
                }).then(function(response) {
                    var selected = '';
                    var rows = response.data;
                    $.each(rows, function(key, value) {
                        html += '<option value="' + value.id + '" data-eng="' + value.name +
                            '" ' + selected + '>' + value.nep_name +
                            '</option>';
                    });
                    $('#{{ $district ?? 'district' }}').html(html);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    });

    $(document).on('change', '#{{ $district ?? 'district' }}', function(event) {
        var district = event.target.value;
        var html = '<option value="">छान्नुहोस्</option>';
        $('#{{ $municipality ?? 'municipality' }}').html(html);
        $('#{{ $ward ?? 'ward' }}').html(html);
        if (district != '') {
            axios.get("{{ route('address.municipality') }}", {
                    params: {
                        id: district
                    }
                }).then(function(response) {
                    var selected = '';
                    var rows = response.data;
                    $.each(rows, function(key, value) {
                        html += '<option value="' + value.id + '" data-eng="' + value.name +
                            '" data-ward="' + value.total_wards +
                            '" ' + selected + '>' + value.nep_name +
                            '</option>';
                    });
                    $('#{{ $municipality ?? 'municipality' }}').html(html);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    });

    $(document).on('change', '#{{ $municipality ?? 'municipality' }}', function(event) {
        var html = '<option value="">छान्नुहोस्</option>';
        $('#{{ $ward ?? 'ward' }}').html(html);

        var municipality = event.target.value;
        debugger;
        var selectedElement = event.target.options[event.target.selectedIndex];
        var total_wards = selectedElement.getAttribute('data-ward');
        if (municipality != '') {
            for (let index = 1; index <= total_wards; index++) {
                html += '<option value="' + index +
                    '" ' + '>' + cN{{ $ward ?? 'ward' }}(index) +
                    '</option>';
            }
            $('#{{ $ward ?? 'ward' }}').html(html);
        }
    });
</script>
