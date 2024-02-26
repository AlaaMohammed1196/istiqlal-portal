<div class="tab-pane fade active show" id="first" role="tabpanel">
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th scope="col" style="word-wrap: break-word;">الحساب</th>
                <th scope="col"  class="text-center">ملاحظات</th>
                <th scope="col" class="text-center">أدوات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($beneficiaries['BetweenAccounts'] as $item)
                <tr>
                    <td scope="row">
                        <div class="d-flex justify-content-start align-items-center">
                            <i class="fa-solid fa-user text-secondary mx-3"></i>
                            <div class="mx-3">
                                <div><strong>{{$item['BANK_NAME']}}</strong></div>
                                <strong>{{$item['BENEFICIARY_FULL_NAME']}}</strong>
                                <div>{{$item['IBAN']??$item['BANK_ACCOUNT_NUMBER']}}</div>
                                <div class="text-dark">{{$item['BENEFICIARY_LEDGER_NAME']}} - {{$item['BENEFICIARY_CURR_NAME']}}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <a role="button" class="{{$item['NOTES']?'text-secondary':'text-muted'}}" @if($item['NOTES'])data-bs-toggle="modal" data-bs-target="#row_notes_{{$item['BENEFICIARY_ID']}}"@endif><i class="fa-solid fa-circle-info"></i></a>
                        @if($item['NOTES'])
                            <div class="modal fade" id="row_notes_{{$item['BENEFICIARY_ID']}}" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body wizard" id="wizardBasic">
                                            <p>{{$item['NOTES']}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                    <td  class="text-center">
                        <a href="{{route('portal.v2.beneficiaries.edit', $item['BENEFICIARY_ID'])}}" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_row" data-id="{{$item['BENEFICIARY_ID']}}" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            @foreach($beneficiaries['InsidePalestine'] as $item)
                <tr>
                    <td scope="row">
                        <div class="d-flex justify-content-start align-items-center">
                            <i class="fa-solid fa-user text-secondary mx-3"></i>
                            <div class="mx-3">
                                <div><strong>{{$item['BANK_NAME']}} - {{$item['BANK_BRANCH_NAME']}}</strong></div>
                                <strong>{{$item['BENEFICIARY_FULL_NAME']}}</strong>
                                <div>{{$item['IBAN']}}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <a role="button" class="{{$item['NOTES']?'text-secondary':'text-muted'}}" @if($item['NOTES'])data-bs-toggle="modal" data-bs-target="#row_notes_{{$item['BENEFICIARY_ID']}}"@endif><i class="fa-solid fa-circle-info"></i></a>
                        @if($item['NOTES'])
                            <div class="modal fade" id="row_notes_{{$item['BENEFICIARY_ID']}}" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body wizard" id="wizardBasic">
                                            <p>{{$item['NOTES']}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                    <td  class="text-center">
                        <a href="{{route('portal.v2.beneficiaries.edit', $item['BENEFICIARY_ID'])}}" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_row" data-id="{{$item['BENEFICIARY_ID']}}" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            @foreach($beneficiaries['OutsidePalestine'] as $item)
                <tr>
                    <td scope="row">
                        <div class="d-flex justify-content-start align-items-center">
                            <i class="fa-solid fa-user text-secondary mx-3"></i>
                            <div class="mx-3">
                                <div><strong>{{$item['BANK_NAME']}} - {{$item['BANK_BRANCH_NAME']}}</strong></div>
                                <strong>{{$item['BENEFICIARY_FULL_NAME']}}</strong>
                                <div>{{$item['IBAN']}}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <a role="button" class="{{$item['NOTES']?'text-secondary':'text-muted'}}" @if($item['NOTES'])data-bs-toggle="modal" data-bs-target="#row_notes_{{$item['BENEFICIARY_ID']}}"@endif><i class="fa-solid fa-circle-info"></i></a>
                        @if($item['NOTES'])
                            <div class="modal fade" id="row_notes_{{$item['BENEFICIARY_ID']}}" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body wizard" id="wizardBasic">
                                            <p>{{$item['NOTES']}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                    <td  class="text-center">
                        <a href="{{route('portal.v2.beneficiaries.edit', $item['BENEFICIARY_ID'])}}" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_row" data-id="{{$item['BENEFICIARY_ID']}}" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane fade" id="second" role="tabpanel">
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th scope="col" style="word-wrap: break-word;">الحساب</th>
                <th scope="col"  class="text-center">ملاحظات</th>
                <th scope="col" class="text-center">أدوات</th>
            </tr>
            </thead>
            <tbody>
            @if(count($beneficiaries['BetweenAccounts']) > 0)
                @foreach($beneficiaries['BetweenAccounts'] as $item)
                    <tr>
                        <td scope="row">
                            <div class="d-flex justify-content-start align-items-center">
                                <i class="fa-solid fa-user text-secondary mx-3"></i>
                                <div class="mx-3">
                                    <div><strong>{{$item['BANK_NAME']}}</strong></div>
                                    <strong>{{$item['BENEFICIARY_FULL_NAME']}}</strong>
                                    <div>{{$item['IBAN']??$item['BANK_ACCOUNT_NUMBER']}}</div>
                                    <div class="text-dark">{{$item['BENEFICIARY_LEDGER_NAME']}} - {{$item['BENEFICIARY_CURR_NAME']}}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <a role="button" class="{{$item['NOTES']?'text-secondary':'text-muted'}}" @if($item['NOTES'])data-bs-toggle="modal" data-bs-target="#row_notes_{{$item['BENEFICIARY_ID']}}"@endif><i class="fa-solid fa-circle-info"></i></a>
                            @if($item['NOTES'])
                                <div class="modal fade" id="row_notes_{{$item['BENEFICIARY_ID']}}" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body wizard" id="wizardBasic">
                                                <p>{{$item['NOTES']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td  class="text-center">
                            <a href="{{route('portal.v2.beneficiaries.edit', $item['BENEFICIARY_ID'])}}" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_row" data-id="{{$item['BENEFICIARY_ID']}}" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane fade" id="third" role="tabpanel">
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th scope="col" style="word-wrap: break-word;">الحساب</th>
                <th scope="col"  class="text-center">ملاحظات</th>
                <th scope="col" class="text-center">أدوات</th>
            </tr>
            </thead>
            <tbody>
            @if(count($beneficiaries['InsidePalestine']) > 0)
                @foreach($beneficiaries['InsidePalestine'] as $item)
                    <tr>
                        <td scope="row">
                            <div class="d-flex justify-content-start align-items-center">
                                <i class="fa-solid fa-user text-secondary mx-3"></i>
                                <div class="mx-3">
                                    <div><strong>{{$item['BANK_NAME']}} - {{$item['BANK_BRANCH_NAME']}}</strong></div>
                                    <strong>{{$item['BENEFICIARY_FULL_NAME']}}</strong>
                                    <div>{{$item['IBAN']}}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <a role="button" class="{{$item['NOTES']?'text-secondary':'text-muted'}}" @if($item['NOTES'])data-bs-toggle="modal" data-bs-target="#row_notes_{{$item['BENEFICIARY_ID']}}"@endif><i class="fa-solid fa-circle-info"></i></a>
                            @if($item['NOTES'])
                                <div class="modal fade" id="row_notes_{{$item['BENEFICIARY_ID']}}" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body wizard" id="wizardBasic">
                                                <p>{{$item['NOTES']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td  class="text-center">
                            <a href="{{route('portal.v2.beneficiaries.edit', $item['BENEFICIARY_ID'])}}" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_row" data-id="{{$item['BENEFICIARY_ID']}}" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane fade" id="fourth" role="tabpanel">
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th scope="col" style="word-wrap: break-word;">الحساب</th>
                <th scope="col"  class="text-center">ملاحظات</th>
                <th scope="col" class="text-center">أدوات</th>
            </tr>
            </thead>
            <tbody>
            @if(count($beneficiaries['OutsidePalestine']) > 0)
                @foreach($beneficiaries['OutsidePalestine'] as $item)
                    <tr>
                        <td scope="row">
                            <div class="d-flex justify-content-start align-items-center">
                                <i class="fa-solid fa-user text-secondary mx-3"></i>
                                <div class="mx-3">
                                    <div><strong>{{$item['BANK_NAME']}} - {{$item['BANK_BRANCH_NAME']}}</strong></div>
                                    <strong>{{$item['BENEFICIARY_FULL_NAME']}}</strong>
                                    <div>{{$item['IBAN']}}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <a role="button" class="{{$item['NOTES']?'text-secondary':'text-muted'}}" @if($item['NOTES'])data-bs-toggle="modal" data-bs-target="#row_notes_{{$item['BENEFICIARY_ID']}}"@endif><i class="fa-solid fa-circle-info"></i></a>
                            @if($item['NOTES'])
                                <div class="modal fade" id="row_notes_{{$item['BENEFICIARY_ID']}}" data-bs-keyboard="false" role="dialog" aria-labelledby="row_notesLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="row_notesLabel">ملاحظات</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body wizard" id="wizardBasic">
                                                <p>{{$item['NOTES']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td  class="text-center">
                            <a href="{{route('portal.v2.beneficiaries.edit', $item['BENEFICIARY_ID'])}}" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark align-top mx-2">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger align-top delete_row" data-id="{{$item['BENEFICIARY_ID']}}" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center"><span class="text-secondary"><i class="fa-solid fa-circle-info"></i></span> لا يوجد بيانات حتى الآن</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
