@extends('portal.layouts.auth')

@section('content')
    <div class="col-12 col-sm-10 offset-0 offset-md-1  offset-lg-0 col-lg-auto h-100 pb-4 px-sm-4 pt-0 p-lg-0">
        <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 px-5 px-sm-0 full-page-content-left-border">
            <div class="sw-lg-50 px-md-5">
                <div class="sh-11">
                    <a href="{{route('portal.login')}}" class="login-logo">
                        <img src="{{asset('assets')}}/img/logo/logo-dark.png">
                        <!-- <div class="logo-default"></div> -->
                    </a>
                </div>
                <div class="mb-5">
                    <h2 class="cta-1 fw-bold mb-0 text-primary">أهلاً وسهلاً بك،</h2>
                    <h2 class="cta-1 text-primary">بوابة بنك الاستقلال للاستثمار والتنمية</h2>
                </div>
                <div class="mb-5">
                    <p class="h5">يرجى استخدام البيانات الخاصة بك لتسجيل الدخول</p>
                    <p class="h5">
                        إذا لا يوجد لديك حساب، يرجي
                        <a href="{{route('portal.register')}}" class="fw-bold text-secondary">التسجيل</a>
                        .
                    </p>
                </div>
                <div>
                    <form id="login-form" action="{{route('portal.login.submit')}}" method="post" class="tooltip-end-bottom" novalidate="novalidate">
                        <div class="alert alert-danger d-none" role="alert"></div>
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="barcode"></i>
                            <input class="form-control" placeholder="رقم المشتغل/التسجيل" name="USER_NAME" id="USER_NAME" />
                        </div>
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="lock-off"></i>
                            <input class="form-control pe-7" name="USER_PASS" id="USER_PASS" type="password" placeholder="كلمة المرور" />
                            <a class="password-icon show-password" href="javascript:void(0);"><i class="far fa-eye"></i></a>
                            <a class="password-icon hide-password d-none" href="javascript:void(0);"><i class="far fa-eye-slash"></i></a>
                        </div>
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <a class="mt-3 d-block" href="{{route('portal.password.forget')}}">نسيت كلمة المرور؟</a>
                        </div>

                        <button type="submit" class="btn btn-lg btn-secondary">دخول</button>
                    </form>
                </div>
            </div>
            <div class="bg-brand"></div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
    <script>
        $('#login-form').on('submit', function (e){
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
                    if(response.status){
                        window.location.href = response.url;
                    }else{
                        errorShow(form, response.msg);
                    }
                    loaderEnd(form);
                },
                error: function (response) {
                    $.each(response.responseJSON.errors, function (index, value) {
                        showValidationError(form, index, value);
                    });
                    loaderEnd(form);
                }
            })
        });
    </script>
@endpush
