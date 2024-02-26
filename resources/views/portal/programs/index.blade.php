@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">البرامج</h1>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <div class="row gx-5">
            @if(count($programs) > 0)
                @foreach($programs as $item)
                    <div class="col-lg-3">
                        <div class="card  mb-5 hover-border-secondary">
                            <img src="{{$item['PROGRAM_PICTURE_LINK']?$item['PROGRAM_PICTURE_LINK']:asset('assets/img/background/program-img.jpg')}}" class="card-img-top" alt="card image" height="130">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center pt-0 top-m-30 program-body">
                                <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center bg-white align-items-center border border-secondary">
                                    <i class="fa-solid fa-money-check fa-2x text-secondary"></i>
                                </div>
                                <a href="{{route('portal.programs.show', $item['VALUE'])}}" class="text-center h6 sh-5 d-flex align-items-center fw-bold lh-1-5">
                                    {{$item['LABEL']}}
                                </a>
                                <div class="w-100 d-flex flex-column flex-lg-row mb-5 align-items-center justify-content-center">
                                    <a href="{{route('portal.programs.show', $item['VALUE'])}}" class="h5 mt-3">
                                        <i class="fa-solid fa-rectangle-list ms-2"></i> قراءة المزيد
                                    </a>
                                </div>
                            </div>
                            <div class="bg-brand-v2"></div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

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
