<div class="letter_title">
    <h1> {{ config('constant.SITE_NAME') }}</h1>
    
    @php
        $ward_no = auth()->user()->ward_no;
    @endphp
    @if($ward_no==0)
    <h2>{{ config('constant.SITE_SUB_TYPE') }}</h2>
        <h3>{{config('constant.SITE_DISTRICT')}}, {{ config('constant.FULL_ADDRESS') }}</h3>

    @else
    <h2>{{ Nepali($ward_no).config('constant.SITE_SUB_TYPE_WARD') }}</h2>
    <h3>{{config('constant.SITE_ADDRESS')}}, {{config('constant.SITE_DISTRICT')}}</h3>
    @endif
    
    <h3>{{ config('constant.PRO_ADDRESS') }}</h3>
    @if ($letter_title != '')
        <div class="letter_type"><b>{{ $letter_title }}</b></div>
    @endif
</div>
