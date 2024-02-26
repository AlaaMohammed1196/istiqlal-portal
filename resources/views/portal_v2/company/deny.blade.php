@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">بيانات الشركة</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.company.info.index')}}">بيانات الشركة</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.company.info.index')}}">البيانات العامة</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row gx-5">
            <section class="scroll-section" id="twoRows">
                <div class="row g-0">
                    <div class="col mb-2 justify-content-end align-items-center text-semi-large text-muted d-none d-md-flex">{{$data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE']?\Carbon\Carbon::parse($data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE'])->translatedFormat('d/m/Y'):''}}</div>
                    <div class="col-auto sw-7 d-flex flex-column justify-content-center align-items-center position-relative me-4 ms-0 ms-md-4">
                        <div class="w-100 d-flex h-100"></div>
                        <div class="bg-foreground sw-7 sh-7 rounded-lg shadow d-flex flex-shrink-0 justify-content-center align-items-center mt-n2 position-relative">
                            <div class="bg-gradient-light sw-5 sh-5 rounded-md">
                                <div class="text-white d-flex justify-content-center align-items-center h-100">01</div>
                            </div>
                        </div>
                        <div class="w-100 d-flex h-100 justify-content-center position-relative">
                            <div class="line-w-1 bg-separator h-100 position-absolute"></div>
                        </div>
                    </div>
                    <div class="col mb-2">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-start">
                                <div class="d-flex flex-column">
                                    <a href="javascript:void(0);" class="heading stretched-link"><i class="fa-regular fa-circle-check  text-secondary"></i> تم التسجيل بنجاح</a>
                                    <div class="text-alternate d-md-none mb-2">{{$data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE']?\Carbon\Carbon::parse($data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE'])->translatedFormat('d/m/Y'):''}}</div>
                                    <div class="text-muted">
                                        يسعدنا اختيارك لنا والتسجيل لدينا
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col mb-2 justify-content-start align-items-center text-semi-large text-muted d-none d-md-flex order-md-3">{{$data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE']?\Carbon\Carbon::parse($data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE'])->translatedFormat('d/m/Y'):''}}</div>
                    <div class="col-auto sw-7 d-flex flex-column justify-content-center align-items-center position-relative me-4 ms-0 ms-md-4 order-md-2">
                        <div class="w-100 d-flex h-100 justify-content-center position-relative">
                            <div class="line-w-1 bg-separator h-100 position-absolute"></div>
                        </div>
                        <div class="bg-foreground sw-7 sh-7 rounded-lg shadow d-flex flex-shrink-0 justify-content-center align-items-center mt-n2 position-relative">
                            <div class="bg-gradient-light sw-5 sh-5 rounded-md">
                                <div class="text-white d-flex justify-content-center align-items-center h-100">02</div>
                            </div>
                        </div>
                        <div class="w-100 d-flex h-100 justify-content-center position-relative">
                            <div class="line-w-1 bg-separator h-100 position-absolute"></div>
                        </div>
                    </div>
                    <div class="col mb-2 order-md-1">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-start">
                                <div class="d-flex flex-column text-md-end">
                                    <a href="javascript:void(0);" class="heading stretched-link"><i class="fa-solid fa-loader Spinner"></i> بيانات الشركة بإنتظار الموافقة</a>
                                    <div class="text-alternate d-md-none mb-2">{{$data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE']?\Carbon\Carbon::parse($data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE'])->translatedFormat('d/m/Y'):''}}</div>
                                    <div class="text-muted">نقوم بمراجعة وتدقيق البيانات التي قمت بتقديمها عن الشركة أثناء التسجيل، سيتم إبلاغك بالنتيجة قريبا</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
