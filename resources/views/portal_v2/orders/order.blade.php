<div class="tab-pane fade" id="first" role="tabpanel">
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th scope="col" style="word-wrap: break-word;">الطلب</th>
                <th scope="col">تاريخ الطلب</th>
                <th scope="col">الحالة</th>
                <th scope="col">أدوات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $item)
                <tr @isset($item['BENEFICIARY_SEQ']) class="beneficiary_order" id="order2-{{$item['BENEFICIARY_SEQ']}}" @else class="transfer_order" id="order2-{{$item['VOUCHER_SEQ']}}" @endisset>
                    <td scope="row"><strong>{{isset($item['BENEFICIARY_SEQ'])?'طلب إضافة مستفيد':'طلب حوالة'}}</strong></td>
                    <td>{{$item['CREATED_ON']}}</td>
                    <td>{{$item['APPROVAL_STATUS_DESC']}}</td>
                    <td>
                        @if(isset($item['BENEFICIARY_SEQ']))
                            <div class="d-flex">
                                <a href="javascript:void(0);" role="button" data-answer="1" data-id="{{$item['BENEFICIARY_SEQ']}}" class="beneficiary_request btn btn-sm btn-icon btn-icon-only btn-outline-success align-top">
                                    <i class="fa-solid fa-circle-check"></i>
                                </a>
                                <a href="javascript:void(0);" role="button" data-answer="0" data-id="{{$item['BENEFICIARY_SEQ']}}" class="beneficiary_request btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top mx-2">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </a>
                            </div>
                        @else
                            <div class="d-flex">
                                <a href="javascript:void(0);" role="button" data-answer="1" data-id="{{$item['VOUCHER_SEQ']}}" data-custId="{{$item['CUST_BENEFICIARY_SEQ']}}" class="transfer_request btn btn-sm btn-icon btn-icon-only btn-outline-success align-top">
                                    <i class="fa-solid fa-circle-check"></i>
                                </a>
                                <a href="javascript:void(0);" role="button" data-answer="0" data-id="{{$item['VOUCHER_SEQ']}}" data-custId="{{$item['CUST_BENEFICIARY_SEQ']}}" class="transfer_request btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top mx-2">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </a>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane fade" id="second" role="tabpanel">
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th scope="col" style="word-wrap: break-word;">الطلب</th>
                <th scope="col">تاريخ الطلب</th>
                <th scope="col">الحالة</th>
                <th scope="col">أدوات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $item)
                <tr @isset($item['BENEFICIARY_SEQ']) class="beneficiary_order" id="order2-{{$item['BENEFICIARY_SEQ']}}" @else class="transfer_order" id="order2-{{$item['VOUCHER_SEQ']}}" @endisset>
                    <td scope="row"><strong>{{isset($item['BENEFICIARY_SEQ'])?'طلب إضافة مستفيد':'طلب حوالة'}}</strong></td>
                    <td>{{$item['CREATED_ON']}}</td>
                    <td>{{$item['APPROVAL_STATUS_DESC']}}</td>
                    <td>
                        @if(isset($item['BENEFICIARY_SEQ']))
                            <div class="d-flex">
                                <a href="javascript:void(0);" role="button" data-answer="1" data-id="{{$item['BENEFICIARY_SEQ']}}" class="beneficiary_request btn btn-sm btn-icon btn-icon-only btn-outline-success align-top">
                                    <i class="fa-solid fa-circle-check"></i>
                                </a>
                                <a href="javascript:void(0);" role="button" data-answer="0" data-id="{{$item['BENEFICIARY_SEQ']}}" class="beneficiary_request btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top mx-2">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </a>
                            </div>
                        @else
                            <div class="d-flex">
                                <a href="javascript:void(0);" role="button" data-answer="1" data-id="{{$item['VOUCHER_SEQ']}}" data-custId="{{$item['CUST_BENEFICIARY_SEQ']}}" class="transfer_request btn btn-sm btn-icon btn-icon-only btn-outline-success align-top">
                                    <i class="fa-solid fa-circle-check"></i>
                                </a>
                                <a href="javascript:void(0);" role="button" data-answer="0" data-id="{{$item['VOUCHER_SEQ']}}" data-custId="{{$item['CUST_BENEFICIARY_SEQ']}}" class="transfer_request btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top mx-2">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </a>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
