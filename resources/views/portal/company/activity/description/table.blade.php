@if(count($data['CompanySellingMethods']) > 0)
    @foreach($data['CompanySellingMethods'] as $index=>$item)
        <tr id="item-{{$item['METHOD_ID']}}" class="tr-item">
            <th scope="row">
                <span>{{$item['SELLING_METHOD']}}</span>
            </th>
            <td class="text-center">
                <span class="text-secondary">{{$item['METHOD_PERCENT']}}%</span>
            </td>
            <td class="text-center" width="15%">
                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2" data-key="{{$index}}" onclick="editRecord(this)" type="button">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_item" data-id="{{$item['METHOD_ID']}}" onclick="deleteRecord(this)" type="button">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="3" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
    </tr>
@endif
