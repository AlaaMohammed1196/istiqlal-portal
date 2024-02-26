@extends('portal.layouts.main')

@section('bodyExtra', 'data-fullpage=true')

@section('content')
    <div class="container d-flex flex-column">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">طلباتي</h1>
                </div>
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        @if(count($data) > 0)
        <div class="row d-flex flex-grow-1 my-requests-section overflow-hidden pb-2 loan-chat-box">
            <!-- Contact and Message List Start overflow-hidden   -->
            <div class="col-auto w-100 w-md-auto h-100 mb-3 d-none d-md-block">
                <div class="sw-md-30 sw-lg-40 w-100 d-flex flex-column  h-100">
                    <div class="card h-100">
                        <div class="card-header border-0 pb-0">
                            <ul class="nav nav-tabs nav-tabs-line card-header-tabs" role="tablist">
                                <li class="nav-item w-100 text-center" role="presentation">
                                    <span class="nav-link active" role="tab" aria-selected="true">الطلبات</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body h-100-card">
                            <div class="h-100">
                                <!-- Messages Start -->
                                <div class="h-100 scroll-out" role="tabpanel">
                                    <div class="h-100 py-0 pb-5 px-3 d-block scroll requests-menu">
                                        @foreach($data as $index=>$item)
                                            <a class="get_fund_details row w-100 d-flex flex-row g-0 mb-2 border-bottom py-2 p-0 request-list-item {{$index==0?'active':''}}" role="button" data-id="{{$item['FUND_ID']}}">
                                                <div class="col-auto">
                                                    <div class="sw-4 sh-4 rounded-xl d-flex justify-content-center align-items-center border border-secondary">
                                                        <i class="fa-solid fa-file-invoice text-secondary"></i>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card-body d-flex flex-row pt-0 pb-0 pe-3 ps-0 h-100 align-items-center justify-content-between">
                                                        <div class="d-flex flex-column">
                                                            <div class="mb-1 title">{{$item['PRODUCT_TYPE']}}</div>
                                                            <span class="fw-bold text-success">رقم الطلب: {{$item['FUND_ID']}}</span>
                                                            <span class="fw-bold">حالة الطلب:
                                                                @if($item['FUND_STATUS_ID'] == 0)
                                                                    <span class="text-muted">{{$item['FUND_STATUS_DESC']}}</span>
                                                                @elseif($item['FUND_STATUS_ID'] == 1 || $item['FUND_STATUS_ID'] == 3)
                                                                    <span class="text-success">{{$item['FUND_STATUS_DESC']}}</span>
                                                                @elseif($item['FUND_STATUS_ID'] == 2)
                                                                    <span class="text-muted">{{$item['FUND_STATUS_DESC']}}</span>
                                                                @elseif($item['FUND_STATUS_ID'] == 10)
                                                                    <span class="text-danger">{{$item['FUND_STATUS_DESC']}}</span>
                                                                @elseif($item['FUND_STATUS_ID'] == 13)
                                                                    <span class="text-danger">{{$item['FUND_STATUS_DESC']}}</span>
                                                                @endif
                                                            </span>
                                                            <span class="fw-bold">مدة القرض: {{$item['INSTALLMENT_CNT']}} شهر</span>
                                                            <div class=" mt-2 text-dark clamp-line" data-line="1" id="contactLastSeen">{{$item['APPLYED_ON']?\Carbon\Carbon::parse($item['APPLYED_ON'])->translatedFormat('d F Y h:m a'):''}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-3 position-relative z-index-1">
                @if(count($data) > 0)
                <div class="div-loader text-center fs-2 d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                <div class="flex-column h-100 w-100" id="fund_view">
                    @php $item=$data[0] @endphp
                    @include('portal.orders.fund')
                </div>
                @endif
            </div>
        </div>
        @else
            <div class="row gx-5 d-flex justify-content-center w-100">
                <div class="col-12 col-md-8">
                    <div class="card mb-5 py-5">
                        <div class="card-body ">
                            <div class="d-flex align-items-center flex-column py-5">
                                <svg class="svg-inline--fa fa-circle-info fa-2x text-secondary mb-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-info" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-144c-17.7 0-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32z"></path></svg><!-- <i class="fa-solid fa-circle-info fa-2x text-secondary mb-3"></i> Font Awesome fontawesome.com -->
                                <h4 class="fw-bold">لا يوجد طلبات</h4>
                                <p class="mb-5">
                                    لا يوجد لديك طلبات قائمة حتى الآن
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
                        <h5 class="modal-title" id="row_notesLabel">معلومات الرفض</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex mb-2">
                            <div class="ps-2">تاريخ الرفض: </div>
                            <div id="date" class="fw-bold"></div>
                        </div>
                        <div class="">
                            <div class="ps-2">سبب الرفض: </div>
                            <div id="text" class="fw-bold"></div>
                        </div>
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
        }
        .requests-menu .request-list-item:hover, .requests-menu .request-list-item.active{
            background-color: #F1F1F1;
        }
        .requests-menu .request-list-item.active .title {
            color: #d49839;
        }
        .data-is-complete-icon {
            right: -5px;
        }
        .tox .tox-statusbar{
            display: none!important;
        }
        .mce-content-body::before{
            left: unset;
            right: 1px;
        }
        .loan-chat-box {
            height: calc(100% - 152px);
        }
        .tox .tox-toolbar__group{
            padding: 0 5px !important;
        }
    </style>
