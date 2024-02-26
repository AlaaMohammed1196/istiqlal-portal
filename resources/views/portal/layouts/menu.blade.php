<div id="nav" class="nav-container d-flex">
    <div class="nav-content d-flex">
        <!-- Logo Start -->
        <div class="logo position-relative">
            <a href="{{route('portal.home')}}">
                <!-- Logo can be added directly -->
                <img src="{{asset('assets')}}/img/logo/logo.png" alt="" />

                <!-- Or added via css to provide different ones for different color themes -->
                <!-- <div class="img"></div> -->
            </a>
        </div>
        <!-- Logo End -->

        <!-- Language Switch Start -->
{{--        <div class="language-switch-container">--}}
{{--            <button class="btn btn-empty language-button dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">العربية</button>--}}
{{--            <div class="dropdown-menu">--}}
{{--                <a href="#" class="dropdown-item">English</a>--}}
{{--                <a href="#" class="dropdown-item active">العربية</a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- Language Switch End -->

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
                                <a href="{{route('portal.profile.index')}}">
                                    <i data-acorn-icon="lock-off" class="me-2" data-acorn-size="17"></i>
                                    <span class="align-middle">تغيير كلمة المرور</span>
                                </a>
                            </li>
                            <div class="separator-light my-2"></div>
                            <li>
                                <a href="{{route('portal.logout')}}">
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
                                                <a href="@if(Route::has($noti['PAGE_URL'])) {{route($noti['PAGE_URL'])}} @else javascript:void(0);@endif">
                                                    <h6 class="fw-bold text-secondary">{{$noti['SUBJECT']}}</h6>
                                                    <p>{{$noti['BODY_CONTENT']}}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <p class="text-center">لا يوجد إشعارات</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </li>
            <li class="list-inline-item">
                <a href="{{asset('user_manual/story.html')}}" target="_blank" title="دليل المستخدم">
                    <i data-acorn-icon="question-circle"  data-acorn-size="18"></i>
                </a>
            </li>
        </ul>
        <!-- Icons Menu End -->

        <!-- Menu Start -->
        <div class="menu-container flex-grow-1">
            <ul id="menu" class="menu">
                <li>
                    <a href="{{route('portal.home')}}">
                        <i class="fa-solid fa-table-columns ms-2"></i>
                        <span class="label">الرئيسية</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.profile.index')}}">
                        <i class="fa-regular fa-id-card ms-2"></i>
                        <span class="label">الملف الشخصي</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.company.info.index')}}">
                        <i class="fa-regular fa-id-card ms-2"></i>
                        <span class="label">بيانات الشركة</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.orders.index')}}">
                        <i class="fa-solid fa-file-invoice ms-2"></i>
                        <span class="label">طلباتي</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.loans.index')}}">
                        <i class="fa-solid fa-file-invoice ms-2"></i>
                        <span class="label">قروضي</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.currencies.index')}}">
                        <i class="fa-solid fa-file-invoice-dollar ms-2"></i>
                        <span class="label">العملات</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('portal.technicalSupport.index')}}">
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
