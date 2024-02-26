<div class="modal fade" id="code_modal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">أدخال رمز التحقق</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="">
                <input type="text" hidden="" id="extra" value="">
                <p class="card-text text-center m-0 px-5 py-4 fs-6">تم إرسال رمز تحقق برسالة نصية إلى هاتفك المحمول يرجى إدخال الرمز للتأكيد</p>
                <form class="tooltip-end-bottom pb-5" id="verify_code">
                    <div class="alert alert-success mx-5 d-none" role="alert"></div>
                    <div class="alert alert-danger mx-5 d-none" role="alert"></div>
                    <input type="text" name="code_is_required" value="1" hidden>
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <div class="code-inputs">
                            <input type="text" inputmode="numeric" id="code1" name="code1" maxlength="1" value="" autocomplete="off">
                            <input type="text" inputmode="numeric" id="code2" name="code2" maxlength="1" value="" autocomplete="off">
                            <input type="text" inputmode="numeric" id="code3" name="code3" maxlength="1" value="" autocomplete="off">
                            <input type="text" inputmode="numeric" id="code4" name="code4" maxlength="1" value="" autocomplete="off">
                        </div>
                        <div class="d-flex justify-content-around mt-3 mb-3">
                            <button type="button" class="border-0 bg-white text-muted" id="resend_code">
                                <div class="text"><i class="fa-solid fa-arrows-rotate"></i> إعادة إرسال</div>
                                <div class="btn-loader d-none">
                                    <div class="spinner-border spinner-border-sm text-light" role="status">
                                        <span class="visually-hidden">جاري الإرسال</span>
                                    </div>
                                    <span>جاري الإرسال</span>
                                </div>
                            </button>
                            <span class="d-block text-primary" id="countdown">00:59</span>
                        </div>
                    </div>
                    <div class="modal-footer px-0 pb-0 mt-5 px-5">
                        <button class="btn btn-icon btn-icon-end btn-secondary" type="submit">
                            <div class="text">
                                <span>إرسال</span>
                                <i data-acorn-icon="chevron-left"></i>
                            </div>
                            <div class="btn-loader d-none">
                                <div class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">جاري الإرسال</span>
                                </div>
                                <span>جاري الإرسال</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
