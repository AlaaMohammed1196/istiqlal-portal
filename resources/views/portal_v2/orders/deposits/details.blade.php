<div id="confirm_form" class="px-5">
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            نوع الطلب
        </div>
        <div class="col-lg-8 fw-bold">{{$data['DEPOSIT_CHANGE_TYPE_DESC']}}</div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            الحساب
        </div>
        <div class="col-lg-8 fw-bold">{{$data['FEED_ACC_NAME']}}, <span dir="ltr">{{$data['FEED_ACCOUNT_NUM']}}</span></div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            قيمة الوديعة
        </div>
        <div class="col-lg-8 fw-bold">{{number_format($data['DEPOSIT_VALUE'], $data['CURR_DECIMAL_PLACES'])}} {{$data['DEPOSIT_CURR_DESC']}}</div>
    </div>
    @if($data['DEPOSIT_CHANGE_TYPE_ID'] == 3)
        <div class="row mb-2 pb-2 border-bottom">
            <div class="col-lg-4">
                قيمة كسر الوديعة
            </div>
            <div class="col-lg-8 fw-bold">{{number_format($data['DEPOSIT_LOSS_VALUE'], $data['CURR_DECIMAL_PLACES'])}} {{$data['DEPOSIT_CURR_DESC']}}</div>
        </div>
    @endif
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            التاريخ
        </div>
        <div class="col-lg-8 fw-bold">{{Carbon\Carbon::parse($data['CREATED_ON'])->translatedFormat('d/m/Y')}}</div>
    </div>
</div>
