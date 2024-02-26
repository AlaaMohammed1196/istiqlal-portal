@if(count($data['FUND_SOURCES_CUST_CONTRIBUTION']) > 0)
    <?php $sum = 0; ?>
    @foreach($data['FUND_SOURCES_CUST_CONTRIBUTION'] as $index=>$item)
        <tr id="source-{{$item['SOURCE_ID']}}">
            <th scope="row">{{$item['SOURCE_DESC']}}</th>
            <td class="text-center">
                <?php $sum += $item['ANNUAL_SOURCE_VALUE'] ?>
                <span class="text-secondary">{{number_format($item['ANNUAL_SOURCE_VALUE'], 2)}}</span>
            </td>
            <td class="text-center"><span class="">{{$item['CURR_NAME']}}</span></td>
            <td  class="text-center" width="15%">
                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2" type="button" data-key="{{$index}}" onclick="editFundRecord(this)">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top" type="button" data-id="{{$item['SOURCE_ID']}}" onclick="deleteFundRecord(this)">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
            </td>
        </tr>
    @endforeach
    <tr  class="table-light">
        <th scope="row" class="table-light">المجموع</th>
        <td class="text-center table-light"><span class="text-secondary">{{number_format($data['TOTAL_FUND_SOURCES_CUST_CONTRIBUTION'], 2)}}</span></td>
        <td class="text-center table-light"><span class="total_currency_here">{{$currency}}</span></td>
        <td  class="text-center table-light" width="15%"></td>
    </tr>
@endif
