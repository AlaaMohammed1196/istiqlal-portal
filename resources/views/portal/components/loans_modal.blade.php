<div class="modal-header">
    <h5 class="modal-title fw-bold" id="addnewLabel">{{$program['PROGRAM_TYPE_DESC']??''}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body" >
    @if(count($loans) > 0)
        @foreach($loans as $item)
            <div class="card bg-gradient-light border border-light sh-16 sh-sm-18 mb-4">
                <div class="row g-0 h-100 align-items-center">
                    <div class="col-auto mb-5">
                        <div class="sw-8 sh-8 rounded-xl d-flex justify-content-center align-items-center border card-img-horizontal border-secondary me-4">
                            <i class="fa-solid fa-file-invoice fa-2x text-secondary"></i>
                        </div>
                    </div>
                    <div class="col position-static mb-5">
                        <div class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                            <div class="d-flex flex-column">
                                <a href="javascript:void(0);" class="stretched-link body-link">
                                    <div class="clamp-line text-white" data-line="2" style="overflow: hidden; text-overflow: ellipsis; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2;">{{$item['PRODUCT_TYPE']}}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-brand-v3"></div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">لا يوجد قروض لهذا البرنامج</p>
    @endif
</div>
