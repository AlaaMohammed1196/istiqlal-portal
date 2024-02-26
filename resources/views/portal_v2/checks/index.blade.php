@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">

        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">الشيكات</h1>
                </div>
            </div>
        </div>

        @if(count($checks) > 0)
            <div class="card">
                <div class="card-body p-4">
                    <form class="row" id="filter_form" action="{{route('portal.v2.checks.index')}}">
                        <!-- Search Start -->
                        <div class="col-sm-12 col-md-6 col-lg-2">
                            <div class="form-floating mb-4">
                                <input type="text" name="CHECK_NUM" class="form-control" placeholder="رقم الشيك" value="" autocomplete="off"/>
                                <label>رقم الشيك</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-2">
                            <div class="form-floating mb-4 w-100">
                                <select class="select-floating-with-search" name="CHECK_STATUS_ID">
                                    <option value="0">الكل</option>
                                    @foreach($types as $item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                                <label>حالة الشيك</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="input-group mb-4 fromToValidation" data-isDate="1">
                                <div class="form-floating w-50">
                                    <input type="text" name="FROM_DATE" class="from date-picker-close rounded-0 rounded-end form-control" placeholder="من تاريخ" autocomplete="off">
                                    <label>تاريخ الشيك من</label>
                                </div>
                                <div class="form-floating w-50">
                                    <input type="text" name="TO_DATE" class="to date-picker-close rounded-0 rounded-start form-control" placeholder="إلى تاريخ" autocomplete="off">
                                    <label>تاريخ الشيك الى</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="input-group mb-4 mb-xxl-0 fromToValidation" data-isDate="0">
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
                        <div class="col-sm-12 col-md-6 col-lg-2">
                            <div class="form-floating mb-4 mb-xxl-0 w-100">
                                <select class="select-floating-with-search" name="CURR_ID">
                                    <option value="0">الكل</option>
                                    @foreach($currencies as $item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                                <label>العملة</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="input-group mb-4 mb-xxl-0 fromToValidation" data-isDate="1">
                                <div class="form-floating w-50">
                                    <input type="text" name="FROM_RECEIPT_DATE" class="from date-picker-close rounded-0 rounded-end form-control" placeholder="من تاريخ" autocomplete="off">
                                    <label>تاريخ القبض من</label>
                                </div>
                                <div class="form-floating w-50">
                                    <input type="text" name="TO_RECEIPT_DATE" class="to date-picker-close rounded-0 rounded-start form-control" placeholder="إلى تاريخ" autocomplete="off">
                                    <label>تاريخ القبض الى</label>
                                </div>
                            </div>
                        </div>
                        <!-- Search End -->

                        <div class="col-sm-12 col-md-6 col-lg-2 text-end">
                            <button type="submit" class="btn btn-xl btn-secondary px-3">
                                <div class="text"><i data-acorn-icon="search"></i></div>
                                <div class="btn-loader d-none">
                                    <div class="spinner-border spinner-border-sm text-light" role="status">
                                        <span class="visually-hidden">جاري البحث</span>
                                    </div>
                                </div>
                            </button>
                            <button type="button" class="btn btn-xl btn-outline-secondary px-3 me-3 filter_reset">
                                <div class="text"><i data-acorn-icon="rotate-right"></i></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-55 position-relative">
                    <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                        <a href="{{route('portal.v2.checks.print')}}" id="to_excel" class="btn btn-secondary w-100 w-sm-auto mb-2 position-absolute top-m-30">
                            <div class="text"><i class="fa-solid fa-file-csv ps-2"></i> تصدير الى Excel</div>
                            <div class="btn-loader d-none">
                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">جاري التصدير</span>
                                </div>
                                <span>جاري التصدير</span>
                            </div>
                        </a>
                    </div>
                    <div class="card mb-3 mt-5">
                        <div class="card-body">
                            <div class="div-loader fs-2 d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                            <div id="items_here">
                                @include('portal_v2.checks.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row gx-5 d-flex justify-content-center w-100">
                <div class="col-12 col-md-8">
                    <div class="card mb-5 py-5">
                        <div class="card-body ">
                            <div class="d-flex align-items-center flex-column py-5">
                                <svg class="svg-inline--fa fa-circle-info fa-2x text-secondary mb-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-info" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-144c-17.7 0-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32z"></path></svg><!-- <i class="fa-solid fa-circle-info fa-2x text-secondary mb-3"></i> Font Awesome fontawesome.com -->
                                <h4 class="fw-bold">لا يوجد شيكات</h4>
                                <p class="mb-5">
                                    لا يوجد لديك شيكات حتى الآن
                                </p>
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
        });
    </script>
    <script>
        let sortValues = [];
        sortValues['ORDER_COLUMN_NAME'] = '';
        sortValues['ORDER_TYPE'] = '';
        sortValues['IS_COLUMN_DATE'] = '';
        sortableTable('{{route('portal.v2.checks.index')}}');

        $(document).on('click', '#to_excel', function (e){
            e.preventDefault();
            let btn = $(this);
            btnLoaderStart(btn);
            let form = document.getElementById('filter_form');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.checks.print')}}',
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
                        a.download = 'Checks.xlsx';
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
            form.find('select').val(0).trigger('change');
            form.trigger('submit');
        });

        $(document).on('submit', '#filter_form', function (e){
            e.preventDefault();
            $('.div-loader').removeClass('d-none');
            let form = $(this);
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
                    }else{
                        SwalModal2(response.msg, 'error');
                    }
                    $('.div-loader').addClass('d-none');
                },
                error: function (response) {
                    SwalModal2('حدث خطأ ما!', 'errors');
                    $('.div-loader').addClass('d-none');
                }
            })
        });

        $(document).on('click', '.page.page-link', function (e){
            e.preventDefault();
            let btn = $(this);
            $('.div-loader').removeClass('d-none');
            let next = btn.data('page')?btn.data('page'):1;
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "GET",
                url: '{{route('portal.v2.checks.index')}}',
                data: {
                    'page': next,
                    'FROM_DATE': $('#filter_form').find('[name="FROM_DATE"]').val(),
                    'TO_DATE': $('#filter_form').find('[name="TO_DATE"]').val(),
                    'FROM_AMOUNT': $('#filter_form').find('[name="FROM_AMOUNT"]').val(),
                    'TO_AMOUNT': $('#filter_form').find('[name="TO_AMOUNT"]').val(),
                    'CHECK_STATUS_ID': $('#filter_form').find('[name="CHECK_STATUS_ID"]').val(),
                    'CURR_ID': $('#filter_form').find('[name="CURR_ID"]').val(),
                    'FROM_RECEIPT_DATE': $('#filter_form').find('[name="FROM_RECEIPT_DATE"]').val(),
                    'TO_RECEIPT_DATE': $('#filter_form').find('[name="TO_RECEIPT_DATE"]').val(),
                    'ORDER_COLUMN_NAME': sortValues['ORDER_COLUMN_NAME'],
                    'ORDER_TYPE': sortValues['ORDER_TYPE'],
                    'IS_COLUMN_DATE': sortValues['IS_COLUMN_DATE'],
                    'CHECK_NUM': $('#filter_form').find('[name="CHECK_NUM"]').val(),
                },
                success: function (response) {
                    if(response.status){
                        $('#items_here').html(response.html);
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
