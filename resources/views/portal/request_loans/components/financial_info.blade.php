<div class="table-responsive">
    <table class="table align-middle number_table balance_table">
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

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 1) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="current_assets financial_info">
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

        <tr class="table-light current_assets_total">
            <th scope="row" class="table-light">مجموع الموجودات المتداولة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 2) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="fixed_assets financial_info">
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

        <tr class="table-light fixed_assets_total">
            <th scope="row" class="table-light">إجمالي الأصول الثابتة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 3) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="extra_assets financial_info">
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

        <tr class="table-light total_fixed_assets_total">
            <th scope="row" class="table-light">مجموع الموجودات غير المتداولة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        <tr class="table-light assets_total">
            <th scope="row" class="table-light">إجمالي الموجودات</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 2)->where('FINANCIAL_INFO_SUB_TYPE_ID', 4) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="current_liabilities financial_info">
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

        <tr class="table-light current_liabilities_total">
            <th scope="row" class="table-light">إجمالي المطلوبات المتداولة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 2)->where('FINANCIAL_INFO_SUB_TYPE_ID', 5) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="fixed_liabilities financial_info">
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

        <tr class="table-light fixed_liabilities_total">
            <th scope="row" class="table-light">إجمالي المطلوبات طويلة الأجل</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        <tr class="table-light liabilities_total">
            <th scope="row" class="table-light">إجمالي المطلوبات</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        @php $list = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 3) @endphp
        <?php $p_count=0 ?>
        @foreach($list as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="all_property financial_info">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center number-format-input {{$item['FINANCIAL_INFO_ID']==22?'integer-only':'number-only'}}" name="LAST_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center"><input class="form-control table-input text-center number-format-input {{$item['FINANCIAL_INFO_ID']==22?'integer-only':'number-only'}}" name="THIS_YEAR_VALUE" disabled value="-"></td>
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

        <tr class="table-light property_total">
            <th scope="row" class="table-light">إجمالي حقوق الملكية</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        <tr class="table-light liabilities_property_total">
            <th scope="row" class="table-light">إجمالي حقوق الملكية والمطلوبات</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>

        </tbody>
    </table>
</div>
