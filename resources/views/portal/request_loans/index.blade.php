@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">طلب قرض</h1>

                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.loan-request.index')}}">طلب قرض</a></li>
                            <li class="breadcrumb-item">طلب</li>
                        </ul>
                    </nav>

                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row gx-5">
            <div class="col-md-auto mb-5 d-none d-lg-block col-lg-4 company-data" id="scrollSpyMenu_v2">
                <!-- Index Start -->
                <h2 class="h4">قائمة طلب القرض</h2>
                @include('portal.request_loans.components.list')
            </div>
            <div class="col-lg-8 col-xl-8">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-datainfo" role="tabpanel" aria-labelledby="pills-datainfo-tab" tabindex="0">
                        <!-- Details Start -->
                        <h2 class="h4">البيانات العامة</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-0 align-items-start mb-2">
                                    @include('portal.request_loans.components.main_info')
                                </div>
                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                    <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab" tabindex="0">
                        <!-- Details Start -->
                        <h2 class="h4">مصادر السداد</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-0 align-items-start mb-2">
                                    <form>
                                        <div class="col-12 d-flex justify-content-between mb-3">
                                            <div class=" fw-bold h5">مصادر التمويل لمساهمة العميل</div>
                                            <button class="btn btn-secondary " type="button" data-bs-toggle="modal" data-bs-target="#addnew">
                                                <i class="fa-solid fa-plus"></i> إضافة مصدر
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table align-middle">
                                                <thead>
                                                <tr>
                                                    <th scope="col">المصدر</th>
                                                    <th scope="col" class="text-center">القيمة</th>
                                                    <th scope="col" class="text-center">العملة</th>
                                                    <th scope="col" class="text-center">أدوات</th>
                                                </tr>
                                                </thead>
                                                <tbody id="fund_source_table">
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between mb-3 mt-5">
                                            <div class=" fw-bold h5">وصف مصادر السداد <span class="text-secondary fw-normal">(حسب الأهمية)</span></div>
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#addnew2">
                                                <i class="fa-solid fa-plus"></i> إضافة مصدر
                                            </button>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table align-middle">
                                                <thead>
                                                <tr>
                                                    <th scope="col">مصدر السداد</th>
                                                    <th scope="col" class="text-center">القيمة</th>
                                                    <th scope="col" class="text-center">العملة</th>
                                                    <th scope="col" class="text-center">أدوات</th>
                                                </tr>
                                                </thead>
                                                <tbody id="fund_desc_table">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-3 row mt-5">
                                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                                <button type="button" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto mb-2 btnPrev"><i class="fa-solid fa-chevron-right"></i></button>
                                                <button type="button" class="btn btn-secondary w-100 w-sm-auto mb-2 btnNext">التالي</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                    <div class="tab-pane fade" id="pills-warranties" role="tabpanel" aria-labelledby="pills-warranties-tab" tabindex="0">
                        <!-- Details Start -->
                        <h2 class="h4">الضمانات</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-0 align-items-start mb-2">
                                    <form>
                                        <div class="col-12 d-flex justify-content-between mb-3">
                                            <div class=" fw-bold h5">الضمانات التي يمكنك تقديمها</div>
                                            <button class="btn btn-secondary " type="button" data-bs-toggle="modal" data-bs-target="#addnew3">
                                                <i class="fa-solid fa-plus"></i> إضافة ضمان
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table align-middle">
                                                <thead>
                                                <tr>
                                                    <th scope="col">الضمانة</th>
                                                    <th scope="col" class="text-center">القيمة التقديرية</th>
                                                    <th scope="col" class="text-center">العملة</th>
                                                    <th scope="col"  class="text-center">وصف الضمان</th>
                                                    <th scope="col" class="text-center">أدوات</th>
                                                </tr>
                                                </thead>
                                                <tbody id="warranty_table">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-12 d-flex justify-content-between mb-3 mt-5">
                                            <div class=" fw-bold h5">الكفالات</div>
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#addnew4">
                                                <i class="fa-solid fa-plus"></i> إضافة كفالة
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table align-middle">
                                                <thead>
                                                <tr>
                                                    <th scope="col">الكفالة</th>
                                                    <th scope="col" class="text-center">القيمة</th>
                                                    <th scope="col" class="text-center">العملة</th>
                                                    <th scope="col" class="text-center">وصف الكفالة</th>
                                                    <th scope="col" class="text-center">أدوات</th>
                                                </tr>
                                                </thead>
                                                <tbody id="guarantee_table">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-3 row mt-5">
                                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                                <button type="button" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto mb-2 btnPrev"><i class="fa-solid fa-chevron-right"></i></button>
                                                <button type="button" class="btn btn-secondary w-100 w-sm-auto mb-2 btnNext">التالي</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                    <div class="tab-pane fade" id="pills-balance" role="tabpanel" aria-labelledby="pills-balance-tab" tabindex="0">
                        <!-- Details Start -->
                        <h2 class="h4">المعلومات المالية | الميزانية العمومية</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-0 align-items-start mb-2">
                                    <form id="finance_info_form">
                                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                                        <input type="text" name="FUND_ID" value="" hidden>
                                        <input type="text" name="is_send" value="0" hidden>
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="form-floating mb-4 w-100">
                                                    <input type="text" class="form-control" name="AUDITED_ENTITY_NAME" placeholder="الجهة المدققة " />
                                                    <label>الجهة المدققة </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-floating mb-4 w-100">
                                                    <select class="select-floating-with-search" name="FINANCE_INFO_CURR_ID">
                                                        <option></option>
                                                        @foreach($constants['CURRENCIES'] as $item)
                                                            <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>العملة </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-floating mb-4">
                                                    <input type="text" class="date-picker-close form-control" name="FINANCE_INFO_PREPARED_ON" id="FINANCE_INFO_PREPARED_ON" placeholder="تاريخ إعدادها" />
                                                    <label>تاريخ إعدادها</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-floating mb-4">
                                                    <input type="text" class="datePickerYear form-control" name="FISCAL_YEAR" id="FISCAL_YEAR" placeholder="السنة المالية" />
                                                    <label>السنة المالية</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="balance_table">
                                        @include('portal.request_loans.components.financial_info')
                                    </div>
                                    <div class="mb-3 row mt-3">
                                        <div class="alert-info p-3 rounded-3 mb-5">في حال عدم وجود قيم لأحد الحقول يجب إدخال قيمة صفر.</div>
                                        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                            <button type="button" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto mb-2 btnPrev"><i class="fa-solid fa-chevron-right"></i></button>
                                            <button class="d-none btnNext"></button>
                                            <button type="button" id="financial_btn" class="btn btn-secondary w-100 w-sm-auto mb-2">التالي</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                    <div class="tab-pane fade" id="pills-income" role="tabpanel" aria-labelledby="pills-income-tab" tabindex="0">
                        <!-- Details Start -->
                        <h2 class="h4">المعلومات المالية | قائمة الدخل</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-0 align-items-start mb-2">
                                    <div id="income_table">
                                        @include('portal.request_loans.components.financial_income_info')
                                    </div>
                                    <div class="mb-3 row mt-3">
                                        <div class="alert-info p-3 rounded-3 mb-5">في حال عدم وجود قيم لأحد الحقول يجب إدخال قيمة صفر.</div>
                                        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                            <button type="button" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto mb-2 btnPrev"><i class="fa-solid fa-chevron-right"></i></button>
                                            <button class="d-none btnNext"></button>
                                            <button type="button" id="income_btn" class="btn btn-secondary w-100 w-sm-auto mb-2">التالي</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                    <div class="tab-pane fade" id="pills-attachments" role="tabpanel" aria-labelledby="pills-attachments-tab" tabindex="0">
                        <!-- Details Start -->
                        <h2 class="h4">المرفقات</h2>
                        <div class="card gallery">
                            <div class="card-body">
                                <div class="row g-0 align-items-start mb-2">
                                    @include('portal.request_loans.components.attachments')
                                </div>
                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Launch static backdrop modal-->
    @include('portal.request_loans.components.fund_source_modal')
    @include('portal.request_loans.components.fund_source_desc_modal')

    @include('portal.request_loans.components.warranty_modal')
    @include('portal.request_loans.components.guarantee_modal')
