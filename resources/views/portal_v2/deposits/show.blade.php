@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">

        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">الودائع</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.deposits.index')}}">الودائع</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">تفاصيل</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <section class="scroll-section position-relative" id="responsiveTabs">
            <div class="row mt-5">
                <div class="col-12 col-xl-4">
                    <div class="card mb-3 p-3 ms-3 border-bottom border-separator-light custom-shadow">
                        <div class="p-3 align-items-center border-bottom d-flex justify-content-start">
                            <i class="fa-solid fa-money-check fa-2x text-secondary ms-3"></i>
                            <div class="d-flex justify-content-between w-100">
                                <div class="h5 fw-bold">وديعة</div>
                                <div class="h5 fw-bold text-secondary">{{$details['DEPOSIT_ID']}}</div>
                            </div>
                        </div>
{{--                        <div class="p-3 border-bottom d-flex justify-content-between">--}}
{{--                            <span class="align-middle">تاريخ ربط الوديعة</span>--}}
{{--                            <span class="align-middle"><strong>{{$details['DEPOSIT_BIND_DATE']?Carbon\Carbon::parse($details['DEPOSIT_BIND_DATE'])->translatedFormat('d/m/Y'):''}}</strong></span>--}}
{{--                        </div>--}}
                        <div class="p-3 border-bottom d-flex justify-content-between">
                            <span class="align-middle">تاريخ استحقاق الوديعة</span>
                            <span class="align-middle"><strong>{{$details['DEPOSIT_MATURITY_DATE']?Carbon\Carbon::parse($details['DEPOSIT_MATURITY_DATE'])->translatedFormat('d/m/Y'):''}}</strong></span>
                        </div>
                        <div class="p-3 border-bottom d-flex justify-content-between">
                            <span class="align-middle">قيمة الوديعة</span>
                            <span class="align-middle"><strong>{{NumberFormat($details['DEPOSIT_VALUE'], $details['CURR_DECIMAL_PLACES'])}} {{$details['DEPOSIT_CURR_DESC']}}</strong></span>
                        </div>
                        <div class="p-3 border-bottom d-flex justify-content-between">
                            <span class="align-middle">مدة ربط الوديعة</span>
                            <span class="align-middle"><strong>{{$details['DEPOSIT_TYPE_PERIOD_DESC']}}</strong></span>
                        </div>
                        @if(in_array(1, array_column(Session::get('userData')['USER_ROLES'], 'ROLE_ID')) && in_array(205, array_column(Session::get('userData')['USER_SCREEN_PERMS'], 'SCREEN_ID')))
                        <div class="pt-3 d-flex justify-content-center">
                            <button type="button" id="deposit_installation_btn" class="btn btn-secondary px-2 mx-1">طلب إضافة على الوديعة</button>
                            <button type="button" id="deposit_break_btn" class="btn btn-secondary px-2 mx-1">طلب كسر وديعة</button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-xl-7 mb-5 position-relative">
                    <div class="div-loader fs-2 d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                    <div id="details_view">
                        @include('portal_v2.deposits.details')
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="deposit_installation" data-bs-keyboard="false" data-bs-backdrop="static" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel">طلب إضافة على الوديعة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deposit_installation_form" action="{{route('portal.v2.deposits.feeding')}}">
                    <div class="modal-body">
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <input type="text" id="type" value="1" hidden>
                        <input type="text" name="DEPOSIT_ID" value="{{$details['DEPOSIT_ID']}}" hidden>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">المبلغ</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" class="form-control formattedNumber" name="DEPOSIT_VALUE" id="feeding_DEPOSIT_VALUE" placeholder="المبلغ"/>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">العملة</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" name="DEPOSIT_CURR_ID" value="{{$details['DEPOSIT_CURR_ID']}}" hidden>
                                <select class="select-single-with-search" id="feeding_DEPOSIT_CURR_ID" disabled data-placeholder="العملة" data-width="100%">
                                    <option></option>
                                    @foreach($currencies as $item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">رقم الحساب</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" hidden name="FEED_ACC_SUB_NUM" id="feeding_FEED_ACC_SUB_NUM" value="">
                                <select class="select-single-with-search" name="FEED_ACC_LEDGER_ID" id="feeding_FEED_ACC_LEDGER_ID" disabled data-placeholder="رقم الحساب" data-width="100%">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-secondary">
                            <div class="text"><i class="fa-solid fa-plus"></i> إرسال</div>
                            <div class="btn-loader d-none">
                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">جاري الإرسال</span>
                                </div>
                                <span>جاري الإرسال</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deposit_break" data-bs-keyboard="false" data-bs-backdrop="static" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel">طلب كسر وديعة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deposit_break_form" action="{{route('portal.v2.deposits.break')}}">
                    <div class="modal-body">
                        <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                        <input type="text" id="type" value="2" hidden>
                        <input type="text" name="DEPOSIT_ID" value="{{$details['DEPOSIT_ID']}}" hidden>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">المبلغ</label>
                            <div class="col-sm-8 col-md-9 col-lg-9">
                                <input type="text" class="form-control formattedNumber" name="DEPOSIT_LOSS_VALUE" id="break_DEPOSIT_LOSS_VALUE" placeholder="المبلغ"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-secondary">
                            <div class="text"><i class="fa-solid fa-plus"></i> إرسال</div>
                            <div class="btn-loader d-none">
                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">جاري الإرسال</span>
                                </div>
                                <span>جاري الإرسال</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('portal_v2.components.code_modal')

@endsection

@push('style')
    <style>
        .div-loader{
            position: absolute;
            top: 0px;
            width: 100%;
            height: 100%;
            display: flex;
            /*align-items: center;*/
            justify-content: center;
            z-index: 1;
            background-color: rgb(255, 255, 255, 0.3);
            margin-top: 200px;
        }
        .card.active:after, .card.selected:after, .card.activatable.context-menu-active:after{
            left: 0px;
        }
        .scroll{
            height: 500px;
        }
        .w-15px{
            display: inline-block;
            width: 230px;
        }
        .text-darkBlue{
            color: #333c58;
        }
        .custom-shadow{
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.15) !important;
        }
    </style>
