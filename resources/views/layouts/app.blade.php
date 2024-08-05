<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SAF ARTIST 2024</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--end::Fonts-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="{{asset('plugins/global/plugins.bundlef552.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/style.bundlef552.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="{{asset('css/themes/layout/header/base/lightf552.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/themes/layout/header/menu/lightf552.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/themes/layout/brand/darkf552.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/themes/layout/aside/darkf552.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/login-1.css') }}" rel="stylesheet" type="text/css" />

    <!-- Google tag (gtag.js) -->
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-39MPJJ1SB7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-39MPJJ1SB7');
    </script>
    <meta name="google-site-verification" content="e6QZlc1nDSbIud2s2AtchGMA5A5XduQnQiIihaf5je4" />

    <!-- Webmaster Code - -->
</head>
<style type="text/css">
    .loginForm{
        margin-top: 0 !important;
    }
</style>
<body>
    <div id="app">
        @if(request()->segment(2) == 'login')
            <main class="loginForm">
                @yield('content')
            </main>
        @else
            <main class="">
                @yield('content')
            </main>
        @endif

    </div>

    <script src="{{asset('js/app.js') }}"></script>
    <script src="{{asset('js/custom.js') }}"></script>

</body>
</html>
