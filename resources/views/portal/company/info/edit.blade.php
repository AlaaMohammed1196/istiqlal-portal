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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.info.index')}}">البيانات العامة</a></li>
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
                <h2 class="h4">البيانات العامة</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-0 align-items-start mb-2">
                            <form id="form_data" action="{{route('portal.company.info.update')}}">
                                <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">اسم الشركة <span class="text-danger">*</span></label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <input type="text" class="form-control" id="PROFILE_NAME_NA" name="PROFILE_NAME_NA" required readonly value="{{$data['CompanyGeneralInfo'][0]['PROFILE_NAME_NA']}}" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">رقم التسجيل <span class="text-danger">*</span></label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <input type="text" class="form-control number-only" id="ID_NUM" name="ID_NUM" required readonly value="{{$data['CompanyGeneralInfo'][0]['ID_NUM']}}" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">الشكل القانوني <span class="text-danger">*</span></label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <select class="select-single-with-search" name="FIRM_LEGAL_TYPE_ID" id="FIRM_LEGAL_TYPE_ID" data-placeholder="اختر الشكل القانوني" data-width="100%">
                                            <option></option>
                                            @foreach($constants['LegalForms'] as $item)
                                                <option value="{{$item['CONSTANT_ID']}}" {{$item['CONSTANT_ID']==$data['CompanyGeneralInfo'][0]['FIRM_LEGAL_TYPE_ID']?'selected':''}}>{{$item['CONSTANT_DESC']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">تاريخ التسجيل <span class="text-danger">*</span></label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control date-picker-close" name="ISTABLISHMENT_DATE" id="ISTABLISHMENT_DATE" value="{{$data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE']?\Carbon\Carbon::parse($data['CompanyGeneralInfo'][0]['ISTABLISHMENT_DATE'])->translatedFormat('d-m-Y'):''}}" autocomplete="off"/>
                                            <span class="input-group-text">
                                                <i data-acorn-icon="calendar" class="text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">رأس المال المسجل <span class="text-danger">*</span></label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control w-75 integer-positive-only formattedNumber" name="CAPITAL" id="CAPITAL" value="{{$data['CompanyGeneralInfo'][0]['CAPITAL']}}" maxlength="17" />
                                            <select class="select-single-with-search w-25" name="CURR_ID" id="CURR_ID">
                                                <option></option>
                                                @foreach($constants['Currencies'] as $item)
                                                    <option value="{{$item['CURR_ID']}}" {{$item['CURR_ID']==$data['CompanyGeneralInfo'][0]['CURR_ID']?'selected':''}}>{{$item['CURR_NAME']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">تاريخ أخر إصدار لشهادة التسجيل</label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control date-picker-close" name="ISSUE_DATE" id="ISSUE_DATE" value="{{$data['CompanyGeneralInfo'][0]['ISSUE_DATE']?\Carbon\Carbon::parse($data['CompanyGeneralInfo'][0]['ISSUE_DATE'])->translatedFormat('d-m-Y'):''}}" autocomplete="off"/>
                                            <span class="input-group-text">
                                              <i data-acorn-icon="calendar" class="text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">النشاط الاقتصادي <span class="text-danger">*</span></label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <select class="select-single-with-search" name="ECONOMIC_ACTIVITY_ID" id="ECONOMIC_ACTIVITY_ID" data-placeholder="اختر نشاط الشركة" data-width="100%">
                                            <option></option>
                                            @foreach($constants['EconomicActivity'] as $item)
                                                <option value="{{$item['CONSTANT_ID']}}" {{$item['CONSTANT_ID']==$data['CompanyGeneralInfo'][0]['ECONOMIC_ACTIVITY_ID']?'selected':''}}>{{$item['CONSTANT_DESC']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">نوع النشاط <span class="text-danger">*</span></label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <select class="select-single-with-search" name="ACTIVITY_ID" id="ACTIVITY_ID" data-placeholder="اختر نوع النشاط" data-width="100%">
                                            <option></option>
                                            @if(count($activity_types) > 0)
                                                @foreach($activity_types as $item)
                                                    <option value="{{$item['VALUE']}}" {{$item['VALUE']==$data['CompanyGeneralInfo'][0]['ACTIVITY_ID']?'selected':''}}>{{$item['LABEL']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">معدل المبيعات لآخر سنة <span class="text-danger">*</span></label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control w-75 integer-positive-only formattedNumber" name="ANNUAL_SALES_RATE" id="ANNUAL_SALES_RATE" value="{{$data['CompanyGeneralInfo'][0]['ANNUAL_SALES_RATE']}}" maxlength="17" />
                                            <select class="select-single-with-search w-25" name="ANNUAL_SALES_RATE_CURR_ID" id="ANNUAL_SALES_RATE_CURR_ID">
                                                <option></option>
                                                @foreach($constants['Currencies'] as $item)
                                                    <option value="{{$item['CURR_ID']}}" {{$item['CURR_ID']==$data['CompanyGeneralInfo'][0]['ANNUAL_SALES_RATE_CURR_ID']?'selected':''}}>{{$item['CURR_NAME']}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">عدد العاملين "ذكور"</label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <input type="text" class="form-control number-only" name="EMPLOYEES_MALE_CNT" id="EMPLOYEES_MALE_CNT" value="{{$data['CompanyGeneralInfo'][0]['EMPLOYEES_MALE_CNT']}}" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">عدد العاملين "إناث"</label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <input type="text" class="form-control number-only" name="EMPLOYEES_FEMALE_CNT" id="EMPLOYEES_FEMALE_CNT" value="{{$data['CompanyGeneralInfo'][0]['EMPLOYEES_FEMALE_CNT']}}" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">كتاب التفويض</label>
                                    <div class="col-sm-8 col-md-9 col-lg-9 d-flex align-items-center">
                                        <?php $file = $data['CompanyGeneralInfo'][0]['AUTHORIZATION_LETTER_COMPANY_FILE'] ?>
                                        <input type="text" name="is_file_exist" value="{{$file?'0':'1'}}" hidden>
                                        <input type="text" class="form-control" id="file_name" value="{{$file?$file[0]['ORIGINAL_FILE_NAME']:''}}" disabled/>
                                        <input type="file" hidden name="AUTHORIZATION_LETTER_COMPANY_FILE" id="AUTHORIZATION_LETTER_COMPANY_FILE" onchange="loadFile(this)">
                                        <label type="button" for="AUTHORIZATION_LETTER_COMPANY_FILE" class="btn btn-icon btn-icon-only btn-outline-secondary w-100 w-sm-auto me-3">اختر ملف</label>
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
                </div>
                <!-- Details End -->
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .select2-container--bootstrap4 .select2-selection.border-danger {
            border: 1px solid var(--danger) !important;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#ECONOMIC_ACTIVITY_ID').on('change', function (e) {
                e.preventDefault();
                $('#ACTIVITY_ID').prop('disabled', true);
                let val = $(this).val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.company-activities.fetch')}}',
                    data: {
                        'id': val,
                    },
                    success: function (response) {
                        $('#ACTIVITY_ID').html(response.html);
                        $('#ACTIVITY_ID').prop('disabled', false);
                    },
                    error: function (response) {
                    }
                })
            });
            $('#CURR_ID').on('change', function (e) {
                e.preventDefault();
                let val = $(this).val();
                $('#CURR_ID_copy').val(val).trigger('change');
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

        var loadFile = function (event) {
            attachFile = event.files[0];
            let filename = $(event).val().split('\\').pop();
            $('#file_name').val(filename);
        };

        function showValidationError(form, index, value){
            form.find("input[name='"+index+"']").addClass('border-danger');
            form.find("input[name='"+index+"']").siblings('.input-number').addClass('border-danger');
            form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
            form.find("select[name='"+index+"']").addClass('border-danger');
            form.find("select[name='"+index+"']").siblings('.select2').find('.select2-selection').addClass('border-danger');
            form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
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
