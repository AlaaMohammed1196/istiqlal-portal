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
                            <div class="wizard p-0" id="wizardValidation_v2">
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
                                <form id="form_data" action="{{route('portal.company.partner.store.person')}}">
                                    <div class="alert alert-danger mt-4 d-none" role="alert"></div>
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="validationFirst" role="tabpanel">
                                            <p class="card-text text-alternate my-5"></p>
                                            <fieldset class="tooltip-end-bottom step">
                                                <div class="row mb-4">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="FIRST_NAME_NA" id="FIRST_NAME_NA" placeholder="اسم الشريك">
                                                            <label>اسم الشريك الأول</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="FATHER_NAME_NA" id="FATHER_NAME_NA" placeholder="اسم الشريك">
                                                            <label>اسم الأب</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="GRAND_FATHER_NAME_NA" id="GRAND_FATHER_NAME_NA" placeholder="اسم الشريك">
                                                            <label>اسم الجد</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="FAMILY_NAME_NA" id="FAMILY_NAME_NA" placeholder="اسم الشريك">
                                                            <label>اسم العائلة</label>
                                                        </div>
                                                    </div>
                                                </div>
{{--                                                <div class="form-floating mb-4">--}}
{{--                                                    <input type="text" class="form-control" name="PARTNER_FULL_NAME" id="PARTNER_FULL_NAME" placeholder="اسم الشريك رباعي">--}}
{{--                                                    <label>اسم الشريك رباعي</label>--}}
{{--                                                </div>--}}
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4 w-100">
                                                            <select class="select-floating-with-search" name="ID_TYPE_ID" id="ID_TYPE_ID">
                                                                <option></option>
                                                                @foreach($constants['IndividualIdTypes'] as $item)
                                                                    <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label>نوع الوثيقة</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control" name="ID_NUM" id="ID_NUM" maxlength="9" placeholder="رقم الهوية">
                                                            <label>رقم الوثيقة</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" name="BIRTH_PLACE" id="BIRTH_PLACE" value="" placeholder="أدخل مكان الميلاد" />
                                                            <label>مكان الميلاد</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="date-picker-close form-control" name="BIRTH_DATE" id="BIRTH_DATE" placeholder="تاريخ الميلاد" autocomplete="off"/>
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
                                                            <label>الحالة الاجتماعية</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4 w-100">
                                                            <select class="select-floating-with-search" name="NATIONALITY_ID[]" id="NATIONALITY_ID" multiple>
                                                                <option></option>
                                                                @foreach($constants['Nationalities'] as $item)
                                                                    <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label>الجنسية</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating ">
                                                            <input type="text" class="form-control number-only" name="DEPENDENTS_CNT" id="DEPENDENTS_CNT" placeholder="عدد المعالين" />
                                                            <label>عدد المعالين</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-start">
                                                    <button class="btn btn-icon btn-icon-end btn-secondary" onclick="checkTab(1)" type="button">
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
                                                            <input type="text" class="form-control number-only" name="SHARES_CNT" id="SHARES_CNT" placeholder="عدد الأسهم">
                                                            <label>عدد الأسهم</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control number-only" name="CONTRIBUTION_PERCENT" id="CONTRIBUTION_PERCENT" placeholder="نسبة المساهمة %" />
                                                            <label>نسبة المساهمة %</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-12 col-md-4 col-form-label pt-0">مقترض قائم لدى بنك الاستقلال للاستثمار والتنمية</label>
                                                    <div class="col-12 col-md-8">
                                                        <div class="form-check form-check-inline ">
                                                            <input class="form-check-input" type="radio" name="IS_BANK_BORROWER" checked id="IS_BANK_BORROWER_1" value="1">
                                                            <label class="form-check-label" for="IS_BANK_BORROWER_1">نعم</label>
                                                        </div>
                                                        <div class="form-check form-check-inline ">
                                                            <input class="form-check-input" type="radio" name="IS_BANK_BORROWER" id="IS_BANK_BORROWER_2" disabled value="0">
                                                            <label class="form-check-label" for="IS_BANK_BORROWER_2">لا</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <textarea class="form-control" name="NOTES" id="NOTES" placeholder="ملاحظات" rows="5" maxlength="{{textMaxSize()}}"></textarea>
                                                    <label>ملاحظات أخرى</label>
                                                </div>
                                                <div class="text-start">
                                                    <button class="btn btn-icon btn-icon-start btn-outline-secondary" onclick="prev()" type="button">
                                                        <i data-acorn-icon="chevron-right"></i>
                                                        <span>السابق</span>
                                                    </button>
                                                    <button class="btn btn-icon btn-icon-end btn-secondary" onclick="checkTab(2)" type="button">
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
                                                    <textarea class="form-control" name="CURRENT_EXPERIENCE_NOTES" id="CURRENT_EXPERIENCE_NOTES" placeholder="تفاصيل الخبرة للعمل الحالي" rows="5" maxlength="{{textMaxSize()}}"></textarea>
                                                    <label>تفاصيل الخبرة للعمل الحالي</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <textarea class="form-control" name="OTHER_EXPERIENCE_NOTES" id="OTHER_EXPERIENCE_NOTES" placeholder="الخبرة في مجالات أخرى" rows="5" maxlength="{{textMaxSize()}}"></textarea>
                                                    <label>الخبرة في مجالات أخرى</label>
                                                </div>
                                                <div class="text-start">
                                                    <button class="btn btn-icon btn-icon-start btn-outline-secondary" onclick="prev()" type="button">
                                                        <i data-acorn-icon="chevron-right"></i>
                                                        <span>السابق</span>
                                                    </button>
                                                    <button class="btn btn-icon btn-icon-end btn-secondary" onclick="checkTab(3)" type="button">
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
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4 w-100">
                                                            <select class="select-floating-with-search" name="COUNTRY_ID" id="COUNTRY_ID">
                                                                <option></option>
                                                                @foreach($countries as $item)
                                                                    <option value="{{$item['COUNTRY_ID']}}">{{$item['COUNTRY_NA']}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label>الدولة</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4 w-100">
                                                            <select class="select-floating-with-search" disabled name="STATE_ID" id="STATE_ID">
                                                                <option></option>
                                                            </select>
                                                            <label>المحافظة</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4 w-100">
                                                            <select class="select-floating-with-search" disabled name="CITY_ID" id="CITY_ID">
                                                                <option></option>
                                                            </select>
                                                            <label>المدينة/البلدة</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control" name="ADDRESS" id="ADDRESS" placeholder="العنوان" />
                                                            <label>العنوان</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control number-only" name="PHONE_NUMBER" id="PHONE_NUMBER" maxlength="9" placeholder="رقم الهاتف" />
                                                            <label>رقم الهاتف</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control number-only" name="CELULAR_NUMBER" id="CELULAR_NUMBER" maxlength="10" placeholder="رقم الهاتف المتنقل" />
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
        .border-error, .select2-container--bootstrap4 .select2-selection.border-error{
            border-color: #cf2637!important;
        }
        .form-floating .select2-selection.select2-selection--multiple {
            height: auto;
            min-height: 52px !important;
            padding: 0.5rem 0rem;
        }
        .select2-container .select2-search--inline{
            float: right;
        }
        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice{
            float: right;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#COUNTRY_ID').on('change', function (e) {
                e.preventDefault();
                $('#STATE_ID').prop('disabled', true);
                $('#CITY_ID').prop('disabled', true);
                let val = $(this).val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.states.fetch')}}',
                    data: {
                        'id': val,
                    },
                    success: function (response) {
                        $('#STATE_ID').html(response.html);
                        $('#STATE_ID').prop('disabled', false);
                    },
                    error: function (response) {
                    }
                })
            });
            $('#STATE_ID').on('change', function (e) {
                e.preventDefault();
                $('#CITY_ID').prop('disabled', true);
                let val = $(this).val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.cities.fetch')}}',
                    data: {
                        'id': val,
                    },
                    success: function (response) {
                        $('#CITY_ID').html(response.html);
                        $('#CITY_ID').prop('disabled', false);
                    },
                    error: function (response) {
                    }
                })
            });
        });

        $(document).ready(function() {
            $('#ID_TYPE_ID').on('change', function (e) {
                let value = $(this).val();
                let field = $('#ID_NUM');
                if(value==1){
                    field.prop('type', 'number');
                    field.prop('maxlength', '9');
                }else{
                    field.prop('type', 'text');
                    field.removeAttr('maxlength');
                }
            });
            $('#ID_NUM').on('change', function (e) {
                e.preventDefault();
                $('input[name="IS_BANK_BORROWER"]').prop('disabled', true);
                let field = $(this);
                let form = $('#form_data');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.company.partner.is-borrower')}}',
                    data: {
                        'ID_NUM': field.val(),
                        'CUST_TYPE_ID': 2,
                        'ID_TYPE_ID': $('#ID_TYPE_ID').val(),
                    },
                    success: function (response) {
                        if (response.status) {
                            if(response.value == 1){
                                $('input[name="IS_BANK_BORROWER"][value="1"]').prop('disabled', false);
                                $('input[name="IS_BANK_BORROWER"][value="1"]').prop('checked', true);
                            }else{
                                $('input[name="IS_BANK_BORROWER"][value="0"]').prop('disabled', false);
                                $('input[name="IS_BANK_BORROWER"][value="0"]').prop('checked', true);
                            }
                        } else {
                            errorShow(form, response.msg);
                        }
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
                        $.each(response.responseJSON.errors, function (i, value) {
                            let index = i.split('.')[0];
                            showValidationError(form, index, value)
                        });
                        errorShow(form, 'الرجاء التحقق من البيانات المدخلة');
                        loaderEnd(form)
                    }
                })
            });
        });

        function checkTab(nu){
            $('.fromFront').remove();
            if(nu == 1){
                // let PARTNER_FULL_NAME = $('#PARTNER_FULL_NAME').val();
                let FIRST_NAME_NA = $('#FIRST_NAME_NA').val();
                let FATHER_NAME_NA = $('#FATHER_NAME_NA').val();
                let GRAND_FATHER_NAME_NA = $('#GRAND_FATHER_NAME_NA').val();
                let FAMILY_NAME_NA = $('#FAMILY_NAME_NA').val();
                let ID_TYPE_ID = $('#ID_TYPE_ID').val();
                let ID_NUM = $('#ID_NUM').val();
                let ID_NUM_length = $('#ID_NUM').val().length;
                let BIRTH_PLACE = $('#BIRTH_PLACE').val();
                let BIRTH_DATE = $('#BIRTH_DATE').val();
                let GENDER_ID = $('input[name="GENDER_ID"]:checked').val();
                let MARITAL_STATUS_ID = $('#MARITAL_STATUS_ID').val();
                let NATIONALITY_ID = $('#NATIONALITY_ID').val().length;
                let DEPENDENTS_CNT = $('#DEPENDENTS_CNT').val();

                if(FIRST_NAME_NA != null && FIRST_NAME_NA != ''){
                    $('#FIRST_NAME_NA').removeClass('border-error');
                }else{
                    $('#FIRST_NAME_NA').addClass('border-error');
                }

                if(FATHER_NAME_NA != null && FATHER_NAME_NA != ''){
                    $('#FATHER_NAME_NA').removeClass('border-error');
                }else{
                    $('#FATHER_NAME_NA').addClass('border-error');
                }

                if(GRAND_FATHER_NAME_NA != null && GRAND_FATHER_NAME_NA != ''){
                    $('#GRAND_FATHER_NAME_NA').removeClass('border-error');
                }else{
                    $('#GRAND_FATHER_NAME_NA').addClass('border-error');
                }

                if(FAMILY_NAME_NA != null && FAMILY_NAME_NA != ''){
                    $('#FAMILY_NAME_NA').removeClass('border-error');
                }else{
                    $('#FAMILY_NAME_NA').addClass('border-error');
                }

                if(ID_TYPE_ID != null && ID_TYPE_ID != ''){
                    $('#ID_TYPE_ID').parent().find('.select2-selection').removeClass('border-error');
                }else{
                    $('#ID_TYPE_ID').parent().find('.select2-selection').addClass('border-error');
                }

                if(ID_NUM != null && ID_NUM != ''){
                    $('#ID_NUM').removeClass('border-error');
                }else{
                    $('#ID_NUM').addClass('border-error');
                }

                if(ID_TYPE_ID == 1){
                    if(ID_NUM_length == 9){
                        $('#ID_NUM').removeClass('border-error');
                    }else{
                        $('#ID_NUM').addClass('border-error');
                    }
                }

                if(BIRTH_PLACE != null && BIRTH_PLACE != ''){
                    $('#BIRTH_PLACE').removeClass('border-error');
                }else{
                    $('#BIRTH_PLACE').addClass('border-error');
                }

                if(BIRTH_DATE != null && BIRTH_DATE != ''){
                    $('#BIRTH_DATE').removeClass('border-error');
                }else{
                    $('#BIRTH_DATE').addClass('border-error');
                }

                if(GENDER_ID != null && GENDER_ID != ''){
                    $('#GENDER_ID').removeClass('border-error');
                }else{
                    $('#GENDER_ID').addClass('border-error');
                }

                if(MARITAL_STATUS_ID != null && MARITAL_STATUS_ID != ''){
                    $('#MARITAL_STATUS_ID').parent().find('.select2-selection').removeClass('border-error');
                }else{
                    $('#MARITAL_STATUS_ID').parent().find('.select2-selection').addClass('border-error');
                }

                if(NATIONALITY_ID > 0){
                    $('#NATIONALITY_ID').parent().find('.select2-selection').removeClass('border-error');
                }else{
                    $('#NATIONALITY_ID').parent().find('.select2-selection').addClass('border-error');
                }

                if(DEPENDENTS_CNT != null && DEPENDENTS_CNT != ''){
                    $('#DEPENDENTS_CNT').removeClass('border-error');
                }else{
                    $('#DEPENDENTS_CNT').addClass('border-error');
                }

                let first_val = false;
                let second_val = false;
                if(FIRST_NAME_NA != null && FIRST_NAME_NA != '' &&
                    FATHER_NAME_NA != null && FATHER_NAME_NA != '' &&
                    GRAND_FATHER_NAME_NA != null && GRAND_FATHER_NAME_NA != '' &&
                    FAMILY_NAME_NA != null && FAMILY_NAME_NA != '' &&
                    ID_NUM != null && ID_NUM != '' &&
                    BIRTH_PLACE != null && BIRTH_PLACE != '' &&
                    BIRTH_DATE != null && BIRTH_DATE != '' &&
                    GENDER_ID != null && GENDER_ID != '' &&
                    MARITAL_STATUS_ID != null && MARITAL_STATUS_ID != '' &&
                    NATIONALITY_ID > 0 &&
                    DEPENDENTS_CNT != null && DEPENDENTS_CNT != '' ){
                    first_val = true;
                }
                if(ID_TYPE_ID == 1){
                    if(ID_NUM_length == 9){
                        second_val = true;
                    }else{
                        second_val = false;
                        $('#ID_NUM').parent().append('<div class="invalid-feedback d-block fromFront">يجب أن يحتوى رقم الوثيقة على 9 أرقام</div>');
                    }
                }else{
                    second_val = true;
                }
                if(first_val && second_val){
                    next();
                }
                return false;
            }else if(nu == 2){
                let SHARES_CNT = $('#SHARES_CNT').val();
                let CONTRIBUTION_PERCENT = $('#CONTRIBUTION_PERCENT').val();

                if(SHARES_CNT != null && SHARES_CNT != ''){
                    $('#SHARES_CNT').removeClass('border-error');
                }else{
                    $('#SHARES_CNT').addClass('border-error');
                }

                if(CONTRIBUTION_PERCENT != null && CONTRIBUTION_PERCENT != ''){
                    $('#CONTRIBUTION_PERCENT').removeClass('border-error');
                }else{
                    $('#CONTRIBUTION_PERCENT').addClass('border-error');
                }

                if(SHARES_CNT != null && SHARES_CNT != '' &&
                    CONTRIBUTION_PERCENT != null && CONTRIBUTION_PERCENT != '' ){
                    next();
                }
                return false;
            }else if(nu == 3){
                let EXPERIENCE_YEARS_CNT = $('#EXPERIENCE_YEARS_CNT').val();
                let EDUCATION_LEVEL_ID = $('#EDUCATION_LEVEL_ID').val();
                let CURRENT_EXPERIENCE_NOTES = $('#CURRENT_EXPERIENCE_NOTES').val();
                let OTHER_EXPERIENCE_NOTES = $('#OTHER_EXPERIENCE_NOTES').val();

                if(EXPERIENCE_YEARS_CNT != null && EXPERIENCE_YEARS_CNT != ''){
                    $('#EXPERIENCE_YEARS_CNT').removeClass('border-error');
                }else{
                    $('#EXPERIENCE_YEARS_CNT').addClass('border-error');
                }

                if(EDUCATION_LEVEL_ID != null && EDUCATION_LEVEL_ID != ''){
                    $('#EDUCATION_LEVEL_ID').parent().find('.select2-selection').removeClass('border-error');
                }else{
                    $('#EDUCATION_LEVEL_ID').parent().find('.select2-selection').addClass('border-error');
                }

                if(CURRENT_EXPERIENCE_NOTES != null && CURRENT_EXPERIENCE_NOTES != ''){
                    $('#CURRENT_EXPERIENCE_NOTES').removeClass('border-error');
                }else{
                    $('#CURRENT_EXPERIENCE_NOTES').addClass('border-error');
                }

                if(OTHER_EXPERIENCE_NOTES != null && OTHER_EXPERIENCE_NOTES != ''){
                    $('#OTHER_EXPERIENCE_NOTES').removeClass('border-error');
                }else{
                    $('#OTHER_EXPERIENCE_NOTES').addClass('border-error');
                }

                if(EXPERIENCE_YEARS_CNT != null && EXPERIENCE_YEARS_CNT != '' &&
                    EDUCATION_LEVEL_ID != null && EDUCATION_LEVEL_ID != '' &&
                    CURRENT_EXPERIENCE_NOTES != null && CURRENT_EXPERIENCE_NOTES != '' &&
                    OTHER_EXPERIENCE_NOTES != null && OTHER_EXPERIENCE_NOTES != '' ){
                    next();
                }
                return false;
            }else if(nu == 4){
                let COUNTRY_ID = $('#COUNTRY_ID').val();
                let STATE_ID = $('#STATE_ID').val();
                let CITY_ID = $('#CITY_ID').val();
                let PHONE_NUMBER = $('#PHONE_NUMBER').val();
                let CELULAR_NUMBER = $('#CELULAR_NUMBER').val();
                let EMAIL = $('#EMAIL').val();

                if(COUNTRY_ID != null && COUNTRY_ID != ''){
                    $('#COUNTRY_ID').parent().find('.select2-selection').removeClass('border-error');
                }else{
                    $('#COUNTRY_ID').parent().find('.select2-selection').addClass('border-error');
                }

                if(STATE_ID != null && STATE_ID != ''){
                    $('#STATE_ID').parent().find('.select2-selection').removeClass('border-error');
                }else{
                    $('#STATE_ID').parent().find('.select2-selection').addClass('border-error');
                }

                if(CITY_ID != null && CITY_ID != ''){
                    $('#CITY_ID').parent().find('.select2-selection').removeClass('border-error');
                }else{
                    $('#CITY_ID').parent().find('.select2-selection').addClass('border-error');
                }

                if(PHONE_NUMBER != null && PHONE_NUMBER != ''){
                    $('#PHONE_NUMBER').removeClass('border-error');
                }else{
                    $('#PHONE_NUMBER').addClass('border-error');
                }

                if(CELULAR_NUMBER != null && CELULAR_NUMBER != ''){
                    $('#CELULAR_NUMBER').removeClass('border-error');
                }else{
                    $('#CELULAR_NUMBER').addClass('border-error');
                }

                if(EMAIL != null && EMAIL != ''){
                    $('#EMAIL').removeClass('border-error');
                }else{
                    $('#EMAIL').addClass('border-error');
                }

                if(COUNTRY_ID != null && COUNTRY_ID != '' &&
                    STATE_ID != null && STATE_ID != '' &&
                    CITY_ID != null && CITY_ID != '' &&
                    PHONE_NUMBER != null && PHONE_NUMBER != '' &&
                    CELULAR_NUMBER != null && CELULAR_NUMBER != '' &&
                    EMAIL != null && EMAIL != '' ){
                    next();
                }
                return false;
            }

        }

        function showValidationError(form, index, value){
            form.find("input[name='"+index+"']").addClass('border-danger');
            form.find("input[name='"+index+"']").after('<div class="invalid-feedback d-block">' + value + '</div');
            form.find("select[name='"+index+"']").addClass('border-danger');
            form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
            form.find("select[name='"+index+"[]']").addClass('border-danger');
            form.find("select[name='"+index+"[]']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
            form.find("textarea[name='"+index+"']").addClass('border-danger');
            form.find("textarea[name='"+index+"']").after('<div class="invalid-feedback d-block">' + value + '</div');
        }
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
