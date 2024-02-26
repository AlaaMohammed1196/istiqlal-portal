@if(count($data) > 0)
    @foreach(collect($data)->take(1) as $index=>$item)
        @php $details = getFundData($item['FUND_ID']) @endphp
        @php $comments = getFundComments($item['FUND_ID']) @endphp
        <div class="tab-pane fade {{$index==0?'show active':''}} h-100-card" id="content-{{$item['FUND_ID']}}" role="tabpanel" aria-labelledby="tab-{{$item['FUND_ID']}}">
            <ul class="nav nav-pills responsive-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex align-items-center active" id="request-comments-1" data-bs-toggle="tab" data-bs-target="#request-comments-1-pane" type="button" role="tab" aria-controls="request-comments-1-pane" aria-selected="false">
                        <i class="fa-solid fa-comments ms-2"></i> التعليقات والمرفقات
                        <span class="me-2 comments-number d-inline-block"><div class="badge bg-secondary" id="contactUnread">{{count($comments['FUND_COMMENTS'])}}</div></span>
                    </button>
                </li>
            </ul>
            <div class="tab-content h-100-card" id="myTabContent">
                <div class="tab-pane fade show active h-100" id="request-comments-1-pane" role="tabpanel" aria-labelledby="request-comments-1" tabindex="0">
                    <div class="card loan-chat-box mb-2">
                        <div class="card-body d-flex flex-column h-100 w-100 position-relative">
                            <!-- User Start -->
{{--                            @dd($details)--}}
                            <div class="d-flex flex-row align-items-center mb-3">
                                <div class="row g-0 align-self-start" id="contactTitle">
                                    <div class="col-auto">
                                        <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border border-secondary ms-3">
                                            <i class="fa-solid fa-file-invoice fa-2x text-secondary"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card-body d-flex flex-row pt-0 pb-0 pe-0 pe-0 ps-2 h-100 align-items-center justify-content-between">
                                            <div class="d-flex flex-column">
                                                <div class="program">{{$details['data']['Fund_Data'][0]['PRODUCT_TYPE']}}</div>
                                                <div class="name fw-bold">{{$details['data']['Fund_Data'][0]['FINANCING_PURPOSE_DESC']}}</div>
                                                <div class=" text-secondary fw-bold h4 mb-0 last">{{$details['data']['Fund_Data'][0]['GOODS_VALUE']}} {{$details['data']['Fund_Data'][0]['GOOD_CURR_NAME']}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-1 me-auto">
                                    <div class="text-success">
                                        <i class="fa-regular fa-circle-check "></i> {{$details['data']['Fund_Data'][0]['FUND_STATUS_DESC']}}
                                    </div>
                                </div>
                            </div>
                            <div class="separator-light mb-3"></div>
                            <!-- User End -->

                            <!-- Messages Start -->
                            <div class="h-100 mb-n2 scroll-out">
{{--                                @dd($comments['FUND_COMMENTS'])--}}
                                <div class="h-100 scroll-track-visible px-3" id="comments-{{$item['FUND_ID']}}">
                                    @if(count($comments['FUND_COMMENTS']) > 0)
                                    @foreach($comments['FUND_COMMENTS'] as $comment)
                                        <div class="mb-2 card-content">
                                            <div class="row g-2">
                                                <div class="col-auto d-flex align-items-end">
                                                    <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                                                        <img src="{{session()->get('user')['USER_PICTURE_LINK']?session()->get('user')['USER_PICTURE_LINK']:asset('default.jpg')}}" class="img-fluid rounded-xl chat-profile" alt="thumb">
                                                    </div>
                                                </div>
                                                <div class="col d-flex align-items-end content-container">
                                                    <div class="bg-separator-light d-inline-block rounded-md py-3 px-3 ps-7 position-relative text-alternate">
                                                        <span class="text">{{$comment['FUND_COMMENT']}}</span>
                                                        <span class="position-absolute text-extra-small text-alternate opacity-75 b-2 s-2 time">{{$comment['CREATED_ON']?\Carbon\Carbon::parse($comment['CREATED_ON'])->diffForHumans():''}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <form class="add-comment" action="{{route('portal.orders.comment.add')}}">
                            <div class="card-body p-0 d-flex flex-row align-items-center px-3 py-3">
                                <input type="text" name="FUND_ID" value="{{$item['FUND_ID']}}" hidden>
                                <textarea class="form-control me-3 border-0 ps-2 py-2" placeholder="اكتب هنا" rows="1" name="FUND_COMMENT" id="FUND_COMMENT"></textarea>
                                <div class="d-flex flex-row">
                                    <input class="file-upload d-none" type="file" name="FUND_ATTACHS" accept="image/*" id="attachButton">
                                    <label class="btn btn-icon btn-icon-only btn-outline-secondary mb-1 rounded-xl" for="attachButton" type="button">
                                        <i data-acorn-icon="attachment"></i>
                                    </label>
                                    <button class="btn btn-icon btn-icon-only btn-secondary mb-1 rounded-xl me-1" id="chatSendButton" type="submit">
                                        <div class="text"><i data-acorn-icon="chevron-left"></i></div>
                                        <div class="btn-loader d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></div>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Chat View End -->

                </div>
            </div>
        </div>
    @endforeach
@endif
