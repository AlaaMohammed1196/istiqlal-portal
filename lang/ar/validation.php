<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => 'يجب قبول :attribute',
    'active_url'           => ':attribute لا يُمثّل رابطًا صحيحًا',
    'after'                => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'       => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha'                => 'يجب أن لا يحتوي :attribute سوى على حروف',
    'alpha_dash'           => 'يجب أن لا يحتوي :attribute على حروف، أرقام ومطّات.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array'                => 'يجب أن يكون :attribute ًمصفوفة',
//    'before'               => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before'               => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ اليوم.',
    'before_or_equal'      => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
    ],
    'boolean'              => 'يجب أن تكون قيمة :attribute إما true أو false ',
    'confirmed'            => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'date'                 => ':attribute ليس تاريخًا صحيحًا',
    'date_format'          => 'لا يتوافق :attribute مع الشكل :format.',
    'different'            => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits'               => 'يجب أن يحتوي :attribute على :digits أرقام',
    'digits_between'       => 'يجب أن يحتوي :attribute بين :min و :max أرقام ',
    'dimensions'           => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'             => 'للحقل :attribute قيمة مُكرّرة.',
    'email'                => 'يجب أن يكون :attribute عنوان صحيح البُنية',
    'exists'               => ':attribute غير موجود',
    'file'                 => 'الـ :attribute يجب أن يكون ملفا.',
    'filled'               => ':attribute إجباري',
    'image'                => 'يجب أن يكون :attribute صورةً',
    'in'                   => ':attribute لاغٍ',
    'in_array'             => ':attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صحيحًا',
    'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json'                 => 'يجب أن يكون :attribute نصآ من نوع JSON.',
    'max'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر لـ :max.',
        'file'    => 'يجب أن لا يتجاوز حجم :attribute :max كيلوبايت',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حرفا',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'                => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes'            => 'يجب أن يكون ملفًا من نوع : :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر لـ :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر',
    ],
    'not_in'               => ':attribute لاغٍ',
    'numeric'              => 'يجب على :attribute أن يكون رقمًا',
    'present'              => 'يجب تقديم :attribute',
    'regex'                => 'صيغة :attribute .غير صحيحة',
    'required'             => ':attribute مطلوب.',
    'required_if'          => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all'    => ':attribute مطلوب إذا توفّر :values.',
    'required_without'     => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
