@extends('portal.layouts.auth')

@section('content')
    <div class="col-12 col-sm-10 offset-0 offset-md-1  offset-lg-0 col-lg-auto h-100 pb-4 px-sm-4 pt-0 p-lg-0">
        <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 px-5 px-sm-0 full-page-content-left-border">
            <div class="sw-lg-50 px-md-5" id="validation">
                <div class="sh-11">
                    <a href="{{route('portal.login')}}" class="login-logo">
                        <img src="{{asset('assets')}}/img/logo/logo-dark.png">
                        <!-- <div class="logo-default"></div> -->
                    </a>
                </div>
                <div class="mb-3">
                    <h2 class="cta-1 fw-bold mb-0 text-primary">إعادة تعيين كلمة المرور</h2>

                </div>

                <div class="wizard" id="wizardValidation">

                    <ul class="nav nav-tabs register-nav forgotpassword-nav p-0 justify-content-center" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center position-relative" href="#validationFirst" id="tab-1" role="tab"></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center" href="#validationSecond" id="tab-2" role="tab"></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center" href="#validationThird" id="tab-3" role="tab"></a>
                        </li>
                        <li class="nav-item d-none" role="presentation">
                            <a class="nav-link text-center" href="#validationLast" id="tab-4" role="tab"></a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade" id="validationFirst" role="tabpanel">
                            <p class="card-text text-alternate mb-4 mt-4 fs-6">الرجاء إدخال البريد الإلكتروني الخاص بحسابك للمتابعة</p>
                            <form class="tooltip-end-bottom" id="phone_form" action="{{route('portal.password.code.request')}}" novalidate="novalidate">
                                <div class="alert alert-success d-none" role="alert"></div>
                                <div class="alert alert-danger d-none" role="alert"></div>
                                <input type="text" value="2" required name="SENDING_METHOD_TYPE_ID" id="SENDING_METHOD_TYPE_ID" hidden=""/>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i data-acorn-icon="barcode"></i>
                                    <input class="form-control number-only" placeholder="رقم مشتغل / تسجيل" type="text" required name="USER_NAME" id="USER_NAME"/>
                                </div>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i class="fa-solid fa-envelope mt-1"></i>
                                    <input class="form-control" placeholder="البريد الإلكتروني" type="text" required name="EMAIL" id="EMAIL"/>
                                </div>
                                <p class="h5 mt-3 mb-4">
                                    العودة إلى صفحة
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
                            <p class="card-text text-alternate mb-4 mt-4 fs-6">تم إرسال رمز تحقق إلى بريدك الإلكتروني <span class="text-secondary fw-bold" id="full_number" dir="ltr"></span> يرجى إدخال الرمز للتأكيد</p>
                            <form class="tooltip-end-bottom" id="check_code_form" action="{{route('portal.password.code.verify')}}" novalidate="novalidate">
                                <div class="alert alert-success d-none" role="alert"></div>
                                <div class="alert alert-danger d-none" role="alert"></div>
                                <input type="text" id="USER_ID_1" name="USER_ID" value="" hidden>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <div class="code-inputs">
                                        <input type="text" inputmode="numeric" id="code1" name="code1" maxlength="1" value="">
                                        <input type="text" inputmode="numeric" id="code2" name="code2" maxlength="1" value="">
                                        <input type="text" inputmode="numeric" id="code3" name="code3" maxlength="1" value="">
                                        <input type="text" inputmode="numeric" id="code4" name="code4" maxlength="1" value="">
                                    </div>
                                    <div class="d-flex justify-content-between mt-3 mb-3">
                                        <button type="button" class="border-0 bg-white text-muted" id="resend_code">
                                            <div class="text"><i class="fa-solid fa-arrows-rotate"></i> إعادة إرسال</div>
                                            <div class="btn-loader d-none">
                                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                                    <span class="visually-hidden">جاري الإرسال</span>
                                                </div>
                                                <span>جاري الإرسال</span>
                                            </div>
                                        </button>
                                        <span class="d-block text-primary" id="countdown">{{$time}}:00</span>
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
                        <div class="tab-pane fade" id="validationThird" role="tabpanel">
                            <p class="card-text text-alternate mb-4 mt-4 fs-6">قم بإدخال كلمة المرور الجديدة الخاصة بك</p>
                            <form class="tooltip-end-bottom" id="password_form" action="{{route('portal.register.password.create')}}" novalidate="novalidate">
                                <div class="alert alert-success d-none" role="alert"></div>
                                <div class="alert alert-danger d-none" role="alert"></div>
                                <input type="text" id="username" hidden>
                                <input type="text" id="USER_ID_2" name="USER_ID" value="" hidden>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i data-acorn-icon="lock-off"></i>
                                    <input class="form-control" placeholder="كلمة المرور" required name="USER_PASS" id="USER_PASS" type="password" autocomplete="new-password"/>
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
                                <p class="card-text text-alternate mb-4 fs-6">لقد تم إعادة تعيين كلمة المرور بنجاح، يمكنك العودة لصفحة الدخول.</p>
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
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#USER_NAME').on('change', function (){
                $('#username').val($(this).val());
            })

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
            $('#phone_form').on('submit', function (e) {
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
                            $('#full_number').html(response.email);
                            $('input[name="USER_ID"]').val(response.user_id);
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
                            showValidationError(form, index, value);
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
                            showValidationError(form, index, value);
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
                let form = $('#check_code_form');
                $('#code4').val('');
                $('#code3').val('');
                $('#code2').val('');
                $('#code1').val('');
                errorHide(form);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.password.code.request')}}',
                    data: {
                        'USER_NAME': $('#USER_NAME').val(),
                        'EMAIL': $('#EMAIL').val(),
                        'SENDING_METHOD_TYPE_ID': $('#SENDING_METHOD_TYPE_ID').val(),
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
                        'USER_ID': $('input[name="USER_ID"]').val(),
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
                            showValidationError(form, index, value);
                        });
                        // errorShow(form, html);
                        loaderEnd(form)
                    }
                })
            });
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
    </script>

    <script>
        function countDown(timer2="{{$time}}:00"){
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
