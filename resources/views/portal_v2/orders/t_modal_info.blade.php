<input type="text" name="VOUCHER_SEQ" value="{{$extra['VOUCHER_SEQ']}}" hidden>
<input type="text" name="APPROVAL_STATUS" value="{{$extra['APPROVAL_STATUS_ID']}}" hidden>
<input type="text" name="REJECT_NOTES" value="" hidden>
<input type="text" name="type" value="2" hidden>
@foreach($steps as $index=>$item)
<h4 class="mt-3">الخطوة رقم {{$item['STEP_ID']}}</h4>
<div class="table-responsive">
    <table id="checkboxTable" class="table align-middle">
        <thead>
        <tr>
            <th scope="col" style="word-wrap: break-word;">الخطوة</th>
            <th scope="col" class="text-center">الحالة</th>
            <th scope="col" class="text-center">تاريخ تغيير الحالة</th>
            <th scope="col" class="text-center">الشخص</th>
            <th scope="col" class="text-center"></th>
        </tr>
        </thead>
        <tbody id="modal_info">
            @foreach($item['REQUEST_STEP_ROLES'] as $i=>$role)
                <tr>
                    <td scope="row">{{$role['ROLE_DESC']}}</td>
                    <td class="text-center"><strong class="text-dark">{{$role['APPROVAL_STATUS_DESC']}}</strong></td>
                    <td class="text-center"><strong class="text-dark">{{$role['APPROVAL_STATUS_CHANGED_ON']??'-'}}</strong></td>
                    <td class="text-center"><span class="text-dark">{{$role['APPROVAL_STATUS_CHANGED_BY']??'-'}}</span></td>
                    <td class="text-center">
                        @if($role['USER_HAVE_ROLE']==1 && $role['APPROVAL_STATUS_ID']==1  && $item['APPROVAL_STATUS_ID']==1  && $extra['APPROVAL_STATUS_ID'] != -1)
                            <input type="text" name="REQUEST_STEPS[{{$index}}][STEP_ID]" value="{{$item['STEP_ID']}}" hidden>
                            <label class="form-check mx-3">
                                <input type="checkbox" class="form-check-input" name="REQUEST_STEPS[{{$index}}][COMMAND_STEP_ROLES][{{$i}}][ROLE_ID]" value="{{$role['ROLE_ID']}}"/>
                            </label>
                        @endif
                        @if($role['USER_HAVE_ROLE'] && $role['APPROVAL_STATUS_ID']!=1)
                            <a href="javascript:void(0);" role="button" data-type="2" data-seq="{{$extra['VOUCHER_SEQ']}}" data-step="{{$item['STEP_ID']}}" data-role="{{$role['ROLE_ID']}}" class="undo_step_request btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top mx-1"
                               data-bs-toggle="tooltip" data-bs-title="إلغاء">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr class="table-light">
                <td scope="row"><strong class="text-dark">حالة الخطوة النهائية</strong></td>
                <td class="text-center"><strong class="text-dark">{{$item['APPROVAL_STATUS_DESC']}}</strong></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
            </tr>
        </tbody>
    </table>
</div>
@endforeach
