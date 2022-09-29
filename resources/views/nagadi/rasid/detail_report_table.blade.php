<table class="print_table table table-stripe table-bordered">
    <thead>
        <tr>
            <th>सि.नं</th>
            <th>मिति</th>
            <th>रसिद नं</th>
            <th>करदाताको नाम</th>
            <th>मुख्य शिर्षक</th>
            <th>सह शिर्षक</th>
            <th>शिर्षक</th>
            <th>रकम</th>
            <th>अवस्था</th>
            <th>रसिद काट्नेको नाम </th>
            <th>कैफियत</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
            $total = 0;
            $cancel_total = 0;
        @endphp
        @foreach ($data as $item)
            <tr>
                <td>{{ Nepali($i) }}</td>
                <td>२०७९-०१-०४</td>
                <td>२६१५३</td>
                <td>तेजेन्द्र दाहाल</td>
                <td>सेवाशुल्क तथा सिफारिस दस्तुर</td>
                <td>सिफारिस तथा प्रमाणीत </td>
                <td>घर बाटो सिफारिस वापत </td>
                <td>४७५.००</td>
                <td>सदर</td>
                <td>दत्त प्रसाद दाहाल </td>
                <td></td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <td colspan="7" style="text-align: right">जम्मा रकम </td>
            <td colspan="">{{ NepaliAmount($total) }}</td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">बदर भएको रसिदको जम्मा रकम </td>
            <td colspan="">{{ NepaliAmount($cancel_total) }}</td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right">कुल जम्मा : </td>
            <td colspan="">
                {{ NepaliAmount($total - $cancel_total) }}</td>
            <td colspan="3"></td>
        </tr>
    </tfoot>
</table>
