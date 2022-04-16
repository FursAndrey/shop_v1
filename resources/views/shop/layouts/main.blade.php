<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset("img/favicon.png") }}">
		
		<!-- all css here -->
        @yield('header_styles')
    </head>
    <body>
        @yield('content')
		<!-- all js here -->
        @yield('footer_script')
    </body>
</html>
