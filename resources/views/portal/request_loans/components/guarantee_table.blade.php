<?php $guarantee_values = collect($data['FUND_GUARANTEES'])->where('IS_BAIL_FLAG', 1) ?>
@if(count($guarantee_values) > 0)
    <?php $sum = 0; ?>
    @foreach($guarantee_values as $index=>$item)
        <tr id="warranty-{{$item['FUND_GUARANTEE_ID']}}">
            <th scope="row">{{$item['GUARANTEE_TYPE']}}</th>
            <td class="text-center">
                <?php $sum += $item['GUARANTEE_VALUE'] ?>
                <span class="text-secondary">{{number_format($item['GUARANTEE_VALUE'], 2)}}</span>
            </td>
            <td class="text-center"><span class="">{{$item['CURR_NAME']}}</span></td>
            <th class="text-center">{{$item['SALARY_TYPE_DESC']}}</th>
            <td  class="text-center" width="15%">
                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2" type="button" data-key="{{$index}}" onclick="editGuaranteeRecord(this)">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top" type="button" data-id="{{$item['FUND_GUARANTEE_ID']}}" onclick="deleteGuaranteeRecord(this)">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
            </td>
        </tr>
    @endforeach
    <tr class="table-light">
        <th scope="row" class="table-light">المجموع</th>
        <td class="text-center table-light"><span class="text-secondary">{{number_format($data['TOTAL_FUND_PERSONS_GUARANTEE'], 2)}}</span></td>
        <td class="text-center table-light"><span class="total_currency_here">{{$currency}}</span></td>
        <td  class="text-center table-light"></td>
        <td  class="text-center table-light" width="15%"></td>
    </tr>
@else
    <tr class="table-light">
        <td colspan="5" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد كفالات حتى الآن</td>
    </tr>
@endif
