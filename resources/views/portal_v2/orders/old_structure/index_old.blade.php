@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">

        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">طلباتي</h1>
                </div>
            </div>
        </div>

        @if(count($beneficiaries) > 0 || count($transfers) > 0 || count($tickets) > 0 || count($deposits) > 0)
            <div class="card mb-4">
                <div class="card-body">
                    <form class="row mb-2 gx-3" id="filter_form" action="{{route('portal.v2.orders.filter')}}">
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-3">
                            <div class="form-floating mb-4 mb-xxl-0">
                                <input type="number" name="REQUEST_SEQ" class="form-control" placeholder="رقم الطلب" value="" autocomplete="off"/>
                                <label>رقم الطلب</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="form-floating mb-4 mb-xxl-0 w-100">
                                <select class="select-floating-with-search" name="APPROVAL_STATUS_ID">
                                    <option value="0">الكل</option>
                                    @foreach($constants['TWO_FACTOR_AUTHENTICATION_STATUSES'] as $item)
                                        @if($item['VALUE'] != 2)
                                            <option value="{{$item['VALUE']}}" {{$item['VALUE']==1?'selected':''}}>{{$item['LABEL']}}</option>
                                       @endif
                                    @endforeach
                                </select>
                                <label>حالة الطلب</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-2 text-end">
                            <button type="submit" class="btn btn-xl btn-secondary px-3">
                                <div class="text"><i data-acorn-icon="search"></i></div>
                                <div class="btn-loader d-none">
                                    <div class="spinner-border spinner-border-sm text-light" role="status">
                                        <span class="visually-hidden">جاري البحث</span>
                                    </div>
                                </div>
                            </button>
                            <button type="button" class="btn btn-xl btn-outline-secondary px-3 filter_reset me-2">
                                <div class="text"><i data-acorn-icon="rotate-right"></i></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <section class="scroll-section  position-relative" id="responsiveTabs">
                <div class="card mb-3 mt-5">
                    <div class="card-header border-0 pb-0">
                        <ul class="nav nav-tabs nav-tabs-line card-header-tabs responsive-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{$tab!='transfers'&&$tab!='tickets'&&$tab!='deposits'?'active':''}}" data-bs-toggle="tab" data-bs-target="#first" role="tab" type="button" aria-selected="true">المستفيدين</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{$tab=='transfers'?'active':''}}" data-bs-toggle="tab" data-bs-target="#second" role="tab" type="button" aria-selected="false">الحوالات</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{$tab=='tickets'?'active':''}}" data-bs-toggle="tab" data-bs-target="#third" role="tab" type="button" aria-selected="false">التذاكر</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{$tab=='deposits'?'active':''}}" data-bs-toggle="tab" data-bs-target="#fourth" role="tab" type="button" aria-selected="false">ربط الودائع</button>
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
                    <div class="card-body position-relative">
                        <div class="div-loader fs-2 d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                        <div class="tab-content">
                            <div class="tab-pane fade {{$tab!='transfers'&&$tab!='tickets'&&$tab!='deposits'?'active show':''}}" id="first" role="tabpanel">
                                @include('portal_v2.orders.beneficiaries')
                            </div>
                            <div class="tab-pane fade {{$tab=='transfers'?'active show':''}}" id="second" role="tabpanel">
                                @include('portal_v2.orders.transfers')
                            </div>
                            <div class="tab-pane fade {{$tab=='tickets'?'active show':''}}" id="third" role="tabpanel">
                                @include('portal_v2.orders.tickets')
                            </div>
                            <div class="tab-pane fade {{$tab=='deposits'?'active show':''}}" id="fourth" role="tabpanel">
                                @include('portal_v2.orders.deposits.index')
                            </div>
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
                            <h4 class="fw-bold">لا يوجد طلبات</h4>
                            <p class="mb-5">لا يوجد لديك طلبات حتى الآن</p>
                        </div>
                    </div>
                    <div class="bg-brand-v2"></div>
                </div>
            </div>
        </div>
        @endif

        <div class="modal fade" id="confirm_modal" data-bs-keyboard="false" role="dialog"  tabindex="0" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addnewLabel">الخطوات</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="confirm_form" action="{{{route('portal.v2.orders.change')}}}">
                    <div class="modal-body" id="modal_info">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-secondary">
                            <div class="text">حفظ</div>
                            <div class="btn-loader d-none">
                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">جاري الحفظ</span>
                                </div>
                                <span>جاري الحفظ</span>
                            </div>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="details_modal" data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addnewLabel">تفاصيل الطلب</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
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
        @media (min-width: 992px){
            .modal-lg{
                max-width: 700px;
            }
        }
        .btn.btn-outline-danger:disabled{
            box-shadow: inset 0 0 0 1px var(--danger) !important;
        }
    </style>
@endpush

