<div class="col-12 mb-5">
    <div class="card mb-2 bg-transparent no-shadow d-none d-md-block">
        <div class="row g-0 sh-3">
            <div class="col">
                <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center table-sortable">
                        <div class="col-6 col-md-4 d-flex align-items-center text-alternate text-medium">نوع الحركة</div>
                        <div class="col-6 col-md-3 d-flex align-items-center text-alternate text-medium sorted-column {{$sort['col']=='TRANS_AMOUNT'?$sort['type']:''}}" data-name="TRANS_AMOUNT">المبلغ</div>
                        <div class="col-6 col-md-4 d-flex align-items-center text-alternate text-medium sorted-column {{$sort['col']=='LAST_TRANS_DATE'?$sort['type']:''}}" data-name="LAST_TRANS_DATE" data-isDate="1">التاريخ</div>
                        <div class="col-6 col-md-1 d-flex align-items-center justify-content-md-end text-alternate text-medium ">تفاصيل</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-out mb-n2 mb-5">
        <div class="scroll-by-count" data-count="3">
            @foreach($transactions as $index=>$item)
                <div class="card mb-2 sh-11 sh-md-8">
                    <div class="card-body pt-0 pb-0 h-100">
                        <div class="row g-0 h-100 align-content-center">
                            <div class="col-8 col-md-4 d-flex align-items-center mb-1 mb-md-0 order-1 order-md-1 order-md-12">
                                <a href="javascript:void(0);" class="body-link text-truncate">
                                    <span class="align-middle">{{$item['TRANS_TYPE_NA']}}</span>
                                </a>
                            </div>
                            <div class="col-4 col-md-3 d-flex align-items-center  fw-bold text-success order-2  order-md-3 order-md-4 justify-content-end justify-content-end" dir="ltr">
                                {{NumberFormat($item['TRANS_AMOUNT'], $item['CURR_DECIMAL_PLACES'])}} {{$item['CURR_SYMBOL']}}</div>
                            <div class="col-11 col-md-4 d-flex align-items-center  order-4  order-md-4 order-md-11">{{Carbon\Carbon::parse($item['LAST_TRANS_DATE'])->translatedFormat('d/m/Y')}}</div>
                            <div class="col-1 col-md-1 d-flex align-items-center text-muted  justify-content-end  order-5  order-md-5 order-md-1">
                                <button class="btn p-0 display_notes {{$item['TRANS_NOTES']?'text-secondary':'text-muted'}}" @if($item['TRANS_NOTES'])data-notes="{{$item['TRANS_NOTES']}}" @else disabled @endif><i class="fa-solid fa-circle-info"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
