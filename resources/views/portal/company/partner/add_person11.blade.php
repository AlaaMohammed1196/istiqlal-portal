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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.partner.index')}}">الشركاء</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.company.partner.add.index')}}">إضافة شريك</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.company.partner.add.person')}}">شخص</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row gx-5">
            @include('portal.components.company_link_list')
            <div class="col-lg-8 col-xl-8">
                <!-- Details Start -->
                <h2 class="h4">إضافة شريك</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="wizard p-0" id="wizardValidation">

                                <ul class="nav nav-tabs register-nav partner-nav p-0 justify-content-center" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-center position-relative" href="#validationFirst" role="tab">
                                            <div class="mb-1 title d-none d-sm-block">البيانات الأساسية</div>
                                            <div class="text-small description d-none d-md-block">أدخل بيانات الشريك الأساسية</div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-center" href="#validationSecond" role="tab">
                                            <div class="mb-1 title d-none d-sm-block">بيانات المساهمة</div>
                                            <div class="text-small description  d-none d-md-block">أدخل بيانات مساهمة الشريك</div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-center" href="#validationThird" role="tab">
                                            <div class="mb-1 title d-none d-sm-block">بيانات العمل</div>
                                            <div class="text-small description  d-none d-md-block">أدخل بيانات عمل الشريك</div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-center" href="#validationFourth" role="tab">
                                            <div class="mb-1 title d-none d-sm-block">بيانات العنوان والاتصال</div>
                                            <div class="text-small description  d-none d-md-block">أدخل بيانات العنوان والاتصال للشريك</div>
                                        </a>
                                    </li>
                                    <li class="nav-item d-none" role="presentation">
                                        <a class="nav-link text-center" href="#validationLast" role="tab"></a>
                                    </li>
                                </ul>
                                <form>
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="validationFirst" role="tabpanel">
                                            <p class="card-text text-alternate my-5"></p>
                                            <fieldset class="tooltip-end-bottom step">
                                                <div class="form-floating mb-4">
                                                    <input type="text" class="form-control" name="PARTNER_FULL_NAME" id="PARTNER_FULL_NAME" placeholder="اسم الشريك رباعي">
                                                    <label>اسم الشريك رباعي</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <input type="text" class="form-control number-only" name="ID_NUM" id="ID_NUM" placeholder="رقم الهوية">
                                                    <label>رقم الهوية </label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4 w-100">
                                                            <select class="select-floating-with-search" name="BIRTH_PLACE" id="BIRTH_PLACE">
                                                                <option></option>
                                                                @foreach($constants['Countries'] as $item)
                                                                    <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label>مكان الميلاد</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="date-picker-close form-control" name="BIRTH_DATE" id="BIRTH_DATE" placeholder="تاريخ الميلاد" />
                                                            <label>تاريخ الميلاد</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6  mb-4">
                                                        <label class="col-12 col-form-label pt-0">الجنس</label>
                                                        <div class="col-12">
                                                            <div class="form-check form-check-inline ">
                                                                <input class="form-check-input" type="radio" name="GENDER_ID" checked id="GENDER_ID_1" value="1">
                                                                <label class="form-check-label" for="GENDER_ID_1">ذكر</label>
                                                            </div>
                                                            <div class="form-check form-check-inline ">
                                                                <input class="form-check-input" type="radio" name="GENDER_ID" id="GENDER_ID_2" value="2">
                                                                <label class="form-check-label" for="GENDER_ID_2">انثي</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-4">
                                                        <div class="form-floating mb-4 w-100">
                                                            <select class="select-floating-with-search" name="MARITAL_STATUS_ID" id="MARITAL_STATUS_ID">
                                                                <option></option>
                                                                @foreach($constants['MaritalStatus'] as $item)
                                                                    <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label>الجنسية</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4 w-100">
                                                            <select class="select-floating-with-search" name="NATIONALITY_ID[]" id="NATIONALITY_ID">
                                                                <option></option>
                                                                @foreach($constants['Countries'] as $item)
                                                                    <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label>الجنسية</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating ">
                                                            <input type="text" class="form-control" name="DEPENDENTS_CNT" id="DEPENDENTS_CNT" placeholder="عدد المعالين" />
                                                            <label>عدد المعالين</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-start">
                                                    <button class="btn btn-icon btn-icon-start btn-outline-secondary" onclick="prev()" type="button">
                                                        <i data-acorn-icon="chevron-right"></i>
                                                        <span>السابق</span>
                                                    </button>
                                                    <button class="btn btn-icon btn-icon-end btn-secondary" onclick="prev()" type="button">
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
                                            </fieldset>
                                        </div>
                                        <div class="tab-pane fade" id="validationSecond" role="tabpanel">
                                            <p class="card-text text-alternate my-5"></p>
                                            <fieldset class="tooltip-end-bottom step">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control" name="SHARES_CNT" id="SHARES_CNT" placeholder="عدد الأسهم">
                                                            <label>عدد الأسهم</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control" name="CONTRIBUTION_PERCENT" id="CONTRIBUTION_PERCENT" placeholder="نسبة المساهمة %" value="5" />
                                                            <label>نسبة المساهمة %</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-12 col-md-4 col-form-label pt-0">مقترض قائم لدى بنك الاستقلال</label>
                                                    <div class="col-12 col-md-8">
                                                        <div class="form-check form-check-inline ">
                                                            <input class="form-check-input" type="radio" name="IS_BANK_BORROWER" checked id="IS_BANK_BORROWER_1" value="1">
                                                            <label class="form-check-label" for="IS_BANK_BORROWER_1">نعم</label>
                                                        </div>
                                                        <div class="form-check form-check-inline ">
                                                            <input class="form-check-input" type="radio" name="IS_BANK_BORROWER" id="IS_BANK_BORROWER_2" value="0">
                                                            <label class="form-check-label" for="IS_BANK_BORROWER_2">لا</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <textarea class="form-control" name="NOTES" id="NOTES" placeholder="ملاحظات" rows="5"></textarea>
                                                    <label>ملاحظات أخرى</label>
                                                </div>
                                                <div class="text-start">
                                                    <button class="btn btn-icon btn-icon-start btn-outline-secondary" onclick="prev()" type="button">
                                                        <i data-acorn-icon="chevron-right"></i>
                                                        <span>السابق</span>
                                                    </button>
                                                    <button class="btn btn-icon btn-icon-end btn-secondary" onclick="prev()" type="button">
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
                                            </fieldset>
                                        </div>
                                        <div class="tab-pane fade" id="validationThird" role="tabpanel">
                                            <p class="card-text text-alternate my-5"></p>
                                            <fieldset class="tooltip-end-bottom step">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-3 w-100">
                                                            <select class="select-floating-with-search"  name="EDUCATION_LEVEL_ID" id="EDUCATION_LEVEL_ID">
                                                                <option></option>
                                                                @foreach($constants['EducationLevels'] as $item)
                                                                    <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label>المؤهل العلمي</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control number-only" name="EXPERIENCE_YEARS_CNT" id="EXPERIENCE_YEARS_CNT" placeholder="سنوات الخبرة للعمل الحالي" />
                                                            <label>سنوات الخبرة للعمل الحالي</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <textarea class="form-control" name="CURRENT_EXPERIENCE_NOTES" id="CURRENT_EXPERIENCE_NOTES" placeholder="تفاصيل الخبرة للعمل الحالي" rows="5"></textarea>
                                                    <label>تفاصيل الخبرة للعمل الحالي</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <textarea class="form-control" name="OTHER_EXPERIENCE_NOTES" id="OTHER_EXPERIENCE_NOTES" placeholder="الخبرة في مجالات أخرى" rows="5"></textarea>
                                                    <label>الخبرة في مجالات أخرى</label>
                                                </div>
                                                <div class="text-start">
                                                    <button class="btn btn-icon btn-icon-start btn-outline-secondary" onclick="prev()" type="button">
                                                        <i data-acorn-icon="chevron-right"></i>
                                                        <span>السابق</span>
                                                    </button>
                                                    <button class="btn btn-icon btn-icon-end btn-secondary" onclick="prev()" type="button">
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
                                            </fieldset>
                                        </div>
                                        <div class="tab-pane fade" id="validationFourth" role="tabpanel">
                                            <p class="card-text text-alternate my-5"></p>
                                            <fieldset class="tooltip-end-bottom step">
                                                <div class="row">
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-floating mb-4 w-100">
                                                            <select class="select-floating-with-search" name="COUNTRY_ID" id="COUNTRY_ID">
                                                                <option></option>
                                                                @foreach($constants['Countries'] as $item)
                                                                    <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label>الدولة</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-floating mb-4 w-100">
                                                            <select class="select-floating-with-search" name="STATE_ID" id="STATE_ID">
                                                                <option></option>
                                                                @foreach($constants['Countries'] as $item)
                                                                    <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label>المحافظة</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-floating mb-4 w-100">
                                                            <select class="select-floating-with-search" name="CITY_ID" id="CITY_ID">
                                                                <option></option>
                                                                @foreach($constants['Countries'] as $item)
                                                                    <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label>المدينة/البلدة</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control" name="CELULAR_NUMBER" id="CELULAR_NUMBER" placeholder="رقم الهاتف المتنقل" />
                                                            <label>رقم الهاتف المتنقل</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control" name="EMAIL" id="EMAIL" placeholder="البريد الإلكتروني" />
                                                            <label>البريد الإلكتروني</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-start">
                                                    <button class="btn btn-icon btn-icon-start btn-outline-secondary" onclick="prev()" type="button">
                                                        <i data-acorn-icon="chevron-right"></i>
                                                        <span>السابق</span>
                                                    </button>
                                                    <button class="btn btn-icon btn-icon-end btn-secondary" onclick="prev()" type="button">
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
                                            </fieldset>
                                        </div>
                                        <div class="tab-pane fade" id="validationLast" role="tabpanel">
                                            <div class="text-center mt-5 mb-5">
                                                <h5 class="card-title h4 fw-bold">شكراً لك،</h5>
                                                <p class="card-text text-alternate mb-4 fs-6">لقد تم اضافة شخص كشريك بنجاح، يمكنك العودة إلى صفحة الشركاء للمشاهدة.</p>
                                                <a href="{{route('portal.company.partner.index')}}" class="btn btn-icon btn-icon-start btn-secondary mb-5">
                                                    <i class="fa-solid fa-handshake"></i>
                                                    <span>الشركاء</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-sm-row justify-content-sm-end">
                                        <button class="btn btn-icon btn-icon-start btn-outline-secondary btn-prev mx-0 mx-sm-3 mb-3 mb-sm-0" type="button">
                                            <i data-acorn-icon="chevron-right"></i>
                                            <span>السابق</span>
                                        </button>
                                        <button class="btn btn-icon btn-icon-end btn-secondary btn-next" type="button">
                                            <span>المتابعة</span>
                                            <i data-acorn-icon="chevron-left"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Details End -->
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .btn-prev, .btn-next{
            display: none;
        }
        .form-floating>label{
            height: auto;
        }
    </style>
@endpush

@push('script')
    <script>
        function next(){
            $('.btn-next').trigger('click');
        }

        function prev(){
            $('.btn-prev').trigger('click');
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

    <script src="{{asset('assets')}}/js/forms/layouts.js"></script>

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
