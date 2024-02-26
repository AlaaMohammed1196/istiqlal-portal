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
                    <button class="btn btn-outline-secondary" type="submit" id="upload_attach">رفع الملف</button>
                </div>
            </div>
        </div>
    </div>
    <div id="attach_list">
        @if(count($data['FUND_ATTACHMENTS']) > 0)
            @foreach($data['FUND_ATTACHMENTS'] as $item)
                @if($item['FILE_TYPE'] == '.pdf')
                    <div class="d-flex border border-separator-light align-items-center rounded py-3 px-5  mb-3 mt-3">
                        <i class="fa-solid fa-paperclip text-secondary"></i>
                        <div class="mx-2">
                            <a href="{{config('app.attach').'/'.$item['ATTACHMENT_ID']}}" download="{{$item['ORIGINAL_FILE_NAME']}}">
                                {{$item['DOC_CLASS_DESC']}}
                                <div>
                                    <small class="ms-2">نوع الملف: {{$item['FILE_TYPE']}}</small>
                                    <small class="ms-2">حجم الملف: {{$item['ATTACHMENT_SIZE']}}</small>
                                </div>
                            </a>
                        </div>
                        <div class="me-auto">
                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top" onclick="removeAttach(this)" data-id="{{$item['D_ATTACHMENT_ID']}}" type="button">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                        </div>
                    </div>
                @else
                    <div class="d-flex border border-separator-light align-items-center rounded py-3 px-5 mb-3 mt-3">
                        <i class="fa-solid fa-paperclip text-secondary"></i>
                        <div class="mx-2">
                            <a href="{{config('app.attach').'/'.$item['ATTACHMENT_ID']}}" download="{{$item['ORIGINAL_FILE_NAME']}}">
                                {{$item['DOC_CLASS_DESC']}}
                                <div>
                                    <small class="ms-2">نوع الملف: {{$item['FILE_TYPE']}}</small>
                                    <small class="ms-2">حجم الملف: {{$item['ATTACHMENT_SIZE']}}</small>
                                </div>
                            </a>
                        </div>
                        <div class="me-auto">
                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top" onclick="removeAttach(this)" data-id="{{$item['D_ATTACHMENT_ID']}}" type="button">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    <div class="mb-3 row mt-5">
        <div class="d-sm-flex justify-content-end flex-column flex-sm-row">
            <button type="button" class="btn btn-outline-secondary mx-0 mx-sm-3 w-100 w-sm-auto mb-2 btnPrev">السابق</button>
            <button type="button" id="apply_loan" class="btn btn-secondary w-100 w-sm-auto mb-2">تقديم الطلب</button>
        </div>
    </div>
</form>
