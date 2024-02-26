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

            <div class="col-lg-8 col-xl-8 position-relative">

                <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                    <button  type="button" id="create_policy_btn" class="btn btn-secondary w-100 w-sm-auto mb-2 position-absolute top-m-30"><i class="fa-solid fa-plus"></i> إضافة سياسة شراء</button>
                </div>
                <!-- Details Start -->
                <h2 class="h4">تفاصيل تحليل سياسة الشراء</h2>
                <div class="row mb-5">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-responsive">

                                        <table class="table table-striped align-middle">
                                            <thead>
                                            <tr>
                                                <th scope="col">السياسة</th>
                                                <th scope="col"  class="text-center">نسبة الشراء</th>
                                                <th scope="col"  class="text-center">مدة الآجل / الأيام</th>
                                                <th scope="col"  class="text-center">ملاحظات</th>
                                                <th scope="col" class="text-center">أدوات</th>
                                            </tr>
                                            </thead>
                                            <tbody id="policy_records">
                                            @include('portal.company.activity.buying.policy')
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
                                                    <td class="text-center">
                                                        <a role="button" class="{{$item['CLIENT_SUPPLIER_NOTES']?'text-secondary':'text-muted'}}" @if($item['CLIENT_SUPPLIER_NOTES'])data-bs-toggle="modal" data-bs-target="#row_notes_{{$item['CLIENT_SUPPLIER_ID']}}"@endif><i class="fa-solid fa-circle-info"></i></a>
                                                        @if($item['CLIENT_SUPPLIER_NOTES'])
                                                            <div class="modal fade" id="row_notes_{{$item['CLIENT_SUPPLIER_ID']}}" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered ">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="row_notesLabel">توضيحات أخرى</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body wizard" id="wizardBasic">
                                                                            <p>{{$item['CLIENT_SUPPLIER_NOTES']}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
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
                    <div class="col-lg-12 col-xl-12 mt-5 position-relative">
                        <div class="row mt-2 mb-3">
                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                <a href="{{route('portal.company.activity.selling.index')}}" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto  mb-2"><svg class="svg-inline--fa fa-chevron-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path></svg><!-- <i class="fa-solid fa-chevron-right"></i> Font Awesome fontawesome.com --></a>
                                <a href="{{route('portal.company.activity.competitors.index')}}" class="btn btn-secondary w-100 w-sm-auto  mb-2">التالي</a>
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
                            <textarea class="form-control" name="CLIENT_SUPPLIER_NOTES" placeholder="توضيحات أخرى" rows="5" maxlength="{{textMaxSize2()}}"></textarea>
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
                            <textarea class="form-control" name="CLIENT_SUPPLIER_NOTES" id="CLIENT_SUPPLIER_NOTES" placeholder="توضيحات أخرى" rows="5" maxlength="{{textMaxSize2()}}"></textarea>
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

    <div class="modal fade" id="addnew_v2"  data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel">إضافة سياسة شراء جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add_policy" action="{{route('portal.company.activity.buying.policy.store')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
                            <div class="fw-bold h5 mb-2">تفاصيل سياسة شراء</div>
                            <p>ادخل البيانات التالية لإضافة سياسة شراء جديدة</p>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4 w-100">
                                    <select class="select-floating-with-search" name="BUY_SELL_SUB_FLAG">
                                        <option></option>
                                        @foreach($constants['BuySellPolicySubtype'] as $item)
                                            <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                        @endforeach
                                    </select>
                                    <label>السياسة</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control float-only" name="COMMERCE_POLICY_PERCENT" placeholder="نسبة البيع %" value="" />
                                    <label>نسبة الشراء %</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="COMMERCE_POLICY_PERIOD" placeholder="مدة الآجل / الأيام" value="" />
                                    <label>مدة الآجل / الأيام</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="NOTES" placeholder="توضيحات اخرى" rows="5" maxlength="{{textMaxSize2()}}"></textarea>
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

    <div class="modal fade" id="editModal_v2"  data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel">إضافة سياسة شراء</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit_policy" action="{{route('portal.company.activity.buying.policy.update')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
                            <div class="fw-bold h5 mb-2">تفاصيل سياسة الشراء</div>
                            <p>ادخل البيانات التالية لتعديل سياسة الشراء</p>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <input type="text" name="BUY_SELL_ID" id="BUY_SELL_ID" hidden>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4 w-100">
                                    <select class="select-floating-with-search" name="BUY_SELL_SUB_FLAG" id="BUY_SELL_SUB_FLAG">
                                        <option></option>
                                        @foreach($constants['BuySellPolicySubtype'] as $item)
                                            <option value="{{$item['CONSTANT_ID']}}">{{$item['CONSTANT_DESC']}}</option>
                                        @endforeach
                                    </select>
                                    <label>السياسة</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control float-only" name="COMMERCE_POLICY_PERCENT" id="COMMERCE_POLICY_PERCENT" placeholder="نسبة البيع %" value="" />
                                    <label>نسبة الشراء %</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="COMMERCE_POLICY_PERIOD" id="COMMERCE_POLICY_PERIOD" placeholder="مدة الآجل / الأيام" value="" />
                                    <label>مدة الآجل / الأيام</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="NOTES" id="NOTES" placeholder="توضيحات أخرى" rows="5" maxlength="{{textMaxSize2()}}"></textarea>
                            <label>توضيحات أخرى</label>
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
        let policyData = {!!json_encode($policy)!!};
        $(document).ready(function() {
            $('#create_btn').on('click', function (e){
                errorHide($('#add_form'));
                $('#add_form').trigger('reset');
                $('#addnew').modal('show');
            });

            $('#create_policy_btn').on('click', function (e){
                let form = $('#add_policy');
                errorHide(form);
                form.trigger('reset');
                form.find('select').val(null).trigger('change');
                form.find('.select2.full').removeClass('full');
                $('#addnew_v2').modal('show');
            });

            $('select[name="BUY_SELL_SUB_FLAG"]').on('change',function (e){
                let val = $(this).val();
                if(val == 1){
                    $('input[name="COMMERCE_POLICY_PERIOD"]').prop('readonly', true);
                    $('input[name="COMMERCE_POLICY_PERIOD"]').val(0);
                }else{
                    $('input[name="COMMERCE_POLICY_PERIOD"]').prop('readonly', false);
                    $('input[name="COMMERCE_POLICY_PERIOD"]').val('');
                }
            });

            $('#add_policy').on('submit', function (e) {
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
                            policyData = response.policy;
                            $('#policy_records').html(response.html);
                            form.trigger('reset');
                            form.find('select').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            $('#addnew_v2').modal('hide');
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

            $('#edit_policy').on('submit', function (e) {
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
                            policyData = response.policy;
                            $('#policy_records').html(response.html);
                            form.trigger('reset');
                            form.find('select').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            $('#editModal_v2').modal('hide');
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

        function editPolicyRecord(e){
            let btn = $(e);
            errorHide($('#edit_policy'));
            let key = btn.data('key');
            let data = policyData[key];
            $('#edit_policy #BUY_SELL_ID').val(data['BUY_SELL_ID']);
            $('#edit_policy #BUY_SELL_SUB_FLAG').siblings('.select2').addClass('full');
            $('#edit_policy #BUY_SELL_SUB_FLAG').val(data['BUY_SELL_SUB_FLAG']).trigger('change');
            $('#edit_policy #COMMERCE_POLICY_PERCENT').val(data['COMMERCE_POLICY_PERCENT']);
            $('#edit_policy #COMMERCE_POLICY_PERIOD').val(data['COMMERCE_POLICY_PERIOD']);
            $('#edit_policy #NOTES').val(data['NOTES']);
            $('#editModal_v2').modal('show');
        }

        function deletePolicyRecord(e){
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
                        url: '{{route('portal.company.activity.buying.policy.delete')}}',
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            if(data.status){
                                $('#policy-'+id).remove();
                                if($('#policy_records tr').length == 1){
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
