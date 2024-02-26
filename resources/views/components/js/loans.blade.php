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
        endDate: '2022',
    });
    $('#FISCAL_YEAR').on('change', function (e){
        let date = new Date($(this).val());
        let year = date.getFullYear();
        $('.col-year').html(year);
        $('.col-sub').html(year - 1);
    });
    $(document).ready(function() {
        $('#f_info_btn').on('click', function (e) {
            let isSend = $('input[name="is_send"]').val();
            if(isSend == 0){
                $('#finance_info_form').trigger('submit');
            }else{
                $('#pills-liabilities-tab').tab('show');
            }
        });

        $('#finance_info_form').on('submit', function (e) {
            e.preventDefault();
            let form = $(this);
            loaderStart(form)
            errorHide(form);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: form.attr('action'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response.status) {
                        $('input[name="is_send"]').val(1);
                        goToTab('pills-liabilities-tab');
                    } else {
                        errorShow(form, response.msg);
                    }
                    loaderEnd(form)
                },
                error: function (response) {
                    let html = '';
                    $.each(response.responseJSON.errors, function (index, value) {
                        showValidationError(form, index, value)
                    });
                    loaderEnd(form)
                }
            })
        });
    });

    function updateIncomeTotal(e, val1, val2, subtype){
        //profit part
        let LAST_YEAR_VALUE_0 = $('.profit-0 input[name="LAST_YEAR_VALUE"]').val()!='-'?parseInt($('.profit-0 input[name="LAST_YEAR_VALUE"]').val()):0;
        let LAST_YEAR_VALUE_1 = $('.profit-1 input[name="LAST_YEAR_VALUE"]').val()!='-'?parseInt($('.profit-1 input[name="LAST_YEAR_VALUE"]').val()):0;
        let THIS_YEAR_VALUE_0 = $('.profit-0 input[name="THIS_YEAR_VALUE"]').val()!='-'?parseInt($('.profit-0 input[name="THIS_YEAR_VALUE"]').val()):0;
        let THIS_YEAR_VALUE_1 = $('.profit-1 input[name="THIS_YEAR_VALUE"]').val()!='-'?parseInt($('.profit-1 input[name="THIS_YEAR_VALUE"]').val()):0;
        $('.total-1 .sub').val(LAST_YEAR_VALUE_0 - LAST_YEAR_VALUE_1);
        $('.total-1 .year').val(THIS_YEAR_VALUE_0 - THIS_YEAR_VALUE_1);
        $('.total-1 .diff').val(parseInt($('.total-1 .year').val()) - parseInt($('.total-1 .sub').val()));

        //expenses part
        if(subtype == 2){
            let className = $(e).data('class');
            let totalEle = $('.'+className);
            let sub = parseInt(totalEle.find('.sub').val()) - LAST_YEAR_VALUE;
            let year = parseInt(totalEle.find('.year').val()) - THIS_YEAR_VALUE;
            totalEle.find('.sub').val(sub+parseInt(val1));
            totalEle.find('.year').val(year+parseInt(val2));
            totalEle.find('.diff').val(parseInt(totalEle.find('.year').val()) - parseInt(totalEle.find('.sub').val()));
        }

        let totalBeforeEle = $('.total-before-running');
        let total1 = [];
        total1['sub'] = parseInt($('.total-1 .sub').val());
        total1['year'] = parseInt($('.total-1 .year').val());
        total1['diff'] = parseInt($('.total-1 .diff').val());
        let total2 = [];
        total2['sub'] = parseInt($('.total-2 .sub').val());
        total2['year'] = parseInt($('.total-2 .year').val());
        total2['diff'] = parseInt($('.total-2 .diff').val());
        totalBeforeEle.find('.sub').val(total1['sub']-total2['sub']);
        totalBeforeEle.find('.year').val(total1['year']-total2['year']);
        totalBeforeEle.find('.diff').val(total1['diff']-total2['diff']);

        let totalBefore = $('.total-before');
        let totalBeforeRunning = [];
        totalBeforeRunning['sub'] = $('.total-before-running .sub').val()!='-'?parseInt($('.total-before-running .sub').val()):0;
        totalBeforeRunning['year'] = $('.total-before-running .year').val()!='-'?parseInt($('.total-before-running .year').val()):0;
        let otherIncome = [];
        otherIncome['sub'] = $('.other-income-0 input[name="LAST_YEAR_VALUE"]').val()!='-'?parseInt($('.other-income-0 input[name="LAST_YEAR_VALUE"]').val()):0;
        otherIncome['year'] = $('.other-income-0 input[name="THIS_YEAR_VALUE"]').val()!='-'?parseInt($('.other-income-0 input[name="THIS_YEAR_VALUE"]').val()):0;
        console.log(otherIncome, totalBeforeRunning);
        totalBefore.find('.sub').val(totalBeforeRunning['sub']+otherIncome['sub']);
        totalBefore.find('.year').val(totalBeforeRunning['year']+otherIncome['year']);
        totalBefore.find('.diff').val((totalBeforeRunning['year']+otherIncome['year']) - (totalBeforeRunning['sub']+otherIncome['sub']));

        let totalAfter = $('.total-after');
        let other_sub_0 = $('.others-0 input[name="LAST_YEAR_VALUE"]').val()!='-'?parseInt($('.others-0 input[name="LAST_YEAR_VALUE"]').val()):0;
        let other_sub_1 = $('.others-1 input[name="LAST_YEAR_VALUE"]').val()!='-'?parseInt($('.others-1 input[name="LAST_YEAR_VALUE"]').val()):0;
        let other_sub_2 = $('.others-2 input[name="LAST_YEAR_VALUE"]').val()!='-'?parseInt($('.others-2 input[name="LAST_YEAR_VALUE"]').val()):0;
        let other_year_0 = $('.others-0 input[name="THIS_YEAR_VALUE"]').val()!='-'?parseInt($('.others-0 input[name="THIS_YEAR_VALUE"]').val()):0;
        let other_year_1 = $('.others-1 input[name="THIS_YEAR_VALUE"]').val()!='-'?parseInt($('.others-1 input[name="THIS_YEAR_VALUE"]').val()):0;
        let other_year_2 = $('.others-2 input[name="THIS_YEAR_VALUE"]').val()!='-'?parseInt($('.others-2 input[name="THIS_YEAR_VALUE"]').val()):0;
        let other_total_sub = other_sub_0 + other_sub_1 + other_sub_2;
        let other_total_year = other_year_0 + other_year_1 + other_year_2;
        let other_total_diff = other_total_year - other_total_sub;
        let totalBeforeVal = [];
        totalBeforeVal['sub'] = parseInt($('.total-before .sub').val());
        totalBeforeVal['year'] = parseInt($('.total-before .year').val());
        totalBeforeVal['diff'] = parseInt($('.total-before .diff').val());
        totalAfter.find('.sub').val(totalBeforeVal['sub']-other_total_sub);
        totalAfter.find('.year').val(totalBeforeVal['year']-other_total_year);
        totalAfter.find('.diff').val(totalBeforeVal['diff']-other_total_diff);
    }
</script>
