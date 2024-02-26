<script>
    $('#FINANCE_INFO_PREPARED_ON').datepicker({
        autoclose: true,
        format: 'mm-dd-yyyy',
    });
    $('#FISCAL_YEAR').datepicker({
        format: 'yyyy',
        autoclose: true,
        startView: 2,
        minViewMode: 2,
        maxViewMode: 2,
        endDate: '{{now()->year}}',
    });
    $('#FISCAL_YEAR').on('change', function (e){
        let date = new Date($(this).val());
        let year = date.getFullYear();
        $('.col-year').html(year);
        $('.col-sub').html(year - 1);
    });

    $(document).on('change', '.balance_table .input-number', function (e){
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

    $(document).on('change', '.balance_table input[name="LAST_YEAR_VALUE"], .balance_table input[name="THIS_YEAR_VALUE"]', function (){
        let current_assets_sub = 0;
        let current_assets_year = 0;
        $('.current_assets').each(function(index, ele) {
            let elem = $(ele);
            current_assets_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
            current_assets_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
        });
        $('.current_assets_total .sub').val(formatNumber(current_assets_sub));
        $('.current_assets_total .year').val(formatNumber(current_assets_year));
        $('.current_assets_total .diff').val(formatNumber(calcChange(current_assets_sub, current_assets_year)));
        ///////////////
        let fixed_assets_sub = 0;
        let fixed_assets_year = 0;
        $('.fixed_assets').each(function(index, ele) {
            let elem = $(ele);
            fixed_assets_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
            fixed_assets_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
        });
        $('.fixed_assets_total .sub').val(formatNumber(fixed_assets_sub));
        $('.fixed_assets_total .year').val(formatNumber(fixed_assets_year));
        $('.fixed_assets_total .diff').val(formatNumber(calcChange(fixed_assets_sub, fixed_assets_year)));
        ///////////////
        let extra_assets_sub = 0;
        let extra_assets_year = 0;
        let total_fixed_assets_total_sub = fixed_assets_sub;
        let total_fixed_assets_total_year = fixed_assets_year;
        $('.extra_assets').each(function(index, ele) {
            let elem = $(ele);
            extra_assets_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
            extra_assets_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
            if(index==0){
                total_fixed_assets_total_sub -= parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
                total_fixed_assets_total_year -= parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
            }else{
                total_fixed_assets_total_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
                total_fixed_assets_total_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
            }
        });
        // let total_fixed_assets_total_sub = fixed_assets_sub - extra_assets_sub;
        // let total_fixed_assets_total_year = fixed_assets_year - extra_assets_year;
        $('.total_fixed_assets_total .sub').val(formatNumber(total_fixed_assets_total_sub));
        $('.total_fixed_assets_total .year').val(formatNumber(total_fixed_assets_total_year));
        $('.total_fixed_assets_total .diff').val(formatNumber(calcChange(total_fixed_assets_total_sub, total_fixed_assets_total_year)));

        $('.assets_total .sub').val(formatNumber(current_assets_sub + total_fixed_assets_total_sub));
        $('.assets_total .year').val(formatNumber(current_assets_year + total_fixed_assets_total_year));
        $('.assets_total .diff').val(formatNumber(calcChange(current_assets_sub + total_fixed_assets_total_sub, current_assets_year + total_fixed_assets_total_year)));
        ///////////////
        let current_liabilities_sub = 0;
        let current_liabilities_year = 0;
        $('.current_liabilities').each(function(index, ele) {
            let elem = $(ele);
            current_liabilities_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
            current_liabilities_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
        });
        $('.current_liabilities_total .sub').val(formatNumber(current_liabilities_sub));
        $('.current_liabilities_total .year').val(formatNumber(current_liabilities_year));
        $('.current_liabilities_total .diff').val(formatNumber(calcChange(current_liabilities_sub, current_liabilities_year)));
        ///////////////
        let fixed_liabilities_total_sub = 0;
        let fixed_liabilities_total_year = 0;
        $('.fixed_liabilities').each(function(index, ele) {
            let elem = $(ele);
            fixed_liabilities_total_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
            fixed_liabilities_total_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
        });
        $('.fixed_liabilities_total .sub').val(formatNumber(fixed_liabilities_total_sub));
        $('.fixed_liabilities_total .year').val(formatNumber(fixed_liabilities_total_year));
        $('.fixed_liabilities_total .diff').val(formatNumber(calcChange(fixed_liabilities_total_sub, fixed_liabilities_total_year)));

        $('.liabilities_total .sub').val(formatNumber(current_liabilities_sub + fixed_liabilities_total_sub));
        $('.liabilities_total .year').val(formatNumber(current_liabilities_year + fixed_liabilities_total_year));
        $('.liabilities_total .diff').val(formatNumber(calcChange(current_liabilities_sub + fixed_liabilities_total_sub, current_liabilities_year + fixed_liabilities_total_year)));
        ///////////////
        let all_property_sub = 0;
        let all_property_year = 0;
        $('.all_property').each(function(index, ele) {
            let elem = $(ele);
            all_property_sub += parseInt($.isNumeric(elem.find('input[name="LAST_YEAR_VALUE"]').val())?elem.find('input[name="LAST_YEAR_VALUE"]').val():0);
            all_property_year += parseInt($.isNumeric(elem.find('input[name="THIS_YEAR_VALUE"]').val())?elem.find('input[name="THIS_YEAR_VALUE"]').val():0);
        });
        $('.property_total .sub').val(formatNumber(all_property_sub));
        $('.property_total .year').val(formatNumber(all_property_year));
        $('.property_total .diff').val(formatNumber(calcChange(all_property_sub, all_property_year)));

        $('.liabilities_property_total .sub').val(formatNumber(current_liabilities_sub + fixed_liabilities_total_sub + all_property_sub));
        $('.liabilities_property_total .year').val(formatNumber(current_liabilities_year + fixed_liabilities_total_year + all_property_year));
        $('.liabilities_property_total .diff').val(formatNumber(calcChange(current_liabilities_sub + fixed_liabilities_total_sub + all_property_sub, current_liabilities_year + fixed_liabilities_total_year + all_property_year)));
    });


    $(document).on('click', '#financial_btn', function (e) {
        let submit = true;
        $('.balance_table').find('input[name="LAST_YEAR_VALUE"]').each(function(index, ele) {
            let elem = $(ele);
            let text = elem.closest('tr').find('th').text();
            let LAST_YEAR_VALUE = elem.val();
            let THIS_YEAR_VALUE = elem.closest('tr').find('input[name="THIS_YEAR_VALUE"]').val();
            if(LAST_YEAR_VALUE == '' || LAST_YEAR_VALUE == null || LAST_YEAR_VALUE == '-' ||
                THIS_YEAR_VALUE == '' || THIS_YEAR_VALUE == null || THIS_YEAR_VALUE == '-'){
                submit = false;
                return false
            }
        });
        if(submit){
            $('#finance_info_form').trigger('submit');
        }else{
            SwalModal('الرجاء تعبئة كل بيانات الميزانية العمومية', 'error');
            return false;
        }
    });

    $(document).on('submit', '#finance_info_form', function (e) {
        e.preventDefault();
        let form = $(this);
        errorHide(form);
        let assets_sub = originalNumber($('.assets_total .sub').val());
        let assets_year = originalNumber($('.assets_total .year').val());
        let liabilities_property_sub = originalNumber($('.liabilities_property_total .sub').val());
        let liabilities_property_year = originalNumber($('.liabilities_property_total .year').val());
        if(!(assets_sub==liabilities_property_sub && assets_year==liabilities_property_year)){
            SwalModal('إجمالي الموجودات يجب ان يساوى إجمالي حقوق الملكية والمطلوبات', 'error');
            return false;
        }
        let info = [];
        let LAST_YEAR_VALUE = [], THIS_YEAR_VALUE = [], FINANCIAL_INFO_IDS = [];
        $('.financial_info').each(function(index, ele) {
            let elem = $(ele);
            let sub = elem.find('input[name="LAST_YEAR_VALUE"]').val();
            let year = elem.find('input[name="THIS_YEAR_VALUE"]').val();
            if(sub != '-' && year != '-'){
                LAST_YEAR_VALUE.push(elem.find('input[name="LAST_YEAR_VALUE"]').val());
                THIS_YEAR_VALUE.push(elem.find('input[name="THIS_YEAR_VALUE"]').val());
                FINANCIAL_INFO_IDS.push(elem.find('input[name="FINANCIAL_INFO_ID"]').val());
            }
        });
        info.push({
            'FINANCIAL_INFO_IDS': FINANCIAL_INFO_IDS,
            'LAST_YEAR_VALUES': LAST_YEAR_VALUE,
            'THIS_YEAR_VALUES': THIS_YEAR_VALUE,
        })
        let formData = new FormData(this);
        formData.append('info', JSON.stringify(info));
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            url: '{{route('portal.loan-request.financial-info.store')}}',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status) {
                    toastr.success(response.msg);
                    goToTab('pills-income-tab');
                } else {
                    toastr.error(response.msg);
                }

                updateList();
            },
            error: function (response) {
                let html = '';
                $.each(response.responseJSON.errors, function (index, value) {
                    showValidationError(form, index, value)
                });
                $('html, body').animate({
                    scrollTop: $("#finance_info_form").offset().top - 100
                }, 100);
            }
        });
    });
</script>
