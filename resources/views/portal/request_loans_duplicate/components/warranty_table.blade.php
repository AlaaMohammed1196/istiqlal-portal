@if(count($data['FUND_GUARANTEES']) > 0)
    <?php $sum = 0; ?>
    @foreach($data['FUND_GUARANTEES'] as $index=>$item)
        <tr id="warranty-{{$item['FUND_GUARANTEE_ID']}}">
            <th scope="row">{{$item['GUARANTEE_TYPE']}}</th>
            <td class="text-center">
                    <?php $sum += $item['GUARANTEE_VALUE'] ?>
                <span class="text-secondary">{{$item['GUARANTEE_VALUE']}}</span>
            </td>
            <td class="text-center"><span class="">{{$item['CURR_NAME']}}</span></td>
            <td class="text-center">
                <span class="{{$item['GUARANTEE_DESC']?'text-secondary cursor':'text-muted'}}" @if($item['GUARANTEE_DESC'])data-bs-toggle="modal" data-bs-target="#row_notes-{{$item['FUND_GUARANTEE_ID']}}"@endif><i class="fa-solid fa-circle-info"></i></span>
                @if($item['GUARANTEE_DESC'])
                    <div class="modal fade" id="row_notes-{{$item['FUND_GUARANTEE_ID']}}" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    <th scope="row" class="table-light">المجموع (مقيم بقيمة الدولار)</th>
    <td class="text-center table-light"><span class="text-secondary">{{$sum}}</span></td>
    <td class="text-center table-light"><span class=""></span></td>
    <td class="text-center table-light"><span class=""></span></td>
    <td  class="text-center table-light" width="15%"></td>
    </tr>
@endif
