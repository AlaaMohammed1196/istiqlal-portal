@extends('portal.layouts.auth')

@section('content')
    <div class="col-12 col-sm-10 offset-0 offset-md-1 offset-lg-0 col-lg-auto h-100 pb-4 px-sm-4 pt-0 p-lg-0">
        <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 px-5 px-sm-0 full-page-content-left-border">
            <div class="sw-lg-50 px-md-5" id="validation">
                <div class="sh-11">
                    <a href="{{route('portal.login')}}" class="login-logo">
                        <img src="{{asset('assets')}}/img/logo/logo-dark.png">
                        <!-- <div class="logo-default"></div> -->
                    </a>
                </div>
                <div class="mb-3">
                    <h2 class="cta-1 fw-bold mb-0 text-primary">أهلا بمحمد محمود الخالدي <br>في بوابة الاستقلال للتنمية و الاستثمار</h2>

                </div>

                <p class="card-text text-alternate mb-4 mt-4 fs-6">قم بإدخال كلمة المرور الجديدة الخاصة بك</p>
                <form class="tooltip-end-bottom">
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-acorn-icon="lock-off"></i>
                        <input class="form-control" placeholder="كلمة المرور الجديدة" required name="password" type="password" />
                    </div>
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-acorn-icon="lock-off"></i>
                        <input class="form-control" placeholder="تأكيد كلمة المرور الجديدة" required name="confirmpassword" type="password" />
                    </div>
                </form>
                <button class="btn btn-icon btn-icon-end btn-secondary btn-next" type="button">
                    <span>المتابعة</span>
                    <i data-acorn-icon="chevron-left"></i>
                </button>
            </div>
            <div class="bg-brand"></div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
@endpush
