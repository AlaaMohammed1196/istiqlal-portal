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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.note.index')}}">الملاحظات</a></li>
                            <li class="breadcrumb-item">تعديل</li>
                        </ul>
                    </nav>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row gx-5">
            @include('portal.components.company_link_list')
            <div class="col-lg-8 col-xl-6">
                <!-- Details Start -->
                <h2 class="h4">الملاحظات</h2>
                <div class="card">
                    <div class="card-body">
                        <form id="form_data" action="{{route('portal.company.note.update')}}">
                            <div class="row g-0 align-items-start mb-2">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="اكتب الملاحظات هنا" name="NOTES" id="NOTES" maxlength="{{textMaxSize()}}" style="height: 300px">{{$data['NOTES']}}</textarea>
                                    <label for="NOTES">اكتب الملاحظات هنا</label>
                                </div>
                            </div>
                            <div class="mb-3 row mt-5">
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
                        </form>
                    </div>
                </div>
                <!-- Details End -->
            </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
    <script>
        $(document).ready(function() {
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
        function showValidationError(form, index, value){
            form.find("input[name='"+index+"']").addClass('border-danger');
            form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
            form.find("select[name='"+index+"']").addClass('border-danger');
            form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
            form.find("textarea[name='"+index+"']").addClass('border-danger');
            form.find("textarea[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
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

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
