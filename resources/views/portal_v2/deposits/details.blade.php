<div class="card custom-shadow">
    <div class="card-body">
        <div class="row py-2 pt-0 border-bottom pb-3 mb-2 align-items-center">
            <div class="col-lg-4">
                <div class="fs-6">
                    <span>قيمة الوديعة</span> <strong class="text-secondary">{{NumberFormat($details['DEPOSIT_VALUE'], $details['CURR_DECIMAL_PLACES'])}} {{$details['DEPOSIT_CURR_DESC']}}</strong>
                </div>
            </div>
            <div class="col-lg-8 text-start">
{{--                <div><span>رقم الوديعة</span> <strong>{{$details['DEPOSIT_ID']}}</strong></div>--}}
{{--                <div>--}}
{{--                    <span>الحالة</span>--}}
{{--                    @if($details['STATUS_ID'] == 1)--}}
{{--                        <strong class="text-warning">{{$details['STATUS_DESC']}}</strong>--}}
{{--                    @elseif($details['STATUS_ID'] == 2)--}}
{{--                        <strong class="text-success">{{$details['STATUS_DESC']}}</strong>--}}
{{--                    @elseif($details['STATUS_ID'] == 3)--}}
{{--                        <strong class="text-danger">{{$details['STATUS_DESC']}}</strong>--}}
{{--                    @elseif($details['STATUS_ID'] == 4)--}}
{{--                        <strong class="text-muted">{{$details['STATUS_DESC']}}</strong>--}}
{{--                    @else--}}
{{--                        <strong class="text-darkBlue">{{$details['STATUS_DESC']}}</strong>--}}
{{--                    @endif--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="row py-2">
            <div class="col-lg-12">
                <i class="fa-solid fa-arrows-rotate text-secondary ms-2"></i> <span class="w-15px">تاريخ ربط الوديعة</span> <strong class="mx-3">{{$details['DEPOSIT_BIND_DATE']?Carbon\Carbon::parse($details['DEPOSIT_BIND_DATE'])->translatedFormat('d/m/Y'):''}}</strong>
            </div>
        </div>
        <div class="row py-2">
            <div class="col-lg-12">
                <i class="fa-solid fa-arrows-rotate text-secondary ms-2"></i> <span class="w-15px">تاريخ استحقاق الوديعة</span> <strong class="mx-3">{{$details['DEPOSIT_MATURITY_DATE']?Carbon\Carbon::parse($details['DEPOSIT_MATURITY_DATE'])->translatedFormat('d/m/Y'):''}}</strong>
            </div>
        </div>
        <div class="row py-2">
            <div class="col-lg-12">
                <i class="fa-solid fa-arrows-rotate text-secondary ms-2"></i> <span class="w-15px">تاريخ اخر تجديد للوديعة</span> <strong class="mx-3">{{$details['LAST_DEPOSIT_MATURITY_DATE']?Carbon\Carbon::parse($details['LAST_DEPOSIT_MATURITY_DATE'])->translatedFormat('d/m/Y'):'-'}}</strong>
            </div>
        </div>
        <div class="row py-2 border-bottom pb-3 mb-2">
            <div class="col-lg-12">
                <i class="fa-solid fa-arrows-rotate text-secondary ms-2"></i> <span class="w-15px">مدة ربط الوديعة</span> <strong class="mx-3">{{$details['DEPOSIT_TYPE_PERIOD_DESC']}}</strong>
            </div>
        </div>
        <div class="row py-2">
            <div class="col-lg-12">
                <i class="fa-solid fa-arrows-rotate text-secondary ms-2"></i> <span class="w-15px">تجديد ربط الوديعة</span> <strong class="mx-3">{{$details['DEPOSIT_BIND_RENEWAL_DESC']}}</strong>
            </div>
        </div>
        <div class="row py-2">
            <div class="col-lg-12">
                <i class="fa-solid fa-percent text-secondary ms-2"></i> <span class="w-15px">نسبة الفائدة%</span> <strong class="mx-3">%{{$details['INTEREST_PERCENTAGE_VALUE']}}</strong>
            </div>
        </div>
        <div class="row py-2 border-bottom pb-3 mb-2">
            <div class="col-lg-12">
                <i class="fa-solid fa-hand-holding-dollar text-secondary ms-2"></i> <span class="w-15px">صرف الفائدة</span> <strong class="mx-3">{{$details['INTEREST_DISBURSEMENT_DESC']}}</strong>
            </div>
        </div>
        @if($details['INTEREST_DISBURSEMENT_ID'] == 1)
{{--            <div class="row py-2">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <i class="fa-solid fa-money-bill text-secondary ms-2"></i> <span class="w-15px">قيمة الفائدة بتاريخ الاستحقاق</span> <strong class="mx-3">{{NumberFormat($amounts['INTERESTS_TO_EXPENSE'], $details['CURR_DECIMAL_PLACES'])}} {{$details['DEPOSIT_CURR_DESC']}}</strong>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row border-bottom py-2">
                <div class="col-lg-12">
                    <i class="fa-solid fa-money-bill text-secondary ms-2"></i> <span class="w-15px">قيمة الفائدة بنهاية الدورة الحالية</span> <strong class="mx-3">{{NumberFormat($amounts['TOTAL_INTERESTS'], $details['CURR_DECIMAL_PLACES'])}} {{$details['DEPOSIT_CURR_DESC']}}</strong>
                </div>
            </div>
        @else
            <div class="row py-2">
                <div class="col-lg-12">
                    <i class="fa-solid fa-money-bill text-secondary ms-2"></i> <span class="w-15px">قيمة الفائدة التقريبية بتاريخ الاستحقاق</span> <strong class="mx-3">{{NumberFormat($amounts['TOTAL_INTERESTS'], $details['CURR_DECIMAL_PLACES'])}} {{$details['DEPOSIT_CURR_DESC']}}</strong>
                </div>
            </div>
        @endif
        <div class="row border-bottom py-2">
            <div class="col-lg-12">
                <i class="fa-solid fa-money-bill text-secondary ms-2"></i> <span class="w-15px">قيمة الفائدة المجمعة</span> <strong class="mx-3">{{NumberFormat($details['ACCRUED_INTEREST_VALUE'], $details['CURR_DECIMAL_PLACES'])}} {{$details['DEPOSIT_CURR_DESC']}}</strong>
            </div>
        </div>
{{--        <div class="row py-2 border-bottom pb-3 mb-2">--}}
{{--            <div class="col-lg-12">--}}
{{--                <i class="fa-solid fa-money-bill text-secondary ms-2"></i> <span class="w-15px">قيمة الفائدة المقيدة</span> <strong class="mx-3">{{NumberFormat($details['RESTRICTED_INTEREST_VALUE'], $details['CURR_DECIMAL_PLACES'])}} {{$details['DEPOSIT_CURR_DESC']}}</strong>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row py-2 border-bottom pb-3 mb-2">--}}
{{--            <div class="col-lg-12">--}}
{{--                <i class="fa-solid fa-money-bill text-secondary ms-2"></i> <span class="w-15px">قيمة الفائدة المصروفة</span> <strong class="mx-3">{{NumberFormat($details['EXPENSED_INTEREST_VALUE'], $details['CURR_DECIMAL_PLACES'])}} {{$details['DEPOSIT_CURR_DESC']}}</strong>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row py-2">--}}
{{--            <div class="col-lg-12">--}}
{{--                <i class="fa-regular fa-credit-card text-secondary ms-2"></i> <span class="w-15px">حساب التغذية</span> <strong class="mx-3" dir="ltr">{{$details['FEED_ACCOUNT_NUM']}}</strong>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row py-2">
            <div class="col-lg-12">
                <i class="fa-regular fa-credit-card text-secondary ms-2"></i> <span class="w-15px">حساب الفوائد</span> <strong class="mx-3" dir="ltr">{{$details['PROFIT_ACCOUNT_NUM']}}</strong>
            </div>
        </div>
{{--        <div class="row py-2">--}}
{{--            <div class="col-lg-12">--}}
{{--                <i class="fa-regular fa-credit-card text-secondary ms-2"></i> <span class="w-15px">حساب التسييل</span> <strong class="mx-3" dir="ltr">{{$details['MONETIZATION_ACCOUNT_NUM']}}</strong>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
