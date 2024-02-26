<div class="row">
    <div class="col-12 mb-5">
        <div class="card mb-2">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="checkboxTable" class="table table-striped align-middle table-sortable">
                        <thead>
                        <tr>
                            <th scope="col" class="sorted-column {{$sort['col']=='CHECK_NUM'?$sort['type']:''}}" data-name="CHECK_NUM" style="word-wrap: break-word;">رقم الشيك</th>
                            <th scope="col" class="sorted-column {{$sort['col']=='BANK_NA'?$sort['type']:''}}" data-name="BANK_NA" style="word-wrap: break-word;">البنك</th>
{{--                            <th scope="col" class="sorted-column {{$sort['col']=='SUBMITTED_BANK_NA'?$sort['type']:''}}" data-name="SUBMITTED_BANK_NA" style="word-wrap: break-word;">مرسل إلى</th>--}}
                            <th scope="col" class="text-center sorted-column {{$sort['col']=='CHECK_AMOUNT'?$sort['type']:''}}" data-name="CHECK_AMOUNT">المبلغ</th>
{{--                            <th scope="col" class="text-center sorted-column {{$sort['col']=='DEPOSIT_DATE'?$sort['type']:''}}" data-name="DEPOSIT_DATE" data-isDate="1">تاريخ الإيداع</th>--}}
                            <th scope="col" class="text-center sorted-column {{$sort['col']=='CHECK_DATE'?$sort['type']:''}}" data-name="CHECK_DATE" data-isDate="1">تاريخ الشيك</th>
                            <th scope="col" class="text-center sorted-column {{$sort['col']=='RECEIPT_DATE'?$sort['type']:''}}" data-name="RECEIPT_DATE" data-isDate="1">تاريخ الإدخال</th>
                            <th scope="col" class="text-center sorted-column {{$sort['col']=='RETURN_DATE'?$sort['type']:''}}" data-name="RETURN_DATE" data-isDate="1">تاريخ الإرجاع</th>
                            <th scope="col" class="text-center sorted-column {{$sort['col']=='CHECK_RETURN_REASON_NA'?$sort['type']:''}}" data-name="CHECK_RETURN_REASON_NA">سبب الإرجاع</th>
{{--                            <th scope="col" class="text-center sorted-column {{$sort['col']=='VOUCHER_NO'?$sort['type']:''}}" data-name="VOUCHER_NO">رقم السند</th>--}}
                            <th scope="col" class="text-center sorted-column {{$sort['col']=='CHECK_STATUS_NA'?$sort['type']:''}}" data-name="CHECK_STATUS_NA">حالة الشيك</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($checks) > 0)
                        @foreach($checks as $item)
                            <tr class="check_item check-{{$item['CHECK_STATUS_ID']}}">
                                <td scope="row"><strong>{{$item['CHECK_NUM']??'-'}}</strong></td>
                                <td scope="row">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="">
                                            <div><strong>{{$item['BANK_NA']??'-'}}</strong></div>
                                            <small>{{$item['BRANCH_NAME']??'-'}}</small>
                                            <div>{{$item['ACCOUNT_NAME']??'-'}}</div>
                                        </div>
                                    </div>
                                </td>
{{--                                <td scope="row">--}}
{{--                                    <div class="d-flex justify-content-start align-items-center">--}}
{{--                                        <div class="">--}}
{{--                                            <div><strong>{{$item['SUBMITTED_BANK_NA']??'-'}}</strong></div>--}}
{{--                                            <small>{{$item['SUBMITTED_BRANCH_NA']??'-'}}</small>--}}
{{--                                            <div>{{$item['CHECK_OWNER_NAME']??'-'}}</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
                                <td class="text-center"><strong class="text-dark">{{NumberFormat($item['CHECK_AMOUNT'], $item['CURR_DECIMAL_PLACES'])}} {{$item['CURR_NAME']}}</strong></td>
{{--                                <td class="text-center"><span class="text-dark">{{$item['DEPOSIT_DATE']?Carbon\Carbon::parse($item['DEPOSIT_DATE'])->translatedFormat('d/m/Y'):''}}</span></td>--}}
                                <td class="text-center"><span class="text-dark">{{$item['CHECK_DATE']?Carbon\Carbon::parse($item['CHECK_DATE'])->translatedFormat('d/m/Y'):''}}</span></td>
                                <td class="text-center"><strong class="text-secondary">{{$item['RECEIPT_DATE']?Carbon\Carbon::parse($item['RECEIPT_DATE'])->translatedFormat('d/m/Y'):'-'}}</strong></td>
                                <td class="text-center"><strong class="text-secondary">{{$item['RETURN_DATE']?Carbon\Carbon::parse($item['RETURN_DATE'])->translatedFormat('d/m/Y'):'-'}}</strong></td>
{{--                                <td class="text-center"><span class="text-dark">{{$item['VOUCHER_NO']??'-'}}</span></td>--}}
                                <td class="text-center">
                                    <button class="btn p-0 display_notes {{$item['CHECK_RETURN_REASON_NA']?'text-secondary':'text-muted'}}" @if($item['CHECK_RETURN_REASON_NA'])data-notes="{{$item['CHECK_RETURN_REASON_NA']}}" @else disabled @endif><i class="fa-solid fa-circle-info"></i></button>
                                </td>
                                <td class="text-center"><span class="text-dark">{{$item['CHECK_STATUS_NA']??'-'}}</span></td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
