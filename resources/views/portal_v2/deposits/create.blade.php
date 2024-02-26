@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">طلب ربط وديعة</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.deposits.index')}}">الودائع</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">طلب ربط وديعة</a></li>
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
                    <form id="form_data" action="{{route('portal.v2.deposits.submit')}}">
                        <div class="row g-0 py-2 text-center">
                            <div class="sh-3 sh-md-5 fw-bold lh-1-25 h5"><i class="fa-solid fa-right-left ms-2"></i> طلب ربط وديعة</div>
                        </div>
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">مدة الوديعة</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <select class="select-single-with-search" name="DEPOSIT_TYPE_PERIOD_ID" data-placeholder="مدة الوديعة" data-width="100%">
                                    <option></option>
                                    @foreach($deposit_types as $item)
                                        <option value="{{$item['DEPOSIT_TYPE_PERIOD_ID']}}">{{$item['DEPOSIT_BIND_PERIOD_DESC']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center" id="DEPOSIT_VALUE_inputs">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">قيمة الوديعة</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" class="form-control formattedNumber" name="DEPOSIT_VALUE" id="DEPOSIT_VALUE_input" placeholder="قيمة الوديعة"/>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">العملة</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <select class="select-single-with-search" name="DEPOSIT_CURR_ID" id="DEPOSIT_CURR_ID_select" data-placeholder="العملة" data-width="100%">
                                    <option></option>
                                    @foreach($currencies as $item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center fs-5 mb-3 amount_text"></div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">رقم الحساب</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" hidden name="FEED_ACC_SUB_NUM" id="FEED_ACC_SUB_NUM" value="">
                                <select class="select-single-with-search" name="FEED_ACC_LEDGER_ID" id="FEED_ACC_LEDGER_ID" disabled data-placeholder="رقم الحساب" data-width="100%">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 mt-4">
                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                <button type="submit" class="btn btn-secondary">
                                    <div class="text"><i class="fa-solid fa-money-bill-transfer"></i> إرسال</div>
                                    <div class="btn-loader d-none">
                                        <div class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">جاري الإرسال</span>
                                        </div>
                                        <span>جاري الإرسال</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
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
        $(document).on('change', '#DEPOSIT_CURR_ID_select', function (e){
            e.preventDefault();
            $('#FEED_ACC_LEDGER_ID').attr('disabled', true);
            let curr = $('#DEPOSIT_CURR_ID_select').val();
            if(curr){
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.v2.deposits.accounts.get')}}',
                    data: {
                        'curr': curr,
                    },
                    success: function (response) {
                        if(response.status){
                            let html = '<option></option>';
                            if(response.options.length > 0){
                                $.each(response.options, function (index, value) {
                                    html += '<option value="'+value['LEDGER_ID']+'" data-FEED_ACC_SUB_NUM="'+value['ACC_SUB_NUM']+'">'+value['ACCOUNT_NUM']+', '+ value['LEDGER_NAME_NA']+', '+ value['ACCOUNT_BALANCE']+' '+ value['CURR_NAME_DESC'] +'</option>'
                                });
                                $('#FEED_ACC_LEDGER_ID').html(html);
                                $('#FEED_ACC_LEDGER_ID').removeAttr('disabled');
                            }else{
                                $('#FEED_ACC_LEDGER_ID').html(html);
                                SwalModal('لا يوجد حسابات للعميل', 'error');
                            }
                        }else{
                            SwalModal(response.msg, 'error')
                        }
                    },
                })
            }
            return false;
        });

        $(document).on('change', '#DEPOSIT_CURR_ID_select, #DEPOSIT_VALUE_inputs input', function (e){
            e.preventDefault();
            let value = $('#DEPOSIT_VALUE_input').val();
            let curr = $('#DEPOSIT_CURR_ID_select').val();
            if(value && curr){
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.v2.deposits.numToText')}}',
                    data: {
                        'value': value,
                        'curr': curr,
                    },
                    success: function (response) {
                        if(response.status){
                            $('.amount_text').html(response.value)
                        }else{
                            SwalModal(response.msg, 'error')
                        }
                    },
                })
            }
            return false;
        });

        $(document).on('change', '#FEED_ACC_LEDGER_ID', function (e){
            let FEED_ACC_SUB_NUM = $(this).find('option:selected').attr('data-FEED_ACC_SUB_NUM');
            $('#FEED_ACC_SUB_NUM').val(FEED_ACC_SUB_NUM);
        });

        $(document).on('submit', '#form_data', function (e){
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
                    if(response.status){
                        $('#code_modal').modal('show');
                        countDown();
                        loaderEnd(form);
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
            let formData = new FormData(document.getElementById('form_data'));
            formData.append('code_is_required', 1);
            let code = form.find('#code4').val()+''+form.find('#code3').val()+''+form.find('#code2').val()+''+form.find('#code1').val();
            formData.append('VERIFY_CODE', code);
            loaderStart(form);
            errorHide(form);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.deposits.submit')}}',
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