@endpush

@push('script')

    <x-js.editor/>

    <script>
        $(document).on('click', '.display_notes', function (e){
            let notes = $(this).attr('data-notes');
            let date = $(this).attr('data-date');
            $('#row_notes .modal-body #text').html(notes);
            $('#row_notes .modal-body #date').html(date);
            $('#row_notes').modal('show');
        })

        $(document).ready(function() {
            $('.get_fund_details').on('click', function (e) {
                e.preventDefault();
                $('.div-loader').removeClass('d-none');
                let btn = $(this);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.orders.fund.get')}}',
                    data: {
                        'id': btn.data('id'),
                    },
                    success: function (response) {
                        if(response.status){
                            $('#fund_view').html(response.html);
                            activeScroll();
                            $('.request-list-item.active').removeClass('active');
                            btn.addClass('active');
                            baguetteBox.run('.lightbox');
                            tinymce.remove('.editor');
                            tinymce.init(editorSettings);
                        }else{
                            SwalModal(response.msg, 'error');
                        }
                        $('.div-loader').addClass('d-none');
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            html += value+',';
                        });
                        SwalModal(html, 'error');
                        $('.div-loader').addClass('d-none');
                    }
                })
            });
        });

        function cancelOrder(e){
            let btn = $(e);
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
                        type: "POST",
                        url: '{{route('portal.orders.cancel')}}',
                        data: {
                            'id': btn.data('id'),
                        },
                        success: function (response) {
                            if(response.status){
                                location.reload();
                            }else{
                                SwalModal(response.msg, 'error');
                            }
                            $('.div-loader').addClass('d-none');
                        },
                        error: function (response) {
                            let html = '';
                            $.each(response.responseJSON.errors, function (index, value) {
                                html += value+',';
                            });
                            SwalModal(html, 'error');
                            $('.div-loader').addClass('d-none');
                        }
                    })
                }
            });
        }

        function submitComment(e){
            let id = $(e).parents('.add-comment').attr('id');
            let form = $('#'+$(e).parents('.add-comment').attr('id'));
            let fundId = form.find('input[name="FUND_ID"]').val();
            let formData = new FormData(document.getElementById(id));
            loaderStart(form);
            let action = form.attr('action');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: action,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if(response.status){
                        $('#comments-'+fundId).html(response.html);
                        form.trigger('reset');
                        SwalModal(response.msg, 'success');
                    }else{
                        SwalModal(response.msg, 'error');
                    }
                    loaderEnd(form);
                },
                error: function (response) {
                    let html = '';
                    $.each(response.responseJSON.errors, function (index, value) {
                        html += value+',';
                    });
                    SwalModal(html, 'error');
                    loaderEnd(form);
                }
            })
        }

        function activeScroll(){
            OverlayScrollbars(document.querySelectorAll('.scroll'), {
                scrollbars: {autoHide: 'leave', autoHideDelay: 600},
                overflowBehavior: {x: 'hidden', y: 'scroll'},
            });
            OverlayScrollbars(document.querySelectorAll('.scroll-track-visible'), {
                overflowBehavior: {x: 'hidden', y: 'scroll'}
            });
        }

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
    <script>
        $(document).ready(function() {
            const triggerTabList = document.querySelectorAll('a.request-list-item[data-bs-toggle="pill"]')
            triggerTabList.forEach(triggerEl => {
                const tabTrigger = new bootstrap.Tab(triggerEl)
                triggerEl.addEventListener('click', event => {
                    $('a.request-list-item[data-bs-toggle="pill"]').removeClass('active');
                    $('a.request-list-item[data-bs-toggle="pill"]').attr('aria-selected','false');
                    event.preventDefault()
                    tabTrigger.show()
                })
            })
        });
    </script>
@endpush
