@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">التذاكر</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.v2.tickets.index')}}">التذاكر</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">تذكرة</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <section class="scroll-section  position-relative" id="responsiveTabs">
            <div class="card mb-2">
                <div class="card-body border-last-none">
                    <div class="mb-4 pb-4 border-bottom border-separator-light">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <h3 class="heading text-primary fw-bold">رقم التذكرة {{$data['TICKET_ID']}}</h3>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="text-secondary mb-1">عنوان التذكرة</div>
                                <div class="h4 fw-bold">{{$data['TICKET_TITLE']}}</div>
                            </div>
                            <div class="col-md-2 text-start mb-3">
                                <div class="text-secondary mb-1">حالة التذكرة</div>
                                <div class="h5">{{$data['TICKET_STATUS_DESC']}}</div>
                            </div>
                            <div class="col-md-2 text-start mb-3">
                                <div class="text-secondary mb-1">تاريخ التذكرة</div>
                                <div class="h5">{{Carbon\Carbon::parse($data['CREATED_ON'])->translatedFormat('d/m/Y h:m a')}}</div>
                            </div>
                            <div class="col-12">
                                <div class="text-secondary mb-1">وصف التذكرة</div>
                                <p>{{$data['TICKET_DESCRIPTION']}}</p>
                            </div>
                            @if(count($data['TICKET_ATTACMENTS']) > 0)
                            <div class="col-12">
                                <div class="row">
                                    @foreach($data['TICKET_ATTACMENTS'] as $attach)
                                        <div class="sw-30 ms-3 mt-3">
                                            <div class="row g-0 rounded-sm sh-8 border">
                                                <div class="col-auto">
                                                    <div class="sw-8 d-flex justify-content-center align-items-center h-100">
{{--                                                        <i data-acorn-icon="file-text" class="text-primary"></i>--}}
                                                        <i class="fa-regular fs-5 fa-file-lines text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="col rounded-sm-end d-flex flex-column justify-content-center ps-3">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-0 clamp-line" data-line="1">{{$attach['ORIGINAL_FILE_NAME']}}</p>
                                                        <a href="{{$attach['ATTACHMENT_LINK']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$attach['ORIGINAL_FILE_NAME']}}">
{{--                                                            <i data-acorn-icon="download" data-acorn-size="17" class="text-alternate stretched-link"></i>--}}
                                                            <i class="fa-solid fa-cloud-arrow-down text-alternate stretched-link"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div id="chat_html">
                        @include('portal_v2.tickets.chat')
                    </div>
                </div>
            </div>
            <!-- Consult Answer Start -->
            <div class="card">
                <div class="card-body">
                    <form id="add_comment" action="{{route('portal.v2.tickets.comment.store')}}">
                        <input type="text" hidden name="TICKET_ID" value="{{$data['TICKET_ID']}}">
                        <div class="form-floating mb-4">
                            <textarea class="form-control" id="COMMENT_DESCRIPTION" name="COMMENT_DESCRIPTION" placeholder="اكتب ما تريد..."></textarea>
                            <label>اكتب ما تريد...</label>
                        </div>
                        <div class="text-start">
                            <span id="attach_info"></span>
                            <input type="file" name="COMMENT_ATTACHMENTS[]" multiple id="COMMENT_ATTACHMENTS" onchange="loadFile(this)" hidden="">
                            <label type="button" class="btn btn-outline-primary btn-icon btn-icon-only me-1" for="COMMENT_ATTACHMENTS">
                                <i data-acorn-icon="attachment"></i>
                            </label>
                            <button class="btn btn-icon btn-icon-end btn-outline-secondary" type="submit">
                                <div class="text">
                                    <span>إرسال</span>
                                    <i data-acorn-icon="send"></i>
                                </div>
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
            <!-- Consult Answer End -->
        </section>
    </div>
@endsection

@push('style')
{{--    <style>--}}
{{--        footer{--}}
{{--            position: relative;--}}
{{--        }--}}
{{--    </style>--}}
@endpush

@push('script')
    <script>
        $(document).on('click', '.display_notes', function (e){
            let notes = $(this).attr('data-notes');
            $('#row_notes .modal-body').html('<p>'+notes+'</p>');
            $('#row_notes').modal('show');
        });

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
                        $('#chat_html').html(response.html);
                        form.trigger('reset');
                        $('#attach_info').html('');
                        SwalModal(response.msg, 'success');
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
