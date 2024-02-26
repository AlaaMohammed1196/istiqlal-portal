<div class="table-responsive">
    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col"  width="40%">البند</th>
            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['LAST_YEAR']}}</th>
            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['THIS_YEAR']}}</th>
            <th scope="col"  class="text-center">التغيير</th>
        </tr>
        </thead>
        <tbody>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 6) @endphp
        <?php $sales_sub = 0; $sales_year = 0; ?>
        @if(count($list) > 0)
            @foreach($list as $index=>$item)
                <tr>
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center"><?php $sales_sub += $item['LAST_YEAR_VALUE'] ?>{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center"><?php $sales_year += $item['THIS_YEAR_VALUE'] ?>{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
        <tr class="table-light">
            <th scope="row" class="table-light">إجمالي المبيعات</th>
            <td class="text-center table-light"><span class="">{{number_format($sales_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($sales_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($sales_sub, $sales_year)}}</span></td>
        </tr>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 7) @endphp
        <?php $income_sub = 0; $income_year = 0; ?>
        @if(count($list) > 0)
            @foreach($list as $index=>$item)
                <tr>
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center"><?php $income_sub += $item['LAST_YEAR_VALUE'] ?>{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center"><?php $income_year += $item['THIS_YEAR_VALUE'] ?>{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
        <tr class="table-light">
            <th scope="row" class="table-light">إجمالي الدخل</th>
            <td class="text-center table-light"><span class="">{{number_format($sales_sub - $income_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($sales_year - $income_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($sales_sub - $income_sub, $sales_year - $income_year)}}</span></td>
        </tr>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 8) @endphp
        <?php $profit_sub = 0; $profit_year = 0; ?>
        @if(count($list) > 0)
            @foreach($list as $index=>$item)
                <tr>
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center"><?php $profit_sub += $item['LAST_YEAR_VALUE'] ?>{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center"><?php $profit_year += $item['THIS_YEAR_VALUE'] ?>{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
        @php
            $profit_after_interest_total_sub = ($sales_sub - $income_sub) - $profit_sub;
            $profit_after_interest_total_year = ($sales_year - $income_year) - $profit_year;
        @endphp
        <tr class="table-light">
            <th scope="row" class="table-light">صافي ربح العمليات</th>
            <td class="text-center table-light"><span class="">{{number_format($profit_after_interest_total_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($profit_after_interest_total_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($profit_after_interest_total_sub, $profit_after_interest_total_year)}}</span></td>
        </tr>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 9) @endphp
        @if(count($list) > 0)
            @foreach($list as $index=>$item)
                <tr>
                    @php
                        if($item['FINANCIAL_INFO_ID'] == 29 || $item['FINANCIAL_INFO_ID'] == 31){
                            $profit_after_interest_total_sub -= $item['LAST_YEAR_VALUE'];
                            $profit_after_interest_total_year -= $item['THIS_YEAR_VALUE'];
                        }else{
                            $profit_after_interest_total_sub += $item['LAST_YEAR_VALUE'];
                            $profit_after_interest_total_year += $item['THIS_YEAR_VALUE'];
                        }
                    @endphp
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center">{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
        <tr class="table-light">
            <th scope="row" class="table-light">صافي الربح بعد الفوائد</th>
            <td class="text-center table-light"><span class="">{{number_format($profit_after_interest_total_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($profit_after_interest_total_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($profit_after_interest_total_sub, $profit_after_interest_total_year)}}</span></td>
        </tr>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 10) @endphp
        <?php $profit_before_tax_sub = 0; $profit_before_tax_year = 0; ?>
        @if(count($list) > 0)
            @foreach($list as $index=>$item)
                <tr>
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center"><?php $profit_before_tax_sub += $item['LAST_YEAR_VALUE'] ?>{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center"><?php $profit_before_tax_year += $item['THIS_YEAR_VALUE'] ?>{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
        <tr class="table-light">
            <th scope="row" class="table-light">صافي الربح قبل الضريبة</th>
            <td class="text-center table-light"><span class="">{{number_format($profit_after_interest_total_sub + $profit_before_tax_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($profit_after_interest_total_year + $profit_before_tax_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($profit_after_interest_total_sub + $profit_before_tax_sub, $profit_after_interest_total_year + $profit_before_tax_year)}}</span></td>
        </tr>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 11) @endphp
        <?php $profit_after_tax_sub = 0; $profit_after_tax_year = 0; ?>
        @if(count($list) > 0)
            @foreach($list as $index=>$item)
                <tr>
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center"><?php $profit_after_tax_sub += $item['LAST_YEAR_VALUE'] ?>{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center"><?php $profit_after_tax_year += $item['THIS_YEAR_VALUE'] ?>{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
        <tr class="table-light">
            <th scope="row" class="table-light">صافي الربح بعد الضريبة</th>
            <td class="text-center table-light"><span class="">{{number_format(($profit_after_interest_total_sub + $profit_before_tax_sub) - $profit_after_tax_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format(($profit_after_interest_total_year + $profit_before_tax_year) - $profit_after_tax_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange(($profit_after_interest_total_sub + $profit_before_tax_sub) - $profit_after_tax_sub, ($profit_after_interest_total_year + $profit_before_tax_year) - $profit_after_tax_year)}}</span></td>
        </tr>
        </tbody>
    </table>
</div>
