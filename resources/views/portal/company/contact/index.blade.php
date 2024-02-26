@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">بيانات الشركة</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{route('portal.company.info.index')}}">بيانات الشركة</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portal.company.contact.index')}}">بيانات العنوان والإنصال</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row gx-5">
            @include('portal.components.company_link_list')
            <div class="col-lg-8 col-xl-6">
                <!-- Details Start -->
                <h2 class="h4">بيانات العنوان والاتصال</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5">
                            <div class="row g-0 align-items-start mb-2">
                                <div class="col-12 col-md-2 col-xl-2  d-flex justify-content-between align-items-center justify-content-md-center flex-md-column ">
                                    <div class="border border-secondary sw-7 sh-7 sw-sm-10 sh-sm-10 rounded-xl d-flex justify-content-center align-items-center mb-3">
                                        <i class="fa-solid fa-address-card text-secondary fa-2x "></i>
                                    </div>
                                    <a href="{{route('portal.company.contact.edit')}}" class="text-nowrap"><i class="fa-solid fa-pen-to-square"></i> تعديل البيانات</a>
                                </div>
                                <div class="col-12  col-md-10  col-xl-10 pe-3">
                                    <div class="row g-0 border-bottom py-2">
                                        <div class="col-12">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold lh-1-25 h5"><i class="fa-solid fa-location-dot ms-2"></i> العنوان</div>
                                        </div>
                                    </div>
                                    <div class="row g-0 py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">
                                                @if(count($data)>0)
                                                    {{$data['CURR_COUNTRY']??''}}{{$data['CURR_STATE']?', '.$data['CURR_STATE']:''}}{{$data['CURR_CITY']?', '.$data['CURR_CITY']:''}}{{$data['CURR_ADDRESS']?', '.$data['CURR_ADDRESS']:''}}
                                                @else لا يوجد عنوان حالي
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom py-2">
                                        <div class="col-12">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold lh-1-25 h5"><i class="fa-solid fa-phone ms-2"></i> الاتصال</div>
                                        </div>
                                    </div>
                                    <div class="row g-0 py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">البريد الإلكتروني</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">
                                                @if(count($data)>0)
                                                    {{$data['CONTACT_EMAIL']??'-'}}
                                                @else -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">رقم الهاتف الأرضي</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">
                                                @if(count($data)>0)
                                                    {{$data['CONTACT_TEL']??'-'}}
                                                @else -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 py-2">
                                        <div class="col-12 col-md">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">رقم الهاتف المتنقل</div>
                                        </div>
                                        <div class="col-12 col-md-auto">
                                            @if(count($data)>0)
                                                @if(count($data['CONTACT_CELULARS']) > 0)
                                                    @foreach($data['CONTACT_CELULARS'] as $index=>$number)
                                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">{{$number}}</div>
                                                    @endforeach
                                                @else -
                                                @endif
                                            @else
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">-</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                <a href="{{route('portal.company.info.index')}}" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto  mb-2"><svg class="svg-inline--fa fa-chevron-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path></svg><!-- <i class="fa-solid fa-chevron-right"></i> Font Awesome fontawesome.com --></a>
                                <a href="{{route('portal.company.partner.index')}}" class="btn btn-secondary w-100 w-sm-auto  mb-2">التالي</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Details End -->
            </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#form_data').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                loaderStart(form)
                errorHide(form);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: form.attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (response.status) {
                            window.location.href = response.url;
                        } else {
                            errorShow(form, response.msg);
                        }
                        loaderEnd(form)
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            showValidationError(form, index, value)
                        });
                        loaderEnd(form)
                    }
                })
            });
        });
        function showValidationError(form, index, value){
            form.find("input[name='"+index+"']").addClass('border-danger');
            form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
            form.find("select[name='"+index+"']").addClass('border-danger');
            form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
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

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
