<div id="confirm_form" class="px-5">
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            نوع الطلب
        </div>
        @if($data['PAY_TYPE_ID'] == 8)
            <div class="col-lg-8 fw-bold from_account">طلب حوالة إلى أخرين داخل البنك</div>
        @elseif($data['PAY_TYPE_ID'] == 7)
            <div class="col-lg-8 fw-bold from_account">طلب حوالة إلى أخرين خارج البنك</div>
        @else
            <div class="col-lg-8 fw-bold from_account">طلب حوالة بين حساباتي</div>
        @endif
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            من الحساب
        </div>
        <div class="col-lg-8 fw-bold from_account">
            <div><strong>{{$data['FROM_ACCOUNT_NAME']}}</strong></div>
            <div><strong>{{$data['FROM_LEDGER_NAME']}} - {{$data['FROM_CURR_NAME']}}</strong></div>
            <div><strong>{{$data['FROM_ACCOUNT_NUM']}}</strong></div>
        </div>
    </div>

    @if(count($data['BEN']) > 1)
    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col">الى الحساب</th>
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
                        <div><strong>{{$ben['BANK_NAME']}} - {{$ben['BANK_BRANCH_NAME']}}</strong></div>
                        <div><strong>{{$ben['IBAN']}}</strong></div>
                    </td>
                    <td class="text-center">{{NumberFormat($ben['TO_AMOUNT_ACC'], $ben['TO_CURR_DECIMAL_PLACES'])}} {{$ben['TO_CURR_NAME']}}</td>
                    <td class="text-center">{{$data['EXCHANGE_RATE']?NumberFormat($data['EXCHANGE_RATE'], $data['CURR_DECIMAL_PLACES']):'-'}}</td>
                @else
                    <td>
                        <div><strong>{{$ben['TO_ACCOUNT_NUM']}}</strong></div>
                        <div><strong>{{$ben['TO_ACCOUNT_NAME']}} - {{$ben['TO_CURR_NAME']}}</strong></div>
                    </td>
                    <td class="text-center">{{NumberFormat($ben['TO_AMOUNT_ACC'], $ben['TO_CURR_DECIMAL_PLACES'])}} {{$ben['TO_CURR_NAME']}}</td>
                    <td class="text-center">{{$ben['EXCHANGE_RATE']?NumberFormat($ben['EXCHANGE_RATE'], $ben['TO_CURR_DECIMAL_PLACES']):'-'}}</td>
                @endif

                <td>{{$ben['REMITTANCE_PURPOSE_NA']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                إلى الحساب
            </div>
            <div class="col-lg-8 fw-bold to_account">
                @if($data['PAY_TYPE_ID'] == 7)
                    <div><strong>{{$data['BEN'][0]['BANK_NAME']}} - {{$data['BEN'][0]['BANK_BRANCH_NAME']}}</strong></div>
                    <div><strong>{{$data['BEN'][0]['IBAN']}}</strong></div>
                @else
                    <div><strong>{{$data['BEN'][0]['TO_ACCOUNT_NUM']}}</strong></div>
                    <div><strong>{{$data['BEN'][0]['TO_ACCOUNT_NAME']}} - {{$data['BEN'][0]['TO_CURR_NAME']}}</strong></div>
                @endif
            </div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                سعر التحول بين العملات
            </div>
            <div class="col-lg-8 fw-bold">
                @if($data['PAY_TYPE_ID'] == 7)
                    {{$data['EXCHANGE_RATE']?NumberFormat($data['EXCHANGE_RATE'], $data['CURR_DECIMAL_PLACES']):'-'}}
                @else
                    {{$data['BEN'][0]['EXCHANGE_RATE']?NumberFormat($data['BEN'][0]['EXCHANGE_RATE'], $data['BEN'][0]['TO_CURR_DECIMAL_PLACES']):'-'}}
                @endif
            </div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                الهدف من الحوالة
            </div>
            <div class="col-lg-8 fw-bold">{{$data['BEN'][0]['REMITTANCE_PURPOSE_NA']}}</div>
        </div>
    @endif

    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            قيمة الحوالة
        </div>
        <div class="col-lg-8 fw-bold">{{NumberFormat($data['FROM_AMOUNT_ACC'], $data['CURR_DECIMAL_PLACES'])}} {{$data['FROM_CURR_NAME']}}</div>
    </div>
    @if($data['PAY_TYPE_ID'] == 7)
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                شامل العمولة
            </div>
            <div class="col-lg-8 fw-bold to_account">{{$data['INCLUDE_COMMISSION']==1?'نعم':'لا'}}</div>
        </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            قيمة العمولة
        </div>
        <div class="col-lg-8 fw-bold to_account">{{NumberFormat($data['BANK_COMMISSION'], $data['CURR_DECIMAL_PLACES'])}} {{$data['CURR_NAME']}}</div>
    </div>
    @endif
{{--    <div class="row mb-2 pb-2 border-bottom">--}}
{{--        <div class="col-lg-4">--}}
{{--            المبلغ المراد تحويله شامل العمولة--}}
{{--        </div>--}}
{{--        <div class="col-lg-8 fw-bold">{{NumberFormat($data['TOTAL_AMOUNT'], $data['CURR_DECIMAL_PLACES'])}} {{$data['CURR_NAME']}}</div>--}}
{{--    </div>--}}
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            المبلغ المراد تحويله
        </div>
        <div class="col-lg-8 fw-bold">
            @if($data['PAY_TYPE_ID'] == 7)
                {{NumberFormat($data['TOTAL_AMOUNT'], $data['CURR_DECIMAL_PLACES'])}} {{$data['CURR_NAME']}}
            @else
{{--                {{$data['TOTAL_AMOUNT']?NumberFormat($data['TOTAL_AMOUNT'], $data['CURR_DECIMAL_PLACES']) . ' ' . $data['CURR_NAME']:'-'}}--}}
                {{$data['AMOUNT']?NumberFormat($data['AMOUNT'], $data['BEN'][0]['TO_CURR_DECIMAL_PLACES']) . ' ' . $data['BEN'][0]['TO_CURR_NAME']:'-'}}
            @endif
        </div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            تاريخ الطلب
        </div>
        <div class="col-lg-8 fw-bold">{{Carbon\Carbon::parse($data['TRANSFER_DATE'])->translatedFormat('d/m/Y h:m a')}}</div>
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
