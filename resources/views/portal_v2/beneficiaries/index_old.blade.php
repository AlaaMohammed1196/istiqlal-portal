@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">المستفيدين</h1>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Responsive Tabs Start -->
        <section class="scroll-section  position-relative" id="responsiveTabs">
            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                <button type="button" class="btn btn-secondary w-100 w-sm-auto mb-2 position-absolute top-m-30 create_new"><i class="fa-solid fa-plus"></i> إضافة مستفيد جديد</button>
            </div>
            <div class="card mb-3 mt-5">
                <div class="card-header border-0 pb-0">
                    <ul class="nav nav-tabs nav-tabs-line card-header-tabs responsive-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#first" role="tab" type="button" aria-selected="true">
                                الكل
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#second" role="tab" type="button" aria-selected="false">داخل البنك</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#third" role="tab" type="button" aria-selected="false">بنوك محلية</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#fourth" role="tab" type="button" aria-selected="false">بنوك دولية </button>
                        </li>
                        <!-- An empty list to put overflowed links -->
                        <li class="nav-item dropdown ms-auto pe-0 d-none responsive-tab-dropdown">
                            <button
                                class="btn btn-icon btn-icon-only btn-foreground mt-2"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                <i data-acorn-icon="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu mt-2 dropdown-menu-end"></ul>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        @include('portal_v2.beneficiaries.table')
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="addnew" data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel">إضافة مستفيد جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add_new" action="{{route('portal.v2.beneficiaries.store')}}">
                    <div class="modal-body wizard" id="wizardBasic">
                        <div class="row g-0 py-2 text-center">
                            <div class="sh-3 sh-md-5 fw-bold lh-1-25 h5"><i class="fa-solid fa-user-plus  ms-2"></i> مستفيد جديد</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12 col-md-12 text-center">
                                @foreach($types as $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="BANK_LOCATION" id="BANK_LOCATION-{{$item['VALUE']}}"
                                           value="{{$item['VALUE']}}" {{$item['VALUE']==3?'checked':''}}>
                                    <label class="form-check-label" for="BANK_LOCATION-{{$item['VALUE']}}">{{$item['LABEL']}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="BENEFICIARY_FULL_NAME" id="BENEFICIARY_FULL_NAME" placeholder="الاسم" />
                            <label>الاسم</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="BENEFICIARY_ADDRESS" id="BENEFICIARY_ADDRESS" placeholder="عنوان المستفيد" />
                            <label>عنوان المستفيد</label>
                        </div>
                        <div class="form-floating mb-4 w-100 d-none">
                            <select class="select-floating-with-search getBankBranches" name="BANK_ID" id="BANK_ID" disabled>
                                <option value=""></option>
                                @foreach($banks as $item)
                                    <option value="{{$item['BANK_ID']}}">{{$item['BANK_DESC']}}</option>
                                @endforeach
                            </select>
                            <label>اسم البنك</label>
                        </div>
                        <div class="form-floating mb-4 d-none">
                            <input type="text" class="form-control" name="BANK_NAME" id="BANK_NAME" disabled placeholder="عنوان المستفيد" />
                            <label>اسم البنك</label>
                        </div>
                        <div class="form-floating mb-4 w-100 d-none">
                            <select class="select-floating-with-search displayBankBranches" name="BANK_BRANCH_ID" id="BANK_BRANCH_ID" disabled>
                                <option></option>
                            </select>
                            <label>اسم فرع البنك</label>
                        </div>
                        <div class="form-floating mb-4 d-none">
                            <input type="text" class="form-control" name="BANK_BRANCH_NAME" id="BANK_BRANCH_NAME" disabled placeholder="عنوان المستفيد" />
                            <label>اسم فرع البنك</label>
                        </div>
                        <div class="form-floating mb-4 d-none">
                            <input type="text" class="form-control" name="IBAN" id="IBAN" placeholder="رقم الحساب الدولي" disabled />
                            <label>رقم الحساب الدولي</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="BANK_ACCOUNT_NUMBER" id="BANK_ACCOUNT_NUMBER" placeholder="حساب المستفيد" value="" />
                            <label>حساب المستفيد</label>
                        </div>
                        <div class="form-floating mb-4 d-none">
                            <input type="text" class="form-control" name="SWIFT_CODE" id="SWIFT_CODE" disabled placeholder="كود Swift" />
                            <label>كود Swift</label>
                        </div>
                        <div class="form-floating mb-3 w-100">
                            <select class="select-floating-with-search" name="BENEFICIARY_CURR_ID" id="BENEFICIARY_CURR_ID">
                                <option value=""></option>
                                @foreach($currencies as $item)
                                    <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                @endforeach
                            </select>
                            <label>عملة الحساب</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="NOTES" placeholder="ملاحظات" value="" />
                            <label>ملاحظات</label>
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

@endsection

@push('style')

@endpush

@push('script')
    <script>
        let beneficiaries_list = {!! json_encode($beneficiaries) !!};

        $(document).on('click', '.create_new', function (e) {
            let form = $('#add_new');
            form.prop('action', '{{route('portal.v2.beneficiaries.store')}}');
            form.find('#BENEFICIARY_ID').remove();
            form.trigger('reset');
            form.find('select').val(null).trigger('change');
            form.find('.select2.full').removeClass('full');
            $("#BANK_LOCATION-3").attr('checked', true).trigger('change');
            $('#addnew').modal('show');
        });

        $(document).on('click', '.edit_row', function (e) {
            let form = $('#add_new');
            form.prop('action', '{{route('portal.v2.beneficiaries.update')}}');
            let index = $(this).data('index');
            let data = beneficiaries_list[index];
            console.log(beneficiaries_list, data);
            form.append('<input type="text" id="BENEFICIARY_ID" name="BENEFICIARY_ID" value="'+data['BENEFICIARY_ID']+'" hidden>');
            $('#BENEFICIARY_FULL_NAME').val(data['BENEFICIARY_FULL_NAME']);
            $('#BENEFICIARY_ADDRESS').val(data['BENEFICIARY_ADDRESS']);
            $('#BANK_ACCOUNT_NUMBER').val(data['BANK_ACCOUNT_NUMBER']);
            $('#BENEFICIARY_CURR_ID').val(data['BENEFICIARY_CURR_ID']);
            $('#NOTES').val(data['NOTES']);
            $('#BANK_NAME').val(data['BANK_NAME']);
            $('#BANK_BRANCH_NAME').val(data['BANK_BRANCH_NAME']);
            $('#IBAN').val(data['IBAN']);
            $('#SWIFT_CODE').val(data['SWIFT_CODE']);
            $('#BANK_ID').val(data['BANK_ID']).trigger('change');
            $('#BANK_BRANCH_ID').val(data['BANK_BRANCH_ID']);
            $('#BANK_LOCATION-'+data['BANK_LOCATION_ID']).attr('checked', true).trigger('change');
            $('#addnew').modal('show');
        });

        $(document).on('change', 'input[name="BANK_LOCATION"]', function (e) {
            let value = $('input[name="BANK_LOCATION"]:checked').val();
            let form = $(this).closest('form');
            form.find('.modal-body .form-floating.d-none').removeClass('d-none');
            form.find('.modal-body :disabled').removeAttr('disabled');
            if(value == 2) {
                form.find('#BANK_ID').parent().addClass('d-none');
                form.find('#BANK_ID').attr('disabled', 'true');
                form.find('#BANK_BRANCH_ID').parent().addClass('d-none');
                form.find('#BANK_BRANCH_ID').attr('disabled', 'true');
                form.find('#BANK_ACCOUNT_NUMBER').parent().addClass('d-none');
                form.find('#BANK_ACCOUNT_NUMBER').attr('disabled', 'true');
                form.find('#BENEFICIARY_CURR_ID').parent().addClass('d-none');
                form.find('#BENEFICIARY_CURR_ID').attr('disabled', 'true');
            }else if(value == 1){
                form.find('#BANK_NAME').parent().addClass('d-none');
                form.find('#BANK_NAME').attr('disabled', 'true');
                form.find('#BANK_BRANCH_NAME').parent().addClass('d-none');
                form.find('#BANK_BRANCH_NAME').attr('disabled', 'true');
                form.find('#BANK_ACCOUNT_NUMBER').parent().addClass('d-none');
                form.find('#BANK_ACCOUNT_NUMBER').attr('disabled', 'true');
                form.find('#SWIFT_CODE').parent().addClass('d-none');
                form.find('#SWIFT_CODE').attr('disabled', 'true');
                form.find('#BENEFICIARY_CURR_ID').parent().addClass('d-none');
                form.find('#BENEFICIARY_CURR_ID').attr('disabled', 'true');
            }else{
                form.find('#BANK_ID').parent().addClass('d-none');
                form.find('#BANK_ID').attr('disabled', 'true');
                form.find('#BANK_BRANCH_ID').parent().addClass('d-none');
                form.find('#BANK_BRANCH_ID').attr('disabled', 'true');
                form.find('#BANK_NAME').parent().addClass('d-none');
                form.find('#BANK_NAME').attr('disabled', 'true');
                form.find('#BANK_BRANCH_NAME').parent().addClass('d-none');
                form.find('#BANK_BRANCH_NAME').attr('disabled', 'true');
                form.find('#IBAN').parent().addClass('d-none');
                form.find('#IBAN').attr('disabled', 'true');
                form.find('#SWIFT_CODE').parent().addClass('d-none');
                form.find('#SWIFT_CODE').attr('disabled', 'true');
            }
        });

        $('.getBankBranches').on('change', function (e) {
            e.preventDefault();
            let ele = $('.displayBankBranches');
            ele.prop('disabled', true);
            let val = $(this).val();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.bank.branches')}}',
                data: {
                    'id': val,
                },
                success: function (response) {
                    ele.html(response.html);
                    ele.prop('disabled', false);
                },
                error: function (response) {
                }
            })
        });

        $('#add_new').on('submit', function (e){
            e.preventDefault();
            let form = $(this);
            loaderStart(form)
            form.validate();
            if(!$(this).valid()){
                loaderEnd(form);
                return false;
            }
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
                    if(response.status){
                        beneficiaries_list = response.beneficiaries;
                        $('.tab-content').html(response.html);
                        loaderEnd(form);
                        $('#addnew').modal('hide');
                        toastr.success(response.msg);
                    }else{
                        errorShow(form, response.msg);
                        loaderEnd(form);
                    }
                },
                error: function (response) {
                    $.each(response.responseJSON.errors, function (index, value) {
                        showValidationError(form, index, value);
                    });
                    loaderEnd(form);
                }
            })
        });

        $(document).on('click', '.delete_row', function (e){
            e.preventDefault();
            let btn = $(this);
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
                        url: '{{route('portal.v2.beneficiaries.delete')}}',
                        type: 'POST',
                        data: {
                            'id': id,
                        },
                        success: function (response) {
                            if(response.status){
                                beneficiaries_list = response.beneficiaries;
                                $('.tab-content').html(response.html);
                                SwalModal2(response.msg, 'success');
                            }else{
                                SwalModal2(response.msg, 'error');
                            }
                        },
                    });
                }
            });
        });

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
