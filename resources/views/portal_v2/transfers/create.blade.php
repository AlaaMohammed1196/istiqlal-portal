@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">إرسال حوالة</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.transfers.index')}}">الحوالات</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">إرسال حوالة جديدة</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Responsive Tabs Start -->
        <section class="scroll-section  position-relative" id="responsiveTabs">
            <div class="card col-md-8 mb-3 mt-5">
                <div class="card-body">
                    <form id="form_data" action="{{route('portal.v2.transfers.submit')}}">
                        <div class="row g-0 py-2 text-center">
                            <div class="sh-3 sh-md-5 fw-bold lh-1-25 h5"><i class="fa-solid fa-right-left ms-2"></i> إرسال حوالة جديدة</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12 col-md-12 text-center">
                                <?php $TransferTypes = collect($constants['TransferTypes'])->sortByDesc('VALUE') ?>
                                @foreach($TransferTypes as $item)
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="transfer_type" {{$item['VALUE']==10?'checked':''}} id="transfer_type-{{$item['VALUE']}}" value="{{$item['VALUE']}}">
                                    <label class="form-check-label" for="transfer_type-{{$item['VALUE']}}">{{$item['LABEL']}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @if(count($internal_beneficiaries) == 0)
                            <div class="alert alert-warning mb-4 internal_beneficiaries_warning d-none" role="alert">الرجاء إضافة مستفيد لتتمكن من إنشاء الحوالة</div>
                        @endif
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">من حساب</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" class="FROM_LEDGER_ID" id="FROM_BRANCH_ID" name="FROM_BRANCH_ID" hidden>
                                <input type="text" class="FROM_LEDGER_ID" id="FROM_CURR_ID" name="FROM_CURR_ID" hidden>
                                <input type="text" class="FROM_LEDGER_ID" id="FROM_ACC_NUM" name="FROM_ACC_NUM" hidden>
                                <input type="text" class="FROM_LEDGER_ID" id="FROM_ACC_SUB_NUM" name="FROM_ACC_SUB_NUM" hidden>
                                <select class="select-single-with-search FROM_LEDGER_ID" name="FROM_LEDGER_ID" id="FROM_LEDGER_ID" data-placeholder="من حساب" data-width="100%">
                                    <option></option>
                                    @foreach($constants['CustomerAccounts'] as $item)
                                        <option value="{{$item['LEDGER_ID']}}" data-BRANCH_ID="{{$item['BRANCH_ID']}}" data-ACC_NUM="{{$item['ACC_NUM']}}" data-CURR_ID="{{$item['CURR_ID']}}" data-ACC_SUB_NUM="{{$item['ACC_SUB_NUM']}}" data-CURR_NAME="{{$item['CURR_NAME']}}">{{$item['ACCOUNT_NUM']}}, {{$item['LEDGER_NAME_NA']}}, {{$item['ACCOUNT_BALANCE']}} {{$item['CURR_NAME']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">إلى حساب</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" class="TO_LEDGER_ID" id="TO_BRANCH_ID" name="TO_BRANCH_ID" hidden>
                                <input type="text" class="TO_LEDGER_ID" id="TO_CURR_ID" name="TO_CURR_ID" hidden>
                                <input type="text" class="TO_LEDGER_ID" id="TO_ACC_NUM" name="TO_ACC_NUM" hidden>
                                <input type="text" class="TO_LEDGER_ID" id="TO_ACC_SUB_NUM" name="TO_ACC_SUB_NUM" hidden>
                                <select class="select-single-with-search TO_LEDGER_ID" name="TO_LEDGER_ID" id="TO_LEDGER_ID" data-placeholder="إلى حساب" data-width="100%">
                                    <option></option>
                                    @foreach($constants['CustomerAccounts'] as $item)
                                        <option value="{{$item['LEDGER_ID']}}" data-BRANCH_ID="{{$item['BRANCH_ID']}}" data-ACC_NUM="{{$item['ACC_NUM']}}" data-CURR_ID="{{$item['CURR_ID']}}" data-ACC_SUB_NUM="{{$item['ACC_SUB_NUM']}}" data-CURR_NAME="{{$item['CURR_NAME']}}">{{$item['ACCOUNT_NUM']}}, {{$item['LEDGER_NAME_NA']}}, {{$item['ACCOUNT_BALANCE']}} {{$item['CURR_NAME']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center d-none">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">من حساب</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" class="CUST_LEDGER_ID" id="CUST_BRANCH_ID" name="CUST_BRANCH_ID" hidden disabled>
                                <input type="text" class="CUST_LEDGER_ID" id="CUST_CURR_ID" name="CUST_CURR_ID" hidden disabled>
                                <input type="text" class="CUST_LEDGER_ID" id="CUST_ACC_NUM" name="CUST_ACC_NUM" hidden disabled>
                                <input type="text" class="CUST_LEDGER_ID" id="CUST_ACC_SUB_NUM" name="CUST_ACC_SUB_NUM" hidden disabled>
                                <select class="select-single-with-search CUST_LEDGER_ID" name="CUST_LEDGER_ID" id="CUST_LEDGER_ID" data-placeholder="من حساب" data-width="100%" disabled>
                                    <option></option>
                                    @foreach($constants['CustomerAccounts'] as $item)
                                        <option value="{{$item['LEDGER_ID']}}" data-BRANCH_ID="{{$item['BRANCH_ID']}}" data-ACC_NUM="{{$item['ACC_NUM']}}" data-CURR_ID="{{$item['CURR_ID']}}" data-ACC_SUB_NUM="{{$item['ACC_SUB_NUM']}}" data-CURR_NAME="{{$item['CURR_NAME']}}">{{$item['ACCOUNT_NUM']}}, {{$item['LEDGER_NAME_NA']}}, {{$item['ACCOUNT_BALANCE']}} {{$item['CURR_NAME']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row internal_beneficiaries_inputs d-none">
                            <div class="col-12">
                                <div class="col-12 d-flex justify-content-between mb-3">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">المستفيدين</label>
                                    <button class="btn btn-link p-0" type="button" data-bs-toggle="modal" data-bs-target="#addNewInternal">
                                        <i class="fa-solid fa-plus"></i> إضافة مستفيد
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col">المستفيد</th>
                                            <th scope="col" class="text-center">المبلغ</th>
                                            <th scope="col" class="text-center">الغرض</th>
                                            <th scope="col" class="text-center">أدوات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="internal_beneficiaries_table">
                                            <tr class="count-0">
                                                <td colspan="4" class="text-center">لا يوجد مستفيدين الرجاء إضافة مستفيد</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row external_beneficiaries_inputs d-none">
                            <div class="col-12">
                                <div class="col-12 d-flex justify-content-between mb-3">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">المستفيدين</label>
                                    <button class="btn btn-link p-0" type="button" data-bs-toggle="modal" data-bs-target="#addNewExternal">
                                        <i class="fa-solid fa-plus"></i> إضافة مستفيد
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col">المستفيد</th>
                                            <th scope="col" class="text-center">المبلغ</th>
                                            <th scope="col" class="text-center">الغرض</th>
                                            <th scope="col" class="text-center">أدوات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="external_beneficiaries_table">
                                            <tr class="count-0">
                                                <td colspan="4" class="text-center">لا يوجد مستفيدين الرجاء إضافة مستفيد</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">المبلغ</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" class="form-control formattedNumber" name="AMOUNT" id="AMOUNT" placeholder="المبلغ"/>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">عملة الحوالة</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <select class="select-single-with-search currency" id="CURR_ID" name="CURR_ID" data-placeholder="عملة الحوالة" data-width="100%" disabled>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center d-none">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">شامل العمولة</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="INCLUDE_COMMISSION" id="INCLUDE_COMMISSION_1" value="1" disabled>
                                    <label class="form-check-label" for="INCLUDE_COMMISSION_1">نعم</label>
                                </div>
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="INCLUDE_COMMISSION" checked id="INCLUDE_COMMISSION_2" value="2" disabled>
                                    <label class="form-check-label" for="INCLUDE_COMMISSION_2">لا</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">الغرض من الحوالة</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <select class="select-single-with-search" name="REMITTANCE_PURPOSE_ID" id="REMITTANCE_PURPOSE_ID" data-placeholder="الغرض من الحوالة" data-width="100%">
                                    <option></option>
                                    @foreach($constants['RemittancePurposes'] as  $item)
                                        <option value="{{$item['REMITTANCE_PURPOSE_ID']}}">{{$item['REMITTANCE_PURPOSE_NA']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">ملاحظات</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" class="form-control" placeholder="ملاحظات" name="NOTES" id="NOTES" />
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center d-none">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">مرفقات</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="file" class="form-control" id="ATTACHMENTS" multiple name="ATTACHMENTS[]" onchange="loadFile(this)" accept="{{acceptImagePdfType()}}" hidden= />
                                <label type="button" class="btn btn-outline-primary btn-icon btn-icon-only me-1" for="ATTACHMENTS">
                                    <i data-acorn-icon="attachment"></i>
                                </label>
                                <span id="attach_info"></span>
                            </div>
                        </div>
                        <div class="row mb-3 mt-4">
                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                <button type="button" class="btn btn-secondary" id="summary_btn">
                                    <div class="text"><i class="fa-solid fa-money-bill-transfer"></i> فحص</div>
                                    <div class="btn-loader d-none">
                                        <div class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">جاري الإرسال</span>
                                        </div>
                                        <span>جاري الإرسال</span>
                                    </div>
                                </button>
{{--                                <button type="submit" class="btn btn-secondary">--}}
{{--                                    <div class="text"><i class="fa-solid fa-money-bill-transfer"></i> إرسال</div>--}}
{{--                                    <div class="btn-loader d-none">--}}
{{--                                        <div class="spinner-border spinner-border-sm text-light" role="status">--}}
{{--                                            <span class="visually-hidden">جاري الإرسال</span>--}}
{{--                                        </div>--}}
{{--                                        <span>جاري الإرسال</span>--}}
{{--                                    </div>--}}
{{--                                </button>--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="addNewInternal" data-bs-keyboard="false" data-bs-backdrop="static" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel">مستفيد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewInternalForm">
                    <div class="modal-body">
                        <div class="row g-0 py-2 text-center">
                            <div class="sh-3 sh-md-5 fw-bold lh-1-25 h5"><i class="fa-solid fa-circle-info ms-2"></i> مستفيد جديدة</div>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">إلى حساب</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <select class="select-single-with-search" name="BENEFICIARY_ID" id="BENEFICIARY_ID-in" data-placeholder="إلى حساب" data-width="100%">
                                    <option></option>
                                    @foreach($internal_beneficiaries as $item)
                                        <option value="{{$item['BENEFICIARY_ID']}}" data-CURR_ID="{{$item['BENEFICIARY_CURR_ID']}}" data-CURR_NAME="{{$item['BENEFICIARY_CURR_NAME']}}">{{$item['BENEFICIARY_FULL_NAME']}} - {{$item['BANK_ACCOUNT_NUMBER']}} - {{$item['BENEFICIARY_CURR_NAME']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">المبلغ</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" class="form-control formattedNumber" name="AMOUNT" placeholder="المبلغ"/>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">الغرض من الحوالة</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <select class="select-single-with-search" name="REMITTANCE_PURPOSE_ID" data-placeholder="الغرض من الحوالة" data-width="100%">
                                    <option></option>
                                    @foreach($constants['RemittancePurposes'] as  $item)
                                        <option value="{{$item['REMITTANCE_PURPOSE_ID']}}">{{$item['REMITTANCE_PURPOSE_NA']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-secondary">
                            <div class="text"><i class="fa-solid fa-plus"></i> حفظ</div>
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

    <div class="modal fade" id="addNewExternal" data-bs-keyboard="false" data-bs-backdrop="static" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel">مستفيد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addNewExternalForm">
                    <div class="modal-body">
                        <div class="row g-0 py-2 text-center">
                            <div class="sh-3 sh-md-5 fw-bold lh-1-25 h5"><i class="fa-solid fa-circle-info ms-2"></i> مستفيد جديدة</div>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">إلى حساب</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <select class="select-single-with-search" name="BENEFICIARY_ID" id="BENEFICIARY_ID-out" data-placeholder="إلى حساب" data-width="100%">
                                    <option></option>
                                    @foreach($external_beneficiaries as $item)
                                        <option value="{{$item['BENEFICIARY_ID']}}">{{$item['BENEFICIARY_FULL_NAME']}} - {{$item['BANK_NAME']}} - {{$item['BANK_BRANCH_NAME']}} - {{$item['IBAN']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">المبلغ</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" class="form-control formattedNumber" name="AMOUNT" placeholder="المبلغ"/>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">الغرض من الحوالة</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <select class="select-single-with-search" name="REMITTANCE_PURPOSE_ID" data-placeholder="الغرض من الحوالة" data-width="100%">
                                    <option></option>
                                    @foreach($constants['RemittancePurposes'] as  $item)
                                        <option value="{{$item['REMITTANCE_PURPOSE_ID']}}">{{$item['REMITTANCE_PURPOSE_NA']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-secondary">
                            <div class="text"><i class="fa-solid fa-plus"></i> حفظ</div>
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

    <div class="modal fade" id="transfer_confirm" data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addnewLabel">تأكيد طلب الحوالة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-secondary" id="confirm_transfer">
                        <div class="text"><i class="fa-solid fa-money-bill-transfer"></i> تأكيد</div>
                        <div class="btn-loader d-none">
                            <div class="spinner-border spinner-border-sm text-light" role="status">
                                <span class="visually-hidden">جاري الإرسال</span>
                            </div>
                            <span>جاري الإرسال</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('portal_v2.components.code_modal')
@endsection

@push('style')
    <style>
        .select2-results__options .select2-results__option[aria-disabled="true"]{
            background: rgba(var(--separator-rgb), 0.5) !important;
            border-color: rgba(var(--separator-rgb), 0.5) !important;
            color: var(--muted);
            border-radius: var(--border-radius-sm);
        }
    </style>
@endpush

@push('script')
    <script>

        $('#addNewInternal, #addNewExternal').on('hidden.bs.modal', function (event) {
            $(this).find('.alert.alert-danger').addClass('d-none');
            let form = $(this).find('form');
            form.trigger('reset');
            form.find('.row_id').remove();
            form.find('select').val(null).trigger('change');
            form.find('.select2.full').removeClass('full');
        })

        $(document).on('submit', '#addNewInternalForm', function (e) {
            let form = $(this);
            let table = $('#internal_beneficiaries_table');

            let BENEFICIARY_ID_value = form.find('[name="BENEFICIARY_ID"]').val();
            let BENEFICIARY_ID_text = form.find('[name="BENEFICIARY_ID"] option:selected').text();
            let AMOUNT_value = form.find('[name="AMOUNT"]').val();
            let AMOUNT_text = form.find('[name="AMOUNT"]').siblings('.input-number').val();
            let REMITTANCE_PURPOSE_ID_value = form.find('[name="REMITTANCE_PURPOSE_ID"]').val();
            let REMITTANCE_PURPOSE_ID_text = form.find('[name="REMITTANCE_PURPOSE_ID"] option:selected').text();
            let row_id = form.find('.row_id').val();

            if(BENEFICIARY_ID_value && AMOUNT_value && REMITTANCE_PURPOSE_ID_value){
                let count = table.find('tr').length;
                let row = '<td>' + BENEFICIARY_ID_text +
                    '<input type="text" hidden class="BENEFICIARY_ID" name="BENEFICIARY_ID[]" value="'+BENEFICIARY_ID_value+'">' +
                    '</td>' +
                    '<td class="text-center">' + AMOUNT_text +
                    '<input type="text" hidden class="AMOUNT" name="AMOUNT[]" value="'+AMOUNT_value+'">' +
                    '</td>' +
                    '<td class="text-center">' + REMITTANCE_PURPOSE_ID_text +
                    '<input type="text" hidden class="REMITTANCE_PURPOSE_ID" name="REMITTANCE_PURPOSE_ID[]" value="'+REMITTANCE_PURPOSE_ID_value+'">' +
                    '</td>' +
                    '<td class="text-center">' +
                    '<button type="button" class="internal_edit_row btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top mx-1" data-bs-toggle="tooltip" data-bs-title="إلغاء المستفيد">' +
                    '<i class="fa-solid fa-pen-to-square"></i>' +
                    '</button>' +
                    '<button type="button" class="remove_row btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top mx-1" data-bs-toggle="tooltip" data-bs-title="إلغاء المستفيد">' +
                    '<i class="fa-solid fa-circle-xmark"></i>' +
                    '</button>' +
                    '</td>';

                if(row_id){
                    table.find('#'+row_id).html(row);
                }else{
                    row = '<tr id="internal-'+count+'">' + row + '</tr>';
                    table.find('.count-0').addClass('d-none')
                    table.append(row);
                }
                $('#addNewInternal').modal('hide');
            }else{
                errorShow(form, 'كل الحقول مطلوبة');
            }

            return false;
        });

        $(document).on('submit', '#addNewExternalForm', function (e) {
            let form = $(this);
            let table = $('#external_beneficiaries_table');

            let BENEFICIARY_ID_value = form.find('[name="BENEFICIARY_ID"]').val();
            let BENEFICIARY_ID_text = form.find('[name="BENEFICIARY_ID"] option:selected').text();
            let AMOUNT_value = form.find('[name="AMOUNT"]').val();
            let AMOUNT_text = form.find('[name="AMOUNT"]').siblings('.input-number').val();
            let REMITTANCE_PURPOSE_ID_value = form.find('[name="REMITTANCE_PURPOSE_ID"]').val();
            let REMITTANCE_PURPOSE_ID_text = form.find('[name="REMITTANCE_PURPOSE_ID"] option:selected').text();
            let row_id = form.find('.row_id').val();

            if(BENEFICIARY_ID_value && AMOUNT_value && REMITTANCE_PURPOSE_ID_value){
                let count = table.find('tr').length;
                let row = '<td>' + BENEFICIARY_ID_text +
                    '<input type="text" hidden class="BENEFICIARY_ID" name="BENEFICIARY_ID[]" value="'+BENEFICIARY_ID_value+'">' +
                    '</td>' +
                    '<td class="text-center">' + AMOUNT_text +
                    '<input type="text" hidden class="AMOUNT" name="AMOUNT[]" value="'+AMOUNT_value+'">' +
                    '</td>' +
                    '<td class="text-center">' + REMITTANCE_PURPOSE_ID_text +
                    '<input type="text" hidden class="REMITTANCE_PURPOSE_ID" name="REMITTANCE_PURPOSE_ID[]" value="'+REMITTANCE_PURPOSE_ID_value+'">' +
                    '</td>' +
                    '<td class="text-center">' +
                    '<button type="button" class="external_edit_row btn btn-sm btn-icon btn-icon-only btn-outline-secondary align-top mx-1" data-bs-toggle="tooltip" data-bs-title="إلغاء المستفيد">' +
                    '<i class="fa-solid fa-pen-to-square"></i>' +
                    '</button>' +
                    '<button type="button" class="remove_row btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top mx-1" data-bs-toggle="tooltip" data-bs-title="إلغاء المستفيد">' +
                    '<i class="fa-solid fa-circle-xmark"></i>' +
                    '</button>' +
                    '</td>';

                if(row_id){
                    table.find('#'+row_id).html(row);
                }else{
                    row = '<tr id="external-'+count+'">' + row + '</tr>';
                    table.find('.count-0').addClass('d-none')
                    table.append(row);
                }

                if(table.find('tr').not('.count-0').length > 1){
                    $('input[name="INCLUDE_COMMISSION"]').parents('.row').addClass('d-none');
                    $('input[name="INCLUDE_COMMISSION"]').attr('disabled', 'true');
                }else{
                    $('input[name="INCLUDE_COMMISSION"]').parents('.row').removeClass('d-none');
                    $('input[name="INCLUDE_COMMISSION"]').removeAttr('disabled');
                }
                $('#addNewExternal').modal('hide');
            }else{
                errorShow(form, 'كل الحقول مطلوبة');
            }

            return false;
        });

        $(document).on('click', '.internal_edit_row', function (e) {
            let row = $(this).parents('tr');

            let BENEFICIARY_ID_value = row.find('.BENEFICIARY_ID').val();
            let AMOUNT_value = row.find('.AMOUNT').val();
            let REMITTANCE_PURPOSE_ID_value = row.find('.REMITTANCE_PURPOSE_ID').val();

            let form = $('#addNewInternalForm')
            form.find('[name="BENEFICIARY_ID"]').val(BENEFICIARY_ID_value).trigger('change');
            form.find('[name="AMOUNT"]').val(AMOUNT_value).trigger('input');
            form.find('[name="REMITTANCE_PURPOSE_ID"]').val(REMITTANCE_PURPOSE_ID_value).trigger('change');
            form.prepend('<input type="text" hidden value="'+row.attr('id')+'" class="row_id">');

            $('#addNewInternal').modal('show');
        });

        $(document).on('click', '.external_edit_row', function (e) {
            let row = $(this).parents('tr');

            let BENEFICIARY_ID_value = row.find('.BENEFICIARY_ID').val();
            let AMOUNT_value = row.find('.AMOUNT').val();
            let REMITTANCE_PURPOSE_ID_value = row.find('.REMITTANCE_PURPOSE_ID').val();

            let form = $('#addNewExternalForm')
            form.find('[name="BENEFICIARY_ID"]').val(BENEFICIARY_ID_value).trigger('change');
            form.find('[name="AMOUNT"]').val(AMOUNT_value).trigger('input');
            form.find('[name="REMITTANCE_PURPOSE_ID"]').val(REMITTANCE_PURPOSE_ID_value).trigger('change');
            form.prepend('<input type="text" hidden value="'+row.attr('id')+'" class="row_id">');

            $('#addNewExternal').modal('show');
        });

        $(document).on('click', '.remove_row', function (e) {
            let row = $(this).parents('tr');
            let tbody = $(this).parents('tbody');
            row.remove();
            if(tbody.find('tr').length == 1){
                tbody.find('.count-0').removeClass('d-none');
            }
        });

        $(document).on('change', 'input[name="transfer_type"]', function (e) {
            let value = $('input[name="transfer_type"]:checked').val();
            let form = $(this).closest('form');
            errorHide(form);
            resetForm(form);
            form.find('.row.d-none').removeClass('d-none');
            form.find(':disabled').removeAttr('disabled');
            form.find('table tbody tr').not('.count-0').remove();
            form.find('table tbody tr.count-0').removeClass('d-none');
            if(value == 8) {
                form.find('.FROM_LEDGER_ID').parents('.row').addClass('d-none');
                form.find('.FROM_LEDGER_ID').attr('disabled', 'true');
                form.find('.TO_LEDGER_ID').parents('.row').addClass('d-none');
                form.find('.TO_LEDGER_ID').attr('disabled', 'true');
                form.find('input[name="INCLUDE_COMMISSION"]').parents('.row').addClass('d-none');
                form.find('input[name="INCLUDE_COMMISSION"]').attr('disabled', 'true');
                form.find('#ATTACHMENTS').parents('.row').addClass('d-none');
                form.find('#ATTACHMENTS').attr('disabled', 'true');
                form.find('.internal_beneficiaries_warning.d-none').removeClass('d-none');

                form.find('.external_beneficiaries_inputs').addClass('d-none');
                form.find('.external_beneficiaries_inputs input').attr('disabled', 'true');

                form.find('#AMOUNT').parents('.row').addClass('d-none');
                form.find('#AMOUNT').attr('disabled', 'true');
                form.find('#REMITTANCE_PURPOSE_ID').parents('.row').addClass('d-none');
                form.find('#REMITTANCE_PURPOSE_ID').attr('disabled', 'true');
            }else if(value == 7){
                form.find('.FROM_LEDGER_ID').parents('.row').addClass('d-none');
                form.find('.FROM_LEDGER_ID').attr('disabled', 'true');
                form.find('.TO_LEDGER_ID').parents('.row').addClass('d-none');
                form.find('.TO_LEDGER_ID').attr('disabled', 'true');

                form.find('.internal_beneficiaries_inputs').addClass('d-none');
                form.find('.internal_beneficiaries_inputs input').attr('disabled', 'true');

                form.find('#AMOUNT').parents('.row').addClass('d-none');
                form.find('#AMOUNT').attr('disabled', 'true');
                form.find('#REMITTANCE_PURPOSE_ID').parents('.row').addClass('d-none');
                form.find('#REMITTANCE_PURPOSE_ID').attr('disabled', 'true');

                setCURR_ID();
            }else{
                form.find('.CUST_LEDGER_ID').parents('.row').addClass('d-none');
                form.find('.CUST_LEDGER_ID').attr('disabled', 'true');
                form.find('#BENEFICIARY_ID-in').parents('.row').addClass('d-none');
                form.find('#BENEFICIARY_ID-in').attr('disabled', 'true');
                form.find('#BENEFICIARY_ID-out').parents('.row').addClass('d-none');
                form.find('#BENEFICIARY_ID-out').attr('disabled', 'true');
                form.find('input[name="INCLUDE_COMMISSION"]').parents('.row').addClass('d-none');
                form.find('input[name="INCLUDE_COMMISSION"]').attr('disabled', 'true');
                form.find('#ATTACHMENTS').parents('.row').addClass('d-none');
                form.find('#ATTACHMENTS').attr('disabled', 'true');

                form.find('.internal_beneficiaries_inputs').addClass('d-none');
                form.find('.internal_beneficiaries_inputs input').attr('disabled', 'true');
                form.find('.external_beneficiaries_inputs').addClass('d-none');
                form.find('.external_beneficiaries_inputs input').attr('disabled', 'true');
            }
        });

        function setCURR_ID(){
            let select = $('#CURR_ID');
            select.find('option').remove();
            select.append('<option></option>');
            let list = {!!json_encode($currencies)!!};
            $.each(list, function( index, value ) {
                select.append('<option value="'+value['VALUE']+'">'+value['LABEL']+'</option>');
            });
            select.parents('.row').removeClass('d-none');
            select.removeAttr('disabled');
        }

        $('#FROM_LEDGER_ID').on('change', function (){
            let elem = $(this).find('option:selected');
            let value = $(this).val();
            if(value){
                let FROM_BRANCH_ID = elem.attr('data-BRANCH_ID');
                let FROM_CURR_ID = elem.attr('data-CURR_ID');
                let FROM_ACC_NUM = elem.attr('data-ACC_NUM');
                let FROM_ACC_SUB_NUM = elem.attr('data-ACC_SUB_NUM');

                $('#FROM_BRANCH_ID').val(FROM_BRANCH_ID);
                $('#FROM_CURR_ID').val(FROM_CURR_ID);
                $('#FROM_ACC_NUM').val(FROM_ACC_NUM);
                $('#FROM_ACC_SUB_NUM').val(FROM_ACC_SUB_NUM);

                setCurrencyID();

                $('#TO_LEDGER_ID').val(null).trigger('change');
                $('#TO_LEDGER_ID').removeClass('full');
                $('#TO_LEDGER_ID option').removeAttr('disabled');
                $('#TO_LEDGER_ID option[value="'+value+'"][data-branch_id="'+FROM_BRANCH_ID+'"][data-acc_num="'+FROM_ACC_NUM+'"][data-curr_id="'+FROM_CURR_ID+'"][data-acc_sub_num="'+FROM_ACC_SUB_NUM+'"]').attr('disabled', 'true');
            }
        });

        $('#TO_LEDGER_ID').on('change', function (){
            let elem = $(this).find('option:selected');
            if(elem.val()){
                $('#TO_BRANCH_ID').val(elem.attr('data-BRANCH_ID'));
                $('#TO_CURR_ID').val(elem.attr('data-CURR_ID'));
                $('#TO_ACC_NUM').val(elem.attr('data-ACC_NUM'));
                $('#TO_ACC_SUB_NUM').val(elem.attr('data-ACC_SUB_NUM'));
                setCurrencyID();
            }
        });

        $('#CUST_LEDGER_ID').on('change', function (){
            let elem = $(this).find('option:selected');
            if(elem.val()){
                $('#CUST_BRANCH_ID').val(elem.attr('data-BRANCH_ID'));
                $('#CUST_CURR_ID').val(elem.attr('data-CURR_ID'));
                $('#CUST_ACC_NUM').val(elem.attr('data-ACC_NUM'));
                $('#CUST_ACC_SUB_NUM').val(elem.attr('data-ACC_SUB_NUM'));
                if($('input[name="transfer_type"]:checked').val()!=7){
                    setCurrencyID();
                }
            }
        });

        // $('#BENEFICIARY_ID-in').on('change', function (){
        //     let elem = $(this).find('option:selected');
        //     if(elem.val()){
        //         setCurrencyID();
        //     }
        // });

        function setCurrencyID(){
            let select = $('#CURR_ID');
            select.attr('disabled', 'disabled');
            select.find('option').remove();
            select.append('<option></option>');
            let FROM_LEDGER_ID = $('#FROM_LEDGER_ID');
            let TO_LEDGER_ID = $('#TO_LEDGER_ID');
            let CUST_LEDGER_ID = $('#CUST_LEDGER_ID');
            let BENEFICIARY_ID_in = $('#BENEFICIARY_ID-in');
            if(!FROM_LEDGER_ID.is(":disabled") && FROM_LEDGER_ID.val()){
                let elem = FROM_LEDGER_ID.find('option:selected');
                select.find('option[value="'+elem.attr('data-CURR_ID')+'"]').remove();
                select.append('<option value="'+elem.attr('data-CURR_ID')+'">'+elem.attr('data-CURR_NAME')+'</option>');
            }
            if(!TO_LEDGER_ID.is(":disabled") && TO_LEDGER_ID.val()){
                let elem = TO_LEDGER_ID.find('option:selected');
                select.find('option[value="'+elem.attr('data-CURR_ID')+'"]').remove();
                select.append('<option value="'+elem.attr('data-CURR_ID')+'">'+elem.attr('data-CURR_NAME')+'</option>');
            }
            if(!CUST_LEDGER_ID.is(":disabled") && CUST_LEDGER_ID.val()){
                let elem = CUST_LEDGER_ID.find('option:selected');
                select.find('option[value="'+elem.attr('data-CURR_ID')+'"]').remove();
                select.append('<option value="'+elem.attr('data-CURR_ID')+'">'+elem.attr('data-CURR_NAME')+'</option>');
            }
            // if(!BENEFICIARY_ID_in.is(":disabled") && BENEFICIARY_ID_in.val()){
            //     let elem = BENEFICIARY_ID_in.find('option:selected');
            //     select.find('option[value="'+elem.attr('data-CURR_ID')+'"]').remove();
            //     select.append('<option value="'+elem.attr('data-CURR_ID')+'">'+elem.attr('data-CURR_NAME')+'</option>');
            // }
            select.removeAttr('disabled');
        }

        $(document).on('click', '#summary_btn', function (e){
            e.preventDefault();
            let form = $('#form_data');
            let btn = $(this);
            btnLoaderStart(btn);
            errorHide(form);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.transfers.check')}}',
                data: new FormData(form[0]),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if(response.status){
                        $('#transfer_confirm .modal-body').html(response.html);
                        let value = $('input[name="transfer_type"]:checked').val();
                        let from = '', to = '';
                        let from_curr = '', to_curr = '';
                        if(value == 8){
                            from = $('#CUST_LEDGER_ID option:selected').text();
                            to = $('#BENEFICIARY_ID-in option:selected').text();
                            from_curr = $('#CUST_LEDGER_ID option:selected').attr('data-CURR_NAME');
                            to_curr = $('#BENEFICIARY_ID-in option:selected').attr('data-CURR_NAME');
                        }else if(value == 7){
                            from = $('#CUST_LEDGER_ID option:selected').text();
                            to = $('#BENEFICIARY_ID-out option:selected').text();
                            from_curr = $('#CUST_LEDGER_ID option:selected').attr('data-CURR_NAME');
                            to_curr = $('#CURR_ID option:selected').text();
                        }else{
                            from = $('#FROM_LEDGER_ID option:selected').text();
                            to = $('#TO_LEDGER_ID option:selected').text();
                            from_curr = $('#FROM_LEDGER_ID option:selected').attr('data-CURR_NAME');
                            to_curr = $('#TO_LEDGER_ID option:selected').attr('data-CURR_NAME');
                        }
                        $('#transfer_confirm .modal-body .from_account').html(from);
                        $('#transfer_confirm .modal-body .to_account').html(to);
                        $('#transfer_confirm .modal-body .from_curr').html(from_curr);
                        $('#transfer_confirm .modal-body .to_curr').html(to_curr);
                        $('#transfer_confirm').modal('show');
                        btnLoaderEnd(btn);
                    }else{
                        errorShow(form, response.msg);
                        btnLoaderEnd(btn);
                    }
                },
                error: function (response) {
                    let error = '';
                    $.each(response.responseJSON.errors, function (i, value) {
                        error += value + '<br>';
                    });
                    errorShow(form, error);
                    btnLoaderEnd(btn);
                }
            })
        });

        $(document).on('click', '#confirm_transfer', function (e){
            e.preventDefault();
            let form = $('#confirm_form');
            let btn = $(this);
            errorHide(form);
            btnLoaderStart(btn);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.transfers.submit')}}',
                data: new FormData(document.getElementById('form_data')),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if(response.status){
                        $('#transfer_confirm').modal('hide');
                        $('#code_modal').modal('show');
                        countDown();
                    }else{
                        errorShow(form, response.msg);
                        btnLoaderEnd(btn);
                    }
                },
                error: function (response) {
                    $.each(response.responseJSON.errors, function (index, value) {
                        form.find("input[name='"+index+"']").addClass('border-danger');
                        form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                        form.find("select[name='"+index+"']").addClass('border-danger');
                        form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                    });
                    btnLoaderEnd(btn);
                }
            })
        });

        $(document).on('submit', '#verify_code', function (e){
            e.preventDefault();
            let form = $(this);
            let formData = new FormData(document.getElementById('form_data'));
            formData.append('code_is_required', 1);
            let code = form.find('#code4').val()+''+form.find('#code3').val()+''+form.find('#code2').val()+''+form.find('#code1').val();
            formData.append('VERIFY_CODE', code);
            loaderStart(form);
            errorHide(form);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.transfers.submit')}}',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if(response.status){
                        $('#code_modal').modal('hide');
                        SwalModal2(response.msg, 'success', response.url);
                    }else{
                        errorShow(form, response.msg);
                        loaderEnd(form);
                    }
                },
                error: function (response) {
                    let valMsg = '';
                    $.each(response.responseJSON.errors, function (index, value) {
                        valMsg = valMsg + ' ' + value;
                    });
                    errorShow(form, valMsg);
                    loaderEnd(form);
                }
            })
        });

        $(document).on('click', '#resend_code', function (e){
            e.preventDefault();
            let btn = $(this);
            btnLoaderStart(btn);
            let verify_code_form = $('#verify_code');
            verify_code_form.find('#code1').val('');
            verify_code_form.find('#code2').val('');
            verify_code_form.find('#code3').val('');
            verify_code_form.find('#code4').val('');
            verify_code_form.find('.alert.alert-danger').addClass('d-none');
            let form = $('#form_data');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: form.attr('action'),
                data: new FormData(document.getElementById('form_data')),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response.status) {
                        successShow(verify_code_form, response.msg);
                        btnLoaderEnd(btn);
                        countDown();
                    } else {
                        errorShow(verify_code_form, response.msg);
                        btnLoaderEnd(btn);
                    }
                },
                error: function (response) {
                    let valMsg = '';
                    $.each(response.responseJSON.errors, function (index, value) {
                        valMsg = valMsg + ' ' + value;
                    });
                    errorShow(verify_code_form, valMsg);
                    loaderEnd(form);
                }
            })
        });

        $(document).ready(function() {
            $('#code_modal').on('hidden.bs.modal', function (e) {
                let verify_code_form = $('#verify_code');
                verify_code_form.find('#code1').val('');
                verify_code_form.find('#code2').val('');
                verify_code_form.find('#code3').val('');
                verify_code_form.find('#code4').val('');
                verify_code_form.find('.alert.alert-danger').addClass('d-none');
            });

            $('#code4').on('keyup', function (){
                $('#code3').focus();
            });
            $('#code3').on('keyup', function (){
                $('#code2').focus();
            });
            $('#code2').on('keyup', function (){
                $('#code1').focus();
            });
        });

        function countDown(timer2="1:00"){
            $('#resend_code').attr('disabled', 'true');
            let interval = setInterval(function() {
                let timer = timer2.split(':');
                //by parsing integer, I avoid all extra string processing
                let minutes = parseInt(timer[0], 10);
                let seconds = parseInt(timer[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;

                if (minutes < 0){
                    clearInterval(interval);
                    // minutes = 0;
                }

                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10 && seconds > 0) ? '0' + seconds : seconds;

                $('#countdown').html(minutes + ':' + seconds);
                timer2 = minutes + ':' + seconds;

                if(minutes == -1 && seconds == 59){
                    clearInterval(interval)
                    $('#countdown').html('0:0');
                    $('#resend_code').removeAttr('disabled');
                    return false;
                }
            }, 1000);
        }

        function resetForm(form){
            // form.trigger('reset');
            form.find(':input[type!="radio"]').val('');
            form.find('select').val(null).trigger('change');
            form.find('.select2.full').removeClass('full');
            form.find('#CURR_ID').find('option[value!=""]').remove();
            form.find('.invalid-feedback').remove();
            form.find('input.border-danger').removeClass('border-danger');
        }

        function btnLoaderStart(btn){
            btn.attr('disabled', true);
            btn.find('.text').addClass('d-none');
            btn.find('.btn-loader').removeClass('d-none');
        }
        function btnLoaderEnd(btn){
            btn.attr('disabled', false);
            btn.find('.text').removeClass('d-none');
            btn.find('.btn-loader').addClass('d-none');
        }
        var loadFile = function (event) {
            let attach = event.files;
            let count = attach.length;
            if(count == 1){
                $('#attach_info').html(attach[0].name)
            }else{
                $('#attach_info').html(count+' مرفقات');
            }
        };
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
