<form id="confirm_form">
    <div class="row mb-4 pb-2 justify-content-center ">
        <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center bg-white align-items-center border border-secondary">
            <i class="fa-solid fa-right-left fa-2x text-secondary"></i>
        </div>
    </div>
    <div class="alert alert-danger mb-4 d-none" role="alert"></div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            من الحساب
        </div>
        <div class="col-lg-8 fw-bold from_account"></div>
    </div>
    @if($transfer_type == 10)
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                إلى الحساب
            </div>
            <div class="col-lg-8 fw-bold to_account"></div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                مبلغ التحويل
            </div>
            <div class="col-lg-8 fw-bold">{{NumberFormat($data['FROM_AMOUNT_ACC'], $data['FROM_CURR_DECIMAL_PLACES'])}} <span class="from_curr"></span></div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                سعر صرف العملة
            </div>
            <div class="col-lg-8 fw-bold">{{$data['EXCHANGE_RATE']}}</div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                المبلغ المراد تحويله
            </div>
            <div class="col-lg-8 fw-bold">{{NumberFormat($data['TO_AMOUNT_ACC'], $data['TO_CURR_DECIMAL_PLACES'])}} <span class="to_curr"></span></div>
        </div>
    @else
        <table class="table align-middle">
            <thead>
            <tr>
                <th scope="col">المستفيد</th>
                <th scope="col" class="text-center">المبلغ</th>
                <th scope="col">سعر صرف العملة</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data['BEN'] as $ben)
                    <tr>
                        @if($transfer_type == 8)
                            <td>{{$ben['BENEFICIARY_FULL_NAME']}} - {{$ben['BANK_ACCOUNT_NUMBER']}} - {{$ben['TO_CURR_NAME']}}</td>
                            <td class="text-center">{{NumberFormat($ben['TO_AMOUNT_ACC'], $ben['TO_CURR_DECIMAL_PLACES'])}} {{$ben['TO_CURR_NAME']}}</td>
                            <td>{{$ben['EXCHANGE_RATE']}}</td>
                        @else
                            <td>{{$ben['BENEFICIARY_NAME_NA']}} <br/> {{$ben['BANK_NAME']}} - {{$ben['BANK_BRANCH_NAME']}} <br/> {{$ben['IBAN']}}</td>
                            <td class="text-center">{{NumberFormat($ben['TO_AMOUNT_ACC'], $data['TO_CURR_DECIMAL_PLACES'])}} {{$data['TO_CURR_NAME']}}</td>
                            <td>{{$data['EXCHANGE_RATE']}}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            تاريخ تنفيذ الحوالة
        </div>
        <div class="col-lg-8 fw-bold">{{Carbon\Carbon::parse($data['TRANSFER_DATE'])->translatedFormat('d/m/Y h:m a')}}</div>
    </div>
</form>
