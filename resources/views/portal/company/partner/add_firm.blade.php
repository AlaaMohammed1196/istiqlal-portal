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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.partner.index')}}">الشركاء</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.company.partner.add.index')}}">إضافة شريك</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.company.partner.add.firm')}}">مؤسسة</a></li>
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
                <h2 class="h4">إضافة شريك</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="row g-0 mb-4">
                                <div class="col-12">
                                    <div class="fw-bold h5">البيانات الأساسية</div>
                                    <p>أدخل بيانات الشريك الأساسية</p>
                                </div>
                            </div>
                            <div class="row g-0 align-items-start mb-2">
                                <form id="form_data" action="{{route('portal.company.partner.store.firm')}}">
                                    <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                                    <div class="mb-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="PARTNER_FULL_NAME" id="PARTNER_FULL_NAME" placeholder="اسم الشريك">
                                            <label>اسم الشريك</label>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control number-only" name="ID_NUM" id="ID_NUM" placeholder="رقم التسجيل">
                                                <label>رقم التسجيل</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control number-only" name="SHARES_CNT" id="SHARES_CNT" placeholder="عدد الأسهم">
                                                <label>عدد الأسهم</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control float-only" name="CONTRIBUTION_PERCENT" id="CONTRIBUTION_PERCENT" placeholder="نسبة المساهمة">
                                                <label>نسبة المساهمة %</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="col-12 col-form-label pt-4 pt-md-0">هل تم منح قروض من بنك الاستقلال للاستثمار والتنمية سابقاً</label>
                                            <div class="col-12">
                                                <div class="form-check form-check-inline ">
                                                    <input class="form-check-input" type="radio" name="IS_BANK_BORROWER" checked id="IS_BANK_BORROWER_1" value="1">
                                                    <label class="form-check-label" for="IS_BANK_BORROWER_1">نعم</label>
                                                </div>
                                                <div class="form-check form-check-inline ">
                                                    <input class="form-check-input" type="radio" name="IS_BANK_BORROWER" id="IS_BANK_BORROWER_0" disabled value="0">
                                                    <label class="form-check-label" for="IS_BANK_BORROWER_0">لا</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <textarea class="form-control" name="COMPANY_NOTES" id="COMPANY_NOTES" placeholder="ملاحظات حول الشركة التابعة" rows="5" maxlength="{{textMaxSize()}}"></textarea>
                                        <label>ملاحظات حول الشركة التابعة</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <textarea class="form-control" name="NOTES" id="NOTES" placeholder="ملاحظات" rows="5" maxlength="{{textMaxSize()}}"></textarea>
                                        <label>ملاحظات أخرى</label>
                                    </div>
                                    <div class="mb-3 row mt-5">
                                        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                            <button type="submit" class="btn btn-secondary w-100 w-sm-auto mb-2">
                                                <div class="text">إضافة</div>
                                                <div class="btn-loader d-none">
                                                    <div class="spinner-border spinner-border-sm text-light" role="status">
                                                        <span class="visually-hidden">جاري الإضافة</span>
                                                    </div>
                                                    <span>جاري الإضافة</span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
    <style>
        .form-floating > label{
            height: auto;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#ID_NUM').on('change', function (e) {
                e.preventDefault();
                $('input[name="IS_BANK_BORROWER"]').prop('disabled', true);
                let field = $(this);
                let form = $('#form_data');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.company.partner.is-borrower')}}',
                    data: {
                        'ID_NUM': field.val(),
                        'CUST_TYPE_ID': 1,
                    },
                    success: function (response) {
                        if (response.status) {
                            if(response.value == 1){
                                $('input[name="IS_BANK_BORROWER"][value="1"]').prop('disabled', false);
                                $('input[name="IS_BANK_BORROWER"][value="1"]').prop('checked', true);
                            }else{
                                $('input[name="IS_BANK_BORROWER"][value="0"]').prop('disabled', false);
                                $('input[name="IS_BANK_BORROWER"][value="0"]').prop('checked', true);
                            }
                        } else {
                            errorShow(form, response.msg);
                        }
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

            $('#form_data').on('submit', function (e) {
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

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
