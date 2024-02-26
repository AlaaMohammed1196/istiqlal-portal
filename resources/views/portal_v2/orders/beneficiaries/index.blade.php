<div class="table-responsive">
    <table class="table table-striped align-middle text-center">
        <thead>
        <tr>
            <th scope="col" class="text-end" style="word-wrap: break-word;">الطلب</th>
            <th scope="col" class="text-center">رقم الطلب</th>
            <th scope="col" class="text-center">تاريخ الطلب</th>
            <th scope="col" class="text-center">الحالة</th>
            <th scope="col" class="text-center">بحاجة لمراجعتي</th>
            <th scope="col" class="text-center">أدوات</th>
        </tr>
        </thead>
        <tbody>
        @if(count($beneficiaries) > 0)
            @foreach($beneficiaries as $item)
                <tr class="beneficiary_order" id="order1-{{$item['BENEFICIARY_SEQ']}}">
                    <td scope="row" class="text-end">
                        @if($item['BANK_LOCATION'] == 1)
                            <strong>طلب {{$item['CHANGE_TYPE_DESC']}} مستفيد داخل فلسطين</strong>
                        @elseif($item['BANK_LOCATION'] == 2)
                            <strong>طلب {{$item['CHANGE_TYPE_DESC']}} مستفيد خارج فلسطين</strong>
                        @else
                            <strong>طلب {{$item['CHANGE_TYPE_DESC']}} مستفيد داخل البنك</strong>
                        @endif
                    </td>
                    <td>{{$item['BENEFICIARY_SEQ']}}</td>
                    <td>{{$item['CREATED_ON']?Carbon\Carbon::parse($item['CREATED_ON'])->translatedFormat('d/m/Y'):''}}</td>
                    <td>{{$item['APPROVAL_STATUS_DESC']}}</td>
                    <td>@if($item['IS_IMPORTANT']==1) نعم @else لا @endif</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="javascript:void(0);" role="button" data-type="1" data-seq="{{$item['BENEFICIARY_SEQ']}}" data-status="{{$item['APPROVAL_STATUS_ID']}}" class="request_details btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top ms-1"
                               data-bs-toggle="tooltip" data-bs-title="عرض التفاصيل">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @if($item['IS_UPDATABLE'] == 1)
                                <a href="{{route('portal.v2.orders.beneficiaries.edit', $item['BENEFICIARY_SEQ'])}}" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top ms-1"
                                   data-bs-toggle="tooltip" data-bs-title="تعديل">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            @endif
                            @if(!in_array(1, array_column(Session::get('userData')['USER_ROLES'], 'ROLE_ID')))
                            <a href="javascript:void(0);" role="button" data-status="{{$item['APPROVAL_STATUS_ID']}}" data-type="1" data-seq="{{$item['BENEFICIARY_SEQ']}}" data-id="" class="step_request btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top ms-1"
                               data-bs-toggle="tooltip" data-bs-title="خطوات الطلب">
                                <i class="fa-solid fa-list"></i>
                            </a>
                            @endif
                            @if($item['APPROVAL_STATUS_ID'] == 1 && $item['IS_CANCELABLE'] == 1)
                                <a href="javascript:void(0);" role="button" data-answer="4" data-type="1" data-seq="{{$item['BENEFICIARY_SEQ']}}" data-id="" class="reject_request btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top ms-1"
                                   data-bs-toggle="tooltip" data-bs-title="إلغاء الطلب">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

@if($beneficiary_pages['allPagesCount'] > 1)
    <div class="w-100 d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item prev {{$beneficiary_pages['current_page']==1?'disabled':''}}">
                <a class="page page-link shadow" data-type="1" data-page="{{$beneficiary_pages['current_page']-1}}" href="javascript:void(0)">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </li>
            @for($i=1; $i<=$beneficiary_pages['allPagesCount']; ++$i)
                @if(($i == $beneficiary_pages['current_page']+2 && $i != $beneficiary_pages['allPagesCount']) || ($i == $beneficiary_pages['current_page']-2 && $i != 1))
                    <li class="page-item disabled">
                        <a class="page page-link shadow" href="javascript:void(0)">...</a>
                    </li>
                @elseif(($i > $beneficiary_pages['current_page']+2 && $i != $beneficiary_pages['allPagesCount']) || ($i < $beneficiary_pages['current_page']-2 && $i != 1))
                @else
                    <li class="page-item {{$beneficiary_pages['current_page']==$i?'active':''}}">
                        <a class="page page-link shadow" data-type="1" data-page="{{$i}}" href="javascript:void(0)">{{$i}}</a>
                    </li>
                @endif
            @endfor
            <li class="page-item next {{$beneficiary_pages['current_page']==$beneficiary_pages['allPagesCount']?'disabled':''}}">
                <a class="page page-link shadow" data-type="1" data-page="{{$beneficiary_pages['current_page']+1}}" href="javascript:void(0)">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </li>
        </ul>
    </div>
@endif
