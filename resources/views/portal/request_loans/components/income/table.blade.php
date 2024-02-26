<div class="table-responsive">
    <table class="table align-middle">
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
        @php $current_assets = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 5) @endphp
        <?php $p_count=0 ?>
        @foreach($current_assets as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="income-1 profit-{{$p_count}}">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="LAST_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="THIS_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center differance">-</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FUND_ID" value="-" disabled hidden>
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-success align-top mx-2 d-none row-save-btn" data-class="total-1" data-type="4" data-sub="1" type="button">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </td>
            </tr>
            <?php $p_count+=1 ?>
        @endforeach
        <tr class="total-1">
            <th scope="row" class="table-light">الربح الإجمالي</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td class="text-center table-light" width="15%"></td>
        </tr>
        @php $current_assets = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 6) @endphp
        @foreach($current_assets as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="income-2">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="LAST_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="THIS_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center differance">-</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FUND_ID" value="-" disabled hidden>
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-success align-top mx-2 d-none row-save-btn" data-class="total-2" data-type="4" data-sub="2" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        <tr class="table-light total-2">
            <th scope="row" class="table-light">مجموع المصاريف</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>
        <tr  class="table-light total-before-running">
            <th scope="row" class="table-secondary">صافي الربح (الخسارة) التشغيلي قبل الضرائب</th>
            <td class="text-center table-secondary"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-secondary"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-secondary"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-secondary" width="15%"></td>
        </tr>
        @php $current_assets = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 7) @endphp
        <?php $i_count=0 ?>
        @foreach($current_assets as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="income-3 other-income-{{$i_count}}">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="LAST_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="THIS_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center differance">-</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FUND_ID" value="-" disabled hidden>
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-success align-top mx-2 d-none row-save-btn" data-type="4" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </td>
            </tr>
            <?php $i_count+=1 ?>
        @endforeach
        <tr  class="table-light total-before">
            <th scope="row" class="table-light">صافي الربح (الخسارة) قبل الضرائب</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>
        @php $current_assets = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 8) @endphp
        <?php $o_count=0 ?>
        @foreach($current_assets as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="income-4 others-{{$o_count}}">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="LAST_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="THIS_YEAR_VALUE" disabled value="-"></td>
                <td class="text-center differance">-</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FUND_ID" value="-" disabled hidden>
                    <input class="form-control table-input text-center" name="FINANCIAL_INFO_ID" disabled value="{{$item['FINANCIAL_INFO_ID']}}" hidden>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2 row-edit-btn" onclick="edit_row(this);" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-success align-top mx-2 d-none row-save-btn" data-type="4" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </td>
            </tr>
            <?php $o_count+=1 ?>
        @endforeach
        <tr  class="table-light total-after">
            <th scope="row" class="table-light">صافي الربح (الخسارة) بعد الضريبة</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>
        </tbody>
    </table>

</div>
