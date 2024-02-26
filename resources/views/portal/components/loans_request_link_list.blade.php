<div class="col-md-auto mb-5 d-none d-lg-block col-lg-4 company-data" id="scrollSpyMenu_v2">
    <!-- Index Start -->
    <h2 class="h4">قائمة طلب القرض</h2>

    <div class="card mb-2">
        <div class="card-body px-5 py-4">
            <div class="mb-n2">
                <ul class="nav flex-column">
                    <li class="my-3">
                        <a href="{{route('portal.loan.request.main_info')}}" class="nav-link body-link d-flex align-items-center {{Route::is(['portal.loan.request.main_info'])?'text-secondary':''}}">
                            <i class="fa-solid fa-circle-info ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">البيانات العامة</span>
                        </a>
                    </li>
                    <li class="my-3">
                        <a href="{{route('portal.loan.request.payment_sources')}}" class="nav-link body-link d-flex align-items-center {{Route::is(['portal.loan.request.payment_sources'])?'text-secondary':''}}">
                            <i class="fa-regular fa-money-bill-1 ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">مصادر السداد</span>
                        </a>
                    </li>
                    <li class="my-3">
                        <a href="{{route('portal.loan.request.warranties')}}" class="nav-link body-link d-flex align-items-center {{Route::is(['portal.loan.request.warranties'])?'text-secondary':''}}">
                            <i class="fa-solid fa-layer-group ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">الضمانات</span>
                        </a>
                    </li>
                    <li class="my-3">
                        <a href="#financial_information" data-bs-toggle="collapse" aria-expanded="true" class="nav-link body-link d-flex align-items-center dropdown-toggle {{Route::is(['portal.loan.request.assets', 'portal.loan.request.liabilities', 'portal.loan.request.property_rights'])?'text-secondary':''}}">
                            <i class="fa-solid fa-coins ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">المعلومات المالية</span>
                        </a>

                        <div class="collapse show" id="financial_information">
                            <a href="{{route('portal.loan.request.assets')}}" class="nav-link body-link d-flex align-items-center mt-3 me-3 {{Route::is(['portal.loan.request.assets'])?'text-secondary':''}}">
                                <i class="fa-solid fa-chevron-left ms-2 sw-2"></i>
                                <span class="align-middle flex-grow-1">الموجودات</span>
                            </a>
                            <a href="{{route('portal.loan.request.liabilities')}}" class="nav-link body-link d-flex align-items-center mt-3 me-3 {{Route::is(['portal.loan.request.liabilities'])?'text-secondary':''}}">
                                <i class="fa-solid fa-chevron-left ms-2 sw-2"></i>
                                <span class="align-middle flex-grow-1">المطلوبات</span>
                            </a>
                            <a href="{{route('portal.loan.request.property_rights')}}" class="nav-link body-link d-flex align-items-center mt-3 me-3 {{Route::is(['portal.loan.request.property_rights'])?'text-secondary':''}}">
                                <i class="fa-solid fa-chevron-left ms-2 sw-2"></i>
                                <span class="align-middle flex-grow-1">حقوق الملكية</span>
                            </a>
                        </div>

                    </li>
                    <li class="my-3">
                        <a href="{{route('portal.loan.request.income_statement')}}" class="nav-link body-link d-flex align-items-center {{Route::is(['portal.loan.request.income_statement'])?'text-secondary':''}}">
                            <i class="fa-solid fa-circle-info ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">قائمة الدخل</span>
                        </a>
                    </li>
                    <li class="my-3">
                        <a href="{{route('portal.loan.request.attachments')}}" class="nav-link body-link d-flex align-items-center {{Route::is(['portal.loan.request.attachments'])?'text-secondary':''}}">
                            <i class="fa-solid fa-paperclip  ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">المرفقات</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>


    <!-- Index End -->
</div>
