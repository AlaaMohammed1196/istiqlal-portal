@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">الحوالات</h1>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        @if(count($transfers)>0)

            <div class="card mb-5">
                <div class="card-body">
                    <form class="row mb-2" id="filter_form" action="{{route('portal.v2.transfers.index')}}">
                        <!-- Search Start -->
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-4">
                            <div class="input-group mb-4 fromToValidation" data-isDate="1">
                                <div class="form-floating w-50">
                                    <input type="text" name="FROM_DATE" class="from date-picker-close rounded-0 rounded-end form-control" placeholder="من تاريخ" autocomplete="off">
                                    <label>تاريخ الحوالة من</label>
                                </div>
                                <div class="form-floating w-50">
                                    <input type="text" name="TO_DATE" class="to date-picker-close rounded-0 rounded-start form-control" placeholder="إلى تاريخ" autocomplete="off">
                                    <label>تاريخ الحوالة الى</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-4">
                            <div class="input-group mb-4 fromToValidation" data-isDate="0">
                                <div class="form-floating w-50">
                                    <input type="number" name="FROM_AMOUNT" class="from rounded-0 rounded-end form-control" placeholder="القيمة من" autocomplete="off">
                                    <label>القيمة من</label>
                                </div>
                                <div class="form-floating w-50">
                                    <input type="number" name="TO_AMOUNT" class="to rounded-0 rounded-start form-control" placeholder="القيمة الى" autocomplete="off">
                                    <label>القيمة الى</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-4">
                            <div class="form-floating mb-4 w-100">
                                <select class="select-floating-with-search" name="CURR_ID">
                                    <option value="-1">الكل</option>
                                    @foreach($currencies as $item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                                <label>العملة</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-4">
                            <div class="form-floating mb-4 mb-xxl-0 w-100">
                                <select class="select-floating-with-search" name="PAY_TYPE_ID">
                                    <option value="-1">الكل</option>
                                    @foreach($types as $item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                                <label>نوع الحوالة</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-4">
                            <div class="form-floating mb-4 mb-xxl-0 w-100">
                                <select class="select-floating-with-search" name="TRANSFER_SOURCE">
                                    <option value="-1">الكل</option>
                                    @foreach($sources as $item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                                <label>مصدر الحوالة</label>
                            </div>
                        </div>
                        <!-- Search End -->
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-2 text-end">
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
            <section class="scroll-section mt-4 position-relative" id="responsiveTabs">
                <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                    @if(in_array(1, array_column(Session::get('userData')['USER_ROLES'], 'ROLE_ID')) && in_array(203, array_column(Session::get('userData')['USER_SCREEN_PERMS'], 'SCREEN_ID')))
                        <a href="{{route('portal.v2.transfers.create')}}" class="btn btn-secondary w-100 w-sm-auto mb-2 me-2"><i class="fa-solid fa-plus"></i> حوالة جديدة</a>
                    @endif
                    <a href="{{route('portal.v2.transfers.print')}}" id="to_excel" class="btn btn-secondary w-100 w-sm-auto mb-2 me-2">
                        <div class="text"><i class="fa-solid fa-file-csv ps-2"></i> تصدير الى Excel</div>
                        <div class="btn-loader d-none">
                            <div class="spinner-border spinner-border-sm text-light" role="status">
                                <span class="visually-hidden">جاري التصدير</span>
                            </div>
                            <span>جاري التصدير</span>
                        </div>
                    </a>
                </div>
                <div class="card mb-3 mt-4">
                    <div class="card-body">
                        <div class="div-loader fs-2 d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                        <div id="items_here">
                            @include('portal_v2.transfers.table')
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
                                <h4 class="fw-bold">لا يوجد حوالات</h4>
                                <p class="">لا يوجد لديك حوالات حتى الآن</p>
                                <a href="{{route('portal.v2.transfers.create')}}" class="btn btn-secondary"><i class="fa-solid fa-plus"></i> حوالة جديدة</a>
                            </div>
                        </div>
                        <div class="bg-brand-v2"></div>
                    </div>
                </div>
            </div>
        @endif

        <div class="modal fade" id="row_notes" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body wizard" id="wizardBasic">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="row_details" data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addnewLabel">تفاصيل الحوالة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>

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
        let sortValues = [];
        sortValues['ORDER_COLUMN_NAME'] = '';
        sortValues['ORDER_TYPE'] = '';
        sortValues['IS_COLUMN_DATE'] = '';
        sortableTable('{{route('portal.v2.transfers.index')}}');

        $(document).on('click', '#to_excel', function (e){
            e.preventDefault();
            let btn = $(this);
            btnLoaderStart(btn);
            let form = document.getElementById('filter_form');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: btn.attr('href'),
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if(response.status){
                        var mediaType = "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,";
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = mediaType + response.file;
                        a.download = 'transfers.xlsx';
                        document.body.appendChild(a);
                        a.click();
                    }else{
                        SwalModal2('حدث خطأ ما!', 'error');
                    }
                    btnLoaderEnd(btn);
                },
                error: function (response) {
                    SwalModal2('حدث خطأ ما!', 'error');
                    btnLoaderEnd(btn);
                }
            })
        });

        $('.filter_reset').on('click', function (e){
            let form = $(this).parents('form');
            form.trigger('reset');
            form.find('select').val('-1').trigger('change');
            form.trigger('submit');
        });

        $(document).on('click', '.display_notes', function (e){
            let notes = $(this).attr('data-notes');
            $('#row_notes .modal-body').html('<p>'+notes+'</p>');
            $('#row_notes').modal('show');
        });

        $(document).on('click', '.display_details', function (e){
            e.preventDefault();
            let btn = $(this);
            let id = $(this).attr('data-id');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.transfers.details')}}',
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

        $(document).on('submit', '#filter_form', function (e){
            e.preventDefault();
            let form = $(this);
            $('.div-loader').removeClass('d-none');
            form.find('.invalid-feedback').remove();
            if(!validateFilter()){
                $('.div-loader').addClass('d-none');
                return false;
            }
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
                    }else{
                        SwalModal2(response.msg, 'error');
                    }
                    $('.div-loader').addClass('d-none');
                },
                error: function (response) {
                    $('.div-loader').addClass('d-none');
                }
            })
        });

        $(document).on('click', '.page.page-link', function (e){
            e.preventDefault();
            let btn = $(this);
            $('.div-loader').removeClass('d-none');
            let next = btn.data('page');
            let type = $('#filter-requests').val();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "GET",
                url: '{{route('portal.v2.transfers.index')}}',
                data: {
                    'page': next,
                    'FROM_DATE': $('#filter_form').find('[name="FROM_DATE"]').val(),
                    'TO_DATE': $('#filter_form').find('[name="TO_DATE"]').val(),
                    'PAY_TYPE_ID': $('#filter_form').find('[name="PAY_TYPE_ID"]').val(),
                    'FROM_AMOUNT': $('#filter_form').find('[name="FROM_AMOUNT"]').val(),
                    'TO_AMOUNT': $('#filter_form').find('[name="TO_AMOUNT"]').val(),
                    'CURR_ID': $('#filter_form').find('[name="CURR_ID"]').val(),
                    'TRANSFER_SOURCE': $('#filter_form').find('[name="TRANSFER_SOURCE"]').val(),
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

        $(document).on('click', '.transfer_to_pdf', function (e){
            e.preventDefault();
            let btn = $(this);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.transfers.pdf.print')}}',
                data: {
                    'VOUCHER_NO': btn.data('id')
                },
                success: function (response) {
                    if(response.status){
                        var mediaType = "data:application/*;base64,";
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = mediaType + response.file;
                        a.download = 'transferDetails.pdf';
                        document.body.appendChild(a);
                        a.click();
                    }else{
                        SwalModal2('حدث خطأ ما!', 'error');
                    }
                },
                error: function (response) {
                    SwalModal2('حدث خطأ ما!', 'error');
                }
            })
        });

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
