<!-- Vendor Scripts Start -->
<script src="{{asset('assets')}}/js/vendor/jquery-3.5.1.min.js"></script>
<script src="{{asset('assets')}}/js/vendor/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets')}}/js/vendor/OverlayScrollbars.min.js"></script>
<script src="{{asset('assets')}}/js/vendor/autoComplete.min.js"></script>
<script src="{{asset('assets')}}/js/vendor/clamp.min.js"></script>

<script src="{{asset('assets')}}/icon/acorn-icons.js"></script>
<script src="{{asset('assets')}}/icon/acorn-icons-interface.js"></script>
<script src="{{asset('assets')}}/js/fontawesome/all.min.js"></script>

<script src="{{asset('assets')}}/js/cs/scrollspy.js"></script>
<script src="{{asset('assets')}}/js/vendor/moment-with-locales.min.js"></script>
<script src="{{asset('assets')}}/js/vendor/glide.min.js"></script>
<!-- Vendor Scripts End -->

<!-- Template Base Scripts Start -->
<script src="{{asset('assets')}}/js/base/helpers.js"></script>
<script src="{{asset('assets')}}/js/base/globals.js"></script>
<script src="{{asset('assets')}}/js/base/nav.js"></script>
<script src="{{asset('assets')}}/js/base/search.js"></script>
<script src="{{asset('assets')}}/js/base/settings.js"></script>
<!-- Template Base Scripts End -->

<!-- Page Specific Scripts Start -->
@stack('page_script')
<!-- Page Specific Scripts End -->

<script src="{{asset('assets')}}/js/toastr.min.js"></script>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    @if(session()->has('success'))
    toastr.success("{{ session('success') }}");
    {{session()->forget('success')}}
    @endif
    @if(session()->has('error'))
    toastr.error("{{ session('error') }}");
    {{session()->forget('error')}}
    @endif
    @if(session()->has('info'))
    toastr.info("{{ session('info') }}");
    {{session()->forget('info')}}
    @endif
    @if(session()->has('warning'))
    toastr.warning("{{ session('warning') }}");
    {{session()->forget('warning')}}
    @endif
</script>

<script src="{{asset('assets')}}/js/sweetalert2@11.js"></script>
<script>
    const SwalModal = (text ,type ,url) => {
        swal.fire({
            text: text,
            icon: type,
            confirmButtonText: 'تأكيد',
            confirmButtonColor: '#d49839',
        }).then(function (){
            if (url)
                window.location = url;
        });
    };

    const SwalModal2 = (text ,type ,url) => {
        swal.fire({
            text: text,
            icon: type,
            showConfirmButton: false,
            timer: 2000,
        }).then(function (){
            if (url)
                window.location = url;
        });
    };
</script>

<script src="{{asset('assets/jquery.inputfilter.min.js')}}"></script>
<script>
    $(function () {
        $('.number-only').inputfilter({
            maxLength: $(this).attr('maxlength'),
        });
        $('.integer-positive-only').inputfilter({
            maxLength: $(this).attr('maxlength'),
            allowCustom: [',']
        });
        $('.text-only').inputfilter({
            allowNumeric: false,
            // allowText: true,
            maxLength: $(this).attr('maxlength')
        });
        $('.text-english-only').inputfilter({
            regex: '[a-z|A-Z|0-9]'
        });
        $('.float-only').inputfilter({
            maxLength: $(this).attr('maxlength'),
            allowCustom: ['.']
        });
        $('.money-only').inputfilter({
            maxLength: $(this).attr('maxlength'),
            allowCustom: ['.', ',']
        });
        $('.integer-only').inputfilter({
            maxLength: $(this).attr('maxlength'),
            allowCustom: ['-','.', ',']
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
        form.find("input[name='"+index+"'][type=file]").parent().find('.invalid-feedback').addClass('d-block');
        form.find("input[name='"+index+"'][type=file]").parent().find('.invalid-feedback').html(value);
        form.find("input[name='"+index+"'][type!=file]").addClass('border-danger');
        form.find("input[name='"+index+"'][type!=file]").after('<div class="invalid-feedback d-block">' + value + '</div');
        form.find("select[name='"+index+"']").addClass('border-danger');
        form.find("select[name='"+index+"']").after('<div class="invalid-feedback d-block">' + value + '</div');
        form.find("select[name='"+index+"[]']").parent().append('<div class="invalid-feedback d-block">' + value + '</div');
        form.find("textarea[name='"+index+"']").addClass('border-danger');
        form.find("textarea[name='"+index+"']").after('<div class="invalid-feedback d-block">' + value + '</div');
    }

</script>
<script>
    function runStaff(){
        $('[data-bs-toggle="tooltip"]').tooltip();
    }
    function scrollToElem(id, offset=0){
        $('html, body').animate({
            scrollTop: $(id).offset().top - offset
        }, 200);
    }
</script>

@if(!Route::is(['portal.company.partner.add.person', 'portal.company.partner.edit.person']))
    <script src="{{asset('assets')}}/numberFormat.js?v=1.5"></script>
@endif

@if(session()->has('userData') && session()->get('userData')['MODULE_ID']==2)
    @include('portal_v2.layouts.scripts')
@endif

@stack('script')
