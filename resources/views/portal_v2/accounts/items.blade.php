@foreach($accounts as $index=>$item)
    <div class="col-lg-4 mb-5">
        <a href="{{route('portal.v2.accounts.show', $index)}}" class="card h-100 ">
            <div class="card-header text-center">
                <div class="text-start">
                    <span class="{{$item['ACCOUNT_STATUS_ID']==1?'text-success':'text-danger'}} fw-bold">{{$item['ACCOUNT_STATUS_DESC']}}</span>
                </div>
                <!-- <div class="sw-13 sh-13 rounded-xl d-flex justify-content-center align-items-center border border-secondary mb-4"> -->
                <i class="fa-solid fa-wallet fa-2x text-secondary my-3"></i>
                <!-- </div> -->
                <div class="">
                    <h5 class="card-title fw-bold">{{$item['ACCOUNT_TYPE_DESC']}} - {{$item['CURR_NAME_DESC']}}</h5>
                    <h5 class="card-title fw-bold">{{$item['PROFILE_NAME']}}</h5>
{{--                    <h5 class="card-title fw-bold">{{$item['LEDGER_NAME_NA']}} - {{$item['CURR_NAME_DESC']}}</h5>--}}
{{--                    <h5 class="card-title fw-bold">{{$item['ACCOUNT_NAME_NA']}} - {{$item['LEDGER_NAME_NA']}} - {{$item['CURR_NAME_DESC']}}</h5>--}}
                </div>
            </div>
            <div class="card-body">
                <h4 class="bg-primary text-center px-3 py-2 rounded-lg text-white mb-3">الرصيد الحالي:
                    <span dir="ltr">{{NumberFormat($item['ACCOUNT_BALANCE'], $item['CURR_DECIMAL_PLACES'])}}</span>
                </h4>
                <h4 class="bg-primary text-center px-3 py-2 rounded-lg text-white mb-3">الرصيد المتوفر:
                    <span dir="ltr">{{NumberFormat($item['AVAILABLE_BALANCE'], $item['CURR_DECIMAL_PLACES'])}}</span> </h4>
                <div class="row g-0 border border-light px-3 py-2 rounded-lg align-items-center mb-2">
                    <div class="row g-0  d-flex align-items-center">
                        <div class="col fw-bold align-content-center">
                            <div class="d-flex align-items-center">
                                <div class="fw-bold">رقم الحساب</div>
                            </div>
                        </div>
                        <div class="col-auto align-content-center">
                            <div class=" d-flex fw-bold align-items-center" dir="ltr">{{$item['ACCOUNT_NUM']}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted text-center">أخر حركة  <span class="fw-bold">{{Carbon\Carbon::parse($item['LAST_TRANS_DATE'])->translatedFormat('d/m/Y h:m a')}}</span></div>
        </a>
    </div>
@endforeach
