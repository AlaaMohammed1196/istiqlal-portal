<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead>
        <tr>
            <th scope="col" style="word-wrap: break-word;">الحساب</th>
            <th scope="col" class="text-center" style="word-wrap: break-word;">رقم المستفيد</th>
            <th scope="col"  class="text-center">ملاحظات</th>
            <th scope="col" class="text-center">أدوات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($beneficiaries as $index=>$item)
            <tr id="item-{{$item['BENEFICIARY_ID']}}">
                <td scope="row">
                    <div class="d-flex justify-content-start align-items-center">
                        <i class="fa-solid fa-user text-secondary mx-3"></i>
                        <div class="mx-3">
                            @if($item['BANK_LOCATION']==2)
                                <div><strong>{{$item['BANK_NAME']}} - {{$item['BANK_BRANCH_NAME']}}</strong></div>
                                <strong>{{$item['BENEFICIARY_FULL_NAME']}}</strong>
                                <div>{{$item['IBAN']}}</div>
                            @elseif($item['BANK_LOCATION']==1)
                                <div><strong>{{$item['BANK_NAME']}} - {{$item['BANK_BRANCH_NAME']}}</strong></div>
                                <strong>{{$item['BENEFICIARY_FULL_NAME']}}</strong>
                                <div>{{$item['IBAN']}}</div>
                            @else
                                <div><strong>{{$item['BANK_NAME']}}</strong></div>
                                <strong>{{$item['BENEFICIARY_FULL_NAME']}}</strong>
                                <div>{{$item['IBAN']??$item['BANK_ACCOUNT_NUMBER']}}</div>
                                <div class="text-dark">{{$item['BENEFICIARY_LEDGER_NAME']}} - {{$item['BENEFICIARY_CURR_NAME']}}</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="text-center">{{$item['BENEFICIARY_ID']}}</td>
                <td class="text-center">
                    <button class="btn p-0 display_notes {{$item['NOTES']?'text-secondary':'text-muted'}}" @if($item['NOTES'])data-notes="{{$item['NOTES']}}" @else disabled @endif><i class="fa-solid fa-circle-info"></i></button>
                </td>
                <td class="text-center">
                    <a href="javascript:void(0);" role="button" data-id="{{$item['BENEFICIARY_ID']}}" class="display_details btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top ms-1"
                       data-bs-toggle="tooltip" data-bs-title="عرض التفاصيل">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    @if(in_array(1, array_column(Session::get('userData')['USER_ROLES'], 'ROLE_ID')) && in_array(202, array_column(Session::get('userData')['USER_SCREEN_PERMS'], 'SCREEN_ID')))
                    <a href="{{route('portal.v2.beneficiaries.edit', $item['BENEFICIARY_ID'])}}" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top ms-1"
                       data-bs-toggle="tooltip" data-bs-title="تعديل">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    @endif
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_row" data-id="{{$item['BENEFICIARY_ID']}}" type="button"
                            data-bs-toggle="tooltip" data-bs-title="حذف">
                        <div class="text"><i class="fa-solid fa-circle-xmark"></i></div>
                        <div class="btn-loader d-none">
                            <div class="spinner-border spinner-border-sm text-danger mx-0" role="status">
                                <span class="visually-hidden">جاري الإرسال</span>
                            </div>
                        </div>

                    </button>
                </td>
            </tr>
        @endforeach
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
