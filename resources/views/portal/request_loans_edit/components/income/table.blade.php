<div class="table-responsive">
    <table class="table align-middle">
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
        @php $current_assets = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 5) @endphp
        <?php $p_count=0 ?>
        @php $p_sub_sum = 0; $p_year_sum = 0; @endphp
        @foreach($current_assets as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = $value['THIS_YEAR_VALUE'] - $value['LAST_YEAR_VALUE'];
                    $p_sub_sum = $p_count==0?$sub:$p_sub_sum-$sub;
                    $p_year_sum = $p_count==0?$year:$p_year_sum-$year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="income-1 profit-{{$p_count}}">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="LAST_YEAR_VALUE" disabled value="{{$sub}}"></td>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="THIS_YEAR_VALUE" disabled value="{{$year}}"></td>
                <td class="text-center differance">{{$diff}}</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FUND_ID" value="{{$data['Fund_Data'][0]['FUND_ID']}}" disabled hidden>
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
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{$p_sub_sum}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{$p_year_sum}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{$p_year_sum-$p_sub_sum}}"></td>
            <td class="text-center table-light" width="15%"></td>
        </tr>
        @php $current_assets = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 6) @endphp
        @php $exp_sub_sum = 0; $exp_year_sum = 0; @endphp
        @foreach($current_assets as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = $value['THIS_YEAR_VALUE'] - $value['LAST_YEAR_VALUE'];
                    $exp_sub_sum += $sub;
                    $exp_year_sum  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="income-2">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="LAST_YEAR_VALUE" disabled value="{{$sub}}"></td>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="THIS_YEAR_VALUE" disabled value="{{$year}}"></td>
                <td class="text-center differance">{{$diff}}</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FUND_ID" value="{{$data['Fund_Data'][0]['FUND_ID']}}" disabled hidden>
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
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{$exp_sub_sum}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{$exp_year_sum}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{$exp_year_sum - $exp_sub_sum}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>
        <tr  class="table-light total-before-running">
            <th scope="row" class="table-secondary">صافي الربح (الخسارة) التشغيلي قبل الضرائب</th>
            <td class="text-center table-secondary"><input class="form-control table-input sub text-center" disabled value="{{$p_sub_sum-$exp_sub_sum}}"></td>
            <td class="text-center table-secondary"><input class="form-control table-input year text-center" disabled value="{{$p_year_sum-$exp_year_sum}}"></td>
            <td class="text-center table-secondary"><input class="form-control table-input diff text-center" disabled value="{{($p_year_sum-$exp_year_sum)-($p_sub_sum-$exp_sub_sum)}}"></td>
            <td  class="text-center table-secondary" width="15%"></td>
        </tr>
        @php $current_assets = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 7) @endphp
        <?php $i_count=0 ?>
        @php $oth_sub_sum = 0; $oth_year_sum = 0; @endphp
        @foreach($current_assets as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = $value['THIS_YEAR_VALUE'] - $value['LAST_YEAR_VALUE'];
                    $oth_sub_sum += $sub;
                    $oth_year_sum  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="income-3 other-income-{{$i_count}}">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="LAST_YEAR_VALUE" disabled value="{{$sub}}"></td>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="THIS_YEAR_VALUE" disabled value="{{$year}}"></td>
                <td class="text-center differance">{{$diff}}</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FUND_ID" value="{{$data['Fund_Data'][0]['FUND_ID']}}" disabled hidden>
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
        <tr class="table-light total-before">
            <th scope="row" class="table-light">صافي الربح (الخسارة) قبل الضرائب</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{($p_sub_sum-$exp_sub_sum)+$oth_sub_sum}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{($p_year_sum-$exp_year_sum)+$oth_year_sum}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{(($p_year_sum-$exp_year_sum)+$oth_year_sum)-(($p_sub_sum-$exp_sub_sum)+$oth_sub_sum)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>
        @php $current_assets = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 8) @endphp
        <?php $o_count=0 ?>
        @php $o_sub_sum = 0; $o_year_sum = 0; @endphp
        @foreach($current_assets as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = $value['THIS_YEAR_VALUE'] - $value['LAST_YEAR_VALUE'];
                    $o_sub_sum += $sub;
                    $o_year_sum  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}" class="income-4 others-{{$o_count}}">
                <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="LAST_YEAR_VALUE" disabled value="{{$sub}}"></td>
                <td class="text-center"><input class="form-control table-input text-center number-only" name="THIS_YEAR_VALUE" disabled value="{{$year}}"></td>
                <td class="text-center differance">{{$diff}}</td>
                <td  class="text-center" width="15%">
                    <input class="form-control table-input text-center" name="FUND_ID" value="{{$data['Fund_Data'][0]['FUND_ID']}}" disabled hidden>
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
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{(($p_sub_sum-$exp_sub_sum)+$oth_sub_sum)-$o_sub_sum}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{(($p_year_sum-$exp_year_sum)+$oth_year_sum)-$o_year_sum}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{((($p_year_sum-$exp_year_sum)+$oth_year_sum)-$o_year_sum)-((($p_sub_sum-$exp_sub_sum)+$oth_sub_sum)-$o_sub_sum)}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>
        </tbody>
    </table>

</div>
