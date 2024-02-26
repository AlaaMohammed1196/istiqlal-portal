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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.activity.buying.index')}}">تفاصيل سياسة الشراء</a></li>
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
                <h2 class="h4">تفاصيل تحليل سياسة الشراء</h2>
                <div class="card mb-5">
                    <div class="card-body">

                        <form id="policy_update" action="{{route('portal.company.activity.selling.policy.update')}}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="row g-0 mb-4">
                                        <div class="col-12">
                                            <div class="fw-bold h5">سياسة البيع النقدي</div>
                                        </div>
                                    </div>
                                    <div class="row g-0 align-items-start mb-2">
                                        <div class="mb-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="BUY_SELL_PERCENT" value="{{count($policy)>0?$policy[0]['BUY_SELL_PERCENT']:''}}" placeholder="نسبة البيع %">
                                                <label>نسبة البيع %</label>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="BUY_SELL_PERIOD" value="{{count($policy)>0?$policy[0]['BUY_SELL_PERIOD']:''}}" placeholder="مدة الآجال / الأيام ">
                                                <label>مدة الآجال / الأيام </label>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <textarea class="form-control" name="BUY_SELL_NOTES" placeholder="ملاحظات أخرى" rows="5">{{count($policy)>0?$policy[0]['BUY_SELL_NOTES']:''}}</textarea>
                                            <label>ملاحظات أخرى</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="row g-0 mb-4">
                                        <div class="col-12">
                                            <div class="fw-bold h5">سياسة البيع الآجل</div>
                                        </div>
                                    </div>
                                    <div class="row g-0 align-items-start mb-2">
                                        <div class="mb-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="BUY_SELL_POSTPONED_PERCENT" value="{{count($policy)>0?$policy[0]['BUY_SELL_POSTPONED_PERCENT']:''}}" placeholder="نسبة البيع %">
                                                <label>نسبة البيع %</label>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="BUY_SELL_POSTPONED_PERIOD" value="{{count($policy)>0?$policy[0]['BUY_SELL_POSTPONED_PERIOD']:''}}" placeholder="مدة الآجال / الأيام ">
                                                <label>مدة الآجال / الأيام </label>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <textarea class="form-control" name="BUY_SELL_POSTPONED_NOTES" placeholder="ملاحظات أخرى" rows="5">{{count($policy)>0?$policy[0]['BUY_SELL_POSTPONED_NOTES']:''}}</textarea>
                                            <label>ملاحظات أخرى</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3 mt-5">
                                    <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                        <button type="submit" class="btn btn-secondary w-100 w-sm-auto mb-2">
                                            <div class="text">تحديث</div>
                                            <div class="btn-loader d-none">
                                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                                    <span class="visually-hidden">جاري التحديث</span>
                                                </div>
                                                <span>جاري التحديث</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .form-floating > label{
            height: auto !important;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#policy_update').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                loaderStart(form)
                errorHide(form);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: form.attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (response.status) {
                            window.location.href = response.url;
                        } else {
                            errorShow(form, response.msg);
                        }
                        loaderEnd(form)
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            showValidationError(form, index, value)
                        });
                        loaderEnd(form)
                    }
                })
            });
        });
    </script>
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
