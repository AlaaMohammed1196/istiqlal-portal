<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead>
        <tr>
            <th scope="col" class="sorted-column {{$sort['col']=='TICKET_ID'?$sort['type']:''}}" data-name="TICKET_ID" style="word-wrap: break-word;">رقم التذكرة</th>
            <th scope="col" class="sorted-column {{$sort['col']=='TICKET_PRIORITY_DESC'?$sort['type']:''}}" data-name="TICKET_PRIORITY_DESC">الأهمية</th>
            <th scope="col" class="sorted-column {{$sort['col']=='TICKET_TITLE'?$sort['type']:''}}" data-name="TICKET_TITLE" style="word-wrap: break-word;">العنوان</th>
            <th scope="col" class="sorted-column {{$sort['col']=='CREATED_ON'?$sort['type']:''}}" data-name="CREATED_ON" data-isDate="1">التاريخ</th>
            <th scope="col" class="sorted-column {{$sort['col']=='TICKET_STATUS_DESC'?$sort['type']:''}}" data-name="TICKET_STATUS_DESC">الحالة</th>
            <th scope="col" class="text-center">الوصف</th>
        </tr>
        </thead>
        <tbody id="table_view">
        @if(count($tickets) > 0)
            @foreach($tickets as $item)
                <tr id="ticket-{{$item['TICKET_ID']}}">
                    <td><span class="text-dark"><strong>{{$item['TICKET_ID']}}</strong></span></td>
                    <td>
                        @if($item['TICKET_PRIORITY_ID'] == 1)
                            <span class="text-danger">{{$item['TICKET_PRIORITY_DESC']}}</span>
                        @elseif($item['TICKET_PRIORITY_ID'] == 2)
                            <span class="text-warning">{{$item['TICKET_PRIORITY_DESC']}}</span>
                        @else
                            <span class="text-dark">{{$item['TICKET_PRIORITY_DESC']}}</span>
                        @endif

                    </td>
                    <td><span class="text-dark">{{$item['TICKET_TITLE']}}</span></td>
                    <td><span class="text-dark">{{Carbon\Carbon::parse($item['CREATED_ON'])->translatedFormat('d/m/Y')}}</span></td>
                    <td>@if($item['TICKET_STATUS_ID']==1)
                        <span class="text-warning">{{$item['TICKET_STATUS_DESC']}}</span>
                        @elseif($item['TICKET_STATUS_ID']==2)
                        <span class="text-danger">{{$item['TICKET_STATUS_DESC']}}</span>
                        @elseif($item['TICKET_STATUS_ID']==3)
                        <span class="text-success">{{$item['TICKET_STATUS_DESC']}}</span>
                        @elseif($item['TICKET_STATUS_ID']==4)
                        <span class="text-info">{{$item['TICKET_STATUS_DESC']}}</span>
                        @else
                            <span class="text-dark">{{$item['TICKET_STATUS_DESC']}}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button role="button" class="btn p-0 display_notes {{$item['TICKET_DESCRIPTION']?'text-secondary':'text-muted'}}" @if($item['TICKET_DESCRIPTION'])data-notes="{{$item['TICKET_DESCRIPTION']}}" @else disabled @endif><i class="fa-solid fa-circle-info"></i></button>
                    </td>
                    <td class="text-center">
                        <a href="{{route('portal.v2.tickets.show', $item['TICKET_ID'])}}" class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top ms-2"
                           data-bs-toggle="tooltip" data-bs-title="عرض التفاصيل">
                            <i class="fa-solid fa-eye"></i>
                        </a>
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

@if($pages['allPagesCount'] > 1)
    <div class="w-100 d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item prev {{$pages['current_page']==1?'disabled':''}}">
                <a class="page page-link shadow" data-page="{{$pages['current_page']-1}}" href="javascript:void(0)">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </li>
            @for($i=1; $i<=$pages['allPagesCount']; ++$i)
                @if(($i == $pages['current_page']+2 && $i != $pages['allPagesCount']) || ($i == $pages['current_page']-2 && $i != 1))
                    <li class="page-item disabled">
                        <a class="page page-link shadow" href="javascript:void(0)">...</a>
                    </li>
                @elseif(($i > $pages['current_page']+2 && $i != $pages['allPagesCount']) || ($i < $pages['current_page']-2 && $i != 1))
                @else
                    <li class="page-item {{$pages['current_page']==$i?'active':''}}">
                        <a class="page page-link shadow" data-page="{{$i}}" href="javascript:void(0)">{{$i}}</a>
                    </li>
                @endif
            @endfor
            <li class="page-item next {{$pages['current_page']==$pages['allPagesCount']?'disabled':''}}">
                <a class="page page-link shadow" data-page="{{$pages['current_page']+1}}" href="javascript:void(0)">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </li>
        </ul>
    </div>
@endif
