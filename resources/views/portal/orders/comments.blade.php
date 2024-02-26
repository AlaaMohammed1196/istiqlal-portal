@if(count($details['data']['FUND_COMMENTS']) > 0)
    @foreach($details['data']['FUND_COMMENTS'] as $comment)
        @if($comment['USER_TYPE_ID'] == 1)
            <div class="mb-2 card-content">
                <div class="row g-2">
                    <div class="col-auto d-flex align-items-end">
                        <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                            <img src="{{session()->get('user')['USER_PICTURE_LINK']?session()->get('user')['USER_PICTURE_LINK']:asset('default.jpg')}}" class="img-fluid rounded-xl chat-profile" alt="thumb">
                        </div>
                    </div>
                    <div class="col d-flex align-items-end content-container">
                        <div class="bg-separator-light d-inline-block rounded-md py-3 px-3 ps-7 position-relative text-alternate mw-100px">
                            <span class="text">{!! $comment['FUND_COMMENT'] !!}</span>
                            <span class="position-absolute text-extra-small text-alternate opacity-75 b-2 s-2 time">{{$comment['CREATED_ON']?\Carbon\Carbon::parse($comment['CREATED_ON'])->translatedFormat('d-m-Y'):''}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if($comment['COMMENT_FILES'])
                <div class="mb-2 card-content">
                    <div class="row g-2">
                        <div class="col-auto d-flex align-items-end">
                            <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                                <img src="{{session()->get('user')['USER_PICTURE_LINK']?session()->get('user')['USER_PICTURE_LINK']:asset('default.jpg')}}" class="img-fluid rounded-xl chat-profile" alt="thumb">
                            </div>
                        </div>
                        <div class="col d-flex align-items-end content-container">
                            @foreach($comment['COMMENT_FILES'] as $attach)
                                @if($attach['FILE_TYPE'] != '.png' || $attach['FILE_TYPE'] != '.svg' || $attach['FILE_TYPE'] != '.jpg' || $attach['FILE_TYPE'] != '.jpeg')
                                    <div class="d-inline-block sh-11 ms-2 position-relative p-4 rounded-md bg-separator-light text-alternate">
                                        <a href="{{config('app.attach').'/'.$attach['ATTACHMENT_ID']}}" download="{{$attach['ORIGINAL_FILE_NAME']}}" class="h-100 attachment stretched-link cursor">
                                            <p>{{$attach['ORIGINAL_FILE_NAME']}}</p>
                                        </a>
                                        <span class="position-absolute text-extra-small text-alternate opacity-75 b-2 s-2 time">{{$comment['CREATED_ON']?\Carbon\Carbon::parse($comment['CREATED_ON'])->translatedFormat('d-m-Y'):''}}</span>
                                    </div>
                                @else
                                    <div class="d-inline-block sh-11 ms-2 position-relative pb-4 rounded-md bg-separator-light text-alternate mw-100px">
                                        <a href="{{config('app.attach').'/'.$attach['ATTACHMENT_ID']}}" download="{{$attach['ORIGINAL_FILE_NAME']}}" class="lightbox h-100 attachment">
                                            <img src="{{config('app.attach').'/'.$attach['ATTACHMENT_ID']}}" class="h-100 rounded-md-top mw-100px object-cover">
                                        </a>
                                        <span class="position-absolute text-extra-small text-alternate opacity-75 b-2 s-2 time">{{$comment['CREATED_ON']?\Carbon\Carbon::parse($comment['CREATED_ON'])->translatedFormat('d-m-Y'):''}}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="mb-2 card-content">
                <div class="row g-2">
                    <div class="col-auto d-flex align-items-end {{$comment['USER_TYPE_ID']==2?'order-1':''}}">
                        <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                            <img src="{{asset('assets/img/favicon/favicon-32x32.png')}}" class="img-fluid rounded-xl chat-profile" alt="thumb">
                        </div>
                    </div>
                    <div class="col d-flex justify-content-end align-items-end content-container">
{{--                        bg-gradient-light--}}
                        <div class="bg-separator-light d-inline-block rounded-md py-3 px-3 pe-7 text-alternate position-relative mw-100px">
                            <span class="text">{!! $comment['FUND_COMMENT'] !!}</span>
                            <span class="position-absolute text-extra-small opacity-75 b-2 e-2 time text-alternate">{{$comment['CREATED_ON']?\Carbon\Carbon::parse($comment['CREATED_ON'])->translatedFormat('d-m-Y'):''}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if($comment['COMMENT_FILES'])
                <div class="mb-2 card-content">
                    <div class="row g-2">
                        <div class="col-auto d-flex align-items-end {{$comment['USER_TYPE_ID']==2?'order-1':''}}">
                            <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                                <img src="{{session()->get('user')['USER_PICTURE_LINK']?session()->get('user')['USER_PICTURE_LINK']:asset('default.jpg')}}" class="img-fluid rounded-xl chat-profile" alt="thumb">
                            </div>
                        </div>
                        <div class="col d-flex justify-content-end align-items-end content-container">
                            @foreach($comment['COMMENT_FILES'] as $attach)
                                @if($attach['FILE_TYPE'] != '.png' || $attach['FILE_TYPE'] != '.svg' || $attach['FILE_TYPE'] != '.jpg' || $attach['FILE_TYPE'] != '.jpeg')
                                    <div class="d-inline-block sh-11 ms-2 position-relative pb-4 bg-primary rounded-md text-white mw-100px">
                                        <a href="{{config('app.attach').'/'.$attach['ATTACHMENT_ID']}}" download="{{$attach['ORIGINAL_FILE_NAME']}}" class=" h-100 attachment stretched-link cursor">
                                            <p class="text-white">{{$attach['ORIGINAL_FILE_NAME']}}</p>
                                        </a>
                                        <span class="position-absolute text-extra-small text-white opacity-75 b-2 s-2 time">{{$comment['CREATED_ON']?\Carbon\Carbon::parse($comment['CREATED_ON'])->translatedFormat('d-m-Y'):''}}</span>
                                    </div>
                                @else
                                    <div class="d-inline-block sh-11 me-2 position-relative pb-4 bg-primary rounded-md mw-100px">
                                        <a href="{{config('app.attach').'/'.$attach['ATTACHMENT_ID']}}" download="{{$attach['ORIGINAL_FILE_NAME']}}" class="lightbox h-100 attachment">
                                            <img src="{{config('app.attach').'/'.$attach['ATTACHMENT_ID']}}" class="h-100 rounded-md-top mw-100px">
                                        </a>
                                        <span class="position-absolute text-extra-small text-white opacity-75 b-2 e-2 time">{{$comment['CREATED_ON']?\Carbon\Carbon::parse($comment['CREATED_ON'])->translatedFormat('d-m-Y'):''}}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach
@endif
