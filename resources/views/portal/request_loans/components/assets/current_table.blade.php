<div class="table-responsive">
    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col" width="40%">الموجودات</th>
            <th scope="col" class="text-center">سنة <span class="col-sub">{{now()->subYear()->year}}</span></th>
            <th scope="col" class="text-center">سنة <span class="col-year">{{now()->year}}</span></th>
            <th scope="col" class="text-center">التغيير</th>
            <th scope="col" class="text-center">أدوات</th>
        </tr>
        </thead>
        <tbody>
        @php $current_assets = collect($constants['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 1) @endphp
        @foreach($current_assets as $item)
            <tr id="info-{{$item['FINANCIAL_INFO_ID']}}">
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
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-success align-top mx-2 d-none row-save-btn" data-type="1" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        <tr class="table-light">
            <th scope="row" class="table-light">المجموع</th>
            <td class="text-center table-light"><input class="form-control table-input sub text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input year text-center" disabled value="0"></td>
            <td class="text-center table-light"><input class="form-control table-input diff text-center" disabled value="0"></td>
            <td  class="text-center table-light" width="15%"></td>
        </tr>
        </tbody>
    </table>
</div>
