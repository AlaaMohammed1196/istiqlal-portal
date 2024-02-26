@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-12 col-lg-6">
{{--                    <a href="{{route('portal.v2.home')}}">الرئيسية</a>--}}
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold fs-5" id="title">أهلاً وسهلاً بك في بوابة بنك الاستقلال للاستثمار والتنمية!</h1>
                    <h3 class="my-3 pb-0 fw-normal text-primary fs-5">مرحباً {{session()->get('user')['COMPANY_NAME']}}، نتمنى لك يوم جميل</h3>
                </div>
                <!-- Title End -->

                <div class="col-12 col-md-12 col-lg-6">
                    @if(isset(session()->get('userData')['LAST_ACTIVITY_DATE']))
                    <div class="alert alert-info alert-dismissible fade show w-100" role="alert">
                        <strong>أخر عملية تسجيل دخول </strong>
                        <span>تمت في تاريخ
                            {{Carbon\Carbon::parse(session()->get('userData')['LAST_ACTIVITY_DATE'])->translatedFormat('d/m/Y h:m a')}}
                        </span>
                    </div>
                    @endif
                    @if(session()->get('user')['PASS_EXPIRED_SOON_FLAG'] == 1)
                        <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                            <strong>يجب تغيير كلمة المرور </strong>
                            <span>قبل تاريخ "{{session()->get('user')['PASS_EXPIRE_ON']}}" و ذلك لضمان استمرارية تفعيل الحساب</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 mb-5">
                <div class="card w-100 sh-100 bg-dark h-100 hover-img-scale-up position-relative home_image">
                    <div class="row align-items-center h-100 gx-0">
                        <div class="col-xxl-4 col-xl-3 col-lg-4 col-md-4 col-sm-4 h-100">
                            <img src="{{asset('assets')}}/img/home.png" class="h-100 w-100" alt="" />
                        </div>
                        <div class="col-xxl-8 col-xl-9 col-lg-8 align-items-center col-md-8 col-sm-8 h-100">
                            <div class="bg-transparent d-flex justify-content-center flex-column h-100 px-3">
                                <div class="cta-2 text-white"></div>
                                <div class="cta-2 mb-3 text-white fw-bold">بنك الاستقلال للاستثمار والتنمية</div>
                                <div class="text-white lh-lg mb-3 d-none d-md-block">يعمل وفق أفضل الممارسات وبالشراكة مع المؤسسات والهيئات الرسمية والصناديق الحكومية والقطاع الخاص، بما يسرع عملية التنمية الاجتماعية والاقتصادية في فلسطين</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <!-- Stats Start -->
                <div class="row gx-2">
                    <div class="col-12 p-0">
                        <div class="glide glide-small" id="statsCarousel">
                            <div class="glide__track" data-glide-el="track">
                                <div class="glide__slides">
                                    <div class="glide__slide">
                                        <div class="card mb-5 hover-border-secondary">
                                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                                <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border border-secondary mt-4">
                                                    <i class="fa-solid fa-calculator fa-2x text-secondary"></i>
                                                </div>
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deposits_calculator" class="text-center mb-4 h4 sh-8 d-flex align-items-center fw-bold lh-1-5 stretched-link">
                                                    حاسبة فوائد الودائع
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="glide__slide">
                                        <div class="card mb-5 hover-border-secondary">
                                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                                <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border border-secondary mt-4">
                                                    <i class="fa-solid fa-file-invoice fa-2x text-secondary"></i>
                                                </div>
                                                <a href="{{route('portal.v2.accounts.index')}}" class="text-center mb-4 h4 sh-8 d-flex align-items-center fw-bold lh-1-5 stretched-link">
                                                    حساباتي
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="glide__slide">
                                        <div class="card mb-5 hover-border-secondary">
                                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                                <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border border-secondary mt-4">
                                                    <i class="fa-solid fa-file-invoice fa-2x text-secondary"></i>
                                                </div>
                                                <a href="{{route('portal.v2.deposits.index')}}" class="text-center mb-4 h4 sh-8 d-flex align-items-center fw-bold lh-1-5 stretched-link">
                                                    الودائع
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Stats End -->

            </div>
        </div>

        @if(count($transactions) > 0)
            <div class="row">
                <div class="col-xl-6 mb-5">
                    <div class=" card w-100 sh-100 bg-dark h-100 hover-img-scale-up position-relative">
                        <img src="{{asset('assets')}}/img/banner/dashboard-account.webp" class="card-img h-100 scale position-absolute" alt="" />
                        <div class="card-img-overlay dashboard-account align-items-center bg-transparent">
                            <img class="logo" src="{{asset('assets')}}/img/logo/logo.png" alt="">
                            <div class="d-flex justify-content-between py-4">
                                <div  class="col-lg-6">
                                    <div class="cta-2 text-white"></div>
                                    <div class="h4 mb-3 text-white fw-bold"></div>
{{--                                    <div class="cta-2 text-white">{{$transactions[0]['ACCOUNT_TYPE_DESC']}}</div>--}}
{{--                                    <div class="h4 mb-3 text-white fw-bold">{{$transactions[0]['ACCOUNT_NUM']}}</div>--}}
                                </div>
                                <div  class="col-lg-6 text-start">
                                    <div class="cta-2 text-white"></div>
                                    <div class="h4 mb-3 text-white fw-bold"></div>
{{--                                    <div class="cta-2 text-white">الرصيد المتوفر</div>--}}
{{--                                    <div class="h4 mb-3 text-white fw-bold">{{NumberFormat($transactions[0]['AVAILABLE_BALANCE'], $transactions[0]['CURR_DECIMAL_PLACES'])}} {{$transactions[0]['CURR_NAME_DESC']}}</div>--}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div  class="col-lg-6">
                                    <div class="cta-2 text-white"></div>
                                    <div class="h4 mb-3 text-white fw-bold"></div>
{{--                                    <div class="cta-2 text-white">اخر حركة</div>--}}
{{--                                    <div class="h4 mb-3 text-white fw-bold">{{$transactions[0]['LAST_TRANS_DATE']}}</div>--}}
                                </div>
                                <div  class="col-lg-6 text-start">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <form id="filter_form" class="d-none"></form>
                    <h2 class="h5 fw-bold">آخر الحركات</h2>
                    <!-- Item List Start -->
                    <div class="row" id="items_here">
                        @include('portal_v2.home.table')
                    </div>
                </div>
            </div>
        @endif

        <div class="modal fade" id="row_notes" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body wizard" id="wizardBasic">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('style')
    <style>
        html[dir="rtl"] .form-floating > label {
            right: unset;
            left: unset;
        }
        .home_image{
            background-color: #434F59!important;
        }
    </style>
@endpush

@push('script')
    <script>
        let sortValues = [];
        sortValues['ORDER_COLUMN_NAME'] = '';
        sortValues['ORDER_TYPE'] = '';
        sortValues['IS_COLUMN_DATE'] = '';
        sortableTable('{{route('portal.v2.home')}}');

        $(document).on('click', '.display_notes', function (e){
            let notes = $(this).attr('data-notes');
            $('#row_notes .modal-body').html('<p>'+notes+'</p>');
            $('#row_notes').modal('show');
        })
    </script>
@endpush

@push('page_style')
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/glide.core.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/bootstrap-datepicker3.standalone.min.css" />
@endpush

@push('page_script')
    <script src="{{asset('assets')}}/js/cs/glide.custom.js"></script>
    <script src="{{asset('assets')}}/js/pages/dashboard.default.js"></script>

    <script src="{{asset('assets')}}/js/vendor/movecontent.js"></script>
    <script src="{{asset('assets')}}/js/vendor/select2.full.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/profile.settings.js"></script>
    <script src="{{asset('assets')}}/js/forms/layouts.js"></script>
    <!-- Chart -->
    <script src="{{asset('assets')}}/js/vendor/moment-with-locales.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/Chart.bundle.min.js"></script>
    <script src="{{asset('assets')}}/js/cs/charts.extend.js"></script>
    <script src="{{asset('assets')}}/js/plugins/charts.js"></script>
    <!-- End Chart -->

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