@endsection

@push('style')
    <style>
        .form-floating > label{
            height: auto !important;
        }
        .table-input:disabled, .table-input[readonly]{
            background-color: transparent !important;
            border-color: transparent !important;
            color: #4e4e4e !important;
            -webkit-text-fill-color: #4e4e4e !important;
        }
        .text-white.table-input:disabled, .text-white.table-input[readonly]{
            color: #fff !important;
            -webkit-text-fill-color: #fff !important;
        }
        .modal .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered{
            line-height: 10px;
        }
        .select2-container .select2-search--inline{
            float: right;
        }
        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice{
            float: right;
        }
        .number_table input, .table td{
            direction: ltr;
        }
        .btn-primary:hover, .btn-primary:focus{
            background-color: #000!important;
        }
    </style>
@endpush

@push('script')
    <x-js.validation />

    <script>
        $(document).ready(function() {
            const nextBtn = document.querySelectorAll(".btnNext");
            const prevBtn = document.querySelectorAll(".btnPrev");
            nextBtn.forEach(function (item, index) {
                item.addEventListener('click', function () {
                    let id = index + 1;
                    let tabElement = document.querySelectorAll('.menu-add-loan a[data-bs-toggle="pill"]')[id];
                    var lastTab = new bootstrap.Tab(tabElement);
                    lastTab.show();
                    var nav_id = $(tabElement).attr('id');
                    $('[data-bs-toggle="pill"]').removeClass('active');
                    $('[data-bs-toggle="pill"]').attr('aria-selected', 'false');
                    $('.menu-add-loan a#' + nav_id).addClass('active');
                    $('.menu-add-loan a#' + nav_id).attr('aria-selected', 'false');
                });
            });
            prevBtn.forEach(function (item, index) {
                item.addEventListener('click', function () {
                    let id = index;
                    let tabElement = document.querySelectorAll('.menu-add-loan a[data-bs-toggle="pill"]')[id];
                    var lastTab = new bootstrap.Tab(tabElement);
                    lastTab.show();
                    var nav_id = $(tabElement).attr('id');
                    $('[data-bs-toggle="pill"]').removeClass('active');
                    $('[data-bs-toggle="pill"]').attr('aria-selected', 'false');
                    $('.menu-add-loan a#' + nav_id).addClass('active');
                    $('.menu-add-loan a#' + nav_id).attr('aria-selected', 'false');
                });
            });
        });
    </script>

    <script>
        var loadMainFile = function (event) {
            let file = event.files[0];
            let filename = file.name;
            $('#file_name').val(filename);
        };

        $(document).ready(function() {
            $('#COMPANY_ADDRESS').on('change', function (e) {
                e.preventDefault();
                let check = $('#COMPANY_ADDRESS');
                let address = $('#ACTIVITY_PLACE');
                if(check.is(':checked')){
                    address.prop('readonly', true);
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "POST",
                        url: '{{route('portal.loan-request.address.get')}}',
                        data: {},
                        success: function (response) {
                            if (response.status) {
                                address.val(response.value);
                            }else{
                                toastr.error(response.msg);
                            }
                        },
                        error: function (response) {
                        }
                    })
                }else{
                    address.val('');
                    address.prop('readonly', false);
                }
            });

            $('#PROGRAM_TYPE_ID').on('change', function (e) {
                e.preventDefault();
                $('#PRODUCT_TYPE_ID').prop('disabled', true);
                let val = $(this).val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.loan-request.program.fetch')}}',
                    data: {
                        'PROGRAM_TYPE_ID': val,
                    },
                    success: function (response) {
                        if (response.status) {
                            $('#PRODUCT_TYPE_ID').html(response.html);
                            $('#PRODUCT_TYPE_ID').prop('disabled', false);
                        }
                    },
                    error: function (response) {
                    }
                })
            });

            $('#FUND_SECTOR_ID').on('change', function (e) {
                e.preventDefault();
                $('#FINANCING_PURPOSE_ID').prop('disabled', true);
                let val = $(this).val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.loan-request.purpose.fetch')}}',
                    data: {
                        'FUND_SECTOR_ID': val,
                    },
                    success: function (response) {
                        if (response.status) {
                            $('#FINANCING_PURPOSE_ID').val(null).trigger('change');
                            $('#FINANCING_PURPOSE_ID').html(response.html);
                            $('#FINANCING_PURPOSE_ID').prop('disabled', false);
                        }
                    },
                    error: function (response) {
                    }
                })
            });

            $('#GOODS_CURR_ID').on('change', function (e) {
                e.preventDefault();
                let val = $(this).val();
                $('#CURR_ID').val(val).trigger('change');
                $('input[name="CURR_ID"]').val(val);
                $('input[name="SOURCE_CURR_ID"]').val(val);
                $('#SOURCE_CURR_ID_select').val(val).trigger('change');
            });

            $('#GOODS_VALUE, #FINANCING_VALUE').siblings('.input-number').on('keyup', function (e) {
                let req = $('#GOODS_VALUE').val() ?? 0;
                let fin = $('#FINANCING_VALUE').val() ?? 0;
                $('#customer_contribution').val(formatNumber(req-fin));
            });

            $('#PROJECT_STATUS_ID').on('change', function (e) {
                e.preventDefault();
                let val = $(this).val();
                if(val==2){
                    $('.project_file').removeClass('d-none');
                }else{
                    $('.project_file').addClass('d-none');
                }
            });

            $('#main_form_data').on('submit', function (e) {
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
                            toastr.success(response.msg);
                            $('input[name="FUND_ID"]').val(response.fund_id);
                            goToTab('pills-payment-tab');
                            $('.curr_select').val($('#GOODS_CURR_ID').val());
                            $('.total_currency_here').html($('#GOODS_CURR_ID option:selected').text());
                            form.attr('action', '{{route('portal.loan-request.main-info.update')}}');
                            form.prepend('<input type="text" name="FUND_ID" value="'+response.fund_id+'" hidden>')
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
    </script>

    <script>
        let fund_source_list = '';

        $(document).ready(function() {
            $('#add_fund_source').on('submit', function (e) {
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
                            SwalModal('تم إضافة مصدر التمويل لمساهمة العميل بنجاح', 'success');
                            $('#fund_source_table').html(response.html);
                            $('select[name="SOURCE_ID"]').html(response.optionHtml);
                            $('#addnew').modal('hide');
                            fund_source_list = response.data['FUND_SOURCES_CUST_CONTRIBUTION'];
                            let fundId = form.find('input[name="FUND_ID"]').val();
                            let sourceId = form.find('select[name="SOURCE_ID"]').val();
                            form.find('select.reset').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            form.trigger('reset');
                            form.find('input[name="FUND_ID"]').val(fundId);
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

            $('#edit_fund_source').on('submit', function (e) {
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
                            SwalModal('تم تعديل مصدر التمويل لمساهمة العميل بنجاح', 'success');
                            $('#fund_source_table').html(response.html);
                            $('#editModal').modal('hide');
                            form.find('select.reset').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            fund_source_list = response.data['FUND_SOURCES_CUST_CONTRIBUTION'];
                            let fundId = form.find('input[name="FUND_ID"]').val();
                            form.trigger('reset');
                            form.find('input[name="FUND_ID"]').val(fundId);
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
        });

        function editFundRecord(e){
            let btn = $(e);
            errorHide($('#edit_fund_source'));
            let key = btn.data('key');
            let data = fund_source_list[key];
            $('#SOURCE_ID').val(data['SOURCE_ID'])
            $('#SOURCE_ID_select').siblings('.select2').addClass('full');
            $('#SOURCE_ID_select').val(data['SOURCE_ID']).trigger('change');
            $('#source_ANNUAL_SOURCE_VALUE').val(data['ANNUAL_SOURCE_VALUE']).trigger('input');
            $('#SOURCE_CURR_ID').siblings('.select2').addClass('full');
            $('#SOURCE_CURR_ID').val(data['CURR_ID']).trigger('change');

            $('#editModal').modal('show');
        }
    </script>

    <script>
        let fund_desc_list = '';

        $(document).ready(function() {
            $('#add_fund_desc').on('submit', function (e) {
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
                            SwalModal('تم إضافة وصف مصدر السداد بنجاح', 'success');
                            $('#fund_desc_table').html(response.html);
                            $('#addnew2').modal('hide');
                            form.find('select.reset').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            fund_desc_list = response.data['FUND_SOURCE_CUST_CONTR_DESC'];
                            let fundId = form.find('input[name="FUND_ID"]').val();
                            form.trigger('reset');
                            form.find('input[name="FUND_ID"]').val(fundId);
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

            $('#edit_fund_desc').on('submit', function (e) {
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
                            SwalModal('تم تعديل وصف مصدر السداد بنجاح', 'success');
                            $('#fund_desc_table').html(response.html);
                            $('#editModal2').modal('hide');
                            form.find('select.reset').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            fund_desc_list = response.data['FUND_SOURCE_CUST_CONTR_DESC'];
                            let fundId = form.find('input[name="FUND_ID"]').val();
                            form.trigger('reset');
                            form.find('input[name="FUND_ID"]').val(fundId);
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
        });

        function editFundDescRecord(e){
            let btn = $(e);
            let form = $('#edit_fund_desc');
            errorHide(form);
            let key = btn.data('key');
            let data = fund_desc_list[key];
            form.find('#SOURCE_CUST_CONTR_DESC_ID').val(data['SOURCE_CUST_CONTR_DESC_ID']);
            form.find('#SOURCE_CUST_CONTR_DESC').val(data['SOURCE_CUST_CONTR_DESC']);
            form.find('#ANNUAL_SOURCE_VALUE').val(data['ANNUAL_SOURCE_VALUE']).trigger('input');
            form.find('#SOURCE_CUST_CONTR_CURR_ID').siblings('.select2').addClass('full');
            form.find('#SOURCE_CUST_CONTR_CURR_ID').val(data['CURR_ID']).trigger('change');

            $('#editModal2').modal('show');
        }
    </script>

    <script>
        let warranty_list = '';

        $(document).ready(function() {
            $('#add_warranty').on('submit', function (e) {
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
                            SwalModal('تم إضافة الضمان بنجاح', 'success');
                            $('#warranty_table').html(response.html);
                            $('#addnew3').modal('hide');
                            form.find('select.reset').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            warranty_list = response.data['FUND_GUARANTEES'];
                            let fundId = form.find('input[name="FUND_ID"]').val();
                            form.trigger('reset');
                            form.find('input[name="FUND_ID"]').val(fundId);
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

            $('#edit_warranty').on('submit', function (e) {
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
                            SwalModal('تم تعديل الضمان بنجاح', 'success');
                            $('#warranty_table').html(response.html);
                            $('#editModal3').modal('hide');
                            form.find('select.reset').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            warranty_list = response.data['FUND_GUARANTEES'];
                            let fundId = form.find('input[name="FUND_ID"]').val();
                            form.trigger('reset');
                            form.find('input[name="FUND_ID"]').val(fundId);
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
        });

        function editWarrantyRecord(e){
            let btn = $(e);
            let form = $('#edit_warranty');
            errorHide(form);
            let key = btn.data('key');
            let data = warranty_list[key];
            form.find('#FUND_GUARANTEE_ID_1').val(data['FUND_GUARANTEE_ID']);
            form.find('#GUARANTEE_TYPE_ID_1').siblings('.select2').addClass('full');
            form.find('#GUARANTEE_TYPE_ID_1').val(data['GUARANTEE_TYPE_ID']).trigger('change');
            form.find('#GUARANTEE_DESC_1').val(data['GUARANTEE_DESC']);
            form.find('#GUARANTEE_VALUE_1').val(data['GUARANTEE_VALUE']).trigger('input');
            form.find('#GURANTEES_CURR_ID_1').siblings('.select2').addClass('full');
            form.find('#GURANTEES_CURR_ID_1').val(data['CURR_ID']).trigger('change');

            $('#editModal3').modal('show');
        }
    </script>

    <script>
        let guarantee_list = '';

        $(document).ready(function() {
            $('#add_guarantee').on('submit', function (e) {
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
                            SwalModal('تم إضافة الكفالة بنجاح', 'success');
                            $('#guarantee_table').html(response.html);
                            $('#addnew4').modal('hide');
                            form.find('select.reset').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            guarantee_list = response.data['FUND_GUARANTEES'];
                            let fundId = form.find('input[name="FUND_ID"]').val();
                            form.trigger('reset');
                            form.find('input[name="FUND_ID"]').val(fundId);
                        } else {
                            errorShow(form, response.msg);
                        }
                        loaderEnd(form);
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            index = index.split('.')[0];
                            form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                            form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                            form.find("input[name='"+index+"[]']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                        });
                        loaderEnd(form)
                    }
                })
            });

            $('#edit_guarantee').on('submit', function (e) {
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
                            SwalModal('تم تعديل الكفالة بنجاح', 'success');
                            $('#guarantee_table').html(response.html);
                            $('#editModal4').modal('hide');
                            form.find('select.reset').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            guarantee_list = response.data['FUND_GUARANTEES'];
                            let fundId = form.find('input[name="FUND_ID"]').val();
                            form.trigger('reset');
                            form.find('input[name="FUND_ID"]').val(fundId);
                        } else {
                            errorShow(form, response.msg);
                        }
                        loaderEnd(form);
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                            form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                            form.find("input[name='"+index+"[]']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                        });
                        loaderEnd(form)
                    }
                })
            });
        });

        function editGuaranteeRecord(e){
            let btn = $(e);
            let form = $('#edit_guarantee');
            form.find('.duplicate_guarantee_here').html('');
            errorHide(form);
            let key = btn.data('key');
            let data = guarantee_list[key];

            form.find('#FUND_GUARANTEE_ID').val(data['FUND_GUARANTEE_ID']);
            form.find('#GUARANTEE_TYPE_ID').siblings('.select2').addClass('full');
            form.find('#GUARANTEE_TYPE_ID').val(data['GUARANTEE_TYPE_ID']).trigger('change');
            form.find('#SALARY_TYPE_ID').siblings('.select2').addClass('full');
            form.find('#SALARY_TYPE_ID').val(data['SALARY_TYPE_ID']).trigger('change');

            if(data['SALARY_TYPE_ID'] == 2){
                form.find('.with_salary').addClass('d-none');
                form.find('.no_salary').removeClass('d-none');
                form.find('#GUARANTEE_VALUE').val(data['GUARANTEE_VALUE']).trigger('input');
                form.find('#GURANTEES_CURR_ID').siblings('.select2').addClass('full');
                form.find('#GURANTEES_CURR_ID').val(data['CURR_ID']).trigger('change');
            }else{
                form.find('.no_salary').addClass('d-none');
                form.find('.with_salary').removeClass('d-none');
                data['FUND_GUARANTEE_SALARIES'].forEach(function(item){
                    let clone = form.find('.duplicate_guarantee_copy').clone();
                    clone.find('.duplicate_guarantee_copy').removeClass('duplicate_guarantee_copy');
                    clone.find('.duplicate_guarantee_copy').addClass('SALARY-'+item['SALARY_ID']);
                    clone.find('.select2').remove();
                    let ele = '<div class="mt-2 SALARY-'+item['SALARY_ID']+'">' + clone.html() + '</div>';
                    form.find('.edited_duplicate_guarantee_here').append(ele);

                    form.find('.edited_duplicate_guarantee_here [name="SALARY_CURR_ID[]"]').select2();

                    let salary = $('.SALARY-'+item['SALARY_ID'])
                    salary.prepend('<input type="text" name="SALARY_ID" value="'+item['SALARY_ID']+'" hidden>')
                    salary.find('.SALARY_DESC').val(item['SALARY_DESC']);
                    salary.find('.SALARY_VALUE').val(item['SALARY_VALUE']).trigger('input');
                    salary.find('.SALARY_CURR_ID').siblings('.select2').addClass('full');
                    salary.find('.SALARY_CURR_ID').val(item['SALARY_CURR_ID']).trigger('change');
                });
            }

            $('#editModal4').modal('show');
        }

        $(document).on('change', 'select[name="SALARY_TYPE_ID"]', function (e) {
            let form = $(this).parents('form');
            let value = $(this).val();
            if(value == 2){
                form.find('.with_salary').addClass('d-none');
                form.find('.no_salary').removeClass('d-none');
            }else{
                form.find('.no_salary').addClass('d-none');
                form.find('.with_salary').removeClass('d-none');
            }
        })

        $('#addnew4').on('show.bs.modal', function (){
            $(this).find('.duplicate_guarantee_here').html('');
            $(this).find('.edited_duplicate_guarantee_here').html('');

            let form = $(this).find('form');
            form.find('select.reset').val(null).trigger('change');
            form.find('.select2.full').removeClass('full');
            let fundId = form.find('input[name="FUND_ID"]').val();
            form.trigger('reset');
            form.find('input[name="FUND_ID"]').val(fundId);
        })

        $('#editModal4').on('hidden.bs.modal', function (){
            $(this).find('.duplicate_guarantee_here').html('');
            $(this).find('.edited_duplicate_guarantee_here').html('');

            let form = $(this).find('form');
            form.find('select.reset').val(null).trigger('change');
            form.find('.select2.full').removeClass('full');
            let fundId = form.find('input[name="FUND_ID"]').val();
            form.trigger('reset');
            form.find('input[name="FUND_ID"]').val(fundId);
        })

        $(document).on('click', '.duplicate_guarantee', function (e){
            let form = $(this).parents('form');
            let clone = form.find('.duplicate_guarantee_copy').clone();
            clone.find('.duplicate_guarantee_copy').removeClass('duplicate_guarantee_copy');
            clone.find('.select2').remove();
            form.find('.duplicate_guarantee_here').append(clone.html());
            form.find('.duplicate_guarantee_here [name="SALARY_CURR_ID[]"]').select2();
        })
    </script>

    <script>
        function deleteFundRecord(e){
            let btn = $(e);
            let fundId = $('input[name="FUND_ID"]').val();
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
                        url: '{{route('portal.loan-request.fund-source.delete')}}',
                        type: 'POST',
                        data: {
                            'fundId': fundId,
                            'id': id,
                        },
                        success: function (data) {
                            if(data.status){
                                $('select[name="SOURCE_ID"]').html(data.optionHtml);
                                $('#fund_source_table').html(data.html);
                                Swal.fire('', 'تم حذف مصادر التمويل لمساهمة العميل بنجاح', 'success', 2000);
                            }else{
                                Swal.fire('', data.msg, 'error', 2000);
                            }
                        },
                    });
                }
            });
        }

        function deleteFundDescRecord(e){
            let btn = $(e);
            let fundId = $('input[name="FUND_ID"]').val();
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
                        url: '{{route('portal.loan-request.fund-desc.delete')}}',
                        type: 'POST',
                        data: {
                            'fundId': fundId,
                            'id': id,
                        },
                        success: function (data) {
                            if(data.status){
                                $('#fund_desc_table').html(data.html);
                                Swal.fire('', 'تم حذف وصف مصادر السداد بنجاح', 'success', 2000);
                            }else{
                                Swal.fire('', data.msg, 'error', 2000);
                            }
                        },
                    });
                }
            });
        }

        function deleteWarrantyRecord(e){
            let btn = $(e);
            let fundId = $('input[name="FUND_ID"]').val();
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
                        url: '{{route('portal.loan-request.warranty.delete')}}',
                        type: 'POST',
                        data: {
                            'fundId': fundId,
                            'id': id,
                        },
                        success: function (data) {
                            if(data.status){
                                $('#warranty_table').html(data.html);
                                Swal.fire('', 'تم حذف الضمان بنجاح', 'success', 2000);
                            }else{
                                Swal.fire('', data.msg, 'error', 2000);
                            }
                        },
                    });
                }
            });
        }

        function deleteGuaranteeRecord(e){
            let btn = $(e);
            let fundId = $('input[name="FUND_ID"]').val();
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
                        url: '{{route('portal.loan-request.guarantee.delete')}}',
                        type: 'POST',
                        data: {
                            'fundId': fundId,
                            'id': id,
                        },
                        success: function (data) {
                            if(data.status){
                                $('#guarantee_table').html(data.html);
                                Swal.fire('', 'تم حذف الكفالة بنجاح', 'success', 2000);
                            }else{
                                Swal.fire('', data.msg, 'error', 2000);
                            }
                        },
                    });
                }
            });
        }
    </script>

    <script>
        function edit_row(e) {
            var btn = $(e);
            var row = btn.closest('tr');
            LAST_YEAR_VALUE = row.find('input[name="LAST_YEAR_VALUE"]').val()!='-'?parseInt(row.find('input[name="LAST_YEAR_VALUE"]').val()):0;
            THIS_YEAR_VALUE = row.find('input[name="THIS_YEAR_VALUE"]').val()!='-'?parseInt(row.find('input[name="THIS_YEAR_VALUE"]').val()):0;
            btn.addClass('d-none');
            row.find('.row-save-btn').removeClass('d-none');
            row.find('input').prop('disabled', false);
            row.find('input').each(function(index, value) {
                if($(this).val()=='-'){
                    $(this).val(0);
                }
            });
        }

        $(document).on('change', 'input[name="LAST_YEAR_VALUE"], input[name="THIS_YEAR_VALUE"]', function () {
            let row = $(this).closest('tr');
            let LAST_YEAR_VALUE = 0;
            let THIS_YEAR_VALUE = 0;
            if($.isNumeric(row.find('input[name="LAST_YEAR_VALUE"]').val()) && $.isNumeric(row.find('input[name="THIS_YEAR_VALUE"]').val())){
                LAST_YEAR_VALUE = parseInt(row.find('input[name="LAST_YEAR_VALUE"]').val());
                THIS_YEAR_VALUE = parseInt(row.find('input[name="THIS_YEAR_VALUE"]').val());
            }else{
                // SwalModal('القيمة المدخلة يجب ان تكون رقم', 'error');
                $(this).val(0);
            }
            // let LAST_YEAR_VALUE = row.find('input[name="LAST_YEAR_VALUE"]').val()!='-'?parseInt(row.find('input[name="LAST_YEAR_VALUE"]').val()):0;
            // let THIS_YEAR_VALUE = row.find('input[name="THIS_YEAR_VALUE"]').val()!='-'?parseInt(row.find('input[name="THIS_YEAR_VALUE"]').val()):0;
            let diff = calcChange(LAST_YEAR_VALUE, THIS_YEAR_VALUE);
            row.find('.differance').html(diff);
        });

        function calcChange(sub, year){
            let result = 0;
            if(sub == year){
                result = '0%';
            }else if (sub < 0 && year == 0 || sub == 0 && year > 0){
                result = '100%';
            }else if (sub > 0 && year == 0 || sub == 0 && year < 0){
                result = '-100%';
            }else{
                let num = ((year - sub) / sub) * 100
                result = (Math.round(num)).toFixed(2) + '%';
            }
            return result;
        }
    </script>

    <x-js.financial_info />
    <x-js.financial_income_info />

    <script>
        $(document).ready(function() {
            $('#attachments_form').on('submit', function (e) {
                e.preventDefault();
                let form = $('#attachments_form');
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
                            SwalModal(response.msg, 'success');
                            $('#attach_list').html(response.html);
                            baguetteBox.run('.lightbox');
                            let fundId = form.find('input[name="FUND_ID"]').val();
                            form.find('select').val(null).trigger('change');
                            form.find('.select2.full').removeClass('full');
                            form.trigger('reset');
                            form.find('input[name="FUND_ID"]').val(fundId);
                        } else {
                            SwalModal(response.msg, 'error');
                        }
                        loaderEnd(form)
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            html += value;
                        });
                        SwalModal(html, 'error');
                        loaderEnd(form)
                    }
                })
            });

            $('#apply_loan').on('click', function (e) {
                e.preventDefault();
                let form = $('#attachments_form');
                errorHide(form);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.loan-request.attachments.submit')}}',
                    data: {
                        'FUND_ID': $('input[name="FUND_ID"]').val()
                    },
                    success: function (response) {
                        if (response.status) {
                            SwalModal(response.msg, 'success', response.url);
                        } else {
                            SwalModal(response.msg, 'error');
                        }
                    },
                })
            });
        });

        var loadFile = function (event) {
            attachFile = event.files[0];
            attachURL = URL.createObjectURL(attachFile);
        };

        function removeAttach(e){
            let btn = $(e);
            let fundId = $('input[name="FUND_ID"]').val();
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
                if(result.value){
                    if(id==0){
                        let no = $(e).parent().parent().data('count');
                        form_data.delete('id-'+no);
                        form_data.delete('file-'+no);
                        $(e).parent().parent().remove();
                    }else{
                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: '{{route('portal.loan-request.attachments.delete')}}',
                            type: 'POST',
                            data: {
                                'fundId': fundId,
                                'id': id,
                            },
                            success: function (data) {
                                if(data.status){
                                    btn.parent().parent().remove();
                                    Swal.fire('', data.msg, 'success', 2000);
                                }else{
                                    Swal.fire('', data.msg, 'error', 2000);
                                }
                            },
                        });
                    }
                }
            });
        }
    </script>

    <script>
        function goToTab(nextID) {
            $('[data-bs-toggle="pill"]').removeClass('active');
            $('[data-bs-toggle="pill"]').attr('aria-selected', 'false');
            $('#'+nextID).tab('show');
            $('a#'+nextID).addClass('active');
        }
    </script>
