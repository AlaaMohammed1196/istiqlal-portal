<div class="table-responsive">
    <table class="table align-middle number_table income_table">
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

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 6) @endphp
        <?php $sales_sub = 0; $sales_year = 0; ?>
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    $sales_sub += $sub;
                    $sales_year  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="sales financial_income_info">
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

        <tr class="table-light sales_total">
            <th scope="row" class="table-light">إجمالي المبيعات</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($sales_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($sales_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($sales_sub, $sales_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 7) @endphp
        <?php $income_sub = 0; $income_year = 0; ?>
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    $income_sub += $sub;
                    $income_year  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="income financial_income_info">
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

        <tr class="table-light income_total">
            <th scope="row" class="table-light">إجمالي الدخل</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($sales_sub - $income_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($sales_year - $income_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($sales_sub - $income_sub, $sales_year - $income_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 8) @endphp
        <?php $profit_sub = 0; $profit_year = 0; ?>
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    $profit_sub += $sub;
                    $profit_year  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="profit financial_income_info">
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
        <tr class="table-light expenses_total">
            <th scope="row" class="table-light">إجمالي المصاريف</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($profit_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($profit_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($profit_sub, $profit_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>
        @php
            $profit_after_interest_total_sub = ($sales_sub - $income_sub) - $profit_sub;
            $profit_after_interest_total_year = ($sales_year - $income_year) - $profit_year;
        @endphp
        <tr class="table-light profit_total">
            <th scope="row" class="table-light">صافي ربح العمليات</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($profit_after_interest_total_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($profit_after_interest_total_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($profit_after_interest_total_sub, $profit_after_interest_total_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 9) @endphp
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    if($value['FINANCIAL_INFO_ID'] == 29 || $value['FINANCIAL_INFO_ID'] == 31){
                        $profit_after_interest_total_sub -= $sub;
                        $profit_after_interest_total_year -= $year;
                    }else{
                        $profit_after_interest_total_sub += $sub;
                        $profit_after_interest_total_year += $year;
                    }
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="profit_after_interest financial_income_info">
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

        <tr class="table-light profit_after_interest_total">
            <th scope="row" class="table-light">صافي الربح بعد الفوائد</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($profit_after_interest_total_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($profit_after_interest_total_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($profit_after_interest_total_sub, $profit_after_interest_total_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 10) @endphp
        <?php $profit_before_tax_sub = 0; $profit_before_tax_year = 0; ?>
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    $profit_before_tax_sub += $sub;
                    $profit_before_tax_year  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="profit_before_tax financial_income_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center integer-only number-format-input" name="LAST_YEAR_VALUE" disabled value="{{$sub}}"></td>
                <td class="text-center"><input class="form-control table-input text-center integer-only number-format-input" name="THIS_YEAR_VALUE" disabled value="{{$year}}"></td>
                <td class="text-center differance">{{$diff}}</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        @endforeach

        <tr class="table-light profit_before_tax_total">
            <th scope="row" class="table-light">صافي الربح قبل الضريبة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format($profit_after_interest_total_sub + $profit_before_tax_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format($profit_after_interest_total_year + $profit_before_tax_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange($profit_after_interest_total_sub + $profit_before_tax_sub, $profit_after_interest_total_year + $profit_before_tax_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 11) @endphp
        <?php $profit_after_tax_sub = 0; $profit_after_tax_year = 0; ?>
        @foreach($list as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = calcChange($value['LAST_YEAR_VALUE'], $value['THIS_YEAR_VALUE']);
                    $profit_after_tax_sub += $sub;
                    $profit_after_tax_year += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="profit_after_tax financial_income_info">
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

        <tr class="table-light profit_after_tax_total">
            <th scope="row" class="table-light">صافي الربح بعد الضريبة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{number_format(($profit_after_interest_total_sub + $profit_before_tax_sub) - $profit_after_tax_sub, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{number_format(($profit_after_interest_total_year + $profit_before_tax_year) - $profit_after_tax_year, 2)}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{calcChange(($profit_after_interest_total_sub + $profit_before_tax_sub) - $profit_after_tax_sub, ($profit_after_interest_total_year + $profit_before_tax_year) - $profit_after_tax_year)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>
        </tbody>
    </table>
</div>
