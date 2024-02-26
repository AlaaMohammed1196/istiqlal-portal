@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">تذاكر</h1>
                </div>
                <div class="col-12 col-md-5">
                    <div class="d-sm-flex justify-content-end flex-column flex-sm-row mt-5">
                        @if(in_array(1, array_column(Session::get('userData')['USER_ROLES'], 'ROLE_ID')) && in_array(204, array_column(Session::get('userData')['USER_SCREEN_PERMS'], 'SCREEN_ID')))
                            <button type="button" id="create_btn" class="btn btn-secondary w-100 w-sm-auto"><i class="fa-solid fa-plus"></i> تذكرة جديدة</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form class="row mb-2" id="filter_form" action="{{route('portal.v2.tickets.index')}}">
                    <!-- Search Start -->
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-4">
                        <div class="input-group mb-4 mb-xxl-0">
                            <div class="form-floating w-50">
                                <input type="text" name="DATE_FROM" class="date-picker-close rounded-0 rounded-end form-control" placeholder="من تاريخ" autocomplete="off">
                                <label>من تاريخ</label>
                            </div>
                            <div class="form-floating  w-50">
                                <input type="text" name="DATE_TO" class="date-picker-close rounded-0 rounded-start form-control" placeholder="إلى تاريخ" autocomplete="off">
                                <label>إلى تاريخ</label>
                            </div>
                        </div>
                    </div>
                    <!-- Search End -->
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-2">
                        <div class="form-floating mb-4 mb-xxl-0">
                            <input type="text" name="TICKET_TITLE" class="form-control" placeholder="عنوان التذكرة" value="" autocomplete="off"/>
                            <label>عنوان التذكرة</label>
                        </div>
                    </div>
                    <!-- Search End -->
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-2">
                        <div class="form-floating mb-4 mb-xxl-0 w-100">
                            <select class="select-floating-with-search" name="TICKET_TYPE_ID">
                                <option></option>
                                @foreach($constants['TICKET_TYPES'] as $item)
                                    <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                @endforeach
                            </select>
                            <label>نوع التذكرة</label>
                        </div>
                    </div>
                    <!-- Search End -->
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-2">
                        <div class="form-floating mb-4 mb-xxl-0 w-100">
                            <select class="select-floating-with-search" name="TICKET_STATUS_ID">
                                <option></option>
                                @foreach($constants['TICKET_STATUSES'] as $item)
                                    <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                @endforeach
                            </select>
                            <label>حالة التذكرة</label>
                        </div>
                    </div>
                    <!-- Search End -->
                    <div class="col-sm-12 col-md-1 col-lg-1 col-xxl-1 text-end">
                        <button type="submit" class="btn btn-xl btn-secondary px-3">
                            <div class="text"><i data-acorn-icon="search"></i></div>
                            <div class="btn-loader d-none">
                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">جاري البحث</span>
                                </div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <section class="scroll-section position-relative" id="responsiveTabs">
            <div class="card">
                <div class="card-body">
                    <div class="div-loader fs-2 d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                    <div id="items_here">
                        @include('portal_v2.tickets.table')
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="addnew" data-bs-keyboard="false" data-bs-backdrop="static" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addnewLabel">إضافة تذكرة جديدة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="add_new" action="{{route('portal.v2.tickets.store')}}">
                        <div class="modal-body">
                            <div class="row g-0 py-2 text-center">
                                <div class="sh-3 sh-md-5 fw-bold lh-1-25 h5"><i class="fa-solid fa-circle-info ms-2"></i> تذكرة جديدة</div>
                            </div>
                            <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                            <div class="form-floating mb-4 w-100">
                                <select class="select-floating-with-search" id="TICKET_TYPE_ID" name="TICKET_TYPE_ID">
                                    <option></option>
                                    @foreach($constants['TICKET_TYPES'] as $item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                                <label>نوع التذكرة</label>
                            </div>
                            <div class="form-floating mb-4 w-100">
                                <select class="select-floating-with-search" id="TICKET_PRIORITY_ID" name="TICKET_PRIORITY_ID">
                                    <option></option>
                                    @foreach($constants['TICKET_PRIORITIES'] as $item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                                <label>درجة أهمية التذكرة</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="TICKET_TITLE" name="TICKET_TITLE" placeholder="عنوان التذكرة" />
                                <label>عنوان التذكرة</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="TICKET_DESCRIPTION" name="TICKET_DESCRIPTION" placeholder="وصف التذكرة"></textarea>
                                <label>وصف التذكرة</label>
                            </div>
                            <div class="mb-3">
                                <input type="file" class="form-control" id="TICKET_ATTACHMENTS" name="TICKET_ATTACHMENTS[]" multiple onchange="loadFile(this)" hidden />
                                <label class="btn btn-outline-muted mb-1" for="TICKET_ATTACHMENTS">
                                    <i class="fa-solid fa-paperclip"></i> إضافة مرفقات
                                </label>
                                <span id="attach_info"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button>
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

        <div class="modal fade" id="row_notes" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="row_notesLabel">الوصف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body wizard" id="wizardBasic">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>

        @include('portal_v2.components.code_modal')

    </div>
@endsection

@push('style')
    <style>
        .div-loader{
            position: absolute;
            top: 0px;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            background-color: rgb(255, 255, 255, 0.3);
            /*margin-top: 200px;*/
        }
    </style>
@endpush

@push('script')
    <script>
        let sortValues = [];
        sortValues['ORDER_COLUMN_NAME'] = '';
        sortValues['ORDER_TYPE'] = '';
        sortValues['IS_COLUMN_DATE'] = '';
        sortableTable('{{route('portal.v2.tickets.index')}}');

        $(document).on('click', '.display_notes', function (e){
            let notes = $(this).attr('data-notes');
            $('#row_notes .modal-body').html('<p>'+notes+'</p>');
            $('#row_notes').modal('show');
        })

        $(document).ready(function (){
            $('#create_btn').on('click', function (e){
                let form = $('#add_new');
                form.trigger('reset');
                $('#attach_info').html('');
                form.find('.invalid-feedback').remove();
                form.find('.border-danger').removeClass('border-danger')
                form.find('select').val(null).trigger('change');
                form.find('.select2.full').removeClass('full');
                $('#addnew').modal('show');
            });
        });

        $(document).on('click', '.page.page-link', function (e){
            e.preventDefault();
            let btn = $(this);
            $('.div-loader').removeClass('d-none');
            let next = btn.data('page');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "GET",
                url: '{{route('portal.v2.tickets.index')}}',
                data: {
                    'page': next,
                    'DATE_FROM': $('#filter_form').find('[name="DATE_FROM"]').val(),
                    'DATE_TO': $('#filter_form').find('[name="DATE_TO"]').val(),
                    'TICKET_TITLE': $('#filter_form').find('[name="TICKET_TITLE"]').val(),
                    'TICKET_TYPE_ID': $('#filter_form').find('[name="TICKET_TYPE_ID"]').val(),
                    'TICKET_STATUS_ID': $('#filter_form').find('[name="TICKET_STATUS_ID"]').val(),
                    'ORDER_COLUMN_NAME': sortValues['ORDER_COLUMN_NAME'],
                    'ORDER_TYPE': sortValues['ORDER_TYPE'],
                    'IS_COLUMN_DATE': sortValues['IS_COLUMN_DATE'],
                },
                success: function (response) {
                    if(response.status){
                        $('#items_here').html(response.html);
                        runStaff();
                        $('.div-loader').addClass('d-none');
                    }else{
                        SwalModal2('حدث خطأ ما!', 'errors');
                        $('.div-loader').addClass('d-none');
                    }
                },
                error: function (response) {
                    SwalModal2('حدث خطأ ما!', 'errors');
                    $('.div-loader').addClass('d-none');
                }
            })
        });

        $(document).on('submit', '#filter_form', function (e){
            e.preventDefault();
            let form = $(this);
            loaderStart(form)
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
                        $('#items_here').html(response.html);
                        runStaff();
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

        $(document).on('submit', '#add_new', function (e){
            e.preventDefault();
            let form = $(this);
            loaderStart(form);
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
                        // $('#items_here').html(response.html);
                        // runStaff();
                        $('#addnew').modal('hide');
                        loaderEnd(form);
                        $('#code_modal').modal('show');
                        countDown();
                        // toastr.success(response.msg);
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
            let formData = new FormData(document.getElementById('add_new'));
            formData.append('code_is_required', form.find('[name="code_is_required"]').val());
            let code = form.find('#code4').val()+''+form.find('#code3').val()+''+form.find('#code2').val()+''+form.find('#code1').val();
            formData.append('VERIFY_CODE', code);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.tickets.store')}}',
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

        function next(){
            $('.btn-next').trigger('click');
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
