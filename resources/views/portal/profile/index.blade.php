@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">الملف الشخصي</h1>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                <!-- Public Info Start -->
                <h2 class="h4">معلوماتي الشخصية</h2>
                <div class="card mb-5">
                    <div class="card-body">

                        <div class="d-flex align-items-start justify-content-between mb-5">
                            <div class="d-flex align-items-center">
                                <div class="sw-13 position-relative mb-3">
                                    <img src="{{$data['USER_PICTURE_LINK']?$data['USER_PICTURE_LINK']:asset('default.jpg')}}" class="rounded-circle" alt="thumb" width="104" height="104"/>
                                </div>
                                <div class="pe-3">
                                    <div class="h5 mb-0">{{$data['USER_FULL_NAME']}}</div>
                                    <div class="text-muted">{{$data['RELATION_DESC']}} {{$data['COMPANY_NAME']}}</div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-row justify-content-end mt-2">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#addnew" title="تغيير كلمة المرور" class="btn btn-icon btn-outline-dark ms-0 ms-sm-2">
                                    <i data-acorn-icon="lock-off" class="" data-acorn-size="17"></i>
                                </button>
                                <a href="{{route('portal.v2.profile.edit')}}" title="تعديل" class="btn btn-icon btn-outline-secondary mt-2 mt-sm-0 me-0 me-sm-2">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                            </div>
                        </div>

                        <div class="mb-5">
                            <div class="row g-0 align-items-center mb-2">
                                <div class="col-auto">
                                    <div class="border border-secondary sw-5 sh-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-id-card text-secondary"></i>
                                    </div>
                                </div>
                                <div class="col pe-3">
                                    <div class="row g-0">
                                        <div class="col">
                                            <div class="sh-5 d-flex align-items-center lh-1-25">رقم الهوية</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="sh-5 d-flex fw-bold align-items-center">{{$data['ID_NUM']??'-'}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0 align-items-center mb-2">
                                <div class="col-auto">
                                    <div class="border border-secondary sw-5 sh-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-calendar-days text-secondary"></i>
                                    </div>
                                </div>
                                <div class="col pe-3">
                                    <div class="row g-0">
                                        <div class="col">
                                            <div class="sh-5 d-flex align-items-center lh-1-25">تاريخ الميلاد</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="sh-5 d-flex fw-bold align-items-center">{{$data['BIRTH_DATE']??'-'}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0 align-items-center mb-2">
                                <div class="col-auto">
                                    <div class="border border-secondary sw-5 sh-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <i class="fa-solid  fa-briefcase text-secondary"></i>
                                    </div>
                                </div>
                                <div class="col pe-3">
                                    <div class="row g-0">
                                        <div class="col">
                                            <div class="sh-5 d-flex align-items-center lh-1-25">المهنة</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="sh-5 d-flex fw-bold align-items-center">{{$data['JOB_DESC']??'-'}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0 align-items-center mb-2">
                                <div class="col-auto">
                                    <div class="border border-secondary sw-5 sh-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-mars-and-venus text-secondary"></i>
                                    </div>
                                </div>
                                <div class="col pe-3">
                                    <div class="row g-0">
                                        <div class="col">
                                            <div class="sh-5 d-flex align-items-center lh-1-25">الجنس</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="sh-5 d-flex fw-bold align-items-center">{{$data['GENDER_DESC']??'-'}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0 align-items-center mb-2">
                                <div class="col-auto">
                                    <div class="border border-secondary sw-5 sh-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-address-book text-secondary"></i>
                                    </div>
                                </div>
                                <div class="col pe-3">
                                    <div class="row g-0">
                                        <div class="col">
                                            <div class="sh-5 d-flex align-items-center lh-1-25">الجنسية</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="sh-5 d-flex fw-bold align-items-center">{{$data['NATIONALITY_DESC']??'-'}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <p class="text-secondary fw-bold mb-2">معلومات الاتصال</p>
                            <div class="row g-0 align-items-center mb-2">
                                <div class="col-auto">
                                    <div class="border border-secondary sw-5 sh-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-phone text-secondary"></i>
                                    </div>
                                </div>
                                <div class="col pe-3">
                                    <div class="row g-0">
                                        <div class="col">
                                            <div class="sh-5 d-flex align-items-center lh-1-25">الهاتف</div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="tel:{{$data['CELULAR_COUNTRY_PHONE_INTRO']}}{{$data['CELULAR']}}" class="d-block body-link mb-1">
                                                <span class="align-middle fw-bold">@if($data['CELULAR']){{$data['CELULAR_COUNTRY_PHONE_INTRO']}}{{$data['CELULAR']}}@else - @endif</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-0 align-items-center mb-2">
                                <div class="col-auto">
                                    <div class="border border-secondary sw-5 sh-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-envelope text-secondary"></i>
                                    </div>
                                </div>
                                <div class="col pe-3">
                                    <div class="row g-0">
                                        <div class="col">
                                            <div class="sh-5 d-flex align-items-center lh-1-25">البريد الإلكتروني</div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="mailto:abdulla@fis.ps" class="d-block body-link mb-1">
                                                <span class="align-middle fw-bold">{{$data['EMAIL']??'-'}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Public Info End -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="addnew" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel">تغيير كلمة المرور</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="change_password" action="{{route('portal.profile.password.change')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
{{--                            <div class="fw-bold h5 mb-2">إعادة تعيين كلمة المرور</div>--}}
                            <p>ادخل كلمة المرور الجديدة</p>
                        </div>
                        <div class="alert alert-danger d-none" role="alert"></div>
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="lock-off"></i>
                            <input class="form-control" placeholder="كلمة المرور الحالية" name="USER_PASS" id="USER_PASS" type="password" />
                            <a class="password-icon show-password" href="javascript:void(0);"><i class="far fa-eye"></i></a>
                            <a class="password-icon hide-password d-none" href="javascript:void(0);"><i class="far fa-eye-slash"></i></a>
                        </div>
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="lock-off"></i>
                            <input class="form-control" placeholder="كلمة المرور الجديدة" name="NEW_USER_PASS" id="NEW_USER_PASS" type="password" />
                            <a class="password-icon show-password" href="javascript:void(0);"><i class="far fa-eye"></i></a>
                            <a class="password-icon hide-password d-none" href="javascript:void(0);"><i class="far fa-eye-slash"></i></a>
                        </div>
                        <div class=" filled form-group tooltip-end-top">
                            <i data-acorn-icon="lock-off"></i>
                            <input class="form-control" placeholder="تأكيد كلمة المرور الجديدة" name="NEW_USER_PASS_confirmation" id="NEW_USER_PASS_confirmation" type="password" />
                            <a class="password-icon show-password" href="javascript:void(0);"><i class="far fa-eye"></i></a>
                            <a class="password-icon hide-password d-none" href="javascript:void(0);"><i class="far fa-eye-slash"></i></a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-secondary">
                            <div class="text">
                                <span>تغيير</span>
                            </div>
                            <div class="btn-loader d-none">
                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">جاري التغيير</span>
                                </div>
                                <span>جاري التغيير</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('style')
    <style>
        .password-icon{
            position: absolute;
            top: 12px;
            right: 16px;
            color: rgba(var(--alternate-rgb), 0.5);
            z-index: 1;
        }
        html[dir="rtl"] .password-icon {
            cursor: pointer;
            left: 16px;
            right: unset;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {

            @if(Session::get('user')['PASS_CHANGE_FLAG'] == 1)
                $('#addnew').modal('show');
            @endif

            $('#change_password').on('submit', function (e) {
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
                            toastr.success(response.msg);
                            $('#addnew').modal('hide');
                            form.trigger('reset');
                        } else {
                            errorShow(form, response.msg);
                        }
                        loaderEnd(form)
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            // html += value + '<br>';
                            showValidationError(form, index, value)
                        });
                        // errorShow(form, html);
                        loaderEnd(form)
                    }
                })
            });
        });
    </script>
    <script>
        $('.show-password').on('click', function (e){
            $(this).addClass('d-none');
            $(this).siblings('input').attr('type', 'text');
            $(this).siblings('.hide-password').removeClass('d-none');
        });
        $('.hide-password').on('click', function (e){
            $(this).addClass('d-none');
            $(this).siblings('input').attr('type', 'password');
            $(this).siblings('.show-password').removeClass('d-none');
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

    <script src="{{asset('assets')}}/js/cs/wizard.js"></script>
    <script src="{{asset('assets')}}/js/vendor/jquery.validate/jquery.validate.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/jquery.validate/additional-methods.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/jquery.validate/localization/messages_ar.min.js"></script>
    <script src="{{asset('assets')}}/js/forms/wizards.js"></script>
    <script src="{{asset('assets')}}/js/forms/layouts.js"></script>

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
