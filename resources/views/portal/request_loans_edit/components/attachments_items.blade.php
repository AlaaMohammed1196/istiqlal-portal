@if(count($data['FUND_ATTACHMENTS']) > 0)
    @foreach($data['FUND_ATTACHMENTS'] as $item)
        @if($item['FILE_TYPE'] != '.png' || $item['FILE_TYPE'] != '.svg' || $item['FILE_TYPE'] != '.jpg' || $item['FILE_TYPE'] != '.jpeg')
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
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top" onclick="removeAttach(this); " data-id="{{$item['D_ATTACHMENT_ID']}}" type="button">
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
                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top" onclick="removeAttach(this);" data-id="{{$item['D_ATTACHMENT_ID']}}" type="button">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </button>
                </div>
            </div>
        @endif
    @endforeach
@endif
