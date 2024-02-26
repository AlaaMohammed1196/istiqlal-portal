<div class="modal-body py-2" id="modal_info">
    <input type="text" name="VOUCHER_SEQ" value="{{$extra['VOUCHER_SEQ']}}" hidden>
    <input type="text" name="type" value="2" hidden>
    @php $countStatusChange = 0; $needMyApproval = false; @endphp
    <div class="px-5">
        <div class="row mb-2 pb-2 border-bottom">
            <h5 class="fw-bold mb-2">الطلب في حاجة لموافقة</h5>
            @foreach($steps as $index=>$step)
                <div class="d-flex mb-1">{{$step['STEP_ID']}} -
                    @foreach($step['REQUEST_STEP_ROLES'] as $i=>$role)
                        <p class="m-0">{{$i!=0?', ':''}}{{$role['ROLE_DESC']}}</p>
                        @if($role['USER_HAVE_ROLE']==1 && $role['APPROVAL_STATUS_ID']==1 && $step['APPROVAL_STATUS_ID']==1 && $extra['APPROVAL_STATUS_ID'] != -1)
                            @php $needMyApproval = true @endphp
                            <input type="text" name="REQUEST_STEPS[{{$index}}][STEP_ID]" value="{{$step['STEP_ID']}}" hidden>
                            <input type="checkbox" name="REQUEST_STEPS[{{$index}}][COMMAND_STEP_ROLES][{{$i}}][ROLE_ID]" value="{{$role['ROLE_ID']}}" checked hidden/>
                        @endif
                        @if($role['APPROVAL_STATUS_ID']!=1)
                            @php $countStatusChange++ @endphp
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <div class="px-5">
        <div class="row mb-2 pb-2">
            <h5 class="fw-bold mb-2">السجلات</h5>
            <div class="table-responsive">
                <table id="checkboxTable" class="table align-middle">
                    <thead>
                    <tr>
                        <th scope="col" style="word-wrap: break-word;">الشخص</th>
                        <th scope="col" class="text-center">الحالة</th>
                        <th scope="col" class="text-center">تاريخ تغيير الحالة</th>
                        <th scope="col" class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($countStatusChange > 0)
                        @foreach($steps as $index=>$step)
                            @foreach($step['REQUEST_STEP_ROLES'] as $i=>$role)
                                <tr class="{{$role['APPROVAL_STATUS_ID']!=1?'':'d-none'}}">
                                    <td scope="row">{{$role['ROLE_DESC']}}</td>
                                    <td class="text-center"><strong class="text-dark">{{$role['APPROVAL_STATUS_DESC']}}</strong></td>
                                    <td class="text-center"><span class="text-dark">{{$role['APPROVAL_STATUS_CHANGED_ON']??'-'}}</span></td>
                                    <td>
                                        @if($role['USER_HAVE_ROLE'] && $role['APPROVAL_STATUS_ID']!=1)
                                            <a href="javascript:void(0);" role="button" data-type="1" data-seq="{{$extra['VOUCHER_SEQ']}}" data-step="{{$step['STEP_ID']}}" data-role="{{$role['ROLE_ID']}}" class="undo_step_request btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top mx-1"
                                               data-bs-toggle="tooltip" data-bs-title="إلغاء">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد سجلات حتى الآن</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer py-3">
@if($extra['APPROVAL_STATUS_ID'] == 1 && $needMyApproval)
    <button type="button" id="agree" class="btn btn-secondary" data-APPROVAL_STATUS="2">
        <div class="text">موافقة</div>
        <div class="btn-loader d-none">
            <div class="spinner-border spinner-border-sm text-light" role="status">
                <span class="visually-hidden">جاري الموافقة</span>
            </div>
            <span>جاري الموافقة</span>
        </div>
    </button>
    <button type="button" id="disagree" class="btn btn-danger" data-APPROVAL_STATUS="3">
        <div class="text">رفض</div>
        <div class="btn-loader d-none">
            <div class="spinner-border spinner-border-sm text-light" role="status">
                <span class="visually-hidden">جاري الرفض</span>
            </div>
            <span>جاري الرفض</span>
        </div>
    </button>
@else
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
@endif
</div>
