<div class="table-responsive">
    <table class="table align-middle number_table income_table">
        <thead>
        <tr>
            <th scope="col" width="40%">البند</th>
            <th scope="col" class="text-center">سنة <span class="col-sub">{{now()->subYear()->year}}</span></th>
            <th scope="col" class="text-center">سنة <span class="col-year">{{now()->year}}</span></th>
            <th scope="col" class="text-center">التغيير</th>
            <th scope="col" class="text-center">أدوات</th>
        </tr>
        </thead>
        <tbody>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 6) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="sales financial_income_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="LAST_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="THIS_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center differance">-</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
            <?php $p_count+=1 ?>
        @endforeach

        <tr class="table-light sales_total">
            <th scope="row" class="table-light">إجمالي المبيعات</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 7) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="income financial_income_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="LAST_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="THIS_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center differance">-</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
                <?php $p_count+=1 ?>
        @endforeach

        <tr class="table-light income_total">
            <th scope="row" class="table-light">إجمالي الدخل</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 8) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="profit financial_income_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="LAST_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="THIS_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center differance">-</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
                <?php $p_count+=1 ?>
        @endforeach

        <tr class="table-light expenses_total">
            <th scope="row" class="table-light">إجمالي المصاريف</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        <tr class="table-light profit_total">
            <th scope="row" class="table-light">صافي ربح العمليات</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 9) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="profit_after_interest financial_income_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="LAST_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="THIS_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center differance">-</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
            <?php $p_count+=1 ?>
        @endforeach

        <tr class="table-light profit_after_interest_total">
            <th scope="row" class="table-light">صافي الربح بعد الفوائد</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 10) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="profit_before_tax financial_income_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center integer-only number-format-input" name="LAST_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center"><input class="form-control table-input text-center integer-only number-format-input" name="THIS_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center differance">-</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        <?php $p_count+=1 ?>
        @endforeach

        <tr class="table-light profit_before_tax_total">
            <th scope="row" class="table-light">صافي الربح قبل الضريبة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 11) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="profit_after_tax financial_income_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="LAST_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center"><input class="form-control table-input text-center money-only number-format-input" name="THIS_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center differance">-</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
                <?php $p_count+=1 ?>
        @endforeach

        <tr class="table-light profit_after_tax_total">
            <th scope="row" class="table-light">صافي الربح بعد الضريبة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>
        </tbody>
    </table>
</div>
