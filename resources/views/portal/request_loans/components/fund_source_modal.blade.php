<div class="modal fade" id="addnew"  data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">إضافة مصدر تمويل</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_fund_source" action="{{route('portal.loan-request.fund-source.store')}}">
            <div class="modal-body wizard" id="wizardBasic">
                <div class="row g-0 py-2 text-center">
                    <div class="fw-bold h5">مصادر التمويل</div>
                    <p>ادخل البيانات التالية لإضافة مصدر تمويل جديد</p>
                </div>
                <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                <input type="text" name="FUND_ID" value="" hidden>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-floating mb-4 w-100">
                            <select class="select-floating-with-search reset" name="SOURCE_ID">
                                <option></option>
                                @foreach($constants['FUND_SOURCES'] as $item)
                                    <option value="{{$item['SOURCE_ID']}}">{{$item['SOURCE_DESC']}}</option>
                                @endforeach
                            </select>
                            <label>المصدر</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control money-only formattedNumber" name="ANNUAL_SOURCE_VALUE" placeholder=" " />
                            <label>القيمة</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3">
{{--                        <input type="text" name="SOURCE_CURR_ID" value="{{$constants['DefualtCurr']}}" hidden>--}}
                        <div class="form-floating mb-3 w-100">
                            <select class="select-floating-no-search curr_select" id="SOURCE_CURR_ID_select" name="SOURCE_CURR_ID">
                                <option></option>
                                @foreach($constants['CURRENCIES'] as $index=>$item)
                                    <option value="{{$item['VALUE']}}" {{$item['VALUE']==$constants['DefualtCurr']?'selected':''}}>{{$item['LABEL']}}</option>
                                @endforeach
                            </select>
{{--                            <label>العملة</label>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="submit" class="btn btn-secondary">
                    <div class="text"><i class="fa-solid fa-plus"></i> إضافة</div>
                    <div class="btn-loader d-none">
                        <div class="spinner-border spinner-border-sm text-light" role="status">
                            <span class="visually-hidden">جاري الإضافة</span>
                        </div>
                        <span>جاري الإضافة</span>
                    </div>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">إضافة مصدر تمويل</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_fund_source" action="{{route('portal.loan-request.fund-source.store')}}">
                <div class="modal-body wizard" id="wizardBasic">
                    <div class="row g-0 py-2 text-center">
                        <div class="fw-bold h5">مصادر التمويل</div>
                        <p>ادخل البيانات التالية لتعديل مصدر التمويل</p>
                    </div>
                    <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                    <input type="text" name="FUND_ID" value="" hidden>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-floating mb-4 w-100">
                                <input type="text" name="SOURCE_ID" id="SOURCE_ID" value="" hidden>
                                <select class="select-floating-with-search reset" id="SOURCE_ID_select" disabled>
                                    <option></option>
                                    @foreach($constants['FUND_SOURCES'] as $item)
                                        <option value="{{$item['SOURCE_ID']}}">{{$item['SOURCE_DESC']}}</option>
                                    @endforeach
                                </select>
                                <label>المصدر</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control money-only formattedNumber" name="ANNUAL_SOURCE_VALUE" id="source_ANNUAL_SOURCE_VALUE" placeholder=" " />
                                <label>القيمة</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 col-lg-3">
{{--                            <input type="text" name="SOURCE_CURR_ID" value="{{$constants['DefualtCurr']}}" hidden>--}}
                            <div class="form-floating mb-3 w-100">
                                <select class="select-floating-no-search curr_select" id="SOURCE_CURR_ID" name="SOURCE_CURR_ID">
                                    <option></option>
                                    @foreach($constants['CURRENCIES'] as $index=>$item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
{{--                                <label>العملة</label>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-secondary">
                        <div class="text"><i class="fa-solid fa-plus"></i> تعديل</div>
                        <div class="btn-loader d-none">
                            <div class="spinner-border spinner-border-sm text-light" role="status">
                                <span class="visually-hidden">جاري التعديل</span>
                            </div>
                            <span>جاري التعديل</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
