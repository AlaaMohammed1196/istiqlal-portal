@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">

        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">الودائع</h1>
                </div>
            </div>
        </div>

        <section class="scroll-section position-relative" id="responsiveTabs">
            @if(count($deposits) > 0)
            <div class="row mt-5">
                <div class="col-12 col-xl-4 scroll-out">
                    <div class="nav flex-column scroll" role="tablist" data-count="1.5">
                        @foreach($deposits as $index=>$item)
                        <a class="card mb-3 p-3 nav-link ms-3 {{$index==0?'active':''}} border-bottom border-separator-light get_deposit_details" role="button" data-id="{{$item['DEPOSIT_ID']}}">
                            <div>
                                <div class="p-3 align-items-center border-bottom d-flex justify-content-start">
                                    <i class="fa-solid fa-money-check fa-2x text-secondary ms-3"></i>
                                    <div class="d-flex justify-content-between w-100">
                                        <div class="h5 fw-bold">وديعة</div>
                                        <div class="h5 fw-bold">{{$item['STATUS_DESC']}}</div>
                                    </div>
                                </div>
                                <div class="p-3 border-bottom d-flex justify-content-between">
                                    <span class="align-middle">تاريخ ربط الوديعة</span>
                                    <span class="align-middle"><strong>{{$item['DEPOSIT_BIND_DATE']?Carbon\Carbon::parse($item['DEPOSIT_BIND_DATE'])->translatedFormat('d/m/Y'):''}}</strong></span>
                                </div>
                                <div class="p-3 border-bottom d-flex justify-content-between">
                                    <span class="align-middle">تاريخ استحقاق الوديعة</span>
                                    <span class="align-middle"><strong>{{$item['DEPOSIT_MATURITY_DATE']?Carbon\Carbon::parse($item['DEPOSIT_MATURITY_DATE'])->translatedFormat('d/m/Y'):''}}</strong></span>
                                </div>
                                <div class="p-3 border-bottom d-flex justify-content-between">
                                    <span class="align-middle">قيمة الوديعة</span>
                                    <span class="align-middle"><strong>{{NumberFormat($item['DEPOSIT_VALUE'], $item['CURR_DECIMAL_PLACES'])}} {{$item['DEPOSIT_CURR_DESC']}}</strong></span>
                                </div>
                                <div class="p-3 d-flex justify-content-between">
                                    <span class="align-middle">مدة ربط الوديعة</span>
                                    <span class="align-middle"><strong>{{$item['DEPOSIT_TYPE_PERIOD_DESC']}}</strong></span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-xl-8 mb-5 position-relative">
                    <div class="div-loader fs-2 d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                    <div id="details_view">
                        @include('portal_v2.deposits.details')
                    </div>
                </div>
            </div>
            @else
                <div class="row gx-5 d-flex justify-content-center w-100">
                    <div class="col-12 col-md-8">
                        <div class="card mb-5 py-5">
                            <div class="card-body ">
                                <div class="d-flex align-items-center flex-column py-5">
                                    <svg class="svg-inline--fa fa-circle-info fa-2x text-secondary mb-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-info" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-144c-17.7 0-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32z"></path></svg><!-- <i class="fa-solid fa-circle-info fa-2x text-secondary mb-3"></i> Font Awesome fontawesome.com -->
                                    <h4 class="fw-bold">لا يوجد ودائع</h4>
                                    <p class="mb-5">
                                        لا يوجد لديك ودائع حتى الآن
                                    </p>
                                </div>
                            </div>
                            <div class="bg-brand-v2"></div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>
@endsection

@push('style')
    <style>
        .div-loader{
            position: absolute;
            top: 0px;
            width: 100%;
            height: 100%;
            display: flex;
            /*align-items: center;*/
            justify-content: center;
            z-index: 1;
            background-color: rgb(255, 255, 255, 0.3);
            margin-top: 200px;
        }
        .card.active:after, .card.selected:after, .card.activatable.context-menu-active:after{
            left: 0px;
        }
        .scroll{
            height: 500px;
        }
        .w-15px{
            display: inline-block;
            width: 150px;
        }
        .text-darkBlue{
            color: #333c58;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('.get_deposit_details').on('click', function (e) {
                e.preventDefault();
                $('.div-loader').removeClass('d-none');
                let btn = $(this);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.v2.deposits.get')}}',
                    data: {
                        'id': btn.data('id'),
                    },
                    success: function (response) {
                        if(response.status){
                            $('#details_view').html(response.html);
                            $('.get_deposit_details.active').removeClass('active');
                            btn.addClass('active');
                        }else{
                            SwalModal2(response.msg, 'error');
                        }
                        $('.div-loader').addClass('d-none');
                    },
                    error: function (response) {
                    }
                })
            });
        });
    </script>
@endpush

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
