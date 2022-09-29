@extends('layout.layout')
@section('sidebar')
    @include('layout.pis_sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="pull-left">अन्य वैयक्तिक विवरण
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                @if (isset($data))
                <tbody>
                    <form action="{{route('page_3_submit')}}" method="POST">
                        @csrf
                    <tr>
                        <td>

                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">लिंग: <i
                                            class="reqq">*</i></span></div>
                                <select id="gender" name="gender" class="form-control select2">
                                    @foreach ($genders as $key => $item)
                                        @if ($data->gender==$key)
                                        <option value="{{ $key }}" data-eng="">{{ $item }}</option>
                                        @endif
                                    @endforeach
                                    @foreach ($genders as $key => $item)
                                        @if ($data->gender!=$key)
                                            <option value="{{ $key }}" data-eng="">{{ $item }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('gender')
                                    <strong> {{$message}}</strong>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">धर्म: <i
                                            class="reqq">*</i></span></div>
                                <select id="religion" name="religion" class="form-control select2">
                                    @foreach ($religions as $item)
                                    @if ($data->gender==$item->id)
                                        <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                        @endif
                                    @endforeach

                                    @foreach ($religions as $item)
                                        @if ($data->gender!=$item->id)
                                        <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('religion')
                                <strong> {{$message}}</strong>
                                 @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">जात/जाती: <i
                                            class="reqq">*</i></span></div>
                                <select id="ethnicity" name="ethnicity" class="form-control select2">
                                    @foreach ($ethnicities as $item)
                                         @if ($data->ethnicity==$item->id)
                                            <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                        @endif
                                     @endforeach
                                     @foreach ($ethnicities as $item)
                                         @if ($data->ethnicity!=$item->id)
                                            <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                        @endif
                                     @endforeach

                                @error('ethnicity')
                                <strong> {{$message}}</strong>
                                 @enderror
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">हुलिया: </span></div>
                                <select id="face" name="face" class="form-control select2">
                                    @if (isset($data->face))
                                        @foreach ($faces as $item)
                                            @if ($data->face==$item->id)
                                                <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                            @endif
                                        @endforeach

                                        @foreach ($faces as $item)
                                            @if ($data->face!=$item->id)
                                                <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="" data-eng="">छान्नुहोस्</option>
                                        @foreach ($faces as $item)
                                            <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                        @endforeach
                                 @endif

                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">रक्त समूह: </span></div>
                                <select id="blood_group" name="blood_group" class="form-control select2">
                                    @if (isset($data->blood_group))
                                        @foreach ($bgroups as $item)
                                            @if ($data->blood_group==$item->id)
                                                <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                            @endif
                                        @endforeach

                                        @foreach ($bgroups as $item)
                                            @if ($data->blood_group!=$item->id)
                                                <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                    <option value="" data-eng="">छान्नुहोस्</option>
                                    @foreach ($bgroups as $item)
                                        <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                    @endforeach
                                    @endif
                                    
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">मुल: </span></div>
                                @if (isset($data->source))
                                    <?php
                                    $s = 1;
                                    foreach ($sources as $v=>$source) {
                                        ?>
                                        <label style="font-weight: normal;">
                                            @if ($data->source==$v)
                                                &nbsp;&nbsp;&nbsp;<input type="radio" name="source" value="<?=$v;?>" checked> <?=$source;?>
                                            @else
                                                 &nbsp;&nbsp;&nbsp;<input type="radio" name="source" value="<?=$v;?>"> <?=$source;?>
                                            @endif
                                        </label>
                                        <?php
                                    }
                                    ?>
                                @else
                                <?php
                                $s = 1;
                                foreach ($sources as $v=>$source) {
                                    ?>
                                    <label style="font-weight: normal;">
                                            &nbsp;&nbsp;&nbsp;<input type="radio" name="source" value="<?=$v;?>"> <?=$source;?>
                                    </label>
                                    <?php
                                }
                                ?>
                                @endif


                            </div>
                        </td>
                    </tr>
                    <?php $yns = ['1' => 'हो', '0' => 'होइन']; ?>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><strong>क) आदिवासी/जनजातीः
                                        </strong></span></div>
                         @if (isset($data->janjati))
                        <?php
                        foreach ($yns as $v=>$yn) {
                        ?>
                                 @if ($data->janjati==$v)
                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                    <input type="radio" name="janjati" value="<?= $v ?>" checked> <?= $yn ?>
                                @else
                                &nbsp;&nbsp;&nbsp; <input type="radio" name="janjati" value="<?= $v ?>"> <?= $yn ?>
                                @endif
                                </label>
                                <?php
                        }
                        ?>
                        @else
                        <?php
                        $s = 1;
                        foreach ($yns as $v=>$yn) {
                        ?>
                                <input type="radio" name="janjati" value="<?= $v ?>"> <?= $yn ?>
                        <?php
                        }
                        ?>
                        @endif
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="input-group" id="janjati_y">
                                <div class="input-group-prepend"><span class="input-group-text">हो भने विवरण </span></div>
                                <input type="text" id="janjati_other" name="janjati_other" class="form-control" value="{{isset($data->janjati_other)? $data->janjati_other: ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><strong>ख) मधेशीः
                                        </strong></span></div>
                         @if (isset($data->madesi))
                                <?php
                        $y = 1;
                        foreach ($yns as $v=>$yn) {
                            ?>
                                 @if ($data->madesi==$v)
                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                    <input type="radio" name="madesi" value="<?= $v ?>" checked> <?= $yn ?>
                                @else
                                &nbsp;&nbsp;&nbsp; <input type="radio" name="madesi" value="<?= $v ?>"> <?= $yn ?>
                                @endif

                                </label>
                                <?php
                        }
                        ?>
                        @else
                        <?php
                        $y = 1;
                        foreach ($yns as $v=>$yn) {
                            ?>
                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                    <input type="radio" name="madesi" value="<?= $v ?>"> <?= $yn ?>
                                </label>
                                <?php
                        }
                        ?>
                        @endif
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="input-group" id="madesi_y">
                                <div class="input-group-prepend"><span class="input-group-text">हो भने विवरण </span></div>
                                <input type="text" id="madesi_other" name="madesi_other" class="form-control" value="{{isset($data->madesi_other)? $data->madesi_other: ''}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><strong>ग) दलितः
                                        </strong></span></div>
                        @if (isset($data->dalit))
                         <?php
                            $y = 1;
                            foreach ($yns as $v=>$yn) {
                                ?>
                                 @if ($data->dalit==$v)
                                    &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                        <input type="radio" class="dalit-radio" name="dalit" value="<?= $v ?>" checked> <?= $yn ?>
                                        @else
                                        &nbsp;&nbsp;&nbsp; <input type="radio" class="dalit-radio" name="dalit" value="<?= $v ?>"> <?= $yn ?>
                                        @endif
                                    </label>
                                    <?php
                            }
                            ?>
                        @else
                        <?php
                        $y = 1;
                        foreach ($yns as $v=>$yn) {
                            ?>
                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                    <input type="radio" class="dalit-radio" name="dalit" value="<?= $v ?>"> <?= $yn ?>
                                </label>
                                <?php
                        }
                        ?>
                        @endif
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="input-group" id="dalit_y">
                                <div class="input-group-prepend"><span class="input-group-text">हो भने विवरण </span></div>
                                <input type="text" id="dalit_other" name="dalit_other" class="form-control" value="{{isset($data->dalit_other)? $data->dalit_other: ''}}">

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><strong>घ) पिछडिएको जिल्ला
                                            (क्षेत्र): </strong></span></div>

                         @if (isset($data->low))
                        
                         <?php
                                $y = 1;
                                foreach ($yns as $v=>$yn) {
                                    ?>
                                    @if ($data->low==$v)
                                        &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                            <input type="radio" name="low" value="<?= $v ?>" checked> <?= $yn ?>
                                    @else
                                    &nbsp;&nbsp;&nbsp; <input type="radio" name="low" value="<?= $v ?>"> <?= $yn ?>
                                    @endif

                                        </label>
                                        <?php
                                }
                                ?>
                        @else
                            <?php
                            $y = 1;
                            foreach ($yns as $v=>$yn) {
                                ?>
                                    &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                        <input type="radio" name="low" value="<?= $v ?>"> <?= $yn ?>
                                    </label>
                                    <?php
                            }
                            ?>

                        @endif
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="input-group" id="low_y">
                                <div class="input-group-prepend"><span class="input-group-text">हो भने विवरण </span></div>
                                <input type="text" id="low_other" name="low_other" class="form-control" value="{{isset($data->low_other)? $data->low_other: ''}}">

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><strong>ङ) अपागंता:
                                        </strong></span></div>
                         @if (isset($data->disable))

                        <?php
                        $y = 1;
                        foreach ($yns as $v=>$yn) {
                        ?>
                        @if ($data->disable==$v)
                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                    <input type="radio" name="disable" value="<?= $v ?>" checked> <?= $yn ?>
                        @else
                        &nbsp;&nbsp;&nbsp; <input type="radio" name="disable" value="<?= $v ?>"> <?= $yn ?>

                        @endif

                                </label>
                                <?php
                        }
                        ?>
                        @else
                        <?php
                        $y = 1;
                        foreach ($yns as $v=>$yn) {
                        ?>
                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                    <input type="radio" name="disable" value="<?= $v ?>"> <?= $yn ?>
                                </label>
                                <?php
                        }
                        ?>
                        @endif
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="input-group" id="disable_y">
                                <div class="input-group-prepend"><span class="input-group-text">हो भने कुन अपागंता</span>
                                </div>
                                <select id="disable_other" name="disable_other" class="form-control select2">
                                    @if (isset($data->disable_other))
                                        @foreach ($physicals as $item)
                                            @if ($data->disable_other==$item->id)
                                                <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                             @endif
                                        @endforeach 
                                        @foreach ($physicals as $item)
                                            @if ($data->disable_other!=$item->id)
                                                <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                             @endif
                                        @endforeach 
                                    @else
                                        <option value="" data-eng="">छान्नुहोस्</option>
                                        @foreach ($physicals as $item)
                                            <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                        @endforeach

                                    @endif


                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">लोक सेवा आयोगको सिफारिश
                                        हुँदा कुन वर्गमा भएको हो ? </span></div>
                                        @if (isset($data->is_division))
                                        <?php
                                            $d = 1;
                                            foreach ($divisions as $v=>$division) {
                                                ?>
                                                @if ($data->is_division==$v)
                                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                                    &nbsp;&nbsp;&nbsp;<input type="radio" name="is_division" value="<?=$v;?>" checked> <?=$division;?>
                                                @else
                                                    &nbsp;&nbsp;&nbsp;<input type="radio" name="is_division" value="<?=$v;?>"> <?=$division;?>
                                                @endif

                                                </label>
                                                <?php
                                            }
                                        ?>
                                        @else
                                        <?php
                                            $d = 1;
                                            foreach ($divisions as $v=>$division) {
                                                ?>
                                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                                    &nbsp;&nbsp;&nbsp;<input type="radio" name="is_division" value="<?=$v;?>"> <?=$division;?>
                                                </label>
                                                <?php
                                            }
                                        ?>
                                        @endif

                            </div>
                        </td>
                    </tr>
                </tbody>
                @else
                <tbody>
                    <form action="{{route('page_3_submit')}}" method="POST">
                        @csrf
                    <tr>
                        <td>

                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">लिंग: <i
                                            class="reqq">*</i></span></div>
                                <select id="gender" name="gender" class="form-control select2">
                                    <option value="" data-eng="">छान्नुहोस्</option>
                                    @foreach ($genders as $key => $item)
                                        <option value="{{ $key }}" data-eng="">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('gender')
                                    <strong> {{$message}}</strong>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">धर्म: <i
                                            class="reqq">*</i></span></div>
                                <select id="religion" name="religion" class="form-control select2">
                                    <option value="" data-eng="">छान्नुहोस्</option>
                                    @foreach ($religions as $item)
                                        <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('religion')
                                <strong> {{$message}}</strong>
                                 @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">जात/जाती: <i
                                            class="reqq">*</i></span></div>
                                <select id="ethnicity" name="ethnicity" class="form-control select2">
                                    <option value="" data-eng="">छान्नुहोस्</option>
                                    @foreach ($ethnicities as $item)
                                    <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                @endforeach
                                @error('ethnicity')
                                <strong> {{$message}}</strong>
                                 @enderror
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">हुलिया: </span></div>
                                <select id="face" name="face" class="form-control select2">
                                    <option value="" data-eng="">छान्नुहोस्</option>
                                    @foreach ($faces as $item)
                                    <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">रक्त समूह: </span></div>
                                <select id="blood_group" name="blood_group" class="form-control select2">
                                    <option value="" data-eng="">छान्नुहोस्</option>
                                    @foreach ($bgroups as $item)
                                    <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">मुल: </span></div>
                                <?php
                                $s = 1;
                                foreach ($sources as $v=>$source) {
                                    ?>
                                    &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                        &nbsp;&nbsp;&nbsp;<input type="radio" name="source" value="<?=$v;?>"> <?=$source;?>
                                    </label>
                                    <?php
                                }
                                ?>

                            </div>
                        </td>
                    </tr>
                    <?php $yns = ['1' => 'हो', '0' => 'होइन']; ?>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><strong>क) आदिवासी/जनजातीः
                                        </strong></span></div>
                                <?php
                        $y = 1;
                        foreach ($yns as $v=>$yn) {
                            ?>
                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                    <input type="radio" name="janjati" value="<?= $v ?>"> <?= $yn ?>
                                </label>
                                <?php
                        }
                        ?>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="input-group" id="janjati_y">
                                <div class="input-group-prepend"><span class="input-group-text">हो भने विवरण </span></div>
                                <input type="text" id="janjati_other" name="janjati_other" class="form-control" value="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><strong>ख) मधेशीः
                                        </strong></span></div>
                                <?php
                        $y = 1;
                        foreach ($yns as $v=>$yn) {
                            ?>
                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                    <input type="radio" name="madesi" value="<?= $v ?>"> <?= $yn ?>
                                </label>
                                <?php
                        }
                        ?>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="input-group" id="madesi_y">
                                <div class="input-group-prepend"><span class="input-group-text">हो भने विवरण </span></div>
                                <input type="text" id="madesi_other" name="madesi_other" class="form-control" value="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><strong>ग) दलितः
                                        </strong></span></div>
                                <?php
                        $y = 1;
                        foreach ($yns as $v=>$yn) {
                            ?>
                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                    <input type="radio" class="dalit-radio" name="dalit" value="<?= $v ?>"> <?= $yn ?>
                                </label>
                                <?php
                        }
                        ?>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="input-group" id="dalit_y">
                                <div class="input-group-prepend"><span class="input-group-text">हो भने विवरण </span></div>
                                <input type="text" id="dalit_other" name="dalit_other" class="form-control" value="">

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><strong>घ) पिछडिएको जिल्ला
                                            (क्षेत्र): </strong></span></div>
                                <?php
                        $y = 1;
                        foreach ($yns as $v=>$yn) {
                            ?>
                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                    <input type="radio" name="low" value="<?= $v ?>"> <?= $yn ?>
                                </label>
                                <?php
                        }
                        ?>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="input-group" id="low_y">
                                <div class="input-group-prepend"><span class="input-group-text">हो भने विवरण </span></div>
                                <input type="text" id="low_other" name="low_other" class="form-control" value="">

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><strong>ङ) अपागंता:
                                        </strong></span></div>
                                <?php
                        $y = 1;
                        foreach ($yns as $v=>$yn) {
                            ?>
                                &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                    <input type="radio" name="disable" value="<?= $v ?>"> <?= $yn ?>
                                </label>
                                <?php
                        }
                        ?>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="input-group" id="disable_y">
                                <div class="input-group-prepend"><span class="input-group-text">हो भने कुन अपागंता</span>
                                </div>
                                <select id="disable_other" name="disable_other" class="form-control select2">
                                    <option value="" data-eng="">छान्नुहोस्</option>
                                    @foreach ($physicals as $item)
                                    <option value="{{ $item->id }}" data-eng="">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">लोक सेवा आयोगको सिफारिश
                                        हुँदा कुन वर्गमा भएको हो ? </span></div>
                                        <?php
                                        $d = 1;
                                        foreach ($divisions as $v=>$division) {
                                            ?>
                                            &nbsp;&nbsp;&nbsp;<label style="font-weight: normal;">
                                                &nbsp;&nbsp;&nbsp;<input type="radio" name="is_division" value="<?=$v;?>"> <?=$division;?>
                                            </label>
                                            <?php
                                        }
                                        ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endif

            </table>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save & Next</button>
        </div>
    </form>
        
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            $(".select2").select2();
        });
    </script>
    <script>
        // $(document).ready(function(){
        //     var html = '<option value="">छान्नुहोस्</option>';
        //     $('input[name="disable"]').on("click", function() {
        //     var disable = $('input[name="disable"]:checked').val();
        //     if (disable==1) {
        //         $('#disable_other').append(html);
        //     }
        // });
        // });
    </script>
@endsection
