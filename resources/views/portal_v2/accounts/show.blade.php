@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">حساباتي</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.accounts.index')}}">حساباتي</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">تفاصيل</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <div class="dropdown dropdown-select mb-4">
                    <button class="btn btn-secondary btn-xl dropdown-toggle px-3 bg-white text-secondary w-100 d-flex align-items-center justify-content-between shadow" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{$account['ACCOUNT_NUM']}}
                    </button>
                    <ul class="dropdown-menu text-end">
                        @foreach($accounts as $i=>$item)
                            <li class="border-bottom"><a class="dropdown-item {{$item['ACCOUNT_NUM']==$account['ACCOUNT_NUM']?'text-secondary':''}}" href="{{$i==$index?'javascript:void(0)':route('portal.v2.accounts.show', $i)}}">{{$item['ACCOUNT_TYPE_DESC']}} - {{$item['CURR_NAME_DESC']}} <br> {{$item['ACCOUNT_NUM']}} </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form class="row mb-2" id="filter_form" action="{{route('portal.v2.accounts.search', $index)}}">
                    <!-- Search Start -->
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="input-group mb-4 mb-xxl-0 fromToValidation" data-isDate="1">
                            <div class="form-floating w-50">
                                <input type="text" name="TRANS_DATE_FROM" class="from date-picker-close rounded-0 rounded-end form-control" placeholder="من تاريخ" autocomplete="off">
                                <label>من تاريخ</label>
                            </div>
                            <div class="form-floating w-50">
                                <input type="text" name="TRANS_DATE_TO" class="to date-picker-close rounded-0 rounded-start form-control" placeholder="إلى تاريخ" autocomplete="off">
                                <label>إلى تاريخ</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="input-group mb-4 mb-xxl-0 fromToValidation" data-isDate="0">
                            <div class="form-floating w-50">
                                <input type="number" name="TRANS_AMOUNT_FROM" class="from rounded-0 rounded-end form-control formattedNumber" placeholder="المبلغ من" autocomplete="off">
                                <label>المبلغ من</label>
                            </div>
                            <div class="form-floating w-50">
                                <input type="number" name="TRANS_AMOUNT_TO" class="to rounded-0 rounded-start form-control formattedNumber" placeholder="المبلغ الى" autocomplete="off">
                                <label>المبلغ الى</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-2">
                        <div class="form-floating mb-4 mb-xxl-0 w-100">
                            <select class="select-floating-with-search" name="DEBIT_CREDIT_ID">
                                <option value="0">الكل</option>
                                @foreach($constants['DEBIT_CREDIT'] as $item)
                                    <option value="{{$item['DEBIT_CREDIT_ID']}}">{{$item['DEBIT_CREDIT']}}</option>
                                @endforeach
                            </select>
                            <label>نوع الحركة</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-2">
                        <div class="form-floating mb-4 mb-xxl-0 w-100">
                            <select class="select-floating-with-search" name="NO_OF_TRANS">
                                <option value="0">الكل</option>
                                <option value="10">10 حركات</option>
                                <option value="20">20 حركات</option>
                                <option value="20">50 حركات</option>
                                <option value="20">100 حركات</option>
                            </select>
                            <label>عدد الحركة</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2 col-xxl-2 text-end">
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
                    <!-- Search End -->
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 mb-5">
                <div class="card mb-5">
                    <div class="card-header text-center">
                        <div class="text-start">
                            <span class="{{$account['ACCOUNT_STATUS_ID']==1?'text-success':'text-danger'}} fw-bold">{{$account['ACCOUNT_STATUS_DESC']}}</span>
                        </div>
                        @if($account['CURR_ID']==1)
                            <img src="{{asset('assets')}}/img/currencies/dollar.png" alt="" class="my-3" height="30">
                        @elseif($account['CURR_ID']==2)
                            <img src="{{asset('assets')}}/img/currencies/dinar.png" alt="" class="my-3" height="30">
                        @elseif($account['CURR_ID']==3)
                            <img src="{{asset('assets')}}/img/currencies/ils.png" alt="" class="my-3" height="30">
                        @elseif($account['CURR_ID']==4)
                            <img src="{{asset('assets')}}/img/currencies/euro.png" alt="" class="my-3" height="30">
                        @else
                            <img src="{{asset('assets')}}/img/currencies/pound.png" alt="" class="my-3" height="30">
                        @endif
                        <div class="">
                            <h5 class="card-title fw-bold">{{$account['ACCOUNT_TYPE_DESC']}} - {{$account['CURR_NAME_DESC']}}</h5>
                            <h5 class="card-title fw-bold">{{$account['PROFILE_NAME']}}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="bg-primary text-center px-3 py-2 rounded-lg text-white mb-3">الرصيد الحالي:
                            <span dir="ltr">{{NumberFormat($account['ACCOUNT_BALANCE'], $account['CURR_DECIMAL_PLACES'])}}</span> </h4>
                        <h4 class="bg-primary text-center px-3 py-2 rounded-lg text-white mb-3">الرصيد المتوفر:
                            <span dir="ltr">{{NumberFormat($account['AVAILABLE_BALANCE'], $account['CURR_DECIMAL_PLACES'])}}</span> </h4>
                        <div class="row g-0 border border-light px-3 py-2 rounded-lg align-items-center mb-2">
                            <div class="row g-0  d-flex align-items-center">
                                <div class="col fw-bold align-content-center">
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold">رقم الحساب</div>
                                    </div>
                                </div>
                                <div class="col-auto align-content-center">
                                    <div class=" d-flex fw-bold align-items-center" dir="ltr">{{$account['ACCOUNT_NUM']}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="card-footer text-muted text-center">أخر حركة  <span class="fw-bold">{{Carbon\Carbon::parse($account['LAST_TRANS_DATE'])->translatedFormat('d/m/Y h:m a')}}</span></div>--}}
                </div>
            </div>
            <div class="col-xl-8 mb-5">
                <ul class="nav nav-pills responsive-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item ms-3" role="presentation">
                        <button class="nav-link active" id="request-data-1" data-bs-toggle="tab" data-bs-target="#request-data-1-pane" type="button" role="tab" aria-controls="request-data-1-pane" aria-selected="true"><i class="fa-solid fa-circle-info ms-2"></i> أخر الحركات</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center" id="request-comments-1" data-bs-toggle="tab" data-bs-target="#request-comments-1-pane" type="button" role="tab" aria-controls="request-comments-1-pane" aria-selected="false"><i class="fa-solid fa-comments ms-2"></i> التعليقات والمرفقات <span class="me-2 comments-number d-inline-block">
                        <div class="badge bg-secondary" id="commentCount">{{count($comments)}}</div>
                      </span></button>
                    </li>
                    <li class="nav-item me-auto" role="presentation">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle px-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">كشف حساب</button>
                            <ul class="dropdown-menu text-start">
                                <li><a class="dropdown-item export_account" role="button" href="{{route('portal.v2.accounts.print', [1, $index])}}">Arabic PDF</a></li>
                                <li><a class="dropdown-item export_account" role="button" href="{{route('portal.v2.accounts.print', [3, $index])}}">English PDF</a></li>
                                <li><a class="dropdown-item export_account" role="button" href="{{route('portal.v2.accounts.print', [100, $index])}}">Excel</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <!-- Item List Start -->
                <div class="tab-content h-100-card" id="myTabContent">
                    <div class="tab-pane fade show active h-100" id="request-data-1-pane" role="tabpanel" aria-labelledby="request-data-1"  tabindex="0">
                        <div class="row">
                            <div class="col-12 mb-5 position-relative">
                                <div class="div-loader fs-2 d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                                <div id="trans_item_here">
                                    @include('portal_v2.accounts.trans')
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade h-100" id="request-comments-1-pane" role="tabpanel" aria-labelledby="request-comments-1" tabindex="0">
                        <div class="card loan-chat-box mb-2">
                            <div class="card-body d-flex flex-column h-100 w-100 position-relative">
                                <div class="h-100 mb-n2 scroll mt-3 mt-sm-0">
                                    <div class="h-100 scroll-track-visible px-3" id="comments_display">
                                        @include('portal_v2.accounts.comments')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <form class="add-comment" id="add_comment" action="{{route('portal.v2.accounts.comment.add')}}">
                                <div class="card-body p-0 d-flex flex-row align-items-center px-3 py-3">
                                    <input type="text" name="index" value="{{$index}}" hidden>
                                    <input type="text" name="BRANCH_ID" value="{{$account['BRANCH_ID']}}" hidden>
                                    <input type="text" name="ACC_NUM" value="{{$account['CUST_ID']}}" hidden>
                                    <input type="text" name="LEDGER_ID" value="{{$account['LEDGER_ID']}}" hidden>
                                    <input type="text" name="CURR_ID" value="{{$account['CURR_ID']}}" hidden>
                                    <input type="text" name="ACC_SUB_NUM" value="{{$account['ACC_SUB_NUM']}}" hidden>
                                    <textarea class="form-control me-3 border-0 ps-2 py-2" placeholder="اكتب هنا" rows="1" name="COMMENT_DESCRIPTION" id="COMMENT_DESCRIPTION"></textarea>
                                    <div class="d-flex flex-row">
                                        <input class="file-upload d-none" type="file" name="COMMENT_ATTACHMENTS[]" multiple onchange="loadFile(this)" accept="{{acceptImagePdfType()}}" id="attachButton">
                                        <span id="attach_info"></span>
                                        <label class="btn btn-icon btn-icon-only btn-outline-secondary mb-1 rounded-xl" for="attachButton">
                                            <i class="fa-solid fa-paperclip"></i>
                                        </label>
                                        <button class="btn btn-icon btn-icon-only btn-secondary mb-1 rounded-xl me-1" type="submit">
                                            <div class="text"><i class="fa-solid fa-chevron-left"></i></div>
                                            <div class="btn-loader d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="row_notes" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body wizard" id="wizardBasic">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        #attach_info{
            display: inline-flex;
            align-items: center;
            padding: 0px 10px;
            height: 32px;
            white-space: nowrap;
        }
        .dropdown.dropdown-select .dropdown-item:hover{
            color: var(--secondary) !important;
        }
        .dropdown.dropdown-select .dropdown-menu{
            width: 100%!important;
            transform: unset;
            top: 36px;
        }
    </style>
