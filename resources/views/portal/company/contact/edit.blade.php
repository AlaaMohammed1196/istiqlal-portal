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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.info.index')}}">البيانات العامة</a></li>
                            <li class="breadcrumb-item">تعديل</li>
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
                        <div class="row g-0 align-items-start mb-2">
                            <form id="form_data" action="{{route('portal.company.contact.update')}}">
                                <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                                <div class="row g-0 border-bottom pb-2 mb-3">
                                    <div class="col-12">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold lh-1-25 h5"><i class="fa-solid fa-location-dot ms-2"></i> العنوان</div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">الدولة </label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <select class="select-single-with-search" name="CURR_COUNTRY_ID" id="CURR_COUNTRY_ID" data-placeholder="اختر الدولة" data-width="100%">
                                            <option></option>
                                            @foreach($countries as $item)
                                                <option value="{{$item['VALUE']}}" {{$item['VALUE']==$data['CURR_COUNTRY_ID']?'selected':''}}>{{$item['LABEL']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">المحافظة </label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <select class="select-single-with-search" {{$data['CURR_COUNTRY_ID']?'':'disabled'}} name="CURR_STATE_ID" id="CURR_STATE_ID" data-placeholder="اختر المحافظة" data-width="100%">
                                            <option></option>
                                            @if($data['CURR_COUNTRY_ID'])
                                                <?php $states = getStates($data['CURR_COUNTRY_ID']) ?>
                                                @foreach(collect($states)->where('PARENT_CONSTANT_ID', $data['CURR_COUNTRY_ID']) as $item)
                                                    <option value="{{$item['VALUE']}}" {{$item['VALUE']==$data['CURR_STATE_ID']?'selected':''}}>{{$item['LABEL']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">المدينة/البلدة </label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <select class="select-single-with-search" {{$data['CURR_STATE_ID']?'':'disabled'}} name="CURR_CITY_ID" id="CURR_CITY_ID" data-placeholder="اختر المدينة/البلدة" data-width="100%">
                                            <option></option>
                                            @if($data['CURR_STATE_ID'])
                                                <?php $cities = getCities($data['CURR_STATE_ID']) ?>
                                                @foreach(collect($cities)->where('PARENT_CONSTANT_ID', $data['CURR_STATE_ID']) as $item)
                                                    <option value="{{$item['VALUE']}}" {{$item['VALUE']==$data['CURR_CITY_ID']?'selected':''}}>{{$item['LABEL']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">العنوان</label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <input type="text" class="form-control" name="CURR_ADDRESS" id="CURR_ADDRESS" value="{{$data['CURR_ADDRESS']}}" />
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom py-2 mb-3">
                                    <div class="col-12">
                                        <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold lh-1-25 h5"><i class="fa-solid fa-phone ms-2"></i> الإتصال</div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">البريد الإلكتروني </label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <input type="text" class="form-control" name="CONTACT_EMAIL" id="CONTACT_EMAIL" value="{{$data['CONTACT_EMAIL']}}" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">رقم الهاتف الأرضي</label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
                                        <input type="text" class="form-control number-only" name="CONTACT_TEL" id="CONTACT_TEL" value="{{$data['CONTACT_TEL']}}" maxlength="9"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 col-form-label">رقم الهاتف المتنقل </label>
                                    <div class="col-sm-8 col-md-9 col-lg-9">
{{--                                        <input type="text" class="form-control number-only" name="CONTACT_CELULAR" id="CONTACT_CELULAR" value="{{$data['CONTACT_CELULAR']}}" maxlength="10"/>--}}
                                        <div id="CONTACT_CELULARS">
                                            <div class="form-group">
                                                <div data-repeater-list="CONTACT_CELULARS">
                                                    @if(count($data['CONTACT_CELULARS']) > 0)
                                                        @foreach($data['CONTACT_CELULARS'] as $index=>$number)
                                                            <div data-repeater-item>
                                                                <div class="row mt-3">
                                                                    <div class="col-12 col-md">
                                                                        <input type="text" class="form-control number-only" value="{{$number}}" name="CONTACT_CELULARS" id="CONTACT_CELULARS" maxlength="10"/>
                                                                    </div>
                                                                    <div class="col-md-auto">
                                                                        <a href="javascript:;" data-repeater-delete class="btn btn-icon btn-icon-only btn-outline-secondary w-100 w-sm-auto">
                                                                            <i class="far fa-trash-alt ms-2"></i>حذف
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    @if(count($data['CONTACT_CELULARS']) == 0)
                                                    <div data-repeater-item>
                                                        <div class="row mt-3">
                                                            <div class="col-12 col-md">
                                                                <input type="text" class="form-control number-only" name="CONTACT_CELULARS" id="CONTACT_CELULARS" maxlength="10"/>
                                                            </div>
                                                            <div class="col-md-auto">
                                                                <a href="javascript:;" data-repeater-delete class="btn btn-icon btn-icon-only btn-outline-secondary w-100 w-sm-auto">
                                                                    <i class="far fa-trash-alt ms-2"></i>حذف
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <a href="javascript:;" data-repeater-create class="btn btn-icon btn-icon-only btn-outline-secondary w-100">
                                                    <i class="fas fa-plus ms-2"></i>إضافة
                                                </a>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback CONTACT_CELULARS-error"></div>
                                    </div>
                                </div>

                                <div class="mb-3 row mt-5">
                                    <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
                                        <button type="submit" class="btn btn-secondary w-100 w-sm-auto mb-2">
                                            <div class="text">تحديث</div>
                                            <div class="btn-loader d-none">
                                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                                    <span class="visually-hidden">جاري التحديث</span>
                                                </div>
                                                <span>جاري التحديث</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
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
    <script src="{{asset('assets/formrepeater.bundle.js')}}"></script>
    <script>
        $('#CONTACT_CELULARS').repeater({
            initEmpty: false,
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#CURR_COUNTRY_ID').on('change', function (e) {
                e.preventDefault();
                $('#CURR_STATE_ID').prop('disabled', true);
                $('#CURR_CITY_ID').prop('disabled', true);
                let val = $(this).val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.states.fetch')}}',
                    data: {
                        'id': val,
                    },
                    success: function (response) {
                        $('#CURR_STATE_ID').html(response.html);
                        $('#CURR_STATE_ID').prop('disabled', false);
                    },
                    error: function (response) {
                    }
                })
            });
            $('#CURR_STATE_ID').on('change', function (e) {
                e.preventDefault();
                $('#CURR_CITY_ID').prop('disabled', true);
                let val = $(this).val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.cities.fetch')}}',
                    data: {
                        'id': val,
                    },
                    success: function (response) {
                        $('#CURR_CITY_ID').html(response.html);
                        $('#CURR_CITY_ID').prop('disabled', false);
                    },
                    error: function (response) {
                    }
                })
            });
        });

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
                        $.each(response.responseJSON.errors, function (i, value) {
                            let index = i.split('.')[0];
                            console.log(index, value);
                            showValidationError(form, index, value)
                        });
                        loaderEnd(form)
                    }
                })
            });
        });
        function showValidationError(form, index, value){
            if(index == 'CONTACT_CELULARS'){
                $('.CONTACT_CELULARS-error').html(value);
                $('.CONTACT_CELULARS-error').addClass('d-block');
            }else{
                form.find("input[name='"+index+"']").addClass('border-danger');
                form.find("input[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                form.find("select[name='"+index+"']").addClass('border-danger');
                form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
            }
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
