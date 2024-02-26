@extends('portal.layouts.main')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a href="index.html"><i class="fa-solid fa-chevron-right"></i> الرئيسية</a>
                    <h1 class="my-3 pb-0 display-4 text-secondary fw-bold" id="title">العملات</h1>

                    <!-- <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                      <ul class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">واجهة</a></li>
                      </ul>
                    </nav> -->

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
                        <a id="BtnDatelastUpdate" href="#">
                             <i class="fa-solid fa-arrows-rotate text-secondary"></i>
                        </a>
                        أخر تحديث
                          <span id="datelastUpdate">

                          </span>
                        </span>
                </h2>


                <div class="card mb-5">
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table" id="table-curr-list">
                                <thead>
                                <tr>
                                    <th scope="col">العملة</th>
                                    <th scope="col">الشراء</th>
                                    <th scope="col">البيع</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">شيكل </th>
                                        <td id="ShekelsBuy"></td>
                                        <td id="ShekelSell"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">دولار </th>
                                        <td id="DularBuy"></td>
                                        <td id="DularSell"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">دينار </th>
                                        <td id="DinarBuy"></td>
                                        <td id="DinarSell"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">يورو </th>
                                        <td id="EuroBuy"></td>
                                        <td id="EuroSell"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">جنيه استرليني</th>
                                        <td id="PoundBuy"></td>
                                        <td id="PoundSell"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Public Info End -->
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <!-- Public Info Start -->
                <h2 class="h4">تحويل العملات</h2>
                <div class="card mb-5">
                    <div class="card-body ">
                        <form id="currencyExchange" action="{{route('portal.currencyExchange')}}">
                        <div class="col-12">
                            <label class="mb-2" for="cu_value">القيمة</label>
                            <input type="text" class="form-control money-only formattedNumber" id="cu_value"  name="cu_value" value="" />
                        </div>
                        <div class="row my-5">
                            <div class="col-12 col-lg-5">
                                <label class="mb-2" for="from">من</label>
                                <select class="select-single-with-search" id="from" name="from" placeholder="اختر العملة "  data-width="100%">
                                    <option label="&nbsp;">اختر العملة</option>
                                    <option value="1" >شيكل</option>
                                    <option value="2" selected>دولار</option>
                                    <option value="3">دينار</option>
                                    <option value="4">يورو</option>
                                    <option value="5">جنيه استرليني</option>
                                </select>
                            </div>

                            <div class="col-12 col-lg-2 d-flex justify-content-center align-items-end">
                                <div id="reverseCurrencies" class="border border-secondary sw-5 sh-5 sw-sm-5 sh-sm-5 rounded-xl d-flex justify-content-center align-items-center mt-4">
                                    <i class="fa-solid fa-arrow-right-arrow-left text-secondary"></i>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5">
                                <label class="mb-2" for="to">إلى</label>

                                <select class="select-single-with-search " id="to" name="to" placeholder="اختر العملة "  data-width="100%">
                                    <option label="&nbsp;">اختر العملة</option>
                                    <option value="1" selected>شيكل</option>
                                    <option value="2" >دولار</option>
                                    <option value="3">دينار</option>
                                    <option value="4">يورو</option>
                                    <option value="5">جنيه استرليني</option>
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
                <!-- Public Info End -->
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

        $(document).ready(function (){

           //  const p = new Charts()

            // p.smallLineChart2.updateOptions({
            //     labels: smallLineChart2Labels,
            //     datasets: [
            //         {
            //             data: smallLineChart2Data,
            //         }]
            // });
            GetCurrenciesData()

        })

        $(document).on('click','#BtnDatelastUpdate',function (e){
            e.preventDefault()
            GetCurrenciesData()
        })
        function  GetCurrenciesData(){
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "get",
                    url: "{{route('portal.currencies.GetCurrenciesData')}}",
                    success: function (response) {
                        if (response.status) {
                            if( response.status== true){
                                $.each(response.currencies.data.CURRENCIES, function( index, value ) {
                                    if(value.CURR_ID == 1){
                                        $('#DularBuy').text(value.BUY_PRICE);
                                        $('#DularSell').text(value.SELL_PRICE);
                                    }
                                    if(value.CURR_ID == 3){
                                        $('#ShekelsBuy').text(value.BUY_PRICE);
                                        $('#ShekelSell').text(value.SELL_PRICE);
                                    }
                                    if(value.CURR_ID == 2){
                                        $('#DinarBuy').text(value.BUY_PRICE);
                                        $('#DinarSell').text(value.SELL_PRICE);
                                    }
                                    if(value.CURR_ID == 4){
                                        $('#EuroBuy').text(value.BUY_PRICE);
                                        $('#EuroSell').text(value.SELL_PRICE);
                                    }
                                    if(value.CURR_ID == 5){
                                        $('#PoundBuy').text(value.BUY_PRICE);
                                        $('#PoundSell').text(value.SELL_PRICE);
                                    }
                                });
                                $('#datelastUpdate').text(response.currencies.data.SYSTEM_DATE);
                            }
                        }
                    },
                    error: function (response) {
                        let html = '';
                        $.each(response.responseJSON.errors, function (index, value) {
                            showValidationError(form, index, value)
                        });
                        loaderEnd(form)
                    }
                });
        }

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
                        let AMOUNT_EQ = Number.parseFloat(response.data.AMOUNT_EQ).toFixed(2)
                        $('#result_currency_exchange').text(AMOUNT_EQ)

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
