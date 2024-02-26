<form id="main_form_data" action="{{route('portal.loan-request.main-info.store')}}">
    <div class="alert alert-danger mb-4 d-none" role="alert"></div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">البرنامج</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <select class="select-single-with-search" name="PROGRAM_TYPE_ID" id="PROGRAM_TYPE_ID" data-placeholder="اختر البرنامج" data-width="100%">
                <option></option>
                @foreach($constants['PROGRAMS_TYPES'] as $item)
                    <option value="{{$item['VALUE']}}" {{$item['VALUE']==$program?'selected':''}}>{{$item['LABEL']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row program-selected">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">القرض</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <select class="select-single-with-search" name="PRODUCT_TYPE_ID" id="PRODUCT_TYPE_ID" {{$product?'':'disabled'}} data-placeholder="اختر القرض" data-width="100%">
                <option></option>
                @if(count($list) > 0)
                    @foreach($list as $item)
                        <option value="{{$item['VALUE']}}" {{$item['VALUE']==$product?'selected':''}}>{{$item['LABEL']}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">القطاع الاقتصادي</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <select class="select-single-with-search" name="FUND_SECTOR_ID" id="FUND_SECTOR_ID" data-placeholder="اختر القطاع" data-width="100%">
                <option></option>
                @foreach($constants['FUND_SECTORS'] as $item)
                    <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">الهدف من القرض</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <select class="select-single-with-search" name="FINANCING_PURPOSE_ID[]" id="FINANCING_PURPOSE_ID" disabled multiple data-placeholder="اختر الهدف من القرض" data-width="100%">
                <option></option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">وصف الهدف من القرض</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <textarea class="form-control" name="FINANCING_PURPOSE_DESCRIPTION" id="FINANCING_PURPOSE_DESCRIPTION" placeholder="اكتب هنا" rows="5" maxlength="{{textMaxSize2()}}"></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">مكان النشاط الممول</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <input type="text" class="form-control" name="ACTIVITY_PLACE" id="ACTIVITY_PLACE"/>
            <div class="form-check form-check-inline m-0 mt-1 me-2">
                <input class="form-check-input" type="checkbox" name="COMPANY_ADDRESS" id="COMPANY_ADDRESS" value="1">
                <label class="form-check-label" for="COMPANY_ADDRESS">نفس عنوان الشركة</label>
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">القيمة الإجمالية (للبضاعة , الآلات , معدات , المشروع ....)</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <div class="input-group">
                <input type="text" class="form-control w-75 integer-positive-only formattedNumber" name="GOODS_VALUE" id="GOODS_VALUE" />
{{--                <input type="text" name="GOODS_CURR_ID" value="{{$constants['CURRENCIES'][0]['VALUE']}}" hidden>--}}
                <select class="select-single-with-search w-25" name="GOODS_CURR_ID" id="GOODS_CURR_ID" data-placeholder="العملة">
                    <option></option>
                    @foreach($constants['CURRENCIES'] as $index=>$item)
                        <option value="{{$item['VALUE']}}" {{$constants['DefualtCurr']==$item['VALUE']?'selected':''}}>{{$item['LABEL']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">قيمة القرض</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <div class="input-group">
                <input type="text" class="form-control w-75 integer-positive-only formattedNumber" name="FINANCING_VALUE" id="FINANCING_VALUE" />
                <select class="select-single-with-search w-25" id="CURR_ID" data-placeholder="العملة" disabled="">
                    <option></option>
                    @foreach($constants['CURRENCIES'] as $index=>$item)
                        <option value="{{$item['VALUE']}}" {{$constants['DefualtCurr']==$item['VALUE']?'selected':''}}>{{$item['LABEL']}}</option>
                    @endforeach
                </select>
                <input type="text" name="CURR_ID" value="{{$constants['DefualtCurr']}}" hidden>
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">قيمة مساهمة العميل</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <input type="text" class="form-control" disabled name="" id="customer_contribution" />
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">مدة القرض / بالأشهر</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <input type="text" class="form-control number-only" name="INSTALLMENT_CNT" id="INSTALLMENT_CNT" />
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">فترة السماح ضمن فترة القرض / بالأشهر  </label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <input type="text" class="form-control number-only" name="GRACE_PERIOD_IN_DAYS" id="GRACE_PERIOD_IN_DAYS" />
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">ما الذي سيضيفه القرض من تطوير لأعمال الشركة (وصف عام للمشروع المراد تمويلية)</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <textarea class="form-control" name="FUND_DESCRIPTION" id="FUND_DESCRIPTION" placeholder="اكتب هنا" rows="5" maxlength="{{textMaxSize2()}}"></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label">حالة المشروع</label>
        <div class="col-sm-8 col-md-9 col-lg-7">
            <select class="select-single-with-search" name="PROJECT_STATUS_ID" id="PROJECT_STATUS_ID" data-placeholder="حالة المشروع" data-width="100%">
                <option></option>
                <option value="1">مشروع قائم</option>
                <option value="2">قيد التأسيس</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row project_file d-none">
        <label class="col-lg-5 col-md-3 col-sm-4 col-form-label col-form-label">دراسة الجدوى للمشروع</label>
        <div class="col-sm-8 col-md-9 col-lg-7 d-flex align-items-center">
            <input type="text" class="form-control" id="file_name" value="0" disabled/>
            <input type="file" hidden name="FUND_PROJECT_ATTACHS" id="FUND_PROJECT_ATTACHS" onchange="loadMainFile(this)">
            <label type="button" for="FUND_PROJECT_ATTACHS" class="btn btn-icon btn-icon-only btn-outline-secondary w-100 w-sm-auto me-3">اختر ملف</label>
        </div>
    </div>
    <div class="mb-3 row mt-5">
        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
            <button class="d-none btnNext"></button>
            <button type="submit" class="btn btn-secondary w-100 w-sm-auto mb-2">التالي</button>
        </div>
    </div>
</form>
