<div id="confirm_form">
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            نوع الحوالة
        </div>
        @if($data['PAY_TYPE_ID'] == 8)
            <div class="col-lg-8 fw-bold from_account"> حوالة إلى أخرين داخل البنك</div>
        @elseif($data['PAY_TYPE_ID'] == 7)
            <div class="col-lg-8 fw-bold from_account"> حوالة إلى أخرين خارج البنك</div>
        @else
            <div class="col-lg-8 fw-bold from_account"> حوالة بين حساباتي</div>
        @endif
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            من الحساب
        </div>
        <div class="col-lg-8 fw-bold from_account">{{$data['FROM_ACCOUNT_NUM']}}</div>
    </div>

    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col">المستفيد</th>
            <th scope="col" class="text-center">المبلغ</th>
            <th scope="col" class="text-center">سعر صرف العملة</th>
            <th scope="col">الغاية</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['BEN'] as $ben)
            <tr>
                @if($data['PAY_TYPE_ID'] == 7)
                    <td>
                        <div><strong>{{$ben['BENEFICIARY_FULL_NAME']}}</strong></div>
                        <div><strong>{{$ben['BANK_NAME']}} - {{$ben['BANK_BRANCH_NAME']}}</strong></div>
                        <div><strong>{{$ben['IBAN']}}</strong></div>
                    </td>
                    <td class="text-center">{{NumberFormat($ben['TO_AMOUNT_ACC'], $ben['TO_CURR_DECIMAL_PLACES'])}} {{$ben['TO_CURR_NAME']}}</td>
                    <td class="text-center">{{$data['EXCHANGE_RATE']??'-'}}</td>
                @else
                    <td>
                        <div><strong>{{$ben['BENEFICIARY_FULL_NAME']}}</strong></div>
                        <div><strong>{{$ben['TO_ACCOUNT_NAME']}} - {{$ben['TO_CURR_NAME']}}</strong></div>
                        <div><strong>{{$ben['TO_ACCOUNT_NUM']}}</strong></div>
                    </td>
                    <td class="text-center">{{NumberFormat($ben['TO_AMOUNT_ACC'], $ben['TO_CURR_DECIMAL_PLACES'])}} {{$ben['TO_CURR_NAME']}}</td>
                    <td class="text-center">{{$ben['EXCHANGE_RATE']??'-'}}</td>
                @endif
                <td>{{$ben['REMITTANCE_PURPOSE_NA']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            المبلغ المراد تحويله
        </div>
        <div class="col-lg-8 fw-bold">{{NumberFormat($data['AMOUNT'], $data['CURR_DECIMAL_PLACES'])}} {{$data['CURR_NAME']}}</div>
    </div>
    @if($data['PAY_TYPE_ID'] == 7)
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                شامل العمولة
            </div>
            <div class="col-lg-8 fw-bold to_account">{{$data['INCLUDE_COMMISSION']==1?'نعم':'لا'}}</div>
        </div>
    @endif
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            قيمة العمولة
        </div>
        <div class="col-lg-8 fw-bold to_account">{{$data['BANK_COMMISSION']??'-'}}</div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            المبلغ المراد تحويله شامل العمولة
        </div>
        <div class="col-lg-8 fw-bold">{{NumberFormat($data['TOTAL_AMOUNT'], $data['CURR_DECIMAL_PLACES'])}} {{$data['CURR_NAME']}}</div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            حالة الحوالة
        </div>
        <div class="col-lg-8 fw-bold">{{$data['VOUCHER_STATUS_TEXT']??'-'}}</div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            ملاحظات
        </div>
        <div class="col-lg-8 fw-bold">{{$data['NOTES']??'-'}}</div>
    </div>
    @if(isset($data['TRANSFER_ATTACHMENTS']) && count($data['TRANSFER_ATTACHMENTS']) > 0)
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                المرفقات
            </div>
            <div class="col-lg-8 fw-bold">
                <div class="row">
                    @foreach($data['TRANSFER_ATTACHMENTS'] as $attach)
                        <div class="d-flex align-items-center">
                            <p class="mx-2 mb-0 clamp-line" data-line="1">{{$attach['ORIGINAL_FILE_NAME']}}</p>
                            <a href="{{$attach['ATTACHMENT_LINK']}}" download="{{$attach['ORIGINAL_FILE_NAME']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$attach['ORIGINAL_FILE_NAME']}}">
                                <i class="fas fa-cloud-download-alt text-alternate stretched-link"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
