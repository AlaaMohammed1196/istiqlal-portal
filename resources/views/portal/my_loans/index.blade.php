@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">قروضي</h1>
                </div>
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row gx-5 d-flex justify-content-center w-100">
            @if(count($data) > 0)
                @foreach($data as $item)
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="card mb-5">
                            <div class="card-body">
                                <div class="d-flex align-items-center flex-column">
                                    <div class="w-100 d-flex justify-content-between">
                                        <div class="d-block">رقم القرض  <span class="fw-bold">{{$item['FUND_FILE_NO']}}</span></div>
                                        <div class="d-block">تاريخ تنفيذ الطلب  <span class="fw-bold">{{\Carbon\Carbon::parse($item['EXECUTED_ON'])->translatedFormat('d-m-Y')}}</span></div>
                                    </div>
                                    <div class="my-4 d-flex align-items-center flex-column">
                                        <div class="sw-13 sh-13 rounded-xl d-flex justify-content-center align-items-center border border-secondary mb-4">
                                            <i class="fa-solid fa-file-invoice fa-2x text-secondary"></i>
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-center">{{$item['PRODUCT_TYPE']}}</div>
                                        <div class="text-muted">{{$item['PROGRAM_TYPE_DESC']}}</div>
                                        <div class="text-secondary h3 fw-bold">
                                            <span class="align-middle">{{number_format($item['FINANCING_VALUE'], 2)}} {{$item['FINANCE_CURR_NAME']}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="row g-0 border-bottom border-top align-items-center mb-2">
                                        <div class="col">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <div class="sh-5 d-flex align-items-center lh-1-25">مدة القرض</div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="sh-5 d-flex fw-bold align-items-center">{{$item['INSTALLMENT_CNT']}} شهر</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom border-top align-items-center mb-2">
                                        <div class="col">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <div class="sh-5 d-flex align-items-center lh-1-25">حالة القرض</div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="sh-5 d-flex fw-bold align-items-center">{{$item['FUND_PAID_STATUS']}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 d-flex justify-content-center text-center mb-2">
                                        <label class="fw-bold">الأقساط</label>
                                    </div>
                                    <div class="row g-0 border border-secondary px-3 py-2 rounded-lg align-items-center mb-2">
                                        <div class="row g-0  d-flex align-items-center">
                                            <div class="col fw-bold align-content-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="fw-bold">القسط القادم <span class="fw-bold text-secondary mx-2">{{\Carbon\Carbon::parse($item['NEXT_INSATLLMENT_DATE'])->translatedFormat('d-m-Y')}}</span></div>
                                                </div>
                                            </div>
                                            <div class="col-auto align-content-center">
                                                <div class=" d-flex fw-bold align-items-center">{{number_format($item['INSTALLMENT_VALUE'], 2)}} {{$item['FINANCE_CURR_NAME']}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border border-light px-3 py-2 rounded-lg align-items-center mb-2">
                                        <div class="row g-0  d-flex align-items-center">
                                            <div class="col fw-bold align-content-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="fw-bold">المبلغ المتبقي</div>
                                                </div>
                                            </div>
                                            <div class="col-auto align-content-center">
                                                <div class=" d-flex fw-bold align-items-center">{{number_format($item['REMAINING_VALUE'], 2)}} {{$item['FINANCE_CURR_NAME']}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5 text-center">
                                    <a href="{{route('portal.loans.show', $item['FUND_ID'])}}" class="btn btn-secondary">تفاصيل</a>
                                </div>
                            </div>
                            <div class="bg-brand-v3"></div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 col-md-8">
                    <div class="card mb-5 py-5">
                        <div class="card-body ">
                            <div class="d-flex align-items-center flex-column py-5">
                                <svg class="svg-inline--fa fa-circle-info fa-2x text-secondary mb-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-info" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-144c-17.7 0-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32z"></path></svg><!-- <i class="fa-solid fa-circle-info fa-2x text-secondary mb-3"></i> Font Awesome fontawesome.com -->
                                <h4 class="fw-bold">لا يوجد قروض</h4>
                                <p class="mb-5">
                                    لا يوجد لديك قروض قائمة حتى الآن
                                </p>
                            </div>
                        </div>
                        <div class="bg-brand-v2"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

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

    <script src="{{asset('assets')}}/js/vendor/progressbar.min.js"></script>

    <script src="{{asset('assets')}}/js/plugins/progressbars.js"></script>

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
