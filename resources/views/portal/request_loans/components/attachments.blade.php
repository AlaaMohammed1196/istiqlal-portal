<form id="attachments_form" action="{{route('portal.loan-request.attachments.store')}}">
    <div class="alert alert-danger mb-4 d-none" role="alert"></div>
    <input type="text" name="FUND_ID" value="" hidden>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="mb-3 row">
                <label class="col-lg-4 col-md-3 col-sm-4 col-form-label">أنواع الملفات <span class="text-danger">*</span></label>
                <div class="col-sm-8 col-md-9 col-lg-8">
                    <select class="select-single-with-search" name="DOC_CLASS_IDS" id="DOC_CLASS_IDS" data-placeholder="اختر نوع الملف" data-width="100%">
                        <option></option>
                        @foreach($constants['ATTACHMENT_TYPES'] as $item)
                            <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <div class="input-group">
                    <input type="file" class="form-control" name="FUND_ATTACHS" id="FUND_ATTACHS" onchange="loadFile(this)" aria-describedby="inputGroupFileAddon04" lang="ar" aria-label="Upload" />
                    <button class="btn btn-secondary" type="submit" id="upload_attach">رفع الملف
                        <!--<div class="text">رفع الملف</div>-->
                        <div class="btn-loader d-none">
                            <div class="spinner-border spinner-border-sm text-light" role="status">
                                <span class="visually-hidden">جاري الرفع</span>
                            </div>
                            <!--<span>جاري الرفع</span>-->
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="attach_list">
    </div>
    <div class="mb-3 row mt-5">
        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
            <button type="button" class="btn btn-icon btn-icon-only btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto mb-2 btnPrev"><i class="fa-solid fa-chevron-right"></i></button>
            <button type="button" id="apply_loan" class="btn btn-primary w-100 w-sm-auto mb-2">تقديم الطلب</button>
        </div>
    </div>
</form>