@endpush

@push('script')
    <script>
        let sortValues = [];
        sortValues['ORDER_COLUMN_NAME'] = '';
        sortValues['ORDER_TYPE'] = '';
        sortValues['IS_COLUMN_DATE'] = '';
        sortableTable('{{route('portal.v2.accounts.search', $index)}}', '#trans_item_here');

        $('.filter_reset').on('click', function (e){
            let form = $(this).parents('form');
            form.trigger('reset');
            form.find('select').val(0).trigger('change');
            form.trigger('submit');
        });

        $(document).on('click', '.display_notes', function (e){
            let notes = $(this).attr('data-notes');
            $('#row_notes .modal-body').html('<p>'+notes+'</p>');
            $('#row_notes').modal('show');
        });

        $(document).on('submit', '#filter_form', function (e){
            e.preventDefault();
            let form = $(this);
            loaderStart(form);
            form.find('.invalid-feedback').remove();
            if(!validateFilter()){
                loaderEnd(form);
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
                        $('#trans_item_here').html(response.html);
                        activeCountScroll();
                        loaderEnd(form);
                    }else{
                        SwalModal2(response.msg, 'error');
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

        var loadFile = function (event) {
            let attach = event.files;
            let count = attach.length;
            if(count == 1){
                $('#attach_info').html(attach[0].name)
            }else{
                $('#attach_info').html(count+' مرفقات');
            }
        };

        $(document).on('submit', '#add_comment', function (e){
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
                        $('#comments_display').html(response.html);
                        activeScroll();
                        $('#commentCount').html(response.count);
                        form.trigger('reset');
                        $('#attach_info').html('');
                        SwalModal2(response.msg, 'success');
                    }else{
                        SwalModal2(response.msg, 'error');
                    }
                    loaderEnd(form);
                },
                error: function (response) {
                    let html = '';
                    $.each(response.responseJSON.errors, function (index, value) {
                        html += value+',';
                    });
                    SwalModal2(html, 'error');
                    loaderEnd(form);
                }
            })
        });

    </script>
@endpush

@push('page_style')
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/baguetteBox.min.css" />

    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/bootstrap-datepicker3.standalone.min.css" />
@endpush

@push('page_script')
    <script src="{{asset('assets')}}/js/vendor/movecontent.js"></script>
    <script src="{{asset('assets')}}/js/vendor/select2.full.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/profile.settings.js"></script>

    <script src="{{asset('assets')}}/js/forms/layouts.js"></script>

    <script src="{{asset('assets')}}/js/vendor/baguetteBox.min.js"></script>
    <script src="{{asset('assets')}}/js/plugins/lightbox.js"></script>

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
