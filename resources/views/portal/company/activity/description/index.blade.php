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
                            <li class="breadcrumb-item">نشاط الشركة</li>
                            <li class="breadcrumb-item"><a href="{{route('portal.company.activity.description.index')}}">وصف النشاط</a></li>
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
                <h2 class="h4">وصف النشاط</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-0 align-items-start mb-2">
                            <div class="mb-5">
                                <div class="row g-0 align-items-start mb-2">
                                    <div class="col-12 col-md-2 col-xl-2  d-flex justify-content-between align-items-center justify-content-md-center flex-md-column ">
                                        <div class="border border-secondary sw-7 sh-7 sw-sm-10 sh-sm-10 rounded-xl d-flex justify-content-center align-items-center mb-3">
                                            <i class="fa-solid fa-building  text-secondary fa-2x  "></i>
                                        </div>
                                        <a href="{{route('portal.company.activity.description.edit')}}" class="text-nowrap"><i class="fa-solid fa-pen-to-square"></i> تعديل</a>
                                    </div>
                                    <div class="col-12  col-md-10  col-xl-10 pe-3">
                                        <div class="row g-0  py-2">
                                            <div class="col-12 col-md">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">مساحة العمل / م2</div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{count($data['CompanyActivity'])>0?number_format($data['CompanyActivity'][0]['WORK_SPACE'], 0):''}}</div>
                                            </div>
                                        </div>

                                        <div class="row g-0 border-bottom py-2">
                                            <div class="col-12 col-md">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">عدد سنوات الخبرة بهذا المجال</div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['EXPERIENCE_YEARS_CNT']:''}} سنة</div>
                                            </div>
                                        </div>

                                        <div class="row g-0 py-2">
                                            <div class="col-12 col-md">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">ملكية العقار</div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="sh-5 sh-sm-3 sh-md-5 d-flex align-items-center fw-bold">{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['REAL_STATE_OWNERSHIP_DESC']:''}}</div>
                                            </div>
                                        </div>

                                        <div class="row border-bottom g-0 py-2">
                                            <div class="col-12">
                                                <div class="d-flex fw-bold align-items-center fw-normal my-3">شرح ملكية العقار</div>
                                            </div>
                                            <div class="col-12">
                                                <p class="lh-lg">{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['REAL_STATE_OWNERSHIP_NOTES']:''}}</p>
                                            </div>
                                        </div>

                                        <div class="row g-0 py-2">
                                            <div class="col-12">
                                                <div class="fw-bold my-3 d-flex align-items-center fw-normal lh-1-25">طرق البيع </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="bg-light pt-3 pb-1 rounded">
                                                    <div class="mb-4">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped align-middle">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">طريقة بيع</th>
                                                                    <th scope="col"  class="text-center">النسبة</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @if(count($data['CompanySellingMethods']) > 0)
                                                                    @foreach($data['CompanySellingMethods'] as $index=>$item)
                                                                        <tr>
                                                                            <th scope="row">{{$item['SELLING_METHOD']}}</th>
                                                                            <td class="text-center"><span class="text-secondary">{{$item['METHOD_PERCENT']}}%</span></td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="3" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
                                                                    </tr>
                                                                @endif
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row border-bottom g-0 py-2">
                                            <div class="col-12">
                                                <div class="d-flex fw-bold align-items-center fw-normal my-3">شرح عن النشاط</div>
                                            </div>
                                            <div class="col-12">
                                                <p class="lh-lg">{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['ACTIVITY_EXPLANATION_NOTES']:''}}</p>
                                            </div>
                                        </div>

                                        <div class="row border-bottom g-0 py-2">
                                            <div class="col-12">
                                                <div class="d-flex fw-bold align-items-center fw-normal my-3">ملاحظات عن الموظفين</div>
                                            </div>
                                            <div class="col-12">
                                                <p class="lh-lg">{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['EMPLOYEES_NOTES']:''}}</p>
                                            </div>
                                        </div>

                                        <div class="row g-0 py-2">
                                            <div class="col-12">
                                                <div class="d-flex fw-bold align-items-center fw-normal my-3">ملاحظات أخرى</div>
                                            </div>
                                            <div class="col-12">
                                                <p class="lh-lg">{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['OTHER_NOTES']:''}}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                    <a href="{{route('portal.company.management.index')}}" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto  mb-2"><svg class="svg-inline--fa fa-chevron-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path></svg><!-- <i class="fa-solid fa-chevron-right"></i> Font Awesome fontawesome.com --></a>
                                    <a href="{{route('portal.company.activity.selling.index')}}" class="btn btn-secondary w-100 w-sm-auto  mb-2">التالي</a>
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
    <script src="{{asset('assets')}}/js/forms/layouts.js"></script>

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
