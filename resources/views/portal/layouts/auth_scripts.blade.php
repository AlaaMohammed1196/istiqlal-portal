<!-- Vendor Scripts Start -->
<script src="{{asset('assets')}}/js/vendor/jquery-3.5.1.min.js"></script>
<script src="{{asset('assets')}}/js/vendor/bootstrap.bundle.min.js"></script>

<script src="{{asset('assets')}}/icon/acorn-icons.js"></script>
<script src="{{asset('assets')}}/icon/acorn-icons-interface.js"></script>
<script src="{{asset('assets')}}/js/fontawesome/all.min.js"></script>

<script src="{{asset('assets')}}/js/cs/wizard.js"></script>
<script src="{{asset('assets')}}/js/vendor/jquery.validate/jquery.validate.min.js"></script>

<script src="{{asset('assets')}}/js/vendor/jquery.validate/additional-methods.min.js"></script>
<script src="{{asset('assets')}}/js/vendor/jquery.validate/localization/messages_ar.min.js"></script>

<!-- Vendor Scripts End -->

<!-- Template Base Scripts Start -->
<script src="{{asset('assets')}}/js/base/globals.js"></script>
<script src="{{asset('assets')}}/js/base/settings.js"></script>
<!-- Template Base Scripts End -->
<!-- Page Specific Scripts Start -->
<script src="{{asset('assets')}}/js/vendor/select2.full.min.js"></script>
<script src="{{asset('assets')}}/js/pages/profile.settings.js"></script>

<script src="{{asset('assets')}}/js/forms/wizards.js"></script>

<script src="{{asset('assets')}}/js/common.js"></script>
<script src="{{asset('assets')}}/js/scripts.js"></script>

<script src="{{asset('assets/jquery.inputfilter.min.js')}}"></script>
<script>
    $(function () {
        $('.number-only').inputfilter({
            maxLength: $(this).attr('maxlength'),
        });
        $('.text-only').inputfilter({
            allowNumeric: false,
            // allowText: true,
            maxLength: $(this).attr('maxlength')
        });
        $('.text-english-only').inputfilter({
            regex: '[a-z|A-Z|0-9]'
        });
    });
</script>
<script>
    function errorHide(e){
        e.find('.alert').addClass('d-none');
        e.find('.invalid-feedback').removeClass('d-block');
        e.find('.border-danger').removeClass('border-danger');
    }
    function errorShow(e, msg){
        e.find('.alert.alert-danger').html(msg);
        e.find('.alert.alert-danger').removeClass('d-none');
    }
    function successShow(e, msg){
        e.find('.alert.alert-success').html(msg);
        e.find('.alert.alert-success').removeClass('d-none');
    }
    function loaderStart(form){
        form.find('button[type=submit]').attr('disabled', true);
        form.find('button[type=submit] .text').addClass('d-none');
        form.find('button[type=submit] .btn-loader').removeClass('d-none');
    }
    function loaderEnd(form){
        form.find('button[type=submit]').attr('disabled', false);
        form.find('button[type=submit] .text').removeClass('d-none');
        form.find('button[type=submit] .btn-loader').addClass('d-none');
    }
    function showValidationError(form, index, value){
        form.find("input[name='"+index+"'][type=file]").parent().find('.invalid-feedback').html(value);
        form.find("input[name='"+index+"'][type!=file]").addClass('border-danger');
        form.find("input[name='"+index+"'][type!=file]").after('<div class="invalid-feedback d-block">' + value + '</div');
        form.find("select[name='"+index+"']").addClass('border-danger');
        form.find("select[name='"+index+"']").after('<div class="invalid-feedback d-block">' + value + '</div');
        form.find("textarea[name='"+index+"']").addClass('border-danger');
        form.find("textarea[name='"+index+"']").after('<div class="invalid-feedback d-block">' + value + '</div');
    }
</script>

<script>
    $('.show-password').on('click', function (e){
        $(this).addClass('d-none');
        $(this).siblings('input').attr('type', 'text');
        $(this).siblings('.hide-password').removeClass('d-none');
    });
    $('.hide-password').on('click', function (e){
        $(this).addClass('d-none');
        $(this).siblings('input').attr('type', 'password');
        $(this).siblings('.show-password').removeClass('d-none');
    });
</script>

@stack('script')
