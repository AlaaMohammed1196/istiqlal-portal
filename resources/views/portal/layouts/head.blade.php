<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>بنك الاستقلال للاستثمار والتنمية | الملف الشخصي</title>
    <meta name="description" content="بنك الاستقلال للاستثمار والتنمية - بوابة الدخول لاستقلال أونلاين" />

    <!-- Favicon Tags Start -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{asset('assets')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('assets/img/favicon/apple-touch-icon-114x114.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('assets/img/favicon/apple-touch-icon-72x72.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('assets/img/favicon/apple-touch-icon-144x144.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{asset('assets/img/favicon/apple-touch-icon-60x60.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{asset('assets/img/favicon/apple-touch-icon-120x120.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{asset('assets/img/favicon/apple-touch-icon-76x76.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{asset('assets/img/favicon/apple-touch-icon-152x152.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon/favicon-196x196.png')}}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon/favicon-96x96.png')}}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon/favicon-32x32.png')}}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon/favicon-16x16.png')}}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon/favicon-128.png')}}" sizes="128x128" />
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="img/favicon/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="img/favicon/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="img/favicon/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="img/favicon/mstile-310x310.png" />
    <!-- Favicon Tags End -->

    <!-- Font Tags Start -->
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" />--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">--}}

    <link rel="stylesheet" href="{{asset('assets/font/CS-Interface/style.css')}}" type="text/css"/>
    <!-- Font Tags End -->

    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/vendor/OverlayScrollbars.min.css')}}" type="text/css"/>

    <!-- Page Specific Scripts Start -->
    @stack('page_style')
    <!-- Page Specific Scripts End -->

    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="{{asset('assets/css/font.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}?v=1.171" type="text/css"/>
    <!-- Template Base Styles End -->
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome/all.min.css')}}" type="text/css"/>

    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" type="text/css"/>

    <script src="{{asset('assets/js/base/loader.js')}}"></script>

    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}" type="text/css"/>

    <style>
        .error-message{
            color: #dc3545;
            font-size: .875em;
        }
        html body.swal2-height-auto{
            height: 100%!important;
        }
        .swal2-popup{
            width: 400px!important;
            padding: 25px!important;
        }
        .swal2-popup .swal2-icon{
            margin: 0px auto!important;
            width: 80px!important;
            height: 80px!important;
        }
        .swal2-popup .swal2-html-container{
            margin: 10px 20px!important;
            font-size: 16px;
        }
        .swal2-popup .swal2-actions{
            margin: 0px!important;
        }
        .swal2-styled.swal2-default-outline:focus{
            box-shadow: none!important;
        }
        .select2-container--bootstrap4.select2-container--disabled.select2-container--focus .select2-selection,
        .select2-container--bootstrap4.select2-container--disabled .select2-selection{
            cursor: default;
        }
        .scroll-200px{
            max-height: 200px;
            overflow: auto;
        }
        .custom-scroll{
            overflow: auto;
        }
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        /* Track */
        .custom-scroll::-webkit-scrollbar-track {
            background: #F5F5F5;
            border-radius: 5px;
        }
        /* Handle */
        .custom-scroll::-webkit-scrollbar-thumb {
            background: #AFAFAF;
            border-radius: 5px;
        }
        /* Handle on hover */
        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #707070;
        }
        .mw-100px{
            min-width: 100px;
        }
        .object-cover{
            object-fit: cover;
        }
        .modal .modal-body p{
            white-space: normal;
        }
        html[data-behaviour="pinned"] #nav .small-logo{
            display: none;
        }
        html[data-behaviour="unpinned"] #nav .large-logo{
            display: none;
        }
    </style>

    @stack('style')

</head>
