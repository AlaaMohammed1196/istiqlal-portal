@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">بيانات الشركة</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.company.info.index')}}">بيانات الشركة</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.company.partner.index')}}">الشركاء</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.company.partner.add.index')}}">إضافة شريك</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row gx-5">
            @include('portal.components.company_link_list')
            <div class="col-lg-8 col-xl-8">
                <!-- Details Start -->
                <h2 class="h4">إضافة شريك</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 col-md-6 ">
                                <a href="{{route('portal.company.partner.add.person')}}" class="row g-0 p-3 rounded-md mb-2 no-shadow border align-items-center">
                                    <div class="col-12 d-flex justify-content-center">
                                        <div class="border border-secondary sw-7 sh-7 sw-sm-10 sh-sm-10 rounded-xl d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-user text-secondary fa-2x  "></i>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        <div class="p-0 px-sm-3">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h4 class="h4 fw-bold">فرد</h4>
                                                <p >اختر هذه لإضافة شخص كشريك لك</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 col-md-6 ">
                                <a href="{{route('portal.company.partner.add.firm')}}" class="row g-0 p-3 rounded-md mb-2 no-shadow border align-items-center">
                                    <div class="col-12 d-flex justify-content-center">
                                        <div class="border border-secondary sw-7 sh-7 sw-sm-10 sh-sm-10 rounded-xl d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-building text-secondary fa-2x"></i>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        <div class="p-0 px-sm-3">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h4 class="h4 fw-bold">مؤسسة</h4>
                                                <p >اختر هذه لإضافة مؤسسة كشريك لك</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Details End -->
            </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
@endpush

@push('page_style')
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/bootstrap-datepicker3.standalone.min.css" />
@endpush

@push('page_script')
    <script src="{{asset('assets')}}/js/vendor/movecontent.js"></script>
    <script src="{{asset('assets')}}/js/vendor/select2.full.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/profile.settings.js"></script>

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
