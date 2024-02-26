@if(count($policy) > 0)
    @foreach($policy as $index=>$item)
        <tr id="policy-{{$item['BUY_SELL_ID']}}">
            <th scope="row">{{$item['BUY_SELL_SUB_FLAG_DESC']}}</th>
            <td class="text-center"><span class="text-secondary">{{$item['COMMERCE_POLICY_PERCENT']}}%</span></td>
            <td class="text-center"><span class="">{{$item['COMMERCE_POLICY_PERIOD']}} يوم</span></td>
            <td class="text-center">
                <span class="{{$item['NOTES']?'text-secondary cursor':'text-muted'}}" @if($item['NOTES'])data-bs-toggle="modal" data-bs-target="#row_notes_{{$item['BUY_SELL_ID']}}"@endif><i class="fa-solid fa-circle-info"></i></span>
                @if($item['NOTES'])
                <div class="modal fade" id="row_notes_{{$item['BUY_SELL_ID']}}" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body wizard" id="wizardBasic">
                                <p>{{$item['NOTES']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </td>
            <td class="text-center">
                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2" data-key="{{$index}}" onclick="editPolicyRecord(this)" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_item" data-id="{{$item['BUY_SELL_ID']}}" onclick="deletePolicyRecord(this)" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
    </tr>
@endif
<tr class="d-none">
    <td colspan="5" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
</tr>
