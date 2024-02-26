<div class="modal fade" id="addnew3"  data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">إضافة ضمان</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_warranty" action="{{route('portal.loan-request.warranty.store')}}">
            <div class="modal-body wizard" id="wizardBasic">
                <div class="row g-0 py-2 text-center">
                    <div class="fw-bold h5">الضمانات</div>
                    <p>ادخل البيانات التالية لإضافة ضمان جديد</p>
                </div>
                <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                <input type="text" name="FUND_ID" value="{{$data['Fund_Data'][0]['FUND_ID']}}" hidden>
                <input type="text" name="FUND_GUARANTEE_ID" value="" hidden>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-floating mb-4 w-100">
                            <select class="select-floating-with-search reset" name="GUARANTEE_TYPE_ID">
                                <option></option>
                                @foreach($constants['GUARANTEE_TYPES'] as $index=>$item)
                                    <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                @endforeach
                            </select>
                            <label>الضمان</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" placeholder="وصف الضمان" name="GUARANTEE_DESC"/>
                            <label>وصف الضمان</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control money-only formattedNumber" placeholder="القيمة التقديرية" name="GUARANTEE_VALUE"/>
                            <label>القيمة التقديرية</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3">
{{--                        <input type="text" name="GURANTEES_CURR_ID" value="{{$data['Fund_Data'][0]['CURR_ID']}}" hidden>--}}
                        <div class="form-floating mb-3 w-100">
                            <select class="select-floating-no-search curr_select" name="GURANTEES_CURR_ID">
                                <option></option>
                                @foreach($constants['CURRENCIES'] as $index=>$item)
                                    <option value="{{$item['VALUE']}}" {{$data['Fund_Data'][0]['CURR_ID']==$item['VALUE']?'selected':''}}>{{$item['LABEL']}}</option>
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

<div class="modal fade" id="editModal3"  data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">تعديل ضمان</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_warranty" action="{{route('portal.loan-request.warranty.store')}}">
                <div class="modal-body wizard" id="wizardBasic">
                    <div class="row g-0 py-2 text-center">
                        <div class="fw-bold h5">الضمانات</div>
                        <p>ادخل البيانات التالية لتعديل الضمان</p>
                    </div>
                    <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                    <input type="text" name="FUND_ID" value="{{$data['Fund_Data'][0]['FUND_ID']}}" hidden>
                    <input type="text" name="FUND_GUARANTEE_ID" id="FUND_GUARANTEE_ID_1" value="" hidden>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-floating mb-4 w-100">
                                <select class="select-floating-with-search reset" name="GUARANTEE_TYPE_ID" id="GUARANTEE_TYPE_ID_1">
                                    <option></option>
                                    @foreach($constants['GUARANTEE_TYPES'] as $index=>$item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                                <label>الضمان</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" placeholder="وصف الضمان" name="GUARANTEE_DESC" id="GUARANTEE_DESC_1"/>
                                <label>وصف الضمان</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control money-only formattedNumber" placeholder="القيمة التقديرية" name="GUARANTEE_VALUE" id="GUARANTEE_VALUE_1"/>
                                <label>القيمة التقديرية</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 col-lg-3">
{{--                            <input type="text" name="GURANTEES_CURR_ID" value="{{$data['Fund_Data'][0]['CURR_ID']}}" hidden>--}}
                            <div class="form-floating mb-3 w-100">
                                <select class="select-floating-no-search curr_select" id="GURANTEES_CURR_ID_1" name="GURANTEES_CURR_ID">
                                    <option></option>
                                    @foreach($constants['CURRENCIES'] as $index=>$item)
                                        <option value="{{$item['VALUE']}}" {{$data['Fund_Data'][0]['CURR_ID']==$item['VALUE']?'selected':''}}>{{$item['LABEL']}}</option>
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
