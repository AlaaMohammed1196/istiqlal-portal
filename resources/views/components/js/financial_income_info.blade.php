<script>
    $(document).on('change', '.income_table .input-number', function (e){
        let ele = $(this).siblings('.number-format-input');
        let value = $(this).val();
        if($.isNumeric(originalNumber(value))){
            ele.val(originalNumber(value));
        }else{
            $(this).val(0);
            ele.val(0);
        }
        ele.trigger('change');
    });

    $(document).on('change', '.income_table input[name="LAST_YEAR_VALUE"], .income_table input[name="THIS_YEAR_VALUE"]', function () {
        let sales_sub = 0;
        let sales_year = 0;
        $('.sales').each(function (index, ele) {
            let elem = $(ele);
            sales_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
            sales_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
        });
        $('.sales_total .sub').val(formatNumber(sales_sub));
        $('.sales_total .year').val(formatNumber(sales_year));
        $('.sales_total .diff').val(formatNumber(calcChange(sales_sub, sales_year)));
        ////////////
        let income_sub = 0;
        let income_year = 0;
        $('.income').each(function (index, ele) {
            let elem = $(ele);
            income_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
            income_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
        });
        $('.income_total .sub').val(formatNumber(sales_sub - income_sub));
        $('.income_total .year').val(formatNumber(sales_year - income_year));
        $('.income_total .diff').val(formatNumber(calcChange(sales_sub - income_sub, sales_year - income_year)));
        ////////////
        let profit_sub = 0;
        let profit_year = 0;
        $('.profit').each(function (index, ele) {
            let elem = $(ele);
            profit_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
            profit_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
        });
        $('.expenses_total .sub').val(formatNumber(profit_sub));
        $('.expenses_total .year').val(formatNumber(profit_year));
        $('.expenses_total .diff').val(formatNumber(calcChange(profit_sub, profit_year)));

        $('.profit_total .sub').val(formatNumber((sales_sub - income_sub) - profit_sub));
        $('.profit_total .year').val(formatNumber((sales_year - income_year) - profit_year));
        $('.profit_total .diff').val(formatNumber(calcChange((sales_sub - income_sub) - profit_sub, (sales_year - income_year) - profit_year)));
        ////////////
        let profit_after_interest_total_sub = (sales_sub - income_sub) - profit_sub;
        let profit_after_interest_total_year = (sales_year - income_year) - profit_year;

        let elem29 = $('#info-29');
        profit_after_interest_total_sub -= parseInt($.isNumeric(elem29.find('input[name="LAST_YEAR_VALUE"]').val())?elem29.find('input[name="LAST_YEAR_VALUE"]').val():0);
        profit_after_interest_total_year -= parseInt($.isNumeric(elem29.find('input[name="THIS_YEAR_VALUE"]').val())?elem29.find('input[name="THIS_YEAR_VALUE"]').val():0);

        let elem30 = $('#info-30');
        profit_after_interest_total_sub += parseInt($.isNumeric(elem30.find('input[name="LAST_YEAR_VALUE"]').val())?elem30.find('input[name="LAST_YEAR_VALUE"]').val():0);
        profit_after_interest_total_year += parseInt($.isNumeric(elem30.find('input[name="THIS_YEAR_VALUE"]').val())?elem30.find('input[name="THIS_YEAR_VALUE"]').val():0);

        let elem31 = $('#info-31');
        profit_after_interest_total_sub -= parseInt($.isNumeric(elem31.find('input[name="LAST_YEAR_VALUE"]').val())?elem31.find('input[name="LAST_YEAR_VALUE"]').val():0);
        profit_after_interest_total_year -= parseInt($.isNumeric(elem31.find('input[name="THIS_YEAR_VALUE"]').val())?elem31.find('input[name="THIS_YEAR_VALUE"]').val():0);

        $('.profit_after_interest_total .sub').val(formatNumber(profit_after_interest_total_sub));
        $('.profit_after_interest_total .year').val(formatNumber(profit_after_interest_total_year));
        $('.profit_after_interest_total .diff').val(formatNumber(calcChange(profit_after_interest_total_sub, profit_after_interest_total_year)));
        ////////
        let profit_before_tax_sub = 0;
        let profit_before_tax_year = 0;
        $('.profit_before_tax').each(function (index, ele) {
            let elem = $(ele);
            profit_before_tax_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
            profit_before_tax_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
        });
        $('.profit_before_tax_total .sub').val(formatNumber(profit_after_interest_total_sub + profit_before_tax_sub));
        $('.profit_before_tax_total .year').val(formatNumber(profit_after_interest_total_year + profit_before_tax_year));
        $('.profit_before_tax_total .diff').val(formatNumber(calcChange(profit_after_interest_total_sub + profit_before_tax_sub, profit_after_interest_total_year + profit_before_tax_year)));
        ////////
        let profit_after_tax_sub = 0;
        let profit_after_tax_year = 0;
        $('.profit_after_tax').each(function (index, ele) {
            let elem = $(ele);
            profit_after_tax_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
            profit_after_tax_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
        });
        $('.profit_after_tax_total .sub').val(formatNumber((profit_after_interest_total_sub + profit_before_tax_sub) - profit_after_tax_sub));
        $('.profit_after_tax_total .year').val(formatNumber((profit_after_interest_total_year + profit_before_tax_year) - profit_after_tax_year));
        $('.profit_after_tax_total .diff').val(formatNumber(calcChange((profit_after_interest_total_sub + profit_before_tax_sub) - profit_after_tax_sub, (profit_after_interest_total_year + profit_before_tax_year) + profit_after_tax_year)));
    });

    $(document).on('click', '#income_btn', function (e) {
        e.preventDefault();
        let submit = true;
        let info = [];
        let LAST_YEAR_VALUE = [], THIS_YEAR_VALUE = [], FINANCIAL_INFO_IDS = [];
        $('.financial_income_info').each(function(index, ele) {
            let elem = $(ele);
            let sub = elem.find('input[name="LAST_YEAR_VALUE"]').val();
            let year = elem.find('input[name="THIS_YEAR_VALUE"]').val();
            if(sub != '-' && year != '-'){
                LAST_YEAR_VALUE.push(elem.find('input[name="LAST_YEAR_VALUE"]').val());
                THIS_YEAR_VALUE.push(elem.find('input[name="THIS_YEAR_VALUE"]').val());
                FINANCIAL_INFO_IDS.push(elem.find('input[name="FINANCIAL_INFO_ID"]').val());
            }else{
                submit = false;
                return false;
            }
        });
        if(submit){
            info.push({
                'FINANCIAL_INFO_IDS': FINANCIAL_INFO_IDS,
                'LAST_YEAR_VALUES': LAST_YEAR_VALUE,
                'THIS_YEAR_VALUES': THIS_YEAR_VALUE,
            })
            if(FINANCIAL_INFO_IDS.length > 0){
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: '{{route('portal.loan-request.income-financial-info.store')}}',
                    data: {
                        'FUND_ID': $('input[name="FUND_ID"]').val(),
                        'info': info,
                    },
                    success: function (response) {
                        if (response.status) {
                            toastr.success(response.msg);
                            goToTab('pills-attachments-tab');
                        } else {
                            toastr.error(response.msg);
                        }
                        updateList();
                    },
                });
            }else{
                goToTab('pills-attachments-tab');
            }
        }else{
            SwalModal('الرجاء تعبئة كل بيانات قائمة الدخل', 'error');
        }
    });
</script>
