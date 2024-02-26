<div class="modal fade" id="deposits_calculator" data-bs-keyboard="false" role="dialog"  tabindex="0" aria-labelledby="exampleModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addnewLabel">حاسبة فوائد الودائع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact__form mt-2">
                            <form  id="deposit_calculate_form" action="{{route('portal.v2.calculate')}}">
                                <div class="alert alert-danger mb-4 d-none" role="alert"></div>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-floating mb-4 w-100">
                                            <select class="select-floating-with-search" name="DEPOSIT_TYPE_PERIOD_ID" id="DEPOSIT_TYPE_PERIOD_ID"  data-width="100%">
                                                <option></option>
                                                @foreach($deposit_types as $item)
                                                    <option value="{{$item['DEPOSIT_TYPE_PERIOD_ID']}}">{{$item['DEPOSIT_BIND_PERIOD_DESC']}}</option>
                                                @endforeach
                                            </select>
                                            <label>اختر المدة *</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-floating mb-4 w-100">
                                            <select class="select-floating-with-search" name="DEPOSIT_CURR_ID" id="DEPOSIT_CURR_ID" data-width="100%">
                                                <option></option>
                                                @foreach($currencies as $item)
                                                    <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                                @endforeach
                                            </select>
                                            <label>اختر العملة *</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control number-only formattedNumber" disabled name="DEPOSIT_VALUE" id="DEPOSIT_VALUE" placeholder="قيمة الوديعة *"/>
                                        <label>قيمة الوديعة *</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-secondary">
                                    <div class="text">احسب</div>
                                    <div class="btn-loader d-none">
                                        <div class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">جاري الحساب</span>
                                        </div>
                                        <span>جاري الحساب</span>
                                    </div>
                                </button>
                                <button type="button" id="deposit_calculate_reset" class="btn btn-outline-secondary">إعادة تعيين</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 calculated-value">
                        <div class="text-center title mb-5">
                            <h4>نسبة الفائدة التقريبية</h4>
                            <h2 class="value text-secondary" dir="ltr">
                                <span class="value" id="interest_rate_from">-</span>
{{--                                <span class="value" id="interest_rate_from"></span> - <span class="value" id="interest_rate_to"></span>--}}
                            </h2>
                        </div>
                        <div class="text-center title mb-5">
                            <h4>قيمة الفائدة التقريبية</h4>
                            <h2 class="value text-secondary" dir="ltr">
                                <span class="value" id="interest_value">-</span>
                            </h2>
                        </div>
                        <div class="mt-5 fw-bold notes">
                            <strong class="text-main text-secondary">ملاحظة:</strong>
                            <p class="mb-0">هذه المعلومات تقريبية و تخضع لسياسة البنك الاستثمارية</p>
                            <p class="mb-0 d-none">
                                <span>قيمة الحد الأدنى للوديعة المسموح بها في البنك : </span>
                                <span id="depositRange"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
