<!DOCTYPE html>
<html lang="ar">
<head>
    @include('website.layouts.inc.head')
</head>

<body>

    <div class="preloader">
        <div class="loader">
            <div class="loader-box-1"></div>
            <div class="loader-box-2"></div>
        </div>
    </div>

    @include('website.layouts.inc.header')
    @yield('PageContent')
    @include('website.layouts.inc.footer')
</body>
</html>
