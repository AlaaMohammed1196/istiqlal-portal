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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.board.index')}}">بيانات أعضاء مجلس الإدارة</a></li>
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
                    <button type="button" id="create_btn" {{$hasMembers==0?'disabled':''}} class="btn btn-secondary w-100 w-sm-auto mb-2 position-absolute top-m-30"><i class="fa-solid fa-plus"></i> إضافة عضو</button>
                </div>
                <!-- Details Start -->
                <h2 class="h4">بيانات أعضاء مجلس الإدارة</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="form-check form-check-inline mb-3">
                            <input class="form-check-input" type="checkbox" {{$hasMembers==0?'checked':''}} name="HAS_BOARD_MEMBERS_FLAG" id="HAS_BOARD_MEMBERS_FLAG" value="1">
                            <label class="form-check-label" for="HAS_BOARD_MEMBERS_FLAG">
                                <div class="text">لا يوجد مجلس إدارة</div>
                               <div class="sending d-none">
                                   <i class="fa-solid fa-circle-notch fa-spin text-secondary ms-1"></i> جارى الإرسال
                               </div>
                            </label>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                <tr>
                                    <th scope="col">الإسم</th>
                                    <th scope="col"  class="text-center">عضو شريك</th>
                                    <th scope="col"  class="text-center">الجهة الممثلة</th>
                                    <th scope="col"  class="text-center">مفوض بالتوقيع</th>
                                    <th scope="col"  class="text-center">رئيس مجلس الإدارة</th>
                                    <th scope="col" class="text-center">أدوات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($data) > 0)
                                    @foreach($data as $index=>$item)
                                        <tr id="item-{{$item['MEMBER_ID']}}">
                                            <th scope="row"><i class="fa-solid fa-user text-secondary"></i>{{$item['MEMBER_FULL_NAME']}}</th>
                                            <td class="text-center"><span class="{{$item['IS_PARTNER']==1?'text-success':'text-muted'}}"><i class="fa-solid fa-circle-check"></i></span></td>
                                            <td class="text-center"><span class="">{{$item['REPERSENTATIVE_NAME']}}</span></td>
                                            <td class="text-center"><span class="{{$item['IS_SIGNER']==1?'text-success':'text-muted'}}"><i class="fa-solid fa-circle-check"></i></span></td>
                                            <td class="text-center"><span class="{{$item['IS_CHAIRMAN_BOARD_DIRECTORS']==1?'text-success':'text-muted'}}"><i class="fa-solid fa-circle-check"></i></span></td>
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
                                <a href="{{route('portal.company.partner.index')}}" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto  mb-2"><svg class="svg-inline--fa fa-chevron-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path></svg><!-- <i class="fa-solid fa-chevron-right"></i> Font Awesome fontawesome.com --></a>
                                <a href="{{route('portal.company.management.index')}}" class="btn btn-secondary w-100 w-sm-auto  mb-2">التالي</a>
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
                <form id="add_form" action="{{route('portal.company.board.store')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
                            <div class="sh-3 sh-md-5 fw-bold lh-1-25 h5"><i class="fa-solid fa-users ms-2"></i> أعضاء مجلس الإدارة</div>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="MEMBER_FULL_NAME" id="MEMBER_FULL_NAME" placeholder="الاسم" />
                            <label>الاسم</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="REPERSENTATIVE_NAME" id="REPERSENTATIVE_NAME" placeholder="الجهة الممثلة" />
                            <label>الجهة الممثلة</label>
                        </div>
                        <div class="row mb-4">
                            <label class="col-12 col-md-4 col-form-label pt-4 pt-md-0">شريك</label>
                            <div class="col-12 col-md-8">
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="IS_PARTNER" id="IS_PARTNER" value="1">
                                    <label class="form-check-label" for="IS_PARTNER">نعم</label>
                                </div>
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="IS_PARTNER" checked id="IS_PARTNER" value="0">
                                    <label class="form-check-label" for="IS_PARTNER">لا</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-12 col-md-4 col-form-label pt-4 pt-md-0">مفوض بالتوقيع</label>
                            <div class="col-12 col-md-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="IS_SIGNER" id="IS_SIGNER_1" value="1">
                                    <label class="form-check-label" for="IS_SIGNER_1">نعم</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="IS_SIGNER" checked id="IS_SIGNER_0" value="0">
                                    <label class="form-check-label" for="IS_SIGNER_0">لا</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-12 col-md-4 col-form-label pt-4 pt-md-0">رئيس مجلس الإدارة</label>
                            <div class="col-12 col-md-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="IS_CHAIRMAN_BOARD_DIRECTORS" id="IS_CHAIRMAN_BOARD_DIRECTORS_1" value="1">
                                    <label class="form-check-label" for="IS_CHAIRMAN_BOARD_DIRECTORS_1">نعم</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="IS_CHAIRMAN_BOARD_DIRECTORS" checked id="IS_CHAIRMAN_BOARD_DIRECTORS_0" value="0">
                                    <label class="form-check-label" for="IS_CHAIRMAN_BOARD_DIRECTORS_0">لا</label>
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
                    <h5 class="modal-title" id="addnewLabel">تعديل بيانات العضو</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit_form" action="{{route('portal.company.board.update')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
                            <div class="sh-3 sh-md-5 fw-bold lh-1-25 h5"><i class="fa-solid fa-users ms-2"></i> أعضاء مجلس الإدارة</div>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <input type="text" name="MEMBER_ID" id="MEMBER_ID" hidden>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="MEMBER_FULL_NAME" id="name" placeholder="الاسم" />
                            <label>الاسم</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="REPERSENTATIVE_NAME" id="rep_name" placeholder="الجهة الممثلة" />
                            <label>الجهة الممثلة</label>
                        </div>
                        <div class="row mb-4">
                            <label class="col-12 col-md-4 col-form-label pt-4 pt-md-0">شريك</label>
                            <div class="col-12 col-md-8">
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="IS_PARTNER" checked id="partner_1" value="1">
                                    <label class="form-check-label" for="IS_PARTNER">نعم</label>
                                </div>
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="IS_PARTNER" id="partner_0" value="0">
                                    <label class="form-check-label" for="IS_PARTNER">لا</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-12 col-md-4 col-form-label pt-4 pt-md-0">مفوض بالتوقيع</label>
                            <div class="col-12 col-md-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="IS_SIGNER" checked id="signer_1" value="1">
                                    <label class="form-check-label" for="IS_SIGNER_1">نعم</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="IS_SIGNER" id="signer_0" value="0">
                                    <label class="form-check-label" for="IS_SIGNER_0">لا</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-12 col-md-4 col-form-label pt-4 pt-md-0">رئيس مجلس الإدارة</label>
                            <div class="col-12 col-md-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="IS_CHAIRMAN_BOARD_DIRECTORS" id="IS_CHAIRMAN_BOARD_DIRECTORS_1" value="1">
                                    <label class="form-check-label" for="IS_CHAIRMAN_BOARD_DIRECTORS_1">نعم</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="IS_CHAIRMAN_BOARD_DIRECTORS" id="IS_CHAIRMAN_BOARD_DIRECTORS_0" value="0">
                                    <label class="form-check-label" for="IS_CHAIRMAN_BOARD_DIRECTORS_0">لا</label>
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

            $('#HAS_BOARD_MEMBERS_FLAG').on('change', function (e){
                let check = $(this);
                check.prop('disabled', true);
                check.siblings('label').find('.text').addClass('d-none');
                check.siblings('label').find('.sending').removeClass('d-none');
                let value = 1;
                if(check.is(':checked')){
                    value = 0;
                }
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.company.board.no-member')}}',
                    data: {
                        'HAS_BOARD_MEMBERS_FLAG': value,
                    },
                    success: function (response) {
                        if (response.status) {
                            window.location.href = response.url;
                        } else {
                            toastr.error(response.msg);
                        }
                        check.prop('disabled', false);
                        check.siblings('label').find('.text').removeClass('d-none');
                        check.siblings('label').find('.sending').addClass('d-none');
                    },
                })
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
            let data = {!!json_encode($data)!!}[key];
            let form = $('#edit_form');
            $('#MEMBER_ID').val(data['MEMBER_ID']);
            $('#name').val(data['MEMBER_FULL_NAME']);
            $('#rep_name').val(data['REPERSENTATIVE_NAME']);
            form.find('#partner_'+data['IS_PARTNER']).attr('checked', 'checked');
            form.find('#signer_'+data['IS_SIGNER']).attr('checked', 'checked');
            form.find('#IS_CHAIRMAN_BOARD_DIRECTORS_'+data['IS_CHAIRMAN_BOARD_DIRECTORS']).attr('checked', 'checked');
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
                        url: '{{route('portal.company.board.delete')}}',
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
