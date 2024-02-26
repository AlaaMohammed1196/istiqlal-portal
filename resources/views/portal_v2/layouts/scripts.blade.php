<script>
    $(document).on('change', '#deposit_calculate_form #DEPOSIT_TYPE_PERIOD_ID, #deposit_calculate_form #DEPOSIT_CURR_ID', function (e) {
        e.preventDefault();
        let form = $('#deposit_calculate_form');
        let DEPOSIT_TYPE_PERIOD_ID = form.find('#DEPOSIT_TYPE_PERIOD_ID').val();
        let DEPOSIT_CURR_ID = form.find('#DEPOSIT_CURR_ID').val();
        if(DEPOSIT_TYPE_PERIOD_ID != null && DEPOSIT_TYPE_PERIOD_ID != '' && DEPOSIT_CURR_ID != null && DEPOSIT_CURR_ID != ''){
            form.find('#DEPOSIT_VALUE').val('');
            form.find('#DEPOSIT_VALUE').attr('disabled', 'disabled');
            form.find('#DEPOSIT_VALUE').siblings('.input-number').val('');
            form.find('#DEPOSIT_VALUE').siblings('.input-number').attr('disabled', 'disabled');
            $('.calculated-value #depositRange').parent('p').addClass('d-none');
            errorHide(form);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{route('portal.v2.deposit.calculate')}}',
                data: {
                    'DEPOSIT_TYPE_PERIOD_ID': DEPOSIT_TYPE_PERIOD_ID,
                    'DEPOSIT_CURR_ID': DEPOSIT_CURR_ID,
                },
                success: function (response) {
                    if (response.status) {
                        if(response.data['DEPOSIT_VALUE_TO'] == -1){
                            $('.calculated-value #depositRange').html(response.data['DEPOSIT_VALUE_FROM'] + ' فأكثر');
                        }else{
                            $('.calculated-value #depositRange').html(response.data['DEPOSIT_VALUE_FROM'] + ' الى ' + response.data['DEPOSIT_VALUE_TO']);
                        }
                        form.find('#DEPOSIT_VALUE').removeAttr('disabled');
                        form.find('#DEPOSIT_VALUE').siblings('.input-number').removeAttr('disabled');
                        $('.calculated-value #depositRange').parent('p').removeClass('d-none');
                    }else{
                        errorShow(form, response.msg);
                    }
                },
                error: function (response) {
                    let html = '';
                    $.each(response.responseJSON.errors, function (index, value) {
                        form.find("input[name='"+index+"']").after('<div class="invalid-feedback d-block">' + value + '</div');
                        form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                    });
                    loaderEnd(form);
                }
            });
        }
    });

    $(document).on('submit', '#deposit_calculate_form', function (e) {
        e.preventDefault();
        let form = $(this);
        errorHide(form);
        let action = form.attr('action');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            url: action,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status) {
                    $('.calculated-value #interest_rate_from').html(response.data['DEFAULT_INTEREST_RATE']+'%');
                    $('.calculated-value #interest_value').html(response.data['INTEREST_VALUE']);
                    // $('.calculated-value #interest_rate_to').html(response.data['INTEREST_RATE_TO']+'%');
                }else{
                    errorShow(form, response.msg);
                }
            },
            error: function (response) {
                let html = '';
                $.each(response.responseJSON.errors, function (index, value) {
                    form.find("input[name='"+index+"']").after('<div class="invalid-feedback d-block">' + value + '</div');
                    form.find("select[name='"+index+"']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
                });
                loaderEnd(form);
            }
        });
    });

    $(document).on('click', '#deposit_calculate_reset', function (e){
        e.preventDefault();
        let form = $('#deposit_calculate_form');
        errorHide(form);
        $('.invalid-feedback').remove();
        form.trigger('reset');
        form.find('select').val(null).trigger('change');
        form.find('.select2.full').removeClass('full');
        $('.calculated-value #interest_rate_from').html('-');
        $('.calculated-value #interest_rate_to').html('');
        $('.calculated-value #interest_value').html('-');
        form.find('#DEPOSIT_VALUE').attr('disabled', 'disabled');
        form.find('#DEPOSIT_VALUE').siblings('.input-number').attr('disabled', 'disabled');
        $('.calculated-value #depositRange').parent('p').addClass('d-none');
    });

    function validateFilter(){
        let value = true;
        $('.fromToValidation').each(function(i, obj) {
            let isDate = $(obj).attr('data-isDate');
            let from = $(obj).find('.from').not('.input-number').val();
            let from_label = $(obj).find('.from').siblings('label').text();
            let to = $(obj).find('.to').not('.input-number').val();
            let to_label = $(obj).find('.to').siblings('label').text();
            if(from != '' && to != ''){
                if(isDate == 1){
                    if(moment(from, 'DD-MM-YYYY').isAfter(new Date(moment(to, 'DD-MM-YYYY')))){
                        $(this).append('<div class="invalid-feedback d-block">'+to_label+' يجب ان يكون تاريخ لاحق ل '+from_label+'</div>');
                        value = false;
                    }
                }else{
                    if(parseFloat(from) > parseFloat(to)){
                        $(this).append('<div class="invalid-feedback d-block">'+to_label+' يجب ان يكون أكبر من '+from_label+'</div>');
                        value = false;
                    }
                }
            }
        });
        return value;
    }

    function sortableTable(url, renderId='#items_here'){
        $(document).on('click', '.table-sortable .sorted-column', function (e){
            $('.div-loader').removeClass('d-none');
            let col = $(this);
            let classes = col.attr('class');
            sortValues['ORDER_COLUMN_NAME'] = col.attr('data-name');
            sortValues['ORDER_TYPE'] = 'DESC';
            sortValues['IS_COLUMN_DATE'] = col.attr('data-isDate')==1?1:0;
            $('.table-sortable .sorted-column.DESC').removeClass('DESC');
            $('.table-sortable .sorted-column.ASC').removeClass('ASC');
            col.attr('class', classes);
            if(col.hasClass('DESC')){
                col.removeClass('DESC');
                col.addClass('ASC');
                sortValues['ORDER_TYPE'] = 'ASC';
            }else if(col.hasClass('ASC')){
                col.removeClass('ASC');
                col.addClass('DESC');
            }else{
                col.removeClass('ASC');
                col.addClass('DESC');
            }
            let formdata = new FormData(document.getElementById("filter_form"));
            formdata.append('ORDER_COLUMN_NAME', sortValues['ORDER_COLUMN_NAME']);
            formdata.append('ORDER_TYPE', sortValues['ORDER_TYPE']);
            formdata.append('IS_COLUMN_DATE', sortValues['IS_COLUMN_DATE']);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: url,
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if(response.status){
                        $(renderId).html(response.html);
                        runStaff();
                        activeCountScroll();
                    }else{
                        SwalModal2(response.msg, 'error');
                    }
                    $('.div-loader').addClass('d-none');
                },
                error: function (response) {
                    SwalModal2('حدث خطأ ما!', 'errors');
                    $('.div-loader').addClass('d-none');
                }
            })
        });
    }

    function activeScroll(){
        OverlayScrollbars(document.querySelectorAll('.scroll'), {
            scrollbars: {autoHide: 'leave', autoHideDelay: 600},
            overflowBehavior: {x: 'hidden', y: 'scroll'},
        });
        OverlayScrollbars(document.querySelectorAll('.scroll-track-visible'), {
            overflowBehavior: {x: 'hidden', y: 'scroll'}
        });
    }
    function activeCountScroll(){
        document.querySelectorAll('.scroll-by-count').forEach((el) => {
            if (typeof ScrollbarByCount === 'undefined') {
                console.log('ScrollbarByCount is undefined!');
                return;
            }
            let scrollByCount = new ScrollbarByCount(el);
        });
    }
</script>
