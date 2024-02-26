<div class="table-responsive">
    <table class="table table-striped align-middle table-sortable">
        <thead>
        <tr>
            <th scope="col" class="" style="word-wrap: break-word;">من حساب</th>
{{--            <th scope="col" class="" style="word-wrap: break-word;">إلى حساب</th>--}}
            <th scope="col" class="text-center sorted-column {{$sort['col']=='AMOUNT'?$sort['type']:''}}" data-name="AMOUNT">المبلغ</th>
{{--            <th scope="col" class="text-center sorted-column {{$sort['col']=='REMITTANCE_PURPOSE_NA'?$sort['type']:''}}" data-name="REMITTANCE_PURPOSE_NA">الغرض من الحوالة</th>--}}
            <th scope="col" class="text-center sorted-column {{$sort['col']=='TRANSFER_DATE'?$sort['type']:''}}" data-name="TRANSFER_DATE" data-isDate="1">تاريخ الحوالة</th>
            <th scope="col" class="text-center">رقم الحوالة</th>
            <th scope="col" class="text-center">ملاحظات</th>
            <th scope="col" class="text-center">أدوات</th>
        </tr>
        </thead>
        <tbody>
        @if(count($transfers) > 0)
            @foreach($transfers as $index=>$item)
                <tr>
                    <td scope="row">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="">
                                <div><strong>{{$item['FROM_ACCOUNT_NAME']}}</strong></div>
                                <div><strong>{{$item['FROM_LEDGER_NAME']}} - {{$item['FROM_CURR_NAME']}}</strong></div>
                            </div>
                        </div>
                    </td>
{{--                    <td scope="row">--}}
{{--                        <div class="d-flex justify-content-start align-items-center">--}}
{{--                            <div class="">--}}
{{--                                @if($item['PAY_TYPE_ID'] == 7)--}}
{{--                                    <div><strong>{{$item['BANK_NAME']}} - {{$item['BANK_BRANCH_NAME']}}</strong></div>--}}
{{--                                    <div><strong>{{$item['IBAN']}}</strong></div>--}}
{{--                                @else--}}
{{--                                    <div><strong>{{$item['TO_ACCOUNT_NAME']}}</strong></div>--}}
{{--                                    <div><strong>{{$item['TO_LEDGER_NAME']}} - {{$item['TO_CURR_NAME']}}</strong></div>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
                    <td class="text-center"><span class="text-dark">{{NumberFormat($item['AMOUNT'], $item['CURR_DECIMAL_PLACES'])}} {{$item['CURR_NAME']}}</span></td>
{{--                    <td class="text-center"><span class="text-dark">{{$item['REMITTANCE_PURPOSE_NA']}}</span></td>--}}
                    <td class="text-center"><span class="text-dark">{{Carbon\Carbon::parse($item['TRANSFER_DATE'])->translatedFormat('d/m/Y')}}</span></td>
                    <td class="text-center">{{$item['VOUCHER_NO']}}</td>
                    <td class="text-center">
                        <button class="btn p-0 display_notes {{$item['NOTES']?'text-secondary':'text-muted'}}" @if($item['NOTES'])data-notes="{{$item['NOTES']}}" @else disabled @endif><i class="fa-solid fa-circle-info"></i></button>
                    </td>
                    <td  class="text-center">
                        <a href="javascript:void(0);" role="button" data-id="{{$item['VOUCHER_NO']}}" class="display_details btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top mx-1"
                           data-bs-toggle="tooltip" data-bs-title="عرض التفاصيل">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <button type="button" data-id="{{$item['VOUCHER_NO']}}" class="transfer_to_pdf btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top mx-1"
                                data-bs-toggle="tooltip" data-bs-title="طباعة الطلب">
                            <i class="fa-solid fa-print"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
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
