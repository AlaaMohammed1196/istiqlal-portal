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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.note.index')}}">الملاحظات</a></li>
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
                <h2 class="h4">الملاحظات</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-0 align-items-start mb-2">
                            <div class="col-12 col-md-2 col-xl-2  d-flex justify-content-between align-items-center justify-content-md-center flex-md-column ">
                                <div class="border border-secondary sw-7 sh-7 sw-sm-10 sh-sm-10 rounded-xl d-flex justify-content-center align-items-center mb-3">
                                    <i class="fa-solid fa-message text-secondary fa-2x "></i>
                                </div>
                                <a href="{{route('portal.company.note.edit')}}" class="text-nowrap"><i class="fa-solid fa-pen-to-square"></i> تعديل</a>
                            </div>
                            <div class="col-12 col-md-10 col-xl-10 pe-3">
                                <div class="row g-0  py-2">
                                    <div class="col-12 col-md">
                                        <p class="lh-lg">{{$data['NOTES']??'أضف ملاحظاتك'}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                <a href="{{route('portal.company.acknowledgement.index')}}" class="btn btn-outline-secondary w-100 w-sm-auto mb-2">السابق</a>
                                <a href="{{route('portal.home')}}" class="btn btn-secondary w-100 w-sm-auto mb-2 me-4">الرئيسية</a>
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
