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


        @if(count($beneficiaries)>0)
            <div class="card mb-4">
                <div class="card-body">
                    <form class="row mb-2" id="filter_form" action="{{route('portal.v2.beneficiaries.index')}}">
                        <!-- Search Start -->
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="form-floating mb-4 mb-xxl-0">
                                <input type="text" name="BENEFICIARY_FULL_NAME" class="form-control" placeholder="اسم المستفيد" value="" autocomplete="off"/>
                                <label>اسم المستفيد</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="form-floating mb-4 mb-xxl-0 w-100">
                                <select class="select-floating-with-search" name="BANK_LOCATION">
                                    <option value="0">الكل</option>
                                    @foreach($types as $item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                                <label>نوع المستفيد</label>
                            </div>
                        </div>
                        <!-- Search End -->
                        <div class="col-sm-12 col-md-1 col-lg-2 text-end">
                            <button type="submit" class="btn btn-xl btn-secondary px-3">
                                <div class="text"><i data-acorn-icon="search"></i></div>
                                <div class="btn-loader d-none">
                                    <div class="spinner-border spinner-border-sm text-light" role="status">
                                        <span class="visually-hidden">جاري البحث</span>
                                    </div>
                                </div>
                            </button>
                            <button type="button" class="btn btn-xl btn-outline-secondary px-3 filter_reset me-3">
                                <div class="text"><i data-acorn-icon="rotate-right"></i></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <section class="scroll-section mt-55 position-relative" id="responsiveTabs">
                <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                    @if(in_array(1, array_column(Session::get('userData')['USER_ROLES'], 'ROLE_ID')) && in_array(202, array_column(Session::get('userData')['USER_SCREEN_PERMS'], 'SCREEN_ID')))
                        <a href="{{route('portal.v2.beneficiaries.create')}}" class="btn btn-secondary w-100 w-sm-auto mb-2 position-absolute top-m-30"><i class="fa-solid fa-plus"></i> إضافة مستفيد جديد</a>
                    @endif
                </div>
                <div class="card mb-3 mt-5">
                    <div class="card-body">
                        <div class="div-loader fs-2 d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                        <div id="items_here">
                            @include('portal_v2.beneficiaries.table')
                        </div>
                    </div>
                </div>
            </section>
        @else
            <div class="row gx-5 d-flex justify-content-center w-100">
                <div class="col-12 col-md-8">
                    <div class="card mb-5 py-5">
                        <div class="card-body ">
                            <div class="d-flex align-items-center flex-column py-5">
                                <svg class="svg-inline--fa fa-circle-info fa-2x text-secondary mb-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-info" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-144c-17.7 0-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32z"></path></svg><!-- <i class="fa-solid fa-circle-info fa-2x text-secondary mb-3"></i> Font Awesome fontawesome.com -->
                                <h4 class="fw-bold">لا يوجد مستفيدين</h4>
                                <p class="">لا يوجد لديك مستفيدين حتى الآن</p>
                                <a href="{{route('portal.v2.beneficiaries.create')}}" class="btn btn-secondary"><i class="fa-solid fa-plus"></i> إضافة مستفيد جديد</a>
                            </div>
                        </div>
                        <div class="bg-brand-v2"></div>
                    </div>
                </div>
            </div>
        @endif

        <div class="modal fade" id="row_notes" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="row_details" data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addnewLabel">تفاصيل المستفيد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
        .mt-55{
            margin-top: 55px!important;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).on('click', '.display_notes', function (e){
            let notes = $(this).attr('data-notes');
            $('#row_notes .modal-body').html('<p>'+notes+'</p>');
            $('#row_notes').modal('show');
        })

        $(document).on('click', '.display_details', function (e){
            e.preventDefault();
            let btn = $(this);
            let id = $(this).attr('data-id');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.beneficiaries.details')}}',
                data: {
                    'id': id
                },
                success: function (response) {
                    if(response.status){
                        $('#row_details .modal-body').html(response.html);
                        $('#row_details').modal('show');
                    }else{
                        SwalModal2(response.msg, 'error');
                    }
                },
                error: function (response) {
                    SwalModal2('حدث خطأ ما!', 'error');
                }
            })
        });

        $('.filter_reset').on('click', function (e){
            let form = $(this).parents('form');
            form.trigger('reset');
            form.find('select').val(0).trigger('change');
            form.trigger('submit');
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

        $(document).on('click', '.page.page-link', function (e){
            e.preventDefault();
            let btn = $(this);
            $('.div-loader').removeClass('d-none');
            let next = btn.data('page');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "GET",
                url: '{{route('portal.v2.beneficiaries.index')}}',
                data: {
                    'page': next,
                    'BENEFICIARY_FULL_NAME': $('#filter_form').find('[name="BENEFICIARY_FULL_NAME"]').val(),
                    'BANK_LOCATION': $('#filter_form').find('[name="BANK_LOCATION"]').val(),
                },
                success: function (response) {
                    if(response.status){
                        $('#items_here').html(response.html);
                        runStaff();
                        $('.div-loader').addClass('d-none');
                    }else{
                        SwalModal2('حدث خطأ ما!', 'error');
                        $('.div-loader').addClass('d-none');
                    }
                },
                error: function (response) {
                    SwalModal2('حدث خطأ ما!', 'error');
                    $('.div-loader').addClass('d-none');
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
                btnLoaderStart(btn);
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
                                $('#code_modal #extra').val(id);
                                $('#code_modal').modal('show');
                                countDown();
                                btnLoaderEnd(btn);
                            }else{
                                SwalModal2(response.msg, 'error');
                                btnLoaderEnd(btn);
                            }
                        },
                    });
                }
            });
        });

        $(document).on('submit', '#verify_code', function (e){
            e.preventDefault();
            let form = $(this);
            let id = $('#code_modal #extra').val();
            let code = form.find('#code4').val()+''+form.find('#code3').val()+''+form.find('#code2').val()+''+form.find('#code1').val();
            loaderStart(form);
            errorHide(form);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{route('portal.v2.beneficiaries.delete')}}',
                type: 'POST',
                data: {
                    'id': id,
                    'VERIFY_CODE': code,
                    'code_is_required': 1,
                },
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

