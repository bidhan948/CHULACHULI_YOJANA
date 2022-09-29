@extends('layout.layout')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('date-picker/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection

@section('content')
    <form method="POST" action="{{route('page_1_submit')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group col-md-8">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">कर्मचारी संकेत नम्बर </span></div>
                        <div class="input-group-prepend"><span class="input-group-text">नेपाली अंकमा</span></div>
                        <input type="text" id="nep_s_no"  class="form-control" value="" readonly>
                        <div class="input-group-prepend"><span class="input-group-text">अंग्रेजी अंकमा</span></div>
                        <input type="number" min="0" id="s_no" name="s_no"  class="form-control" value="{{isset($data->s_no)? $data->s_no: ''}}">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="input-group image-preview" default-img="">
                        <div class="input-group-prepend"><span class="input-group-text">Photo</span></div>
                        <input type="text" class="form-control image-preview-filename" value="" disabled="disabled">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                <span class="fa fa-remove"></span>Clear
                            </button>
                            <div class="btn btn-success image-preview-input">
                                <span class="fa fa-repeat"></span>
                                <span class="image-preview-input-title">Image Browse</span>
                                <input type="file" accept="image/png, image/jpeg, image/gif" id="photo" name="photo">
                                @error('photo')
                                    <strong> {{$message}} </strong>
                                @enderror
                            </div>
                        </span>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td colspan="3">
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">नाम नेपालीमा : <i
                                            class="reqq">*</i></span></div>
                                <input type="text" id="nep_name" name="nep_name" class="form-control" value="{{isset($data->nep_name)? $data->nep_name: ''}}" required>
                                @error('nep_name')
                                <strong> {{$message}} </strong>
                            @enderror
                                <div class="input-group-prepend"><span class="input-group-text">नाम अंग्रेजीमा : <i
                                            class="reqq">*</i></span></div>
                                <input type="text" id="name" name="name" class="form-control" value="{{isset($data->name)? $data->name: ''}}" required>
                                @error('name')
                                <strong> {{$message}} </strong>
                            @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">जन्म मिति विवरण : <i
                                            class="reqq">*</i></span></div>
                                <div class="input-group-prepend"><span class="input-group-text">(ई.सं.)</span></div>
                                <input type="text" id="eng_dob" class="form-control" value="" readonly>
                                <div class="input-group-prepend"><span class="input-group-text">(वि.सं.)</span></div>
                                <input type="text" id="dob" name="dob" class="form-control" value="{{isset($data->dob)? $data->dob: ''}}" required>
                                @error('dob')
                                <strong> {{$message}} </strong>
                            @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">नागरिकता नं. <i
                                            class="reqq">*</i></span></div>
                                <input type="text" id="cs_no" name="cs_no" class="form-control" value="{{isset($data->cs_no)? $data->cs_no: ''}}" required>
                                @error('cs_no')
                                <strong> {{$message}} </strong>
                            @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">जारी जिल्ला</span></div>
                                <select id="cs_district" name="cs_district" class="form-control select2">
                                    @isset($data->cs_district)
                                    @foreach ($districts as $district)
                                    @if ($district->id==$data->cs_district)
                                    <option value="{{ $district->id }}">{{ $district->nep_name }}</option>
                                    @endif
                                    @endforeach
                                    @endisset
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->nep_name }}</option>
                                    @endforeach
                                </select>
                                @error('cs_district')
                                <strong> {{$message}} </strong>
                            @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">जारी मिति</span></div>
                                <input type="text" id="cs_issue" name="cs_issue" class="form-control" value="{{isset($data->cs_issue)? $data->cs_issue: ''}}">
                                @error('cs_issue')
                                <strong> {{$message}} </strong>
                            @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">कर्मचारीको प्रकार <i
                                            class="reqq">*</i></span></div>
                                <select name="category_id" class="form-control select2" id="category" required>
                                    <option value="">--</option>
                                    @foreach ($staff_categories as $staff_category)
                                        <option value="{{ $staff_category->id }}">{{ $staff_category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <strong> {{$message}} </strong>
                            @enderror

                            </div>
                        </td>

                        <td colspan="2">
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">कर्मचारीको सह प्रकार</span>
                                </div>
                               
                                <select name="sub_category_id" class="form-control select2" id="sub_category">
                                    @isset($data->sub_category_id)
                                    @foreach ($staff_sub_cat as $sub_cat)
                                    @if ($data->sub_category_id==$sub_cat->id)
                                    <option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
                                    @endif
                                    @endforeach
                                    @endisset
                                    <option value="">--</option>
                                </select>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">बाबुको नाम (नेपालीमा)</span>
                                </div>
                                <input type="text" id="father_nep_name" name="father_nep_name" class="form-control"
                                    value="{{isset($data->father_nep_name)? $data->father_nep_name: ''}}">
                                    @error('father_nep_name')
                                    <strong> {{$message}} </strong>
                                     @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">(अंग्रेजीमा)</span></div>
                                <input type="text" id="father_name" name="father_name" class="form-control" value="{{isset($data->father_name)? $data->father_name: ''}}">
                            </div>
                        </td>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">पेशा</span></div>
                                <select id="father_occupation" name="father_occupation" class="form-control select2">
                                    @isset($data->father_occupation)
                                        @foreach ($occupations as $occupation)
                                            @if ($data->father_occupation==$occupation->id)
                                                <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                            @endif
                                        @endforeach
                                    @endisset
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($occupations as $occupation)
                                    @if (isset($data->father_occupation))
                                        @if ($data->father_occupation!=$occupation->id)
                                            <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                        @else
                                        <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                        @endif
                                    @else
                                    <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                    @endif

                                    @endforeach
                                </select>
                                @error('father_occupation')
                                <strong> {{$message}} </strong>
                                 @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">बाजेको नाम (नेपालीमा)</span>
                                </div>
                                <input type="text" id="g_father_nep_name" name="g_father_nep_name" class="form-control"
                                    value="{{isset($data->g_father_nep_name)? $data->g_father_nep_name: ''}}">
                                    @error('g_father_nep_name')
                                    <strong> {{$message}} </strong>
                                     @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">(अंग्रेजीमा)</span></div>
                                <input type="text" id="g_father_name" name="g_father_name" class="form-control" value="{{isset($data->g_father_name)? $data->g_father_name: ''}}">
                                @error('g_father_name')
                                <strong> {{$message}} </strong>
                                 @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">पेशा</span></div>
                                <select id="g_father_occupation" name="g_father_occupation" class="form-control select2">

                                    @isset($data->g_father_occupation)
                                        @foreach ($occupations as $occupation)
                                            @if ($data->g_father_occupation==$occupation->id)
                                                 <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                            @endif
                                        @endforeach
                                    @endisset
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($occupations as $occupation)
                                    @if (isset($data->g_father_occupation))
                                    @if ($data->g_father_occupation!=$occupation->id)
                                        <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                    @else
                                    <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                    @endif
                                    @else
                                    <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                    @endif
                                    @endforeach

                                    @error('g_father_occupation')
                                <strong> {{$message}} </strong>
                                 @enderror
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">आमाको नाम (नेपालीमा)</span>
                                </div>
                                <input type="text" id="mother_nep_name" name="mother_nep_name" class="form-control"
                                    value="{{isset($data->mother_nep_name)? $data->mother_nep_name: ''}}">
                                    @error('mother_nep_name')
                                <strong> {{$message}} </strong>
                                 @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">(अंग्रेजीमा)</span></div>
                                <input type="text" id="mother_name" name="mother_name" class="form-control" value="{{isset($data->mother_name)? $data->mother_name: ''}}">
                                @error('mother_name')
                                <strong> {{$message}} </strong>
                                 @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">पेशा</span></div>
                                <select id="mother_occupation" name="mother_occupation" class="form-control select2">
                                 @isset($data->mother_occupation)
                                    @foreach ($occupations as $occupation)
                                        @if ($data->mother_occupation==$occupation->id)
                                             <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                        @endif
                                    @endforeach
                                @endisset
                                <option value="">छान्नुहोस्</option>
                                @foreach ($occupations as $occupation)
                                @if (isset( $data->mother_occupation))
                                    @if ($data->mother_occupation!=$occupation->id)
                                        <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                    @else
                                    <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                    @endif
                                    @else
                                    <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                    @endif
                                @endforeach
                                </select>
                                @error('mother_occupation')
                                <strong> {{$message}} </strong>
                                 @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">विवाहित भए पति/पत्नीको नाम
                                        (नेपालीमा)</span></div>
                                <input type="text" id="spouse_nep_name" name="spouse_nep_name" class="form-control"
                                    value="{{isset($data->spouse_nep_name)? $data->spouse_nep_name: ''}}">
                                    @error('spouse_nep_name')
                                    <strong> {{$message}} </strong>
                                     @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">(अंग्रेजीमा)</span></div>
                                <input type="text" id="spouse_name" name="spouse_name"  class="form-control" value="{{isset($data->spouse_name) ? $data->spouse_name : ''}}">
                                @error('spouse_name')
                                <strong> {{$message}} </strong>
                                 @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">पेशा</span></div>
                                <select id="spouse_occupation" name="spouse_occupation" class="form-control select2">
                                @isset($data->spouse_occupation)
                                    @foreach ($occupations as $occupation)
                                        @if ($data->spouse_occupation==$occupation->id)
                                             <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                        @endif
                                    @endforeach
                                @endisset
                                <option value="">छान्नुहोस्</option>
                                @foreach ($occupations as $occupation)
                                @if (isset($data->spouse_occupation))
                                            
                                    @if ($data->spouse_occupation!=$occupation->id)
                                        <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                    @else
                                    <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                    @endif
                                    @else
                                    <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                    @endif

                                @endforeach
                                    
                                </select>
                                @error('spouse_occupation')
                                <strong> {{$message}} </strong>
                                 @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">छोरीको संख्या </span>
                                </div>
                                <input type="number" min="0" id="daughters_no" name="daughters_no" class="form-control"
                                    value="{{isset($data->daughters_no)? $data->daughters_no: ''}}">
                                    @error('daughters_no')
                                    <strong> {{$message}} </strong>
                                     @enderror
                            </div>
                        </td>
                        <td></td>
                        <td>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend"><span class="input-group-text">छोराको संख्या </span>
                                </div>
                                <input type="number" min="0" id="sons_no" name="sons_no" class="form-control" value="{{isset($data->sons_no)? $data->sons_no: ''}}">
                                @error('sons_no')
                                <strong> {{$message}} </strong>
                                 @enderror
                            </div>
                        </td>

                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save & Next</button>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{ asset('date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            $('#s_no').on('input', function() {
                var s_no = $(this).val();
                if (s_no != '') {
                        $('#nep_s_no').val(convertToNepaliNumber(s_no));
                } else  {
                    $('#nep_s_no').val('');
                }
            });

            $('#dob').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
                onChange: function(e) {
                    $('#eng_dob').val(e.ad);
                }
            });
            $('#cs_issue').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 70,
                readOnlyInput: true,
                ndpTriggerButton: false,
                ndpTriggerButtonText: '<i class="fa fa-calendar"></i>',
                ndpTriggerButtonClass: 'btn btn-primary',
                onChange: function() {

                }
            });

            $('#name').on('input', function() {
                var name = $(this).val();
                if (name != '') {
                    $(this).val(name.toUpperCase());
                }
            });
        });

        function categoryChange() {
            var cat = $('#category').val();
            if (cat != '') {
                axios.get("{{ route('staff_sub_category') }}", {
                        params: {
                            id: cat
                        }
                    })
                    .then(function(response) {
                        console.log(response);
                        var html = '<option value="">छान्नुहोस्</option>';
                        var selected = '';
                        var rows = response.data;
                        $.each(rows, function(key, value) {
                            html += '<option value="' + value.id + '" ' + selected + '>' + value.name +
                                '</option>';
                        });

                        $('#sub_category').html(html);
                    })
                    .catch(function(error) {
                        console.log(error);;
                    });
            } else {
                var html = '<option value="">छान्नुहोस्</option>';
                $('#sub_category').html(html);
            }
        }
        $('#category').on('change', function() {
            categoryChange();
        });
    </script>
@endsection
