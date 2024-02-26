@if(count($data) > 0)
    @foreach($data as $index=>$item)
        <div class="tab-pane fade {{$index==0?'show active':''}} h-100-card" id="content-{{$item['FUND_ID']}}" role="tabpanel" aria-labelledby="tab-{{$item['FUND_ID']}}">
            <ul class="nav nav-pills responsive-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item ms-3" role="presentation">
                    <button class="nav-link active" id="request-data-1" data-bs-toggle="tab" data-bs-target="#request-data-1-pane" type="button" role="tab" aria-controls="request-data-1-pane" aria-selected="true"><i class="fa-solid fa-circle-info ms-2"></i> بيانات الطلب</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex align-items-center" id="request-comments-1" data-bs-toggle="tab" data-bs-target="#request-comments-1-pane" type="button" role="tab" aria-controls="request-comments-1-pane" aria-selected="false">
                        <i class="fa-solid fa-comments ms-2"></i> التعليقات والمرفقات
                        <span class="me-2 comments-number d-inline-block"><div class="badge bg-secondary" id="contactUnread">1</div></span>
                    </button>
                </li>
            </ul>
            <div class="tab-content h-100-card" id="myTabContent">
                <div class="tab-pane fade show active h-100" id="request-data-1-pane" role="tabpanel" aria-labelledby="request-data-1"  tabindex="0">
                    <div class="card h-100 ">
                        <div class="row card-body scroll-out h-100 ">
                            <div class="col-auto d-none d-sm-block">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#data-info">البيانات العامة <i data-acorn-icon="chevron-left"></i></a></li>
                                    <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#payments-info">مصادر السداد <i data-acorn-icon="chevron-left"></i></a></li>
                                    <li class="nav-item">
                                        <a class="nav-link  d-flex justify-content-between" href="#warranties-info">الضمانات <i data-acorn-icon="chevron-left"></i></a>
                                    </li>
                                    <li class="nav-item border-bottom ">
                                        <a class="nav-link d-flex justify-content-between fw-bold" href="javascript:void(0);">المعلومات المالية</a>
                                        <ul class="nav flex-column">
                                            <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#assets-info">الموجودات <i data-acorn-icon="chevron-left"></i></a></li>
                                            <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#liabilities-info">المطلوبات <i data-acorn-icon="chevron-left"></i></a></li>
                                            <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#property-info">حقوق الملكية <i data-acorn-icon="chevron-left"></i></a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#income-info">قائمة الدخل <i data-acorn-icon="chevron-left"></i></a></li>
                                    <li class="nav-item"><a class="nav-link  d-flex justify-content-between" href="#attachments-info">المرفقات <i data-acorn-icon="chevron-left"></i></a></li>
                                </ul>
                            </div>
                            <div class="col h-100">

                                <!-- Messages Start -->
                                <div class="scroll-track-visible h-100 mb-n2">
                                    <div class=" px-3">

                                        <!-- Details Start -->
                                        <div class="row py-2 border-bottom" id="data-info">
                                            <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-circle-info ms-2"></i> البيانات العامة</h2>
                                        </div>
                                        <div class="row g-0  py-2">
                                            <div class="col-12 col-md">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">البرنامج</div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">برنامج الاقتصاد الأخضر</div>
                                            </div>
                                        </div>
                                        <div class="row g-0 py-2">
                                            <div class="col-12 col-md">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">القرض</div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="sh-5 sh-sm-3 sh-md-5 d-flex align-items-center fw-bold">تمويل ريادة - مزرعة الأمل</div>
                                            </div>
                                        </div>
                                        <div class="row g-0 border-bottom py-2">
                                            <div class="col-12 col-md">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">الهدف من القرض</div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">هدف القرض تمكين المرأة</div>
                                            </div>
                                        </div>

                                        <div class="row g-0 border-bottom py-2">
                                            <div class="col-12 col-md">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">قيمة المبلغ المطلوب</div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold text-secondary">10000$</div>
                                            </div>
                                        </div>
                                        <div class="row g-0 border-bottom py-2">
                                            <div class="col-12 col-md">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">قيمة القرض</div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">10000$</div>
                                            </div>
                                        </div>

                                        <div class="row g-0 border-bottom py-2">
                                            <div class="col-12 col-md">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">قيمة مساهمة العميل</div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">5</div>
                                            </div>
                                        </div>
                                        <div class="row g-0 py-2">
                                            <div class="col-12 col-md">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">مدة القرض بالأشهر</div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">24</div>
                                            </div>
                                        </div>
                                        <div class="row g-0  border-bottom py-2">
                                            <div class="col-12 col-md">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">فترة السماح ضمن فترة القرض / الأيام</div>
                                            </div>
                                            <div class="col-12 col-md-auto">
                                                <div class="sh-3 sh-md-5 d-flex align-items-center fw-bold">12</div>
                                            </div>
                                        </div>
                                        <div class="row g-0 py-2">
                                            <div class="col-12">
                                                <div class="d-flex fw-bold align-items-center fw-normal my-3">ما الذي سيضيفه القرض من تطوير لأعمال الشركة</div>
                                            </div>
                                            <div class="col-12">
                                                <p class="lh-lg">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال "lorem ipsum" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.

                                                </p>
                                            </div>
                                        </div>

                                        <div class="row py-2 border-bottom" id="payments-info">
                                            <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-money-bill-1 ms-2"></i> مصادر السداد</h2>
                                        </div>

                                        <div class="row g-0 py-2">
                                            <div class="col-12">
                                                <div class="fw-bold my-3 d-flex align-items-center fw-normal lh-1-25">مصادر التمويل لمساهمة العميل</div>
                                            </div>
                                            <div class="col-12">

                                                <div class="bg-light pt-3 pb-1 rounded">
                                                    <div class="mb-4">
                                                        <div class="table-responsive">

                                                            <table class="table align-middle">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">المصدر</th>
                                                                    <th scope="col"  class="text-center">القيمة السنوية</th>
                                                                    <th scope="col"  class="text-center">العملة	</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">ذاتي</th>
                                                                    <td class="text-center"><span class="text-secondary">2000</span></td>
                                                                    <td class="text-center">دولار</td>
                                                                </tr>

                                                                <tr>
                                                                    <th scope="row" class="table-secondary">المجموع (مقيم بقيمة الدولار)</th>
                                                                    <td class="text-center table-secondary"><span class="text-secondary fw-bold">2000</span></td>
                                                                    <td class="text-center table-secondary fw-bold">دولار</td>
                                                                </tr>

                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-0 py-2">
                                            <div class="col-12">

                                                <div class="fw-bold my-3 d-flex align-items-center fw-normal lh-1-25">وصف مصادر السداد <span class="text-secondary fw-normal me-2">(حسب الاهمية)</span></div>
                                            </div>
                                            <div class="col-12">

                                                <div class="bg-light pt-3 pb-1 rounded">
                                                    <div class="mb-4">
                                                        <div class="table-responsive">

                                                            <table class="table align-middle">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">مصدر السداد</th>
                                                                    <th scope="col"  class="text-center">القيمة السنوية</th>
                                                                    <th scope="col"  class="text-center">العملة	</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">راتب</th>
                                                                    <td class="text-center"><span class="text-secondary">2000</span></td>
                                                                    <td class="text-center">دولار</td>
                                                                </tr>

                                                                <tr>
                                                                    <th scope="row" class="table-secondary">المجموع (مقيم بقيمة الدولار)</th>
                                                                    <td class="text-center table-secondary"><span class="text-secondary fw-bold">2000</span></td>
                                                                    <td class="text-center table-secondary fw-bold">دولار</td>
                                                                </tr>

                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pt-5 pb-2 border-bottom" id="warranties-info">
                                            <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-layer-group ms-2"></i> الضمانات</h2>
                                        </div>

                                        <div class="row g-0 py-2">
                                            <div class="col-12">
                                                <div class="fw-bold my-3 d-flex align-items-center fw-normal lh-1-25">الضمانات التي يمكنك تقديمها</div>
                                            </div>
                                            <div class="col-12">

                                                <div class="bg-light pt-3 pb-1 rounded">
                                                    <div class="mb-4">
                                                        <div class="table-responsive">

                                                            <table class="table align-middle">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">الضمانة</th>
                                                                    <th scope="col"  class="text-center">القيمة التقديرية</th>
                                                                    <th scope="col"  class="text-center">العملة	</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">الكفالات الشخصية والاعتبارية</th>
                                                                    <td class="text-center"><span class="text-secondary">2000</span></td>
                                                                    <td class="text-center">دولار</td>
                                                                </tr>

                                                                <tr>
                                                                    <th scope="row" class="table-secondary">المجموع (مقيم بقيمة الدولار)</th>
                                                                    <td class="text-center table-secondary"><span class="text-secondary fw-bold">2000</span></td>
                                                                    <td class="text-center table-secondary fw-bold">دولار</td>
                                                                </tr>

                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pt-5 pb-2 border-bottom" id="assets-info">
                                            <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-coins ms-2"></i> المعلومات المالية | الموجودات</h2>
                                        </div>
                                        <div class="g-0 d-flex flex-column flex-sm-row justify-content-between align-items-center  border-bottom  py-2">
                                            <div class="sh-3 sh-md-5 d-flex align-items-center fw-normal lh-1-25">الجهة المدققة <span class="sh-3 sh-md-5  d-flex align-items-center mx-2 fw-bold">مؤسسة هديل</span></div>

                                            <div class="sh-3 sh-md-5  d-flex align-items-center fw-normal lh-1-25">العملة <span class="sh-3 sh-md-5 mx-2  d-flex align-items-center fw-bold">دولار</span></div>

                                            <div class="sh-3 sh-md-5  d-flex align-items-center fw-normal lh-1-25">تاريخ إعدادها <span class="sh-3 sh-md-5 mx-2  d-flex align-items-center fw-bold">28/11/2022</span></div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between mt-5 mb-3">
                                            <div class="fw-bold h5 text-secondary">الموجودات المتداولة</div>
                                        </div>

                                        <div class="table-responsive">

                                            <table class="table align-middle">
                                                <thead>
                                                <tr>
                                                    <th scope="col"  width="40%">الموجودات</th>
                                                    <th scope="col"  class="text-center">سنة 2021</th>
                                                    <th scope="col"  class="text-center">سنة 2022</th>
                                                    <th scope="col"  class="text-center">التغيير</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">النقد المتوفر في البنوك</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">الذمم المدينة</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">المخزون</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">اخرى</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr  class="table-light">
                                                    <th scope="row" class="table-light">المجموع</th>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="col-12 d-flex justify-content-between mb-3 mt-5">
                                            <div class="fw-bold h5 text-secondary">الموجودات الثابتة</div>
                                        </div>

                                        <div class="table-responsive">

                                            <table class="table align-middle">
                                                <thead>
                                                <tr>
                                                    <th scope="col" width="40%">الموجودات</th>
                                                    <th scope="col"  class="text-center">سنة 2021</th>
                                                    <th scope="col"  class="text-center">سنة 2022</th>
                                                    <th scope="col"  class="text-center">التغيير</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">مباني واراضي</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">سيارات</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">اثاث و معدات</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">استهلاك الأصول الثابتة</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">اخرى</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr  class="table-light">
                                                    <th scope="row" class="table-light">المجموع</th>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="row pt-5 pb-2 border-bottom" id="liabilities-info">
                                            <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-coins ms-2"></i> المعلومات المالية | المطلوبات</h2>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between mt-5 mb-3">
                                            <div class="fw-bold h5 text-secondary">المطلوبات المتداولة</div>
                                        </div>

                                        <div class="table-responsive">

                                            <table class="table align-middle">
                                                <thead>
                                                <tr>
                                                    <th scope="col"  width="40%">المطلوبات</th>
                                                    <th scope="col"  class="text-center">سنة 2021</th>
                                                    <th scope="col"  class="text-center">سنة 2022</th>
                                                    <th scope="col"  class="text-center">التغيير</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">ذمم دائنة</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">قروض قصيرة الآجل</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>

                                                <tr  class="table-light">
                                                    <th scope="row" class="table-light">المجموع</th>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="col-12 d-flex justify-content-between mb-3 mt-5">
                                            <div class="fw-bold h5 text-secondary">المطلوبات الغير متداولة</div>
                                        </div>

                                        <div class="table-responsive">

                                            <table class="table align-middle">
                                                <thead>
                                                <tr>
                                                    <th scope="col" width="40%">المطلوبات</th>
                                                    <th scope="col"  class="text-center">سنة 2021</th>
                                                    <th scope="col"  class="text-center">سنة 2022</th>
                                                    <th scope="col"  class="text-center">التغيير</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">قروض طويلة الاجل</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">سيارات</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">اثاث و معدات</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">استهلاك الأصول الثابتة</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">اخرى</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr  class="table-light">
                                                    <th scope="row" class="table-light">المجموع</th>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                        <div class=" d-flex bg-primary rounded py-3 px-5 justify-content-between mb-3 mt-3">
                                            <div class="text-white">مجموع المطلوبات</div>
                                            <div class="text-white">0</div>
                                        </div>

                                        <div class="row pt-5 pb-2 border-bottom" id="property-info">
                                            <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-coins ms-2"></i> المعلومات المالية | حقوق الملكية</h2>
                                        </div>
                                        <div class="table-responsive">

                                            <table class="table align-middle">
                                                <thead>
                                                <tr>
                                                    <th scope="col"  width="40%">البند</th>
                                                    <th scope="col"  class="text-center">سنة 2021</th>
                                                    <th scope="col"  class="text-center">سنة 2022</th>
                                                    <th scope="col"  class="text-center">التغيير</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">رأس المال المدفوع</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">الأرباح المدورة</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">أرباح السنة الحالية</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">الاحتياطات</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">السحوبات الشخصية (لشركاء)</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>

                                                <tr  class="table-light">
                                                    <th scope="row" class="table-light">صافي حقوق الملكية</th>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>

                                        <div class=" d-flex bg-primary rounded py-3 px-5 justify-content-between mb-3 mt-3">
                                            <div class="text-white">مجموع الخصوم (المطلوبات + حقوق الملكية)</div>
                                            <div class="text-white">0</div>
                                        </div>

                                        <div class="row pt-5 pb-2 border-bottom" id="income-info">
                                            <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-wallet ms-2"></i> قائمة الدخل</h2>
                                        </div>

                                        <div class="table-responsive">

                                            <table class="table align-middle">
                                                <thead>
                                                <tr>
                                                    <th scope="col"  width="40%">البند</th>
                                                    <th scope="col"  class="text-center">سنة 2021</th>
                                                    <th scope="col"  class="text-center">سنة 2022</th>
                                                    <th scope="col"  class="text-center">التغيير</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">صافي المبيعات او الايرادات</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">تكلفة المبيعات</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row" class="table-light">الربح الإجمالي</th>
                                                    <td class="text-center table-light">0</td>
                                                    <td class="text-center table-light">0</td>
                                                    <td class="text-center table-light">0</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">مصاريف إدارية وتشغيلية</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">مصاريف البيع والتسويق</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">الايجار</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">الاستهلاكات</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">اثاث ومعدات</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">فوائد وعمولات</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">مصاريف اخرى</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>

                                                <tr  class="table-light">
                                                    <th scope="row" class="table-light">مجموع المصاريف</th>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                </tr>
                                                <tr  class="table-light">
                                                    <th scope="row" class="table-secondary">صافي الربح (الخسارة) التشغيلي قبل الضرائب</th>
                                                    <td class="text-center table-secondary"><span class="">0</span></td>
                                                    <td class="text-center table-secondary"><span class="">0</span></td>
                                                    <td class="text-center table-secondary"><span class="">0</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">إيرادات أخرى (غير تشغيلية)</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">صافي الربح (الخسارة) قبل الضرائب</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">ضريبة الدخل</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">احتياطي مقتطع</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">أرباح موزعة للمالكين</th>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>

                                                </tr>

                                                <tr  class="table-light">
                                                    <th scope="row" class="table-light">صافي الربح (الخسارة) بعد الضريبة</th>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                    <td class="text-center table-light"><span class="">0</span></td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="row pt-5 pb-2 border-bottom" id="attachments-info">
                                            <h2 class="h4 fw-bold text-secondary"><i class="fa-solid fa-paperclip ms-2"></i> المرفقات</h2>
                                        </div>

                                        <div class=" d-flex border border-separator-light align-items-center rounded py-3 px-5 justify-content-between mb-3 mt-3">
                                            <a class="cursor" data-bs-toggle="modal" data-bs-target="#iframeModal" data-caption=" شهادة تسجيل الشركة"><i class="fa-solid fa-paperclip text-secondary iframe" ></i> شهادة تسجيل الشركة</a>
                                        </div>


                                        <div class=" d-flex border border-separator-light align-items-center rounded py-3 px-5 justify-content-between mb-3 mt-3">
                                            <a href="img/programs/program.webp" class="lightbox" data-caption=" صورة الهوية"><i class="fa-solid fa-paperclip text-secondary"></i> صورة الهوية</a>

                                        </div>


                                        <!-- Details End -->
                                    </div>
                                </div>
                                <!-- Messages End -->
                            </div>

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade h-100 " id="request-comments-1-pane" role="tabpanel" aria-labelledby="request-comments-1" tabindex="0">
                    <div class="card loan-chat-box mb-2">
                        <div class="card-body d-flex flex-column h-100 w-100 position-relative">

                            <!-- User Start -->
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
                                                <div class="program">برنامج الاقتصاد الأخضر</div>
                                                <div class="name fw-bold">تمويل ريادة - مزرعة الأمل</div>
                                                <div class=" text-secondary fw-bold h4 mb-0 last">10000$</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-1 me-auto">

                                    <div class="mb-2">
                                        رقم الطلب: <span class="text-secondary fw-bold">54564164</span>
                                    </div>
                                    <div class="text-success">
                                        <i class="fa-regular fa-circle-check "></i> موافق عليه
                                    </div>
                                </div>

                            </div>

                            <div class="separator-light mb-3"></div>
                            <!-- User End -->

                            <!-- Messages Start -->
                            <div class="h-100 mb-n2 scroll-out">
                                <div class="h-100 scroll-track-visible px-3">

                                    <div class="mb-2 card-content">
                                        <div class="row g-2">
                                            <div class="col-auto d-flex align-items-end">
                                                <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                                                    <img src="img/profile/profile-1.webp" class="img-fluid rounded-xl chat-profile" alt="thumb">
                                                </div>
                                            </div>
                                            <div class="col d-flex align-items-end content-container">
                                                <div class="bg-separator-light d-inline-block rounded-md py-3 px-3 ps-7 position-relative text-alternate">
                                                    <span class="text">مرحبا</span>
                                                    <span class="position-absolute text-extra-small text-alternate opacity-75 b-2 s-2 time">17:20</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2 card-content">
                                        <div class="row g-2">
                                            <div class="col-auto d-flex align-items-end">
                                                <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                                                    <img src="img/profile/profile-1.webp" class="img-fluid rounded-xl chat-profile" alt="thumb">
                                                </div>
                                            </div>
                                            <div class="col d-flex align-items-end content-container">
                                                <div class="d-inline-block sh-11 ms-2 position-relative pb-4 rounded-md bg-separator-light text-alternate">
                                                    <a href="img/programs/program.webp" data-caption="صورة الهوية" class="lightbox h-100 attachment">
                                                        <img src="img/programs/program.webp" class="h-100 rounded-md-top">
                                                    </a>
                                                    <span class="position-absolute text-extra-small text-alternate opacity-75 b-2 s-2 time">17:20</span>
                                                </div>
                                                <div class="d-inline-block sh-11 ms-2 position-relative pb-4 rounded-md bg-separator-light text-alternate">
                                                    <a href="img/programs/program.webp" data-caption="تأسيس الشركة" class="lightbox h-100 attachment">
                                                        <img src="img/programs/program.webp" class="h-100 rounded-md-top">
                                                    </a>
                                                    <span class="position-absolute text-extra-small text-alternate opacity-75 b-2 s-2 time">17:20</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2 card-content">
                                        <div class="row g-2">
                                            <div class="col-auto d-flex align-items-end">
                                                <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                                                    <img src="img/profile/profile-1.webp" class="img-fluid rounded-xl chat-profile" alt="thumb">
                                                </div>
                                            </div>
                                            <div class="col d-flex align-items-end content-container">
                                                <div class="bg-separator-light d-inline-block rounded-md py-3 px-3 ps-7 position-relative text-alternate">
                                                  <span class="text lh-lg">
                                                    هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو
                                                  </span>
                                                    <span class="position-absolute text-extra-small text-alternate opacity-75 b-2 s-2 time">17:22</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2 card-content">
                                        <div class="row g-2">
                                            <div class="col-auto d-flex align-items-end order-1">
                                                <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                                                    <img src="img/profile/profile-1.webp" class="img-fluid rounded-xl" alt="thumb">
                                                </div>
                                            </div>
                                            <div class="col d-flex justify-content-end align-items-end content-container">
                                                <div class="bg-gradient-light d-inline-block rounded-md py-3 px-3 pe-7 text-white position-relative">
                                                    <span class="text">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي</span>
                                                    <span class="position-absolute text-extra-small text-white opacity-75 b-2 e-2 time">19:10</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2 card-content">
                                        <div class="row g-2">
                                            <div class="col-auto d-flex align-items-end order-1">
                                                <div class="sw-5 sh-5 mb-1 d-inline-block position-relative">
                                                    <img src="img/profile/profile-1.webp" class="img-fluid rounded-xl" alt="thumb">
                                                </div>
                                            </div>
                                            <div class="col d-flex justify-content-end align-items-end content-container">
                                                <div class="d-inline-block sh-11 me-2 position-relative pb-4 bg-primary rounded-md">
                                                    <a href="img/programs/program.webp" data-caption="الشروط اللازم توفرها" class="lightbox h-100 attachment">
                                                        <img src="img/programs/program.webp" class="h-100 rounded-md-top">
                                                    </a>
                                                    <span class="position-absolute text-extra-small text-white opacity-75 b-2 e-2 time">19:26</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Messages End -->
                        </div>


                    </div>
                    <!-- Message Input Start -->
                    <div class="card">
                        <div class="card-body p-0 d-flex flex-row align-items-center px-3 py-3">
                            <textarea class="form-control me-3 border-0 ps-2 py-2" placeholder="اكتب هنا" rows="1" id="chatInput"></textarea>
                            <div class="d-flex flex-row">
                                <input class="file-upload d-none" type="file" accept="image/*" id="attachButton">
                                <label class="btn btn-icon btn-icon-only btn-outline-secondary mb-1 rounded-xl" for="attachButton" type="button">
                                    <i data-acorn-icon="attachment"></i>
                                </label>
                                <button class="btn btn-icon btn-icon-only btn-secondary mb-1 rounded-xl me-1" id="chatSendButton" type="button">
                                    <i data-acorn-icon="chevron-left"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Message Input End -->
                    </div>
                    <!-- Chat View End -->

                </div>
            </div>
        </div>
    @endforeach
@endif
