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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.management.index')}}">الإدارة التنفيذية والمفوضون</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row gx-5">
            @include('portal.components.company_link_list')
            <div class="col-lg-8 col-xl-8 position-relative">
                <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                    <button type="button" id="create_btn" class="btn btn-secondary w-100 w-sm-auto mb-2 position-absolute top-m-30"><i class="fa-solid fa-plus"></i> إضافة عضو</button>
                </div>
                <!-- Details Start -->
                <h2 class="h4">بيانات الإدارة التنفيذية والمفوضون بالتوقيع</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped align-middle">
                                <thead>
                                <tr>
                                    <th scope="col">الاسم</th>
                                    <th scope="col" class="text-center">رقم الهوية</th>
                                    <th scope="col" class="text-center">المسمى الوظيفي</th>
                                    <th scope="col" class="text-center">مفوض بالتوقيع</th>
                                    <th scope="col" class="text-center">أدوات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($data) > 0)
                                    @foreach($data as $index=>$item)
                                        <tr id="item-{{$item['MEMBER_ID']}}">
                                            <th scope="row"><i class="fa-solid fa-user text-secondary"></i> {{$item['MEMBER_FULL_NAME']}}</th>
                                            <td class="text-center"><span class="text-secondary">{{$item['ID_NUM']}}</span></td>
                                            <td class="text-center"><span class="">{{$item['JOB_DESC']}}</span></td>
                                            <td class="text-center"><span class="{{$item['IS_SIGNER']==1?'text-success':'text-muted'}}"><i class="fa-solid fa-circle-check"></i></span></td>
                                            <td  class="text-center">
                                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2" data-key="{{$index}}" onclick="editRecord(this)" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_item" data-id="{{$item['MEMBER_ID']}}" onclick="deleteRecord(this)" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
                                    </tr>
                                @endif
                                <tr class="d-none">
                                    <td colspan="7" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mb-3 mt-5">
                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                <a href="{{route('portal.company.board.index')}}" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto  mb-2"><svg class="svg-inline--fa fa-chevron-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path></svg><!-- <i class="fa-solid fa-chevron-right"></i> Font Awesome fontawesome.com --></a>
                                <a href="{{route('portal.company.activity.description.index')}}" class="btn btn-secondary w-100 w-sm-auto  mb-2">التالي</a>
                            </div>
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
                    <h5 class="modal-title" id="addnewLabel">إضافة عضو جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add_form" action="{{route('portal.company.management.store')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
                            <div class="sh-3 sh-md-5 fw-bold lh-1-25 h5"><i class="fa-solid fa-user-tie ms-2"></i> الإدارة التنفيذية والمفوضون بالتوقيع</div>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="MEMBER_FULL_NAME" placeholder="اسم العضو" />
                                    <label>اسم العضو</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="ID_NUM" placeholder="رقم الهوية" />
                                    <label>رقم الهوية</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <div class="form-floating w-100">
                                    <select class="select-floating-with-search" name="JOB_ID">
                                        <option></option>
                                        @foreach($constants['Jobs'] as $item)
                                            <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                        @endforeach
                                    </select>
                                    <label>المسمى الوظيفي</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4">
                                <div class="form-floating w-100">
                                    <select class="select-floating-with-search" name="EDUCATION_LEVEL_ID">
                                        <option></option>
                                        @foreach($constants['EducationLevels'] as $item)
                                            <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                        @endforeach
                                    </select>
                                    <label>المؤهل العلمي</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control number-only" name="EXPERIENCE_YEARS_CNT" placeholder="سنوات الخبرة" />
                                    <label>سنوات الخبرة</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row mb-4">
                                    <label class="col-12 col-form-label pt-4 pt-md-0">مفوض بالتوقيع</label>
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="IS_SIGNER" id="IS_SIGNER_1_add" value="1">
                                            <label class="form-check-label" for="IS_SIGNER_1_add">نعم</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="IS_SIGNER" checked id="IS_SIGNER_0_add" value="0">
                                            <label class="form-check-label" for="IS_SIGNER_0_add">لا</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="CURRENT_EXPERIENCE_NOTES" placeholder="تفاصيل الخبرة للعمل الحالي" rows="5" maxlength="{{textMaxSize()}}"></textarea>
                            <label>تفاصيل خبرة العمل</label>
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
                    <h5 class="modal-title" id="addnewLabel">تعديل بيانات العضو</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit_form" action="{{route('portal.company.management.update')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
                            <div class="sh-3 sh-md-5 fw-bold lh-1-25 h5"><i class="fa-solid fa-user-tie ms-2"></i> الإدارة التنفيذية والمفوضون بالتوقيع</div>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <div class="row">
                            <input type="text" name="MEMBER_ID" id="MEMBER_ID" hidden>
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="MEMBER_FULL_NAME" id="MEMBER_FULL_NAME" placeholder="اسم العضو" />
                                    <label>اسم العضو</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="ID_NUM" id="ID_NUM" placeholder="رقم الهوية" />
                                    <label>رقم الهوية</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <div class="form-floating w-100">
                                    <select class="select-floating-with-search" name="JOB_ID" id="JOB_ID">
                                        <option></option>
                                        @foreach($constants['Jobs'] as $item)
                                            <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                        @endforeach
                                    </select>
                                    <label>المسمى الوظيفي</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4">
                                <div class="form-floating w-100">
                                    <select class="select-floating-with-search" name="EDUCATION_LEVEL_ID" id="EDUCATION_LEVEL_ID">
                                        <option></option>
                                        @foreach($constants['EducationLevels'] as $item)
                                            <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                        @endforeach
                                    </select>
                                    <label>المؤهل العلمي</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control number-only" name="EXPERIENCE_YEARS_CNT" id="EXPERIENCE_YEARS_CNT" placeholder="سنوات الخبرة" />
                                    <label>سنوات خبرة</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row mb-4">
                                    <label class="col-12 col-form-label pt-4 pt-md-0">مفوض بالتوقيع</label>
                                    <div class="col-12">
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input" type="radio" name="IS_SIGNER" checked id="IS_SIGNER_1" value="1">
                                            <label class="form-check-label" for="IS_SIGNER_1">نعم</label>
                                        </div>
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input" type="radio" name="IS_SIGNER" id="IS_SIGNER_0" value="0">
                                            <label class="form-check-label" for="IS_SIGNER_0">لا</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="CURRENT_EXPERIENCE_NOTES" id="CURRENT_EXPERIENCE_NOTES" placeholder="تفاصيل الخبرة للعمل الحالي" rows="5" maxlength="{{textMaxSize()}}"></textarea>
                            <label>تفاصيل الخبرة العمل</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-secondary">
                            <div class="text"><i class="fa-solid fa-plus"></i> تعديل</div>
                            <div class="btn-loader d-none">
                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">جاري تعديل</span>
                                </div>
                                <span>جاري تعديل</span>
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
        $(document).ready(function() {
            $('#create_btn').on('click', function (e){
                errorHide($('#add_form'));
                $('#add_form').trigger('reset');
                $('#addnew').modal('show');
            });

            $('#addnew input[name="ID_NUM"]').on('change', function (e) {
                let value = $(this).val();
                if(value){
                    let form = $('#addnew #add_form');
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "POST",
                        url: '{{route('portal.company.management.search')}}',
                        data: {
                            'ID_NUM': value,
                        },
                        success: function (response) {
                            if (response.status && response.data) {
                                form.find('[name="MEMBER_FULL_NAME"]').val(response.data['PARTNER_FULL_NAME']);
                                form.find('[name="EDUCATION_LEVEL_ID"]').siblings('.select2').addClass('full');
                                form.find('[name="EDUCATION_LEVEL_ID"]').val(response.data['EDUCATION_LEVEL_ID']).trigger('change');
                                form.find('[name="EXPERIENCE_YEARS_CNT"]').val(response.data['EXPERIENCE_YEARS_CNT']);
                                form.find('[name="CURRENT_EXPERIENCE_NOTES"]').val(response.data['CURRENT_EXPERIENCE_NOTES']);
                            }
                        },
                    })
                }
            });

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
                            window.location.href = response.url;
                        } else {
                            errorShow(form, response.msg);
                        }
                        loaderEnd(form)
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            // showValidationError(form, index, value)
                            form.find("input[name='"+index+"']").addClass('border-danger');
                            form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                            form.find("select[name='"+index+"']").addClass('border-danger');
                            form.find("select[name='"+index+"']").parent().parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                            form.find("textarea[name='"+index+"']").addClass('border-danger');
                            form.find("textarea[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
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
                            window.location.href = response.url;
                        } else {
                            errorShow(form, response.msg);
                        }
                        loaderEnd(form)
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            // showValidationError(form, index, value)
                            form.find("input[name='"+index+"']").addClass('border-danger');
                            form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                            form.find("select[name='"+index+"']").addClass('border-danger');
                            form.find("select[name='"+index+"']").parent().parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                            form.find("textarea[name='"+index+"']").addClass('border-danger');
                            form.find("textarea[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
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
            let data = {!!json_encode($data)!!}[key];
            $('#MEMBER_ID').val(data['MEMBER_ID']);
            $('#MEMBER_FULL_NAME').val(data['MEMBER_FULL_NAME']);
            $('#ID_NUM').val(data['ID_NUM']);
            $('#JOB_ID').siblings('.select2').addClass('full');
            $('#JOB_ID').val(data['JOB_ID']).trigger('change');
            $('#EDUCATION_LEVEL_ID').siblings('.select2').addClass('full');
            $('#EDUCATION_LEVEL_ID').val(data['EDUCATION_LEVEL_ID']).trigger('change');
            $('#EXPERIENCE_YEARS_CNT').val(data['EXPERIENCE_YEARS_CNT']);
            $('#IS_SIGNER_'+data['IS_SIGNER']).attr('checked', 'checked');
            $('#CURRENT_EXPERIENCE_NOTES').val(data['CURRENT_EXPERIENCE_NOTES']);
            $('#editModal').modal('show');
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
                        url: '{{route('portal.company.management.delete')}}',
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            if(data.status){
                                $('#item-'+id).remove();
                                if($('table tbody tr').length == 1){
                                    $('tr.d-none').removeClass('d-none');
                                }
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
