@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">بيانات الشركة</h1>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row gx-5">
            <div class="col-lg-8 col-xl-6">
                <!-- Details Start -->
                <h2 class="h4">البيانات العامة</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5">
                            <div class="row g-0 align-items-start mb-2">
                                <div class="col-12 pe-3">
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
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE']?\Carbon\Carbon::parse($data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE'])->translatedFormat('d/m/Y'):'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0   py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">رأس المال المسجل</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['CAPITAL']?NumberFormat($data['CompanyGeneralInfo'][0]['CAPITAL'], $data['CompanyGeneralInfo'][0]['CURR_DECIMAL_PLACES']).' '.$data['CompanyGeneralInfo'][0]['CURR_NAME']:'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0  border-bottom py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">تاريخ أخر إصدار لشهادة التسجيل</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['ISSUE_DATE']?\Carbon\Carbon::parse($data['CompanyGeneralInfo'][0]['ISSUE_DATE'])->translatedFormat('d/m/Y'):'-'}}</div>
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
                                    <div class="row g-0 border-bottom py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">معدل المبيعات لآخر سنة</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$data['CompanyGeneralInfo'][0]['ANNUAL_SALES_RATE']?NumberFormat($data['CompanyGeneralInfo'][0]['ANNUAL_SALES_RATE'], $data['CompanyGeneralInfo'][0]['CURR_DECIMAL_PLACES']).' '.$data['CompanyGeneralInfo'][0]['ANNUAL_SALES_RATE_CURR_NAME']:'-'}}</div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">العنوان</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">
                                                @if(count($data)>0)
                                                    {{$data['CompanyContactInfo']['CURR_COUNTRY']??''}}{{$data['CompanyContactInfo']['CURR_STATE']?', '.$data['CompanyContactInfo']['CURR_STATE']:''}}{{$data['CompanyContactInfo']['CURR_CITY']?', '.$data['CompanyContactInfo']['CURR_CITY']:''}}{{$data['CompanyContactInfo']['CURR_ADDRESS']?', '.$data['CompanyContactInfo']['CURR_ADDRESS']:''}}
                                                @else لا يوجد عنوان حالي
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">البريد الإلكتروني</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">
                                                @if(count($data)>0)
                                                    {{$data['CompanyContactInfo']['CONTACT_EMAIL']??'-'}}
                                                @else -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0  py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">رقم الهاتف الأرضي</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">
                                                @if(count($data)>0)
                                                    {{$data['CompanyContactInfo']['CONTACT_TEL']??'-'}}
                                                @else -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0  py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">رقم الهاتف المتنقل</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">
                                                @if(count($data)>0)
                                                    @if(count($data['CompanyContactInfo']['CONTACT_CELULARS']) > 0)
                                                        @foreach($data['CompanyContactInfo']['CONTACT_CELULARS'] as $index=>$number)
                                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold" dir="ltr">{{$number}}{!! $index==0?'':',&nbsp;' !!}</div>
                                                        @endforeach
                                                    @else -
                                                    @endif
                                                @else
                                                    <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">-</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
