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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.info.index')}}">البيانات العامة</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row gx-5">
            @include('portal.components.company_link_list')
            <div class="col-lg-8 col-xl-6">
                <!-- Details Start -->
                <h2 class="h4">البيانات العامة</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5">
                            <div class="row g-0 align-items-start mb-2">
                                <div class="col-12 col-md-2 col-xl-2  d-flex justify-content-between align-items-center justify-content-md-center flex-md-column ">
                                    <div class="border border-secondary sw-7 sh-7 sw-sm-10 sh-sm-10 rounded-xl d-flex justify-content-center align-items-center mb-3">
                                        <i class="fa-solid fa-circle-info text-secondary fa-2x fa-x2 "></i>
                                    </div>
                                    <a href="{{route('portal.company.info.edit')}}" class="text-nowrap"><i class="fa-solid fa-pen-to-square"></i> تعديل البيانات</a>
                                </div>
                                <div class="col-12  col-md-10  col-xl-10 pe-3">
                                    <div class="row g-0  py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">الشركة</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['PROFILE_NAME_NA']??'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">رقم المشتغل/التسجيل</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['ID_NUM']??'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0 py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">الشكل القانوني</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-5 sh-sm-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['LEGAL_FORM']??'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">تاريخ التسجيل</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE']?\Carbon\Carbon::parse($data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE'])->translatedFormat('d F Y'):'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0   py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">رأس المال المسجل</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['CAPITAL']?number_format($data['CompanyGeneralInfo'][0]['CAPITAL'], 0).' '.$data['CompanyGeneralInfo'][0]['CURR_NAME']:'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0  border-bottom py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">تاريخ أخر إصدار لشهادة التسجيل</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['ISSUE_DATE']?\Carbon\Carbon::parse($data['CompanyGeneralInfo'][0]['ISSUE_DATE'])->translatedFormat('d F Y'):'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0 py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">النشاط الاقتصادي</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['ECONOMIC_ACTIVITY']??'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0  border-bottom py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">نوع النشاط</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['ACTIVITY_DESC']??'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0  border-bottom py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">معدل المبيعات لآخر سنة</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['ANNUAL_SALES_RATE']?number_format($data['CompanyGeneralInfo'][0]['ANNUAL_SALES_RATE'], 0).' '.$data['CompanyGeneralInfo'][0]['ANNUAL_SALES_RATE_CURR_NAME']:'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0  py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">عدد العاملين</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['EMPLOYEES_MALE_CNT']+$data['CompanyGeneralInfo'][0]['EMPLOYEES_FEMALE_CNT']}} عاملين</div>
                                        </div>
                                    </div>
                                    <div class="row g-0  py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">الذكور</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['EMPLOYEES_MALE_CNT']??0}} عاملين</div>
                                        </div>
                                    </div>
                                    <div class="row g-0  border-bottom py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">الإناث</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['EMPLOYEES_FEMALE_CNT']??0}} عاملين</div>
                                        </div>
                                    </div>
                                    <div class="row g-0  border-bottom py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">كتاب التفويض</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            @if($data['CompanyGeneralInfo'][0]['AUTHORIZATION_LETTER_COMPANY_FILE'])
                                                <?php $file = $data['CompanyGeneralInfo'][0]['AUTHORIZATION_LETTER_COMPANY_FILE'][0] ?>
                                                @if($file['ATTACHMENT_LINK'])
                                                    <a href="{{$file['ATTACHMENT_LINK']}}" download="{{$file['ORIGINAL_FILE_NAME']}}"><div class="sh-3 sh-md-5 d-flex align-items-center fw-bold text-secondary"><i class="fa-solid fa-cloud-arrow-down"></i></div></a>
                                                @else
                                                    <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">-</div>
                                                @endif
                                            @else
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">-</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                <a href="{{route('portal.company.contact.index')}}" class="btn btn-secondary w-100 w-sm-auto mb-2">التالي</a>
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
