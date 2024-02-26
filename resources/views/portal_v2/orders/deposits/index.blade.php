<div class="table-responsive">
    <table class="table table-striped align-middle text-center">
        <thead>
        <tr>
            <th scope="col" class="text-end" style="word-wrap: break-word;">الطلب</th>
            <th scope="col" class="text-center">رقم الطلب</th>
            <th scope="col" class="text-center">تاريخ الطلب</th>
            <th scope="col" class="text-center">حالة الطلب</th>
            <th scope="col" class="text-center">حالة الوديعة</th>
            <th scope="col" class="text-center">بحاجة لمراجعتي</th>
            <th scope="col" class="text-center">أدوات</th>
        </tr>
        </thead>
        <tbody>
        @if(count($deposits) > 0)
            @foreach($deposits as $item)
                <tr id="order4-{{$item['DEPOSIT_SEQ']}}">
                    <td scope="row" class="text-end">{{$item['DEPOSIT_CHANGE_TYPE_DESC']}}</td>
                    <td>{{$item['DEPOSIT_SEQ']}}</td>
                    <td>{{$item['CREATED_ON']?Carbon\Carbon::parse($item['CREATED_ON'])->translatedFormat('d/m/Y'):''}}</td>
                    <td>{{$item['APPROVAL_STATUS_DESC']}}</td>
                    <td>{{$item['DEPOSIT_STATUS_DESC']}}</td>
                    <td>@if(isset($item['IS_IMPORTANT']) && $item['IS_IMPORTANT']==1) نعم @else لا @endif</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="javascript:void(0);" role="button" data-type="4" data-seq="{{$item['DEPOSIT_SEQ']}}" data-status="{{$item['APPROVAL_STATUS_ID']}}" class="request_details btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top ms-1"
                               data-bs-toggle="tooltip" data-bs-title="عرض التفاصيل">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @if(!in_array(1, array_column(Session::get('userData')['USER_ROLES'], 'ROLE_ID')))
                            <a href="javascript:void(0);" role="button" data-status="{{$item['APPROVAL_STATUS_ID']}}" data-type="4" data-seq="{{$item['DEPOSIT_SEQ']}}" data-id="" class="step_request btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top ms-1"
                               data-bs-toggle="tooltip" data-bs-title="خطوات الطلب">
                                <i class="fa-solid fa-list"></i>
                            </a>
                            @endif
                            @if($item['APPROVAL_STATUS_ID'] == 1 && in_array(1, array_column(Session::get('userData')['USER_ROLES'], 'ROLE_ID')))
                                <a href="javascript:void(0);" role="button" data-answer="4" data-type="4" data-seq="{{$item['DEPOSIT_SEQ']}}" data-id="" class="reject_request btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top ms-1"
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

@if($deposit_pages['allPagesCount'] > 1)
    <div class="w-100 d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item prev {{$deposit_pages['current_page']==1?'disabled':''}}">
                <a class="page page-link shadow" data-type="2" data-page="{{$deposit_pages['current_page']-1}}" href="javascript:void(0)">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </li>
            @for($i=1; $i<=$deposit_pages['allPagesCount']; ++$i)
                @if(($i == $deposit_pages['current_page']+2 && $i != $deposit_pages['allPagesCount']) || ($i == $deposit_pages['current_page']-2 && $i != 1))
                    <li class="page-item disabled">
                        <a class="page page-link shadow" href="javascript:void(0)">...</a>
                    </li>
                @elseif(($i > $deposit_pages['current_page']+2 && $i != $deposit_pages['allPagesCount']) || ($i < $deposit_pages['current_page']-2 && $i != 1))
                @else
                    <li class="page-item {{$deposit_pages['current_page']==$i?'active':''}}">
                        <a class="page page-link shadow" data-type="2" data-page="{{$i}}" href="javascript:void(0)">{{$i}}</a>
                    </li>
                @endif
            @endfor
            <li class="page-item next {{$deposit_pages['current_page']==$deposit_pages['allPagesCount']?'disabled':''}}">
                <a class="page page-link shadow" data-type="2" data-page="{{$deposit_pages['current_page']+1}}" href="javascript:void(0)">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </li>
        </ul>
    </div>
@endif
