<div id="confirm_form" class="px-5">
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            نوع الطلب
        </div>
        طلب تذكرة
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            رقم التذكرة
        </div>
        <div class="col-lg-8 fw-bold">{{$data['TICKET_ID']}}</div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            الأهمية
        </div>
        <div class="col-lg-8 fw-bold">{{$data['TICKET_PRIORITY_DESC']}}</div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            العنوان
        </div>
        <div class="col-lg-8 fw-bold">{{$data['TICKET_TITLE']}}</div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            التاريخ
        </div>
        <div class="col-lg-8 fw-bold">{{Carbon\Carbon::parse($data['CREATED_ON'])->translatedFormat('d/m/Y')}}</div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            الحالة
        </div>
        <div class="col-lg-8 fw-bold">{{$data['TICKET_STATUS_DESC']}}</div>
    </div>
    <div class="row mb-2 pb-2 border-bottom">
        <div class="col-lg-4">
            المرفقات
        </div>
        <div class="col-lg-8 fw-bold">
            @if(count($data['TICKET_ATTACMENTS'])>0)
                <div class="row">
                    @foreach($data['TICKET_ATTACMENTS'] as $attach)
                        <div class="d-flex align-items-center">
                            <p class="mx-2 mb-0 clamp-line" data-line="1">{{$attach['ORIGINAL_FILE_NAME']}}</p>
                            <a href="{{$attach['ATTACHMENT_LINK']}}" download="{{$attach['ORIGINAL_FILE_NAME']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$attach['ORIGINAL_FILE_NAME']}}">
                                <i class="fas fa-cloud-download-alt text-alternate stretched-link"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else -
            @endif
        </div>
    </div>
</div>
