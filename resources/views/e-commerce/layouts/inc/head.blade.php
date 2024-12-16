<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>@yield('title') - {{ getStoreInformation("store_name") }}</title>
<meta name="robots" content="noindex, follow" />
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ url(getStoreInformation("logo")) }}">

<!-- CSS
============================================ -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ url('/assets/css/vendor/bootstrap.rtl.min.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/vendor/font-awesome.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/vendor/flaticon/flaticon.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/vendor/slick.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/vendor/slick-theme.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/vendor/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/vendor/sal.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/vendor/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/vendor/base.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/style.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.27/sweetalert2.min.css">
@include('e-commerce.layouts.inc.color')
@stack('styles')
