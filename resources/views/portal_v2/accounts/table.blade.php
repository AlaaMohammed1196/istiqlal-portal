<div class="table-responsive">
    <table class="table table-striped align-middle table-sortable">
        <thead>
        <tr>
            <th scope="col" class="sorted-column {{$sort['col']=='ACCOUNT_NUM'?$sort['type']:''}}" data-name="ACCOUNT_NUM">رقم الحساب</th>
            <th scope="col" class="sorted-column {{$sort['col']=='PROFILE_NAME'?$sort['type']:''}}" data-name="PROFILE_NAME" style="word-wrap: break-word;">اسم الحساب</th>
            <th scope="col" class="sorted-column {{$sort['col']=='ACCOUNT_TYPE_DESC'?$sort['type']:''}}" data-name="ACCOUNT_TYPE_DESC">نوع الحساب</th>
            <th scope="col" class="sorted-column {{$sort['col']=='CURR_NAME_DESC'?$sort['type']:''}}" data-name="CURR_NAME_DESC" style="word-wrap: break-word;">عملة الحساب</th>
            <th scope="col" class="sorted-column {{$sort['col']=='ACCOUNT_BALANCE'?$sort['type']:''}}" data-name="ACCOUNT_BALANCE">الرصيد الحالي</th>
            <th scope="col" class="sorted-column {{$sort['col']=='AVAILABLE_BALANCE'?$sort['type']:''}}" data-name="AVAILABLE_BALANCE">الرصيد المتوفر</th>
            <th scope="col" class="text-center">أدوات</th>
        </tr>
        </thead>
        <tbody id="table_view">
        @if(count($accounts) > 0)
            @foreach($accounts as $index=>$item)
                <tr>
                    <td><span class="text-dark" dir="ltr">{{$item['ACCOUNT_NUM']}}</span></td>
                    <td><span class="text-dark"><strong>{{$item['PROFILE_NAME']}}</strong></span></td>
                    <td><span class="text-dark"><strong>{{$item['ACCOUNT_TYPE_DESC']}}</strong></span></td>
                    <td><span class="text-dark"><strong>{{$item['CURR_NAME_DESC']}}</strong></span></td>
                    <td><span class="text-dark" dir="ltr">{{NumberFormat($item['ACCOUNT_BALANCE'], $item['CURR_DECIMAL_PLACES'])}}</span></td>
                    <td><span class="text-dark" dir="ltr">{{NumberFormat($item['AVAILABLE_BALANCE'], $item['CURR_DECIMAL_PLACES'])}}</span></td>
                    <td  class="text-center">
                        <a href="{{route('portal.v2.accounts.show', $index)}}" class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top ms-2"
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
