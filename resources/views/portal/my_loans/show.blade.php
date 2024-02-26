@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">قروضي</h1>

                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.loans.index')}}">قروضي</a></li>
                            <li class="breadcrumb-item">{{$item['PROGRAM_TYPE_DESC']}}</li>
                        </ul>
                    </nav>

                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row gx-5 ">

            <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                <div class="card h-100 mb-5">
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
                                    <span class="align-middle">{{$item['FINANCING_VALUE']}} {{$item['FINANCE_CURR_NAME']}}</span>
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
                                        <div class="d-flex fw-bold align-items-center">{{$item['INSTALLMENT_VALUE']}} {{$item['FINANCE_CURR_NAME']}}</div>
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
                                        <div class=" d-flex fw-bold align-items-center">{{$item['REMAINING_VALUE']}} {{$item['FINANCE_CURR_NAME']}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-brand-v3"></div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-8">
                <div class="card h-100 mb-5 mt-print mt-md-0">
                    <div class="card-body mb-5 scroll-out position-relative">
                        <a href="{{route('portal.loans.print', $item['FUND_ID'])}}" download="" class="btn btn-icon btn-icon-only btn-outline-secondary align-top print-btn">
                            <i class="fa-solid fa-print"></i>
                        </a>
                        <div class="scroll-track-visible h-100 px-3">
                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                    <tr>
                                        <th scope="col" style="word-wrap: break-word;">رقم القسط</th>
                                        <th scope="col"  class="text-center">تاريخ القسط</th>
                                        <th scope="col" class="text-center">قيمة القسط</th>
                                        <th scope="col" class="text-center">حالة القسط</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($installments > 0)
                                        @foreach($installments as $item)
                                        <tr>
                                            <th scope="row"><i class="fa-solid fa-money-check-dollar text-secondary"></i> {{$item['INSTALLMENT_ID']}}</th>
                                            <td class="text-center">{{\Carbon\Carbon::parse($item['INSTALLMENT_DATE'])->translatedFormat('d F Y')}}</td>
                                            <td class="text-center "><span class="text-secondary fw-bold">{{$item['TOTAL_INSTALLMENT_VALUE']}}</span></td>
                                            <td class="text-center ">{{$item['INST_STATUS_DESC']}}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد أقساط مدفوعة حتى الآن</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="bg-brand-v3"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .mt-print{
            margin-top: 65px;
        }
        .print-btn{
            position: absolute;
            left: 0px;
            top: -50px;
        }
    </style>
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
