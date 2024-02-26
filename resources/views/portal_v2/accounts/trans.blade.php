<div class="card mb-2 bg-transparent no-shadow d-none d-md-block">
    <div class="row g-0 sh-3">
        <div class="col">
            <div class="card-body pt-0 pb-0 h-100">
                <div class="row g-0 h-100 align-content-center table-sortable">
                    <div class="col-6 col-md-6 d-flex align-items-center text-alternate text-medium sorted-column {{$sort['col']=='TRANS_TYPE_NA'?$sort['type']:''}}" data-name="TRANS_TYPE_NA">نوع الحركة</div>
                    <div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium sorted-column {{$sort['col']=='DEBIT_CREDIT_NA'?$sort['type']:''}}" data-name="DEBIT_CREDIT_NA">نوع الحركة</div>
                    <div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium sorted-column {{$sort['col']=='TRANS_AMOUNT'?$sort['type']:''}}" data-name="TRANS_AMOUNT">المبلغ</div>
                    <div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium sorted-column {{$sort['col']=='LAST_TRANS_DATE'?$sort['type']:''}}" data-name="LAST_TRANS_DATE" data-isDate="1">التاريخ</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="scroll-out mb-n2 mb-5">
    <div class="scroll-by-count" data-count="5">
        @if(count($account['LAST_TRANSACTIONS']))
            @foreach($account['LAST_TRANSACTIONS'] as $item)
                <div class="card mb-2 sh-11 sh-md-8">
                    <div class="card-body pt-0 pb-0 h-100">
                        <div class="row g-0 h-100 align-content-center">
                            <div class="col-6 col-md-6 d-flex align-items-center mb-1 mb-md-0 order-1 order-md-1 order-md-12">
                                <a href="javascript:void(0);" class="body-link w-90">
                                    <i class="fa-solid fa-arrow-right-arrow-left ms-2 text-success"></i>
                                    <span class="align-middle">{{$item['TRANS_TYPE_NA']}} - {{$item['TRANS_NOTES']}}</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-2 d-flex align-items-center order-4 order-md-4 order-md-11">{{$item['DEBIT_CREDIT_NA']}}</div>
                            <div class="col-6 col-md-2 d-flex align-items-center  fw-bold text-success order-2  order-md-3 order-md-4 justify-content-end justify-content-end" dir="ltr">
                                {{NumberFormat($item['TRANS_AMOUNT'], $item['CURR_DECIMAL_PLACES'])}} {{$item['CURR_SYMBOL']}}
                            </div>
                            <div class="col-6 col-md-2 d-flex align-items-center order-4 order-md-4 order-md-11">{{Carbon\Carbon::parse($item['LAST_TRANS_DATE'])->translatedFormat('d/m/Y')}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card mb-2 sh-11 sh-md-8">
                <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                        <div class="col-12 d-flex align-items-center justify-content-center">لا يوجد حركات متعلقة بالحساب</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
