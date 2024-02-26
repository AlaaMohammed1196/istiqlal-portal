<?php $warranty_values = collect($data['FUND_GUARANTEES'])->where('IS_BAIL_FLAG', '!=', 1) ?>
@if(count($warranty_values) > 0)
    <?php $sum = 0; ?>
    @foreach($warranty_values as $index=>$item)
        <tr id="warranty-{{$item['FUND_GUARANTEE_ID']}}">
            <th scope="row">{{$item['GUARANTEE_TYPE']}}</th>
            <td class="text-center">
                    <?php $sum += $item['GUARANTEE_VALUE'] ?>
                <span class="text-secondary">{{number_format($item['GUARANTEE_VALUE'], 2)}}</span>
            </td>
            <td class="text-center"><span class="">{{$item['CURR_NAME']}}</span></td>
            <td class="text-center">
                <span class="{{$item['GUARANTEE_DESC']?'text-secondary cursor':'text-muted'}}" @if($item['GUARANTEE_DESC'])data-bs-toggle="modal" data-bs-target="#row_notes-{{$item['FUND_GUARANTEE_ID']}}"@endif><i class="fa-solid fa-circle-info"></i></span>
                @if($item['GUARANTEE_DESC'])
                    <div class="modal fade" id="row_notes-{{$item['FUND_GUARANTEE_ID']}}" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                                </div>
                                <div class="modal-body wizard" id="wizardBasic">
                                    <p>{{$item['GUARANTEE_DESC']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </td>
            <td  class="text-center" width="15%">
                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2" type="button" data-key="{{$index}}" onclick="editWarrantyRecord(this)">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top" type="button" data-id="{{$item['FUND_GUARANTEE_ID']}}" onclick="deleteWarrantyRecord(this)">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
            </td>
        </tr>
    @endforeach
    <tr class="table-light">
        <th scope="row" class="table-light">المجموع</th>
        <td class="text-center table-light"><span class="text-secondary">{{number_format($data['TOTAL_FUND_GUARANTEES'], 2)}}</span></td>
        <td class="text-center table-light"><span class="total_currency_here">{{$currency}}</span></td>
        <td class="text-center table-light"><span class=""></span></td>
        <td  class="text-center table-light" width="15%"></td>
    </tr>
@else
    <tr class="table-light">
        <td colspan="5" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد ضمانات حتى الآن</td>
    </tr>
@endif
