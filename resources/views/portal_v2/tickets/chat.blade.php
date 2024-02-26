@if(count($data['TICKET_COMMENTS']) > 0)
    @foreach($data['TICKET_COMMENTS'] as $index=>$item)
        <div class="{{$index==0?'':'pt-4'}} border-bottom border-separator-light">
            <div class="row g-0 sh-sm-5 h-auto">
                @if($item['ENTRY_SOURCE_ID'] == 1)
                    <div class="col-auto">
                        <img src="{{asset('assets/img/favicon/favicon-32x32.png')}}" class="card-img rounded-xl sh-5 sw-5" alt="thumb" />
                    </div>
                    <div class="col px-3">
                        <div class="row h-100 g-2">
                            <div class="col h-sm-100 d-flex flex-column justify-content-sm-center mb-1 mb-sm-0">
                                <div>موظف البنك</div>
                            </div>
                            <div class="col-12 order-3 order-sm-0 col-sm-auto text-muted text-sm-end d-flex flex-column justify-content-sm-center">{{Carbon\Carbon::parse($item['CREATED_ON'])->translatedFormat('d/m/Y')}}</div>
                        </div>
                    </div>
                @else
                    <div class="col-auto">
                        <img src="{{isset($item['USER_PICTURE_LINK'])&&$item['USER_PICTURE_LINK']?$item['USER_PICTURE_LINK']:asset('default.jpg')}}" class="card-img rounded-xl sh-5 sw-5" alt="thumb" />
                    </div>
                    <div class="col px-3">
                        <div class="row h-100 g-2">
                            <div class="col h-sm-100 d-flex flex-column justify-content-sm-center mb-1 mb-sm-0">
                                <div>{{$item['USER_FULL_NAME']}}</div>
                            </div>
                            <div class="col-12 order-3 order-sm-0 col-sm-auto text-muted text-sm-end d-flex flex-column justify-content-sm-center">{{Carbon\Carbon::parse($item['CREATED_ON'])->translatedFormat('d/m/Y')}}</div>
                        </div>
                    </div>
                @endif
            </div>
            <div>
                <div class="mt-4">
                    <p>{{$item['COMMENT_DESCRIPTION']}}</p>
                </div>
                <div class="row">
                    @foreach($item['COMMENT_ATTACHMENTS'] as $attach)
                    <div class="sw-30 me-2 mt-3 mb-4">
                        <div class="row g-0 rounded-sm sh-8 border">
                            <div class="col-auto">
                                <div class="sw-8 d-flex justify-content-center align-items-center h-100">
{{--                                    <i data-acorn-icon="file-text" class="text-primary"></i>--}}
                                    <i class="fa-regular fs-5 fa-file-lines text-primary"></i>
                                </div>
                            </div>
                            <div class="col rounded-sm-end d-flex flex-column justify-content-center ps-3">
                                <div class="d-flex justify-content-between">
                                    <p class="mb-0 clamp-line" data-line="1">{{$attach['ORIGINAL_FILE_NAME']}}</p>
                                    <a href="{{$attach['ATTACHMENT_LINK']}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$attach['ORIGINAL_FILE_NAME']}}">
{{--                                        <i data-acorn-icon="download" data-acorn-size="17" class="text-alternate stretched-link"></i>--}}
                                        <i class="fa-solid fa-cloud-arrow-down text-alternate stretched-link"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@endif