@endpush

@push('page_style')
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/bootstrap-datepicker3.standalone.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/baguetteBox.min.css" />
@endpush

@push('page_script')
    <script src="{{asset('assets')}}/js/vendor/movecontent.js"></script>
    <script src="{{asset('assets')}}/js/vendor/select2.full.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/profile.settings.js"></script>
    <script src="{{asset('assets')}}/js/forms/layouts.js"></script>

    <script src="{{asset('assets')}}/js/vendor/baguetteBox.min.js"></script>
    <script src="{{asset('assets')}}/js/plugins/lightbox.js"></script>

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>

    <script>
        $(document).ready(function() {
            const triggerTabList = document.querySelectorAll('.menu-add-loan a[data-bs-toggle="pill"]')
            triggerTabList.forEach(triggerEl => {
                const tabTrigger = new bootstrap.Tab(triggerEl)
                triggerEl.addEventListener('click', event => {
                    $('[data-bs-toggle="pill"]').removeClass('active');
                    $('[data-bs-toggle="pill"]').attr('aria-selected','false');
                    event.preventDefault()
                    tabTrigger.show()
                })
            })
        });
        function program_select(e) {
            var value = $(e).val();
            if(value > 0){
                $('.program-selected select.select-single-with-search').prop('disabled',false);
            }else{
                $('.program-selected select.select-single-with-search').prop('disabled',true);
            }
        }
    </script>
@endpush
