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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.activity.buying.index')}}">تفاصيل سياسة الشراء</a></li>
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
                <h2 class="h4">تفاصيل تحليل سياسة الشراء</h2>

                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <a href="{{route('portal.company.activity.buying.edit')}}" class="text-nowrap"><svg class="svg-inline--fa fa-pen-to-square" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-to-square" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"></path></svg><!-- <i class="fa-solid fa-pen-to-square"></i> Font Awesome fontawesome.com --> تعديل البيانات</a>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="row g-0 mb-4">
                                    <div class="col-12">
                                        <div class="fw-bold h5">سياسة الشراء النقدي</div>
                                    </div>
                                </div>
                                <div class="row g-0 bg-light px-3 rounded-lg mb-2 py-2">
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">نسبة الشراء</div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{count($policy)>0?$policy[0]['BUY_SELL_PERCENT'].'%':'-'}}</div>
                                    </div>
                                </div>
                                <div class="row g-0 bg-light px-3 rounded-lg mb-2 py-2">
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">مدة الآجال / الأيام </div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{count($policy)>0?$policy[0]['BUY_SELL_PERIOD'].' يوم':'-'}}</div>
                                    </div>
                                </div>
                                <div class="row g-0 bg-light px-3 rounded-lg mb-2 py-2">
                                    <div class="col-12">
                                        <div class="d-flex fw-bold align-items-center fw-normal my-3">ملاحظات أخرى</div>
                                    </div>
                                    <div class="col-12">
                                        <p class="lh-lg custom-scroll scroll-200px">{{count($policy)>0?$policy[0]['BUY_SELL_NOTES']:''}}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="row g-0 mb-4">
                                    <div class="col-12">
                                        <div class="fw-bold h5">سياسة الشراء الآجل</div>
                                    </div>
                                </div>
                                <div class="row g-0  bg-light px-3 rounded-lg mb-2 py-2">
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">نسبة الشراء</div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{count($policy)>0?$policy[0]['BUY_SELL_POSTPONED_PERCENT'].'%':'-'}}</div>
                                    </div>
                                </div>
                                <div class="row g-0  bg-light px-3 rounded-lg mb-2 py-2">
                                    <div class="col-12 col-md">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">مدة الآجال / الأيام </div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{count($policy)>0?$policy[0]['BUY_SELL_POSTPONED_PERIOD'].' يوم':'-'}}</div>
                                    </div>
                                </div>
                                <div class="row g-0  bg-light px-3 rounded-lg mb-2 py-2">
                                    <div class="col-12">
                                        <div class="d-flex fw-bold align-items-center fw-normal my-3">ملاحظات أخرى</div>
                                    </div>
                                    <div class="col-12">
                                        <p class="lh-lg lh-lg custom-scroll scroll-200px">{{count($policy)>0?$policy[0]['BUY_SELL_POSTPONED_NOTES']:''}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-3">
                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                <a href="{{route('portal.company.activity.selling.index')}}" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto  mb-2"><svg class="svg-inline--fa fa-chevron-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path></svg><!-- <i class="fa-solid fa-chevron-right"></i> Font Awesome fontawesome.com --></a>
                                <a href="{{route('portal.company.activity.competitors.index')}}" class="btn btn-secondary w-100 w-sm-auto  mb-2">التالي</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-xl-12 mt-5 position-relative">
                        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                            <button type="button" id="create_btn" class="btn btn-secondary w-100 w-sm-auto mb-2 position-absolute top-m-30"><i class="fa-solid fa-plus"></i> إضافة مورد</button>
                        </div>
                        <!-- Details Start -->
                        <h2 class="h4 mb-3">أكبر خمسة موردين</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col">اسم المورد</th>
                                            <th scope="col" class="text-center">نسبة الشراء</th>
                                            <th scope="col" class="text-center">مصدر التوريد</th>
                                            <th scope="col" class="text-center">توضيحات أخرى</th>
                                            <th scope="col" class="text-center">أدوات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($data) > 0)
                                            @foreach($data as $index=>$item)
                                                <tr id="item-{{$item['CLIENT_SUPPLIER_ID']}}">
                                                    <th scope="row"><i class="fa-solid fa-user text-secondary"></i> {{$item['CLIENT_SUPPLIER_NAME']}}</th>
                                                    <td class="text-center"><span class="text-secondary">{{$item['BUY_SELL_PERCENT']}}%</span></td>
                                                    <td class="text-center"><span class="">{{$item['BUY_PLACE']}}</span></td>
                                                    <td class="text-center"><span class="{{$item['CLIENT_SUPPLIER_NOTES']?'text-secondary':'text-muted'}}"><i class="fa-solid fa-circle-info"></i></span></td>
                                                    <td  class="text-center">
                                                        <button class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2" data-key="{{$index}}" onclick="editRecord(this)" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_item" data-id="{{$item['CLIENT_SUPPLIER_ID']}}" onclick="deleteRecord(this)" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                                            <i class="fa-solid fa-circle-xmark"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
                                            </tr>
                                        @endif
                                        <tr class="d-none">
                                            <td colspan="5" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Details End -->
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
                    <h5 class="modal-title" id="addnewLabel">إضافة مورد جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add_form" action="{{route('portal.company.activity.buying.store')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
                            <div class="fw-bold h5 mb-2">تفاصيل سياسة الشراء</div>
                            <p>ادخل البيانات التالية لإضافة مورد</p>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="CLIENT_SUPPLIER_NAME" placeholder="اسم المورد" />
                                    <label>اسم المورد</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control float-only" name="BUY_SELL_PERCENT" placeholder="نسبة الشراء %" />
                                    <label>نسبة الشراء %</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4 w-100">
                                    <input type="text" class="form-control" name="BUY_PLACE" placeholder="مصدر التوريد" />
                                    <label>مصدر التوريد</label>
                                </div>
                            </div>

                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="CLIENT_SUPPLIER_NOTES" placeholder="توضيحات أخرى" rows="5"></textarea>
                            <label>توضيحات أخرى</label>
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
                    <h5 class="modal-title" id="addnewLabel">تعديل بيانات مورد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit_form" action="{{route('portal.company.activity.buying.update')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
                            <div class="fw-bold h5 mb-2">تفاصيل سياسة الشراء</div>
                            <p>ادخل البيانات الجديدة لتعديل بيانات المورد</p>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <input type="text" name="CLIENT_SUPPLIER_ID" id="CLIENT_SUPPLIER_ID" hidden>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="CLIENT_SUPPLIER_NAME" id="CLIENT_SUPPLIER_NAME" placeholder="اسم المورد" />
                                    <label>اسم المورد</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control float-only" name="BUY_SELL_PERCENT" id="BUY_SELL_PERCENT" placeholder="نسبة الشراء %" />
                                    <label>نسبة الشراء %</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4 w-100">
                                    <input type="text" class="form-control" name="BUY_PLACE" id="BUY_PLACE" placeholder="مصدر التوريد" />
                                    <label>مصدر التوريد</label>
                                </div>
                            </div>

                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="CLIENT_SUPPLIER_NOTES" id="CLIENT_SUPPLIER_NOTES" placeholder="توضيحات أخرى" rows="5"></textarea>
                            <label>توضيحات اخرى</label>
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
        $(document).ready(function() {
            $('#create_btn').on('click', function (e){
                errorHide($('#add_form'));
                $('#add_form').trigger('reset');
                $('#addnew').modal('show');
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
            $('#CLIENT_SUPPLIER_ID').val(data['CLIENT_SUPPLIER_ID']);
            $('#CLIENT_SUPPLIER_NAME').val(data['CLIENT_SUPPLIER_NAME']);
            $('#BUY_SELL_PERCENT').val(data['BUY_SELL_PERCENT']);
            $('#BUY_PLACE').val(data['BUY_PLACE']);
            $('#CLIENT_SUPPLIER_NOTES').val(data['CLIENT_SUPPLIER_NOTES']);
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
                        url: '{{route('portal.company.activity.buying.delete')}}',
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
