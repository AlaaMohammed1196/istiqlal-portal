@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">الدعم الفني</h1>
                </div>
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <!-- Public Info Start -->
                    <h2 class="h4 ">تواصل معنا</h2>
                    <div class="card pb-5 mb-5">
                        <div class="card-body">
                            <div class="d-flex justify-content-start mt-3">
                                <i class="fa-solid fa-location-dot fa-2x text-secondary ms-3"></i>
                                <div class="col">
                                    <h5>موقعنا</h5>
                                    <p>
                                        @if(array_key_exists('ADDRESS',$info_branch))
                                            {{$info_branch['ADDRESS']??'-'}}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start mt-3">
                                <i class="fa-solid fa-phone fa-2x text-secondary ms-3"></i>
                                <div class="col text-end">
                                    <h5>رقم الهاتف</h5>
                                    <p class="phone-number">
                                        @if(array_key_exists('TELPHONE_NUMBERS',$info_branch))
                                            @if(count($info_branch['TELPHONE_NUMBERS'])>0)
                                                <a href="tel:({{$info_branch['TELPHONE_NUMBERS'][0]['CONTACT_COUNTRY_INTRO']}}){{$info_branch['TELPHONE_NUMBERS'][0]['CONTACT_INFO']}}">
                                                    ({{$info_branch['TELPHONE_NUMBERS'][0]['CONTACT_COUNTRY_INTRO']}}
                                                    ){{$info_branch['TELPHONE_NUMBERS'][0]['CONTACT_INFO']}}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </p>

                                </div>
                            </div>

                            <div class="d-flex justify-content-start mt-3">
                                <i class="fa-solid fa-envelope fa-2x text-secondary ms-3"></i>
                                <div class="col">
                                    <h5>البريد الإلكتروني</h5>
                                    <p>
                                        @if(array_key_exists('EMAILS',$info_branch))
                                            @if(count($info_branch['EMAILS'])>0)
                                                <a href="mailto:{{$info_branch['EMAILS'][0]['CONTACT_INFO']}}">
                                                    {{$info_branch['EMAILS'][0]['CONTACT_INFO']}}</a>
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start mt-3">
                                <i class="fa-solid fa-thumbs-up fa-2x text-secondary ms-3"></i>
                                <div class="col">
                                    <h5>تابعنا عبر التواصل الاجتماعي</h5>
                                    @if(array_key_exists('SOCIAL_MEDIAS',$info_branch))
                                        @if(count($info_branch['SOCIAL_MEDIAS'])>0)
                                            <ul class="list-unstyled list-inline">
                                                @foreach($info_branch['SOCIAL_MEDIAS'] as $social)

                                                     @if($social['CONTACT_SUB_TYPE_ID'] == 10)
                                                        <li class="list-inline-item mx-2">
                                                            <a href="{{$social['CONTACT_INFO']}}" target="_blank">
                                                                <i class="fab fa-facebook-f"></i>
                                                            </a>
                                                        </li>
                                                    @endif

{{--                                                    @if($social['CONTACT_SUB_TYPE_ID'] == 11)--}}
{{--                                                        <li class="list-inline-item mx-2">--}}
{{--                                                            <a href="{{$social['CONTACT_INFO']}}" target="_blank"><i--}}
{{--                                                                    class="fab fa-twitter"></i></a>--}}
{{--                                                        </li>--}}
{{--                                                    @endif--}}

                                                    @if($social['CONTACT_SUB_TYPE_ID'] == 12)
                                                        <li class="list-inline-item mx-2">
                                                            <a href="{{$social['CONTACT_INFO']}}" target="_blank"><i
                                                                    class="fab fa-linkedin-in"></i></a>
                                                        </li>
                                                    @endif

                                                @endforeach
                                            </ul>
                                        @else
                                            -
                                        @endif
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="bg-brand-v2"></div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')

@endpush

@push('page_style')
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2.min.css"/>
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2-bootstrap4.min.css"/>
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/bootstrap-datepicker3.standalone.min.css"/>
@endpush

@push('page_script')
    <script src="{{asset('assets')}}/js/vendor/movecontent.js"></script>
    <script src="{{asset('assets')}}/js/vendor/select2.full.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/profile.settings.js"></script>

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
