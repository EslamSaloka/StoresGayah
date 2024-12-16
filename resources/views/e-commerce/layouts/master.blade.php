<!DOCTYPE html>
<html lang="ar">
<head>
    @include('e-commerce.layouts.inc.head')
</head>
@if (Route::is("e-commerce.home"))
    <body class="DOMAIN_NAME DOMAIN_TOKEN" data-token="{{ csrf_token() }}" data-url="{{ url(request()->route('domain')) }}">
@else
    <body class="sticky-header DOMAIN_NAME DOMAIN_TOKEN" data-token="{{ csrf_token() }}" data-url="{{ url(request()->route('domain')) }}">
@endif
    <div id="id_preload_ship" style="width: 100%;height: 100vh;background:#000000a1;position: absolute;top: 0;z-index: 99999;display:none">
        <center style=" margin-top: 20%; ">
            <div class="mlk" style="background-color: {{getStoreInformation('main_color')}} !important;border-color: {{getStoreInformation('main_color')}} !important;padding: 50px;width:300px;border-radius:7px;">
                <img src="{{asset('loading.gif')}}" style="height:50px;width:auto;">
                <h5 style="color: white !important;margin-top:10px;">
                    برجاء الإنتظار .....
                </h5>
            </div>
        </center>
    </div>
    <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>
    @include('e-commerce.layouts.inc.header')
    @yield('PageContent')
    @include('e-commerce.layouts.inc.footer')
</body>
</html>
