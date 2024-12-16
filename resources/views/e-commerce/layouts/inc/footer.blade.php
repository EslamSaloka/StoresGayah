<div class="service-area" style="margin-top:50px;">
    <div class="container">
        <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <i class="fa fa-truck-moving featured_icons"></i>
                    </div>
                    <div class="content">
                        <h6 class="title">شحن سريع وأمن</h6>
                        <p>عبر منصة غاية اكسبريس.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <i class="fa fa-wreath featured_icons"></i>
                    </div>
                    <div class="content">
                        <h6 class="title">منتجات أصلية</h6>
                        <p>بنسبة ١٠٠٪.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <i class="fa fa-wifi featured_icons"></i>
                    </div>
                    <div class="content">
                        <h6 class="title">خدمة متواصلة</h6>
                        <p>على مدار الساعة.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <i class="fa fa-phone-plus featured_icons"></i>
                    </div>
                    <div class="content">
                        <h6 class="title">خدمة عملاء سريعة</h6>
                        <p>طوال ايام الاسبوع.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Footer Area  -->
<footer class="axil-footer-area footer-style-2">
    <!-- Start Footer Top Area  -->
    <div class="footer-top separator-top">
        <div class="container">
            <div class="row">
                <!-- Start Single Widget  -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">بيانات التواصل</h5>
                        <div class="inner">
                            <ul class="support-list-item">
                                <li><a href="#!"><i class="fal fa-map-marker"></i>{{ getStoreInformation("address") }}</a></li>
                                <li><a href="mailto:{{ getStoreInformation("email") }}"><i class="fal fa-envelope-open"></i> {{ getStoreInformation("email") }}</a></li>
                                <li><a href="tel:{{ getStoreInformation("phone") }}"><i class="fal fa-phone-alt"></i> {{ getStoreInformation("phone") }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">المتجر</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="{{ makeRoute('about') }}">من نحن</a></li>
                                <li><a href="{{ makeRoute('contact.index') }}">تواصل معنا</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">روابط سريعة</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="{{ makeRoute('home') }}">الصفحة الرئيسية</a></li>
                                <li><a href="{{ makeRoute('products.index') }}">المنتجات</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">رمز الإستجابة السريعة</h5>
                        <div class="inner">
                            <div class="download-btn-group">
                                <div class="qr-code">
                                    <img src="https://barcode.tec-it.com/barcode.ashx?data={{ makeRoute('home') }}&code=QRCode&translate-esc=on" alt="Axilthemes">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
            </div>
        </div>
    </div>
    <!-- End Footer Top Area  -->
    <!-- Start Copyright Area  -->
    <div class="copyright-area copyright-default separator-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-4">
                    <div class="social-share">
                        <a href="{{ getStoreInformation("facebook") }}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ getStoreInformation("instagram") }}"><i class="fab fa-instagram"></i></a>
                        <a href="{{ getStoreInformation("twitter") }}"><i class="fab fa-twitter"></i></a>
                        <a href="{{ getStoreInformation("snapchat") }}"><i class="fab fa-snapchat"></i></a>
                         <a href="{{ getStoreInformation("tiktok") }}">
                             <i class="">
                                 <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                     <path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/>
                                 </svg>
                             </i>
                         </a>
                        </i></a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="copyright-left d-flex flex-wrap justify-content-center">
                        <ul class="quick-link">
                            <li> جميع الحقوق محفوظة - متجر {{ getStoreInformation("store_name") }} © |  <a target="_blank" href="https://gayah-express.com">غاية اكسبريس</a>.</li>
                        </ul>
                        @if(getStoreInformation("vat_registration") != "")
                        <p style="font-size:14px;margin-bottom:10px;"> رقم التسجيل الضريبي :  {{ getStoreInformation("vat_registration") }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="copyright-right d-flex flex-wrap justify-content-xl-end justify-content-center align-items-center">
                        <span class="card-text">نقبل الدفع بــ  </span>
                        <ul class="payment-icons-bottom quick-link">
                            <li><img src="{{ url('/assets/images/icons/cart/cart-2.png') }}" alt="paypal cart"></li>
                            <li><img src="{{ url('/assets/images/icons/cart/cart-5.png') }}" alt="paypal cart"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Copyright Area  -->


</footer>
<!-- End Footer Area  -->

<!-- Product Quick View Modal Start -->
<div class="modal fade quick-view-product" id="quick-view-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
            </div>
            <div class="modal-body" id="quickView">

            </div>
        </div>
    </div>
</div>
<!-- Product Quick View Modal End -->

<!-- Header Search Modal End -->
<div class="header-search-modal" id="header-search-modal">
    <button class="card-close sidebar-close"><i class="fas fa-times"></i></button>
    <div class="header-search-wrap">
        <div class="card-header">
            <form action="{{ makeRoute("products.index") }}" method="get">
                <div class="input-group">
                    <input type="search" class="form-control" id="prod-search" name="name" autofocus="autofocus" tabindex="1" id="prod-search" placeholder="ماذا تبحث عن ؟ ">
                    <button type="submit" class="axil-btn btn-bg-primary"><i class="far fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Header Search Modal End -->

@php
    $cart = (new \App\Support\Cart);
@endphp


<div class="cart-dropdown" id="cart-dropdown">
    <div class="cart-content-wrap">
        <div class="cart-header">
            <h2 class="header-title">سلة المشتريات</h2>
            <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-body">
            @if ($cart->getCount() != 0)
                <ul class="cart-item-list">

                    @foreach ($cart->showItems() as $item)
                        <li class="cart-item" id="cart_{{$item['id']}}">
                            <div class="item-img">
                                <a href="{{ makeRoute('products.show',[$item['id']]) }}"><img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"></a>
                                <button data-url="{{ makeRoute('cart.delete',[$item['id']]) }}" class="close-btn cartDeleteAction" data-id="{{$item['id']}}" ><i class="fas fa-times"></i></button>
                            </div>
                            <div class="item-content">
                                <h3 class="item-title"><a href="{{ makeRoute('products.show',[$item['id']]) }}">{{ $item['name'] }}</a></h3>
                                <div class="item-price"><span class="currency-symbol">{{ $item['total'] }} ر.س</span></div>
                                <div class="pro-qty item-quantity" data-action="{{ makeRoute('cart.addOrRemoveQty',[$item['id']]) }}">
                                    <input readonly type="number" min="1" class="quantity-input" value="{{ $item['qty'] }}">
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            @else
                <center>
                    <img width="350px" src="{{ url('/assets/images/cart_empty.gif') }}" alt="" srcset="">
                    <p>
                        لا يوجد منتجات في السله
                    </p>
                </center>
            @endif
        </div>
        @if ($cart->getCount() != 0)
            <div class="cart-footer">
                <h3 class="cart-subtotal">
                    <span class="subtotal-title">المجموع :</span>
                    <span class="subtotal-amount cartTotal">{{ $cart->getSubTotal() }} ر.س</span>
                </h3>
                <div class="group-btn">
                    <a href="{{ makeRoute('cart.index') }}" class="axil-btn btn-bg-primary viewcart-btn">عرض سلة المشتريات</a>
                </div>
            </div>
        @endif
    </div>
</div>


<script src="{{ url('/assets/js/vendor/modernizr.min.js') }}"></script>
<script src="{{ url('/assets/js/vendor/jquery.js') }}"></script>
<script src="{{ url('/assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ url('/assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ url('/assets/js/vendor/slick.min.js') }}"></script>
<script src="{{ url('/assets/js/vendor/js.cookie.js') }}"></script>
<script src="{{ url('/assets/js/vendor/jquery-ui.min.js') }}"></script>
<script src="{{ url('/assets/js/vendor/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ url('/assets/js/vendor/jquery.countdown.min.js') }}"></script>
<script src="{{ url('/assets/js/vendor/sal.js') }}"></script>
<script src="{{ url('/assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ url('/assets/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ url('/assets/js/vendor/isotope.pkgd.min.js') }}"></script>
<script src="{{ url('/assets/js/vendor/counterup.js') }}"></script>
<script src="{{ url('/assets/js/vendor/waypoints.min.js') }}"></script>
<script src="{{ url('/assets/js/rtl-main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.0/sweetalert2.all.js"></script>
<script src="{{ url('/assets/js/e-commerce.js') }}"></script>


@if (Session::get('success'))
    <script>
        Swal.fire({
            title: 'عملية ناجحة',
            text: "{{ Session::get('success') }}",
            icon: 'success',
            confirmButtonText: 'موافق'
        })
    </script>
@endif
@if (Session::get('danger'))
    <script>
        Swal.fire({
            title: 'حدث خطأ',
            text: "{{ Session::get('danger') }}",
            icon: 'error',
            confirmButtonText: 'موافق'
        })
    </script>
@endif

@stack('scripts')
