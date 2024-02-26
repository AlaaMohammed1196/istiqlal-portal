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
        <div class="col-12 col-md-12 col-lg-12 col-xl-8">
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
                                    <input type="file" id="profile_img" name="USER_PICTURE" class="d-none" onchange="loadFile(this, 'image')" accept="{{acceptImageType()}}">
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
                                <input type="text" class="form-control" name="USER_FULL_NAME" id="USER_FULL_NAME" value="{{$data['USER_FULL_NAME']}}" readonly/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">نوع الوثيقة</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <input type="text" class="form-control" id="ID_NUM" value="{{$data['ID_TYPE_DESC']}}" disabled />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">رقم الوثيقة</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <input type="text" class="form-control" id="ID_NUM" value="{{$data['ID_NUM']}}" disabled />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">تاريخ الميلاد</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <input type="text" class="form-control date-picker-close" id="birthday" name="BIRTH_DATE" value="{{$data['BIRTH_DATE']}}" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">العمل</label>
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
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">الرسائل القصيرة</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="SMS_RECEIVE_FLAG" {{$data['SMS_RECEIVE_FLAG']==1?'checked':''}}  id="SMS_RECEIVE_FLAG_2" value="1">
                                    <label class="form-check-label" for="SMS_RECEIVE_FLAG_2">تفعيل</label>
                                </div>
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="SMS_RECEIVE_FLAG" {{$data['SMS_RECEIVE_FLAG']==0?'checked':''}} id="SMS_RECEIVE_FLAG_2" value="0">
                                    <label class="form-check-label" for="SMS_RECEIVE_FLAG_2">إلغاء</label>
                                </div>
                            </div>
                        </div>

                        <hr class="border-light">
                        <h2 class="small-title fw-bold">معلومات الاتصال</h2>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">البريد الإلكتروني</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <input type="text" class="form-control" id="EMAIL" name="EMAIL" value="{{$data['EMAIL']}}" disabled/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">رقم الهاتف</label>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <input type="text" class="form-control" id="CELULAR" name="CELULAR" value="{{$data['CELULAR_COUNTRY_PHONE_INTRO']}}{{$data['CELULAR']}}" disabled/>
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
        });

        var loadFile = function (event, image_id) {
            $('#'+image_id).attr('src', URL.createObjectURL(event.files[0]))
        };
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
