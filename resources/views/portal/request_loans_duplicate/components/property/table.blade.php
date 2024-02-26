<div class="table-responsive">
    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col"  width="40%">البند</th>
            <th scope="col" class="text-center">سنة <span class="col-sub">{{$data['Fund_Data'][0]['LAST_YEAR']}}</span></th>
            <th scope="col" class="text-center">سنة <span class="col-year">{{$data['Fund_Data'][0]['THIS_YEAR']}}</span></th>
            <th scope="col"  class="text-center">التغيير</th>
            <th scope="col" class="text-center">أدوات</th>
        </tr>
        </thead>
        <tbody>
        @php $current_assets = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 3) @endphp
        @php $p_sub_sum = 0; $p_year_sum = 0; @endphp
        @foreach($current_assets as $item)
            @php
                $value = collect($data['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_ID', $item['FINANCIAL_INFO_ID'])->first();
                if($value){
                    $sub = $value['LAST_YEAR_VALUE'];
                    $year = $value['THIS_YEAR_VALUE'];
                    $diff = $value['THIS_YEAR_VALUE'] - $value['LAST_YEAR_VALUE'];
                    $p_sub_sum += $sub;
                    $p_year_sum  += $year;
                }else{
                    $sub = '-';
                    $year = '-';
                    $diff = '-';
                }
            @endphp
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}">
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
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-success align-top mx-2 d-none row-save-btn" data-type="3" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        <tr class="table-light total-rights">
            <th scope="row" class="table-light">صافى حقوق الملكية</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="{{$p_sub_sum}}"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="{{$p_year_sum}}"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="{{$p_year_sum-$p_sub_sum}}"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>
        <tr class="bg-primary">
            <th scope="row" class="bg-primary text-white">مجموع الخصوم (المطلوبات + حقوق الملكية)</th>
            <td class="text-center bg-primary"><input class="form-control table-input text-white total_sub_2 text-center" readonly value="0"></td>
            <td class="text-center bg-primary"><input class="form-control table-input text-white total_year_2 text-center" readonly value="0"></td>
            <td class="text-center bg-primary"><input class="form-control table-input text-white total_diff_2 text-center" readonly value="0"></td>
            <td  class="text-center bg-primary" width="15%"></td>
        </tr>
        </tbody>
    </table>
</div>
