<!DOCTYPE html>
<html lang="ar" dir="rtl" data-footer="true" data-override='{"attributes": {"placement": "vertical" }}' @yield('bodyExtra')>
@include('portal.layouts.head')

<body class="rtl pb-0">
<div id="root" class="position-relative">
    @include('portal_v2.layouts.menu')

    <main>
        @yield('content')

        @include('portal_v2.components.deposits_calculator')
    </main>

    <!-- Layout Footer Start -->
    @include('portal.layouts.footer')
    <!-- Layout Footer End -->
</div>


<!-- Search Modal Start -->
<div class="modal fade modal-under-nav modal-search modal-close-out" id="searchPagesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 p-0">
                <button type="button" class="btn-close btn btn-icon btn-icon-only btn-foreground" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ps-5 pe-5 pb-0 border-0">
                <input id="searchPagesInput" placeholder="بحث..." class="form-control form-control-xl borderless ps-0 pe-0 mb-1 auto-complete" type="text" autocomplete="off" />
            </div>
            <div class="modal-footer border-top justify-content-start ps-5 pe-5 pb-3 pt-3 border-0">
            <span class="text-alternate d-inline-block m-0 me-3">
              <i data-acorn-icon="arrow-bottom" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
              <span class="align-middle text-medium">التنقل</span>
            </span>
                <span class="text-alternate d-inline-block m-0 me-3">
              <i data-acorn-icon="arrow-bottom-left" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
              <span class="align-middle text-medium">للاختيار</span>
            </span>
            </div>
        </div>
    </div>
</div>
<!-- Search Modal End -->

@include('portal.layouts.scripts')

</body>
</html>
