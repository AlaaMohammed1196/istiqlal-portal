@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">تكرار طلب قرض</h1>

                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.orders.index')}}">طلباتي</a></li>
                            <li class="breadcrumb-item">تكرار طلب قرض</li>
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
                @include('portal.request_loans_duplicate.components.list')
            </div>
            <div class="col-lg-8 col-xl-8">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-datainfo" role="tabpanel" aria-labelledby="pills-datainfo-tab" tabindex="0">
                        <!-- Details Start -->
                        <h2 class="h4">البيانات العامة</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-0 align-items-start mb-2">
                                    @include('portal.request_loans_duplicate.components.main_info')
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
                                                @include('portal.request_loans_duplicate.components.fund_source_table')
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
                                                @include('portal.request_loans_duplicate.components.fund_source_desc_table')
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-3 row mt-5">
                                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                                <button type="button" class="d-none btnPrev">السابق</button>
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
                                                @include('portal.request_loans_duplicate.components.warranty_table')
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-3 row mt-5">
                                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                                <button type="button" class="btn btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto mb-2 btnPrev">السابق</button>
                                                <button type="button" class="btn btn-secondary w-100 w-sm-auto mb-2 btnNext">التالي</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                    <div class="tab-pane fade" id="pills-assets" role="tabpanel" aria-labelledby="pills-assets-tab" tabindex="0">
                        <h2 class="h4">المعلومات المالية | الموجودات</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-0 align-items-start mb-2">
                                    <form id="finance_info_form" action="{{route('portal.loan-request.financial-info.year')}}">
                                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                                        <input type="text" name="FUND_ID" value="{{$data['Fund_Data'][0]['FUND_ID']}}" hidden>
                                        <input type="text" name="is_send" value="0" hidden>
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="form-floating mb-4 w-100">
                                                    <input type="text" class="form-control" name="AUDITED_ENTITY_NAME" value="{{$data['Fund_Data'][0]['AUDITED_ENTITY_NAME']}}" placeholder="الجهة المدققة " />
                                                    <label>الجهة المدققة </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-floating mb-4 w-100">
                                                    <select class="select-floating-with-search" name="FINANCE_INFO_CURR_ID">
                                                        <option></option>
                                                        @foreach($constants['CURRENCIES'] as $item)
                                                            <option value="{{$item['VALUE']}}" {{$item['VALUE']==$data['Fund_Data'][0]['FINANCE_INFO_CURR_ID']?'selected':''}}>{{$item['LABEL']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>العملة </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-floating mb-4">
                                                    <input type="text" class="date-picker-close form-control" name="FINANCE_INFO_PREPARED_ON" value="{{$data['Fund_Data'][0]['FINANCE_INFO_PREPARED_ON']?\Carbon\Carbon::parse($data['Fund_Data'][0]['FINANCE_INFO_PREPARED_ON'])->format('m-d-Y'):''}}" id="FINANCE_INFO_PREPARED_ON" placeholder="تاريخ إعدادها" />
                                                    <label>تاريخ إعدادها</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-floating mb-4">
                                                    <input type="text" class="datePickerYear form-control" name="FISCAL_YEAR" value="{{$data['Fund_Data'][0]['FISCAL_YEAR']}}" id="FISCAL_YEAR" placeholder="السنة المالية" />
                                                    <label>السنة المالية</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-12 d-flex justify-content-between mb-3">
                                        <div class="fw-bold h5">الموجودات المتداولة</div>
                                    </div>
                                    <div id="current_assets_table">
                                        @include('portal.request_loans_duplicate.components.assets.current_table')
                                    </div>
                                    <div class="col-12 d-flex justify-content-between mb-3 mt-5">
                                        <div class="fw-bold h5">الموجودات الثابتة</div>
                                    </div>
                                    <div id="fixed_assets_table">
                                        @include('portal.request_loans_duplicate.components.assets.fixed_table')
                                    </div>
                                    <div class="mb-3 row mt-5">
                                        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                            <button type="button" class="btn btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto mb-2 btnPrev">السابق</button>
                                            <button class="d-none btnNext" id="go"></button>
                                            <button id="f_info_btn" class="btn btn-secondary w-100 w-sm-auto mb-2">التالي</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                    <div class="tab-pane fade" id="pills-liabilities" role="tabpanel" aria-labelledby="pills-liabilities-tab" tabindex="0">
                        <!-- Details Start -->
                        <h2 class="h4">المعلومات المالية | المطلوبات</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-0 align-items-start mb-2 total1">
                                    <div class="col-12 d-flex justify-content-between mb-3">
                                        <div class="fw-bold h5">المطلوبات المتداولة</div>
                                    </div>
                                    <div class="current_liabilities_table">
                                    @include('portal.request_loans_duplicate.components.liabilities.current_table')
                                    </div>
                                    <div class="col-12 d-flex justify-content-between mb-3 mt-5">
                                        <div class="fw-bold h5">المطلوبات الغير متداولة</div>
                                    </div>
                                    <div class="fixed_liabilities_table">
                                        @include('portal.request_loans_duplicate.components.liabilities.fixed_table')
                                    </div>
                                    <div class="mb-3 row mt-5">
                                        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                            <button type="button" class="btn btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto mb-2 btnPrev">السابق</button>
                                            <button type="button" class="btn btn-secondary w-100 w-sm-auto mb-2 btnNext">التالي</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                    <div class="tab-pane fade" id="pills-property" role="tabpanel" aria-labelledby="pills-property-tab" tabindex="0">
                        <!-- Details Start -->
                        <h2 class="h4">المعلومات المالية | حقوق الملكية</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-0 align-items-start mb-2">
                                    <div id="property_table">
                                        @include('portal.request_loans_duplicate.components.property.table')
                                    </div>
                                    <div class="mb-3 row mt-5">
                                        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                            <button type="button" class="btn btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto mb-2 btnPrev">السابق</button>
                                            <button type="button" class="btn btn-secondary w-100 w-sm-auto mb-2 btnNext">التالي</button>
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
                                        @include('portal.request_loans_duplicate.components.income.table')
                                    </div>
                                    <div class="mb-3 row mt-5">
                                        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                            <button type="button" class="btn btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto mb-2 btnPrev">السابق</button>
                                            <button type="button" class="btn btn-secondary w-100 w-sm-auto mb-2 btnNext">التالي</button>
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
                                    @include('portal.request_loans_duplicate.components.attachments')
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
    @include('portal.request_loans_duplicate.components.fund_source_modal')

    <!-- Modal  Launch static backdrop modal-->
    @include('portal.request_loans_duplicate.components.fund_source_desc_modal')

    <!-- Modal  Launch static backdrop modal-->
    @include('portal.request_loans_duplicate.components.warranty_modal')
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
    </style>
@endpush

@push('script')
    <x-js.validation />

    <script>
        $(document).ready(function() {

            let sub1 = parseInt($('.total-current .sub').val());
            let year1 = parseInt($('.total-current .year').val());
            let diff1 = parseInt($('.total-current .diff').val());
            let sub2 = parseInt($('.total-fixed .sub').val());
            let year2 = parseInt($('.total-fixed .year').val());
            let diff2 = parseInt($('.total-fixed .diff').val());
            $('.total_sub_1').val(sub1+sub2);
            $('.total_year_1').val(year1+year2);
            $('.total_diff_1').val(diff1+diff2);
            let sub3 = parseInt($('.total-rights .sub').val());
            let year3 = parseInt($('.total-rights .year').val());
            let diff3 = parseInt($('.total-rights .diff').val());
            $('.total_sub_2').val(sub1+sub2+sub3);
            $('.total_year_2').val(year1+year2+year3);
            $('.total_diff_2').val(diff1+diff2+diff3);

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
        $(document).ready(function() {
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
            });

            $('#GOODS_VALUE, #FINANCING_VALUE').on('keyup', function (e) {
                let req = $('#GOODS_VALUE').val() ?? 0;
                let fin = $('#FINANCING_VALUE').val() ?? 0;
                $('#customer_contribution').val(req-fin);
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
                            toastr.success(response.msg)
                            $('input[name="FUND_ID"]').val(response.fund_id);
                            goToTab('pills-payment-tab');
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
        let fund_source_list = {!!json_encode($data['FUND_SOURCES_CUST_CONTRIBUTION'])!!};

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
            $('#source_ANNUAL_SOURCE_VALUE').val(data['ANNUAL_SOURCE_VALUE'])
            $('#SOURCE_CURR_ID').siblings('.select2').addClass('full');
            $('#SOURCE_CURR_ID').val(data['CURR_ID']).trigger('change');

            $('#editModal').modal('show');
        }
    </script>

    <script>
        let fund_desc_list = {!!json_encode($data['FUND_SOURCE_CUST_CONTR_DESC'])!!};

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
            form.find('#ANNUAL_SOURCE_VALUE').val(data['ANNUAL_SOURCE_VALUE']);
            form.find('#SOURCE_CUST_CONTR_CURR_ID').siblings('.select2').addClass('full');
            form.find('#SOURCE_CUST_CONTR_CURR_ID').val(data['CURR_ID']).trigger('change');

            $('#editModal2').modal('show');
        }
    </script>

    <script>
        let warranty_list = {!!json_encode($data['FUND_GUARANTEES'])!!};

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
            form.find('#FUND_GUARANTEE_ID').val(data['FUND_GUARANTEE_ID']);
            form.find('#GUARANTEE_TYPE_ID').siblings('.select2').addClass('full');
            form.find('#GUARANTEE_TYPE_ID').val(data['GUARANTEE_TYPE_ID']).trigger('change');
            form.find('#GUARANTEE_DESC').val(data['GUARANTEE_DESC']);
            form.find('#GUARANTEE_VALUE').val(data['GUARANTEE_VALUE']);
            form.find('#GURANTEES_CURR_ID').siblings('.select2').addClass('full');
            form.find('#GURANTEES_CURR_ID').val(data['GURANTEES_CURR_ID']).trigger('change');

            $('#editModal3').modal('show');
        }
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
                                Swal.fire('', data.msg, 'success', 2000);
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
                                Swal.fire('', data.msg, 'success', 2000);
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

    <script>
        $(document).ready(function() {
            $('.row-save-btn').on('click', function (e) {
                e.preventDefault();
                let btn = $(this);
                let type = btn.data('type');
                let row = btn.closest('tr');
                let sub = row.find('input[name="LAST_YEAR_VALUE"]').val();
                let year = row.find('input[name="THIS_YEAR_VALUE"]').val();
                let fundId = row.find('input[name="FUND_ID"]').val();
                let FINANCIAL_INFO_ID = row.find('input[name="FINANCIAL_INFO_ID"]').val();
                if(sub >= 0 || year >= 0){
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "POST",
                        url: '{{route('portal.loan-request.financial-info.store')}}',
                        data: {
                            'FUND_ID': fundId,
                            'FINANCIAL_INFO_ID': FINANCIAL_INFO_ID,
                            'LAST_YEAR_VALUE': sub,
                            'THIS_YEAR_VALUE': year,
                        },
                        success: function (response) {
                            if (response.status) {
                                btn.addClass('d-none');
                                row.find('.row-edit-btn').removeClass('d-none');
                                row.find('input').prop('disabled', true);
                                row.find('.differance').html(year-sub);
                                if(type==2){
                                    updateSum(row, sub, year);
                                    updateTotal1();
                                    updateTotal2()
                                }else if(type==3){
                                    updateSum(row, sub, year);
                                    updateTotal2();
                                }else if(type==4){
                                    let subtype = btn.data('sub');
                                    updateIncomeTotal(btn, sub, year, subtype);
                                }else{
                                    updateSum(row, sub, year);
                                }
                            } else {
                            }
                        },
                        error: function (response) {
                        }
                    })
                }else{
                    btn.addClass('d-none');
                    row.find('.row-edit-btn').removeClass('d-none');
                    row.find('input').prop('disabled', true);
                    row.find('input').each(function(index, value) {
                        if($(this).val()==0){
                            $(this).val('-');
                        }
                    });
                }
            });
        });

        let LAST_YEAR_VALUE = 0;
        let THIS_YEAR_VALUE = 0;

        function edit_row(e) {
            var btn = $(e);
            var row = btn.closest('tr');
            LAST_YEAR_VALUE = row.find('input[name="LAST_YEAR_VALUE"]').val()!='-'?parseInt(row.find('input[name="LAST_YEAR_VALUE"]').val()):0;
            THIS_YEAR_VALUE = row.find('input[name="LAST_YEAR_VALUE"]').val()!='-'?parseInt(row.find('input[name="THIS_YEAR_VALUE"]').val()):0;
            btn.addClass('d-none');
            row.find('.row-save-btn').removeClass('d-none');
            row.find('input').prop('disabled', false);
            row.find('input').each(function(index, value) {
                if($(this).val()=='-'){
                    $(this).val(0);
                }
            });
        }
        function updateSum(e, val1, val2){
            let sub = parseInt(e.closest('table').find('.sub').val()) - LAST_YEAR_VALUE;
            let year = parseInt(e.closest('table').find('.year').val()) - THIS_YEAR_VALUE;
            e.closest('table').find('.sub').val(sub+parseInt(val1));
            e.closest('table').find('.year').val(year+parseInt(val2));
            e.closest('table').find('.diff').val(parseInt(e.closest('table').find('.year').val())-parseInt(e.closest('table').find('.sub').val()));
        }

        function updateTotal1(){
            let fixed = [];
            fixed['sub'] = parseInt($('.total-fixed .sub').val());
            fixed['year'] = parseInt($('.total-fixed .year').val());
            fixed['diff'] = parseInt($('.total-fixed .diff').val());
            let current = [];
            current['sub'] = parseInt($('.total-current .sub').val());
            current['year'] = parseInt($('.total-current .year').val());
            current['diff'] = parseInt($('.total-current .diff').val());
            $('.total_sub_1').val(fixed['sub']+current['sub']);
            $('.total_year_1').val(fixed['year']+current['year']);
            $('.total_diff_1').val(fixed['diff']+current['diff']);
        }

        function updateTotal2(){
            let rights = [];
            rights['sub'] = parseInt($('.total-rights .sub').val());
            rights['year'] = parseInt($('.total-rights .year').val());
            rights['diff'] = parseInt($('.total-rights .diff').val());
            let total1 = [];
            total1['sub'] = parseInt($('.total_sub_1').val());
            total1['year'] = parseInt($('.total_year_1').val());
            total1['diff'] = parseInt($('.total_diff_1').val());
            $('.total_sub_2').val(rights['sub']+total1['sub']);
            $('.total_year_2').val(rights['year']+total1['year']);
            $('.total_diff_2').val(rights['diff']+total1['diff']);
        }
    </script>

    <x-js.loans />

    <script>
        let form_data = new FormData();
        let docID = [];
        let docFile = []
        let attachFile;
        let attachURL = '';
        let attachData = [];
        let count = 1;
        $(document).ready(function() {
            $('#attachments_form').on('submit', function (e) {
                e.preventDefault();
                let form = $('#attachments_form');
                errorHide(form);
                let type = $('select[name="DOC_CLASS_IDS"]').find('option:selected').html();
                let ext = $('input[name="FUND_ATTACHS"]').val().split(".");
                ext = ext[ext.length-1].toLowerCase();
                let size = attachFile.size/1000+'kb';
                console.log(ext, attachFile.size/1000+'kb');
                let html = '';
                if(type){
                    if(ext == 'pdf'){
                        html = '<div class="d-flex border border-separator-light align-items-center rounded py-3 px-5 mb-3 mt-3">' +
                            '<i class="fa-solid fa-paperclip text-secondary"></i>' +
                            '<div class="mx-2">' +
                            '<a target="_blank" href="'+attachURL+'" download="'+type+'">'+type+
                            '<div>' +
                            '<small class="ms-2">نوع الملف: '+ext+'</small>' +
                            '<small class="ms-2">حجم الملف: '+size+'</small>' +
                            '</div>' +
                            '</a>' +
                            '</div>' +
                            '<div class="me-auto">' +
                            '<button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top" onclick="removeAttach(this)" data-id="0" type="button">' +
                            '<i class="fa-solid fa-circle-xmark"></i>' +
                            '</button>' +
                            '</div>' +
                            '</div>' ;
                    }else if(ext == 'png' || ext == 'svg' || ext == 'jpg' || ext == 'jpeg'){
                        html = '<div class="d-flex border border-separator-light align-items-center rounded py-3 px-5 mb-3 mt-3">' +
                        '<i class="fa-solid fa-paperclip text-secondary"></i>' +
                        '<div class="mx-2">' +
                        '<a target="_blank" href="'+attachURL+'" download="'+type+'">'+type+
                        '<div>' +
                        '<small class="ms-2">نوع الملف: '+ext+'</small>' +
                        '<small class="ms-2">حجم الملف: '+size+'</small>' +
                        '</div>' +
                        '</a>' +
                        '</div>' +
                        '<div class="me-auto">' +
                        '<button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top" onclick="removeAttach(this)" data-id="0" type="button">' +
                        '<i class="fa-solid fa-circle-xmark"></i>' +
                        '</button>' +
                        '</div>' +
                        '</div>' ;
                    }else{
                        errorShow(form, 'صيغة الملف خاطئة الصيغ المسموح فيها png,svg,jpg,jpeg,pdf');
                        return false;
                    }
                }else{
                    errorShow(form, 'صيغة الملف خاطئة الصيغ المسموح فيها png,svg,jpg,jpeg,pdf');
                    return false;
                }
                form_data.append('id-'+count, $('select[name="DOC_CLASS_IDS"]').val());
                form_data.append('file-'+count, attachFile);
                form_data.append('FUND_ID', $('input[name="FUND_ID"]').val());
                count++;
                $('#attach_list').prepend(html);
                baguetteBox.run('.lightbox');
                form.find('select').val(null).trigger('change');
                form.find('.select2.full').removeClass('full');
                form.trigger('reset');
                attachURL = '';
            });

            $('#apply_loan').on('click', function (e) {
                e.preventDefault();
                let form = $('#attachments_form');
                errorHide(form);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: form.attr('action'),
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (response.status) {
                            window.location.href = response.url;
                        } else {
                            errorShow(form, response.msg);
                        }
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            // showValidationError(form, index, value);
                            html += value;
                        });
                        SwalModal(html, 'error');
                    }
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
                                    window.location.reload(true);
                                    window.location.reload(true);
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
