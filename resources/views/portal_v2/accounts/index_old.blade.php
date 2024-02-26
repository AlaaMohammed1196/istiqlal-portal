@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">

        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">حساباتي</h1>
                </div>
            </div>
        </div>

        @if(count($accounts) > 0)
        <div class="row">
            <div class="col-12 mb-4 text-start">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle px-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">كشف حساب</button>
                    <ul class="dropdown-menu text-start">
                        <li><a class="dropdown-item export_account" role="button" href="{{route('portal.v2.accounts.print', [1])}}">Arabic PDF</a></li>
                        <li><a class="dropdown-item export_account" role="button" href="{{route('portal.v2.accounts.print', [3])}}">English PDF</a></li>
                        <li><a class="dropdown-item export_account" role="button" href="{{route('portal.v2.accounts.print', [100])}}">Excel</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row" id="items_here">
            @include('portal_v2.accounts.items')
        </div>
            @if($pages['has_more_pages'])
            <div class="col-12 text-center">
                <button type="button" id="next_page" class="btn btn-secondary" data-page="{{$pages['current_page']}}" data-max="{{$pages['allPagesCount']}}">
                    <div class="text"><i class="fa-solid fa-chevron-down"></i> عرض المزيد</div>
                    <div class="btn-loader d-none">
                        <div class="spinner-border spinner-border-sm text-light" role="status">
                            <span class="visually-hidden">جاري العرض</span>
                        </div>
                        <span>جاري العرض</span>
                    </div>
                </button>
            </div>
            @endif
        @else
            <div class="row gx-5 d-flex justify-content-center w-100">
                <div class="col-12 col-md-8">
                    <div class="card mb-5 py-5">
                        <div class="card-body ">
                            <div class="d-flex align-items-center flex-column py-5">
                                <svg class="svg-inline--fa fa-circle-info fa-2x text-secondary mb-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-info" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-144c-17.7 0-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32z"></path></svg><!-- <i class="fa-solid fa-circle-info fa-2x text-secondary mb-3"></i> Font Awesome fontawesome.com -->
                                <h4 class="fw-bold">لا يوجد حسابات</h4>
                                <p class="mb-5">لا يوجد لديك حسابات حتى الآن</p>
                            </div>
                        </div>
                        <div class="bg-brand-v2"></div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('style')

@endpush

@push('script')
    <script>
        $(document).on('click', '.page.page-link', function (e){
            e.preventDefault();
            let btn = $(this);
            $('.div-loader').removeClass('d-none');
            let next = btn.data('page');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "GET",
                url: '{{route('portal.v2.accounts.index')}}',
                data: {
                    'page': next,
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
        {{--$(document).on('click', '#next_page', function (e){--}}
        {{--    e.preventDefault();--}}
        {{--    let btn = $(this);--}}
        {{--    btnLoaderStart(btn);--}}
        {{--    let current = btn.data('page');--}}
        {{--    let max = btn.data('max');--}}
        {{--    let next = current+1;--}}
        {{--    $.ajax({--}}
        {{--        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
        {{--        type: "GET",--}}
        {{--        url: '{{route('portal.v2.accounts.index')}}',--}}
        {{--        data: {--}}
        {{--            'page': next--}}
        {{--        },--}}
        {{--        success: function (response) {--}}
        {{--            if(response.status){--}}
        {{--                $('#items_here').append(response.html);--}}
        {{--                btn.attr('data-page', next);--}}
        {{--                btnLoaderEnd(btn);--}}
        {{--                if(next==max){--}}
        {{--                    btn.attr('disabled', 'true');--}}
        {{--                }--}}
        {{--            }else{--}}
        {{--                SwalModal2('حدث خطأ ما!', 'errors');--}}
        {{--                btnLoaderEnd(btn);--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function (response) {--}}
        {{--            SwalModal2('حدث خطأ ما!', 'errors');--}}
        {{--            btnLoaderEnd(btn);--}}
        {{--        }--}}
        {{--    })--}}
        {{--});--}}

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
