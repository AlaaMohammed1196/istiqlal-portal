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
                            <li class="breadcrumb-item"><a href="{{route('portal.company.acknowledgement.index')}}">بيانات الإقرار</a></li>
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
                <h2 class="h4">بيانات الإقرار</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5">
                            <div class="row g-0 align-items-start mb-2">
                                <p>بحسب النظام الداخلي أو عقد التأسيس للشركة: </p>
                                <form id="form_data" action="{{route('portal.company.acknowledgement.update')}}">
                                    <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                                    <div class="mb-3 row">
                                        <label class="col-12 col-sm-8 col-form-label">أحقية الرهن للغير</label>
                                        <div class="col-12  col-sm-4 d-flex justify-content-between">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="IS_MORTGEGE_TO_OTHERS" {{count($data)>0?$data[0]['IS_MORTGEGE_TO_OTHERS']==1?'checked':'':''}} id="IS_MORTGEGE_TO_OTHERS_1" value="1">
                                                <label class="form-check-label" for="IS_MORTGEGE_TO_OTHERS_1">نعم</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="IS_MORTGEGE_TO_OTHERS" {{count($data)>0?$data[0]['IS_MORTGEGE_TO_OTHERS']=='0'?'checked hi':'':''}} id="IS_MORTGEGE_TO_OTHERS_0" value="0">
                                                <label class="form-check-label" for="IS_MORTGEGE_TO_OTHERS_0">لا</label>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-12 col-sm-8 col-form-label">أحقية الاقتراض للشركة</label>
                                        <div class="col-12  col-sm-4 d-flex justify-content-between">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="IS_COMPANY_RIGHT_BORROW" {{count($data)>0?$data[0]['IS_COMPANY_RIGHT_BORROW']==1?'checked':'':''}} id="IS_COMPANY_RIGHT_BORROW_1" value="1">
                                                <label class="form-check-label" for="IS_COMPANY_RIGHT_BORROW_1">نعم</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="IS_COMPANY_RIGHT_BORROW" {{count($data)>0?$data[0]['IS_COMPANY_RIGHT_BORROW']=='0'?'checked':'':''}} id="IS_COMPANY_RIGHT_BORROW_0" value="0">
                                                <label class="form-check-label" for="IS_COMPANY_RIGHT_BORROW_0">لا</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3 row inlineRadioOptions2">
                                        <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control integer-positive-only formattedNumber" name="BORROWING_LIMIT" {{count($data)>0?$data[0]['IS_COMPANY_RIGHT_BORROW']=='0'?'disabled':'':'disabled'}}  id="BORROWING_LIMIT" value="{{count($data)>0?$data[0]['BORROWING_LIMIT']:''}}" placeholder=" " />
                                                <label>الحد المسموح للاقتراض</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                                            <div class="form-floating mb-3 w-100">
{{--                                                <input type="text" class="form-control" name="CURR_ID" id="CURR_ID" value="{{$data[0]['CURR_ID']}}" readonly hidden />--}}
                                                <select class="select-floating-no-search" name="CURR_ID" id="CURR_ID" {{count($data)>0?$data[0]['IS_COMPANY_RIGHT_BORROW']=='0'?'disabled':'':'disabled'}}>
                                                    <option></option>
                                                    @foreach($constants['Currencies'] as $item)
                                                        <option value="{{$item['CURR_ID']}}" {{$item['CURR_ID']==$data[0]['CURR_ID']?'selected':''}}>{{$item['CURR_NAME']}}</option>
                                                    @endforeach
                                                </select>
{{--                                                <label>العملة</label>--}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-12 col-sm-8 col-form-label">تمتلك الشركة مستند خلو ضريبة</label>
                                        <div class="col-12  col-sm-4 d-flex justify-content-between">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="IS_COMPANY_TAX_DOC" {{count($data)>0?$data[0]['IS_COMPANY_TAX_DOC']==1?'checked':'':''}} id="IS_COMPANY_TAX_DOC_1" value="1">
                                                <label class="form-check-label" for="IS_COMPANY_TAX_DOC_1">نعم</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="IS_COMPANY_TAX_DOC" {{count($data)>0?$data[0]['IS_COMPANY_TAX_DOC']=='0'?'checked':'':''}} id="IS_COMPANY_TAX_DOC_0" value="0">
                                                <label class="form-check-label" for="IS_COMPANY_TAX_DOC_0">لا</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-12 col-sm-8 col-form-label">هل تم منح قروض من بنك الاستقلال للاستثمار والتنمية سابقاً</label>
                                        <div class="col-12  col-sm-4 d-flex justify-content-between">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="IS_LOANS_GRANTED" disabled {{count($data)>0?$data[0]['IS_LOANS_GRANTED']==1?'checked':'':''}} id="IS_LOANS_GRANTED_1" value="1">
                                                <label class="form-check-label" for="IS_LOANS_GRANTED_1">نعم</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="IS_LOANS_GRANTED" disabled {{count($data)>0?$data[0]['IS_LOANS_GRANTED']=='0'?'checked':'':''}} id="IS_LOANS_GRANTED_0" value="0">
                                                <label class="form-check-label" for="IS_LOANS_GRANTED_0">لا</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-12 col-sm-8 col-form-label">هل الشركة كفيلة لقرض قائم لبنك الاستقلال للاستثمار والتنمية</label>
                                        <div class="col-12  col-sm-4 d-flex justify-content-between">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="IS_COMPANY_GUARANTEE_LOANS" {{count($data)>0?$data[0]['IS_COMPANY_GUARANTEE_LOANS']==1?'checked':'':''}} id="IS_COMPANY_GUARANTEE_LOANS_1" value="1">
                                                <label class="form-check-label" for="IS_COMPANY_GUARANTEE_LOANS_1">نعم</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="IS_COMPANY_GUARANTEE_LOANS" {{count($data)>0?$data[0]['IS_COMPANY_GUARANTEE_LOANS']=='0'?'checked':'':''}} id="IS_COMPANY_GUARANTEE_LOANS_0" value="0">
                                                <label class="form-check-label" for="IS_COMPANY_GUARANTEE_LOANS_0">لا</label>
                                            </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .select2-container--bootstrap4.select2-container--disabled.select2-container--focus .select2-selection, .select2-container--bootstrap4.select2-container--disabled .select2-selection{
            cursor: default;
        }
    </style>
@endpush

@push('script')
    <script>
        document.getElementById('BORROWING_LIMIT').removeAttribute('required');
        $(document).ready(function() {
            $('input[name="IS_COMPANY_RIGHT_BORROW"]').on('change', function (e){
                let val = $('input[name="IS_COMPANY_RIGHT_BORROW"]:checked').val();
                if(val == 1){
                    $('#CURR_ID').removeAttr('disabled');
                    $('#BORROWING_LIMIT').removeAttr('disabled');
                    $('#BORROWING_LIMIT').siblings('.input-number').removeAttr('disabled');
                }else{
                    $('#CURR_ID').attr('disabled', 'disabled');
                    $('#BORROWING_LIMIT').attr('disabled', 'disabled');
                    $('#BORROWING_LIMIT').siblings('.input-number').attr('disabled', 'disabled');
                }
            });

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
    <script src="{{asset('assets')}}/js/forms/layouts.js"></script>

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
