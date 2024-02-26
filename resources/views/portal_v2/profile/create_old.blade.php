@extends('portal_v2.layouts.main')

@section('content')
<div class="container">
    <div class="page-title-container">
        <div class="row">
            <div class="col-12 col-md-7">
                <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">الملف الشخصي</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-9 col-xxl-8">
            <!-- Public Info Start -->
            <h2 class="h4">معلوماتي الشخصية</h2>
            <div class="card mb-5">
                <div class="card-body">
                    <form id="form_data" action="{{route('portal.v2.profile.update')}}">
                        <div class="mb-3 row">
                            <div class="d-flex align-items-start flex-column">
                                <div class=" d-flex flex-column align-items-center justify-content-center flex-sm-row justify-content-sm-start">
                                    <label class="sw-13 sw-md-13 position-relative mb-3" for="profile_img">
                                        <img src="{{$data['USER_PICTURE_LINK']?$data['USER_PICTURE_LINK']:asset('default.jpg')}}" class="cursor rounded-circle" id="image" alt="thumb" width="104" height="104">
                                    </label>
                                    <input type="file" id="profile_img" name="USER_PICTURE" aria-invalid="USER_PICTURE" class="d-none" onchange="loadFile(this, 'image')" accept="{{acceptImageType()}}">
                                    <div class="col-auto mx-3">
                                        <div class="h5 mb-0">اضغط على الصورة لتغييرها</div>
                                        <div class="text-muted">الصورة الشخصية</div>
                                        <div class="invalid-feedback d-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-danger d-none" role="alert"></div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">الاسم بالكامل</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <input type="text" class="form-control" name="USER_FULL_NAME" id="USER_FULL_NAME" value="{{$data['USER_FULL_NAME']}}" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">رقم الهوية</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <input type="text" class="form-control" id="ID_NUM" value="{{$data['ID_NUM']}}" readonly />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">تاريخ الميلاد</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <input type="text" class="form-control date-picker-close" id="birthday" name="BIRTH_DATE" value="{{$data['BIRTH_DATE']}}" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">المهنة</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <select class="select-single-with-search" id="JOB_ID" name="JOB_ID" data-width="100%">
                                    <option></option>
                                    @foreach($jobs as $item)
                                    <option value="{{$item['VALUE']}}" {{$item['VALUE']==$data['JOB_ID']?'selected':''}}>{{$item['CONSTANT_DESC']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">الجنس</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <select class="select-single-no-search" name="GENDER_ID" data-width="100%" id="genderSelect">
                                    <option></option>
                                    @foreach($genders as $item)
                                        <option value="{{$item['VALUE']}}" {{$item['VALUE']==$data['GENDER_ID']?'selected':''}}>{{$item['CONSTANT_DESC']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">الجنسية</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <select class="select-single-with-search" name="NATIONALITY_ID" data-width="100%" id="NationalitySelect">
                                    <option></option>
                                    @foreach($nationalities as $item)
                                        <option value="{{$item['VALUE']}}" {{$item['VALUE']==$data['NATIONALITY_ID']?'selected':''}}>{{$item['CONSTANT_DESC']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr class="border-light">
                        <h2 class="small-title fw-bold">معلومات الاتصال</h2>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">البريد الإلكتروني</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <input type="text" class="form-control" id="EMAIL" name="EMAIL" value="{{$data['EMAIL']}}" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">رقم الهاتف</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="phone_number" value="{{$data['CELULAR_COUNTRY_PHONE_INTRO']}}{{$data['CELULAR']}}" readonly placeholder="ضع رقم هاتفك" aria-label="changenumber" aria-describedby="button-addon1">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon1">تغيير</button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row mt-5">
                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                <button type="submit" class="btn btn-secondary w-100 w-sm-auto mb-2">
                                    <div class="text">
                                        <span>تحديث</span>
                                    </div>
                                    <div class="btn-loader d-none">
                                        <div class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">جاري التحقق</span>
                                        </div>
                                        <span>جاري التحقق</span>
                                    </div>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- Public Info End -->
        </div>

        <!-- Modal  Launch static backdrop modal-->
        <div class="modal fade" id="changeNumber" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">تغيير رقم الهاتف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body wizard" id="wizardBasic">
                        <ul class="nav nav-tabs d-none p-0 justify-content-center" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-center position-relative" href="#validationFirst" role="tab" id="tab-1"></a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-center" href="#validationSecond" role="tab" id="tab-2"></a>
                            </li>
                            <li class="nav-item d-none" role="presentation">
                                <a class="nav-link text-center" href="#validationLast" role="tab" id="tab-3"></a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade" id="validationFirst" role="tabpanel">
                                <form class="tooltip-end-bottom" id="update_phone" action="{{route('portal.v2.profile.phone.update')}}">
                                    <div class="alert alert-danger d-none" role="alert"></div>
                                    <div class="row g-0">
                                        <input type="text" name="IS_VERIFIED" value="0" hidden>
                                        <input type="text" id="CELULAR_COUNTRY_ID" value="{{$countries[0]['CONSTANT_CODE1']}}" hidden>
                                        <div class="col-9 ps-2 mb-3 filled form-group tooltip-end-top">
                                            <i class="fa-solid fa-mobile-screen-button mt-1"></i>
                                            <input class="form-control number-only" placeholder="رقم الهاتف الجديد" type="text" name="CELULAR" id="CELULAR" maxlength="10"/>
                                        </div>
                                        <div class="col-3 filled">
                                            <select class="select2Basic" data-width="100%" id="CountryCodeSelect" name="CELULAR_COUNTRY_ID" data-placeholder="الدولة">
                                                @foreach($countries as $index=>$item)
                                                    @if($item['CONSTANT_ID']==1)
                                                        <option value="{{$item['CONSTANT_ID']}}" {{$index==0?'selected':''}} data-image="{{$item['CONSTANT_FILE_LINK']}}" data-code="{{$item['CONSTANT_CODE1']}}">{{$item['CONSTANT_CODE1']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer px-0 pb-0 mt-5">
                                        <button class="btn btn-icon btn-icon-end btn-secondary" type="submit">
                                            <div class="text">
                                                <span>المتابعة</span>
                                                <i data-acorn-icon="chevron-left"></i>
                                            </div>
                                            <div class="btn-loader d-none">
                                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                                    <span class="visually-hidden">جاري الإرسال</span>
                                                </div>
                                                <span>جاري الإرسال</span>
                                            </div>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="validationSecond" role="tabpanel">
                                <p class="card-text text-center mb-4 mt-4 fs-6">تم إرسال رمز تحقق برسالة نصية إلى هاتفك المحمول <span class="text-secondary fw-bold full_number">00970599013319</span> يرجى إدخال الرمز للتأكيد</p>
                                <form class="tooltip-end-bottom" id="verify_code" action="{{route('portal.v2.profile.phone.update')}}">
                                    <div class="alert alert-success d-none" role="alert"></div>
                                    <div class="alert alert-danger d-none" role="alert"></div>
                                    <input type="text" name="IS_VERIFIED" value="1" hidden>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <div class="code-inputs">
                                            <input type="text" inputmode="numeric" id="code1" name="code1" maxlength="1" value="">
                                            <input type="text" inputmode="numeric" id="code2" name="code2" maxlength="1" value="">
                                            <input type="text" inputmode="numeric" id="code3" name="code3" maxlength="1" value="">
                                            <input type="text" inputmode="numeric" id="code4" name="code4" maxlength="1" value="">
                                        </div>
                                        <div class="d-flex justify-content-around mt-3 mb-3">
                                            <button type="button" class="border-0 bg-white text-muted" id="resend_code">
                                                <div class="text"><i class="fa-solid fa-arrows-rotate"></i> إعادة إرسال</div>
                                                <div class="btn-loader d-none">
                                                    <div class="spinner-border spinner-border-sm text-light" role="status">
                                                        <span class="visually-hidden">جاري الإرسال</span>
                                                    </div>
                                                    <span>جاري الإرسال</span>
                                                </div>
                                            </button>
                                            <span class="d-block text-primary" id="countdown">00:59</span>
                                        </div>
                                    </div>
                                    <div class="modal-footer px-0 pb-0 mt-5">
                                        <button class="btn btn-icon btn-icon-start btn-outline-secondary prev2" onclick="prev()" type="button">
                                            <i data-acorn-icon="chevron-right"></i>
                                            <span>السابق</span>
                                        </button>
                                        <button class="btn btn-icon btn-icon-end btn-secondary" type="submit">
                                            <span>المتابعة</span>
                                            <i data-acorn-icon="chevron-left"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="validationLast" role="tabpanel">
                                <div class="text-center mt-5 mb-5">
                                    <h5 class="card-title h4 fw-bold">شكراً لك،</h5>
                                    <p class="card-text text-alternate mb-4 fs-6">لقد تم تغيير رقم هاتفك.</p>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
                                    <div class="modal-footer px-0 pb-0 mt-5 d-none">
                                        <button class="btn btn-icon btn-icon-start btn-outline-secondary prev2" onclick="prev()" type="button">
                                            <i data-acorn-icon="chevron-right"></i>
                                            <span>السابق</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer px-0 pb-0 mt-5 d-none">
                            <button class="btn btn-icon btn-icon-start btn-outline-secondary btn-prev" type="button">
                                <i data-acorn-icon="chevron-right"></i>
                                <span>السابق</span>
                            </button>
                            <button class="btn btn-icon btn-icon-end btn-secondary btn-next" type="button">
                                <span>المتابعة</span>
                                <i data-acorn-icon="chevron-left"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('style')
    <style>
        /*.btn-next, .btn-prev{*/
        /*    display: none;*/
        /*}*/
        html[dir="rtl"] .filled .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: unset;
            padding-right: 15px;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#code4').on('keyup', function (){
                $('#code3').focus();
            });
            $('#code3').on('keyup', function (){
                $('#code2').focus();
            });
            $('#code2').on('keyup', function (){
                $('#code1').focus();
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#button-addon1').on('click', function () {
                prev();
                $('#changeNumber').modal('show');
            })

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
                            // html += value + '<br>';
                            showValidationError(form, index, value)
                        });
                        // errorShow(form, html);
                        loaderEnd(form)
                    }
                })
            });

            $('#update_phone').on('submit', function (e) {
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
                            let no = $('#CELULAR').val();
                            let full_number = $('#CELULAR_COUNTRY_ID').val() + '' + no.substring(1, no.length);
                            $('.full_number').html(full_number);
                            countDown();
                            next();
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

            $('#verify_code').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                loaderStart(form)
                errorHide(form);
                let formdata = new FormData(this);
                formdata.append('CELULAR', $('#CELULAR').val());
                formdata.append('CELULAR_COUNTRY_ID', $('select[name="CELULAR_COUNTRY_ID"]').val());
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: form.attr('action'),
                    data: formdata,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (response.status) {
                            let no = $('#CELULAR').val();
                            let full_number = $('#CELULAR_COUNTRY_ID').val() + '' + no.substring(1, no.length);
                            $('#phone_number').val(full_number);
                            countDown();
                            next();
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

            $('#resend_code').on('click', function (e){
                e.preventDefault();
                let btn = $(this);
                btnLoaderStart(btn);
                let form = $('#verify_code');
                form.find('#code1').val('');
                form.find('#code2').val('');
                form.find('#code3').val('');
                form.find('#code4').val('');
                form.find('.alert.alert-danger').addClass('d-none');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.v2.profile.phone.update')}}',
                    data: {
                        'CELULAR_COUNTRY_ID': $('select[name="CELULAR_COUNTRY_ID"]').val(),
                        'CELULAR': $('#CELULAR').val(),
                        'IS_VERIFIED': $('#IS_VERIFIED').val(),
                    },
                    success: function (response) {
                        if (response.status) {
                            successShow(form, response.msg);
                            btnLoaderEnd(btn);
                            countDown();
                        } else {
                            errorShow(form, response.msg);
                            btnLoaderEnd(btn);
                        }
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            // html += value + '<br>';
                            showValidationError(form, index, value);
                        });
                        // errorShow(form, html);
                        btnLoaderEnd(btn);
                    }
                })
            });

            $('#CountryCodeSelect').on('change', function (e) {
                $('#CELULAR_COUNTRY_ID').val($(this).find('option:selected').data('code'));
            })

            const changeNumberModal = document.getElementById('changeNumber')
            changeNumberModal.addEventListener('hidden.bs.modal', event => {
                $('#changeNumber').find('form').trigger('reset');
                prev();
            })
        });

        function next(){
            $('.btn-next').trigger('click');
        }

        function prev(){
            $('.btn-prev').trigger('click');
        }

        var loadFile = function (event, image_id) {
            $('#'+image_id).attr('src', URL.createObjectURL(event.files[0]))
        };
    </script>

    <script>
        function countDown(timer2="1:00"){
            $('#resend_code').attr('disabled', 'true');
            let interval = setInterval(function() {
                let timer = timer2.split(':');
                //by parsing integer, I avoid all extra string processing
                let minutes = parseInt(timer[0], 10);
                let seconds = parseInt(timer[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;

                if (minutes < 0){
                    clearInterval(interval);
                    // minutes = 0;
                }

                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10 && seconds > 0) ? '0' + seconds : seconds;

                $('#countdown').html(minutes + ':' + seconds);
                timer2 = minutes + ':' + seconds;

                if(minutes == -1 && seconds == 59){
                    clearInterval(interval)
                    $('#countdown').html('0:0');
                    $('#resend_code').removeAttr('disabled');
                    return false;
                }
            }, 1000);
        }

        function btnLoaderStart(btn){
            btn.attr('disabled', true);
            btn.find('.text').addClass('d-none');
            btn.find('.btn-loader').removeClass('d-none');
        }
        function btnLoaderEnd(btn){
            btn.attr('disabled', false);
            btn.find('.text').removeClass('d-none');
            btn.find('.btn-loader').addClass('d-none');
        }

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

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
