<div id="nav" class="nav-container d-flex">
    <div class="nav-content d-flex">
        <!-- Logo Start -->
        <div class="logo position-relative">
{{--            <a href="{{route('portal.home')}}">--}}
                <!-- Logo can be added directly -->
                <img src="{{asset('assets')}}/img/logo/logo.png" alt="" class="large-logo"/>
                <img src="{{asset('assets/img/favicon/favicon-128.png')}}" alt="" class="small-logo"/>
                <!-- Or added via css to provide different ones for different color themes -->
                <!-- <div class="img"></div> -->
            </a>
        </div>
        <!-- Logo End -->

        <!-- User Menu Start -->
        <div class="user-container d-flex">
            <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="profile" alt="profile" src="{{session()->get('user')['USER_PICTURE_LINK']?session()->get('user')['USER_PICTURE_LINK']:asset('default.jpg')}}" />
                <div class="name">{{session()->get('user')['USER_FULL_NAME']}}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-end user-menu wide">
                <div class="row mb-1 ms-0 me-0">
                    <div class="col-12 pe-1 ps-1">
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{route('portal.v2.profile.index')}}">
                                    <i data-acorn-icon="lock-off" class="me-2" data-acorn-size="17"></i>
                                    <span class="align-middle">تغيير كلمة المرور</span>
                                </a>
                            </li>
                            <div class="separator-light my-2"></div>
                            <li>
                                <a href="{{route('portal.v2.logout')}}">
                                    <i data-acorn-icon="logout" class="me-2" data-acorn-size="17"></i>
                                    <span class="align-middle">الخروج</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Menu End -->

        <!-- Icons Menu Start -->
        <ul class="list-unstyled list-inline text-center menu-icons">
{{--            <li class="list-inline-item">--}}
{{--                <a href="#" data-bs-toggle="modal" data-bs-target="#searchPagesModal" title="بحث">--}}
{{--                    <i data-acorn-icon="search" data-acorn-size="18"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="list-inline-item">
                <a href="#" id="pinButton" class="pin-button" title="تثبيت القائمة">
                    <i data-acorn-icon="lock-on" class="unpin" data-acorn-size="18"></i>
                    <i data-acorn-icon="lock-off" class="pin" data-acorn-size="18"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" id="colorButton" title="الوضع المظلم">
                    <i data-acorn-icon="light-on" class="light" data-acorn-size="18"></i>
                    <i data-acorn-icon="light-off" class="dark" data-acorn-size="18"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#" data-bs-toggle="dropdown" data-bs-target="#notifications" aria-haspopup="true" aria-expanded="false" class="notification-button" title="الإشعارات">
                    <div class="position-relative d-inline-flex">
                        <i data-acorn-icon="bell" data-acorn-size="18"></i>
                        <span class="position-absolute {{count($notifications['UnReadNotifications']['Notifications'])>0?'notification-dot':''}} rounded-xl"></span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end wide notification-dropdown scroll-out" id="notifications">
                    <div class="scroll">
                        <ul class="list-unstyled border-last-none">
                            @if(count($notifications['AllNotifications']['Notifications']) > 0)
                                @foreach($notifications['AllNotifications']['Notifications'] as $noti)
                                    <li class="mb-3 pb-3 border-bottom border-separator-light row gx-0">
                                        <div class="col-auto">
                                            <div class="sw-4 sh-4 rounded-xl d-flex justify-content-center align-items-center border border-secondary ms-3">
                                                <i class="fa-regular fa-bell text-secondary"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="align-self-center">
                                                <a href="@if(Route::has($noti['PAGE_URL'])) {{$noti['PAGE_URL']=='portal.v2.tickets.show'||$noti['PAGE_URL']=='portal.v2.deposits.show'?route($noti['PAGE_URL'], $noti['REFERENCE_NUM']):route($noti['PAGE_URL'])}} @else javascript:void(0); @endif">
                                                    <h6 class="fw-bold text-secondary">{{$noti['SUBJECT']}}</h6>
                                                    <p>{{$noti['BODY_CONTENT']}}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <p class="text-center">لا يوجد إشعارات لديك</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </li>
            <li class="list-inline-item">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deposits_calculator" title="حاسبة فوائد الودائع">
                    <i class="fa-solid fa-calculator ms-2"></i>
                </a>
            </li>
        </ul>
        <!-- Icons Menu End -->

        <!-- Menu Start -->
        <div class="menu-container flex-grow-1">
            <ul id="menu" class="menu">
                <li>
                    <a href="{{route('portal.v2.home')}}">
                        <i class="fa-solid fa-table-columns ms-2"></i>
                        <span class="label">الرئيسية</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.v2.profile.index')}}">
                        <i class="fa-regular fa-id-card ms-2"></i>
                        <span class="label">الملف الشخصي</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.v2.company.info.index')}}">
                        <i class="fa-regular fa-id-card ms-2"></i>
                        <span class="label">بيانات الشركة</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.v2.accounts.index')}}">
                        <i class="fa-solid fa-file-invoice ms-2"></i>
                        <span class="label">حساباتي</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.v2.transfers.index')}}">
                        <i class="fa-solid fa-file-invoice ms-2"></i>
                        <span class="label">الحوالات</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.v2.beneficiaries.index')}}">
                        <i class="fa-solid fa-file-invoice ms-2"></i>
                        <span class="label">المستفيدين</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.v2.deposits.index')}}">
                        <i class="fa-solid fa-file-invoice ms-2"></i>
                        <span class="label">الودائع</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.v2.checks.index')}}">
                        <i class="fa-solid fa-file-invoice-dollar ms-2"></i>
                        <span class="label">الشيكات</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.v2.orders.index')}}">
                        <i class="fa-solid fa-file-invoice-dollar ms-2"></i>
                        <span class="label">{{in_array(1, array_column(Session::get('userData')['USER_ROLES'], 'ROLE_ID'))?'طلباتي':'الحركات التي تحتاج الى موافقة'}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.v2.currencies.index')}}">
                        <i class="fa-solid fa-file-invoice-dollar ms-2"></i>
                        <span class="label">العملات</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.v2.tickets.index')}}">
                        <i class="fa-solid fa-circle-info ms-2"></i>
                        <span class="label">التذاكر</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.v2.technicalSupport.index')}}">
                        <i class="fa-solid fa-circle-info ms-2"></i>
                        <span class="label">الدعم الفني</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Menu End -->

        <!-- Mobile Buttons Start -->
        <div class="mobile-buttons-container">
            <!-- Scrollspy Mobile Button Start -->
            <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
                <i data-acorn-icon="menu-dropdown"></i>
            </a>
            <!-- Scrollspy Mobile Button End -->

            <!-- Scrollspy Mobile Dropdown Start -->
            <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
            <!-- Scrollspy Mobile Dropdown End -->

            <!-- Menu Button Start -->
            <a href="#" id="mobileMenuButton" class="menu-button">
                <i data-acorn-icon="menu"></i>
            </a>
            <!-- Menu Button End -->
        </div>
        <!-- Mobile Buttons End -->
    </div>
    <div class="nav-shadow"></div>
</div>
