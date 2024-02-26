<div class="modal fade" id="exampleModal"  data-bs-keyboard="false" role="dialog"  tabindex="0" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addnewLabel">حاسبة القرض</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact__form mt-2">
                            <form id="calculate_form" action="{{route('portal.calculate')}}">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-floating mb-4 w-100">
                                            <select class="select-floating-with-search" name="PRODUCT_TYPE_ID" id="PRODUCT_TYPE_ID" data-width="100%">
                                                <option></option>
                                                @if(count($constants['PRODUCT_TYPES']) > 0)
                                                    @foreach($constants['PRODUCT_TYPES'] as $item)
                                                        <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <label>اختر القرض *</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-floating mb-4 w-100">
                                            <select class="select-floating-with-search" name="CURR_ID" id="CURR_ID" data-width="100%" disabled>
                                            </select>
                                            <label>اختر العملة *</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control number-only" min="4000" value="" max="25000" id="money_input" placeholder="قيمة القرض المطلوب؟ *" disabled/>
                                        <label>قيمة القرض المطلوب؟ *</label>
                                    </div>
                                </div>
                                <div class="col-12 pb-0 mb-4">
                                    <div class="form-group">
                                        <label class="d-flex justify-content-between text-secondary" for="money_range">
                                            <span>المبلغ</span>
{{--                                            <span id="rangeNumberVal">15000</span>--}}
                                        </label>
                                        <input type="range" min="4000" value="4000" max="25000" name="FINANCING_VALUE" class="form-control-range p-0 custom-range2 form-range" id="money_range" disabled>
                                        <div  class="d-flex justify-content-between text-secondary">
                                            <span class="min" id="min-amount"></span>
                                            <span class="max" id="max-amount"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control number-only" min="12" value="" max="60" id="time_input" placeholder="فترة سداد القرض *" disabled/>
                                        <label>فترة سداد القرض / بالأشهر *</label>
                                    </div>
                                </div>
                                <div class="col-12 pb-0 mb-4">
                                    <div class="form-group">
                                        <label class="d-flex justify-content-between text-secondary" for="time_range">
                                            <span>المدة</span>
{{--                                            <span id="rangeTimeVal">12</span>--}}
                                        </label>
                                        <input type="range" min="12" value="12" max="60" name="INSTALLMENT_CNT" class="form-control-range p-0 custom-range2 form-range" id="time_range" disabled>
                                        <div  class="d-flex justify-content-between text-secondary">
                                            <span class="min" id="min-time-amount"></span>
                                            <span class="max" id="max-time-amount"></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-secondary">احسب</button>
                                <button type="button" id="calculate_reset" class="btn btn-outline-secondary">إعادة تعيين</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 calculated-value">
                        <div class="text-center title mb-5">
                            <h4>دفعتك الشهرية التقريبية</h4>
                            <h2 class="value text-secondary" id="monthly_payment">
                                <span class="value">0.0</span> <span class="currency"></span>
                            </h2>
                        </div>
                        <div class="data border-top p-2 d-flex justify-content-between">
                            <span>عدد الدفعات</span>
                            <span class="value" id="payment_numbers">0</span>
                        </div>
                        <div class="data border-top p-2 d-flex justify-content-between">
                            <span>المبلغ المطلوب</span>
                            <span class="value" id="require_payment">0</span>
                        </div>
                        <div class="data border-top p-2 d-flex justify-content-between">
                            <span>نسبة الفائدة على القرض</span>
                            <span class="value" id="return_percentage">0</span>
                        </div>
                        <div class="data border-top p-2 d-flex justify-content-between">
                            <span>قيمة الفائدة على القرض</span>
                            <span class="value" id="return_value">0</span>
                        </div>
                        <div class="data border-top p-2 d-flex justify-content-between">
                            <span>مبلغ القرض الاجمالي</span>
                            <span class="value" id="total_number">0</span>
                        </div>
                        <div class="mt-10 fw-bold notes calculate_error_here mt-5"><p class="mb-0 text-danger"></p></div>
                        <div class="mt-5 fw-bold notes"><strong class="text-main text-secondary">ملاحظة:</strong><p class="mb-0">هذه المعلومات تقريبية وتخضع للسياسة الائتمانية الخاصة بالبنك.</p></div>
                        <div class="fw-bold text-center apply-new-msg d-none"><p class="pt-20"><a class="text-decoration-underline" href="#">تقدم بطلب القرض الآن</a></p></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
