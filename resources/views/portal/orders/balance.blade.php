<div class="table-responsive">
    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col" width="40%">البند</th>
            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['LAST_YEAR']}}</th>
            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['THIS_YEAR']}}</th>
            <th scope="col" class="text-center">التغيير</th>
        </tr>
        </thead>
        <tbody>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 1) @endphp
        <?php $current_assets_sub = 0; $current_assets_year = 0; ?>
        @if(count($list) > 0)
            @foreach($list as $item)
                <tr>
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center"><?php $current_assets_sub += $item['LAST_YEAR_VALUE'] ?>{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center"><?php $current_assets_year += $item['THIS_YEAR_VALUE'] ?>{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
        <tr class="table-light">
            <th scope="row" class="table-light">مجموع الموجودات المتداولة</th>
            <td class="text-center table-light"><span class="">{{number_format($current_assets_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($current_assets_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($current_assets_sub, $current_assets_year)}}</span></td>
        </tr>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 2) @endphp
        <?php $fixed_assets_sub = 0; $fixed_assets_year = 0; ?>
        @if(count($list) > 0)
            @foreach($list as $item)
                <tr>
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center"><?php $fixed_assets_sub += $item['LAST_YEAR_VALUE'] ?>{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center"><?php $fixed_assets_year += $item['THIS_YEAR_VALUE'] ?>{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
        <tr class="table-light">
            <th scope="row" class="table-light">إجمالي الأصول الثابتة</th>
            <td class="text-center table-light"><span class="">{{number_format($fixed_assets_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($fixed_assets_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($fixed_assets_sub, $fixed_assets_year)}}</span></td>
        </tr>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 3) @endphp
        <?php $extra_assets_sub = 0; $extra_assets_year = 0; ?>
        <?php $total_fixed_assets_total_sub = $fixed_assets_sub; $total_fixed_assets_total_year = $fixed_assets_year; ?>
        @if(count($list) > 0)
            @foreach($list as $item)
                @php
                    if($item['FINANCIAL_INFO_ID']==12){
                            $total_fixed_assets_total_sub -= $item['LAST_YEAR_VALUE'];
                            $total_fixed_assets_total_year -= $item['THIS_YEAR_VALUE'];
                    }else{
                            $total_fixed_assets_total_sub += $item['LAST_YEAR_VALUE'];
                            $total_fixed_assets_total_year += $item['THIS_YEAR_VALUE'];
                    }
                @endphp
                <tr>
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center"><?php $extra_assets_sub += $item['LAST_YEAR_VALUE'] ?>{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center"><?php $extra_assets_year += $item['THIS_YEAR_VALUE'] ?>{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
{{--        @php--}}
{{--            $total_fixed_assets_total_sub = $fixed_assets_sub - $extra_assets_sub;--}}
{{--            $total_fixed_assets_total_year = $fixed_assets_year - $extra_assets_year;--}}
{{--        @endphp--}}
        <tr class="table-light">
            <th scope="row" class="table-light">مجموع الموجودات غير المتداولة</th>
            <td class="text-center table-light"><span class="">{{number_format($total_fixed_assets_total_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($total_fixed_assets_total_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($total_fixed_assets_total_sub, $total_fixed_assets_total_year)}}</span></td>
        </tr>
        <tr class="table-light">
            <th scope="row" class="table-light">إجمالي الموجودات</th>
            <td class="text-center table-light"><span class="">{{number_format($current_assets_sub + $total_fixed_assets_total_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($current_assets_year + $total_fixed_assets_total_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($current_assets_sub + $total_fixed_assets_total_sub, $current_assets_year + $total_fixed_assets_total_year)}}</span></td>
        </tr>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 2)->where('FINANCIAL_INFO_SUB_TYPE_ID', 4) @endphp
        <?php $current_liabilities_sub = 0; $current_liabilities_year = 0; ?>
        @if(count($list) > 0)
            @foreach($list as $item)
                <tr>
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center"><?php $current_liabilities_sub += $item['LAST_YEAR_VALUE'] ?>{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center"><?php $current_liabilities_year += $item['THIS_YEAR_VALUE'] ?>{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
        <tr class="table-light">
            <th scope="row" class="table-light">إجمالي المطلوبات المتداولة</th>
            <td class="text-center table-light"><span class="">{{number_format($current_liabilities_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($current_liabilities_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($current_liabilities_sub, $current_liabilities_year)}}</span></td>
        </tr>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 2)->where('FINANCIAL_INFO_SUB_TYPE_ID', 5) @endphp
        <?php $fixed_liabilities_total_sub = 0; $fixed_liabilities_total_year = 0; ?>
        @if(count($list) > 0)
            @foreach($list as $item)
                <tr>
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center"><?php $fixed_liabilities_total_sub += $item['LAST_YEAR_VALUE'] ?>{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center"><?php $fixed_liabilities_total_year += $item['THIS_YEAR_VALUE'] ?>{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
        <tr class="table-light">
            <th scope="row" class="table-light">إجمالي المطلوبات طويلة الأجل</th>
            <td class="text-center table-light"><span class="">{{number_format($fixed_liabilities_total_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($fixed_liabilities_total_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($fixed_liabilities_total_sub, $fixed_liabilities_total_year)}}</span></td>
        </tr>
        <tr class="table-light">
            <th scope="row" class="table-light">إجمالي المطلوبات</th>
            <td class="text-center table-light"><span class="">{{number_format($current_liabilities_sub + $fixed_liabilities_total_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($current_liabilities_year + $fixed_liabilities_total_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($current_liabilities_sub + $fixed_liabilities_total_sub, $current_liabilities_year + $fixed_liabilities_total_year)}}</span></td>
        </tr>
        @php $list = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 3) @endphp
        <?php $all_property_sub = 0; $all_property_year = 0; ?>
        @if(count($list) > 0)
            @foreach($list as $item)
                <tr>
                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                    <td class="text-center"><?php $all_property_sub += $item['LAST_YEAR_VALUE'] ?>{{number_format($item['LAST_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center"><?php $all_property_year += $item['THIS_YEAR_VALUE'] ?>{{number_format($item['THIS_YEAR_VALUE'], 2)}}</td>
                    <td class="text-center">{{calcChange($item['LAST_YEAR_VALUE'], $item['THIS_YEAR_VALUE'])}}</td>
                </tr>
            @endforeach
        @endif
        <tr class="table-light">
            <th scope="row" class="table-light">إجمالي حقوق الملكية</th>
            <td class="text-center table-light"><span class="">{{number_format($all_property_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($all_property_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($all_property_sub, $all_property_year)}}</span></td>
        </tr>
        <tr class="table-light">
            <th scope="row" class="table-light">إجمالي حقوق الملكية والمطلوبات</th>
            <td class="text-center table-light"><span class="">{{number_format($current_liabilities_sub + $fixed_liabilities_total_sub + $all_property_sub, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{number_format($current_liabilities_year + $fixed_liabilities_total_year + $all_property_year, 2)}}</span></td>
            <td class="text-center table-light"><span class="">{{calcChange($current_liabilities_sub + $fixed_liabilities_total_sub + $all_property_sub, $current_liabilities_year + $fixed_liabilities_total_year + $all_property_year)}}</span></td>
        </tr>
        </tbody>
    </table>
</div>
