<form id="main_form_data" action="{{route('portal.loan-request.main-info.store')}}">
    <div class="alert alert-danger mb-4 d-none" role="alert"></div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">البرنامج</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <select class="select-single-with-search" name="PROGRAM_TYPE_ID" id="PROGRAM_TYPE_ID" data-placeholder="اختر البرنامج" data-width="100%">
                <option></option>
                @foreach($constants['PROGRAMS_TYPES'] as $item)
                    <option value="{{$item['VALUE']}}" {{$item['VALUE']==$data['Fund_Data'][0]['PROGRAM_TYPE_ID']?'selected':''}}>{{$item['LABEL']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row program-selected">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">القرض</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <select class="select-single-with-search" name="PRODUCT_TYPE_ID" id="PRODUCT_TYPE_ID" data-placeholder="اختر القرض" data-width="100%">
                @php $products = $responseBody = fetchProgram($data['Fund_Data'][0]['PROGRAM_TYPE_ID']); @endphp
                <option></option>
                @foreach($products['data']['PRODUCT_TYPES'] as $item)
                    <option value="{{$item['VALUE']}}" {{$item['VALUE']==$data['Fund_Data'][0]['PRODUCT_TYPE_ID']?'selected':''}}>{{$item['LABEL']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">القطاع الاقتصادي</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <select class="select-single-with-search" name="FUND_SECTOR_ID" id="FUND_SECTOR_ID" data-placeholder="اختر القطاع" data-width="100%">
                <option></option>
                @foreach($constants['FUND_SECTORS'] as $item)
                    <option value="{{$item['VALUE']}}" {{$item['VALUE']==$data['Fund_Data'][0]['FUND_SECTOR_ID']?'selected':''}}>{{$item['LABEL']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">الهدف من القرض</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            @php $fp = explode(',', $data['Fund_Data'][0]['FINANCING_PURPOSE_ID']) @endphp
            <select class="select-single-with-search" name="FINANCING_PURPOSE_ID[]" id="FINANCING_PURPOSE_ID" multiple data-placeholder="اختر الهدف من القرض" data-width="100%">
                <option></option>
                @foreach($FINANCING_PURPOSES_list as $item)
                    <option value="{{$item['VALUE']}}" {{in_array($item['VALUE'], $fp)?'selected':''}}>{{$item['LABEL']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">قيمة المبلغ المطلوب</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <div class="input-group">
                <input type="text" class="form-control number-only w-75" name="GOODS_VALUE" id="GOODS_VALUE" value="{{$data['Fund_Data'][0]['GOODS_VALUE']}}"/>
{{--                <input type="text" name="GOODS_CURR_ID" value="{{$constants['CURRENCIES'][0]['VALUE']}}" hidden>--}}
                <select class="select-single-with-search" name="GOODS_CURR_ID" id="GOODS_CURR_ID" data-placeholder="العملة">
                    <option></option>
                    @foreach($constants['CURRENCIES'] as $index=>$item)
                        <option value="{{$item['VALUE']}}" {{$data['Fund_Data'][0]['GOODS_CURR_ID']==$item['VALUE']?'selected':''}}>{{$item['LABEL']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">قيمة القرض</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <div class="input-group">
                <input type="text" class="form-control number-only w-75" name="FINANCING_VALUE" id="FINANCING_VALUE" value="{{$data['Fund_Data'][0]['FINANCING_VALUE']}}"/>
                <input type="text" name="CURR_ID" value="{{$data['Fund_Data'][0]['CURR_ID']}}" hidden>
                <select class="select-single-with-search" id="CURR_ID" data-placeholder="العملة" disabled="">
                    <option></option>
                    @foreach($constants['CURRENCIES'] as $index=>$item)
                        <option value="{{$item['VALUE']}}" {{$data['Fund_Data'][0]['CURR_ID']==$item['VALUE']?'selected':''}}>{{$item['LABEL']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">قيمة مساهمة العميل</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <input type="text" class="form-control" disabled name="" id="customer_contribution" value="{{$data['Fund_Data'][0]['GOODS_VALUE'] - $data['Fund_Data'][0]['FINANCING_VALUE']}}"/>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">مدة القرض / بالأشهر  <span class="text-danger">*</span></label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <input type="text" class="form-control" name="INSTALLMENT_CNT" id="INSTALLMENT_CNT" value="{{$data['Fund_Data'][0]['INSTALLMENT_CNT']}}"/>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">فترة السماح ضمن فترة القرض / بالأشهر  <span class="text-danger">*</span></label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <input type="text" class="form-control" name="GRACE_PERIOD_IN_DAYS" id="GRACE_PERIOD_IN_DAYS" value="{{$data['Fund_Data'][0]['GRACE_PERIOD_IN_DAYS']/30}}"/>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">ما الذي سيضيفه القرض من تطوير لأعمال الشركة</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <textarea class="form-control" name="FUND_DESCRIPTION" id="FUND_DESCRIPTION" placeholder="اكتب هنا" rows="5">{{$data['Fund_Data'][0]['FUND_DESCRIPTION']}}</textarea>
        </div>
    </div>
    <div class="mb-3 row mt-5">
        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
            <button class="d-none btnNext"></button>
            <button type="submit" class="btn btn-secondary w-100 w-sm-auto mb-2">التالي</button>
        </div>
    </div>
</form>
