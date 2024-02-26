<div>
    <div class="accordion accordion-flush mt-3" id="accordionFlushExample">
        @foreach($product as $index=>$item)
            <div class="accordion-item border-0 mb-3">
                <div class="accordion-header" id="flush-heading-{{$index}}">
                    <button class="accordion-button bg-light rounded-lg py-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{$index}}" aria-expanded="false" aria-controls="flush-collapse-{{$index}}">
                        <h4 class="my-3 fw-bold">{{$item['PRODUCT_TITLE_DESC']}}</h4>
                    </button>
                </div>
                <div id="flush-collapse-{{$index}}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{$index}}"
                     data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">{!! $item['TITLE_DESCRIPTION'] !!}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
