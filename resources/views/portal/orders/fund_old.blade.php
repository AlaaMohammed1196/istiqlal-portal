<div class="h-100-card">
    @php $details = getFundData($item['FUND_ID']) @endphp
    <ul class="nav nav-pills responsive-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item ms-3" role="presentation">
            <a href="{{route('portal.orders.print', $details['data']['Fund_Data'][0]['FUND_ID'])}}" download="" class="btn btn-icon btn-icon-only btn-outline-secondary align-top">
                <i class="fa-solid fa-print"></i>
            </a>
        </li>
        <li class="nav-item ms-3" role="presentation">
            <button class="nav-link active" id="request-data-1" data-bs-toggle="tab" data-bs-target="#request-data-1-pane" type="button" role="tab" aria-controls="request-data-1-pane" aria-selected="true"><i class="fa-solid fa-circle-info ms-2"></i> بيانات الطلب</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link d-flex align-items-center" id="request-comments-1" data-bs-toggle="tab" data-bs-target="#request-comments-1-pane" type="button" role="tab" aria-controls="request-comments-1-pane" aria-selected="false">
                <i class="fa-solid fa-comments ms-2"></i> التعليقات والمرفقات
                <span class="me-2 comments-number d-inline-block"><div class="badge bg-secondary" id="contactUnread">{{count($details['data']['FUND_COMMENTS'])}}</div></span>
            </button>
        </li>
        <li class="nav-item me-auto" role="presentation">
            <div class="d-flex">
                @if($details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 0 || $details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 1)
                <a href="{{route('portal.loan-request.edit', $details['data']['Fund_Data'][0]['FUND_ID'])}}" class="nav-link d-flex align-items-center px-0">
                    <i class="fa-solid fa-edit ms-2 text-secondary"></i> تعديل الطلب
                </a>
                <a href="javascript:void(0)" data-id="{{$details['data']['Fund_Data'][0]['FUND_ID']}}" onclick="cancelOrder(this)" class="nav-link d-flex align-items-center ps-0">
                    <i class="fa-solid fa-times ms-2 text-secondary"></i> إلغاء الطلب
                </a>
                @endif
                @if($details['data']['Fund_Data'][0]['FUND_STATUS_ID'] != 0)
                    <a href="{{route('portal.loan-request.duplicate', $details['data']['Fund_Data'][0]['FUND_ID'])}}" class="nav-link d-flex align-items-center ps-0">
                        <i class="fa-regular fa-copy ms-2 text-secondary"></i> تكرار الطلب
                    </a>
                @endif
            </div>
        </li>
    </ul>
    <div class="tab-content h-100-card" id="myTabContent">

        <div class="tab-pane fade show active h-100" id="request-data-1-pane" role="tabpanel" aria-labelledby="request-data-1"  tabindex="0">
            <div class="card h-100">
                <div class="card-body pb-0">
                    <!-- User Start -->
                    <div class="d-flex flex-row align-items-center mb-3">
                        <div class="row g-0 align-self-start" id="contactTitle">
                            <div class="col-auto">
                                <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border border-secondary ms-3">
                                    <i class="fa-solid fa-file-invoice fa-2x text-secondary"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body d-flex flex-row pt-0 pb-0 pe-0 pe-0 ps-2 h-100 align-items-center justify-content-between">
                                    <div class="d-flex flex-column">
                                        <div class="program">{{$details['data']['Fund_Data'][0]['PRODUCT_TYPE']}}</div>
                                        <div class="name fw-bold">{{$details['data']['Fund_Data'][0]['FINANCING_PURPOSE_DESC']}}</div>
                                        <div class=" text-secondary fw-bold h4 mb-0 last">{{number_format($details['data']['Fund_Data'][0]['FINANCING_VALUE'], 2)}} {{$details['data']['Fund_Data'][0]['GOOD_CURR_NAME']}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ms-1 me-auto">
                            @if($details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 0)
                                <div class="text-muted">
                                    <i class="fa-regular fa-file"></i> {{$details['data']['Fund_Data'][0]['FUND_STATUS_DESC']}}
                                </div>
                            @elseif($details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 1 || $details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 3)
                                <div class="text-success">
                                    <i class="fa-regular fa-circle-check"></i> {{$details['data']['Fund_Data'][0]['FUND_STATUS_DESC']}}
                                </div>
                            @elseif($details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 2)
                                <div class="text-muted">
                                    <i class="fa-solid fa-arrows-rotate"></i> {{$details['data']['Fund_Data'][0]['FUND_STATUS_DESC']}}
                                </div>
                            @elseif($details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 10 || $details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 13)
                                <div class="text-danger">
                                    <i class="fa-solid fa-circle-xmark"></i> {{$details['data']['Fund_Data'][0]['FUND_STATUS_DESC']}}
                                </div>
                            @endif
                            <div class="mb-2">
                                رقم الطلب: <span class="text-secondary fw-bold">{{$details['data']['Fund_Data'][0]['FUND_ID']}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="separator-light mb-3"></div>
                    <!-- User End -->
                </div>
                <div class="row card-body scroll-out h-100">
                    <div class="col-auto d-none d-sm-block">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#data-info">البيانات العامة <i data-acorn-icon="chevron-left"></i></a></li>
                            <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#payments-info">مصادر السداد <i data-acorn-icon="chevron-left"></i></a></li>
                            <li class="nav-item">
                                <a class="nav-link  d-flex justify-content-between" href="#warranties-info">الضمانات <i data-acorn-icon="chevron-left"></i></a>
                            </li>
                            <li class="nav-item border-bottom ">
                                <a class="nav-link d-flex justify-content-between fw-bold" href="javascript:void(0);">المعلومات المالية</a>
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#assets-info">الموجودات <i data-acorn-icon="chevron-left"></i></a></li>
                                    <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#liabilities-info">المطلوبات <i data-acorn-icon="chevron-left"></i></a></li>
                                    <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#property-info">حقوق الملكية <i data-acorn-icon="chevron-left"></i></a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#income-info">قائمة الدخل <i data-acorn-icon="chevron-left"></i></a></li>
                            <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#attachments-info">المرفقات <i data-acorn-icon="chevron-left"></i></a></li>
                        </ul>
                    </div>
                    <div class="col h-100">
                        <div class="scroll-track-visible h-100 mb-n2">
                            <div class=" px-3">
                                <div class="row py-2 border-bottom" id="data-info">
                                    <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-circle-info ms-2"></i> البيانات العامة</h2>
                                </div>
                                <div class="row g-0  py-2">
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">البرنامج</div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$details['data']['Fund_Data'][0]['PROGRAM_TYPE_DESC']}}</div>
                                    </div>
                                </div>
                                <div class="row g-0 py-2">
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">القرض</div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-5 sh-sm-3 sh-md-5 d-flex align-items-center fw-bold">{{$details['data']['Fund_Data'][0]['PRODUCT_TYPE']}}</div>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom py-2">
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">الهدف من القرض</div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$details['data']['Fund_Data'][0]['FINANCING_PURPOSE_DESC']}}</div>
                                    </div>
                                </div>

                                <div class="row g-0 border-bottom py-2">
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">قيمة المبلغ المطلوب</div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold text-secondary">{{number_format($details['data']['Fund_Data'][0]['GOODS_VALUE'], 2)}} {{$details['data']['Fund_Data'][0]['GOOD_CURR_NAME']}}</div>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom py-2">
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">قيمة القرض</div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{number_format($details['data']['Fund_Data'][0]['FINANCING_VALUE'], 2)}} {{$details['data']['Fund_Data'][0]['GOOD_CURR_NAME']}}</div>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom py-2">
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">قيمة مساهمة العميل</div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{number_format($details['data']['Fund_Data'][0]['GOODS_VALUE'] - $details['data']['Fund_Data'][0]['FINANCING_VALUE'], 2)}} {{$details['data']['Fund_Data'][0]['GOOD_CURR_NAME']}}</div>
                                    </div>
                                </div>
                                <div class="row g-0 py-2">
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">مدة القرض بالأشهر</div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$details['data']['Fund_Data'][0]['INSTALLMENT_CNT']}}</div>
                                    </div>
                                </div>
                                <div class="row g-0  border-bottom py-2">
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">فترة السماح ضمن فترة القرض / بالأشهر</div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$details['data']['Fund_Data'][0]['GRACE_PERIOD_IN_DAYS']/30}}</div>
                                    </div>
                                </div>
                                <div class="row g-0 py-2">
                                    <div class="col-12">
                                        <div class="d-flex fw-bold align-items-center fw-normal my-3">ما الذي سيضيفه القرض من تطوير لأعمال الشركة</div>
                                    </div>
                                    <div class="col-12">
                                        <p class="lh-lg">{{$details['data']['Fund_Data'][0]['FUND_DESCRIPTION']}}</p>
                                    </div>
                                </div>

                                <div class="row py-2 border-bottom" id="payments-info">
                                    <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-money-bill-1 ms-2"></i> مصادر السداد</h2>
                                </div>

                                <div class="row g-0 py-2">
                                    <div class="col-12">
                                        <div class="fw-bold my-3 d-flex align-items-center fw-normal lh-1-25">مصادر التمويل لمساهمة العميل</div>
                                    </div>
                                    <div class="col-12">

                                        <div class="bg-light pt-3 pb-1 rounded">
                                            <div class="mb-4">
                                                <div class="table-responsive">
                                                    <table class="table align-middle"   >
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">المصدر</th>
                                                            <th scope="col" class="text-center">القيمة السنوية</th>
                                                            <th scope="col" class="text-center">العملة	</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($details['data']['FUND_SOURCES_CUST_CONTRIBUTION']) > 0)
                                                            <?php $sum = 0; ?>
                                                            @foreach($details['data']['FUND_SOURCES_CUST_CONTRIBUTION'] as $source)
                                                            <tr>
                                                                <th scope="row">{{$source['SOURCE_DESC']}}</th>
                                                                <td class="text-center">
                                                                  <?php $sum += $source['ANNUAL_SOURCE_VALUE'] ?>
                                                                    <span class="text-secondary">{{$source['ANNUAL_SOURCE_VALUE']}}</span>
                                                                </td>
                                                                <td class="text-center">{{$source['CURR_NAME']}}</td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <th scope="row" class="table-secondary">المجموع (مقيم بقيمة الدولار)</th>
                                                                <td class="text-center table-secondary"><span class="text-secondary fw-bold">{{$sum}}</span></td>
                                                                <td class="text-center table-secondary fw-bold"></td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td colspan="3" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد مصادر سداد حتى الآن</td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-0 py-2">
                                    <div class="col-12">
                                        <div class="fw-bold my-3 d-flex align-items-center fw-normal lh-1-25">وصف مصادر السداد <span class="text-secondary fw-normal me-2">(حسب الاهمية)</span></div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg-light pt-3 pb-1 rounded">
                                            <div class="mb-4">
                                                <div class="table-responsive">
                                                    <table class="table align-middle">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">مصدر السداد</th>
                                                            <th scope="col" class="text-center">القيمة السنوية</th>
                                                            <th scope="col" class="text-center">العملة</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($details['data']['FUND_SOURCE_CUST_CONTR_DESC']) > 0)
                                                            <?php $sum = 0; ?>
                                                            @foreach($details['data']['FUND_SOURCE_CUST_CONTR_DESC'] as $source)
                                                                <tr>
                                                                    <th scope="row">{{$source['SOURCE_CUST_CONTR_DESC']}}</th>
                                                                    <td class="text-center">
                                                                        <?php $sum += $source['ANNUAL_SOURCE_VALUE'] ?>
                                                                        <span class="text-secondary">{{$source['ANNUAL_SOURCE_VALUE']}}</span>
                                                                    </td>
                                                                    <td class="text-center">{{$source['CURR_NAME']}}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <th scope="row" class="table-secondary">المجموع (مقيم بقيمة الدولار)</th>
                                                                <td class="text-center table-secondary"><span class="text-secondary fw-bold">{{$sum}}</span></td>
                                                                <td class="text-center table-secondary fw-bold"></td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td colspan="3" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد وصف مصادر السداد حتى الآن</td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-5 pb-2 border-bottom" id="warranties-info">
                                    <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-layer-group ms-2"></i> الضمانات</h2>
                                </div>

                                <div class="row g-0 py-2">
                                    <div class="col-12">
                                        <div class="fw-bold my-3 d-flex align-items-center fw-normal lh-1-25">الضمانات التي يمكنك تقديمها</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg-light pt-3 pb-1 rounded">
                                            <div class="mb-4">
                                                <div class="table-responsive">
                                                    <table class="table align-middle">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">الضمانة</th>
                                                            <th scope="col" class="text-center">القيمة التقديرية</th>
                                                            <th scope="col" class="text-center">العملة</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($details['data']['FUND_GUARANTEES']) > 0)
                                                            <?php $sum = 0; ?>
                                                            @foreach($details['data']['FUND_GUARANTEES'] as $source)
                                                                <tr>
                                                                    <th scope="row">{{$source['GUARANTEE_TYPE']}}</th>
                                                                    <td class="text-center">
                                                                        <?php $sum += $source['GUARANTEE_VALUE'] ?>
                                                                        <span class="text-secondary">{{$source['GUARANTEE_VALUE']}}</span>
                                                                    </td>
                                                                    <td class="text-center">{{$source['CURR_NAME']}}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <th scope="row" class="table-secondary">المجموع (مقيم بقيمة الدولار)</th>
                                                                <td class="text-center table-secondary"><span class="text-secondary fw-bold">{{$sum}}</span></td>
                                                                <td class="text-center table-secondary fw-bold"></td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td colspan="3" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد ضمانات حتى الآن</td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-5 pb-2 border-bottom" id="assets-info">
                                    <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-coins ms-2"></i> المعلومات المالية | الموجودات</h2>
                                </div>

                                <div class="g-0 d-flex flex-column flex-sm-row justify-content-between align-items-center  border-bottom  py-2">
                                    <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">الجهة المدققة <span class="sh-3 sh-md-5 d-flex align-items-center mx-2 fw-bold">{{$details['data']['Fund_Data'][0]['AUDITED_ENTITY_NAME']}}</span></div>
                                    <div class="sh-3 sh-md-5  d-flex align-items-center fw-normal lh-1-25">العملة <span class="sh-3 sh-md-5 mx-2 d-flex align-items-center fw-bold">{{$details['data']['Fund_Data'][0]['FINANCE_INFO_CURR_NAME']}}</span></div>
                                    <div class="sh-3 sh-md-5  d-flex align-items-center fw-normal lh-1-25">تاريخ إعدادها <span class="sh-3 sh-md-5 mx-2 d-flex align-items-center fw-bold">{{$details['data']['Fund_Data'][0]['FINANCE_INFO_PREPARED_ON']?\Carbon\Carbon::parse($details['data']['Fund_Data'][0]['FINANCE_INFO_PREPARED_ON'])->translatedFormat('d-m-Y'):''}}</span></div>
                                    <div class="sh-3 sh-md-5  d-flex align-items-center fw-normal lh-1-25">السنة المالية <span class="sh-3 sh-md-5 mx-2 d-flex align-items-center fw-bold">{{$details['data']['Fund_Data'][0]['FISCAL_YEAR']}}</span></div>
                                </div>

                                <div class="col-12 d-flex justify-content-between mt-5 mb-3">
                                    <div class="fw-bold h5 text-secondary">الموجودات المتداولة</div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col" width="40%">الموجودات</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['LAST_YEAR']}}</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['THIS_YEAR']}}</th>
                                            <th scope="col" class="text-center">التغيير</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $current_assets = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 1) @endphp
                                        <?php $assets_current_last_sum = 0; $assets_current_this_sum = 0; ?>
                                        @if(count($current_assets) > 0)
                                            @foreach($current_assets as $item)
                                                <tr>
                                                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                                                    <td class="text-center"><?php $assets_current_last_sum += $item['LAST_YEAR_VALUE'] ?>{{$item['LAST_YEAR_VALUE']}}</td>
                                                    <td class="text-center"><?php $assets_current_this_sum += $item['THIS_YEAR_VALUE'] ?>{{$item['THIS_YEAR_VALUE']}}</td>
                                                    <td class="text-center">{{$item['THIS_YEAR_VALUE'] - $item['LAST_YEAR_VALUE']}}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="table-light">
                                                <th scope="row" class="table-light">المجموع</th>
                                                <td class="text-center table-light"><span class="">{{$assets_current_last_sum}}</span></td>
                                                <td class="text-center table-light"><span class="">{{$assets_current_this_sum}}</span></td>
                                                <td class="text-center table-light"><span class="">{{$assets_current_this_sum - $assets_current_last_sum}}</span></td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد موجودات متداولة حتى الآن</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-12 d-flex justify-content-between mb-3 mt-5">
                                    <div class="fw-bold h5 text-secondary">الموجودات الثابتة</div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col" width="40%">الموجودات</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['LAST_YEAR']}}</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['THIS_YEAR']}}</th>
                                            <th scope="col" class="text-center">التغيير</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $fixed_assets = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 1)->where('FINANCIAL_INFO_SUB_TYPE_ID', 2) @endphp
                                        <?php $assets_fixed_last_sum = 0; $assets_fixed_this_sum = 0; ?>
                                        @if(count($fixed_assets) > 0)
                                            @foreach($fixed_assets as $item)
                                                <tr>
                                                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                                                    <td class="text-center"><?php $assets_fixed_last_sum += $item['LAST_YEAR_VALUE'] ?>{{$item['LAST_YEAR_VALUE']}}</td>
                                                    <td class="text-center"><?php $assets_fixed_this_sum += $item['THIS_YEAR_VALUE'] ?>{{$item['THIS_YEAR_VALUE']}}</td>
                                                    <td class="text-center">{{$item['THIS_YEAR_VALUE'] - $item['LAST_YEAR_VALUE']}}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="table-light">
                                                <th scope="row" class="table-light">المجموع</th>
                                                <td class="text-center table-light"><span class="">{{$assets_fixed_last_sum}}</span></td>
                                                <td class="text-center table-light"><span class="">{{$assets_fixed_this_sum}}</span></td>
                                                <td class="text-center table-light"><span class="">{{$assets_fixed_this_sum - $assets_fixed_last_sum}}</span></td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد موجودات ثابتة حتى الآن</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row pt-5 pb-2 border-bottom" id="liabilities-info">
                                    <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-coins ms-2"></i> المعلومات المالية | المطلوبات</h2>
                                </div>

                                <div class="col-12 d-flex justify-content-between mt-5 mb-3">
                                    <div class="fw-bold h5 text-secondary">المطلوبات المتداولة</div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col" width="40%">المطلوبات</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['LAST_YEAR']}}</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['THIS_YEAR']}}</th>
                                            <th scope="col" class="text-center">التغيير</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $current_liabilities = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 2)->where('FINANCIAL_INFO_SUB_TYPE_ID', 3) @endphp
                                        <?php $liabilities_current_last_sum = 0; $liabilities_current_this_sum = 0; ?>
                                        @if(count($current_liabilities) > 0)
                                            @foreach($current_liabilities as $item)
                                                <tr>
                                                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                                                    <td class="text-center"><?php $liabilities_current_last_sum += $item['LAST_YEAR_VALUE'] ?>{{$item['LAST_YEAR_VALUE']}}</td>
                                                    <td class="text-center"><?php $liabilities_current_this_sum += $item['THIS_YEAR_VALUE'] ?>{{$item['THIS_YEAR_VALUE']}}</td>
                                                    <td class="text-center">{{$item['THIS_YEAR_VALUE'] - $item['LAST_YEAR_VALUE']}}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="table-light">
                                                <th scope="row" class="table-light">المجموع</th>
                                                <td class="text-center table-light"><span class="">{{$liabilities_current_last_sum}}</span></td>
                                                <td class="text-center table-light"><span class="">{{$liabilities_current_this_sum}}</span></td>
                                                <td class="text-center table-light"><span class="">{{$liabilities_current_this_sum - $liabilities_current_last_sum}}</span></td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد مطلوبات متداولة حتى الآن</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-12 d-flex justify-content-between mb-3 mt-5">
                                    <div class="fw-bold h5 text-secondary">المطلوبات الغير متداولة</div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col" width="40%">المطلوبات</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['LAST_YEAR']}}</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['THIS_YEAR']}}</th>
                                            <th scope="col" class="text-center">التغيير</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $fixed_liabilities = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 2)->where('FINANCIAL_INFO_SUB_TYPE_ID', 4) @endphp
                                        <?php $liabilities_fixed_last_sum = 0; $liabilities_fixed_this_sum = 0; ?>
                                        @if(count($fixed_liabilities) > 0)
                                            @foreach($fixed_liabilities as $item)
                                                <tr>
                                                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                                                    <td class="text-center"><?php $liabilities_fixed_last_sum += $item['LAST_YEAR_VALUE'] ?>{{$item['LAST_YEAR_VALUE']}}</td>
                                                    <td class="text-center"><?php $liabilities_fixed_this_sum += $item['THIS_YEAR_VALUE'] ?>{{$item['THIS_YEAR_VALUE']}}</td>
                                                    <td class="text-center">{{$item['THIS_YEAR_VALUE'] - $item['LAST_YEAR_VALUE']}}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="table-light">
                                                <th scope="row" class="table-light">المجموع</th>
                                                <td class="text-center table-light"><span class="">{{$liabilities_fixed_last_sum}}</span></td>
                                                <td class="text-center table-light"><span class="">{{$liabilities_fixed_this_sum}}</span></td>
                                                <td class="text-center table-light"><span class="">{{$liabilities_fixed_this_sum - $liabilities_fixed_last_sum}}</span></td>
                                            </tr>
                                            <tr class="bg-primary">
                                                <th scope="row" class="bg-primary text-white">مجموع المطلوبات</th>
                                                <td class="text-center bg-primary text-white"><span class="">{{$liabilities_current_last_sum + $liabilities_fixed_last_sum}}</span></td>
                                                <td class="text-center bg-primary text-white"><span class="">{{$liabilities_current_this_sum + $liabilities_fixed_this_sum}}</span></td>
                                                <td class="text-center bg-primary text-white"><span class="">{{($liabilities_current_this_sum + $liabilities_fixed_this_sum) - ($liabilities_current_last_sum + $liabilities_fixed_last_sum)}}</span></td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد مطلوبات ثابتة حتى الآن</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row pt-5 pb-2 border-bottom" id="property-info">
                                    <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-coins ms-2"></i> المعلومات المالية | حقوق الملكية</h2>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col" width="40%">البند</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['LAST_YEAR']}}</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['THIS_YEAR']}}</th>
                                            <th scope="col" class="text-center">التغيير</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $rights = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 3) @endphp
                                        <?php $rights_last_sum = 0; $rights_this_sum = 0; ?>
                                        @if(count($rights) > 0)
                                            @foreach($rights as $item)
                                                <tr>
                                                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                                                    <td class="text-center"><?php $rights_last_sum += $item['LAST_YEAR_VALUE'] ?>{{$item['LAST_YEAR_VALUE']}}</td>
                                                    <td class="text-center"><?php $rights_this_sum += $item['THIS_YEAR_VALUE'] ?>{{$item['THIS_YEAR_VALUE']}}</td>
                                                    <td class="text-center">{{$item['THIS_YEAR_VALUE'] - $item['LAST_YEAR_VALUE']}}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="table-light">
                                                <th scope="row" class="table-light">المجموع</th>
                                                <td class="text-center table-light"><span class="">{{$rights_last_sum}}</span></td>
                                                <td class="text-center table-light"><span class="">{{$rights_this_sum}}</span></td>
                                                <td class="text-center table-light"><span class="">{{$rights_this_sum - $rights_last_sum}}</span></td>
                                            </tr>
                                            <tr class="bg-primary">
                                                <th scope="row" class="bg-primary text-white">مجموع الخصوم (المطلوبات + حقوق الملكية)</th>
                                                <td class="text-center bg-primary text-white"><span class="">{{$liabilities_current_last_sum + $liabilities_fixed_last_sum + $rights_last_sum}}</span></td>
                                                <td class="text-center bg-primary text-white"><span class="">{{$liabilities_current_this_sum + $liabilities_fixed_this_sum + $rights_this_sum}}</span></td>
                                                <td class="text-center bg-primary text-white"><span class="">{{($liabilities_current_this_sum + $liabilities_fixed_this_sum + $rights_this_sum) - ($liabilities_current_last_sum + $liabilities_fixed_last_sum + $rights_last_sum)}}</span></td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد حقوق ملكية حتى الآن</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row pt-5 pb-2 border-bottom" id="income-info">
                                    <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-wallet ms-2"></i> قائمة الدخل</h2>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col"  width="40%">البند</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['LAST_YEAR']}}</th>
                                            <th scope="col" class="text-center">سنة {{$details['data']['Fund_Data'][0]['THIS_YEAR']}}</th>
                                            <th scope="col"  class="text-center">التغيير</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $p_incomes = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 5) @endphp
                                        <?php $p_last_sum = 0; $p_this_sum = 0; ?>
                                        @if(count($p_incomes) > 0)
                                            @foreach($p_incomes as $index=>$item)
                                                <tr>
                                                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                                                    <td class="text-center"><?php $item['FINANCIAL_INFO_ID']==22?$p_last_sum=$item['LAST_YEAR_VALUE']:$p_last_sum=$p_last_sum-$item['LAST_YEAR_VALUE']; ?>{{$item['LAST_YEAR_VALUE']}}</td>
                                                    <td class="text-center"><?php $item['FINANCIAL_INFO_ID']==22?$p_this_sum=$item['THIS_YEAR_VALUE']:$p_this_sum=$p_this_sum-$item['THIS_YEAR_VALUE']; ?>{{$item['THIS_YEAR_VALUE']}}</td>
                                                    <td class="text-center">{{$item['THIS_YEAR_VALUE'] - $item['LAST_YEAR_VALUE']}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr class="table-light">
                                            <th scope="row" class="table-light">الربح الإجمالي</th>
                                            <td class="text-center table-light"><span class="">{{$p_last_sum}}</span></td>
                                            <td class="text-center table-light"><span class="">{{$p_this_sum}}</span></td>
                                            <td class="text-center table-light"><span class="">{{$p_this_sum - $p_last_sum}}</span></td>
                                        </tr>
                                        @php $exp_incomes = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 6) @endphp
                                        <?php $exp_last_sum = 0; $exp_this_sum = 0; ?>
                                        @if(count($exp_incomes) > 0)
                                            @foreach($exp_incomes as $item)
                                                <tr>
                                                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                                                    <td class="text-center"><?php $exp_last_sum += $item['LAST_YEAR_VALUE'] ?>{{$item['LAST_YEAR_VALUE']}}</td>
                                                    <td class="text-center"><?php $exp_this_sum += $item['THIS_YEAR_VALUE'] ?>{{$item['THIS_YEAR_VALUE']}}</td>
                                                    <td class="text-center">{{$item['THIS_YEAR_VALUE'] - $item['LAST_YEAR_VALUE']}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr class="table-light">
                                            <th scope="row" class="table-light">مجموع المصاريف</th>
                                            <td class="text-center table-light"><span class="">{{$exp_last_sum}}</span></td>
                                            <td class="text-center table-light"><span class="">{{$exp_this_sum}}</span></td>
                                            <td class="text-center table-light"><span class="">{{$exp_this_sum - $exp_last_sum}}</span></td>
                                        </tr>
                                        <tr class="table-light">
                                            <th scope="row" class="table-secondary">صافي الربح (الخسارة) التشغيلي قبل الضرائب</th>
                                            <td class="text-center table-secondary"><span class="">{{$p_last_sum - $exp_last_sum}}</span></td>
                                            <td class="text-center table-secondary"><span class="">{{$p_this_sum - $exp_this_sum}}</span></td>
                                            <td class="text-center table-secondary"><span class="">{{($p_this_sum - $exp_this_sum) - ($p_last_sum - $exp_last_sum)}}</span></td>
                                        </tr>
                                        @php $o_incomes = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 7) @endphp
                                        <?php $o_last_sum = 0; $o_this_sum = 0; ?>
                                        @if(count($o_incomes) > 0)
                                            @foreach($o_incomes as $item)
                                                <tr>
                                                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                                                    <td class="text-center"><?php $o_last_sum += $item['LAST_YEAR_VALUE'] ?>{{$item['LAST_YEAR_VALUE']}}</td>
                                                    <td class="text-center"><?php $o_this_sum += $item['THIS_YEAR_VALUE'] ?>{{$item['THIS_YEAR_VALUE']}}</td>
                                                    <td class="text-center">{{$item['THIS_YEAR_VALUE'] - $item['LAST_YEAR_VALUE']}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr>
                                            <th scope="row">صافي الربح (الخسارة) قبل الضرائب</th>
                                            <td class="text-center">{{($p_last_sum - $exp_last_sum) + $o_last_sum}}</td>
                                            <td class="text-center">{{($p_this_sum - $exp_this_sum) + $o_this_sum}}</td>
                                            <td class="text-center">{{(($p_this_sum - $exp_this_sum) + $o_this_sum) - (($p_last_sum - $exp_last_sum) + $o_last_sum)}}</td>
                                        </tr>
                                        @php $oth_incomes = collect($details['data']['FUND_FINANCIAL_INFORMATION'])->where('FINANCIAL_INFO_TYPE_ID', 4)->where('FINANCIAL_INFO_SUB_TYPE_ID', 8) @endphp
                                        <?php $oth_last_sum = 0; $oth_this_sum = 0; ?>
                                        @if(count($oth_incomes) > 0)
                                            @foreach($oth_incomes as $item)
                                                <tr>
                                                    <th scope="row">{{$item['FINANCIAL_INFO_DESC']}}</th>
                                                    <td class="text-center"><?php $oth_last_sum += $item['LAST_YEAR_VALUE'] ?>{{$item['LAST_YEAR_VALUE']}}</td>
                                                    <td class="text-center"><?php $oth_this_sum += $item['THIS_YEAR_VALUE'] ?>{{$item['THIS_YEAR_VALUE']}}</td>
                                                    <td class="text-center">{{$item['THIS_YEAR_VALUE'] - $item['LAST_YEAR_VALUE']}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr class="table-light">
                                            <th scope="row" class="table-light">صافي الربح (الخسارة) بعد الضريبة</th>
                                            <td class="text-center table-light"><span class="">{{(($p_last_sum - $exp_last_sum) + $o_last_sum) - $oth_last_sum}}</span></td>
                                            <td class="text-center table-light"><span class="">{{(($p_this_sum - $exp_this_sum) + $o_this_sum) - $oth_this_sum}}</span></td>
                                            <td class="text-center table-light"><span class="">{{((($p_this_sum - $exp_this_sum) + $o_this_sum) - $oth_this_sum) - ((($p_last_sum - $exp_last_sum) + $o_last_sum) - $oth_last_sum)}}</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row pt-5 pb-2 border-bottom" id="attachments-info">
                                    <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-paperclip ms-2"></i> المرفقات</h2>
                                </div>

                                @if(count($details['data']['FUND_ATTACHMENTS']) > 0)
                                    @foreach($details['data']['FUND_ATTACHMENTS'] as $item)
                                        @if($item['FILE_TYPE'] != '.png' || $item['FILE_TYPE'] != '.svg' || $item['FILE_TYPE'] != '.jpg' || $item['FILE_TYPE'] != '.jpeg')
                                            <div class=" d-flex border border-separator-light align-items-center rounded py-3 px-5 justify-content-between mb-3 mt-3">
                                                <a href="{{config('app.attach').'/'.$item['ATTACHMENT_ID']}}" target="_blank" download="" class="cursor"><i class="fa-solid fa-paperclip text-secondary iframe"></i> {{$item['DOC_CLASS_DESC']}}</a>
                                            </div>
                                        @else
                                            <div class=" d-flex border border-separator-light align-items-center rounded py-3 px-5 justify-content-between mb-3 mt-3">
                                                <a href="{{config('app.attach').'/'.$item['ATTACHMENT_ID']}}" target="_blank" download="" class="lightbox" data-caption="{{$item['DOC_CLASS_DESC']}}"><i class="fa-solid fa-paperclip text-secondary"></i> {{$item['DOC_CLASS_DESC']}}</a>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="pt-2">لا يوجد مرفقات حتى الآن</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade h-100" id="request-comments-1-pane" role="tabpanel" aria-labelledby="request-comments-1" tabindex="0">
            <div class="card loan-chat-box mb-2">
                <div class="card-body d-flex flex-column h-100 w-100 position-relative">

                    <div class="d-flex flex-row align-items-center mb-3">
                        <div class="row g-0 align-self-start" id="contactTitle">
                            <div class="col-auto">
                                <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border border-secondary ms-3">
                                    <i class="fa-solid fa-file-invoice fa-2x text-secondary"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body d-flex flex-row pt-0 pb-0 pe-0 pe-0 ps-2 h-100 align-items-center justify-content-between">
                                    <div class="d-flex flex-column">
                                        <div class="program">{{$details['data']['Fund_Data'][0]['PRODUCT_TYPE']}}</div>
                                        <div class="name fw-bold">{{$details['data']['Fund_Data'][0]['FINANCING_PURPOSE_DESC']}}</div>
                                        <div class=" text-secondary fw-bold h4 mb-0 last">{{number_format($details['data']['Fund_Data'][0]['FINANCING_VALUE'], 2)}} {{$details['data']['Fund_Data'][0]['GOOD_CURR_NAME']}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ms-1 me-auto">
                            @if($details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 0)
                                <div class="text-muted">
                                    <i class="fa-regular fa-file"></i> {{$details['data']['Fund_Data'][0]['FUND_STATUS_DESC']}}
                                </div>
                            @elseif($details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 1 || $details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 3)
                                <div class="text-success">
                                    <i class="fa-regular fa-circle-check"></i> {{$details['data']['Fund_Data'][0]['FUND_STATUS_DESC']}}
                                </div>
                            @elseif($details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 2)
                                <div class="text-muted">
                                    <i class="fa-solid fa-arrows-rotate"></i> {{$details['data']['Fund_Data'][0]['FUND_STATUS_DESC']}}
                                </div>
                            @elseif($details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 10 || $details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 13)
                                <div class="text-danger">
                                    <i class="fa-solid fa-circle-xmark"></i> {{$details['data']['Fund_Data'][0]['FUND_STATUS_DESC']}}
                                </div>
                            @endif
                            <div class="mb-2">
                                رقم الطلب: <span class="text-secondary fw-bold">{{$details['data']['Fund_Data'][0]['FUND_ID']}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="separator-light mb-3"></div>

                    <div class="h-100 mb-n2 scroll">
                        <div class="h-100 scroll-track-visible comment-scroll px-3" id="comments-{{$details['data']['Fund_Data'][0]['FUND_ID']}}">
                            @include('portal.orders.comments')
                        </div>
                    </div>
                </div>
            </div>
            @if($details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 1 || $details['data']['Fund_Data'][0]['FUND_STATUS_ID'] == 2)
            <div class="card">
                <form class="add-comment" id="comment-fund-{{$details['data']['Fund_Data'][0]['FUND_ID']}}" action="{{route('portal.orders.comment.add')}}">
                    <div class="card-body p-0 d-flex flex-row align-items-center px-3 py-3">
                        <input type="text" name="FUND_ID" value="{{$details['data']['Fund_Data'][0]['FUND_ID']}}" hidden>
                        <textarea class="form-control me-3 border-0 ps-2 py-2" placeholder="اكتب هنا" rows="1" name="FUND_COMMENT" id="FUND_COMMENT"></textarea>
                        <div class="d-flex flex-row">
                            <input class="file-upload d-none" type="file" name="FUND_ATTACHS" accept="{{acceptImagePdfType()}}" id="attachButton">
                            <label class="btn btn-icon btn-icon-only btn-outline-secondary mb-1 rounded-xl" for="attachButton" type="button">
                                <i class="fa-solid fa-paperclip"></i>
                            </label>
                            <button type="submit" class="comment-btn d-none"></button>
                            <button class="btn btn-icon btn-icon-only btn-secondary mb-1 rounded-xl me-1" onclick="submitComment(this)" type="button">
                                <div class="text"><i class="fa-solid fa-chevron-left"></i></div>
                                <div class="btn-loader d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>

    </div>
</div>
