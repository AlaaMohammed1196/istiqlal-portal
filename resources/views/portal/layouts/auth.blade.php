<!DOCTYPE html>
<html lang="ar" dir="rtl">
@include('portal.layouts.auth_head')

<body class="h-100 rtl">
<div id="root" class="h-100 pb-0">
    <!-- Background Start -->
    <div class="fixed-background"></div>
    <!-- Background End -->

    <div class="container-fluid p-0 h-100 position-relative">
        <div class="row g-0 h-100">
            <!-- Left Side Start -->
            <div class="offset-0 col-12 d-none d-lg-flex offset-md-1 col-lg h-lg-100">
                <div class="min-h-100 d-flex align-items-center">
                    <div class="w-100 w-lg-75 w-xxl-50">
                        <div>
                            <div class="mb-5">
                                <h1 class="display-3 fw-bold text-white">بنك الاستقلال للاستثمار والتنمية</h1>
                            </div>
                            <p class="h4 text-white lh-lg mb-5">
                                 يعمل وفق أفضل الممارسات وبالشراكة مع المؤسسات والهيئات الرسمية والصناديق الحكومية والقطاع الخاص، بما يسرع عملية التنمية الاجتماعية والاقتصادية في فلسطين
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Left Side End -->

            <!-- Right Side Start -->
            @yield('content')
            <!-- Right Side End -->
        </div>
    </div>
</div>


@include('portal.layouts.auth_scripts')
</body>
</html>
