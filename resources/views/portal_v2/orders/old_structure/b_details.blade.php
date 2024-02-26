<div id="confirm_form" class="px-5">
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            نوع الطلب
        </div>
        @if($data['BANK_LOCATION'] == 1)
            <div class="col-lg-8 fw-bold from_account">طلب {{$data['CHANGE_TYPE_DESC']}} مستفيد داخل فلسطين</div>
        @elseif($data['BANK_LOCATION'] == 2)
            <div class="col-lg-8 fw-bold from_account">طلب {{$data['CHANGE_TYPE_DESC']}} مستفيد خارج فلسطين</div>
        @else
            <div class="col-lg-8 fw-bold from_account">طلب {{$data['CHANGE_TYPE_DESC']}} مستفيد داخل البنك</div>
        @endif
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            اسم المستفيد
        </div>
        <div class="col-lg-8 fw-bold from_account">{{$data['BENEFICIARY_FULL_NAME']}}</div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            عنوان المستفيد
        </div>
        <div class="col-lg-8 fw-bold from_account">{{$data['BENEFICIARY_ADDRESS']}}</div>
    </div>

    @if($data['BANK_LOCATION']==2 || $data['BANK_LOCATION']==1)
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                اسم البنك
            </div>
            <div class="col-lg-8 fw-bold from_account">{{$data['BANK_NAME']}} - {{$data['BANK_BRANCH_NAME']}}</div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                IBAN
            </div>
            <div class="col-lg-8 fw-bold from_account">{{$data['IBAN']}}</div>
        </div>
    @else
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                نوع الحساب
            </div>
            <div class="col-lg-8 fw-bold from_account">{{$data['BENEFICIARY_LEDGER_NAME']}}</div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                عملة الحساب
            </div>
            <div class="col-lg-8 fw-bold from_account">{{$data['BENEFICIARY_CURR_NAME']}}</div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                رقم الحساب
            </div>
            <div class="col-lg-8 fw-bold from_account">{{$data['BANK_ACCOUNT_NUMBER']}}</div>
        </div>
    @endif
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            تاريخ الطلب
        </div>
        <div class="col-lg-8 fw-bold">{{Carbon\Carbon::parse($data['CREATED_ON'])->translatedFormat('d/m/Y')}}</div>
    </div>
</div>
