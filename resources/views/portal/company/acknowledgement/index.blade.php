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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.acknowledgement.index')}}">بيانات الإقرار</a></li>
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
                <h2 class="h4">بيانات الإقرار</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5">
                            <div class="row g-0 align-items-start mb-2">
                                <div class="col-12 col-md-2 col-xl-2  d-flex justify-content-between align-items-center justify-content-md-center flex-md-column ">
                                    <div class="border border-secondary sw-7 sh-7 sw-sm-10 sh-sm-10 rounded-xl d-flex justify-content-center align-items-center mb-3">
                                        <i class="fa-solid fa-file-lines text-secondary fa-2x"></i>
                                    </div>
                                    <a href="{{route('portal.company.acknowledgement.store')}}" class="text-nowrap"><i class="fa-solid fa-pen-to-square"></i> تعديل البيانات</a>
                                </div>
                                <div class="col-12  col-md-10  col-xl-10 pe-3">
                                    <div class="row g-0  py-2">
                                        <div class="col-12 col-md">
                                            <div class="my-2 d-flex align-items-center fw-normal lh-1-25">أحقية الرهن للغير</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            @if(count($data)>0 && isset($data[0]['IS_MORTGEGE_TO_OTHERS']))
                                            <div class="my-2 d-flex align-items-center fw-bold"><i class="fa-solid fa-circle-check {{$data[0]['IS_MORTGEGE_TO_OTHERS']==1?'text-secondary':'text-muted'}} sh-3"></i></div>
                                            @else
                                                <div class="my-2 d-flex align-items-center fw-bold">-</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row g-0 py-2">
                                        <div class="col-12 col-md">
                                            <div class="my-2 d-flex align-items-center fw-normal lh-1-25">أحقية الاقتراض للشركة</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            @if(count($data)>0 && isset($data[0]['IS_COMPANY_RIGHT_BORROW']))
                                            <div class="sh-5 sh-sm-3 sh-md-5 d-flex align-items-center fw-bold"><i class="fa-solid fa-circle-check {{$data[0]['IS_COMPANY_RIGHT_BORROW']==1?'text-secondary':'text-muted'}} sh-3"></i></div>
                                            @else
                                                <div class="my-2 d-flex align-items-center fw-bold">-</div>
                                            @endif
                                        </div>
                                    </div>
                                    @if(count($data)>0)
                                        @if($data[0]['IS_COMPANY_RIGHT_BORROW']==1)
                                            <div class="row g-0 border-bottom py-2">
                                                <div class="col-12 col-md">
                                                    <div class="my-2 d-flex align-items-center fw-normal lh-1-25">الحد المسموح للاقتراض</div>
                                                </div>
                                                <div class="col-12 col-md-auto">
                                                    <div class="my-2 d-flex align-items-center fw-bold">{{number_format($data[0]['BORROWING_LIMIT'], 0)}} {{$data[0]['CURR_NAME']}}</div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="row g-0   py-2">
                                        <div class="col-12 col-md">
                                            <div class="my-2 d-flex align-items-center fw-normal lh-1-25">تمتلك الشركة مستند خلو ضريبة</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            @if(count($data)>0 && isset($data[0]['IS_COMPANY_TAX_DOC']))
                                            <div class="my-2 d-flex align-items-center fw-bold"><i class="fa-solid fa-circle-check {{$data[0]['IS_COMPANY_TAX_DOC']==1?'text-secondary':'text-muted'}}  sh-3"></i></div>
                                            @else
                                                <div class="my-2 d-flex align-items-center fw-bold">-</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row g-0  py-2">
                                        <div class="col-12 col-md">
                                            <div class="my-2 d-flex align-items-center fw-normal lh-1-25">هل تم منح الشركة قروض من بنك الاستقلال للاستثمار والتنمية سابقاً</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            @if(count($data)>0 && isset($data[0]['IS_LOANS_GRANTED']))
                                            <div class="my-2 d-flex align-items-center fw-bold"><i class="fa-solid fa-circle-check {{$data[0]['IS_LOANS_GRANTED']==1?'text-secondary':'text-muted'}} sh-3"></i></div>
                                            @else
                                                <div class="my-2 d-flex align-items-center fw-bold">-</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row g-0 py-2">
                                        <div class="col-12 col-md">
                                            <div class="my-2 d-flex align-items-center fw-normal lh-1-25">هل الشركة كفيلة لقرض قائم لبنك الاستقلال للاستثمار والتنمية</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            @if(count($data)>0 && isset($data[0]['IS_COMPANY_GUARANTEE_LOANS']))
                                            <div class="my-2 d-flex align-items-center fw-bold"><i class="fa-solid fa-circle-check {{$data[0]['IS_COMPANY_GUARANTEE_LOANS']==1?'text-secondary':'text-muted'}} sh-3"></i></div>
                                            @else
                                                <div class="my-2 d-flex align-items-center fw-bold">-</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                <a href="{{route('portal.company.activity.competitors.index')}}" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto  mb-2"><svg class="svg-inline--fa fa-chevron-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path></svg><!-- <i class="fa-solid fa-chevron-right"></i> Font Awesome fontawesome.com --></a>
                                <a href="{{route('portal.company.note.index')}}" class="btn btn-secondary w-100 w-sm-auto  mb-2">التالي</a>
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
