<div class="table-responsive">
    <table class="table align-middle number_table balance_table">
        <thead>
        <tr>
            <th scope="col" width="40%">البند</th>
            <th scope="col" class="text-center">سنة <span class="col-sub">{{$data['Fund_Data'][0]['LAST_YEAR']}}</span></th>
            <th scope="col" class="text-center">سنة <span class="col-year">{{$data['Fund_Data'][0]['THIS_YEAR']}}</span></th>
            <th scope="col" class="text-center">التغيير</th>
            <th scope="col" class="text-center">أدوات</th>
        </tr>
        </thead>
        <tbody>
        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 1) @endphp
        <?php $current_assets_sub = 0; $current_assets_year = 0; ?>
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    $current_assets_sub += $sub;
                    $current_assets_year  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="current_assets financial_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="LAST_YEAR_VALUE" disabled value="{{$sub}}"></td>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="THIS_YEAR_VALUE" disabled value="{{$year}}"></td>
                <td class="text-center differance">{{$diff}}</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        @endforeach

        <tr class="table-light current_assets_total">
            <th scope="row" class="table-light">مجموع الموجودات المتداولة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($current_assets_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($current_assets_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($current_assets_sub, $current_assets_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 2) @endphp
        <?php $fixed_assets_sub = 0; $fixed_assets_year = 0; ?>
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    $fixed_assets_sub += $sub;
                    $fixed_assets_year  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="fixed_assets financial_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="LAST_YEAR_VALUE" disabled value="{{$sub}}"></td>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="THIS_YEAR_VALUE" disabled value="{{$year}}"></td>
                <td class="text-center differance">{{$diff}}</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        @endforeach

        <tr class="table-light fixed_assets_total">
            <th scope="row" class="table-light">إجمالي الأصول الثابتة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($fixed_assets_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($fixed_assets_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($fixed_assets_sub, $fixed_assets_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 3) @endphp
        <?php $extra_assets_sub = 0; $extra_assets_year = 0; ?>
        <?php $total_fixed_assets_total_sub = $fixed_assets_sub; $total_fixed_assets_total_year = $fixed_assets_year; ?>
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    $extra_assets_sub += $sub;
                    $extra_assets_year  += $year;
                    if($item['FINANCIAL_INFO_ID']==12){
                        $total_fixed_assets_total_sub -= $sub;
                        $total_fixed_assets_total_year -= $year;
                    }else{
                        $total_fixed_assets_total_sub += $sub;
                        $total_fixed_assets_total_year += $year;
                    }
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="extra_assets financial_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="LAST_YEAR_VALUE" disabled value="{{$sub}}"></td>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="THIS_YEAR_VALUE" disabled value="{{$year}}"></td>
                <td class="text-center differance">{{$diff}}</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        <tr class="table-light total_fixed_assets_total">
            <th scope="row" class="table-light">مجموع الموجودات غير المتداولة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($total_fixed_assets_total_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($total_fixed_assets_total_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($total_fixed_assets_total_sub, $total_fixed_assets_total_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        <tr class="table-light assets_total">
            <th scope="row" class="table-light">إجمالي الموجودات</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($current_assets_sub + $total_fixed_assets_total_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($current_assets_year + $total_fixed_assets_total_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($current_assets_sub + $total_fixed_assets_total_sub, $current_assets_year + $total_fixed_assets_total_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 2)->where('FINANCIAL_INFO_SUB_TYPE_ID', 4) @endphp
        <?php $current_liabilities_sub = 0; $current_liabilities_year = 0; ?>
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    $current_liabilities_sub += $sub;
                    $current_liabilities_year  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="current_liabilities financial_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="LAST_YEAR_VALUE" disabled value="{{$sub}}"></td>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="THIS_YEAR_VALUE" disabled value="{{$year}}"></td>
                <td class="text-center differance">{{$diff}}</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        @endforeach

        <tr class="table-light current_liabilities_total">
            <th scope="row" class="table-light">إجمالي المطلوبات المتداولة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($current_liabilities_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($current_liabilities_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($current_liabilities_sub, $current_liabilities_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 2)->where('FINANCIAL_INFO_SUB_TYPE_ID', 5) @endphp
        <?php $fixed_liabilities_total_sub = 0; $fixed_liabilities_total_year = 0; ?>
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    $fixed_liabilities_total_sub += $sub;
                    $fixed_liabilities_total_year  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="fixed_liabilities financial_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="LAST_YEAR_VALUE" disabled value="{{$sub}}"></td>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="THIS_YEAR_VALUE" disabled value="{{$year}}"></td>
                <td class="text-center differance">{{$diff}}</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        @endforeach

        <tr class="table-light fixed_liabilities_total">
            <th scope="row" class="table-light">إجمالي المطلوبات طويلة الأجل</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($fixed_liabilities_total_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($fixed_liabilities_total_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($fixed_liabilities_total_sub, $fixed_liabilities_total_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        <tr class="table-light liabilities_total">
            <th scope="row" class="table-light">إجمالي المطلوبات</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($current_liabilities_sub + $fixed_liabilities_total_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($current_liabilities_year + $fixed_liabilities_total_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($current_liabilities_sub + $fixed_liabilities_total_sub, $current_liabilities_year + $fixed_liabilities_total_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 3) @endphp
        <?php $all_property_sub = 0; $all_property_year = 0; ?>
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    $all_property_sub += $sub;
                    $all_property_year  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="all_property financial_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center number-format-input {{$item['FINANCIAL_INFO_ID']==22?'integer-only':'money-only'}}" name="LAST_YEAR_VALUE" disabled value="{{$sub}}"></td>
                <td class="text-center"><input class="form-control table-input text-center number-format-input {{$item['FINANCIAL_INFO_ID']==22?'integer-only':'money-only'}}" name="THIS_YEAR_VALUE" disabled value="{{$year}}"></td>
                <td class="text-center differance">{{$diff}}</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        @endforeach

        <tr class="table-light property_total">
            <th scope="row" class="table-light">إجمالي حقوق الملكية</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($all_property_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($all_property_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($all_property_sub, $all_property_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        <tr class="table-light liabilities_property_total">
            <th scope="row" class="table-light">إجمالي حقوق الملكية والمطلوبات</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($current_liabilities_sub + $fixed_liabilities_total_sub + $all_property_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($current_liabilities_year + $fixed_liabilities_total_year + $all_property_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($current_liabilities_sub + $fixed_liabilities_total_sub + $all_property_sub, $current_liabilities_year + $fixed_liabilities_total_year + $all_property_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        </tbody>
    </table>
</div>
