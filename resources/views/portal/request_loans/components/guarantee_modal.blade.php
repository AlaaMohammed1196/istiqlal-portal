<div class="modal fade" id="addnew4"  data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">إضافة كفالة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_guarantee" action="{{route('portal.loan-request.guarantee.store')}}">
            <div class="modal-body wizard" id="wizardBasic">
                <div class="row g-0 py-2 text-center">
                    <div class="fw-bold h5">الكفالات</div>
                    <p>ادخل البيانات التالية لإضافة كفالة جديدة</p>
                </div>
                <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                <input type="text" name="FUND_ID" hidden>
                <input type="text" name="FUND_GUARANTEE_ID" value="" hidden>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-floating mb-4 w-100">
                            <select class="select-floating-with-search reset" name="GUARANTEE_TYPE_ID">
                                <option></option>
                                @foreach($constants['Bails_Types'] as $index=>$item)
                                    <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                @endforeach
                            </select>
                            <label>الكفالة</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-floating mb-4 w-100">
                            <select class="select-floating-with-search reset" name="SALARY_TYPE_ID">
                                <option></option>
                                @foreach($constants['SALARY_TYPES'] as $index=>$item)
                                    <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                @endforeach
                            </select>
                            <label>وصف الكفالة</label>
                        </div>
                    </div>
                </div>

                <div class="row no_salary d-none">
                    <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control money-only formattedNumber" placeholder="القيمة التقديرية" name="GUARANTEE_VALUE"/>
                            <label>القيمة التقديرية</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="form-floating mb-3 w-100">
                            <select class="select-floating-no-search curr_select" name="GURANTEES_CURR_ID">
                                <option></option>
                                @foreach($constants['CURRENCIES'] as $index=>$item)
                                    <option value="{{$item['VALUE']}}" {{$item['VALUE']==$constants['DefualtCurr']?'selected':''}}>{{$item['LABEL']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="with_salary">
                    <div class="duplicate_guarantee_copy d-none">
                        <div class="row">
                            <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control SALARY_DESC" placeholder="وصف الدخل الشهري" name="SALARY_DESC[]"/>
                                    <label>وصف الدخل الشهري</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control money-only formattedNumber SALARY_VALUE" placeholder="القيمة" name="SALARY_VALUE[]"/>
                                    <label>القيمة</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                                <div class="form-floating mb-3 w-100">
                                    <select class="select-floating-no-search curr_select SALARY_CURR_ID" name="SALARY_CURR_ID[]">
                                        <option></option>
                                        @foreach($constants['CURRENCIES'] as $index=>$item)
                                            <option value="{{$item['VALUE']}}" {{$item['VALUE']==$constants['DefualtCurr']?'selected':''}}>{{$item['LABEL']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="وصف الدخل الشهري" name="SALARY_DESC[]"/>
                                <label>وصف الدخل الشهري</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control money-only formattedNumber" placeholder="القيمة" name="SALARY_VALUE[]"/>
                                <label>القيمة</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                            <div class="form-floating mb-3 w-100">
                                <select class="select-floating-no-search curr_select" name="SALARY_CURR_ID[]">
                                    <option></option>
                                    @foreach($constants['CURRENCIES'] as $index=>$item)
                                        <option value="{{$item['VALUE']}}" {{$item['VALUE']==$constants['DefualtCurr']?'selected':''}}>{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="duplicate_guarantee_here"></div>
                    <div class="row">
                        <div class="col-12 text-start">
                            <button type="button" class="btn btn-secondary p-3 duplicate_guarantee"><i class="fa-solid fa-plus"></i></button>
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

<div class="modal fade" id="editModal4"  data-bs-keyboard="false" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">تعديل كفالة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_guarantee" action="{{route('portal.loan-request.guarantee.store')}}">
                <div class="modal-body wizard" id="wizardBasic">
                    <div class="row g-0 py-2 text-center">
                        <div class="fw-bold h5">الكفالات</div>
                        <p>ادخل البيانات التالية لتعديل الكفالة</p>
                    </div>
                    <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                    <input type="text" name="FUND_ID" hidden>
                    <input type="text" name="FUND_GUARANTEE_ID" id="FUND_GUARANTEE_ID" value="" hidden>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-floating mb-4 w-100">
                                <select class="select-floating-with-search reset" name="GUARANTEE_TYPE_ID" id="GUARANTEE_TYPE_ID">
                                    <option></option>
                                    @foreach($constants['Bails_Types'] as $index=>$item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                                <label>الضمان</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-floating mb-4 w-100">
                                <select class="select-floating-with-search reset" name="SALARY_TYPE_ID" id="SALARY_TYPE_ID">
                                    <option></option>
                                    @foreach($constants['SALARY_TYPES'] as $index=>$item)
                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                                <label>وصف الكفالة</label>
                            </div>
                        </div>
                    </div>

                    <div class="row no_salary d-none">
                        <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control money-only formattedNumber" placeholder="القيمة التقديرية" name="GUARANTEE_VALUE" id="GUARANTEE_VALUE"/>
                                <label>القيمة التقديرية</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                            <div class="form-floating mb-3 w-100">
                                <select class="select-floating-no-search curr_select" name="GURANTEES_CURR_ID" id="GURANTEES_CURR_ID">
                                    <option></option>
                                    @foreach($constants['CURRENCIES'] as $index=>$item)
                                        <option value="{{$item['VALUE']}}" {{$item['VALUE']==$constants['DefualtCurr']?'selected':''}}>{{$item['LABEL']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="with_salary">
                        <div class="duplicate_guarantee_copy d-none">
                            <div class="row">
                                <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control SALARY_DESC" placeholder="وصف الدخل الشهري" name="SALARY_DESC[]"/>
                                        <label>وصف الدخل الشهري</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control money-only formattedNumber SALARY_VALUE" placeholder="القيمة" name="SALARY_VALUE[]"/>
                                        <label>القيمة</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                                    <div class="form-floating mb-3 w-100">
                                        <select class="select-floating-no-search curr_select SALARY_CURR_ID" name="SALARY_CURR_ID[]">
                                            <option></option>
                                            @foreach($constants['CURRENCIES'] as $index=>$item)
                                                <option value="{{$item['VALUE']}}" {{$item['VALUE']==$constants['DefualtCurr']?'selected':''}}>{{$item['LABEL']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="edited_duplicate_guarantee_here"></div>
                        <div class="row">
                            <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder="وصف الدخل الشهري" name="SALARY_DESC[]"/>
                                    <label>وصف الدخل الشهري</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control money-only formattedNumber" placeholder="القيمة" name="SALARY_VALUE[]"/>
                                    <label>القيمة</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                                <div class="form-floating mb-3 w-100">
                                    <select class="select-floating-no-search curr_select" name="SALARY_CURR_ID[]">
                                        <option></option>
                                        @foreach($constants['CURRENCIES'] as $index=>$item)
                                            <option value="{{$item['VALUE']}}" {{$item['VALUE']==$constants['DefualtCurr']?'selected':''}}>{{$item['LABEL']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="duplicate_guarantee_here"></div>
                        <div class="row">
                            <div class="col-12 text-start">
                                <button type="button" class="btn btn-secondary p-3 duplicate_guarantee"><i class="fa-solid fa-plus"></i></button>
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
