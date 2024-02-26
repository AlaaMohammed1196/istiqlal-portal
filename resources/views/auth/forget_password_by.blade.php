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
                <div class="">
                    <a href="{{route('portal.password.forget.mobile')}}" class="btn btn-secondary btn-xl rounded-0">باستخدام رقم الهاتف الخلوي</a>
                    <a href="{{route('portal.password.forget.email')}}" class="btn btn-secondary btn-xl rounded-0">باستخدام البريد الإلكتروني</a>
                    <p class="h5">
                        العودة إلى صفحة
                        <a href="{{route('portal.login')}}" class="fw-bold text-secondary">الدخول</a>.
                    </p>
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
        .btn{
            width: 250px;
            margin-bottom: 10px;
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
                let form = $('#check_code_form');
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
@endpush
