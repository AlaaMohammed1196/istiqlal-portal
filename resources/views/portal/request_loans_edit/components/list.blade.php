
    <div class="card-body px-5 py-4">
        <div class="mb-n2">
            <ul class="nav nav-pills menu-add-loan flex-column">
                <li class="my-1 nav-item">
                    <a class="nav-link body-link d-flex align-items-center position-relative {{isset($is_active) && $is_active ?'active':''}}" disabled="" id="pills-datainfo-tab" data-bs-toggle="pill" data-bs-target="#pills-datainfo" type="button" role="tab" aria-controls="pills-datainfo" aria-selected="true">
                        @if($data['CheckCompleteFundApplication'][0])
                            <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                        @else
                            <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                        @endif
                        <i class="fa-solid fa-circle-info ms-2 sw-2"></i>
                        <span class="align-middle flex-grow-1">البيانات العامة</span>
                    </a>
                </li>
                <li class="my-1 nav-item">
                    <a class="nav-link body-link d-flex align-items-center position-relative" id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false">
                        @if($data['CheckCompleteFundApplication'][1])
                            <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                        @else
                            <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                        @endif
                        <i class="fa-regular fa-money-bill-1 ms-2 sw-2"></i>
                        <span class="align-middle flex-grow-1">مصادر السداد</span>
                    </a>
                </li>
                <li class="my-1 nav-item">
                    <a class="nav-link body-link d-flex align-items-center position-relative" id="pills-warranties-tab" data-bs-toggle="pill" data-bs-target="#pills-warranties" type="button" role="tab" aria-controls="pills-warranties" aria-selected="false">
                        @if($data['CheckCompleteFundApplication'][2])
                            <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                        @else
                            <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                        @endif
                        <i class="fa-solid fa-layer-group ms-2 sw-2"></i>
                        <span class="align-middle flex-grow-1">الضمانات و الكفالات</span>
                    </a>
                </li>
                <li class="my-1 nav-item">
                    <a class="nav-link body-link d-flex align-items-center position-relative" id="pills-balance-tab" data-bs-toggle="pill" data-bs-target="#pills-balance" type="button" role="tab" aria-controls="pills-balance" aria-selected="false">
                        @if($data['CheckCompleteFundApplication'][3] && $data['CheckCompleteFundApplication'][4])
                            <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                        @else
                            <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                        @endif
                        <i class="fa-solid fa-circle-info ms-2 sw-2"></i>
                        <span class="align-middle flex-grow-1">الميزانية العمومية</span>
                    </a>
                </li>
                <li class="my-1 nav-item">
                    <a class="nav-link body-link d-flex align-items-center position-relative" id="pills-income-tab" data-bs-toggle="pill" data-bs-target="#pills-income" type="button" role="tab" aria-controls="pills-income" aria-selected="false">
                        @if($data['CheckCompleteFundApplication'][5])
                            <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                        @else
                            <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                        @endif
                        <i class="fa-solid fa-circle-info ms-2 sw-2"></i>
                        <span class="align-middle flex-grow-1">قائمة الدخل</span>
                    </a>
                </li>
                <li class="my-1 nav-item">
                    <a class="nav-link body-link d-flex align-items-center position-relative" id="pills-attachments-tab" data-bs-toggle="pill" data-bs-target="#pills-attachments" type="button" role="tab" aria-controls="pills-attachments" aria-selected="false">
                        @if($data['CheckCompleteFundApplication'][6])
                            <i class="fa-solid fa-check position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات مكتملة"></i>
                        @else
                            <i class="fa-solid fa-circle text-danger position-absolute data-is-complete-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="البيانات غير مكتملة"></i>
                        @endif
                        <i class="fa-solid fa-paperclip  ms-2 sw-2"></i>
                        <span class="align-middle flex-grow-1">المرفقات</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

