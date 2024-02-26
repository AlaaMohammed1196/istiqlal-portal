@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">{{$program['PROGRAM_TYPE_DESC']}}</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.programs.index')}}">البرامج</a></li>
                            <li class="breadcrumb-item">{{$program['PROGRAM_TYPE_DESC']}}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <div class="row gx-5">
            <div class="col-xl-12">
                <!-- Basic Start -->
                <section class="scroll-section section-program-body" id="basic">
                    <div class="card mb-5">
                        <div class="row g-0 h-auto">
                            <div class="col-sm-4  d-flex align-content-center">
                                <img src="{{$program['PROGRAM_PICTURE_LINK']??asset('assets/img/background/program-img.jpg')}}" class="card-img" alt="card image" />
                            </div>
                            <div class="col-sm-8">
                                <div class="card-body d-flex flex-column">{!! $program['PROGRAM_DESCREPTION'] !!}</div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic End -->
            </div>
            <div class="col-xl-12">
                <h4 class="mb-3">القروض</h4>
                <div class="row">
                    @if(count($loans) > 0)
                        @foreach($loans as $item)
                            <div class="col-12 col-lg-4 mt-3">
                                <div class="card  mb-5 hover-border-secondary">
                                    <div class="h-100  d-flex flex-column justify-content-between card-body align-items-center pt-0 top-m-30 program-body">
                                        <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center bg-white align-items-center border border-secondary">
                                            <i class="fa-solid fa-file-invoice fa-2x text-secondary"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="text-center h5 sh-8 d-flex align-items-center fw-bold lh-1-5">
                                            {{$item['PRODUCT_TYPE']}}
                                        </a>
                                        <div class="w-100 d-flex flex-column flex-lg-row mb-5 align-items-center justify-content-lg-between">
                                            <a href="javascript:void(0);"  data-id="{{$item['PRODUCT_TYPE_ID']}}" class="get_details h5 mt-3">
                                                <i class="fa-solid fa-rectangle-list ms-2"></i>
                                                تفاصيل القرض
                                            </a>
                                            <a href="{{route('portal.loan-request.index')}}?program={{$program['PROGRAM_TYPE_ID']}}&product={{$item['PRODUCT_TYPE_ID']}}" class="btn btn-secondary mt-3 fw-bold h5">
                                                <i class="fa-solid fa-file-invoice ms-2"></i>
                                                اطلب الآن
                                            </a>
                                        </div>
                                    </div>
                                    <div class="bg-brand-v3"></div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Launch static backdrop modal-->
    <div class="modal fade" id="viewDetails"  data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel">تفاصيل القرض</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body wizard" id="wizardBasic">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.get_details').on('click', function (e) {
                e.preventDefault();
                let btn = $(this);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.programs.product.details')}}',
                    data: {
                        'id': btn.data('id'),
                    },
                    success: function (response) {
                        if (response.status) {
                            $('#viewDetails .modal-body').html(response.html);
                            $('#viewDetails').modal('show');
                        } else {
                            toastr.error(response.msg);
                        }
                    },
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
