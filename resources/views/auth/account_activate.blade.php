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
                    <h2 class="cta-1 fw-bold mb-0 text-primary">أهلا بك في بوابة <br>بنك الاستقلال للتنمية و الاستثمار</h2>
                </div>

                @if($status && isset($data['IS_BLOCKED']) && $data['IS_BLOCKED']==0)
                <div class="wizard" id="wizardValidation">
                    <ul class="nav nav-tabs register-nav forgotpassword-nav p-0 justify-content-center" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center position-relative" href="#first" id="tab-1" role="tab"></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center" href="#second" id="tab-2" role="tab"></a>
                        </li>
                        <li class="nav-item d-none" role="presentation">
                            <a class="nav-link text-center" href="#third" id="tab-3" role="tab"></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="first" role="tabpanel">
                            <p class="card-text text-alternate mb-4 mt-4 fs-6">يرجى إدخال رمز التفعيل المرسل إلى رقمك <span class="text-secondary fw-bold" dir="ltr">{{$data['CELULLAR']}}</span>  وذلك لاستكمال إجراءات تفعيل الحساب</p>
                            <form class="tooltip-end-bottom" id="check_code_form" action="{{route('portal.account.activate.code.check')}}" novalidate="novalidate">
                                <div class="alert alert-success d-none" role="alert"></div>
                                <div class="alert alert-danger d-none" role="alert"></div>
                                <input type="text" class="USER_ID" name="USER_ID" value="{{$data['USER_ID']}}" hidden>
                                <input type="text" id="ACTIVATION_TOKEN" name="ACTIVATION_TOKEN" value="{{$data['ACTIVATION_TOKEN']}}" hidden>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <div class="code-inputs">
                                        <input type="text" inputmode="numeric" id="code1" name="code1" maxlength="1" value="">
                                        <input type="text" inputmode="numeric" id="code2" name="code2" maxlength="1" value="">
                                        <input type="text" inputmode="numeric" id="code3" name="code3" maxlength="1" value="">
                                        <input type="text" inputmode="numeric" id="code4" name="code4" maxlength="1" value="">
                                    </div>
                                    <div class="d-flex justify-content-between mt-3 mb-3">
                                        <a href="javascript:void(0);" class="text-muted" id="resend_code">
                                            <i class="fa-solid fa-arrows-rotate"></i> إعادة إرسال</a>.
                                        <span class="d-block text-primary" id="countdown">00:59</span>
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
                        <div class="tab-pane fade" id="second" role="tabpanel">
                            <p class="card-text text-alternate mb-4 mt-4 fs-6">قم بإدخال كلمة المرور الجديدة الخاصة بك</p>
                            <form class="tooltip-end-bottom" id="password_form" action="{{route('portal.register.password.create')}}" novalidate="novalidate">
                                <div class="alert alert-success d-none" role="alert"></div>
                                <div class="alert alert-danger d-none" role="alert"></div>
                                <input type="text" id="username" value="{{$data['CELULLAR']}}" hidden>
                                <input type="text" class="USER_ID" name="USER_ID" value="{{$data['USER_ID']}}" hidden>
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
                        <div class="tab-pane fade" id="third" role="tabpanel">
                            <div class="text-center mt-5 mb-5">
                                <h5 class="card-title h4 fw-bold">شكراً لك،</h5>
                                <p class="card-text text-alternate mb-4 fs-6">لقد تم تفعيل حسابك بنجاح، يمكنك العودة لصفحة الدخول.</p>
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
                @else
                    <div class="alert alert-danger mt-4" role="alert">{{$msg}}</div>
                @endif
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
    @if($status && isset($data['IS_BLOCKED']) && $data['IS_BLOCKED']==0)
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                countDown('0:59', '#countdown');
            }, 500);
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
                let form = $('#check_code_form');
                errorHide(form);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.account.activate.code.request')}}',
                    data: {
                        'ACTIVATION_TOKEN': $('#ACTIVATION_TOKEN').val(),
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
                            showValidationError(form, index, value);
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
    @endif
@endpush