//        'string'  => 'يجب أن يحتوي :attribute على :size حرف بالضبط',
        'string'  => 'يرجى التحقق من :attribute على ان يحتوي على :size خانة تماماً',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط',
    ],
    'string'               => 'يجب أن يكون :attribute نصآ.',
    'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique'               => 'قيمة :attribute مُستخدمه من قبل',
    'uploaded'             => 'فشل في تحميل الـ :attribute',
    'url'                  => 'صيغة الرابط :attribute غير صحيحة',
    'captcha'              => 'رمز التحقق خاطئ',
    'starts_with'          => 'يجب ان  يبدأ :attribute ب 056 أو 059',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'SALARY_VALUE' => [
            'required' => 'القيمة مطلوبة',
            'min' => 'القيمة مطلوبة',
        ],
        'SALARY_DESC' => [
            'required' => 'وصف الدخل الشهري مطلوبة',
            'min' => 'وصف الدخل الشهري مطلوبة',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'USER_FULL_NAME' => 'إسم المستخدم',
        'ID_NUM' => 'رقم الهوية',
        'EMAIL' => 'البريد الإلكتروني',
        'CELULAR' => 'الهاتف الخلوي',
        'registerCheck' => 'موافقة',
        'CELULAR_COUNTRY_ID' => 'مقدمة الدولة',
        'COMPANY_NAME_NA' => 'إسم الشركة',
        'COMPANY_ID_NUM' => 'رقم مشتغل / تسجيل',
        'COMPANY_RELATION_ID' => 'العلاقة مع الشركة',
        'USER_PASS' => 'كلمة المرور',
        'USER_PASS_confirmation' => 'تأكيد كلمة المرور',
        'USER_PICTURE' => 'الصورة الشخصية',
        'NEW_USER_PASS' => 'كلمة المرور الجديدة',
        'NEW_USER_PASS_confirmation' => 'تأكيد كلمة المرور الجديدة',
        'USER_NAME' => 'رقم المشتغل/التسجيل',
        'PARTNER_FULL_NAME' => 'اسم الشريك',
//        'ID_NUM' => 'رقم التسجيل',
        'SHARES_CNT' => 'عدد الأسهم',
        'CONTRIBUTION_PERCENT' => 'نسبة المساهمة',
        'IS_BANK_BORROWER' => 'هل تم منح قروض',
        'NOTES' => 'ملاحظات أخرى',
        'COMPANY_NOTES' => 'ملاحظات حول الشركة التابعة',
        'MEMBER_FULL_NAME' => 'الاسم',
        'REPERSENTATIVE_NAME' => 'الجهة الممثلة',
        'FIRM_LEGAL_TYPE_ID' => 'الشكل القانوني',
        'ISTABLISHMENT_DATE' => 'تاريخ التسجيل *',
        'CAPITAL' => 'رأس المال المسجل',
        'ISSUE_DATE' => 'تاريخ أخر إصدار لشهادة التسجيل',
        'SECTOR_ID' => 'القطاع الاقتصادي',
        'ECONOMIC_ACTIVITY_ID' => 'نشاط الشركة',
        'ANNUAL_SALES_RATE' => 'معدل المبيعات لآخر سنة',
        'DEPENDENTS_FEMALES_CNT' => 'عدد العاملين "ذكور"',
        'DEPENDENTS_MALES_CNT' => 'عدد العاملين "إناث"',
        'CURR_COUNTRY_ID' => 'الدولة',
        'CURR_STATE_ID' => 'المحافظة',
        'CURR_CITY_ID' => 'المدينة/البلدة',
        'CONTACT_EMAIL' => 'البريد الإلكتروني',
        'CONTACT_CELULAR' => 'رقم الهاتف المتنقل',
        'IS_MORTGEGE_TO_OTHERS' => 'أحقية الرهن للغير',
        'IS_COMPANY_RIGHT_BORROW' => 'أحقية الاقتراض للشركة',
        'BORROWING_LIMIT' => 'الحد المسموح للاقتراض',
        'CURR_ID' => 'العملة',
        'IS_COMPANY_TAX_DOC' => 'تمتلك الشركة مستند خلو ضريبة',
        'IS_LOANS_GRANTED' => 'هل تم منح قروض من بنك الاستقلال للاستثمار والتنمية سابقاً',
        'IS_COMPANY_GUARANTEE_LOANS' => 'هل الشركة كفيلة لقرض قائم لبنك الاستقلال للاستثمار والتنمية',
        'CONTACT_TEL' => 'رقم الهاتف الأرضي',
        'COMPETITOR_NAME' => 'اسم المنافس',
        'MARKET_SHARE' => 'الحصة السوقية',
        'WORK_SPACE' => 'مساحة العمل',
        'REAL_STATE_OWNERSHIP' => 'ملكية العقار',
        'EXPERIENCE_YEARS_CNT' => 'عدد سنوات الخبرة',
        'ACTIVITY_EXPLANATION_NOTES' => 'شرح عن النشاط ',
        'EMPLOYEES_NOTES' => 'ملاحظات عن الموظفين',
        'OTHER_NOTES' => 'ملاحظات أخرى',
        'SELLING_METHOD_ID' => 'طريقة البيع',
        'METHOD_PERCENT' => 'نسبة البيع',
        'BIRTH_PLACE' => 'مكان الميلاد',
        'BIRTH_DATE' => 'تاريخ الميلاد',
        'DEPENDENTS_CNT' => 'عدد المعالين',
        'EDUCATION_LEVEL_ID' => 'المؤهل العلمي',
        'CURRENT_EXPERIENCE_NOTES' => 'تفاصيل الخبرة للعمل الحالي',
        'OTHER_EXPERIENCE_NOTES' => 'الخبرة في مجالات أخرى',
        'COUNTRY_ID' => 'الدولة',
        'STATE_ID' => 'المحافظة',
        'CITY_ID' => 'المدينة/البلدة',
        'CELULAR_NUMBER' => 'رقم الهاتف المتنقل',
        'MARITAL_STATUS_ID' => 'الحالة الاجتماعية',
        'NATIONALITY_ID' => 'الجنسية',
        'NATIONALITY_ID.0' => 'الجنسية',
        'PHONE_NUMBER' => 'رقم الهاتف',
        'PROGRAM_TYPE_ID' => 'البرنامج',
        'PRODUCT_TYPE_ID' => 'القرض',
        'FINANCING_PURPOSE_ID' => 'الهدف من القرض',
        'GOODS_VALUE' => 'القيمة الإجمالية',
        'GOODS_CURR_ID' => 'العملة',
        'FINANCING_VALUE' => 'قيمة القرض',
        'INSTALLMENT_CNT' => 'مدة القرض / بالأشهر',
        'GRACE_PERIOD_IN_DAYS' => 'فترة السماح ضمن فترة القرض / بالأشهر',
        'FUND_DESCRIPTION' => 'ما الذي سيضيفه القرض من تطوير لأعمال الشركة',
        'SOURCE_ID' => 'المصدر',
        'ANNUAL_SOURCE_VALUE' => 'القيمة',
        'SOURCE_CURR_ID' => 'العملة',
        'SOURCE_CUST_CONTR_DESC' => 'المصدر',
        'SOURCE_CUST_CONTR_CURR_ID' => 'العملة',
        'GUARANTEE_TYPE_ID' => 'الضمان',
        'GUARANTEE_DESC' => 'وصف الضمان',
        'GUARANTEE_VALUE' => 'القيمة',
        'GURANTEES_CURR_ID' => 'العملة',
        'FUND_COMMENT' => 'نص التعليق',
        'AUDITED_ENTITY_NAME' => 'الجهة المدققة',
        'FINANCE_INFO_CURR_ID' => 'العملة',
        'FINANCE_INFO_PREPARED_ON' => 'تاريخ الإعداد',
        'FISCAL_YEAR' => 'السنة المالية',
        'FUND_ATTACHS' => 'المرفق',
        'JOB_ID' => 'المسمى الوظيفي',
        'CURR_ADDRESS' => 'العنوان',
        'CONTACT_CELULARS' => 'رقم الهاتف المتنقل',
        'CONTACT_CELULARS.*.CONTACT_CELULARS' => 'رقم الهاتف المتنقل',
        'AUTHORIZATION_LETTER_COMPANY_FILE' => 'كتاب التفويض',
        'FUND_SECTOR_ID' => 'القطاع الاقتصادي',
        'ACTIVITY_PLACE' => 'مكان النشاط الممول',
        'FINANCING_PURPOSE_DESCRIPTION' => 'شرح الهدف من القرض',
        'FUND_PROJECT_ATTACHS' => 'دراسة الجدوى للمشروع',
        'ADDRESS' => 'العنوان',
        'BENEFICIARY_FULL_NAME' => 'اسم المستفيد',
        'BENEFICIARY_ADDRESS' => 'عنوان المستفيد',
        'BANK_ID' => 'اسم البنك',
        'BANK_BRANCH_ID' => 'اسم فرع البنك',
        'BANK_NAME' => 'اسم البنك',
        'BANK_BRANCH_NAME' => 'اسم فرع البنك',
        'IBAN' => 'رقم الحساب الدولي',
        'BANK_ACCOUNT_NUMBER' => 'حساب المستفيد',
        'SWIFT_CODE' => 'كود Swift',
        'BENEFICIARY_CURR_ID' => 'عملة الحساب',
        'BENEFICIARY_ACC_SUB_NUM' => 'رقم الحساب الفرعي',
        'BENEFICIARY_LEDGER_ID' => 'نوع الحساب',
        'FROM_LEDGER_ID' => 'من حساب',
        'TO_LEDGER_ID' => 'إلى حساب',
        'AMOUNT' => 'المبلغ',
        'REMITTANCE_PURPOSE_ID' => 'الغرض من الحوالة',
        'CUST_LEDGER_ID' => 'من حساب',
        'INCLUDE_COMMISSION' => 'شامل الضريبة',
        'DEPOSIT_TYPE_PERIOD_ID' => 'المدة',
        'DEPOSIT_CURR_ID' => 'العملة',
        'DEPOSIT_VALUE' => 'قيمة الوديعة',
        'COMMENT_DESCRIPTION' => 'التعليق',
        'ATTACHMENTS' => 'المرفقات',
        'ATTACHMENTS.*' => 'المرفقات',
        'COMMENT_ATTACHMENTS' => 'المرفقات',
        'COMMENT_ATTACHMENTS.*' => 'المرفقات',
        'TICKET_TITLE' => 'عنوان التذكرة',
        'TICKET_DESCRIPTION' => 'وصف التذكرة',
        'TICKET_TYPE_ID' => 'نوع التذكرة',
        'TICKET_PRIORITY_ID' => 'درجة أهمية التذكرة',
        'TICKET_ATTACHMENTS' => 'المرفقات',
        'TICKET_ATTACHMENTS.*' => 'المرفقات',
        'REAL_STATE_OWNERSHIP_NOTES' => 'شرح ملكية العقار',
        'EMPLOYEES_MALE_CNT' => 'عدد العاملين "ذكور"',
        'EMPLOYEES_FEMALE_CNT' => 'عدد العاملين "إناث"',
        'VERIFY_CODE' => 'رمز التحقق',
        'SALARY_TYPE_ID' => 'وصف الكفالة',
        'SALARY_DESC' => 'وصف الدخل الشهري',
        'SALARY_VALUE' => 'القيمة',
        'SALARY_DESC.1' => 'وصف الدخل الشهري',
        'SALARY_VALUE.1' => 'القيمة',
        'SALARY_CURR_ID' => 'العملة',
        'SALARY_CURR_ID.1' => 'العملة',
        'DOC_CLASS_IDS' => 'نوع الملف',
        'AMOUNT.*' => 'المبلغ',
        'FEED_ACC_LEDGER_ID' => 'رقم الحساب',
        'ACTIVITY_ID' => 'النشاط الاقتصادي',
        'PROJECT_STATUS_ID' => 'حالة المشروع',
        'DEPOSIT_LOSS_VALUE' => 'المبلغ',
    ],
];