@endpush

@push('script')
    <script>

        let FormID = '';

        $(document).ready(function (){

        })

        $(document).on('click', '#deposit_installation_btn', function (e){
            $('select#feeding_DEPOSIT_CURR_ID').val('{{$details['DEPOSIT_CURR_ID']}}').trigger('change');
            let form = $('#deposit_installation_form');
            let modal = $('#deposit_installation');
            form.trigger('reset');
            form.find('select#feeding_FEED_ACC_LEDGER_ID').val(null).trigger('change');
            modal.find('.alert').addClass('d-none');
            modal.find('.invalid-feedback').remove();
            modal.modal('show');
        });

        $(document).on('click', '#deposit_break_btn', function (e){
            let form = $('#deposit_break_form');
            let modal = $('#deposit_break');
            form.trigger('reset');
            form.find('select').val(null).trigger('change');
            modal.find('.alert').addClass('d-none');
            modal.find('.invalid-feedback').remove();
            modal.modal('show');
        });

        $(document).on('change', '#feeding_DEPOSIT_CURR_ID', function (e){
            e.preventDefault();
            $('#feeding_FEED_ACC_LEDGER_ID').attr('disabled', true);
            let curr = $('#feeding_DEPOSIT_CURR_ID').val();
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
                                $('#feeding_FEED_ACC_LEDGER_ID').html(html);
                                $('#feeding_FEED_ACC_LEDGER_ID').removeAttr('disabled');
                            }else{
                                $('#feeding_FEED_ACC_LEDGER_ID').html(html);
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

        $(document).on('change', '#feeding_FEED_ACC_LEDGER_ID', function (e){
            let FEED_ACC_SUB_NUM = $(this).find('option:selected').attr('data-FEED_ACC_SUB_NUM');
            $('#feeding_FEED_ACC_SUB_NUM').val(FEED_ACC_SUB_NUM);
        });

        $(document).on('submit', '#deposit_installation_form', function (e){
            e.preventDefault();
            let form = $(this);
            loaderStart(form);
            FormID = 'deposit_installation_form';
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
                        $('#deposit_installation').modal('hide');
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
                        form.find("textarea[name='"+index+"']").addClass('border-danger');
                        form.find("textarea[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                    });
                    loaderEnd(form);
                }
            })
        });

        $(document).on('submit', '#deposit_break_form', function (e){
            e.preventDefault();
            let form = $(this);
            loaderStart(form);
            FormID = 'deposit_break_form';
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
                        $('#deposit_break').modal('hide');
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
                        form.find("textarea[name='"+index+"']").addClass('border-danger');
                        form.find("textarea[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                    });
                    loaderEnd(form);
                }
            })
        });

        $(document).on('submit', '#verify_code', function (e){
            e.preventDefault();
            let form = $(this);
            loaderStart(form);
            errorHide(form);
            form.find('.alert').addClass('d-none');
            let formData = new FormData(document.getElementById(FormID));
            formData.append('code_is_required', 1);
            let code = form.find('#code4').val()+''+form.find('#code3').val()+''+form.find('#code2').val()+''+form.find('#code1').val();
            formData.append('VERIFY_CODE', code);
            let url = $('#'+FormID).find('#type').val()==1?'{{route('portal.v2.deposits.feeding')}}':'{{route('portal.v2.deposits.break')}}';
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: url,
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
            let form = $('#'+FormID);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: form.attr('action'),
                data: new FormData(document.getElementById(FormID)),
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
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/glide.core.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/bootstrap-datepicker3.standalone.min.css" />
@endpush

@push('page_script')
    <script src="{{asset('assets')}}/js/cs/glide.custom.js"></script>
    <script src="{{asset('assets')}}/js/pages/dashboard.default.js"></script>

    <script src="{{asset('assets')}}/js/vendor/movecontent.js"></script>
    <script src="{{asset('assets')}}/js/vendor/select2.full.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/profile.settings.js"></script>
    <script src="{{asset('assets')}}/js/forms/layouts.js"></script>
    <!-- Chart -->
    <script src="{{asset('assets')}}/js/vendor/moment-with-locales.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/Chart.bundle.min.js"></script>
    <script src="{{asset('assets')}}/js/cs/charts.extend.js"></script>
    <script src="{{asset('assets')}}/js/plugins/charts.js"></script>
    <!-- End Chart -->

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
