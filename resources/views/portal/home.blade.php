@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-12 col-lg-6">
                    <a href="{{route('portal.home')}}">الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold fs-5" id="title">أهلاً وسهلاً بك في بوابة بنك الاستقلال للاستثمار والتنمية!</h1>
                    <h3 class="my-3 pb-0 fw-normal text-primary fs-5">مرحباً {{session()->get('user')['COMPANY_NAME']}}، نتمنى لك يوم جميل</h3>
                </div>
                <!-- Title End -->
                <div class="col-12 col-md-12 col-lg-6">
                    @if(count($notifications['AllNotifications']['Notifications']) > 0)
                        <div class="alert alert-info alert-dismissible fade show w-100" role="alert">
                            <strong>{{reset($notifications['AllNotifications']['Notifications'])['SUBJECT']}} </strong>
                            {{reset($notifications['AllNotifications']['Notifications'])['BODY_CONTENT']}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session()->get('user')['PASS_EXPIRED_SOON_FLAG'] == 1)
                        <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                            <strong>يجب تغيير كلمة المرور </strong>
                            <span>قبل تاريخ "{{session()->get('user')['PASS_EXPIRE_ON']}}" و ذلك لضمان استمرارية تفعيل الحساب</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                    <strong>تخضع جميع البيانات إلى السرية المصرفية بحسب ما نصت عليه تعليمات سلطة النقد الفلسطينية بالخصوص</strong>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 mb-5">
                <div class="card w-100 sh-100 bg-dark h-100 hover-img-scale-up position-relative">
                    <img src="{{asset('assets')}}/img/banner/dashboard-pic.webp" class="card-img h-100 scale " alt="" />
                    <div class="card-img-overlay d-flex justify-content-between bg-transparent">
                        <div class="col-xxl-4 col-xl-3 col-lg-4 col-md-4 col-sm-4"></div>
                        <div  class="col-xxl-8 col-xl-9 col-lg-8 align-items-center col-md-8 col-sm-8">
                            <div class="cta-2 text-white"></div>
                            <div class="cta-2 mb-3 text-white fw-bold">بنك الاستقلال للاستثمار والتنمية</div>
                            <div class="text-white lh-lg mb-3 d-none d-md-block">
                                يعمل وفق أفضل الممارسات وبالشراكة مع
                                المؤسسات والهيئات الرسمية والصناديق الحكومية والقطاع
                                الخاص، بما يسرع عملية التنمية الاجتماعية
                                والاقتصادية في فلسطين
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <!-- Stats Start -->
                <div class="row gx-2">
                    <div class="col-12 p-0">
                        <div class="glide glide-small" id="statsCarousel">
                            <div class="glide__track" data-glide-el="track">
                                <div class="glide__slides">
                                    <div class="glide__slide">
                                        <div class="card mb-5 hover-border-secondary">
                                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                                <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border border-secondary mt-4">
                                                    <i class="fa-solid fa-file-invoice fa-2x text-secondary"></i>
                                                </div>
                                                <a href="{{route('portal.loan-request.index')}}" class="text-center mb-4 h4 sh-8 d-flex align-items-center fw-bold lh-1-5 stretched-link">
                                                    طلب قرض
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="glide__slide">
                                        <div class="card mb-5 hover-border-secondary">
                                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                                <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border border-secondary mt-4">
                                                    <i class="fa-solid fa-calculator fa-2x text-secondary"></i>
                                                </div>
                                                <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#exampleModal"  class="text-center mb-4 h4 sh-8 d-flex align-items-center fw-bold lh-1-5 stretched-link">
                                                    حاسبة القروض
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="glide__slide">
                                        <div class="card mb-5 hover-border-secondary">
                                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                                <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border border-secondary mt-4">
                                                    <i class="fa-solid fa-money-check fa-2x text-secondary"></i>
                                                </div>
                                                <a href="{{route('portal.programs.index')}}" class="text-center mb-4 h4 sh-8 d-flex align-items-center fw-bold lh-1-5 stretched-link">
                                                    البرامج والقروض
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="glide__slide">
                                        <div class="card mb-5 hover-border-secondary">
                                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                                <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border border-secondary mt-4">
                                                    <i class="fa-regular fa-circle-question fa-2x text-secondary"></i>
                                                </div>
                                                <a href="{{asset('user_manual/story.html')}}" target="_blank" class="text-center mb-4 h4 sh-8 d-flex align-items-center fw-bold lh-1-5 stretched-link">
                                                    دليل المستخدم
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Stats End -->
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <!-- Stats Start -->
                <div class="row gx-2">
                    <div class="col-12 p-0">
                        <div class="glide glide-small" id="programsCarousel">
                            <div class="glide__track" data-glide-el="track">
                                <div class="glide__slides">
                                    @if(count($programs) > 0)
                                        @foreach($programs as $item)
                                            <div class="glide__slide">
                                                <div class="card  mb-5 hover-border-secondary">
                                                    <img src="{{$item['PROGRAM_PICTURE_LINK']??asset('assets/img/background/program-img.jpg')}}" class="card-img-top" alt="card image" height="130">
                                                    <div class="h-100  d-flex flex-column justify-content-between card-body align-items-center pt-0 top-m-30 program-body">
                                                        <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center bg-white align-items-center border border-secondary">
                                                            <i class="fa-solid fa-money-check fa-2x text-secondary"></i>
                                                        </div>
                                                        <a href="{{route('portal.programs.show', $item['VALUE'])}}" class="text-center h6 sh-5 d-flex align-items-center fw-bold lh-1-5">
                                                            {{$item['LABEL']}}
                                                        </a>
                                                        <div class="w-100 d-flex flex-column flex-lg-row mb-5 align-items-center justify-content-lg-between">
                                                            <a href="{{route('portal.programs.show', $item['VALUE'])}}" class="h5 mt-3">
                                                                <i class="fa-solid fa-rectangle-list ms-2"></i>
                                                                وصف البرنامج
                                                            </a>
                                                            <a href="javascript:void(0);" class="text-secondary mt-3 fw-bold h5 loans_btn" data-id="{{$item['VALUE']}}">
                                                                <i class="fa-solid fa-file-invoice ms-2"></i>
                                                                القروض
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="bg-brand-v2"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Stats End -->
            </div>
        </div>

        @if(count($installments) > 0 || $last)

        <div class="row align-items-center">

            <div class="col-12 col-xl-6">
                <h2 class="h5 fw-bold">الأقساط</h2>
                <!-- Item List Start -->
                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="card mb-2 bg-transparent no-shadow d-none d-md-block">
                            <div class="row g-0 sh-3">
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-6 col-md-5 d-flex align-items-center text-alternate text-medium text-nowrap">القرض</div>
                                            <div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium text-nowrap">المبلغ</div>
                                            <div class="col-6 col-md-3 d-flex align-items-center text-alternate text-medium text-nowrap">التاريخ</div>
                                            <div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium text-nowrap">قيمة القرض الإجمالية</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="scroll-out mb-n2 mb-5">
                            <div class="scroll-by-count" data-count="3">
                                @if(count($installments) > 0)
                                    @foreach($installments as $item)
                                        <div class="card mb-2 sh-11 sh-md-8">
                                            <div class="card-body pt-0 pb-0 h-100">
                                                <div class="row g-0 h-100 align-content-center">
                                                    <div class="col-8 col-md-5 d-flex align-items-center mb-1 mb-md-0">
                                                        <a href="javascript:void(0);" class="body-link text-truncate">
                                                            <i class="fa-solid fa-arrow-right-arrow-left ms-2 text-secondary"></i>
                                                            <span class="align-middle">{{$item['PRODUCT_TYPE']}}</span>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 col-md-2 d-flex align-items-center fw-bold">
                                                        {{$item['TOTAL_INSTALLMENT_VALUE']}} {{$item['CURR_NAME']}}</div>
                                                    <div class="col-11 col-md-3 d-flex align-items-center">{{$item['FORMTAED_DATE']?\Carbon\Carbon::parse($item['FORMTAED_DATE'])->translatedFormat('d F Y'):''}}</div>
                                                    <div class="col-4 col-md-2 d-flex align-items-center fw-bold text-secondary justify-content-end justify-content-end justify-content-md-start">{{$item['FINANCING_VALUE']}} {{$item['CURR_NAME']}}</div>
                                                </div>
                                                <div class="row g-0 h-100 align-content-center">
                                                    <div class="col-8 col-md-3 d-flex align-items-center mb-1 mb-md-0 order-1 order-md-1 order-md-12">
                                                        <a href="javascript:void(0);" class="body-link text-truncate">
                                                            <i class="fa-solid fa-arrow-right-arrow-left ms-2 text-secondary"></i>
                                                            <span class="align-middle">{{$item['PRODUCT_TYPE']}}</span>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 col-md-2 d-flex align-items-center fw-bold  order-3  order-md-2 order-md-8">
                                                        {{$item['TOTAL_INSTALLMENT_VALUE']}} {{$item['CURR_NAME']}}</div>
                                                    <div class="col-4 col-md-3 d-flex align-items-center  fw-bold text-secondary order-2  order-md-4 justify-content-end justify-content-end justify-content-md-start">{{$item['FINANCING_VALUE']}} {{$item['CURR_NAME']}}</div>
                                                    <div class="col-11 col-md-4 d-flex align-items-center  order-4  order-md-3 order-md-11">{{$item['FORMTAED_DATE']?\Carbon\Carbon::parse($item['FORMTAED_DATE'])->translatedFormat('d F Y'):''}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="card mb-2 sh-11 sh-md-8">
                                        <div class="card-body pt-0 pb-0 h-100">
                                            <div class="row g-0 h-100 align-content-center">
                                                <div class="col-12 d-flex align-items-center justify-content-center">لا يوجد أقساط حتى الآن للعرض</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Item List End -->
            </div>

            <div class="col-12 col-xl-6 mb-3">
                <section class="scroll-section" id="smallLineChartsTitle">
                    <div class="row g-2">
                        <div class="col-12 col-md-12 col-xl-12 col-xxl-12">
                            <div class="card py-5 mt-5">
                                <div class="card-body py-0 d-flex align-items-center">
                                    <div class="row g-0 d-flex w-100 align-items-center">
                                        @if($last)
                                        <div class="col sh-15 d-flex flex-column justify-content-center">
                                            <div class="custom-tooltip">
                                                <div class="text-primary">آخر الطلبات</div>
                                                <div class="title heading fw-bold h4 mb-0 text-secondary">{{$last['PRODUCT_TYPE']??''}}</div>
                                                <div class="text-primary text mt-5">قيمة القرض</div>
                                                <div class="cta-4 text-secondary fw-bold value d-inline-block h4 align-middle">{{$last['FINANCING_VALUE']??''}} {{$last['FINANCE_CURR_NAME']??''}}</div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-left">
                                            <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border border-secondary mb-2">
                                                <i class="fa-solid fa-file-invoice fa-2x text-secondary"></i>
                                            </div>
                                            <p class="text-center mb-0">{{$last['FUND_STATUS_DESC']??''}}</p>
                                        </div>
                                        @else
                                            <div class="col-12">
                                                <p class="text-center mb-0">لا يوجد طلبات قروض حتى الآن</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>

        @endif

        <div class="modal fade" id="loanModal" data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                <div class="modal-content" id="loans_here">
                </div>
            </div>
        </div>
    </div>

    @include('components.calculator')

@endsection

@push('style')
    <style>
        .form-control:disabled {
            -webkit-text-fill-color: #afafaf00 !important;
        }
        .form-floating .form-control:disabled ~ label{
            right: 0.75rem;
        }
        .card .card-img{
            object-position: right;
        }
    </style>
@endpush

@push('script')
    <script>
        let moneyMin = 4000;
        let moneyMax = 25000;
        let timeMin = 12;
        let timeMax = 60;
        $(document).ready(function() {
            function checkCalcValue(){
                let t = $('#time_input');
                let m = $('#money_input');
                let time = t.val();
                let money = m.val();
                $('.invalid-feedback.d-block').remove();
                if(!(time >= timeMin && time <= timeMax)){
                    let t_label = '{{__('msg.val_between', ['var' => 'قيمة التمويل المطلوب'])}} '+timeMin+'-'+timeMax;
                    $('#time_range').parent().append('<div class="invalid-feedback d-block">'+t_label+'</div>');
                }
                if(!(money >= moneyMin && money <= moneyMax)){
                    let m_label = '{{__('msg.val_between', ['var' => 'فترة سداد التمويل'])}} '+moneyMin+'-'+moneyMax;
                    $('#money_range').parent().append('<div class="invalid-feedback d-block">'+m_label+'</div>');
                }
                if((time >= timeMin && time <= timeMax) && (money >= moneyMin && money <= moneyMax)){
                    return true;
                }else{
                    return false;
                }
            }

            $('#time_range, #time_input').on('change', function (e) {
                let val = $(this).val();
                $('#time_input, #time_range').val(val);
                $('#rangeTimeVal').html(val);
            });

            $('#money_range, #money_input').on('change', function (e) {
                let val = $(this).val();
                $('#money_input, #money_range').val(val);
                $('#rangeMoneyVal').html(val);
            });

            $('#calculate_reset').on('click', function (e){
                e.preventDefault();
                $('.calculate_error_here p ').html('');
                $('.invalid-feedback.d-block').remove();
                $('#calculate_form').trigger('reset');
                $('#calculate_form').find('select').val(null).trigger('change');
                $('#calculate_form').find('.select2.full').removeClass('full');
                $('#monthly_payment .value').html('0')
                $('#payment_numbers').html('0');
                $('#require_payment').html('0');
                $('#return_percentage').html('0');
                $('#return_value').html('0');
                $('#total_number').html('0');
                $('#CURR_ID').prop('disabled', true);
                $('#money_input').prop('disabled', true);
                $('#money_range').prop('disabled', true);
                $('#time_input').prop('disabled', true);
                $('#time_range').prop('disabled', true);
                $('#min-time-amount').html('');
                $('#max-time-amount').html('');
                $('#min-amount').html('');
                $('#max-amount').html('');
            });

            $('#PRODUCT_TYPE_ID').on('change', function (e) {
                e.preventDefault();
                $('#CURR_ID').prop('disabled', true);
                let field = $(this);
                if(!field.val()){
                    return false;
                }
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.calculate.currencies.get')}}',
                    data: {
                        'PRODUCT_TYPE_ID': field.val(),
                    },
                    success: function (response) {
                        if (response.status) {
                            $('#CURR_ID').html(response.html);
                            $('#CURR_ID').prop('disabled', false);
                        }else{
                            SwalModal(response.msg, 'error');
                        }
                    }
                });
            });

            $('#CURR_ID').on('change', function (e) {
                e.preventDefault();
                $('#money_input').prop('disabled', true);
                $('#money_range').prop('disabled', true);
                let field = $(this);
                if(!field.val()){
                    return false;
                }
                let data = {
                    'PRODUCT_TYPE_ID': $('#PRODUCT_TYPE_ID').val(),
                    'CURR_ID': field.val(),
                }
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.calculate.money.get')}}',
                    data: data,
                    success: function (response) {
                        if (response.status) {
                            moneyMin = response.min;
                            moneyMax = response.max;
                            $('#money_input').prop('min', response.min);
                            $('#money_input').prop('max', response.max);
                            $('#money_range').prop('min', response.min);
                            $('#money_range').prop('max', response.max);
                            $('#min-amount').html(response.min);
                            $('#max-amount').html(response.max);
                            $('#money_input').prop('disabled', false);
                            $('#money_range').prop('disabled', false);
                            $('#money_input').val(response.min);
                            $('#money_range').val(response.min).trigger('change');
                        }else{
                            $('#money_input').prop('disabled', false);
                            $('#money_range').prop('disabled', false);
                        }
                    }
                });
            });

            $('#money_range').on('change', function (e) {
                e.preventDefault();
                $('#time_input').prop('disabled', true);
                $('#time_range').prop('disabled', true);
                let field = $(this);
                let data = {
                    'PRODUCT_TYPE_ID': $('#PRODUCT_TYPE_ID').val(),
                    'CURR_ID': $('#CURR_ID').val(),
                    'AMOUNT': field.val(),
                }
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.calculate.time.get')}}',
                    data: data,
                    success: function (response) {
                        if (response.status) {
                            timeMin = response.min;
                            timeMax = response.max;
                            $('#time_input').prop('min', response.min);
                            $('#time_input').prop('max', response.max);
                            $('#time_range').prop('min', response.min);
                            $('#time_range').prop('max', response.max);
                            $('#min-time-amount').html(response.min + ' شهر');
                            $('#max-time-amount').html(response.max + ' شهر');
                            $('#time_input').prop('disabled', false);
                            $('#time_range').prop('disabled', false);
                            $('#time_input').val(response.min);
                            $('#time_range').val(response.min);
                        }else{
                            $('#time_input').prop('disabled', false);
                            $('#time_range').prop('disabled', false);
                        }
                    }
                });
            });

            $('#calculate_form').on('submit', function (e) {
                e.preventDefault();
                let check = checkCalcValue();
                if(!check){
                    return false;
                }
                let form = $(this);
                $('.calculate_error_here p ').html('');
                let action = form.attr('action');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: action,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (response.status) {
                            $('#monthly_payment .value').html(response.data.monthly_payment);
                            $('#monthly_payment .currency').html($('#CURR_ID option:selected').text());
                            $('#payment_numbers').html(response.data.payment_numbers);
                            $('#require_payment').html(response.data.require_payment);
                            $('#return_percentage').html(response.data.return_percentage);
                            $('#return_value').html(response.data.return_value);
                            $('#total_number').html(response.data.total_number);
                        }else{
                            SwalModal(response.msg, 'error');
                        }
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            form.find("input[name='"+index+"']").after('<div class="invalid-feedback d-block">' + value + '</div');
                            form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                        });
                        loaderEnd(form);
                    }
                });
            });

        });
    </script>

    <script>

        $(document).ready(function() {
            $('.loans_btn').on('click', function (){
                let btn = $(this);
                let id = btn.data('id');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.loans.get')}}',
                    data: {
                        'id': id
                    },
                    success: function (response) {
                        if(response.status){
                            $('#loans_here').html(response.html);
                            $('#loanModal').modal('show');
                        }else{
                            SwalModal(response.msg, 'error');
                        }
                    },
                })
            })
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
