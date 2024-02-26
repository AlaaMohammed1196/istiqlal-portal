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

                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.beneficiaries.index')}}">المستفيدين</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">تعديل مستفيد</a></li>
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
                <form id="add_new" action="{{route('portal.v2.beneficiaries.submit')}}">
                    <div class="card-body">
                        <div class="row g-0 py-2 text-center">
                            <div class="sh-3 sh-md-5 fw-bold lh-1-25 h5"><i class="fa-solid fa-user-plus ms-2"></i>  تعديل بيانات مستفيد</div>
                        </div>
                        <div class="row mb-4 d-none">
                            <div class="col-12 col-md-12 text-center">
                                @foreach($types as $item)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="BANK_LOCATION" id="BANK_LOCATION-{{$item['VALUE']}}"
                                               value="{{$item['VALUE']}}" {{$item['VALUE']==3?'checked':''}} disabled>
                                        <label class="form-check-label" for="BANK_LOCATION-{{$item['VALUE']}}">{{$item['LABEL']}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <input type="text" id="BENEFICIARY_ID" name="BENEFICIARY_ID" value="{{$data['BENEFICIARY_ID']}}" hidden>
                        <div class="form_inputs">
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">اسم المستفيد</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <input type="text" class="form-control" name="BENEFICIARY_FULL_NAME" id="BENEFICIARY_FULL_NAME" value="{{$data['BENEFICIARY_FULL_NAME']??''}}" placeholder="اسم المستفيد" />
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">عنوان المستفيد</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <input type="text" class="form-control" name="BENEFICIARY_ADDRESS" id="BENEFICIARY_ADDRESS" value="{{$data['BENEFICIARY_ADDRESS']??''}}" placeholder="عنوان المستفيد" />
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center d-none">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">اسم البنك</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <select class="select-single-with-search getBankBranches" name="BANK_ID" id="BANK_ID" data-placeholder="اسم البنك" data-width="100%" disabled>
                                        <option value=""></option>
                                        @foreach($banks as $item)
                                            <option value="{{$item['BANK_ID']}}" @isset($data['BANK_ID']){{$item['BANK_ID']==$data['BANK_ID']?'selected':''}}@endisset>{{$item['BANK_DESC']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center d-none">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">اسم فرع البنك</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <select class="select-single-with-search displayBankBranches" name="BANK_BRANCH_ID" id="BANK_BRANCH_ID" data-placeholder="اسم فرع البنك" data-width="100%" disabled>
                                        <option value=""></option>
                                        @foreach($branches as $item)
                                            <option value="{{$item['VALUE']}}" @isset($data['BANK_BRANCH_ID']){{$item['VALUE']==$data['BANK_BRANCH_ID']?'selected':''}}@endisset>{{$item['LABEL']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center d-none">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">اسم البنك</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <input type="text" class="form-control" name="BANK_NAME" id="BANK_NAME" value="{{$data['BANK_NAME']??''}}" disabled placeholder="اسم البنك" />
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center d-none">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">اسم فرع البنك</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <input type="text" class="form-control" name="BANK_BRANCH_NAME" id="BANK_BRANCH_NAME" value="{{$data['BANK_BRANCH_NAME']??''}}" disabled placeholder="اسم فرع البنك" />
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center d-none">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">رقم الحساب الدولي</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <input type="text" class="form-control" name="IBAN" id="IBAN" value="{{$data['IBAN']??''}}" placeholder="رقم الحساب الدولي" disabled />
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">حساب المستفيد</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <input type="text" class="form-control number-only" name="BANK_ACCOUNT_NUMBER" id="BANK_ACCOUNT_NUMBER" value="{{$data['BANK_ACCOUNT_NUMBER']??''}}" placeholder="حساب المستفيد" />
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center d-none">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">كود Swift</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <input type="text" class="form-control" name="SWIFT_CODE" id="SWIFT_CODE" value="{{$data['SWIFT_CODE']??''}}" disabled placeholder="كود Swift" />
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">عملة الحساب</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <select class="select-single-with-search" name="BENEFICIARY_CURR_ID" id="BENEFICIARY_CURR_ID" data-placeholder="عملة الحساب" data-width="100%">
                                        <option value=""></option>
                                        @foreach($currencies as $item)
                                            <option value="{{$item['VALUE']}}" @isset($data['BENEFICIARY_CURR_ID']){{$item['VALUE']==$data['BENEFICIARY_CURR_ID']?'selected':''}}@endisset>{{$item['LABEL']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">نوع الحساب</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <select class="select-single-with-search" name="BENEFICIARY_LEDGER_ID" id="BENEFICIARY_LEDGER_ID" data-placeholder="نوع الحساب" data-width="100%">
                                        <option value=""></option>
                                        @foreach($ledgers as $item)
                                            <option value="{{$item['LEDGER_ID']}}" @isset($data['BENEFICIARY_LEDGER_ID']){{$item['LEDGER_ID']==$data['BENEFICIARY_LEDGER_ID']?'selected':''}}@endisset>{{$item['LEDGER_NAME_NA']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">رقم الحساب الفرعي</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <input type="text" class="form-control number-only" name="BENEFICIARY_ACC_SUB_NUM" id="BENEFICIARY_ACC_SUB_NUM" value="{{$data['BENEFICIARY_ACC_SUB_NUM']??''}}" placeholder="رقم الحساب الفرعي" />
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">ملاحظات</label>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <input type="text" class="form-control" name="NOTES" id="NOTES" placeholder="ملاحظات" value="{{$data['NOTES']??''}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-start">
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
                        </div>
                    </div>
                </form>
            </div>
        </section>

        @include('portal_v2.components.code_modal')
    </div>
@endsection

@push('style')
{{--    <style>--}}
{{--        .form-control, .form-select, .custom-select{--}}
{{--            padding: 0.85rem 0.75rem;--}}
{{--        }--}}
{{--        .select2-container--bootstrap4 .select2-selection--single{--}}
{{--            height: var(--input-height);;--}}
{{--        }--}}
{{--    </style>--}}
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#BANK_LOCATION-{{$data['BANK_LOCATION']}}').attr('checked', true).trigger('change');
            $('#BANK_LOCATION-{{$data['BANK_LOCATION']}}').removeAttr('disabled');
        });
        $(document).on('change', 'input[name="BANK_LOCATION"]', function (e) {
            let value = $('input[name="BANK_LOCATION"]:checked').val();
            let form = $(this).closest('form');
            form.find('.form_inputs .d-none').removeClass('d-none');
            form.find('.form_inputs :disabled').removeAttr('disabled');
            if(value == 2) {
                form.find('#BANK_ID').parents('.row').addClass('d-none');
                form.find('#BANK_ID').attr('disabled', 'true');
                form.find('#BANK_BRANCH_ID').parents('.row').addClass('d-none');
                form.find('#BANK_BRANCH_ID').attr('disabled', 'true');
                form.find('#BANK_ACCOUNT_NUMBER').parents('.row').addClass('d-none');
                form.find('#BANK_ACCOUNT_NUMBER').attr('disabled', 'true');
                form.find('#BENEFICIARY_CURR_ID').parents('.row').addClass('d-none');
                form.find('#BENEFICIARY_CURR_ID').attr('disabled', 'true');
                form.find('#BENEFICIARY_LEDGER_ID').parents('.row').addClass('d-none');
                form.find('#BENEFICIARY_LEDGER_ID').attr('disabled', 'true');
                form.find('#BENEFICIARY_ACC_SUB_NUM').parents('.row').addClass('d-none');
                form.find('#BENEFICIARY_ACC_SUB_NUM').attr('disabled', 'true');
            }else if(value == 1){
                form.find('#BANK_NAME').parents('.row').addClass('d-none');
                form.find('#BANK_NAME').attr('disabled', 'true');
                form.find('#BANK_BRANCH_NAME').parents('.row').addClass('d-none');
                form.find('#BANK_BRANCH_NAME').attr('disabled', 'true');
                form.find('#BANK_ACCOUNT_NUMBER').parents('.row').addClass('d-none');
                form.find('#BANK_ACCOUNT_NUMBER').attr('disabled', 'true');
                form.find('#SWIFT_CODE').parents('.row').addClass('d-none');
                form.find('#SWIFT_CODE').attr('disabled', 'true');
                form.find('#BENEFICIARY_CURR_ID').parents('.row').addClass('d-none');
                form.find('#BENEFICIARY_CURR_ID').attr('disabled', 'true');
                form.find('#BENEFICIARY_LEDGER_ID').parents('.row').addClass('d-none');
                form.find('#BENEFICIARY_LEDGER_ID').attr('disabled', 'true');
                form.find('#BENEFICIARY_ACC_SUB_NUM').parents('.row').addClass('d-none');
                form.find('#BENEFICIARY_ACC_SUB_NUM').attr('disabled', 'true');
            }else{
                form.find('#BANK_ID').parents('.row').addClass('d-none');
                form.find('#BANK_ID').attr('disabled', 'true');
                form.find('#BANK_BRANCH_ID').parents('.row').addClass('d-none');
                form.find('#BANK_BRANCH_ID').attr('disabled', 'true');
                form.find('#BANK_NAME').parents('.row').addClass('d-none');
                form.find('#BANK_NAME').attr('disabled', 'true');
                form.find('#BANK_BRANCH_NAME').parents('.row').addClass('d-none');
                form.find('#BANK_BRANCH_NAME').attr('disabled', 'true');
                form.find('#IBAN').parents('.row').addClass('d-none');
                form.find('#IBAN').attr('disabled', 'true');
                form.find('#SWIFT_CODE').parents('.row').addClass('d-none');
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

        $(document).on('submit', '#add_new', function (e){
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
                        $('#code_modal').modal('show');
                        countDown();
                        loaderEnd(form);
                        // SwalModal2(response.msg, 'success', response.url);
                        // window.location.href = response.url;
                    }else{
                        errorShow(form, response.msg);
                        loaderEnd(form);
                    }
                },
                error: function (response) {
                    $.each(response.responseJSON.errors, function (index, value) {
                        form.find("input[name='"+index+"']").addClass('border-danger');
                        form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                        form.find("select[name='"+index+"']").addClass('border-danger');
                        form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                    });
                    loaderEnd(form);
                }
            })
        });

        $(document).on('submit', '#verify_code', function (e){
            e.preventDefault();
            let form = $(this);
            let formData = new FormData(document.getElementById('add_new'));
            formData.append('code_is_required', 1);
            let code = form.find('#code4').val()+''+form.find('#code3').val()+''+form.find('#code2').val()+''+form.find('#code1').val();
            formData.append('VERIFY_CODE', code);
            loaderStart(form);
            errorHide(form);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.beneficiaries.submit')}}',
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
            let form = $('#add_new');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: form.attr('action'),
                data: new FormData(document.getElementById('add_new')),
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
