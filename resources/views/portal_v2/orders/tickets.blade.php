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
        @if(count($tickets) > 0)
            @foreach($tickets as $item)
                <tr class="transfer_order" id="order3-{{$item['TICKET_SEQ']}}">
                    <td scope="row" class="text-end">طلب تذكرة</td>
                    <td>{{$item['TICKET_SEQ']}}</td>
                    <td>{{$item['CREATED_ON']?Carbon\Carbon::parse($item['CREATED_ON'])->translatedFormat('d/m/Y'):''}}</td>
                    <td>{{$item['APPROVAL_STATUS_DESC']}}</td>
                    <td>@if(isset($item['IS_IMPORTANT']) && $item['IS_IMPORTANT']==1) نعم @else لا @endif</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="javascript:void(0);" role="button" data-type="3" data-seq="{{$item['TICKET_SEQ']}}" data-status="{{$item['APPROVAL_STATUS_ID']}}" class="request_details btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top mx-1"
                               data-bs-toggle="tooltip" data-bs-title="عرض التفاصيل">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @if($item['APPROVAL_STATUS_ID'] != 1)
                                <a href="javascript:void(0);" role="button" data-answer="-1" data-type="3" data-seq="{{$item['TICKET_SEQ']}}" data-id="{{$item['TICKET_ID']}}" class="step_request btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top mx-1"
                                   data-bs-toggle="tooltip" data-bs-title="عرض خطوات الطلب">
                                    <i class="fa-solid fa-list"></i>
                                </a>
                            @endif
                            @if($item['APPROVAL_STATUS_ID'] == 1)
                                <a href="javascript:void(0);" role="button" data-answer="1" data-type="3" data-seq="{{$item['TICKET_SEQ']}}" data-id="{{$item['TICKET_ID']}}" class="step_request btn btn-sm btn-icon btn-icon-only btn-outline-success align-top mx-1"
                                   data-bs-toggle="tooltip" data-bs-title="الموافقة على الطلب">
                                    <i class="fa-solid fa-circle-check"></i>
                                </a>
                            @endif
                            @if($item['APPROVAL_STATUS_ID'] == 1)
                            <button href="javascript:void(0);" role="button" data-answer="0" data-type="3" data-seq="{{$item['TICKET_SEQ']}}" data-id="{{$item['TICKET_ID']}}" {{$item['APPROVAL_STATUS_ID']!=1?'disabled':''}} class="step_request btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top mx-1"
                               data-bs-toggle="tooltip" data-bs-title="رفض الطلب">
                                <i class="fa-solid fa-ban"></i>
                            </button>
                            @endif
                            @if($item['APPROVAL_STATUS_ID'] == 1)
                                <a href="javascript:void(0);" role="button" data-answer="4" data-type="3" data-seq="{{$item['TICKET_SEQ']}}" data-id="{{$item['TICKET_ID']}}" class="reject_request btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top mx-1"
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

@if($ticket_pages['allPagesCount'] > 1)
    <div class="w-100 d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item prev {{$ticket_pages['current_page']==1?'disabled':''}}">
                <a class="page page-link shadow" data-type="2" data-page="{{$ticket_pages['current_page']-1}}" href="javascript:void(0)">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </li>
            @for($i=1; $i<=$ticket_pages['allPagesCount']; ++$i)
                @if(($i == $ticket_pages['current_page']+2 && $i != $ticket_pages['allPagesCount']) || ($i == $ticket_pages['current_page']-2 && $i != 1))
                    <li class="page-item disabled">
                        <a class="page page-link shadow" href="javascript:void(0)">...</a>
                    </li>
                @elseif(($i > $ticket_pages['current_page']+2 && $i != $ticket_pages['allPagesCount']) || ($i < $ticket_pages['current_page']-2 && $i != 1))
                @else
                    <li class="page-item {{$ticket_pages['current_page']==$i?'active':''}}">
                        <a class="page page-link shadow" data-type="2" data-page="{{$i}}" href="javascript:void(0)">{{$i}}</a>
                    </li>
                @endif
            @endfor
            <li class="page-item next {{$ticket_pages['current_page']==$ticket_pages['allPagesCount']?'disabled':''}}">
                <a class="page page-link shadow" data-type="2" data-page="{{$ticket_pages['current_page']+1}}" href="javascript:void(0)">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </li>
        </ul>
    </div>
@endif
