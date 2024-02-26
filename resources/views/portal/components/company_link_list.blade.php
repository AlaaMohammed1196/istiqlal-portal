<div class="col-md-auto mb-5 d-none d-lg-block col-lg-4 company-data" id="scrollSpyMenu_v2">
    <h2 class="h4">قائمة بيانات الشركة</h2>
    <div class="card mb-2">
        <div class="card-body px-5 py-4">
            <div class="mb-n2">
                <ul class="nav flex-column">
                    <li class="my-3">
                        <a href="{{route('portal.company.info.index')}}" class="nav-link body-link d-flex align-items-center position-relative {{Route::is(['portal.company.info.index', 'portal.company.info.edit'])?'text-secondary':''}}">
                            @if($constants['CompanyProfileData']['CompanyGeneralInfo']['CompanyGeneralInfo'][0]['IS_COMPANY_GENERAL_INFO_COMPLETED'] == 1)
                                <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                            @else
                                <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                            @endif
                            <i class="fa-solid fa-circle-info ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">البيانات العامة</span>
                        </a>
                    </li>
                    <li class="my-3">
                        <a href="{{route('portal.company.contact.index')}}" class="nav-link body-link d-flex align-items-center position-relative {{Route::is(['portal.company.contact.index', 'portal.company.contact.edit'])?'text-secondary':''}}">
                            @if($constants['CompanyProfileData']['CompanyGeneralInfo']['CompanyContactInfo']['IS_COMPANY_CONTACTL_INFO_COMPLETED'] == 1)
                                <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                            @else
                                <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                            @endif
                            <i class="fa-solid fa-address-card ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">بيانات العنوان والاتصال</span>
                        </a>
                    </li>
                    <li class="my-3">
                        <a href="{{route('portal.company.partner.index')}}" class="nav-link body-link d-flex align-items-center position-relative {{Route::is(['portal.company.partner.index', 'portal.company.partner.add.index', 'portal.company.partner.add.person', 'portal.company.partner.add.firm', 'portal.company.partner.edit.person', 'portal.company.partner.edit.firm'])?'text-secondary':''}}">
                            @if($constants['CompanyProfileData']['IS_COMPANY_PARTNERS_INFO_COMPLETED'] == 1)
                                <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                            @else
                                <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                            @endif
                            <i class="fa-solid fa-handshake ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">الشركاء</span>
                        </a>
                    </li>
                    <li class="my-3">
                        <a href="{{route('portal.company.board.index')}}" class="nav-link body-link d-flex align-items-center position-relative {{Route::is(['portal.company.board.index'])?'text-secondary':''}}">
                            @if($constants['CompanyProfileData']['IS_COMPANY_BOARD_MEMBERS_INFO_COMPLETED'] == 1)
                                <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                            @else
                                <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                            @endif
                            <i class="fa-solid fa-users ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">بيانات أعضاء مجلس الإدارة</span>
                        </a>
                    </li>
                    <li class="my-3">
                        <a href="{{route('portal.company.management.index')}}" class="nav-link body-link d-flex align-items-center position-relative {{Route::is(['portal.company.management.index'])?'text-secondary':''}}">
                            @if($constants['CompanyProfileData']['IS_COMPANY_EXECUTIVE_MEMBERS_INFO_COMPLETED'] == 1)
                                <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                            @else
                                <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                            @endif
                            <i class="fa-solid fa-user-tie ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">الإدارة التنفيذية والمفوضون</span>
                        </a>
                    </li>
                    <li class="my-3">
                        <a href="#company_Activity" data-bs-toggle="collapse" aria-expanded="true" class="nav-link body-link d-flex align-items-center position-relative dropdown-toggle {{Route::is(['portal.company.activity.description.index', 'portal.company.activity.selling.index', 'portal.company.activity.buying.index', 'portal.company.activity.competitors.index'])?'text-secondary':''}}">
                            <i class="fa-solid fa-building ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">نشاط الشركة</span>
                        </a>
                        <div class="collapse show" id="company_Activity">
                            <a href="{{route('portal.company.activity.description.index')}}" class="nav-link body-link d-flex align-items-center position-relative mt-3 me-3 {{Route::is(['portal.company.activity.description.index', 'portal.company.activity.description.edit'])?'text-secondary':''}}">
                                @if($constants['CompanyProfileData']['IS_COMPANY_ACTIVITY_INFO_COMPLETED'] == 1)
                                    <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                                @else
                                    <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                                @endif
                                <i class="fa-solid fa-chevron-left ms-2 sw-2"></i>
                                <span class="align-middle flex-grow-1">وصف النشاط</span>
                            </a>
                            <a href="{{route('portal.company.activity.selling.index')}}" class="nav-link body-link d-flex align-items-center position-relative mt-3 me-3 {{Route::is(['portal.company.activity.selling.index', 'portal.company.activity.selling.edit'])?'text-secondary':''}}">
                                @if($constants['CompanyProfileData']['IS_COMPANY_SELL_POLICY_INFO_COMPLETED'] == 1)
                                    <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                                @else
                                    <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                                @endif
                                <i class="fa-solid fa-chevron-left ms-2 sw-2"></i>
                                <span class="align-middle flex-grow-1">تفاصيل سياسة البيع</span>
                            </a>
                            <a href="{{route('portal.company.activity.buying.index')}}" class="nav-link body-link d-flex align-items-center position-relative mt-3 me-3 {{Route::is(['portal.company.activity.buying.index', 'portal.company.activity.buying.edit'])?'text-secondary':''}}">
                                @if($constants['CompanyProfileData']['IS_COMPANY_BUY_POLICY_INFO_COMPLETED'] == 1)
                                    <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                                @else
                                    <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                                @endif
                                <i class="fa-solid fa-chevron-left ms-2 sw-2"></i>
                                <span class="align-middle flex-grow-1">تفاصيل سياسة الشراء</span>
                            </a>
                            <a href="{{route('portal.company.activity.competitors.index')}}" class="nav-link body-link d-flex align-items-center position-relative mt-3 me-3 {{Route::is(['portal.company.activity.competitors.index'])?'text-secondary':''}}">
                                @if($constants['CompanyProfileData']['IS_COMPANY_COMPETITORS_INFO_COMPLETED'] == 1)
                                    <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                                @else
                                    <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                                @endif
                                <i class="fa-solid fa-chevron-left ms-2 sw-2"></i>
                                <span class="align-middle flex-grow-1">أهم المنافسين</span>
                            </a>
                        </div>
                    </li>
                    <li class="my-3">
                        <a href="{{route('portal.company.acknowledgement.index')}}" class="nav-link body-link d-flex align-items-center position-relative {{Route::is(['portal.company.acknowledgement.index', 'portal.company.acknowledgement.store'])?'text-secondary':''}}">
                            @if($constants['CompanyProfileData']['IS_COMPANY_ACKNOWLEDGMENTS_INFO_COMPLETED'] == 1)
                                <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                            @else
                                <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                            @endif
                            <i class="fa-solid fa-file-lines ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">بيانات الإقرار</span>
                        </a>
                    </li>
                    <li class="my-3">
                        <a href="{{route('portal.company.note.index')}}" class="nav-link body-link d-flex align-items-center position-relative {{Route::is(['portal.company.note.index', 'portal.company.note.edit'])?'text-secondary':''}}">
                            @if($constants['CompanyProfileData']['IS_COMPANY_NOTES_INFO_COMPLETED'] == 1)
                                <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                            @else
                                <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                            @endif
                            <i class="fa-solid fa-message ms-2 sw-2"></i>
                            <span class="align-middle flex-grow-1">الملاحظات</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
