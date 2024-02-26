@extends('portal_v2.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="{{route('portal.v2.home')}}"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">العملات</h1>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->
        <div class="row">

            <div class="col-12 col-md-12 col-lg-6">
                <!-- Public Info Start -->
                <h2 class="h4">الأسواق
                    <span class="float-start text-small">
                        <a id="update_currencies_btn" href="#">
                             <i class="fa-solid fa-arrows-rotate text-secondary"></i>
                        </a>
                        أخر تحديث
                          <span id="update_date">{{$data['SYSTEM_DATE']?Carbon\Carbon::parse($data['SYSTEM_DATE'])->translatedFormat('d/m/Y'):''}}</span>
                    </span>
                </h2>
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table" id="table-curr-list">
                                <thead>
                                <tr>
                                    <th scope="col">العملة</th>
                                    <th scope="col">سعر الشراء</th>
                                    <th scope="col">سعر البيع</th>
                                    <th scope="col">السعر الوسطى</th>
                                </tr>
                                </thead>
                                <tbody id="currencies_values">
                                    @include('portal_v2.currencies.rows')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Public Info End -->
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <h2 class="h4">تحويل العملات</h2>
                <div class="card mb-5">
                    <div class="card-body ">
                        <form id="currencyExchange" action="{{route('portal.v2.currencyExchange')}}">
                        <div class="col-12">
                            <label class="mb-2" for="cu_value">القيمة</label>
                            <input type="text" class="form-control money-only formattedNumber" id="cu_value"  name="cu_value" placeholder="القيمة" />
                        </div>
                        <div class="row my-5">
                            <div class="col-12 col-lg-5">
                                <label class="mb-2" for="from">من</label>
                                <select class="select-single-with-search" id="from" name="from" data-width="100%">
                                    @foreach($data['CURRENCIES'] as $item)
                                        <option value="{{$item['CURR_ID']}}">{{$item['CURR_NAME']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-2 d-flex justify-content-center align-items-end">
                                <div id="reverseCurrencies" class="border border-secondary sw-5 sh-5 sw-sm-5 sh-sm-5 rounded-xl d-flex justify-content-center align-items-center mt-4">
                                    <i class="fa-solid fa-arrow-right-arrow-left text-secondary"></i>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5">
                                <label class="mb-2" for="to">إلى</label>
                                <select class="select-single-with-search " id="to" name="to" data-width="100%">
                                    @foreach($data['CURRENCIES'] as $item)
                                        <option value="{{$item['CURR_ID']}}" {{$item['CURR_ID']==3?'selected':''}}>{{$item['CURR_NAME']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row gx-0 mt-5 mb-5 d-flex justify-content-between align-items-center align-content-center">
                            <div class="col-12 col-sm-9 mt-4">
                                <button type="submit" class="btn btn-secondary">تحويل</button>
                            </div>
                            <div class="col-12 col-sm-3 mt-4 py-2 bg-light rounded-lg px-3 d-flex align-items-center justify-content-center" style="height: 42px">
                                <div class="h3 m-0" id="result_currency_exchange">0</div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        #table-curr-list tbody th,
        #table-curr-list tbody td{
            line-height: 31px;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).on('click','#update_currencies_btn',function (e){
            e.preventDefault();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.currencies.update')}}',
                success: function (response) {
                    $('#currencies_values').html(response.html);
                    $('#update_date').html(response.data['SYSTEM_DATE']);
                },
                error: function (response) {
                }
            })
        })

        $(document).on('submit','#currencyExchange',function (e){
            e.preventDefault()
             let cu_value =  $('[name="cu_value"]').val();
            if(!cu_value){
                $('[name="cu_value"]').val(1)
            }
            getCurrencyExchange();
        })

        function  getCurrencyExchange(){
            let form = $('#currencyExchange');
            let FormData =form.serialize();
            loaderStart(form)
            errorHide(form);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: form.attr('action'),
                data:FormData,
                success: function (response) {
                    if (response.status) {
                        // let AMOUNT_EQ = Number.parseFloat(response.data.AMOUNT_EQ).toFixed(2)
                        $('#result_currency_exchange').text(response.data.AMOUNT_EQ)

                    } else {
                        errorShow(form, response.msg);
                        $('#result_currency_exchange').text('')
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
        }

        $(document).on('click','#reverseCurrencies',function (e) {
            e.preventDefault()
            let old_form =$('[name="from"]').val()
            let old_to =$('[name="to"]').val()
            $('[name="from"]').val(old_to).trigger('change');
            $('[name="to"]').val(old_form).trigger('change');
               let cu_value =  $('[name="cu_value"]').val();

            if(!cu_value){
                $('[name="cu_value"]').val(1)
            }
            getCurrencyExchange();
        })

        $(document).on('keydown', '.check-is-number', function (e) {
            if (e.keyCode === 110) {
                var x = $(this).val();
                if (x.indexOf(".") >= 0) {
                    e.preventDefault();
                }
            }
            if (e.shiftKey) e.preventDefault();
            else {
                var nKeyCode = e.keyCode;
                //Ignore Backspace and Tab keys
                if (nKeyCode == 8 || nKeyCode == 9 || nKeyCode == 110 || nKeyCode == 190) return;
                if (nKeyCode < 95) {
                    if (nKeyCode < 48 || nKeyCode > 57) e.preventDefault();
                } else {
                    if (nKeyCode < 96 || nKeyCode > 105) e.preventDefault();
                }
            }
        });
    </script>
@endpush

@push('page_style')
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2.min.css"/>
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/select2-bootstrap4.min.css"/>
    <link rel="stylesheet" href="{{asset('assets')}}/css/vendor/bootstrap-datepicker3.standalone.min.css"/>
@endpush

@push('page_script')

    <script src="{{asset('assets')}}/js/vendor/movecontent.js"></script>
    <script src="{{asset('assets')}}/js/vendor/select2.full.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/profile.settings.js"></script>

    <script src="{{asset('assets')}}/js/forms/layouts.js"></script>

    <script src="{{asset('assets')}}/js/vendor/moment-with-locales.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/Chart.bundle.min.js"></script>
    <script src="{{asset('assets')}}/js/cs/charts.extend.js"></script>
    <script src="{{asset('assets')}}/js/plugins/charts.js"></script>
    <!-- End Chart -->

    <script src="{{asset('assets')}}/js/common.js"></script>
    <script src="{{asset('assets')}}/js/scripts.js"></script>
@endpush