@push('script')
    <script>

        $(document).on('click', '.filter_reset', function (e){
            let form = $(this).parents('form');
            form.trigger('reset');
            form.find('select').val(0).trigger('change');
            form.find('select[name="APPROVAL_STATUS_ID"]').val(1).trigger('change');
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
                        $('#first').html(response.beneficiaries_html);
                        $('#second').html(response.transfers_html);
                        $('#third').html(response.tickets_html);
                        $('#fourth').html(response.deposits_html);
                        runStaff();
                    }else{
                        errorShow(form, response.msg);
                    }
                    $('.div-loader').addClass('d-none');
                },
                error: function (response) {
                    SwalModal2('حدث خطأ ما!', 'errors');
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
                url: '{{route('portal.v2.orders.transfers.print')}}',
                data: {
                    'VOUCHER_SEQ': btn.data('seq')
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

        $(document).on('click', '.page.page-link', function (e){
            e.preventDefault();
            let btn = $(this);
            $('.div-loader').removeClass('d-none');
            let next = btn.data('page');
            let type = btn.data('type');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "GET",
                url: '{{route('portal.v2.orders.index')}}',
                data: {
                    'page': next,
                    'type': type,
                    'REQUEST_SEQ': $('input[name="REQUEST_SEQ"]').val(),
                    'APPROVAL_STATUS_ID': $('select[name="APPROVAL_STATUS_ID"]').val(),
                },
                success: function (response) {
                    if(response.status){
                        if(type==1){
                            $('#first').html(response.html);
                        }else if(type==2) {
                            $('#second').html(response.html);
                        }else if(type==3){
                            $('#third').html(response.html);
                        }else{
                            $('#fourth').html(response.html);
                        }
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
        $(document).on('click', '.request_details', function (e){
            e.preventDefault();
            let btn = $(this);
            let seq = btn.data('seq');
            let type = btn.data('type');
            let status = btn.data('status');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{route('portal.v2.orders.details')}}',
                type: 'POST',
                data: {
                    'seq': seq,
                    'type': type,
                    'status': status,
                },
                success: function (response) {
                    if(response.status){
                        $('#details_modal .modal-body').html(response.html);
                        $('#details_modal').modal('show');
                    }else{
                        SwalModal2(response.msg, 'error');
                    }
                },
            });
        });
        $(document).on('click', '.step_request', function (e){
            e.preventDefault();
            let btn = $(this);
            let answer = btn.data('answer');
            let seq = btn.data('seq');
            let id = btn.data('id');
            let type = btn.data('type');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{route('portal.v2.orders.steps')}}',
                type: 'POST',
                data: {
                    'answer': answer,
                    'seq': seq,
                    'id': id,
                    'type': type,
                },
                success: function (response) {
                    if(response.status){
                        $('#confirm_modal #modal_info').html(response.html);
                        $('#confirm_modal').modal('show');
                    }else{
                        SwalModal2(response.msg, 'error');
                    }
                },
            });
        });
        $(document).on('submit', '#confirm_form', function (e){
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
                        if(response.approval){
                            if(form.find('input[name="type"]').val()==1){
                                $('#order1-'+form.find('input[name="BENEFICIARY_SEQ"]').val()).remove();
                            }else if(form.find('input[name="type"]').val()==2){
                                $('#order2-'+form.find('input[name="VOUCHER_SEQ"]').val()).remove();
                            }else if(form.find('input[name="type"]').val()==3){
                                $('#order3-'+form.find('input[name="TICKET_SEQ"]').val()).remove();
                            }else{
                                $('#order4-'+form.find('input[name="DEPOSIT_SEQ"]').val()).remove();
                            }
                        }
                        $('#confirm_modal').modal('hide');
                        loaderEnd(form);
                    }else{
                        SwalModal2(response.msg, 'error');
                        loaderEnd(form);
                    }
                },
            });
        });
        $(document).on('click', '.reject_request', function (e){
            e.preventDefault();
            Swal.fire({
                text: 'هل أنت متأكد أنك تريد إلغاء الطلب المحدد؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D79A2B',
                cancelButtonColor: '#F64E60',
                confirmButtonText: 'نعم ، إلغاء!',
                cancelButtonText: 'لا ، تراجع'
            }).then((result) => {
                if (result.value) {
                    let btn = $(this);
                    let answer = btn.data('answer');
                    let seq = btn.data('seq');
                    let id = btn.data('id');
                    let type = btn.data('type');
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{route('portal.v2.orders.reject')}}',
                        type: 'POST',
                        data: {
                            'answer': answer,
                            'seq': seq,
                            'id': id,
                            'type': type,
                        },
                        success: function (response) {
                            if(response.status){
                                if(type == 1){
                                    $('#order1-'+seq).remove();
                                }else if(type == 2){
                                    $('#order2-'+seq).remove();
                                }else if(type == 2){
                                    $('#order3-'+seq).remove();
                                }else{
                                    $('#order4-'+seq).remove();
                                }
                                SwalModal2(response.msg, 'success');
                            }else{
                                SwalModal2(response.msg, 'error');
                            }
                        },
                    });
                }
            });
        });
        $(document).on('click', '.undo_step_request', function (e){
            e.preventDefault();

            Swal.fire({
                text: 'هل أنت متأكد أنك تريد إلغاء حالة الخطوة المحدد؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D79A2B',
                cancelButtonColor: '#F64E60',
                confirmButtonText: 'نعم ، إلغاء!',
                cancelButtonText: 'لا ، تراجع'
            }).then((result) => {
                if (result.value) {
                    let btn = $(this);
                    let seq = btn.data('seq');
                    let type = btn.data('type');
                    let step = btn.data('step');
                    let role = btn.data('role');
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{route('portal.v2.orders.undo')}}',
                        type: 'POST',
                        data: {
                            'seq': seq,
                            'type': type,
                            'step': step,
                            'role': role,
                        },
                        success: function (response) {
                            if(response.status){
                                $('#confirm_modal').modal('hide')
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
