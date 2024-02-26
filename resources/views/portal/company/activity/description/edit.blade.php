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
                            <li class="breadcrumb-item">نشاط الشركة</li>
                            <li class="breadcrumb-item"><a href="{{route('portal.company.activity.description.index')}}">وصف النشاط</a></li>
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
            <div class="col-lg-8 col-xl-8">
                <!-- Details Start -->
                <h2 class="h4">وصف النشاط</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-0 align-items-start mb-2">
                            <form id="form_data" action="{{route('portal.company.activity.description.update')}}">
                                <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-md-3 col-sm-4 col-form-label">مساحة العمل / م2</label>
                                    <div class="col-sm-8 col-md-9 col-lg-8">
                                        <input type="text" class="form-control integer-positive-only formattedNumber" id="WORK_SPACE" name="WORK_SPACE" value="{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['WORK_SPACE']:''}}" placeholder="مساحة العمل / م2">
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label class="col-lg-4 col-md-3 col-sm-4 col-form-label">عدد سنوات الخبرة بهذا المجال</label>
                                    <div class="col-sm-8 col-md-9 col-lg-8">
                                        <input type="text" class="form-control number-only" name="EXPERIENCE_YEARS_CNT" id="EXPERIENCE_YEARS_CNT" value="{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['EXPERIENCE_YEARS_CNT']:''}}" placeholder="عدد سنوات الخبرة بهذا المجال">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-md-3 col-sm-4 col-form-label">ملكية العقار</label>
                                    <div class="col-sm-8 col-md-9 col-lg-8">
                                        <select class="select-single-with-search" name="REAL_STATE_OWNERSHIP" id="REAL_STATE_OWNERSHIP" data-width="100%" data-placeholder="اختر ملكية العقار">
                                            <option></option>
                                            @foreach($constants['HousingOwnership'] as $item)
                                                <option value="{{$item['VALUE']}}" {{count($data['CompanyActivity'])>0?$item['VALUE']==$data['CompanyActivity'][0]['REAL_STATE_OWNERSHIP']?'selected':'':''}}>{{$item['LABEL']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-md-3 col-sm-4 col-form-label">شرح ملكية العقار</label>
                                    <div class="col-sm-8 col-md-9 col-lg-8">
                                        <textarea class="form-control" name="REAL_STATE_OWNERSHIP_NOTES" id="REAL_STATE_OWNERSHIP_NOTES" placeholder="شرح عن ملكية العقار" rows="5" maxlength="{{textMaxSize()}}">{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['REAL_STATE_OWNERSHIP_NOTES']:''}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label class="col-lg-4 col-md-3 col-sm-4 col-form-label d-flex justify-content-between">
                                        <span>طرق البيع </span>
                                        <button id="create_btn" class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top {{count($data['CompanySellingMethods'])>=2?'disabled':''}}" type="button">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </label>
                                    <div class="col-sm-8 col-md-9 col-lg-8">
                                        <div class="bg-light pt-3 pb-1 rounded">
                                            <div class="mb-4">
                                                <div class="table-responsive">
                                                    <table class="table table-striped align-middle">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">طريقة بيع</th>
                                                            <th scope="col"  class="text-center">النسبة</th>
                                                            <th scope="col" class="text-center">أدوات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="form_table">
                                                        @include('portal.company.activity.description.table')
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-md-3 col-sm-4 col-form-label">شرح عن النشاط</label>
                                    <div class="col-sm-8 col-md-9 col-lg-8">
                                        <textarea class="form-control" name="ACTIVITY_EXPLANATION_NOTES" id="ACTIVITY_EXPLANATION_NOTES" placeholder="شرح عن النشاط " rows="5" maxlength="{{textMaxSize()}}">{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['ACTIVITY_EXPLANATION_NOTES']:''}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-md-3 col-sm-4 col-form-label">ملاحظات عن الموظفين (الرواتب، مسميات الوظيفية، خبرات) </label>
                                    <div class="col-sm-8 col-md-9 col-lg-8">
                                        <textarea class="form-control" name="EMPLOYEES_NOTES" id="EMPLOYEES_NOTES" placeholder="ملاحظات عن الموظفين" rows="5" maxlength="{{textMaxSize()}}">{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['EMPLOYEES_NOTES']:''}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-md-3 col-sm-4 col-form-label">ملاحظات أخرى</label>
                                    <div class="col-sm-8 col-md-9 col-lg-8">
                                        <textarea class="form-control" name="OTHER_NOTES" id="OTHER_NOTES" placeholder="ملاحظات أخرى" rows="5" maxlength="{{textMaxSize()}}">{{count($data['CompanyActivity'])>0?$data['CompanyActivity'][0]['OTHER_NOTES']:''}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row mt-5">
                                    <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                        <button type="submit" class="btn btn-secondary w-100 w-sm-auto mb-2">تحديث</button>
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

    <div class="modal fade" id="addnew" data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel">إضافة طريقة بيع جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add_form" action="{{route('portal.company.activity.description.sell.store')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
                            <div class="fw-bold h5 mb-2">طرق البيع</div>
                            <p>ادخل البيانات التالية لإضافة طريقة بيع للنشاط</p>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4 w-100">
                                    <?php $methods = array_column($data['CompanySellingMethods'], 'SELLING_METHOD_ID'); ?>
                                    <select class="select-floating-with-search" name="SELLING_METHOD_ID">
                                        <option></option>
                                        @foreach($constants['ActivitSellingMethods'] as $item)
                                            <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                        @endforeach
                                    </select>
                                    <label>طريقة البيع</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control float-only" name="METHOD_PERCENT" placeholder="نسبة البيع %" />
                                    <label>نسبة البيع %</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-secondary">
                            <div class="text"><i class="fa-solid fa-plus"></i> إضافة</div>
                            <div class="btn-loader d-none">
                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">جاري الإضافة</span>
                                </div>
                                <span>جاري الإضافة</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel">إضافة طريقة بيع جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit_form" action="{{route('portal.company.activity.description.sell.update')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
                            <div class="fw-bold h5 mb-2">طرق البيع</div>
                            <p>تعديل بيانات طريقة بيع للنشاط</p>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <input type="text" name="METHOD_ID" id="METHOD_ID" hidden>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <input type="text" name="SELLING_METHOD_ID" id="SELLING_METHOD_ID" hidden>
                                <div class="form-floating mb-4 w-100">
                                    <select class="select-floating-with-search" id="SELLING_METHOD_select" disabled>
                                        <option></option>
                                        @foreach($constants['ActivitSellingMethods'] as $item)
                                            <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                        @endforeach
                                    </select>
                                    <label>طريقة البيع</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control float-only" name="METHOD_PERCENT" id="METHOD_PERCENT" placeholder="نسبة البيع %" />
                                    <label>نسبة البيع %</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-secondary">
                            <div class="text"><i class="fa-solid fa-plus"></i> تعديل</div>
                            <div class="btn-loader d-none">
                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">جاري التعديل</span>
                                </div>
                                <span>جاري التعديل</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .form-floating > label{
            height: auto !important;
        }
    </style>
@endpush

@push('script')
    <script>

        $('#create_btn').on('click', function (e){
            errorHide($('#add_form'));
            $('#add_form').trigger('reset');
            $('#addnew').modal('show');
        });

        let list = {!!json_encode($data['CompanySellingMethods'])!!};

        $(document).ready(function() {
            $('#add_form').on('submit', function (e) {
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
                            // window.location.href = response.url;
                            $('#form_table').html(response.html);
                            $('#addnew').modal('hide');
                            form.find('select').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            list = response.data['CompanySellingMethods'];
                            form.trigger('reset');
                        } else {
                            errorShow(form, response.msg);
                        }
                        loaderEnd(form);
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

            $('#edit_form').on('submit', function (e) {
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
                            // window.location.href = response.url;
                            $('#form_table').html(response.html);
                            $('#editModal').modal('hide');
                            form.find('select').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            list = response.data['CompanySellingMethods'];
                            form.trigger('reset');
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

            $('#form_data').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                loaderStart(form)
                errorHide(form);
                if($('#form_table tr.tr-item').length == 0){
                    errorShow(form, 'يجب إدخال طريقة بيع واحدة على الأقل');
                    scrollToElem('#form_data', 30);
                    loaderEnd(form);
                    return false;
                }
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

        function editRecord(e){
            let btn = $(e);
            errorHide($('#edit_form'));
            let key = btn.data('key');
            let data = list[key];
            $('#METHOD_ID').val(data['METHOD_ID']);
            $('#SELLING_METHOD_ID').val(data['SELLING_METHOD_ID'])
            $('#SELLING_METHOD_select').siblings('.select2').addClass('full');
            $('#SELLING_METHOD_select').val(data['SELLING_METHOD_ID']).trigger('change');
            $('#METHOD_PERCENT').val(data['METHOD_PERCENT']);

            $('#editModal').modal('show');
        }

        function showValidationError(form, index, value){
            form.find("input[name='"+index+"']").addClass('border-danger');
            form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
            form.find("select[name='"+index+"']").addClass('border-danger');
            form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
            form.find("textarea[name='"+index+"']").addClass('border-danger');
            form.find("textarea[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
        }

        function deleteRecord(e){
            let btn = $(e);
            let id = btn.data('id');
            Swal.fire({
                title: '',
                text: '{{__('msg.are_you_sure_delete')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d49839',
                cancelButtonColor: '#cf2637',
                confirmButtonText: '{{__('msg.confirm_delete')}}',
                cancelButtonText: '{{__('msg.no_cancel')}}'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{route('portal.company.activity.description.sell.delete')}}',
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            if(data.status){
                                $('#item-'+id).remove();
                                $('#create_btn').removeClass('disabled');
                                Swal.fire('', data.msg, 'success', 2000);
                            }else{
                                Swal.fire('', data.msg, 'error', 2000);
                            }
                        },
                    });
                }
            });
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
    <script src="{{asset('assets')}}/js/forms/layouts.js"></script>

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
