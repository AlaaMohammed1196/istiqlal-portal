@extends('portal.layouts.auth')

@section('content')
    <div class="col-12 col-sm-10 offset-0 offset-md-1  offset-lg-0 col-lg-auto h-100 pb-4 px-sm-4 pt-0 p-lg-0">
        <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 px-5 px-sm-0 full-page-content-left-border">
            <div class="sw-lg-50 px-md-5" id="validation">
                <div class="sh-11">
                    <a href="{{route('portal.register')}}" class="login-logo">
                        <img src="{{asset('assets')}}/img/logo/logo-dark.png">
                        <!-- <div class="logo-default"></div> -->
                    </a>
                </div>
                <div class="mb-3">
                    <h2 class="cta-1 fw-bold mb-0 text-primary">قم بإنشاء<br>حساب لشركتك</h2>
                </div>

                <div class="wizard" id="wizardValidation">
                    <ul class="nav nav-tabs register-nav p-0 justify-content-center" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center position-relative" href="#validationFirst" id="tab-1" role="tab"></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center" href="#validationSecond" id="tab-2" role="tab"></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center" href="#validationThird" id="tab-3" role="tab"></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center" href="#validationFourth" id="tab-4" role="tab"></a>
                        </li>
                        <li class="nav-item d-none" role="presentation">
                            <a class="nav-link text-center" href="#validationLast" id="tab-5" role="tab"></a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade" id="validationFirst" role="tabpanel">
                            <p class="card-text text-alternate mb-4 mt-4 fs-6">الرجاء إدخال البيانات الخاصة بك للمتابعة</p>
                            <form class="tooltip-end-bottom check_form" id="check_user_form" action="{{route('portal.register.check.user')}}" novalidate="novalidate">
                                <div class="alert alert-danger d-none" role="alert"></div>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i class="fa-regular fa-user mt-1"></i>
                                    <input class="form-control" placeholder="إسم المستخدم" type="text" required name="USER_FULL_NAME" id="USER_FULL_NAME" maxlength="100"/>
                                </div>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i class="fa-regular fa-id-card mt-1"></i>
                                    <input class="form-control" placeholder="رقم الهوية" type="text" required name="ID_NUM" id="ID_NUM" maxlength="9"/>
                                </div>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i class="fa-regular fa-envelope mt-1"></i>
                                    <input class="form-control" placeholder="البريد الإلكتروني" type="EMAIL" required name="EMAIL" id="EMAIL" maxlength="100"/>
                                </div>
                                <div class="row g-0">
                                    <input type="text" id="CELULAR_COUNTRY_CODE" value="{{$countries[0]['CONSTANT_CODE1']}}" hidden>
                                    <input type="text" id="CELULAR_COUNTRY_ID" value="{{$countries[0]['CONSTANT_ID']}}" hidden>
                                    <div class="col-8 ps-2 mb-3 filled form-group tooltip-end-top">
                                        <i class="fa-solid fa-mobile-screen-button mt-1"></i>
                                        <input class="form-control number-only" placeholder="الهاتف الخلوي" type="text" required name="CELULAR" id="CELULAR" maxlength="10"/>
                                    </div>
                                    <div class="col-4 filled">
                                        <select class="select2Basic" data-width="100%" id="CountryCodeSelect" name="CELULAR_COUNTRY_ID" data-placeholder="الدولة">
                                            @foreach($countries as $index=>$item)
                                                @if($item['CONSTANT_ID']==1)
                                                    <option value="{{$item['CONSTANT_ID']}}" {{$index==0?'selected':''}} data-code="{{$item['CONSTANT_CODE1']}}" data-image="{{$item['CONSTANT_FILE_LINK']}}">{{$item['CONSTANT_CODE1']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <p class="h5 mt-0 mb-3 fw-bold text-danger">تخضع جميع البيانات الى السرية المصرفية بحسب ما نصت عليه تعليمات سلطة النقد الفلسطينية بالخصوص</p>
                                <div class="mb-3 position-relative form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" required id="registerCheck" name="registerCheck" />
                                        <label class="form-check-label" for="registerCheck">
                                            أوافق على التصريح والاستعلام لدى سلطة النقد
                                        </label>
                                    </div>
                                </div>
                                <p class="h5 mt-3 mb-4">
                                    إذا يوجد لديك حساب،
                                    <a href="{{route('portal.login')}}" class="fw-bold text-secondary">الدخول</a>.
                                </p>
                                <button class="btn btn-icon btn-icon-end btn-secondary" type="submit">
                                    <div class="text">
                                        <span>المتابعة</span>
                                        <i data-acorn-icon="chevron-left"></i>
                                    </div>
                                    <div class="btn-loader d-none">
                                        <div class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">جاري التحقق</span>
                                        </div>
                                        <span>جاري التحقق</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="validationSecond" role="tabpanel">
                            <p class="card-text text-alternate mb-4 mt-4 fs-6">الرجاء إدخال بيانات الشركة</p>
                            <form class="tooltip-end-bottom check_form" id="check_company_form" action="{{route('portal.register.check.company')}}" novalidate="novalidate">
                                <div class="alert alert-danger d-none" role="alert"></div>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i class="fa-regular fa-building mt-1"></i>
                                    <input class="form-control" placeholder="إسم الشركة" type="text" required name="COMPANY_NAME_NA" id="COMPANY_NAME_NA" />
                                </div>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i data-acorn-icon="barcode"></i>
                                    <input class="form-control number-only" placeholder="رقم مشتغل / تسجيل" required name="COMPANY_ID_NUM" id="COMPANY_ID_NUM" />
                                </div>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i class="fa-solid fa-people-roof mt-1"></i>
{{--                                    <input class="form-control" placeholder="العلاقة مع الشركة" required name="COMPANY_RELATION_ID" id="COMPANY_RELATION_ID" />--}}
                                    <select name="COMPANY_RELATION_ID" id="companyRelationSelect" required data-placeholder="العلاقة مع الشركة">
                                        <option></option>
                                        @foreach($relations as $item)
                                            <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-icon btn-icon-start btn-outline-secondary" onclick="prev()" type="button">
                                    <i data-acorn-icon="chevron-right"></i>
                                    <span>السابق</span>
                                </button>
                                <button class="btn btn-icon btn-icon-end btn-secondary" type="submit">
                                    <div class="text">
                                        <span>المتابعة</span>
                                        <i data-acorn-icon="chevron-left"></i>
                                    </div>
                                    <div class="btn-loader d-none">
                                        <div class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">جاري التحقق</span>
                                        </div>
                                        <span>جاري التحقق</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="validationThird" role="tabpanel">
                            <p class="card-text text-alternate mb-4 mt-4 fs-6">تم إرسال رمز تحقق برسالة نصية إلى هاتفك المحمول <span class="text-secondary fw-bold full_number">00970599013319</span> يرجى إدخال الرمز لتأكيد التسجيل</p>
                            <form class="tooltip-end-bottom" id="check_code_form" action="{{route('portal.register.check.code')}}" novalidate="novalidate">
                                <div class="alert alert-success d-none" role="alert"></div>
                                <div class="alert alert-danger d-none" role="alert"></div>
                                <input type="text" id="USER_SEQ" name="USER_SEQ" value="" hidden>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <div class="code-inputs">
                                        <input type="text" inputmode="numeric" id="code1" name="code1" maxlength="1" value="">
                                        <input type="text" inputmode="numeric" id="code2" name="code2" maxlength="1" value="">
                                        <input type="text" inputmode="numeric" id="code3" name="code3" maxlength="1" value="">
                                        <input type="text" inputmode="numeric" id="code4" name="code4" maxlength="1" value="">
                                    </div>
                                    <div class="d-flex justify-content-between mt-3 mb-3">
                                        <a href="javascript:void(0);" role="button" class="text-muted" id="resend_code">
                                            <i class="fa-solid fa-arrows-rotate"></i> إعادة إرسال</a>
                                        <span class="d-block text-primary" id="countdown">00:59</span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3 mb-3">
                                        <a href="javascript:void(0);" role="button" id="gotonumber" class="text-primary">هذا ليس رقمي!</a>
                                    </div>
                                    <button class="btn btn-icon btn-icon-start btn-outline-secondary" onclick="prev()" type="button">
                                        <i data-acorn-icon="chevron-right"></i>
                                        <span>السابق</span>
                                    </button>
                                    <button class="btn btn-icon btn-icon-end btn-secondary" type="submit">
                                        <div class="text">
                                            <span>المتابعة</span>
                                            <i data-acorn-icon="chevron-left"></i>
                                        </div>
                                        <div class="btn-loader d-none">
                                            <div class="spinner-border spinner-border-sm text-light" role="status">
                                                <span class="visually-hidden">جاري التحقق</span>
                                            </div>
                                            <span>جاري التحقق</span>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="validationFourth" role="tabpanel">
                            <p class="card-text text-alternate mb-4 mt-4 fs-6">قم بإدخال كلمة المرور الخاصة بك لإتمام عملية إنشاء الحساب بنجاح</p>
                            <form class="tooltip-end-bottom" id="password_form" action="{{route('portal.register.password.create')}}" novalidate="novalidate">
                                <div class="alert alert-success d-none" role="alert"></div>
                                <div class="alert alert-danger d-none" role="alert"></div>
                                <input type="text" id="username" hidden>
                                <input type="text" id="USER_ID" name="USER_ID" value="" hidden>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i data-acorn-icon="lock-off"></i>
                                    <input class="form-control" placeholder="كلمة المرور" required name="USER_PASS" id="USER_PASS" type="password" />
                                    <a class="password-icon show-password" href="javascript:void(0);"><i class="far fa-eye"></i></a>
                                    <a class="password-icon hide-password d-none" href="javascript:void(0);"><i class="far fa-eye-slash"></i></a>
                                </div>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i data-acorn-icon="lock-off"></i>
                                    <input class="form-control" placeholder="تأكيد كلمة المرور" required name="USER_PASS_confirmation" id="USER_PASS_confirmation" type="password" />
                                    <a class="password-icon show-password" href="javascript:void(0);"><i class="far fa-eye"></i></a>
                                    <a class="password-icon hide-password d-none" href="javascript:void(0);"><i class="far fa-eye-slash"></i></a>
                                </div>
                                <button class="btn btn-icon btn-icon-start btn-outline-secondary" onclick="prev()" type="button">
                                    <i data-acorn-icon="chevron-right"></i>
                                    <span>السابق</span>
                                </button>
                                <button class="btn btn-icon btn-icon-end btn-secondary" type="submit">
                                    <div class="text">
                                        <span>المتابعة</span>
                                        <i data-acorn-icon="chevron-left"></i>
                                    </div>
                                    <div class="btn-loader d-none">
                                        <div class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">جاري التحقق</span>
                                        </div>
                                        <span>جاري التحقق</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="validationLast" role="tabpanel">
                            <div class="text-center mt-5 mb-5">
                                <h5 class="card-title h4 fw-bold">شكراً لك،</h5>
                                <p class="card-text text-alternate mb-4 fs-6">لقد تم تسجيلك بنجاح، سوف يتم مراجعة حسابك لتوثيقه.</p>
                                <a href="{{route('portal.login')}}" class="btn btn-icon btn-icon-start btn-secondary mb-5">
                                    <i data-acorn-icon="login"></i>
                                    <span>دخول</span>
                                </a>
                            </div>
                        </div>
                    </div>
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
            <div class="bg-brand"></div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .btn-next, .btn-prev{
            display: none;
        }
        html[dir="rtl"] #check_user_form .filled .select2-container .select2-selection--single .select2-selection__rendered {
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

        $('#COMPANY_ID_NUM').on('change', function (){
            $('#username').val($(this).val());
        })

        $('#check_user_form').on('submit', function (e) {
            e.preventDefault();
            let form = $(this);
            loaderStart(form)
            form.validate();
            if(!$(this).valid()){
                loaderEnd(form);
                return false;
            }
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

        $('#check_company_form').on('submit', function (e) {
            e.preventDefault();
            let form = $(this);
            loaderStart(form)
            // form.validate();
            // if(!$(this).valid()){
            //     loaderEnd(form);
            //     return false;
            // }
            errorHide(form);
            let cel = $('#CELULAR').val();
            let full_number = $('#CELULAR_COUNTRY_CODE').val() + '' + cel.substring(1, cel.length);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: form.attr('action'),
                data: {
                    'USER_FULL_NAME': $('#USER_FULL_NAME').val(),
                    'ID_NUM': $('#ID_NUM').val(),
                    'CELULAR_COUNTRY_ID': $('#CELULAR_COUNTRY_ID').val(),
                    'CELULAR': $('#CELULAR').val(),
                    'EMAIL': $('#EMAIL').val(),
                    'COMPANY_NAME_NA': $('#COMPANY_NAME_NA').val(),
                    'COMPANY_ID_NUM': $('#COMPANY_ID_NUM').val(),
                    'COMPANY_RELATION_ID': $('select[name="COMPANY_RELATION_ID"]').val(),
                },
                success: function (response) {
                    if (response.status) {
                        $('.full_number').html(full_number);
                        $('#USER_SEQ').val(response.USER_SEQ);
                        countDown('0:59', '#countdown');
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
                        form.find("input[name='"+index+"']").addClass('border-danger');
                        form.find("input[name='"+index+"']").after('<div class="invalid-feedback d-block">' + value + '</div');
                        form.find("select[name='"+index+"']").addClass('border-danger');
                        form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                    });
                    // errorShow(form, html);
                    loaderEnd(form)
                }
            })
        });

        $('#check_code_form').on('submit', function (e) {
            e.preventDefault();
            let form = $(this);
            loaderStart(form)
            form.validate();
            if(!$(this).valid()){
                loaderEnd(form);
                return false;
            }
            errorHide(form);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: form.attr('action'),
                data: {
                    'USER_SEQ': $('#USER_SEQ').val(),
                    'VERIFY_CODE': $('#code4').val()+''+$('#code3').val()+''+$('#code2').val()+''+$('#code1').val(),
                    'COMPANY_NAME_NA': $('#COMPANY_NAME_NA').val(),
                    'COMPANY_ID_NUM': $('#COMPANY_ID_NUM').val(),
                    'COMPANY_RELATION_ID': $('select[name="COMPANY_RELATION_ID"]').val(),
                },
                success: function (response) {
                    if (response.status) {
                        $('#USER_ID').val(response.user_id)
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
            let form = $('#check_code_form');
            errorHide(form);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.register.resend.code')}}',
                data: {
                    'USER_FULL_NAME': $('#USER_FULL_NAME').val(),
                    'ID_NUM': $('#ID_NUM').val(),
                    'CELULAR_COUNTRY_ID': $('#CELULAR_COUNTRY_ID').val(),
                    'CELULAR': $('#CELULAR').val(),
                    'EMAIL': $('#EMAIL').val(),
                    'COMPANY_NAME_NA': $('#COMPANY_NAME_NA').val(),
                    'COMPANY_ID_NUM': $('#COMPANY_ID_NUM').val(),
                    'COMPANY_RELATION_ID': $('select[name="COMPANY_RELATION_ID"]').val(),
                },
                success: function (response) {
                    if (response.status) {
                        successShow(form, response.msg);
                        countDown('0:59', '#countdown');
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

        $('#password_form').on('submit', function (e) {
            e.preventDefault();
            let form = $(this);
            loaderStart(form)
            form.validate();
            if(!$(this).valid()){
                loaderEnd(form);
                return false;
            }
            errorHide(form);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: form.attr('action'),
                data: {
                    'USER_ID': $('#USER_ID').val(),
                    'VERIFY_CODE': $('#code4').val()+''+$('#code3').val()+''+$('#code2').val()+''+$('#code1').val(),
                    'USER_PASS': $('#USER_PASS').val(),
                    'USER_PASS_confirmation': $('#USER_PASS_confirmation').val(),
                },
                success: function (response) {
                    if (response.status) {
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

        $('#CountryCodeSelect').on('change', function (e) {
            $('#CELULAR_COUNTRY_ID').val($(this).val());
            $('#CELULAR_COUNTRY_CODE').val($(this).find('option:selected').data('code'));
        })
    });

    function next(){
        $('.btn-next').trigger('click');
    }

    function prev(){
        $('.btn-prev').trigger('click');
    }

    function goToTap(e){
        $('#tab-'+e).tab('show');
    }

    function countDown(timer2, e){
        for(i=0; i<100; i++){
            window.clearInterval(i);
        }
        var interval = setInterval(function() {
            var timer = timer2.split(':');
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0){
                clearInterval(interval);
                minutes = 0;
            }
            seconds = (seconds < 0) ? '0' : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            $(e).html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
        }, 1000);
    }
    </script>
@endpush
