@foreach($checks as $item)
    <div class="col-lg-6 col-xl-6 col-xxl-4">
        <div class="card p-4">
            <label class="form-check w-100 checked-line-through checked-opacity-75">
                <div class="card-body p-2 d-flex flex-column justify-content-between">
                                    <span class="form-check-label d-block">
                                        <h3 class="heading text-primary mb-4 fw-bold">رقم الشيك: {{$item['CHECK_NUM']??'-'}}</h3>
                                    </span>
                    <div class="mb-3">
                        <h4 class="bg-primary text-center px-3 py-2 rounded-lg text-white mb-3">المبلغ: {{NumberFormat($item['CHECK_AMOUNT'], $item['CURR_DECIMAL_PLACES'])}} {{$item['CURR_NAME']}}</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="text-secondary mb-1">حالة الشيك</div>
                            <div class="h5 text-success">{{$item['CHECK_STATUS_NA']??'-'}}</div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 mb-3">
                            <div class="text-secondary mb-1">رقم السند</div>
                            <div class="h5">{{$item['VOUCHER_NO']??'-'}}</div>
                        </div>
                        {{--                                        <div class="col-md-4 mb-3">--}}
                        {{--                                            <div class="text-secondary mb-1">رقم المقبوض منه</div>--}}
                        {{--                                            <div class="h5">{{$item['ACC_NUM']??'-'}}</div>--}}
                        {{--                                        </div>--}}
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <h6 class="card-title">البنك</h6>
                            <h5 class="small card-title fw-bold">{{$item['BANK_NA']??'-'}}</h5>
                            <h5 class="small card-title">{{$item['BRANCH_NAME']??'-'}}</h5>
                            <p class="card-text">{{$item['ACCOUNT_NAME']??'-'}}</p>
                        </div>
                        <div class="col-lg-2 text-center">
                            <i class="fa-solid fa-right-left text-secondary"></i>
                        </div>
                        <div class="col-lg-5">
                            <h6 class="card-title">مرسل إلى بنك</h6>
                            <h5 class="small card-title fw-bold">{{$item['SUBMITTED_BANK_NA']??'-'}}</h5>
                            <h5 class="small card-title">{{$item['SUBMITTED_BRANCH_NA']??'-'}}</h5>
                            <p class="card-text">{{$item['CHECK_OWNER_NAME']??'-'}}</p>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <div class="border-bottom border-separator-light pb-3 mb-3">تاريخ الشيك  <span class="fw-bold text-primary">{{Carbon\Carbon::parse($item['CHECK_DATE'])->translatedFormat('d/m/Y')}}</span></div>
                        <div class="">تاريخ القبض  <span class="fw-bold text-secondary">{{Carbon\Carbon::parse($item['RECEIPT_DATE'])->translatedFormat('d/m/Y')}}</span></div>
                    </div>
                </div>
            </label>
        </div>
    </div>
@endforeach
